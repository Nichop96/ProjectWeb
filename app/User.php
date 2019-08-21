<?php

namespace ORC;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','surname','username', 'email', 'password','birth_date'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'birth_date' => 'date',
    ];
    
    public static $rules = [ 'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255',],
            'email' => ['required', 'string', 'email', 'max:255'],
            'birth_date' => ['required'],
            'password' => ['required', 'string', 'min:8','confirmed']];
    
    public function roles(){
        return $this->belongsToMany('ORC\Role');
    }
    
    public function hasAnyRoles($roles){
        return null !== $this->roles()->whereIn('name',$roles)->first();
    }
    
    public function hasAnyRole($role){
        return null !== $this->roles()->where('name',$role)->first();
    }
    
    public function groups(){
        return $this->belongsToMany('ORC\Group');
    }
    
    public function completedSurveys(){
        return $this->hasMany('ORC\CompletedSurvey');
    }
    
    
}
