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
        $tissueCategory = Category::where('name', 'Tissue')->pluck('id')->first();
        $musicCategory = Category::where('name', 'Music')->pluck('id')->first();

        Survey::create([
            'name' => 'Red wine',
            'description' => 'wine good',
            'image' => null,
            'category_id' => $wineCategory,
            'fillable' => rand(0, 1)
        ]);

        Survey::create([
            'name' => 'White wine',
            'description' => 'wine good',
            'image' => null,
            'category_id' => $wineCategory,
            'fillable' => rand(0, 1)
        ]);

        Survey::create([
            'name' => 'Spumante',
            'description' => 'wine with bubbles',
            'image' => null,
            'category_id' => $wineCategory,
            'fillable' => rand(0, 1)
        ]);

        Survey::create([
            'name' => 'Castelcovati wine',
            'description' => 'null',
            'image' => null,
            'category_id' => $wineCategory,
            'fillable' => rand(0, 1)
        ]);

        Survey::create([
            'name' => 'American coffee',
            'description' => null,
            'image' => null,
            'category_id' => $coffeeCategory,
            'fillable' => rand(0, 1)
        ]);

        Survey::create([
            'name' => 'Chanel n. 5',
            'description' => null,
            'image' => null,
            'category_id' => $perfumeCategory,
            'fillable' => rand(0, 1)
        ]);

        Survey::create([
            'name' => 'One Million',
            'description' => null,
            'image' => null,
            'category_id' => $perfumeCategory,
            'fillable' => rand(0, 1)
        ]);

        Survey::create([
            'name' => 'Eau de toilette',
            'description' => null,
            'image' => null,
            'category_id' => $perfumeCategory,
            'fillable' => rand(0, 1)
        ]);

        Survey::create([
            'name' => 'Silk',
            'description' => null,
            'image' => null,
            'category_id' => $tissueCategory,
            'fillable' => rand(0, 1)
        ]);


        Survey::create([
            'name' => 'Glass',
            'description' => null,
            'image' => null,
            'category_id' => $tissueCategory,
            'fillable' => rand(0, 1)
        ]);
    }

}
