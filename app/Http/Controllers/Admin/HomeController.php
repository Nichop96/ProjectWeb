<?php

namespace ORC\Http\Controllers\Admin;

use ORC\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use ORC\Survey;
use ORC\Module;
use ORC\Group;
use ORC\User;

class HomeController extends Controller {

    public function index() {
        $modules_count = Module::count();
        $surveys_count = Survey::count();
        $group_count = Group::count();
        $users_count = User::count();
        
        $surveys = DB::table('surveys')
                        ->join('categories', 'surveys.category_id', '=', 'categories.id')                        
                        ->select('surveys.*','categories.name as category')
                        ->orderBy('surveys.created_at','desc')
                        ->paginate(10);
        
        $completedSurveys = DB::table('completed_surveys')
                ->join('surveys', 'completed_surveys.survey_id', '=', 'surveys.id')                
                ->select('surveys.*', 'completed_surveys.id as completed_id')
                ->orderBy('completed_surveys.created_at', 'asc')
                ->get();
 
         $surveys_category = DB::table('surveys')               
                ->join('categories', 'surveys.category_id', 'categories.id')
                ->groupBy('categories.name')
                ->select('categories.name', DB::raw('COUNT(*) as count'))               
                ->get();

        $correctAnswers = 0;
        $countQuestions = 0;
        foreach ($completedSurveys as $completedSurvey) {            
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
                $countQuestions++;
            }            
        }
        $wrongAnswers = $countQuestions - $correctAnswers;

        return view('admin.index')->with([
                    'surveys_count' => $surveys_count,
                    'modules_count' => $modules_count,
                    'group_count' => $group_count,
                    'users_count' => $users_count,
                    'correctAnswers' => $correctAnswers,
                    'wrongAnswers' => $wrongAnswers,
                    'surveys_category' => $surveys_category,
                    'surveys' => $surveys
        ]);
    }

}
