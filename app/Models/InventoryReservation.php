<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class InventoryReservation extends Model {
    protected $fillable = ['order_id','product_id','quantity','status','expires_at','released_at'];
    protected function casts(): array { return ['expires_at'=>'datetime','released_at'=>'datetime','quantity'=>'integer']; }
    public function order() { return $this->belongsTo(Order::class); }
    public function product() { return $this->belongsTo(Product::class); }
}
