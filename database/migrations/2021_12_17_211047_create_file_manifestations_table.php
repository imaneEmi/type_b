<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFileManifestationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('file_manifestations', function (Blueprint $table) {
            $table->id();
            $table->string('titre', 200);
            $table->string('url', 200);
            $table->unsignedBigInteger('manifestation_id');
            $table->foreign('manifestation_id')->references('id')->on('manifestations')->onDelete('cascade');
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
        Schema::connection('mysql')->dropIfExists('file_manifestations');
    }
}
