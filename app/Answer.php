<?php

namespace ORC;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $guarded = [];
    
    public function completedSurvey()
    {
        return $this->belongsTo('ORC\CompletedSurvey');
    }
    
    public function question()
    {
        return $this->belongsTo('ORC\Question');
    }
    
}
