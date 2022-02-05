<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBudgetStructuresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('budget_structures', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('labo_id')->unique();
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
        Schema::dropIfExists('budget_structures');
    }
}
