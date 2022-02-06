<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFraisCouvertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('frais_couverts', function (Blueprint $table) {
            $table->id();
            $table->string('libelle', 100);
            $table->double('forfait');
            $table->string('unite', 60)->nullable();
            $table->string('limite', 100)->nullable();
            $table->text('description');
            $table->text('remarques')->nullable();
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
        Schema::connection('mysql')->dropIfExists('frais_couverts');
    }
}
