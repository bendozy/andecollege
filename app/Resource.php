<?php

namespace AndeCollege;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    protected $fillable = [
        'title',
        'user_id',
        'link',
        'description',
        'cat_id'
    ];

    public function user()
    {
        return $this->belongsTo('AndeCollege\User', 'user_id');
    }

    public function category()
    {
        return $this->belongsTo('AndeCollege\Category', 'cat_id');
    }
}
