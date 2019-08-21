<?php

namespace ORC;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];
    
    public function models()
    {
        return $this->hasMany(Module::class);
    }
            
}
