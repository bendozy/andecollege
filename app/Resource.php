<?php

namespace AndeCollege;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
	public function user()
	{
		return $this->belongsTo('AndeCollege\User');
	}

	public function category()
	{
		return $this->belongsTo('AndeCollege\Category');
	}
}
