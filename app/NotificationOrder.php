<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class NotificationOrder extends Model
{
    protected $primaryKey = 'idNotificationOrder';

    protected $table = 'notifications_orders';

    protected $fillable = [
        'idNotificationOrder','idPedido','status','output','executed_at','success_at','failed_at'
    ];

    public function pedido()
    {
        return $this->hasOne(\App\Pedido::class, 'idPedido','idPedido')->first();
    }

    public function setSuccess(){
        $this->status='S';
        $this->success_at = Carbon::now('Europe/Madrid');
        $this->save();
    }

    public function setStarted(){
        $this->status='E';
        $this->executed_at = Carbon::now('Europe/Madrid');
        $this->save();
    }

    public function setFailed(){
        $this->status='F';
        $this->failed_at = Carbon::now('Europe/Madrid');
        $this->save();
    }

    public function setOutput($text){
        $this->output = $text;
        $this->save();
    }
}
