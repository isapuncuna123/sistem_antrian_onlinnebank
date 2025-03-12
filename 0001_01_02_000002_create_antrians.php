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
        Schema::create('antrians', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable(); // Bisa tanpa login
            $table->string('nomor_antrian'); // Misal: A001, B002
            $table->enum('jenis_layanan', ['umum', 'prioritas', 'pengaduan']);
            $table->enum('status', ['menunggu', 'dipanggil', 'selesai'])->default('menunggu');
            $table->timestamp('waktu_pendaftaran')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('waktu_dipanggil')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });

        
    }

   
    public function down(): void
    {
        Schema::dropIfExists('antrians');
       
    }
};
