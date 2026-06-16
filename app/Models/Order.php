<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Order extends Model {
    protected $fillable=['customer_id','kurir_pickup_id','kurir_delivery_id','tanggal_order','jenis_laundry','status','total_berat','total_harga','harga_per_kg','catatan','foto_pickup','foto_delivery','jadwal_pickup','jadwal_delivery'];
    protected $casts=['tanggal_order'=>'datetime','jadwal_pickup'=>'datetime','jadwal_delivery'=>'datetime'];

    public static $statusLabels=['menunggu_pickup'=>'Menunggu Pickup','pickup'=>'Pickup','proses'=>'Diproses','selesai_cuci'=>'Selesai Cuci','siap_delivery'=>'Siap Delivery','delivery'=>'Delivery','selesai'=>'Selesai'];
    public static $statusColors=['menunggu_pickup'=>'warning','pickup'=>'info','proses'=>'primary','selesai_cuci'=>'secondary','siap_delivery'=>'success','delivery'=>'info','selesai'=>'success'];

    public function getStatusLabelAttribute():string{return self::$statusLabels[$this->status]??$this->status;}
    public function getStatusColorAttribute():string{return self::$statusColors[$this->status]??'secondary';}
    public function customer(){return $this->belongsTo(Customer::class);}
    public function kurirPickup(){return $this->belongsTo(User::class,'kurir_pickup_id');}
    public function kurirDelivery(){return $this->belongsTo(User::class,'kurir_delivery_id');}
    public function statusLogs(){return $this->hasMany(OrderStatusLog::class)->latest();}
    public function invoice(){return $this->hasOne(Invoice::class);}
}
