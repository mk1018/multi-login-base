<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PaymentType;

class PaymentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->add('銀行振込', 1);
        $this->add('クレジットカード', 1);
        $this->add('LINEPay', 1);
        $this->add('PayPay', 1);
        $this->add('BTC', 1);
    }

    private function add($payment_name, $enabled){
        (new PaymentType([
            'name' => $payment_name,
            'enabled' => $enabled
        ]))->save();
    }
}
