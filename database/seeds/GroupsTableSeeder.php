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
            'name' => 'Chanel n.5 Smellers',
            'description' => 'Chanel n.5',            
        ]);
        
        Group::create([
            'name' => 'Red wine Tasters',
            'description' => 'Red wine',            
        ]);
        
        Group::create([
            'name' => 'White wine Tasters',
            'description' => 'White wine',            
        ]);
        
        Group::create([
            'name' => 'Bassanese: Griffone',
            'description' => 'Bassanese: Griffone 0.75 ',            
        ]);
        
        Group::create([
            'name' => 'Moet & Chandon Tasters',
            'description' => 'Moet & Chandon saga',            
        ]);
        
        Group::create([
            'name' => 'Coffee Tasters',
            'description' => 'Group for all types of coffe',            
        ]);
        
        Group::create([
            'name' => 'Grana Padano',
            'description' => 'Grana Padano Riserva 24 mesi',            
        ]);
        
        Group::create([
            'name' => 'Tissue Touchers',
            'description' => 'Group for texture touch',            
        ]);
        
        Group::create([
            'name' => 'The Simpson: Yellow Album',
            'description' => 'The Simpson: The Yellow Album',            
        ]);
    }
}
