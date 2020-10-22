<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
        	'name' => "Electronique",
        	'slug' => "electronique",
        ]);

        DB::table('categories')->insert([
            'name' => "Portable Computer",
            'slug' => "PC",
        ]);   

        DB::table('categories')->insert([
            'name' => "Mason Toolkits",
            'slug' => "M Toolkits",
        ]);   

        DB::table('categories')->insert([
            'name' => "House Accessories",
            'slug' => "House",
        ]);   

        DB::table('categories')->insert([
            'name' => "Plumbing",
            'slug' => "plumbing",
        ]);
    }
}
