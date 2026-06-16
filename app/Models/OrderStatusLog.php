<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class OrderStatusLog extends Model {
    protected $fillable=['order_id','status','catatan','actor_id','actor_type'];
    public function order(){return $this->belongsTo(Order::class);}
}
