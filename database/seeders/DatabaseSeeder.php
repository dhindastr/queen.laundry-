<?php
namespace Database\Seeders;
use App\Models\{Customer,Expense,Invoice,Item,Order,OrderStatusLog,User};
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder {
    public function run(): void {
        User::create(['name'=>'Admin Queen','email'=>'admin@queen.com','password'=>Hash::make('password'),'role'=>'admin','no_telp'=>'081234567890']);
        User::create(['name'=>'H. Sutrisno','email'=>'owner@queen.com','password'=>Hash::make('password'),'role'=>'owner','no_telp'=>'081234567891']);
        $k1=User::create(['name'=>'Andi Nugroho','email'=>'andi@queen.com','password'=>Hash::make('password'),'role'=>'kurir','no_telp'=>'081234567892','kendaraan'=>'Motor']);
        $k2=User::create(['name'=>'Rudi Hartono','email'=>'rudi@queen.com','password'=>Hash::make('password'),'role'=>'kurir','no_telp'=>'081234567893','kendaraan'=>'Motor']);

        $c1=Customer::create(['nama'=>'PT Maju Jaya','email'=>'customer@queen.com','password'=>Hash::make('password'),'no_telp'=>'082111111111','alamat'=>'Jl. Diponegoro No.45, Surabaya']);
        $c2=Customer::create(['nama'=>'CV Sejahtera','email'=>'cv@queen.com','password'=>Hash::make('password'),'no_telp'=>'082222222222','alamat'=>'Jl. Ahmad Yani No.12, Surabaya']);
        $c3=Customer::create(['nama'=>'Toko Sumber','email'=>'toko@queen.com','password'=>Hash::make('password'),'no_telp'=>'082333333333','alamat'=>'Jl. Pemuda No.7, Surabaya']);
        $c4=Customer::create(['nama'=>'UD Makmur','email'=>'ud@queen.com','password'=>Hash::make('password'),'no_telp'=>'082444444444','alamat'=>'Jl. Semut No.33, Surabaya']);
        $c5=Customer::create(['nama'=>'Warung Bu Anis','email'=>'anis@queen.com','password'=>Hash::make('password'),'no_telp'=>'082555555555','alamat'=>'Jl. Semut No.7, Surabaya']);

        Item::insert([
            ['nama'=>'Deterjen Cair','satuan'=>'Liter','stok'=>2,'stok_minimum'=>5,'harga_satuan'=>25000,'created_at'=>now(),'updated_at'=>now()],
            ['nama'=>'Plastik Kemas','satuan'=>'pcs','stok'=>45,'stok_minimum'=>100,'harga_satuan'=>500,'created_at'=>now(),'updated_at'=>now()],
            ['nama'=>'Softener','satuan'=>'Liter','stok'=>8.5,'stok_minimum'=>5,'harga_satuan'=>35000,'created_at'=>now(),'updated_at'=>now()],
            ['nama'=>'Pewangi Linen','satuan'=>'Liter','stok'=>12,'stok_minimum'=>5,'harga_satuan'=>40000,'created_at'=>now(),'updated_at'=>now()],
            ['nama'=>'Hanger','satuan'=>'pcs','stok'=>87,'stok_minimum'=>50,'harga_satuan'=>2000,'created_at'=>now(),'updated_at'=>now()],
            ['nama'=>'Label Nama','satuan'=>'lembar','stok'=>320,'stok_minimum'=>100,'harga_satuan'=>100,'created_at'=>now(),'updated_at'=>now()],
        ]);

        $ordersData=[
            ['customer_id'=>$c3->id,'kurir_pickup_id'=>$k1->id,'tanggal_order'=>now()->subDays(3),'jenis_laundry'=>'Pakaian biasa','status'=>'selesai','total_berat'=>6.1,'harga_per_kg'=>30000,'total_harga'=>183000],
            ['customer_id'=>$c4->id,'kurir_pickup_id'=>$k2->id,'kurir_delivery_id'=>$k2->id,'tanggal_order'=>now()->subDays(2),'jenis_laundry'=>'Pakaian kerja','status'=>'delivery','total_berat'=>3.5,'harga_per_kg'=>30000,'total_harga'=>105000],
            ['customer_id'=>$c2->id,'kurir_pickup_id'=>$k1->id,'tanggal_order'=>now()->subDays(1),'jenis_laundry'=>'Pakaian biasa','status'=>'proses','total_berat'=>2.8,'harga_per_kg'=>30000,'total_harga'=>84000],
            ['customer_id'=>$c1->id,'kurir_pickup_id'=>$k1->id,'tanggal_order'=>now(),'jenis_laundry'=>'Pakaian kerja','status'=>'pickup','total_berat'=>4.2,'harga_per_kg'=>30000,'total_harga'=>126000,'jadwal_pickup'=>now()->addHours(2)],
            ['customer_id'=>$c5->id,'tanggal_order'=>now(),'jenis_laundry'=>'Linen/Sprei','status'=>'menunggu_pickup','total_berat'=>0,'harga_per_kg'=>30000,'total_harga'=>0],
            ['customer_id'=>$c1->id,'tanggal_order'=>now()->addHour(),'jenis_laundry'=>'Linen/Sprei','status'=>'menunggu_pickup','total_berat'=>0,'harga_per_kg'=>30000,'total_harga'=>0,'catatan'=>'Jangan pakai pewangi'],
            ['customer_id'=>$c3->id,'kurir_pickup_id'=>$k2->id,'tanggal_order'=>now()->subDays(5),'jenis_laundry'=>'Karpet','status'=>'selesai','total_berat'=>5.0,'harga_per_kg'=>35000,'total_harga'=>175000],
            ['customer_id'=>$c2->id,'kurir_pickup_id'=>$k1->id,'tanggal_order'=>now()->subDays(7),'jenis_laundry'=>'Pakaian biasa','status'=>'selesai','total_berat'=>3.2,'harga_per_kg'=>30000,'total_harga'=>96000],
        ];

        foreach($ordersData as $d){
            $o=Order::create($d);
            OrderStatusLog::create(['order_id'=>$o->id,'status'=>$o->status,'catatan'=>'Order dibuat','actor_type'=>'system']);
        }

        $selesaiOrders=Order::where('status','selesai')->get();
        foreach($selesaiOrders as $i=>$o){
            Invoice::create(['no_invoice'=>'INV-'.str_pad($i+1,4,'0',STR_PAD_LEFT).'-'.date('mY'),'order_id'=>$o->id,'subtotal'=>$o->total_harga,'total'=>$o->total_harga,'status'=>'paid','tanggal_bayar'=>now()->subDays($i)]);
        }

        Expense::insert([
            ['kategori'=>'Bahan Baku','keterangan'=>'Deterjen cair 5L + Softener 3L','jumlah'=>295000,'tanggal'=>now()->subDays(1)->toDateString(),'created_at'=>now(),'updated_at'=>now()],
            ['kategori'=>'Gaji Kurir','keterangan'=>'Tunjangan mingguan Andi & Rudi','jumlah'=>600000,'tanggal'=>now()->subDays(3)->toDateString(),'created_at'=>now(),'updated_at'=>now()],
            ['kategori'=>'Listrik/Air','keterangan'=>'Tagihan PLN bulan ini','jumlah'=>450000,'tanggal'=>now()->subDays(5)->toDateString(),'created_at'=>now(),'updated_at'=>now()],
            ['kategori'=>'Operasional','keterangan'=>'Plastik kemas 200 pcs','jumlah'=>100000,'tanggal'=>now()->subDays(6)->toDateString(),'created_at'=>now(),'updated_at'=>now()],
            ['kategori'=>'Bahan Baku','keterangan'=>'Pewangi linen 5L','jumlah'=>200000,'tanggal'=>now()->subDays(8)->toDateString(),'created_at'=>now(),'updated_at'=>now()],
        ]);
    }
}
