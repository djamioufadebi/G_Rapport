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

        Schema::create('intervenants', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->string('contact');
            $table->string('email');
            $table->string('adresse');
            $table->unsignedBigInteger('id_activite');
            $table->foreign('id_activite')->
                references('id')->on('activites');
            $table->timestamps();
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('intervenants', function (Blueprint $table) {
            $table->dropForeign('id_activite');
            $table->dropForeign('id_activite');
        });
        Schema::dropIfExists('intervenants');
    }
};
