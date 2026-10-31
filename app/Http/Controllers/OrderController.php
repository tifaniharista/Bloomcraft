<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class OrderController extends Controller
{
    /**
     * Menampilkan daftar pesanan milik customer yang sedang login.
     */
    public function index(): View
    {
        $orders = Order::where('user_id', auth()->id())
            ->with('details.product', 'payments')
            ->latest()
            ->get();

        return view('orders.index', compact('orders'));
    }

    /**
     * Memperbarui nomor telepon pada pesanan milik customer.
     *
     * Nomor telepon hanya dapat diubah sebelum pesanan selesai,
     * dibatalkan, atau kedaluwarsa.
     */
    public function updatePhone(Request $request, Order $order): RedirectResponse
    {
        $validated = $request->validate([
            'phone' => [
                'required',
                'string',
                'max:30',
                'regex:/^[0-9+\-\s()]{8,30}$/',
            ],
        ], [
            'phone.required' => 'Nomor telepon wajib diisi.',
            'phone.string' => 'Nomor telepon harus berupa teks.',
            'phone.max' => 'Nomor telepon maksimal 30 karakter.',
            'phone.regex' => 'Format nomor telepon tidak valid. Gunakan angka dan karakter +, spasi, tanda kurung, atau tanda hubung.',
        ]);

        // Kunci baris pesanan selama pemeriksaan dan penyimpanan agar status
        // tidak berubah di tengah proses update.
        $updated = DB::transaction(function () use ($request, $order, $validated): bool {
            $lockedOrder = Order::query()
                ->whereKey($order->getKey())
                ->lockForUpdate()
                ->firstOrFail();

            // Jangan membocorkan keberadaan pesanan milik customer lain.
            abort_unless(
                (int) $lockedOrder->user_id === (int) $request->user()->id,
                404
            );

            if ($this->phoneEditingIsLocked($lockedOrder)) {
                return false;
            }

            $lockedOrder->phone = trim($validated['phone']);
            $lockedOrder->save();

            return true;
        });

        if (! $updated) {
            return redirect()
                ->route('orders.index')
                ->with('error', 'Nomor telepon tidak dapat diubah karena pesanan sudah selesai, dibatalkan, atau kedaluwarsa.');
        }

        return redirect()
            ->route('orders.index')
            ->with('success', 'Nomor telepon pesanan berhasil diperbarui.');
    }

    /**
     * Menampilkan invoice hanya setelah bukti pembayaran berhasil diunggah.
     */
    public function invoice(Request $request, Order $order): View
    {
        // Customer hanya boleh membuka invoice untuk pesanan miliknya sendiri.
        abort_unless(
            (int) $order->user_id === (int) $request->user()->id,
            404
        );

        $order->load(['details.product', 'payments']);

        // PaymentController menyimpan bukti pada payment terbaru.
        $payment = $order->payments
            ->sortByDesc('id')
            ->first();

        // Jangan tampilkan invoice jika bukti pembayaran belum diunggah.
        abort_unless(
            $payment && filled($payment->proof_path),
            404,
            'Invoice tersedia setelah bukti pembayaran berhasil diunggah.'
        );

        return view('orders.invoice', compact('order', 'payment'));
    }

    /**
     * Menentukan apakah pengeditan nomor telepon harus dikunci.
     */
    private function phoneEditingIsLocked(Order $order): bool
    {
        return in_array($order->order_status, [
            'completed',
            'cancelled',
            'expired',
        ], true)
            || in_array($order->status, [
                'success',
                'cancel',
                'cancelled',
                'expired',
            ], true)
            || $order->payment_status === 'cancelled';
    }
}
