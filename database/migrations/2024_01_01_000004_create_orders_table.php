<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers')->cascadeOnDelete();
            $table->foreignId('kurir_pickup_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('kurir_delivery_id')->nullable()->constrained('users')->nullOnDelete();
            $table->dateTime('tanggal_order');
            $table->string('jenis_laundry')->default('Pakaian biasa');
            $table->enum('status', ['menunggu_pickup','pickup','proses','selesai_cuci','siap_delivery','delivery','selesai'])->default('menunggu_pickup');
            $table->decimal('total_berat', 10, 2)->default(0);
            $table->decimal('total_harga', 12, 2)->default(0);
            $table->decimal('harga_per_kg', 10, 2)->default(25000);
            $table->text('catatan')->nullable();
            $table->string('foto_pickup')->nullable();
            $table->string('foto_delivery')->nullable();
            $table->dateTime('jadwal_pickup')->nullable();
            $table->dateTime('jadwal_delivery')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('orders'); }
};
