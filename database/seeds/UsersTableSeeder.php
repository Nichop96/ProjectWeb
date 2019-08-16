<?php

use Illuminate\Database\Seeder;
use ORC\User;
use ORC\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        DB::table('role_user')->truncate();
        $adminRole = Role::where('name','admin')->first();
        $userRole = Role::where('name','user')->first();
        
        $admin = User::create([
            'name' => 'Admin',
            'surname' => 'Admin', 
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),         
            'birth_date' => '1995-11-18',
        ]);
        
        $user = User::create([
            'name' => 'Piero',
            'surname' => 'Luati', 
            'username' => 'piero',
            'email' => 'piero@luati.com',
            'password' => bcrypt('piero'),         
            'birth_date' => '1955-11-18',
        ]);
        
        $admin->roles()->attach($adminRole);
        $user->roles()->attach($userRole);
        
        factory(ORC\User::class,30)->create();
    }
}
