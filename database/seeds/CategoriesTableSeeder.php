<?php

use Illuminate\Database\Seeder;
use ORC\Category;

class CategoriesTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Category::create([
                    'name' => 'Wine',                    
        ]);
        
       Category::create([
                    'name' => 'Coffee',                    
        ]);
    }

}
