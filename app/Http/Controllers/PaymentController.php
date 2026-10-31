<?php
namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class PaymentController extends Controller {
    public function upload(Request $request, Order $order) {
        abort_unless($order->user_id === $request->user()->id, 403);
        $data=$request->validate(['proof'=>'required|image|mimes:jpg,jpeg,png,webp|max:4096']);
        abort_if($order->payment_status==='paid', 422, 'Pembayaran pesanan ini sudah diverifikasi.');
        $payment=$order->payments()->latest()->firstOrFail();
        if($payment->proof_path) Storage::disk('local')->delete($payment->proof_path);
        $path=$data['proof']->store('payment-proofs','local');
        $payment->update(['proof_path'=>$path,'status'=>'under_review','admin_note'=>null]);
        $order->update(['payment_status'=>'under_review','order_status'=>'payment_review']);
        return redirect()->route('orders.index')->with('success','Bukti transfer berhasil diunggah dan menunggu verifikasi admin.');
    }
}
