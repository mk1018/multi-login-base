<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('DROP VIEW IF EXISTS wallets');

        $sql = 'CREATE VIEW wallets AS
            SELECT
                users.id,
		        case when sum(asset_histories.amount) is nULL then 0 else sum(asset_histories.amount) end as tradable
            from
                users
            left join
                asset_histories
            on
                users.id = asset_histories.user_id
            group by
                users.id';

        DB::statement($sql);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW IF EXISTS wallets');
    }
}