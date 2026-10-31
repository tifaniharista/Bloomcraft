<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderStatusHistory;
use App\Models\InventoryReservation;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Menampilkan daftar pesanan admin.
     */
    public function index()
    {
        $orders = Order::with('user', 'latestPayment')
            ->latest()
            ->get();

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Menampilkan detail pesanan.
     */
    public function show(Order $order)
    {
        $order->load('details.product', 'user', 'payments', 'statusHistories');

        return view('admin.orders.show', compact('order'));
    }

    /**
     * Memperbarui status pesanan.
     */
    public function update(Request $request, Order $order)
    {
        $data = $request->validate([
            'status' => 'required|in:pending,process,success,cancel',
        ]);

        if (
            in_array($data['status'], ['process', 'success'], true)
            && $order->payment_status !== 'paid'
        ) {
            return back()->with(
                'error',
                'Verifikasi pembayaran sebelum memproses pesanan.'
            );
        }

        if (
            $data['status'] === 'cancel'
            && $order->payment_status === 'paid'
        ) {
            return back()->with(
                'error',
                'Pesanan yang sudah dibayar memerlukan penanganan refund.'
            );
        }

        $from = $order->order_status;

        DB::transaction(function () use ($order, $data, $from) {
            if ($data['status'] === 'cancel') {
                $reservations = InventoryReservation::where('order_id', $order->id)
                    ->whereIn('status', ['reserved', 'confirmed'])
                    ->lockForUpdate()
                    ->get();

                foreach ($reservations as $reservation) {
                    if ($reservation->product_id) {
                        $product = Product::whereKey($reservation->product_id)
                            ->lockForUpdate()
                            ->first();

                        if ($product) {
                            $product->increment('stock', $reservation->quantity);
                        }
                    }

                    $reservation->update([
                        'status' => 'released',
                        'released_at' => now(),
                    ]);
                }

                $order->update([
                    'status' => 'cancel',
                    'order_status' => 'cancelled',
                    'payment_status' => 'cancelled',
                ]);
            } elseif ($data['status'] === 'success') {
                $order->update([
                    'status' => 'success',
                    'order_status' => 'completed',
                    'completed_at' => now(),
                ]);
            } elseif ($data['status'] === 'process') {
                $order->update([
                    'status' => 'process',
                    'order_status' => 'processing',
                ]);
            } else {
                $order->update([
                    'status' => 'pending',
                ]);
            }

            OrderStatusHistory::create([
                'order_id' => $order->id,
                'from_status' => $from,
                'to_status' => $order->fresh()->order_status,
                'changed_by' => auth()->id(),
                'note' => 'Status pesanan diperbarui admin.',
            ]);
        });

        return back()->with('success', 'Status pesanan diperbarui.');
    }

    /**
     * Menghapus pesanan yang benar-benar sudah selesai.
     *
     * Pesanan yang masih diproses, menunggu pembayaran, atau dibatalkan
     * tidak dapat dihapus melalui tindakan ini.
     */
    public function destroy(Order $order)
    {
        $deleted = DB::transaction(function () use ($order): bool {
            // Kunci dan periksa ulang status pesanan di dalam transaksi.
            $lockedOrder = Order::query()
                ->whereKey($order->getKey())
                ->lockForUpdate()
                ->firstOrFail();

            if ($lockedOrder->order_status !== 'completed') {
                return false;
            }

            $orderId = $lockedOrder->id;

            // Hapus data turunan terlebih dahulu agar tidak menyisakan
            // referensi ke pesanan yang sudah dihapus.
            OrderStatusHistory::where('order_id', $orderId)->delete();
            InventoryReservation::where('order_id', $orderId)->delete();

            $lockedOrder->payments()->delete();
            $lockedOrder->details()->delete();

            // Pesanan selesai tidak mengembalikan stok: stok sudah terjual.
            $lockedOrder->delete();

            return true;
        });

        if (! $deleted) {
            return redirect()
                ->route('admin.orders.index')
                ->with(
                    'error',
                    'Hanya pesanan berstatus Selesai yang dapat dihapus.'
                );
        }

        return redirect()
            ->route('admin.orders.index')
            ->with('success', 'Pesanan selesai berhasil dihapus.');
    }
}
