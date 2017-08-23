<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $fillable = ['title', 'body', 'is_ready'];

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
