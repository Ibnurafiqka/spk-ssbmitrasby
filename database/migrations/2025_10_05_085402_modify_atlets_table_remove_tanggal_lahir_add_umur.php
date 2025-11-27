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
        Schema::table('atlets', function (Blueprint $table) {
            // Hapus kolom tanggal_lahir
            $table->dropColumn('tanggal_lahir');
            
            // Tambah kolom umur (jika belum ada)
            if (!Schema::hasColumn('atlets', 'umur')) {
                $table->integer('umur')->after('jenis_kelamin');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('atlets', function (Blueprint $table) {
            // Kembalikan kolom tanggal_lahir
            $table->date('tanggal_lahir')->after('jenis_kelamin');
            
            // Hapus kolom umur
            $table->dropColumn('umur');
        });
    }
};