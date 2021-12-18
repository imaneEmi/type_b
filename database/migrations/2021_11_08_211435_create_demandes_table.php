<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDemandesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Schema::disableForeignKeyConstraints();
        Schema::connection('mysql')->create('demandes', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->timestamp('date_envoie');
            $table->string('etat', 20);
            $table->string('remarques', 500)->nullable();
            $table->unsignedBigInteger('coordonnateur_id');
            $table->boolean('editable');
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
        Schema::connection('mysql')->dropIfExists('demandes');
    }
}
