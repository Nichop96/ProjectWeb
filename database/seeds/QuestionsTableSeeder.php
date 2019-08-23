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
            'name' => 'Prettyness',
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
    }
}
