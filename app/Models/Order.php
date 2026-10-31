<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Order extends Model {
    protected $fillable = ['order_number','user_id','name','email','phone','address','subtotal','shipping_cost','discount_amount','total','status','payment_status','order_status','shipping_courier','shipping_service','tracking_number','paid_at','shipped_at','completed_at'];
    protected function casts(): array { return ['subtotal'=>'decimal:2','shipping_cost'=>'decimal:2','discount_amount'=>'decimal:2','total'=>'decimal:2','paid_at'=>'datetime','shipped_at'=>'datetime','completed_at'=>'datetime']; }
    public function details() { return $this->hasMany(OrderDetail::class); }
    public function user() { return $this->belongsTo(User::class); }
    public function payments() { return $this->hasMany(Payment::class); }
    public function latestPayment() { return $this->hasOne(Payment::class)->latestOfMany(); }
    public function inventoryReservations() { return $this->hasMany(InventoryReservation::class); }
    public function statusHistories() { return $this->hasMany(OrderStatusHistory::class); }
}
