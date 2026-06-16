<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Invoice extends Model {
    protected $fillable=['no_invoice','order_id','subtotal','total','status','tanggal_bayar'];
    protected $casts=['tanggal_bayar'=>'datetime'];
    public function order(){return $this->belongsTo(Order::class);}
}
