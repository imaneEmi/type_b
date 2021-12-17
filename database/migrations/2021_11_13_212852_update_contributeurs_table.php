<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateContributeursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->table('contributeurs', function($table) {
            $table->dropColumn('type');
            $table->dropColumn('nature');
        
            $table->unsignedBigInteger('nature_contribution_id');
            $table->foreign('nature_contribution_id')->references('id')->on('nature_contributions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql')->dropIfExists('contributeurs');
    }
}
