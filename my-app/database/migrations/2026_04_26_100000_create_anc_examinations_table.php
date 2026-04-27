<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('anc_examinations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained()->onDelete('cascade');
            $table->foreignId('bidan_id')->constrained('users')->onDelete('cascade');
            $table->date('tanggal_periksa');
            $table->integer('usia_kehamilan_minggu');
            $table->integer('tekanan_darah_sistolik');
            $table->integer('tekanan_darah_diastolik');
            $table->decimal('berat_badan', 5, 2);
            $table->decimal('tinggi_fundus', 5, 2)->nullable();
            $table->decimal('lingkar_lengan_atas', 5, 2)->nullable();
            $table->integer('denyut_jantung_janin')->nullable();
            $table->text('keluhan')->nullable();
            $table->text('catatan_bidan')->nullable();
            $table->date('jadwal_kunjungan_berikutnya')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('anc_examinations');
    }
};
