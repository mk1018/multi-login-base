<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVerifyMailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('verify_mails', function (Blueprint $table) {
            $table->string('email')->unique();
            $table->bigInteger('introducer_id');
            $table->string('verify_token');
            $table->timestamp('expired_at');
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
        Schema::dropIfExists('verify_mails');
    }
}
