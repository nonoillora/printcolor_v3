<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    protected $table = 'configs';

    protected $primaryKey = 'idConfig';

    protected $fillable = [
        'config_key', 'type', 'value', 'description', 'config_is_active'
    ];
}
