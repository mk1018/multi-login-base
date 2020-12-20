<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->add('payment', 'Payment');
        $this->add('deposit', 'Deposit');
        $this->add('withdraw', 'Withdraw');
        $this->add('bonus', 'Bonus');
    }

    private function add($code, $name){
        (new Category([
            'code' => $code,
            'name' => $name
        ]))->save();
    }
}
