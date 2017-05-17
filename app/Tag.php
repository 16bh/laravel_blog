<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //申明一对多关系
    public function articles()
    {
        return $this->belongsToMany('App\Article');
    }
}
