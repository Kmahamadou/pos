<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('print_invoices')->insert([
            'name' => "Mahamadou",
            'email' => "test@test.com",
            'password' => Hash::make('password'),
        ]);
    }
}
