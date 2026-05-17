<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('health_centers', function (Blueprint $table) {
            $table->id();
            $table->string('nama_faskes');        
            $table->string('jenis_bencana')->nullable(); 
            $table->string('wilayah');           
            $table->enum('status', ['AKTIF', 'SIAGA', 'KRITIS', 'NON-AKTIF'])->default('AKTIF'); 
            $table->text('deskripsi_bencana')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('health_centers');
    }
};