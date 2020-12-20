<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBonusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bonuses', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->unsignedBigInteger('bonus_type');
            $table->float('amount');
            $table->integer('status')->length('1')->comment('0:申請、1:保留、2:確認、3:承認、9:非承認');
            $table->timestamps();

            $table->foreign('bonus_type')->references('id')->on('bonus_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bonuses');
    }
}
