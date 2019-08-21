<?php

use Illuminate\Database\Seeder;
use ORC\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::truncate();
        
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'user']);
    }
}
