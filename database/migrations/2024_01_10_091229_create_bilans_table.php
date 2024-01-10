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
        Schema::create('bilans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_activite');
            $table->foreign('id_activite')->
                references('id')->on('activites');
            $table->timestamps();
        });
        schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bilans', function (Blueprint $table) {
            $table->dropForeign('id_activite');
            $table->dropColumn('id_activite');
        });
        Schema::dropIfExists('bilans');

    }
};