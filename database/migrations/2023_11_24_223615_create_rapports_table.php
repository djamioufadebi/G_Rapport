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
        Schema::create('rapports', function (Blueprint $table) {
            $table->id();
            $table->string('libelle');
            $table->text('contenu');
            // $table->boolean('statut')->default(0);
            $table->string('fichier')->nullable();
            $table->enum('statut', ['en attente', 'Validé', 'rejeté'])->default('en attente');

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
        // cet code permet de supprimer la colonne du champs clé etrangère au cas ou nous voulons la supprimer
        Schema::table('rapports', function (Blueprint $table) {
            $table->dropForeign('id_projet');
            $table->dropColumn('id_projet');
        });
        Schema::dropIfExists('rapports');
    }
};
