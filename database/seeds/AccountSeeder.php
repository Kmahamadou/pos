<?php

use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('accounts')->insert([
            'name' => "Cash",
            'type' => "cash",
            'acc_no' => "N/A",
            'bank_name' => "N/A",
            'balance' => "1000",
            'opening_balance' => "1000",
            'bank_address' => "N/A",
        ]);    }
}
