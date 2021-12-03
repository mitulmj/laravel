<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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
        'email_verified_at' => 'datetime',
    ];

    public function post(){
 
        //this consider as user_id(default) fields in posts table 
        //if you change this default fields add section parameter the_user_id
        //and if post table not id field is there you add the thired parameter as post unique id
        //has one to one relationship
        return $this->hasOne('App\Post');

    }

    public function posts(){
        return $this->hasMany('App\Post');
    }

    public function roles(){

        //if in database have diffrent table name then you would to enter table name and key also like below
        return $this->belongsTOMany('App\Role','user_roles','user_id','role_id')->withPivot('created_At'); //find user_roles table in database (its costom)

        //if in database have role_user table cant not require define table name (because its laravel convention) like below
        //return $this->bolongsTOMany('App\Role'); -> find role_user table find in database (its by default)
    }
}
