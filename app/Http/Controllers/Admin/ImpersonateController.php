<?php

namespace ORC\Http\Controllers\Admin;

use Illuminate\Http\Request;
use ORC\Http\Controllers\Controller;
use ORC\User;

class ImpersonateController extends Controller {

    public function index($id) {
        $user = User::where('id', $id)->first();
        if ($user) {
            session()->put('impersonate', $user->id);
        }
        return redirect('/home');
    }

    public function destroy() {
        session()->forget('impersonate');
        return redirect('/home');
    }

}
