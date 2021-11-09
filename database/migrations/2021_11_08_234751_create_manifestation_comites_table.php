<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManifestationComitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('manifestation_comites', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('manifestation_id');
            $table->unsignedBigInteger('comite_organisation_id');

            $table->foreign('manifestation_id')->references('id')->on('manifestations');
            $table->index('manifestation_id');
            $table->foreign('comite_organisation_id')->references('id')->on('comite_organisations');
            $table->index('comite_organisation_id');
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
        Schema::dropIfExists('manifestation_comites');
    }
}
