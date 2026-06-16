<?php
namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class Customer extends Authenticatable {
    use Notifiable;
    protected $fillable=['nama','email','password','no_telp','alamat'];
    protected $hidden=['password','remember_token'];
    protected $casts=['password'=>'hashed'];
    public function orders(){return $this->hasMany(Order::class);}
}
