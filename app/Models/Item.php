<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Item extends Model {
    protected $fillable=['nama','satuan','stok','stok_minimum','harga_satuan'];
    public function getStatusAttribute():string{
        if($this->stok<=0)return'Habis';
        if($this->stok<=$this->stok_minimum)return'Kritis';
        if($this->stok<=$this->stok_minimum*1.5)return'Menipis';
        return'Aman';
    }
    public function getStatusColorAttribute():string{
        return match($this->status){'Habis','Kritis'=>'danger','Menipis'=>'warning',default=>'success'};
    }
}
