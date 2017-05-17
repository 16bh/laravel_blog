<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Article extends Model
{
    //
    protected $dates = ['published_at'];

     protected $fillable = [
        'title',
        'intro',
        'content',
        'published_at'
    ];

    public function setPublishedAtAttribute($date)
    {
        $this->attributes['published_at'] = Carbon::createFromFormat('Y-m-d',$date);
    }

    //将文章标题转化为URL的一部分，以利于SEO
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;

        if (! $this->exists) {
            $this->attributes['slug'] = str_slug($value);
        }
    }

    public function scopePublished($query)
    {
        $query->where('published_at','<=',Carbon::now());
    }

    //申明一对多关系
    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }

    public function getTagListAttribute()
    {
        // laravel 5.1 needs all()
        return $this->tags->pluck('id')->all();
        // tags means tags() many-to-many relationship with tag
    }

}
