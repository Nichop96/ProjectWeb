<?php

namespace ORC\Http\Controllers\User;

use Illuminate\Http\Request;
use ORC\Http\Controllers\Controller;
use ORC\Question;
use ORC\Module;
use ORC\Survey;
use ORC\Group;
use ORC\Category;
use ORC\Answer;
use ORC\User;
use ORC\CompletedSurvey;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SurveyController extends Controller {

    public function index() {
        $completedSurveys = DB::table('completed_surveys')
                        ->join('surveys', 'completed_surveys.survey_id', '=', 'surveys.id')
                        ->where('completed_surveys.user_id', '=', Auth::id())
                        ->select('surveys.*', 'completed_surveys.id as completed_id')
                        ->orderBy('completed_surveys.created_at','desc')
                        ->get();
        
        $ids = array();
        foreach($completedSurveys as $s)
        {
            array_push($ids, $s->id);
        }        
        $surveys = DB::table('surveys')->join('group_survey', 'surveys.id', '=', 'group_survey.survey_id')
                        ->join('groups', 'group_survey.group_id', '=', 'groups.id')
                        ->join('group_user', 'groups.id', '=', 'group_user.group_id')
                        ->join('users', 'group_user.user_id', '=', 'users.id')
                        ->where([['users.id', '=', Auth::id()],['surveys.fillable','=','1']])
                        ->whereNotIn('surveys.id',$ids)
                        ->distinct('surveys.id')
                        ->select('surveys.*')
                        ->orderBy('surveys.created_at','desc')
                        ->get();

        return view('user.surveys.index')->with(['surveys' => $surveys,
                    'completedSurveys' => $completedSurveys]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id) {
        $survey = Survey::find($id);
        $questions = $survey->questions;
        return view('user.surveys.create')->with(['survey' => $survey,
                    'questions' => $questions,
        ]);
    }

    public function store(Request $request) {
        $i = 1;
        $completedSurvey = new CompletedSurvey();
        $completedSurvey->user_id = Auth::id();
        $completedSurvey->survey_id = $request['id'];
        $completedSurvey->save();
        
        $completedSurvey = DB::table('completed_surveys')
                ->where([['user_id','=',Auth::id()],['survey_id','=',$request['id']]])
                ->first();
        while(isset($request['question_id'.$i]))
        {
            $answer = new Answer();
            $answer->completed_survey_id = $completedSurvey->id;
            $answer->question_id = $request['question_id'.$i];
            $answer->value = $request['answer'.$i];
            $answer->save();
            $i++;
        }
        return redirect(route('user.surveys.index'));
    }

    public function show($id) {
        $sid = CompletedSurvey::findOrFail($id);
        $completedSurvey = DB::table('completed_surveys')
                        ->join('surveys', 'completed_surveys.survey_id', '=', 'surveys.id')
                        ->where('completed_surveys.id', '=', $id)
                        ->select('surveys.*', 'completed_surveys.id as completed_id')->first();      
        $questions = DB::table('question_survey')
                        ->join('questions', 'question_survey.question_id','questions.id')
                        ->join('answers','questions.id','answers.question_id')
                        ->where('answers.completed_survey_id', '=', $completedSurvey->completed_id)
                        ->distinct('questions.id')
                        ->select('questions.*','answers.value as value','answers.id as answer_id')
                        ->orderBy('questions.id', 'asc')->get();       
       
        $correctAnswers = 0;
        foreach ($questions as $question)
        {
            if($question->value == $question->correct_answer)
            {
                $correctAnswers++;
            }
        }
        $wrongAnswers = count($questions) - $correctAnswers;
        
        $score = 0;
        foreach ($questions as $question)
        {
            $score+= abs($question->value - $question->correct_answer);            
        }
        if(count($questions) != 0)
        {
            $score /= count($questions);
        }        
        return view('user.surveys.show')->with(['completedSurvey' => $completedSurvey,                    
                    'questions' => $questions,
                    'wrongAnswers' => $wrongAnswers,
                    'correctAnswers' => $correctAnswers,
                    'score' => $score
        ]);
    }
}
