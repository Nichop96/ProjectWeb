<?php

namespace ORC\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use ORC\Http\Controllers\Controller;
use ORC\Question;
use ORC\Category;

class QuestionController extends Controller
{
     public function index() {
        $questionsList = Question::all();
        return Response::json($questionsList);
    }
    
    public function store(Request $request) {
        $request->validate(Question::$rules);
        Question::create($request->all()); 
        
    }
    
    public function edit($id) {
        $question = Question::findOrFail($id);
        return $question;
    }
}
