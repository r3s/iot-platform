<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Redis;

class Device extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'topic', 'display_type', 'output_enabled','board_id'
    ];

    /**
     * Get the board that this device belongs to
     * @return App\Board
     */
    public function board()
    {
    	return $this->belongsTo('App\Board');
    }

    public function type()
    {
        return DisplayType::find($this->display_type)->name;
    }

    public function updateVal($value)
    {
        $this->current_val = $value;
        Redis::set($this->topic,$value);
    }

    public function currentVal(){
        return Redis::get($this->topic);
    }
}
