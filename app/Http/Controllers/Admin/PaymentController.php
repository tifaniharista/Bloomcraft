<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderStatusHistory;
use App\Models\Product;
use App\Models\InventoryReservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
class PaymentController extends Controller {
    public function proof(Order $order) {
        $payment=$order->payments()->latest()->firstOrFail();
        abort_unless($payment->proof_path && Storage::disk('local')->exists($payment->proof_path),404);
        return Storage::disk('local')->response($payment->proof_path);
    }

    public function verify(Request $request, Order $order) {
        $data=$request->validate(['decision'=>'required|in:approve,reject','admin_note'=>'nullable|required_if:decision,reject|string|max:1000']);
        $payment=$order->payments()->latest()->firstOrFail();
        if(!$payment->proof_path) return back()->with('error','Belum ada bukti transfer untuk diverifikasi.');
        if($order->payment_status==='paid') return back()->with('error','Pembayaran sudah diverifikasi sebelumnya.');
        DB::transaction(function() use($data,$order,$payment) {
            $from=$order->order_status;
            if($data['decision']==='approve') {
                $payment->update(['status'=>'approved','admin_note'=>$data['admin_note']??null,'verified_by'=>auth()->id(),'verified_at'=>now()]);
                $order->update(['payment_status'=>'paid','order_status'=>'processing','status'=>'process','paid_at'=>now()]);
                InventoryReservation::where('order_id',$order->id)->where('status','reserved')->update(['status'=>'confirmed']);
                $note='Pembayaran diverifikasi admin.';
            } else {
                $payment->update(['status'=>'rejected','admin_note'=>$data['admin_note']??'Bukti transfer perlu diperbaiki.','verified_by'=>auth()->id(),'verified_at'=>now()]);
                $order->update(['payment_status'=>'proof_rejected','order_status'=>'awaiting_payment','status'=>'pending']);
                $note='Bukti transfer ditolak; customer diminta mengunggah ulang.';
            }
            OrderStatusHistory::create(['order_id'=>$order->id,'from_status'=>$from,'to_status'=>$order->fresh()->order_status,'changed_by'=>auth()->id(),'note'=>$note]);
        });
        return back()->with('success',$data['decision']==='approve'?'Pembayaran disetujui; pesanan dapat diproses.':'Bukti ditolak; customer dapat mengunggah bukti baru.');
    }
    public function readyToShip(Request $request, Order $order) {
        abort_unless($order->payment_status==='paid',422,'Pembayaran harus diverifikasi terlebih dahulu.');
        $data=$request->validate(['shipping_courier'=>'nullable|string|max:100','shipping_service'=>'nullable|string|max:100','tracking_number'=>'nullable|string|max:100']);
        $from=$order->order_status; $order->update($data+['order_status'=>'ready_to_ship','status'=>'process','shipped_at'=>now()]);
        OrderStatusHistory::create(['order_id'=>$order->id,'from_status'=>$from,'to_status'=>'ready_to_ship','changed_by'=>auth()->id(),'note'=>'Barang siap dikirim; customer diinformasikan melalui WhatsApp. Ongkir gratis.']);
        return back()->with('success','Status barang siap dikirim disimpan. Gunakan tautan WhatsApp untuk memberi tahu customer.');
    }
}
