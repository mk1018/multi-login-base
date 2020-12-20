<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNetworksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('networks', function (Blueprint $table) {
            $table->bigInteger('user_id')->unique();
            $table->bigInteger('introducer_id');
            $table->bigInteger('position_id')->nullable();
            $table->integer('introducer_stage')->comment('一番上からの段数');
            $table->integer('position_stage')->nullable()->comment('一番上からの段数');
            $table->string('introducer_structure')->nullable();
            $table->string('position_structure')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('networks');
    }
}
