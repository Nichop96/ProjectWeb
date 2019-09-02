<?php

use Illuminate\Database\Seeder;
use ORC\Survey;
use ORC\Group;

class GroupsSurveysTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('group_survey')->truncate();
        $groups = Group::orderBy("id","asc")->get();
        $surveys = Survey::orderBy("id","asc")->get();
        
        $surveys[0]->groups()->attach($groups[7]);
        $surveys[1]->groups()->attach($groups[2]);
        $surveys[2]->groups()->attach($groups[1]);
        $surveys[3]->groups()->attach($groups[5]);
        $surveys[4]->groups()->attach($groups[6]);
        $surveys[5]->groups()->attach($groups[2]);
        $surveys[6]->groups()->attach($groups[9]);
        $surveys[7]->groups()->attach($groups[0]);
        $surveys[8]->groups()->attach($groups[0]);
        $surveys[9]->groups()->attach($groups[8]);
    }

}
