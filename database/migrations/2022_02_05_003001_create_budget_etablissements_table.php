<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBudgetEtablissementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('budget_etablissements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('etablissement_id')->unique();
            $table->integer('annee')->unique()->nullable(false);
            $table->double('budget_fixe');
            $table->double('budget_restant');
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
        Schema::dropIfExists('budget_etablissements');
    }
}
