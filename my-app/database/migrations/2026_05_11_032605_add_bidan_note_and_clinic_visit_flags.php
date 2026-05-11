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
        Schema::table('kia_checkins', function (Blueprint $table) {
            $table->text('bidan_note')->nullable()->after('answers');
        });

        Schema::table('patients', function (Blueprint $table) {
            $table->boolean('requires_clinic_visit')->default(false)->after('taksiran_persalinan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kia_checkins', function (Blueprint $table) {
            $table->dropColumn('bidan_note');
        });

        Schema::table('patients', function (Blueprint $table) {
            $table->dropColumn('requires_clinic_visit');
        });
    }
};
