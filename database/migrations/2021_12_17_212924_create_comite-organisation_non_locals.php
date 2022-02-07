<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComiteOrganisationNonLocals extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::connection('mysql')->disableForeignKeyConstraints();
        Schema::connection('mysql')->create('comite_organisation_non_locals', function (Blueprint $table) {
            $table->id();
            $table->string('nom',50);
            $table->string('prenom',50);
            $table->string('email',150);
            $table->string('tel',15);
            $table->string('universite',50);
            $table->string('etablissement',50);
            $table->string('ville',15);
            $table->unsignedBigInteger('manifestation_id');
            $table->foreign('manifestation_id')->references('id')->on('manifestations')->onDelete('cascade') ;
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
        Schema::connection('mysql')->dropIfExists('comite_organisation_non_locals');

    }
}
