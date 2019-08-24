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
        return redirect()->route('user.surveys.index');
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
        $score /= count($questions);
        return view('user.surveys.show')->with(['completedSurvey' => $completedSurvey,                    
                    'questions' => $questions,
                    'wrongAnswers' => $wrongAnswers,
                    'correctAnswers' => $correctAnswers,
                    'score' => $score
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        // rimuovo le domande attaccate al survey
        $survey = Survey::find($id);

        $old_questions = $survey->questions;
        $survey->questions()->detach();

        foreach ($old_questions as $quest) {
            $count_s = $quest->surveys()->count();

            if ($count_s < 1) {
                Question::destroy($quest['id']);
            }
        }

        // rimuovo le relazioni con i gruppi

        $survey->groups()->detach();

        Survey::destroy($id);

        $modules = Module::all();
        $surveys = Survey::all();

        return view('admin.surveys.index')->with(['modules' => $modules,
                    'surveys' => $surveys]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $survey = Survey::find($id);
        $questions = $survey->questions;
        $categories = Category::all();
        $selectedGroups = $survey->groups;
        //dd($questions);

        return view('admin.surveys.edit')->with(['survey' => $survey,
                    'questions' => $questions,
                    'categories' => $categories,
                    'groups' => Group::all(),
                    'selectedGroups' => $selectedGroups]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {

        // CONTINUA DA QUA, COPIA IL CREATE DI UN SURVEY E VEDI SE FUNZIONA
        // SE FUNZIONA PROVA CON IL METODO UPDATE COSI DA NON CREARE COPIONI DELLO STESSO ELEMENTO
        // SE FUNZIONA APPLICA UPDATE A TUTTI GLI UPDATE PASSATI.
        // Verifico la validità del modulo
        $request->validate(Survey::$rules);

        // se sono qui ho superato il validate perciò estraggo gli attributi 
        // non necessari(le domande) e procedo con l'inserimento
        $question = $request['aux_questions'];
        $question = explode(",", $question);

        $label_left = $request->aux_left;
        $label_left = explode(",", $label_left);

        $label_right = $request->aux_right;
        $label_right = explode(",", $label_right);

        $max_rate = $request->aux_maxmark;
        $max_rate = explode(",", $max_rate);

        // estraggo gli id dei gruppi coinvolti
        $groups_id = $request['aux_groups'];
        $groups_id = explode(",", $groups_id);

        unset($request['aux_groups']);
        unset($request['aux_questions']);
        unset($request['aux_left']);
        unset($request['aux_right']);
        unset($request['aux_maxmark']);



        // setto la categoria e faccio inserimento del survey
        $tmp = $request['category'];
        unset($request['category']);
        $request['category_id'] = $tmp;
        Survey::find($id)
                ->update([
                    'category_id' => $request['category_id'],
                    'name' => $request['name'],
                    'description' => $request['description']
        ]);


        $survey_inserito = Survey::find($id);
        $old_questions = $survey_inserito->questions;
        $survey_inserito->questions()->detach();
        foreach ($old_questions as $quest) {
            $count_s = $quest->surveys()->count();
            $count = $count_s;

            if ($count < 1) {
                Question::destroy($quest['id']);
            }
        }
        // ora gestisco le domande
        for ($i = 0; $i < count($question); $i++) {
            if ($question[$i] != '-1') {
                $tmp = new Question;

                $tmp->name = $question[$i];
                $tmp->label_left = $label_left[$i];
                $tmp->label_right = $label_right[$i];
                $tmp->max_rate = $max_rate[$i];

                $tmp->save();

                $domanda = Question::where('name', $tmp->name)->orderBy('id', 'DESC')->first();
                // gestisco la relazione tra domande e moduli
                $survey_inserito->questions()->attach($domanda['id']);
                $survey_inserito->save();
            }
        }


        $survey_inserito->groups()->detach(); // remove every group-survey relationship
        for ($i = 0; $i < count($groups_id); $i++) {
            $survey_inserito->groups()->attach($groups_id[$i]);
            $survey_inserito->save();
        }

        $modules = Module::all();
        $surveys = Survey::all();

        return view('admin.surveys.index')->with(['modules' => $modules,
                    'surveys' => $surveys]);
    }

}
