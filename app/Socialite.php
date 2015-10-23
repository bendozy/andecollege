<?php

namespace AndeCollege;

use Illuminate\Database\Eloquent\Model;

class Socialite extends Model
{
	public $timestamps = false;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'socialites';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['auth_id', 'provider', 'user_id'];

	public function user()
	{
		return $this->belongsTo('AndeCollege\User');
	}
}
