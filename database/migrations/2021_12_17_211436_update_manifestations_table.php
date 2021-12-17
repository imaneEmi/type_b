<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateManifestationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->table('manifestations', function ($table) {

            $table->integer('nbr_etudiants_locaux');
            $table->integer('nbr_etudiants_non_locaux');
            $table->unsignedBigInteger('file_manifestation_etudiants_locaux_id');
            $table->foreign('file_manifestation_etudiants_locaux_id')->references('id')->on('file_manifestations');
            $table->unsignedBigInteger('file_manifestation_enseignants_locaux_id');
            $table->foreign('file_manifestation_enseignants_locaux_id')->references('id')->on('file_manifestations');
            $table->integer('nbr_enseignants_locaux');
            $table->integer('nbr_enseignants_non_locaux');
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