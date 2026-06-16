<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('order_status_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->string('status');
            $table->string('catatan')->nullable();
            $table->unsignedBigInteger('actor_id')->nullable();
            $table->string('actor_type')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('order_status_logs'); }
};
