<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Expense extends Model {
    protected $fillable=['kategori','keterangan','jumlah','tanggal','user_id'];
    protected $casts=['tanggal'=>'date'];
    public function user(){return $this->belongsTo(User::class);}
}
