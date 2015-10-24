<?php

namespace AndeCollege;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo('AndeCollege\User');
    }

    public function resources()
    {
        return $this->hasMany('AndeCollege\Resource', 'cat_id');
    }
}
