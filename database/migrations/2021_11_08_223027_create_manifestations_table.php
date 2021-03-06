<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManifestationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->disableForeignKeyConstraints();
        Schema::connection('mysql')->create('manifestations', function (Blueprint $table) {
            $table->id();
            $table->string('intitule', 100);
            $table->string('type', 100);
            $table->string('etendue', 100);
            $table->string('lieu', 100);
            $table->string('site_web', 100)->nullable();
            $table->string('agence_organisatrice', 100)->nullable();
            $table->text('partenaires');
            $table->integer('nbr_participants_prevus');
            $table->dateTime('date_debut');
            $table->dateTime('date_fin');
            $table->unsignedBigInteger('demande_id')->unique();
            $table->unsignedBigInteger('entite_organisatrice_id');

            $table->foreign('demande_id')->references('id')->on('demandes') ->onDelete('cascade');
            $table->index('demande_id');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql')->dropIfExists('manifestations');
    }
}
