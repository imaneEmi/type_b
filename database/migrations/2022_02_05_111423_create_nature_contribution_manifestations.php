<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNatureContributionManifestations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('nature_contribution_manifestations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('manifestation_id');
            $table->unsignedBigInteger('nature_con_id');

            $table->foreign('manifestation_id')->references('id')->on('manifestations')->onDelete('cascade');
            $table->index('manifestation_id');
            $table->foreign('nature_con_id')->references('id')->on('nature_contributions');
            $table->index('nature_con_id');
            $table->unique(['manifestation_id','nature_con_id'],'manifestation_id_nature_id');
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
        //
    }
}
