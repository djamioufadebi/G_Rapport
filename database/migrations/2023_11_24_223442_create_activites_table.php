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
        Schema::create('activites', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->text('description');
            $table->date('date_debut');
            $table->date('date_fin');
            $table->string('fichier')->nullable();
            $table->enum('statut', ['en attente', 'en cours', 'terminé', 'arrêté'])->default('en attente');
            // Ajout de taux de réalisation : pour un nombre décimal avec 5 chiffres au total et 2 décimales
            $table->decimal('taux_de_realisation', 5, 2)->default(0.00);
            $table->unsignedBigInteger('id_projet');
            $table->foreign('id_projet')->
                references('id')->on('projets');
            $table->timestamps();
        });

        schema::enableForeignKeyConstraints();

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('activites', function (Blueprint $table) {
            $table->dropForeign('id_projet');
            $table->dropForeign('id_projet');
        });
        Schema::dropIfExists('activites');
    }
};
