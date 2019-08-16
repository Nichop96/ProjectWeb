<?php

namespace ORC;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $guarded = [];
    
    public static $rules = [ 'name' => ['required','min:3', 'string', 'max:255'],
            'description' => ['string', 'max:255','nullable'],
            'image' => ['nullable'],          
            'category' => ['required','string']];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    public function questions(){
        return $this->belongsToMany('ORC\Question');
    }
    
    public function surveys(){
        return $this->hasMany('ORC\Survey');
    }
}
