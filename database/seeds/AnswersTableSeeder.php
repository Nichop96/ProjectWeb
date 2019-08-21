<?php

use Illuminate\Database\Seeder;
use ORC\CompletedSurvey;
use ORC\Question;
use ORC\Answer;

class AnswersTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('answers')->truncate();
        $completedSurveys = CompletedSurvey::all();
        foreach ($completedSurveys as $completedSurvey) {
            $questions = DB::table('question_survey')
                    ->join('questions', 'question_survey.question_id', '=', 'questions.id')
                    ->where('question_survey.survey_id', '=', $completedSurvey['survey_id'])
                    ->get();
            foreach ($questions as $question) {
                $value = rand(1, $question->max_rate);
                Answer::create([
                    'completed_survey_id' => $completedSurvey['id'],
                    'question_id' => $question->id,                    
                    'value' => $value,
                ]);
            }
        }
    }

}
