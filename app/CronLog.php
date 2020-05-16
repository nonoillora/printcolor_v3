<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CronLog extends Model
{
    protected $table = 'cron_logs';
    protected $primaryKey = 'idLog';

    protected $fillable = ['idLog','command','result', 'cron_launch_at', 'created_at', 'updated_at'];


}
