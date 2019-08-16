<?php

namespace ORC;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $guarded = [];
    
    public static $rules = [ 'name' => ['required', 'string', 'max:255'],
            'label_left' => ['nullable'],
            'label_right' => ['nullable']];
    
    public function modules(){
        return $this->belongsToMany('ORC\Module');
    }
    
    public function surveys(){
        return $this->belongsToMany('ORC\Survey');
    }
    
    public function answers(){
        return $this->hasMany('ORC\Answer');
    }
    
}
