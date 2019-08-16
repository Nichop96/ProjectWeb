<?php

use Illuminate\Database\Seeder;
use ORC\Question;
use ORC\Survey;

class SurveysQuestionsTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('question_survey')->truncate();
        $surveys = Survey::all();
        $questions = Question::all();
        foreach ($surveys as $survey) {
            $randMax = rand(4, 9);
            foreach ($questions as $question) {
                $rand = rand(1, 10);
                if ($rand <= $randMax) {
                    $survey->questions()->attach($question['id']);
                }
            }
        }
    }

}
