<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('purchase_orders', function (Blueprint $table) {
        $table->id();
        $table->string('nama_pembelian');
        $table->integer('jumlah_pembelian');
        $table->date('tanggal');
        $table->foreignId('material_id')->constrained()->onDelete('cascade');
        $table->foreignId('supplier_id')->constrained()->onDelete('cascade');
        $table->text('deskripsi');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_orders');
    }
};
