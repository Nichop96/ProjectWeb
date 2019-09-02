<?php

use Illuminate\Database\Seeder;
use ORC\Survey;
use ORC\Category;

class SurveysTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
         $wineCategory = Category::where('name', 'Wine')->pluck('id')->first();
        $coffeeCategory = Category::where('name', 'Coffee')->pluck('id')->first();
        $perfumeCategory = Category::where('name', 'Perfume')->pluck('id')->first();
        $musicCategory = Category::where('name', 'Music')->pluck('id')->first();
        $cheeseCategory = Category::where('name', 'Cheese')->pluck('id')->first();
        $tissueCategory = Category::where('name', 'Tissue')->pluck('id')->first();

        Survey::create([
            'name' => 'Grana Padano Riserva 24 m',
            'description' => 'Grana Padano Riserva 24 mesi, session: 22-03-2019',
            
            'category_id' => $cheeseCategory,
            'fillable' => 0,
            'image' => 'grana.jpg'
        ]);

        Survey::create([
            'name' => 'Bassanese: Griffone 0.75',
            'description' => 'Bassanese: Griffone 0.75, session: 2-06-2019',
            
            'category_id' => $wineCategory,
            'fillable' => 0,
            'image' => 'vino.jpg'
        ]);

        Survey::create([
            'name' => 'Chanel n.5',
            'description' => 'Chanel n.5',
            
            'category_id' => $perfumeCategory,
            'fillable' => 1,
            'image' => 'chanel.jpg'
        ]);

        Survey::create([
            'name' => 'Moet & Chandon: Imperial Brut 0.75',
            'description' => 'Moet & Chandon: Imperial Brut 0.75, session: 13-01-2019',
            
            'category_id' => $wineCategory,
            'fillable' => 0,
            'image' => 'moet.jpg'
        ]);

        Survey::create([
            'name' => 'Medici Ermete: Assolo 0.75',
            'description' => 'Medici Ermete: Assolo 0.75',
            
            'category_id' => $wineCategory,
            'fillable' => 1,
            'image' => 'assolo.jpg'
        ]);

        Survey::create([
            'name' => 'Love?',
            'description' => 'The Simpson: The Yellow Album',
            
            'category_id' => $musicCategory,
            'fillable' => 0,
            'image' => 'simpson.jpg'
        ]);

        Survey::create([
            'name' => 'Sisters are doing it for themselves',
            'description' => 'The Simpson: The Yellow Album',
            
            'category_id' => $musicCategory,
            'fillable' => 0,
            'image' => 'simpson.jpg'
        ]);
        
        Survey::create([
            'name' => 'Every summer with you',
            'description' => 'The Simpson: The Yellow Album',
            
            'category_id' => $musicCategory,
            'fillable' => 1,
            'image' => 'simpson.jpg'
        ]);

        Survey::create([
            'name' => 'Persian Carpet Tabriz',
            'description' => 'Persian Carpet Tabriz',
            
            'category_id' => $tissueCategory,
            'fillable' => 1,
            'image' => 'default.jpg'
        ]);
    }

}
