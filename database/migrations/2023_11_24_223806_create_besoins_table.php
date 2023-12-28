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
        Schema::create('besoins', function (Blueprint $table) {
            $table->id();
            $table->string('libelle');
            $table->integer('user_id');
            $table->text('contenu');
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

        Schema::table('besoins', function (Blueprint $table) {
            $table->dropForeign('id_projet');
            $table->dropColumn('id_projet');
        });

        Schema::dropIfExists('besoins');
    }
};