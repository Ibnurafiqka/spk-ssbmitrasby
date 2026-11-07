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

        // 2. Modify users table role enum (PostgreSQL Compatible)
        // Menghapus nilai default lama terlebih dahulu agar tidak konflik saat mengubah tipe data
        DB::statement("ALTER TABLE users ALTER COLUMN role DROP DEFAULT");
        
        // Membuat tipe enum baru di PostgreSQL (jika belum ada)
        DB::statement("CREATE TYPE user_role_new AS ENUM('admin', 'pelatih', 'orang_tua')");
        
        // Mengubah tipe kolom menggunakan tipe enum baru dengan casting (USING)
        DB::statement("ALTER TABLE users ALTER COLUMN role TYPE user_role_new USING role::text::user_role_new");
        
        // Memasang kembali nilai default-nya
        DB::statement("ALTER TABLE users ALTER COLUMN role SET DEFAULT 'pelatih'");

        // 3. Modify atlets table
        Schema::table('atlets', function (Blueprint $table) {
            $table->dropColumn(['alamat', 'no_telepon']);
            // Menggunakan string biasa di Laravel dengan validasi, karena mengubah/menambah ENUM di Postgres via Schema Builder sering bermasalah
            $table->string('posisi')->nullable(); // Alternatif aman untuk PostgreSQL
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

        // 2. Down Users (Kembalikan ke ENUM lama)
        DB::statement("ALTER TABLE users ALTER COLUMN role DROP DEFAULT");
        DB::statement("CREATE TYPE user_role_old AS ENUM('admin', 'pelatih')");
        DB::statement("ALTER TABLE users ALTER COLUMN role TYPE user_role_old USING role::text::user_role_old");
        DB::statement("ALTER TABLE users ALTER COLUMN role SET DEFAULT 'pelatih'");
        
        // Hapus tipe data kustom yang dibuat di fungsi up()
        DB::statement("DROP TYPE IF EXISTS user_role_new");

        // 1. Down OrangTuas
        Schema::dropIfExists('orang_tuas');
        
        // Hapus tipe data kustom yang dibuat di fungsi down()
        DB::statement("DROP TYPE IF EXISTS user_role_old");
    }
};
