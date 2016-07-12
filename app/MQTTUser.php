<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MQTTUser extends Model
{
    protected $table = 'mqtt_users';
    public $timestamps = false;
    
    protected $fillable = [
        'username', 'pw', 'super',
    ];
}
