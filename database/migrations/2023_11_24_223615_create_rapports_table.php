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
            $table->enum('statut', ['en attente', 'Validé', 'rejeté'])->default('en attente');
            $table->text('materiels_utilises')->nullable();
            $table->text('difficultes_rencontrees')->nullable();
            $table->text('solutions_apportees')->nullable();

            $table->unsignedBigInteger('id_activite');
            $table->foreign('id_activite')->
                references('id')->on('activites')->onDelete('cascade');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->text('commentaires')->nullable();
            $table->timestamps();
        });
        schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rapports', function (Blueprint $table) {
            $table->dropForeign(['id_activite', 'user_id']);
            $table->dropColumn(['id_activite', 'user_id']);
        });
        Schema::dropIfExists('rapports');
    }
};
