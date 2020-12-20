<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BonusType;

class BonusTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->add('Bonus / month', 1);
        $this->add('Bonus / manual', 1);
    }

    private function add($name, $enabled){
        (new BonusType([
            'name' => $name,
            'enabled' => $enabled
        ]))->save();
    }
}
