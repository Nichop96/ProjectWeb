<?php

namespace ORC;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    protected $guarded = [];
    
    public static $rules = [ 'name' => ['required','min:3', 'string', 'max:255'],
            'description' => ['string', 'max:255','nullable'],
            'image' => ['nullable'],          
            'category' => ['required','string']];
    
    public function groups(){
        return $this->belongsToMany('ORC\Group');
    }
    
    public function questions(){
        return $this->belongsToMany('ORC\Question');
    }
    
    public function module()
    {
        return $this->belongsTo('App\Module');
    }
    
    public function completedSurveys(){
        return $this->hasMany('ORC\CompletedSurvey');
    }
}

