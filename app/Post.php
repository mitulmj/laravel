<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $fillable = ['title','content'];
    public function user(){

        return $this->belongsTO('App\User');
    }
}
