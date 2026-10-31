<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Payment extends Model {
    protected $fillable = ['order_id','amount','method','proof_path','status','admin_note','verified_by','verified_at'];
    protected function casts(): array { return ['amount'=>'decimal:2','verified_at'=>'datetime']; }
    public function order() { return $this->belongsTo(Order::class); }
    public function verifier() { return $this->belongsTo(User::class, 'verified_by'); }
}
