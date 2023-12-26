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
        Schema::create('notification_rapport', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('titre');
            $table->text('message');
            $table->boolean('read')->default(false);
            $table->unsignedBigInteger('id_rapport');
            $table->foreign('id_rapport')->references('id')->on('rapports');
            $table->timestamps();
        });
        schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('notification_rapport', function (Blueprint $table) {
            $table->dropForeign(['id_rapport', 'user_id']);
            $table->dropForeign(['id_rapport', 'user_id']);

        });
        Schema::dropIfExists('notification_rapport');
    }
};
