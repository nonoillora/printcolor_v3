<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CronLog extends Model
{
    protected $fillable = ['result', 'cron_launch_at', 'created_at', 'updated_at'];
    protected $table = 'cron_logs';
    protected $primaryKey = 'idLog';

}
