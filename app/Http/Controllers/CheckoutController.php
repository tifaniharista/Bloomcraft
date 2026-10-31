<?php
namespace App\Http\Controllers;
use App\Models\InventoryReservation;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderStatusHistory;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
class CheckoutController extends Controller {
    public function index() {
        $sessionCart=session('cart', []);
        if (!$sessionCart) return redirect()->route('cart.index')->with('error','Keranjang masih kosong.');
        $products=Product::whereIn('id',array_map('intval',array_keys($sessionCart)))->get()->keyBy('id'); $cart=[]; $total=0;
        foreach ($sessionCart as $id=>$item) {
            $product=$products->get((int)$id); $qty=filter_var($item['quantity']??null,FILTER_VALIDATE_INT);
            if (!$product || $product->status!=='active' || !$qty || $qty<1 || $qty>$product->stock) return redirect()->route('cart.index')->with('error','Produk tidak tersedia atau jumlah melebihi stok. Perbarui keranjang.');
            $price=$product->currentPrice(); $line=$price*$qty; $total+=$line;
            $cart[$product->id]=['id'=>$product->id,'name'=>$product->name,'price'=>$price,'image'=>$product->image??[],'quantity'=>$qty,'line_total'=>$line,'stock'=>$product->stock];
        }
        return view('checkout.index',compact('cart','total'));
    }
    public function store(Request $request) {
        $data=$request->validate(['name'=>'required|string|max:120','email'=>'required|email|max:190','phone'=>'required|string|max:30','address'=>'required|string|max:2000']);
        $sessionCart=session('cart',[]); if (!$sessionCart) return redirect()->route('cart.index')->with('error','Keranjang masih kosong.');
        $quantities=[]; foreach($sessionCart as $id=>$item) { $pid=filter_var($id,FILTER_VALIDATE_INT); $qty=filter_var($item['quantity']??null,FILTER_VALIDATE_INT); if(!$pid||!$qty||$qty<1||$qty>99) throw ValidationException::withMessages(['cart'=>'Keranjang tidak valid.']); $quantities[$pid]=$qty; } ksort($quantities);
        $order=DB::transaction(function() use($data,$quantities) {
            $products=Product::whereIn('id',array_keys($quantities))->orderBy('id')->lockForUpdate()->get()->keyBy('id');
            if($products->count()!==count($quantities)) throw ValidationException::withMessages(['cart'=>'Produk tidak ditemukan.']);
            $subtotal=0; $lines=[];
            foreach($quantities as $id=>$qty) { $product=$products->get($id); if(!$product||$product->status!=='active'||$product->stock<$qty) throw ValidationException::withMessages(['cart'=>'Stok produk '.$product?->name.' tidak mencukupi.']); $price=$product->currentPrice(); $line=$price*$qty; $subtotal+=$line; $lines[]=compact('product','qty','price','line'); }
            $order=Order::create(['order_number'=>'BC-'.now()->format('YmdHis').'-'.Str::upper(Str::random(4)),'user_id'=>auth()->id(),'name'=>$data['name'],'email'=>$data['email'],'phone'=>$data['phone'],'address'=>$data['address'],'subtotal'=>$subtotal,'shipping_cost'=>0,'discount_amount'=>0,'total'=>$subtotal,'status'=>'pending','payment_status'=>'awaiting_proof','order_status'=>'awaiting_payment']);
            Payment::create(['order_id'=>$order->id,'amount'=>$subtotal,'method'=>'bank_transfer','status'=>'awaiting_proof']);
            foreach($lines as $line) { $product=$line['product']; OrderDetail::create(['order_id'=>$order->id,'product_id'=>$product->id,'product_name'=>$product->name,'price'=>$line['price'],'quantity'=>$line['qty'],'line_total'=>$line['line']]); $product->decrement('stock',$line['qty']); InventoryReservation::create(['order_id'=>$order->id,'product_id'=>$product->id,'quantity'=>$line['qty'],'status'=>'reserved','expires_at'=>now()->addDays(2)]); }
            OrderStatusHistory::create(['order_id'=>$order->id,'from_status'=>null,'to_status'=>'awaiting_payment','changed_by'=>auth()->id(),'note'=>'Pesanan dibuat. Ongkir gratis; menunggu bukti transfer.']);
            return $order;
        },3);
        session()->forget('cart');
        return redirect()->route('orders.index')->with('success','Pesanan '.$order->order_number.' berhasil dibuat. Silakan unggah bukti transfer. Ongkir gratis.');
    }
}
