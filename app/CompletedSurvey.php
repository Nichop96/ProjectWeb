<?php

namespace ORC;

use Illuminate\Database\Eloquent\Model;

class CompletedSurvey extends Model
{
    protected $guarded = [];
    
    public function user()
    {
        return $this->belongsTo('ORC\User');
    }
    
    public function survey()
    {
        return $this->belongsTo('ORC\Survey');
    }
    
    public function answers(){
        return $this->hasMany('ORC\Answer');
    }
}
