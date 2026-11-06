<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Create orang_tuas table
        Schema::create('orang_tuas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('no_telepon', 20)->nullable();
            $table->text('alamat')->nullable();
            $table->timestamps();
        });

        // 2. Modify users table role enum
        // MySQL specific alter table for enum
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin', 'pelatih', 'orang_tua') DEFAULT 'pelatih'");

        // 3. Modify atlets table
        Schema::table('atlets', function (Blueprint $table) {
            $table->dropColumn(['alamat', 'no_telepon']);
            $table->enum('posisi', ['penyerang', 'tengah', 'bertahan'])->nullable();
            $table->foreignId('orang_tua_id')->nullable()->constrained('orang_tuas')->onDelete('set null');
        });

        // 4. Modify kriterias table
        Schema::table('kriterias', function (Blueprint $table) {
            $table->dropColumn('bobot');
            $table->decimal('bobot_penyerang', 5, 2)->default(0);
            $table->decimal('bobot_tengah', 5, 2)->default(0);
            $table->decimal('bobot_bertahan', 5, 2)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // 4. Down Kriterias
        Schema::table('kriterias', function (Blueprint $table) {
            $table->dropColumn(['bobot_penyerang', 'bobot_tengah', 'bobot_bertahan']);
            $table->decimal('bobot', 5, 2)->default(0);
        });

        // 3. Down Atlets
        Schema::table('atlets', function (Blueprint $table) {
            $table->dropForeign(['orang_tua_id']);
            $table->dropColumn(['posisi', 'orang_tua_id']);
            $table->text('alamat')->nullable();
            $table->string('no_telepon', 20)->nullable();
        });

        // 2. Down Users
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin', 'pelatih') DEFAULT 'pelatih'");

        // 1. Down OrangTuas
        Schema::dropIfExists('orang_tuas');
    }
};
