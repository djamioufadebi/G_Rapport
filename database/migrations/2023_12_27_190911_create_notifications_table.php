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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->integer('rapport_id')->nullable();
            $table->integer('besoin_id')->nullable();
            $table->integer('projet_id')->nullable();
            $table->integer('activite_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('titre');
            $table->text('message');
            $table->string('type');
            $table->boolean('read')->default(false);
            $table->timestamps();
        });
        schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('notifications', function (Blueprint $table) {
            $table->dropForeign(['user_id', 'rappord_id', 'besoin_id']);
            $table->dropForeign(['user_id', 'rappord_id', 'besoin_id']);
        });
        Schema::dropIfExists('notifications');
    }
};
