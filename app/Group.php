<?php

namespace ORC;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $guarded = [];
    
    public static $rules = [ 'name' => ['required', 'string', 'min:3', 'max:255'],
            'description' => ['required','string', 'max:255']];
    
    public function users(){
        return $this->belongsToMany('ORC\User');
    }
}
