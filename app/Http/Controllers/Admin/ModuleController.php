<?php

namespace ORC\Http\Controllers\Admin;

use Illuminate\Http\Request;
use ORC\Http\Controllers\Controller;
use ORC\Module;
use ORC\Category;
use ORC\Question;
use Illuminate\Support\Facades\DB;

class ModuleController extends Controller {

    public function index() {
        $modules = Module::all();
        return view('admin.modules.index')->with('modules', $modules);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $categories = Category::all();
        return view('admin.modules.create')->with('categories', $categories);
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

        unset($request['aux_questions']);
        unset($request['aux_left']);
        unset($request['aux_right']);
        unset($request['aux_maxmark']);
        unset($request['aux_correctans']);


        // setto la categoria e faccio inserimento del modulo
        $tmp = $request['category'];
        unset($request['category']);
        $request['category_id'] = $tmp;


        unset($request['file']);

        // parte modificata profondamente
        $module = new Module();
        $module->name = $request['name'];
        $module->description = $request['description'];
        $module->category_id = $request['category_id'];
        // gestisco l'immagine
        if ($file = $request->file('file')) {
            $name = $file->getClientOriginalName();
            if ($file->move('images\modules', $name)) {
                $module->image = $name;
            }
        }
        $module->save();
        //Module::create($request->all());
        // fine parte modificata profondamente

        $modulo_inserito = Module::where('name', $request['name'])->orderBy('id', 'DESC')->first();
        // ora gestisco le domande
        if ($question[0] === '') {
            $dim = 0;
        } else {
            $dim = count($question);
        }
        for ($i = 0; $i < $dim; $i++) {
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
                $modulo_inserito->questions()->attach($domanda['id']);
                $modulo_inserito->save();
            }
        }

        $modules = Module::all();
        return view('admin.modules.index')->with('modules', $modules);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $module = Module::find($id);
        $questions = $module->questions;
        $module->questions()->detach();

        foreach ($questions as $question) {
            Question::destroy($question['id']);
        }

        Module::destroy($id);
        // un pò brutto da vedere ma è l'unica soluzione che mi viene in mente ora
        //$groups = Group::all();
        $modules = Module::all();

        return view('admin.modules.index')->with('modules', $modules);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $module = Module::find($id);
        $questions = $module->questions;
        $categories = Category::all();
        //dd($questions);
        return view('admin.modules.edit')->with(['module' => $module,
                    'questions' => $questions,
                    'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
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

        unset($request['aux_questions']);
        unset($request['aux_left']);
        unset($request['aux_right']);
        unset($request['aux_maxmark']);
        unset($request['aux_correctans']);


        // setto la categoria e faccio inserimento del modulo
        $tmp = $request['category'];
        unset($request['category']);
        $request['category_id'] = $tmp;

        $module = Module::find($id);
        $module->name = $request['name'];
        $module->description = $request['description'];
        $module->category_id = $request['category_id'];

        if ($file = $request->file('file')) {
            $name = $file->getClientOriginalName();
            if ($file->move('images\modules', $name)) {
                $module->image = $name;
            }
        }
        $module->save();

        // ora lavoro sulle domande del modulo
        // la via più facile è rimuoverli tutti e reinserire quelli selezionati nel form
        $_questions = $module->questions;
        $module->questions()->detach(); // rimuovo i collegamenti molti a molti e cancello le domande
        foreach ($_questions as $_question) {
            Question::destroy($_question['id']);
        }
        // ora gestisco le domande

        if ($question[0] === '') {
            $dim = 0;
        } else {
            $dim = count($question);
        }
        for ($i = 0; $i < $dim; $i++) {
            if ($question[$i] != '-1') {

                $tmp = new Question;

                $tmp->name = $question[$i];
                $tmp->label_left = $label_left[$i];
                $tmp->label_right = $label_right[$i];
                $tmp->max_rate = $max_rate[$i];
                $tmp->correct_answer = $correct_ans[$i];
                $tmp->save();

                $quest = Question::where('name', $tmp->name)->orderBy('id', 'DESC')->first();
                // gestisco la relazione tra domande e moduli
                $module->questions()->attach($quest['id']);
                $module->save();
            }
        }

        $modules = Module::all();

        return view('admin.modules.index')->with('modules', $modules);
    }

    public function modules() {
        echo json_encode(DB::table('modules')
                        ->join('categories', 'modules.category_id', 'categories.id')
                        ->select('modules.*', 'categories.name as category')
                        ->get());
    }

    public function questions(Request $request) {
        $id = $request->input('module');
        echo json_encode(DB::table('module_question')
                        ->join('questions', 'module_question.question_id', 'questions.id')
                        ->select('questions.*')
                        ->where('module_question.module_id', '=', $id)
                        ->get());
    }
    
    public function importQuestions(Request $request) {
        $questions = DB::table('questions')->get();               
                        
        $ids = $request->input('questions');        
        $importQuestions = array();
        foreach($questions as $question) {
            foreach($ids as $id) {
                if($id == $question->id) {
                    array_push($importQuestions, $question);
                }
            }
        }
        
        echo json_encode($importQuestions);
    }

}
