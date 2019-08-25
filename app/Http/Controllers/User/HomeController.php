<?php

namespace ORC\Http\Controllers\User;

use ORC\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller {

    public function index() {
        $completedSurveys = DB::table('completed_surveys')
                ->join('surveys', 'completed_surveys.survey_id', '=', 'surveys.id')
                ->where('completed_surveys.user_id', '=', Auth::id())
                ->select('surveys.*', 'completed_surveys.id as completed_id')
                ->orderBy('completed_surveys.created_at', 'asc')
                ->get();
        $completedSurveys_count = count($completedSurveys);

        $ids = array();
        foreach ($completedSurveys as $s) {
            array_push($ids, $s->id);
        }

        $surveys_count = DB::table('surveys')->join('group_survey', 'surveys.id', '=', 'group_survey.survey_id')
                        ->join('groups', 'group_survey.group_id', '=', 'groups.id')
                        ->join('group_user', 'groups.id', '=', 'group_user.group_id')
                        ->join('users', 'group_user.user_id', '=', 'users.id')
                        ->where([['users.id', '=', Auth::id()],['surveys.fillable','=','1']])
                        ->whereNotIn('surveys.id',$ids)
                        ->distinct('surveys.id')
                        ->select('surveys.*')
                        ->orderBy('surveys.created_at','desc')
                        ->count('surveys.id');

        //$surveys_count = count($surveys);

        $surveys_category = DB::table('completed_surveys')
                ->join('surveys', 'completed_surveys.survey_id', '=', 'surveys.id')
                ->join('categories', 'surveys.category_id', 'categories.id')
                ->distinct('categories.id')
                ->select('categories.name', 'categories.id')
                ->where('completed_surveys.user_id', '=', Auth::id())
                ->get();

        foreach ($surveys_category as $survey_category) {
            $survey_category->count = DB::table('completed_surveys')
                    ->join('surveys', 'completed_surveys.survey_id', '=', 'surveys.id')
                    ->where([['completed_surveys.user_id', '=', Auth::id()], ['surveys.category_id', '=', $survey_category->id]])
                    ->count();
        }

        $correctAnswers = 0;
        $countQuestions = 0;
        foreach ($completedSurveys as $completedSurvey) {
            $completedSurvey->score = 0;
            $questions = DB::table('question_survey')
                            ->join('questions', 'question_survey.question_id', 'questions.id')
                            ->join('answers', 'questions.id', 'answers.question_id')
                            ->where('answers.completed_survey_id', '=', $completedSurvey->completed_id)
                            ->distinct('questions.id')
                            ->select('questions.*', 'answers.value as value', 'answers.id as answer_id')
                            ->orderBy('questions.id', 'asc')->get();
            foreach ($questions as $question) {
                if ($question->value == $question->correct_answer) {
                    $correctAnswers++;
                }
                $completedSurvey->score+= abs($question->value - $question->correct_answer);
               $countQuestions++;
            }
            if (count($questions) != 0) {
                $completedSurvey->score /= count($questions);
            }      
        }

        $wrongAnswers = $countQuestions - $correctAnswers;

        return view('user.index')->with([
                    'surveys_count' => $surveys_count,
                    'completedSurveys_count' => $completedSurveys_count,
                    'correctAnswers' => $correctAnswers,
                    'wrongAnswers' => $wrongAnswers,
                    'surveys_category' => $surveys_category,
                    'completedSurveys' => $completedSurveys
        ]);
    }

}
