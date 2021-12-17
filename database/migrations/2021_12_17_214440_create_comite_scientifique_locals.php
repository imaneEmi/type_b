<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComiteScientifiqueLocals extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('comite_scientifique_locals', function (Blueprint $table) {
            $table->id();
            $table->string('nom',500);
            $table->string('prenom',500);
            $table->string('email',500);
            $table->string('tel',500);
            $table->string('type_entite',500);
            $table->string('nom_entite',500);

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
        Schema::connection('mysql')->dropIfExists('comite_scientifique_locals');
    }
}
