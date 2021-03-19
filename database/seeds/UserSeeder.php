<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => "Mahamadou",
            'email' => "test@test.com",
            'password' => Hash::make('password'),
        ]);
        

        DB::table('users')->insert([
            'name' => "Ousmane",
            'email' => "ousmane@camara.shop",
            'password' => Hash::make('password'),
        ]);
    }
}
