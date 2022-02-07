<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManifestationTypeContributeurs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('manifestation_type_contributeurs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('manifestation_id');
            $table->unsignedBigInteger('type_contributeur_id');

            $table->foreign('manifestation_id')->references('id')->on('manifestations')->onDelete('cascade');
            $table->index('manifestation_id');
            $table->foreign('type_contributeur_id')->references('id')->on('type_contributeurs');
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
        Schema::dropIfExists('manifestation_type_contributeurs');
    }
}
