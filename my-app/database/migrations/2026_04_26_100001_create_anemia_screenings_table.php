<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('anemia_screenings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained()->onDelete('cascade');
            $table->foreignId('bidan_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('anc_examination_id')->nullable()->constrained()->onDelete('set null');
            $table->date('tanggal_screening');
            $table->decimal('kadar_hb', 4, 1);
            $table->enum('status_anemia', ['normal', 'ringan', 'sedang', 'berat']);
            $table->text('tindakan')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('anemia_screenings');
    }
};
