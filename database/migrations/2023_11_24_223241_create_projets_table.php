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
        Schema::create('projets', function (Blueprint $table) {
            $table->id();
            $table->string('libelle');
            $table->string('lieu');
            $table->text('description')->nullable();
            $table->date('date_debut');
            $table->date('date_fin_prevue');
            $table->string('fichier')->nullable();
            $table->enum('statut', ['en attente', 'en cours', 'terminé', 'arrêté'])->default('en attente');
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->
                references('id')->on('users');
            $table->unsignedBigInteger('id_gestionnaire');
            $table->foreign('id_gestionnaire')->
                references('id')->on('users');

            $table->unsignedBigInteger('id_client');
            $table->foreign('id_client')->
                references('id')->on('clients');

            $table->timestamps();

        });

        Schema::enableForeignKeyConstraints();

        // Définir id_user comme valeur par défaut pour id_gestionnaire
        DB::statement('UPDATE projets SET id_gestionnaire = id_user');

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projets', function (Blueprint $table) {
            $table->dropForeign(['id_client', 'id_user']);
            $table->dropForeign(['id_client', 'id_user']);
        });

        Schema::dropIfExists('projets');

    }
};
