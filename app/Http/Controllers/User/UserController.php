<?php

namespace ORC\Http\Controllers\User;

use Illuminate\Http\Request;
use ORC\Http\Controllers\Controller;
use ORC\User;
use ORC\Role;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
        /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::user()->id != $id){
            return redirect()->route('user.user.index')->with('warning', 'You are not allowed');
        }
        return view('user.user.edit')->with(['user' => User::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(Auth::user()->id != $id){
            return redirect()->route('user.users.index')->with('warning', 'You are not allowed');
        }
        
        // tutto tranne password che non tocco in fase di modifica
        $request->validate([ 'name' => ['required', 'string', 'max:255'],
                            'surname' => ['required', 'string', 'max:255'],
                            'username' => ['required', 'string', 'max:255',],
                            'email' => ['required', 'string', 'email', 'max:255'],
                            'birth_date' => ['required']]); 
        
        
        
        $user = User::find($id);
        $user->name = $request['name'];
        $user->surname = $request['surname'];
        $user->birth_date = $request['birth_date'];
        $user->username = $request['username'];
        $user->email = $request['email'];
        if($request['changePassword']=="change")
        {
            $user->password = bcrypt($request['password']);
        }
        $user->save();
        
        return redirect(route('user.index'));
    }
   
}
