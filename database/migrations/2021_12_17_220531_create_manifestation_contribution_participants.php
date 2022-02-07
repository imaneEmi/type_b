<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManifestationContributionParticipants extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('manifestation_contribution_participants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('manifestation_id');
            $table->unsignedBigInteger('cont_par_id');

            $table->foreign('manifestation_id')->references('id')->on('manifestations')
            ->onDelete('cascade');
            $table->index('manifestation_id');
            $table->foreign('cont_par_id')->references('id')->on('contribution_participants');
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
        Schema::dropIfExists('manifestation_contribution_participants');
    }
}
