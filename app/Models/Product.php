<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Product extends Model {
    protected $fillable = ['name','slug','category_id','price','sale_price','stock','description','status','image','image_path'];
    protected function casts(): array { return ['image'=>'array','price'=>'decimal:2','sale_price'=>'decimal:2','stock'=>'integer']; }
    public function category() { return $this->belongsTo(Category::class); }
    public function orderDetails() { return $this->hasMany(OrderDetail::class); }
    public function inventoryReservations() { return $this->hasMany(InventoryReservation::class); }
    public function currentPrice(): int { $price=(int) round((float)$this->price); $sale=$this->sale_price !== null ? (int)round((float)$this->sale_price) : null; return $sale !== null && $sale > 0 && $sale < $price ? $sale : $price; }
}
