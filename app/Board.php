<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'key', 'password','user_id'
    ];

    /**
     * Every board belongs to a user
     * 
     * @return App\User User that owns the board
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get devices belonging to this board
     * @return Collection A collection of devices belonging to this board
     */
    public function devices()
    {
        return $this->hasMany('App\Device');
    }

}
