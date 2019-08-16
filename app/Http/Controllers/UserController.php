<?php

namespace ORC\Http\Controllers;

use Illuminate\Http\Request;
use ORC\User;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller {

    public function index() {
        $userList = User::all();
        // return View::make('user/index')->with('userList', $userList);
        return View('user/index')->with('userList', $userList);
    }

    public function create() {
        $user = new User();
        return View::make('user/form')->with('user', $user);
    }

    public function store(Request $request) {
        $request->validate(User::$rules); 
        User::create($request->all());
        return Redirect::to(route('index'));
    }

    public function edit($id) {
        $user = User::findOrFail($id);
        return View::make('user/form')->with('user', $user);
    }

    public function update(Request $request, $id) {
        $this->validate($request, User::$rules);
        $user = User::findOrFail($id);
        $user->update($request->all());
        return Redirect::to(route('user.index'));
    }

    public function destroy($id) {
        User::destroy($id);
        return Redirect::to(route('user.index'));
    }

}
