<?php

use Illuminate\Database\Seeder;
use ORC\Question;
use ORC\Survey;
use ORC\Category;

class SurveysQuestionsTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('question_survey')->truncate();
        $surveys = Survey::orderBy("id","ASC")->get();
        $categories = Category::all();
        
        $categories[0]->start_id = 1; //vino
        $categories[0]->end_id = 15;
        
        $categories[3]->start_id = 17; //profumo
        $categories[3]->end_id = 20;
        
        $categories[2]->start_id = 21; //furmai
        $categories[2]->end_id = 27;
        
        $categories[4]->start_id = 28; 
        $categories[4]->end_id = 32;  //tessuti
        
        $categories[5]->start_id = 33; //musica
        $categories[5]->end_id = 36;
        
        
        
        
        foreach ($surveys as $survey) {
            $questions = Question::whereBetween('id', [$categories[$survey['category_id']-1]->start_id, $categories[$survey['category_id']-1]->end_id])->get();
            $randMax = rand(7, 10);
            foreach ($questions as $question) {
                $rand = rand(1, 10);
                if ($rand <= $randMax) {
                    $q = new Question();
                    $q->name = $question->name;
                    $q->label_left = $question->label_left;
                    $q->label_right = $question->label_right;
                    $q->max_rate = $question->max_rate;
                    $q->correct_answer = $question->correct_answer;
                    $q->save();
                    $q = DB::table("questions")->orderBy("id","DESC")->first();
                    $survey->questions()->attach($q->id);
                }
            }
        }
    }

}
