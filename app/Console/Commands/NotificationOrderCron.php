<?php

namespace App\Console\Commands;

use App\NotificationOrder;
use App\SupportFunctions\HelperConfig;
use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Mail\newOrderUser;
use App\Mail\newOrder;
use Factura;
use Mail;
use Exception;
use DB;
use App\CronLog;

class NotificationOrderCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notificationOrderCron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Busca los correos de nuevos pedidos generados ne la plataforma para enviarlos';

    protected $notifications;

    protected $cronLog;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->cronLog = new CronLog(['command'=>$this->signature]);
        $this->cronLog->created_at = Carbon::now('Europe/Madrid');
        $this->notifications = $this->getNewsNotifications();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->cronLog->cron_launch_at = Carbon::now('Europe/Madrid');

        if (count($this->notifications) > 0) {
            foreach ($this->notifications as $notification) {
                try {
                    $notification->setStarted();

                    $pedido = $notification->pedido();
                    $cliente = $notification->pedido()->cliente();
                    $lineas = DB::table('linea_pedidos')
                        ->select('*')
                        ->whereIn('id', unserialize(DB::table('pedidos')->select('idLineas')->where('idPedido', $pedido->idPedido)->first()->idLineas))
                        ->get();
                    $factura = $notification->pedido()->factura();
                    Mail::to($cliente->email)->send(new newOrderUser($pedido, $cliente, $lineas, $factura));
                    Mail::to(HelperConfig::getConfig('_EMAIL_SEND_NOTIFICATION_OWN'))->send(new newOrder($pedido, $cliente, $lineas, $factura));

                    if (count(Mail::failures()) > 0) {
                        $notification->setFailed();
                    } else {
                        $notification->setSuccess();
                    }
                } catch (Exception $ex) {
                    $notification->setOutput($ex);
                    $notification->setFailed();
                }
            }
            $this->cronLog->result = "Se procesaron ".count($this->notifications)." notificaciones.";
        }else{
            $this->cronLog->result = "No hay nada que procesar";
        }
        $this->cronLog->updated_at = Carbon::now('Europe/Madrid');
        $this->cronLog->save();
    }

    public function getNewsNotifications()
    {
        $newsNotifications = array();
        $notifications = \DB::table('notifications_orders')->where(array('status' => 'P', 'notification_order_is_active' => 1))->orderBy('idNotificationOrder', 'ASC')->limit(10)->get();
        foreach ($notifications as $notification) {
            $newsNotifications[] = NotificationOrder::where('idNotificationOrder', $notification->idNotificationOrder)->first();
        }
        unset($notifications);
        return $newsNotifications;
    }
}
