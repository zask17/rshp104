<?php

// database/migrations/*_create_role_users_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('role_user', function (Blueprint $table) {
            $table->id();

            // Kunci asing ke tabel 'user'
            $table->foreignId('iduser')->constrained('user', 'iduser')->onDelete('cascade');
            
            // Kunci asing ke tabel 'role'
            $table->foreignId('idrole')->constrained('role')->onDelete('cascade'); 
            
            // Kolom status (1=Aktif, 0=Tidak Aktif)
            $table->tinyInteger('status')->default(1);

            $table->timestamps();
            
            // Membuat kombinasi iduser dan idrole harus unik
            $table->unique(['iduser', 'idrole']); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('role_user');
    }
};