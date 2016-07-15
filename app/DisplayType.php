<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DisplayType extends Model
{
    protected $table = 'display_types';
    protected $fillable = ['type', 'name'];
}
