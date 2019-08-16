<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(GroupsTableSeeder::class);
        $this->call(GroupsUsersTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(ModulesTableSeeder::class);
        $this->call(QuestionsTableSeeder::class);
        $this->call(ModulesQuestionsTableSeeder::class);
        $this->call(SurveysTableSeeder::class);
        $this->call(GroupsSurveysTableSeeder::class);
        $this->call(SurveysQuestionsTableSeeder::class);
        $this->call(CompletedSurveysTableSeeder::class);
        $this->call(AnswersTableSeeder::class);
    }
}
