<?php
/**
 * Created by PhpStorm.
 * User: Antonio
 * Date: 18/11/2017
 * Time: 19:43
 */

namespace App\Listeners;

use App\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\Login;
use DB;
use Auth;

class LastLogin
{
    /**
     * Handle the event.
     *
     * @param  \Illuminate\Auth\Events\Login $event
     * @return void
     */
    public function handle(Login $event)
    {
        $last= Auth::user()->user_current_login;
        // Update user last login date/time
        DB::table('users') ->where('id', $event->user->id) ->update(['user_last_login'=>$last,'user_current_login' => Carbon::now('Europe/madrid')]);
    }
}