<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users_profils', function (Blueprint $table) {
            $table->id();

            $table->integer('user_id');
            $table->integer('profil_id');

            $table->timestamps();
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users_profils', function (Blueprint $table) {
            $table->dropForeign(['user_id', 'profil_id']);
            $table->dropForeign(['user_id', 'profil_id']);
        });
        Schema::dropIfExists('users_profils');
    }
};
