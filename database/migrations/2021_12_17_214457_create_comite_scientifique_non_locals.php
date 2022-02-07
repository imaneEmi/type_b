<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComiteScientifiqueNonLocals extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('comite_scientifique_non_locals', function (Blueprint $table) {
            $table->id();
            $table->string('nom',500);
            $table->string('prenom',500);
            $table->string('email',500)->nullable();
            $table->string('tel',500)->nullable();
            $table->string('type_entite',500)->nullable();
            $table->string('nom_entite',500)->nullable();
            $table->string('pays',500)->nullable();
            $table->unsignedBigInteger('manifestation_id');
            $table->foreign('manifestation_id')->references('id')->on('manifestations')
            ->onDelete('cascade');
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
        Schema::connection('mysql')->dropIfExists('comite_scientifique_non_locals');
    }
}
