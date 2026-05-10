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
        Schema::create('health_updates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('patients')->onDelete('cascade');
            $table->foreignId('bidan_id')->nullable()->constrained('users')->onDelete('set null');
            $table->date('tanggal_update');
            $table->enum('tipe_update', ['harian', 'mingguan'])->default('harian');
            
            // Keluhan & Kondisi
            $table->text('keluhan')->nullable();
            $table->enum('kondisi_umum', ['baik', 'cukup', 'kurang'])->default('baik');
            
            // Tanda Vital Sederhana
            $table->decimal('suhu_tubuh', 4, 1)->nullable(); // Celsius
            $table->integer('tekanan_darah_sistolik')->nullable();
            $table->integer('tekanan_darah_diastolik')->nullable();
            
            // Gejala Umum
            $table->boolean('mual_muntah')->default(false);
            $table->boolean('pusing')->default(false);
            $table->boolean('nyeri_perut')->default(false);
            $table->boolean('pendarahan')->default(false);
            $table->boolean('kontraksi')->default(false);
            $table->boolean('gerakan_janin_berkurang')->default(false);
            
            // Aktivitas & Pola
            $table->enum('kualitas_tidur', ['baik', 'cukup', 'buruk'])->nullable();
            $table->enum('nafsu_makan', ['baik', 'cukup', 'buruk'])->nullable();
            $table->enum('aktivitas_fisik', ['ringan', 'sedang', 'berat'])->nullable();
            
            // Catatan
            $table->text('catatan_pasien')->nullable();
            $table->text('catatan_bidan')->nullable();
            $table->boolean('perlu_tindak_lanjut')->default(false);
            
            // Metadata
            $table->enum('sumber_input', ['pasien', 'bidan'])->default('pasien');
            $table->timestamps();
            
            // Index
            $table->index(['patient_id', 'tanggal_update']);
            $table->index('tipe_update');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('health_updates');
    }
};
