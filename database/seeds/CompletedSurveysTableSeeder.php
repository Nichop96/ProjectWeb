<?php

use Illuminate\Database\Seeder;
use ORC\User;
use ORC\Survey;
use ORC\CompletedSurvey;

class CompletedSurveysTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $users = User::all();

        foreach ($users as $user) {
            $randMax = rand(0, 10);
            $surveys = DB::table('surveys')->join('group_survey', 'surveys.id', '=', 'group_survey.survey_id')
                    ->join('groups', 'group_survey.group_id', '=', 'groups.id')
                    ->join('group_user', 'groups.id', '=', 'group_user.group_id')
                    ->join('users', 'group_user.user_id', '=', 'users.id')
                    ->where('users.id', '=', $user['id'])
                    ->distinct('surveys.id')
                    ->select('surveys.*')
                    ->orderBy('surveys.created_at', 'desc')
                    ->get();
            foreach ($surveys as $survey) {
                $rand = rand(1, 10);
                if ($rand <= $randMax) {
                    CompletedSurvey::create([
                        'user_id' => $user['id'],
                        'survey_id' => $survey->id,
                    ]);
                }
            }
        }
    }

}
