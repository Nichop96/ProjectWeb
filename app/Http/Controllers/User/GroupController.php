<?php

namespace ORC\Http\Controllers\User;

use Illuminate\Http\Request;
use ORC\Http\Controllers\Controller;
use ORC\Group;
use ORC\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $groups = User::find(Auth::id())->groups()->paginate(5);
        foreach ($groups as $group) {
            $group->count = $group->users()->count();
        }

        return view('user.groups.index')->with('groups', $groups);
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
        $users = $group->users()->wherePivot('user_id','=',Auth::id())->detach();

        return redirect(route('user.groups.index'));
    }

}
