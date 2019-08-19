<?php

use Illuminate\Database\Seeder;
use ORC\Question;
use ORC\Module;

class ModulesQuestionsTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('module_question')->truncate();
        $modules = Module::all();
        $questions = Question::all();
        foreach ($modules as $module) {
            $randMax = rand(4, 9);
            foreach ($questions as $question) {
                $rand = rand(1, 10);
                if ($rand <= $randMax) {
                    $module->questions()->attach($question['id']);
                }
            }
        }
    }

}
