<?php

use Illuminate\Database\Seeder;
use ORC\Group;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Group::create([
            'name' => 'Public',
            'description' => 'Group with every users ',            
        ]);
        
        Group::create([
            'name' => 'Red wine tasters',
            'description' => 'Red wine',            
        ]);
        
        Group::create([
            'name' => 'White wine tasters',
            'description' => 'White wine',            
        ]);
        
        Group::create([
            'name' => 'Spumante tasters',
            'description' => 'Spumante',            
        ]);
    }
}
