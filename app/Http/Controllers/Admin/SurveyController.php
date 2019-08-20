<?php

namespace ORC\Http\Controllers\Admin;

use Illuminate\Http\Request;
use ORC\Http\Controllers\Controller;
use ORC\Question;
use ORC\Module;
use ORC\Survey;
use ORC\Group;
use ORC\Category;
use ORC\CompletedSurvey;
use Illuminate\Support\Facades\DB;

class SurveyController extends Controller {

    public function index() {
        $modules = Module::all();
        $surveys = Survey::all();

        return view('admin.surveys.index')->with(['modules' => $modules,
                    'surveys' => $surveys]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id) {

        if ($id === '-1') {                     // from scratch
            $categories = Category::all();
            $groups = Group::paginate(50);

            foreach ($groups as $group) {
                $group->count = $group->users()->count();
            }
            return view('admin.surveys.create')->with(['categories' => $categories,
                        'groups' => $groups]);
        } else {                                // otherwise...
            $module = Module::find($id);
            $categories = Category::all();
            $questions = $module->questions;
            $groups = Group::paginate(50);

            foreach ($groups as $group) {
                $group->count = $group->users()->count();
            }

            return view('admin.surveys.create')->with(['module' => $module,
                        'questions' => $questions,
                        'categories' => $categories,
                        'groups' => $groups]);
        }
    }

    public function store(Request $request) {
        // Verifico la validità del modulo
        $request->validate(Module::$rules);

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

        $correct_ans = $request->aux_correctans;
        $correct_ans = explode(",", $correct_ans);

        $groups_id = $request['aux_groups'];
        $groups_id = explode(",", $groups_id);

        unset($request['aux_groups']);
        unset($request['aux_questions']);
        unset($request['aux_left']);
        unset($request['aux_right']);
        unset($request['aux_maxmark']);
        unset($request['aux_correctans']);


        // setto la categoria e faccio inserimento del modulo
        $tmp = $request['category'];
        unset($request['category']);
        $request['category_id'] = $tmp;
        
         // modifiche
        unset($request['file']);
        
        // parte modificata profondamente
        $survey = new Survey();
        $survey->name = $request['name'];
        $survey->description = $request['description'];
        $survey->category_id = $request['category_id'];
        $survey->fillable = $request['fillable'];   
        
        // gestisco l'immagine
        if($file = $request->file('file')){
                $name = $file->getClientOriginalName();
                if($file->move('images/surveys', $name)){
                    $survey->image = $name;
                    
                }
        }else{
            if($request['aux_module_id']){
                $tmp = Module::find($request['aux_module_id']);
                if(strlen($tmp->image)){
                    if(copy("images/modules/".$tmp->image, "images/surveys/".$tmp->image)){
                        $survey->image = $tmp->image;
                    
                    }
                }
            }
        }
        $survey->save();
        
        
        // Survey::create($request->all());
        // fine modifiche
        
        
        $survey_inserito = Survey::where('name', $request['name'])->orderBy('id', 'DESC')->first();
        // ora gestisco le domande
        for ($i = 0; $i < count($question); $i++) {
            if ($question[$i] != '-1') {
                $tmp = new Question;

                $tmp->name = $question[$i];
                $tmp->label_left = $label_left[$i];
                $tmp->label_right = $label_right[$i];
                $tmp->max_rate = $max_rate[$i];
                $tmp->correct_answer = $correct_ans[$i];

                $tmp->save();

                $domanda = Question::where('name', $tmp->name)->orderBy('id', 'DESC')->first();
                // gestisco la relazione tra domande e moduli
                $survey_inserito->questions()->attach($domanda['id']);
                $survey_inserito->save();
            }
        }


        for ($i = 0; $i < count($groups_id); $i++) {
            $survey_inserito->groups()->attach($groups_id[$i]);
            $survey_inserito->save();
        }

        $modules = Module::all();
        $surveys = Survey::all();

        return view('admin.surveys.index')->with(['modules' => $modules,
                    'surveys' => $surveys]);
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
        $groups = Group::all();
        foreach($groups as $group)
        {
            $group->count = $group->users()->count();
        }
        return view('admin.surveys.edit')->with(['survey' => $survey,
                    'questions' => $questions,
                    'categories' => $categories,
                    'groups' => $groups,
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

        $correct_ans = $request->aux_correctans;
        $correct_ans = explode(",", $correct_ans);

        $groups_id = $request['aux_groups'];
        $groups_id = explode(",", $groups_id);

        unset($request['aux_groups']);
        unset($request['aux_questions']);
        unset($request['aux_left']);
        unset($request['aux_right']);
        unset($request['aux_maxmark']);
        unset($request['aux_correctans']);



        // setto la categoria e faccio inserimento del survey
        $tmp = $request['category'];
        unset($request['category']);
        $request['category_id'] = $tmp;
        
         // gestisco l'immagine
        if($file = $request->file('file')){
                $name = $file->getClientOriginalName();
                if($file->move('images\surveys', $name)){
                    Survey::find($id)
                                    ->update([
                                    'category_id' => $request['category_id'],
                                    'name' => $request['name'],
                                    'description' => $request['description'],
                                    'fillable' => $request['fillable'],
                                    'image' => $name
                        ]);                    
                }
        }
        
        Survey::find($id)
                ->update([
                    'category_id' => $request['category_id'],
                    'name' => $request['name'],
                    'description' => $request['description'],
                    'fillable' => $request['fillable']
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
                $tmp->correct_answer = $correct_ans[$i];

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

    public function show($id) {
        $survey = Survey::findOrFail($id);
        $questions = Survey::findOrFail($id)->questions()->paginate(10);
        $completedSurveys = Survey::findOrFail($id)->completedSurveys()->paginate(100);
        
        $users = DB::table('surveys')
                ->join('completed_surveys','surveys.id','completed_surveys.survey_id')
                ->join('users','completed_surveys.user_id','users.id')
                ->where('surveys.id', '=', $id)
                ->select('users.*','completed_surveys.id as completed_id')
                ->paginate(1000);
        
        $surveys_total_count = DB::table('surveys')->join('group_survey', 'surveys.id', '=', 'group_survey.survey_id')
                        ->join('groups', 'group_survey.group_id', '=', 'groups.id')
                        ->join('group_user', 'groups.id', '=', 'group_user.group_id')
                        ->join('users', 'group_user.user_id', '=', 'users.id')                                                         
                        ->where('surveys.id', '=', $id)
                        ->count();        
        $completedSurveys_count = Survey::findOrFail($id)->completedSurveys()->count();
        $not_completedSurveys_count = $surveys_total_count - $completedSurveys_count;
        
         

        foreach ($questions as $question) {
            $question->count_answers = DB::table('question_survey')
                    ->join('questions', 'question_survey.question_id', '=', 'questions.id')
                    ->join('answers', 'questions.id', 'answers.question_id')
                    ->where([['question_survey.survey_id', '=', $survey->id], ['questions.id', '=', $question->id]])
                    ->groupBy('answers.value')
                    ->select(DB::raw('COUNT(*) as total'))
                    ->pluck('total');
        }
        
        $scores_users = array();
        $i = 0;
        foreach ($completedSurveys as $completedSurvey) {
            $questions_users = DB::table('question_survey')
                            ->join('questions', 'question_survey.question_id', 'questions.id')
                            ->join('answers', 'questions.id', 'answers.question_id')
                            ->where('answers.completed_survey_id', '=', $completedSurvey->id)
                            ->distinct('questions.id')
                            ->select('questions.*', 'answers.value as value', 'answers.id as answer_id')
                            ->orderBy('questions.id', 'asc')->get();
            $score = 0;
            foreach ($questions_users as $question_user) {
                $score += abs($question_user->value - $question_user->correct_answer);
            }            
            $t = 0;
            for($j = 0; $j<$i;$j++) {
                if ($scores_users[$j]['score'] == $score) {
                    $scores_users[$j]['count']++;
                    $t = 1;
                }
            }
            if ($t == 0) {
                $scores_users[$i] = array();
                $scores_users[$i]['score'] = $score;
                $scores_users[$i]['count'] = 1;
                $i++;
            }
        }
        sort($scores_users);
        $minimum_score = 10000000000000;
        $maximum_score = 0;
        $average_score = 0;
        foreach($scores_users as $scores_user)
        {
            if($scores_user['score'] > $maximum_score){
                $maximum_score = $scores_user['score'];
            }
            if($scores_user['score'] < $minimum_score){
                $minimum_score = $scores_user['score'];
            }
            $average_score += $scores_user['score'];
        }
        $average_score /= count($scores_users);

        return view('admin.surveys.show')->with(['completedSurveys' => $completedSurveys,
                    'survey' => $survey,
                    'questions' => $questions,
                    'scores_users' => $scores_users,
                    'completedSurveys_count' => $completedSurveys_count,
                    'not_completedSurveys_count' => $not_completedSurveys_count,
                    'minimum_score' => $minimum_score,
                    'maximum_score' => $maximum_score,
                    'average_score' => $average_score,
                    'users' => $users
        ]);
    }
    
    public function view($id) {
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
        
         $user = CompletedSurvey::findOrFail($id)->user()->first();
        
        
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

        return view('admin.surveys.view')->with(['completedSurvey' => $completedSurvey,                    
                    'questions' => $questions,
                    'wrongAnswers' => $wrongAnswers,
                    'correctAnswers' => $correctAnswers,
                    'score' => $score,
                    'user' => $user
        ]);
    }

}
