<?php

use Illuminate\Database\Seeder;
use ORC\Question;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $maxrate = 5;
        
        Question::create([
            'name' => 'Clarity',
            'label_left' => 'Low clear',  
            'label_right' => 'Very clear',
            'max_rate' => $maxrate, 
            'correct_answer' => rand(1,$maxrate),
        ]);
        
        Question::create([
            'name' => 'Effervenscence',
            'label_left' => 'Low',  
            'label_right' => 'High',
            'max_rate' => $maxrate,
            'correct_answer' => rand(1,$maxrate),
        ]);
        
        Question::create([
            'name' => 'Fluidity',
            'label_left' => 'Low',  
            'label_right' => 'High',
            'max_rate' => $maxrate, 
            'correct_answer' => rand(1,$maxrate),
        ]);
        
        Question::create([
            'name' => 'Balsamic',
            'label_left' => 'Low',  
            'label_right' => 'High',
            'max_rate' => $maxrate, 
            'correct_answer' => rand(1,$maxrate),
        ]);
        
        Question::create([
            'name' => 'Fruity',
            'label_left' => 'Low',  
            'label_right' => 'High',
            'max_rate' => $maxrate, 
            'correct_answer' => rand(1,$maxrate),
        ]);
        
        Question::create([
            'name' => 'Floral',
            'label_left' => 'Low',  
            'label_right' => 'High',
            'max_rate' => $maxrate, 
            'correct_answer' => rand(1,$maxrate),
        ]);
        
        Question::create([
            'name' => 'Woody',
            'label_left' => 'Low',  
            'label_right' => 'High',
            'max_rate' => $maxrate, 
            'correct_answer' => rand(1,$maxrate),
        ]);
        
        Question::create([
            'name' => 'Spiced',
            'label_left' => 'Low',  
            'label_right' => 'High',
            'max_rate' => $maxrate, 
            'correct_answer' => rand(1,$maxrate),
        ]);
        
        Question::create([
            'name' => 'Sugar content',
            'label_left' => 'Low',  
            'label_right' => 'High',
            'max_rate' => $maxrate, 
            'correct_answer' => rand(1,$maxrate),
        ]);
        
        Question::create([
            'name' => 'Alcohol content',
            'label_left' => 'Low',  
            'label_right' => 'High',
            'max_rate' => $maxrate, 
            'correct_answer' => rand(1,$maxrate),
        ]);
        
        Question::create([
            'name' => 'Texture',
            'label_left' => 'Low',  
            'label_right' => 'High',
            'max_rate' => $maxrate, 
            'correct_answer' => rand(1,$maxrate),
        ]);
        
        Question::create([
            'name' => 'Acidity',
            'label_left' => 'Low',  
            'label_right' => 'High',
            'max_rate' => $maxrate, 
            'correct_answer' => rand(1,$maxrate),
        ]);
        
        
        Question::create([
            'name' => 'Structure',
            'label_left' => 'Low',  
            'label_right' => 'High',
            'max_rate' => $maxrate, 
            'correct_answer' => rand(1,$maxrate),
        ]);
        
        
        Question::create([
            'name' => 'Persistance',
            'label_left' => 'Low',  
            'label_right' => 'High',
            'max_rate' => $maxrate, 
            'correct_answer' => rand(1,$maxrate),
        ]);
        
        Question::create([
            'name' => 'Development',
            'label_left' => 'Low',  
            'label_right' => 'High',
            'max_rate' => $maxrate, 
            'correct_answer' => rand(1,$maxrate),
        ]);
        
        Question::create([
            'name' => 'Yellowness',
            'label_left' => 'Low',  
            'label_right' => 'High',
            'max_rate' => $maxrate, 
            'correct_answer' => rand(1,$maxrate),
        ]);  
        
        Question::create([
            'name' => 'Frankness',
            'label_left' => 'Low',  
            'label_right' => 'High',
            'max_rate' => $maxrate, 
            'correct_answer' => rand(1,$maxrate),
        ]);  
        
        Question::create([
            'name' => 'Harmony',
            'label_left' => 'Low',  
            'label_right' => 'High',
            'max_rate' => $maxrate, 
            'correct_answer' => rand(1,$maxrate),
        ]);  
        
        Question::create([
            'name' => 'Intensity',
            'label_left' => 'Low',  
            'label_right' => 'High',
            'max_rate' => $maxrate, 
            'correct_answer' => rand(1,$maxrate),
        ]);  
        
        Question::create([
            'name' => 'Quality',
            'label_left' => 'Low',  
            'label_right' => 'High',
            'max_rate' => $maxrate, 
            'correct_answer' => rand(1,$maxrate),
        ]); 
        
        Question::create([
            'name' => 'Intensity of color',
            'label_left' => 'Low',  
            'label_right' => 'High',
            'max_rate' => $maxrate, 
            'correct_answer' => rand(1,$maxrate),
        ]);  
        
        Question::create([
            'name' => 'Creemy odour',
            'label_left' => 'Low',  
            'label_right' => 'High',
            'max_rate' => $maxrate, 
            'correct_answer' => rand(1,$maxrate),
        ]);  
        
        Question::create([
            'name' => 'Buttery',
            'label_left' => 'Low',  
            'label_right' => 'High',
            'max_rate' => $maxrate, 
            'correct_answer' => rand(1,$maxrate),
        ]);  
        
        Question::create([
            'name' => 'Salty',
            'label_left' => 'Low',  
            'label_right' => 'High',
            'max_rate' => $maxrate, 
            'correct_answer' => rand(1,$maxrate),
        ]);  
        
        Question::create([
            'name' => 'Acid',
            'label_left' => 'Low',  
            'label_right' => 'High',
            'max_rate' => $maxrate, 
            'correct_answer' => rand(1,$maxrate),
        ]);  
        
        Question::create([
            'name' => 'Grainy',
            'label_left' => 'Low',  
            'label_right' => 'High',
            'max_rate' => $maxrate, 
            'correct_answer' => rand(1,$maxrate),
        ]);  
        
        Question::create([
            'name' => 'Hardness',
            'label_left' => 'Low',  
            'label_right' => 'High',
            'max_rate' => $maxrate, 
            'correct_answer' => rand(1,$maxrate),
        ]);  
        
        Question::create([
            'name' => 'Softness',
            'label_left' => 'Low',  
            'label_right' => 'High',
            'max_rate' => $maxrate, 
            'correct_answer' => rand(1,$maxrate),
        ]);  
        
        Question::create([
            'name' => 'Springiness',
            'label_left' => 'Low',  
            'label_right' => 'High',
            'max_rate' => $maxrate, 
            'correct_answer' => rand(1,$maxrate),
        ]); 
        
        Question::create([
            'name' => 'Padding',
            'label_left' => 'Low',  
            'label_right' => 'High',
            'max_rate' => $maxrate, 
            'correct_answer' => rand(1,$maxrate),
        ]);  
        
        Question::create([
            'name' => 'Lining',
            'label_left' => 'Low',  
            'label_right' => 'High',
            'max_rate' => $maxrate, 
            'correct_answer' => rand(1,$maxrate),
        ]);  
        
        Question::create([
            'name' => 'Wear',
            'label_left' => 'Low',  
            'label_right' => 'High',
            'max_rate' => $maxrate, 
            'correct_answer' => rand(1,$maxrate),
        ]);  
        
        Question::create([
            'name' => 'Melody',
            'label_left' => 'Low',  
            'label_right' => 'High',
            'max_rate' => $maxrate, 
            'correct_answer' => rand(1,$maxrate),
        ]);  
        
        Question::create([
            'name' => 'Harmony',
            'label_left' => 'Low',  
            'label_right' => 'High',
            'max_rate' => $maxrate, 
            'correct_answer' => rand(1,$maxrate),
        ]);  
        
        Question::create([
            'name' => 'Rhythm',
            'label_left' => 'Low',  
            'label_right' => 'High',
            'max_rate' => $maxrate, 
            'correct_answer' => rand(1,$maxrate),
        ]);  
        
        Question::create([
            'name' => 'Stamp',
            'label_left' => 'Low',  
            'label_right' => 'High',
            'max_rate' => $maxrate, 
            'correct_answer' => rand(1,$maxrate),
        ]);  
    }
}
