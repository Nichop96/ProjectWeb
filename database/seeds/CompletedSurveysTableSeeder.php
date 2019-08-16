<?php

use Illuminate\Database\Seeder;
use ORC\User;
use ORC\Survey;
use ORC\CompletedSurvey;

class CompletedSurveysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $users = User::all();
       $surveys = Survey::all();
       
       foreach ($users as $user)
       {
           $randMax = rand(3, 6);
           foreach($surveys as $survey)
           {
               $rand = rand(1, 10);
                if ($rand <= $randMax) {
                    
                    CompletedSurvey::create([
                        'user_id' => $user['id'],
                        'survey_id' => $survey['id'],                        
                    ]);
                    
                }
           }
       }
    }
}
