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
        $groups = Group::all();
        $surveys = Survey::all();
        foreach ($surveys as $survey) {
            $randMax = rand(5, 9);
            foreach ($groups as $group) {
                $rand = rand(1, 10);
                if ($group['name'] != 'Public' && $rand <= $randMax) {
                    $survey->groups()->attach($group['id']);
                }
            }
        }
    }

}
