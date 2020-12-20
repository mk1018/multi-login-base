<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Network;

class NetworkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->add('1', '0', '0', 1, 1, '1', '1');
        $this->add('2', '1', '1', 2, 2, '1/2', '1/2');
        $this->add('3', '2', '2', 3, 3, '1/2/3', '1/2/3');
        $this->add('4', '1', '2', 2, 3, '1/4', '1/2/4');
        $this->add('5', '3', '3', 4, 4, '1/2/3/5', '1/2/3/5');

    }

    private function add($user_id, $introducer_id, $position_id, $introducer_stage, $position_stage, $introducer_structure, $position_structure){
        (new Network([
            'user_id' => $user_id,
            'introducer_id' => $introducer_id,
            'position_id' => $position_id,
            'introducer_stage' => $introducer_stage,
            'position_stage' => $position_stage,
            'introducer_structure' => $introducer_structure,
            'position_structure' => $position_structure,
        ]))->save();
    }
}
