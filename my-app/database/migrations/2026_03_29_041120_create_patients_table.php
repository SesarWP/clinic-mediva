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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->string('nik')->unique();
            $table->string('nama_lengkap');
            $table->text('alamat')->nullable();
            $table->string('no_hp')->nullable();
            $table->date('tanggal_lahir');
            $table->string('golongan_darah')->nullable();
            $table->integer('gravida')->nullable();
            $table->integer('para')->nullable();
            $table->integer('abortus')->nullable();
            $table->date('hpht')->nullable();
            $table->date('taksiran_persalinan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
