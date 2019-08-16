<?php

use Illuminate\Database\Seeder;
use ORC\Group;
use ORC\User;

class GroupsUsersTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('group_user')->truncate();
        $groups = Group::all();
        $users = User::all();
        foreach ($groups as $group) {
            if ($group['name'] == 'Public') {
                foreach ($users as $user) {
                    $group->users()->attach($user['id']);
                }
            }
            else {
                $randMax = rand(1,5);
                foreach ($users as $user) {
                    $rand = rand(1,10);
                    if($rand <= $randMax){
                        $group->users()->attach($user['id']);
                    }                    
                }
            }
        }
    }
}
