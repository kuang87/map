<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    public function note()
    {
        return $this->hasOne(Note::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
