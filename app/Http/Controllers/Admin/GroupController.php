<?php

namespace ORC\Http\Controllers\Admin;

use Illuminate\Http\Request;
use ORC\Http\Controllers\Controller;
use ORC\Group;
use ORC\User;

class GroupController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        //$groups = Group::all();
        $groups = Group::where('id','!=',1)->paginate(10);

        foreach ($groups as $group) {
            $group->count = $group->users()->count();
        }

        return view('admin.groups.index')->with('groups', $groups);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $userlist = User::all();
        return view('admin.groups.create')->with('userlist', $userlist);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $users = $request->ids;
        $users = explode(",", $users);
        if ($users[0] === '') {
            $dim = 0;
        } else {
            $dim = count($users);
        }

        $request->validate(Group::$rules);
        unset($request['ids']);
        Group::create($request->all());
        $group = Group::where('name', $request['name'])->first();

        for ($i = 0; $i < $dim; $i++) {
            $user = User::where('id', $users[$i])->first();
            $user->groups()->attach($group['id']);
            $user->save();
        }

        return redirect(route('admin.groups.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id) {
        $group = Group::find($id);
        $userlist = User::all();
        $selectedUsers = $group->users;
        return view('admin.groups.edit')->with(['group' => $group,
                    'userlist' => $userlist,
                    'selectedUsers' => $selectedUsers]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $request->validate(Group::$rules);

        // prendo il numero di utenti da attaccare al gruppo per usarli in fondo al metodo
        $users = $request->ids;
        $users = explode(",", $users);

        if ($users[0] === '') {
            $dim = 0;
        } else {
            $dim = count($users);
        }

        // sovrascrivo il gruppo 
        $group = Group::find($id);
        $group->name = $request['name'];
        $group->description = $request['description'];
        $group->save();

        // ora lavoro sugli utenti del gruppo
        // la via più facile è rimuoverli tutti e reinserire quelli selezionati nel form
        $group->users()->detach();
        for ($i = 0; $i < $dim; $i++) {
            $user = User::where('id', $users[$i])->first();
            $user->groups()->attach($group['id']);
            $user->save();
        }
        return redirect(route('admin.groups.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        // NOTA BENISSIMO:
        // PER SCELTA: quando cancello un gruppo la relazione ed il relativo survey rimangono intatti
        // potrebbe non essere la scelta migliore: vedremo in futuro cosa è meglio fare!
        // cancello solo tutte le relazioni user-group
        $group = Group::find($id);
        $users = $group->users()->detach();

        Group::destroy($id);
        return redirect(route('admin.groups.index'));
    }

    public function searchUser(Request $request) {
        if (strlen($request['search_key']) > 0) {
            $byName = Group::where('name', 'LIKE', "%{$request['search_key']}%")->get();
            $byDescription = Group::where('description', 'LIKE', "%{$request['search_key']}%")->get();
            $union = $byName->union($byDescription);

            foreach ($union as $group) {
                $group->count = $group->users()->count();
            }


            return view('admin.groups.index')->with(['groups' => $union,
                        'search' => true]);
        }
        return redirect(route('admin.groups.index'));
    }

}
