<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name_first');
            $table->string('name_last');
            $table->string('name_first_other')->nullable();
            $table->string('name_last_other')->nullable();
            $table->string('country_code')->nullable();
            $table->string('zip')->nullable();
            $table->string('prefectures')->nullable();
            $table->string('address_1')->nullable();
            $table->string('address_2')->nullable();
            $table->string('address_3')->nullable();
            $table->Integer('mobile_number_country_code')->nullable();
            $table->Integer('mobile_number')->nullable();
            $table->Integer('landline_number')->nullable();
            $table->date('birthday')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('qr_token');
            $table->timestamp('qr_issuedated_at')->comment('qr_tokenの発行日');
            $table->timestamp('expired_at')->nullable()->comment('20/12/17 今のところ使用する予定なし');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
