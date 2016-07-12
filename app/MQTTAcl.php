<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MQTTAcl extends Model
{
    protected $table = 'mqtt_acls';
    public $timestamps = false;

    protected $fillable = [
        'username', 'topic', 'rw',
    ];
}
