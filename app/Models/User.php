<?php
namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class User extends Authenticatable {
    use Notifiable;
    protected $fillable=['name','email','password','role','no_telp','kendaraan'];
    protected $hidden=['password','remember_token'];
    protected $casts=['password'=>'hashed'];
    public function ordersAsPickup(){return $this->hasMany(Order::class,'kurir_pickup_id');}
    public function ordersAsDelivery(){return $this->hasMany(Order::class,'kurir_delivery_id');}
    public function expenses(){return $this->hasMany(Expense::class);}
}
