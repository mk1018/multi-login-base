<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->add('first_name_1', 'last_name_1', 'name1@example.com', 'password', sha1(uniqid(bin2hex(random_bytes(20)))), date('Y-m-d H:i:s'));
        $this->add('first_name_2', 'last_name_2', 'name2@example.com', 'password', sha1(uniqid(bin2hex(random_bytes(20)))), date('Y-m-d H:i:s'));
        $this->add('first_name_3', 'last_name_3', 'name3@example.com', 'password', sha1(uniqid(bin2hex(random_bytes(20)))), date('Y-m-d H:i:s'));
        $this->add('first_name_4', 'last_name_4', 'name4@example.com', 'password', sha1(uniqid(bin2hex(random_bytes(20)))), date('Y-m-d H:i:s'));
        $this->add('first_name_5', 'last_name_5', 'name5@example.com', 'password', sha1(uniqid(bin2hex(random_bytes(20)))), date('Y-m-d H:i:s'));
    }

    private function add($name_first, $name_last, $email, $password, $qr_token, $qr_issuedated_at){
        (new User([
            'name_first' => $name_first,
            'name_last' => $name_last,
            'email' => $email,
            'password' => bcrypt($password),
            'qr_token' => $qr_token,
            'qr_issuedated_at' => $qr_issuedated_at
        ]))->save();
    }
}
