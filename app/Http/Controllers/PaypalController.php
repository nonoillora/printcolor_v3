<?php

namespace App\Http\Controllers;

use App\Paypal;
use Illuminate\Http\Request;
use App\Pedido;
use App\Payer;
use Browser;
use Uuid;

class PaypalController extends Controller
{
    /**
     * @param Request $request
     */
    public function form(Request $request, $order_id = null)
    {
        $order_id = $order_id ?: encrypt(1);

        $order = Pedido::findOrFail($order_id);

        return view('paypal', array('title' => 'test paypal', 'order' => $order));
    }

    /**
     * @param $order_id
     * @param Request $request
     */
    public function checkout($order_id, Request $request)
    {
        //nos llegaria el numIdentificacionPedido encriptado, lo descrincriptamos y recuperamos el pedido...
        $order = Pedido::where('numIdentificacionPedido', decrypt($order_id))->first();

        $paypal = new Paypal;

        $response = $paypal->purchase([
            'amount' => $paypal->formatAmount(0.01/*$order->totalPedido*/),
            'transactionId' => $order->numIdentificacionPedido,
            'currency' => 'EUR',
            'cancelUrl' => $paypal->getCancelUrl($order),
            'returnUrl' => $paypal->getReturnUrl($order),
        ]);

        if ($response->isRedirect()) {
            $response->redirect();
        }
        //chec if th client try to pay before....
        if($response->getData()['L_SHORTMESSAGE0']=="Duplicate invoice"){
            $order->numIdentificacionPedido = Uuid::generate();
            $order->save();
            return $this->checkout(['order' => encrypt($order->numIdentificacionPedido),$request]);

        }
        dd($response,$response->getMessage());
        return redirect()->back()->with([
            'message' => $response->getMessage(),
        ]);
    }

    /**
     * @param $order_id
     * @param Request $request
     * @return mixed
     */
    public function completed($order_id, Request $request)
    {
        $order = Pedido::where('numIdentificacionPedido', $order_id)->first();

        $paypal = new Paypal;

        $response = $paypal->complete([
            'amount' => $paypal->formatAmount($order->totalPedido),
            'transactionId' => $order->numIdentificacionPedido,
            'currency' => 'EUR',
            'cancelUrl' => $paypal->getCancelUrl($order),
            'returnUrl' => $paypal->getReturnUrl($order),
            'notifyUrl' => $paypal->getNotifyUrl($order),
        ]);

        if ($response->isSuccessful()) {
            $data = $response->getData();
            $this->savePayer($order->idPedido, $request, $data);
            return redirect()->action(
                'PedidoController@orderPaypalCompleted', ['idPedido' => $order->idPedido]
            );
        }

        dd($response,$response->getMessage());
        return redirect()->back()->with([
            'message' => $response->getMessage(),
        ]);
    }

    /**
     * @param $order_id
     */
    public function cancelled($order_id)
    {
        $pedido = Pedido::join('clientes', 'pedidos.idCliente', '=', 'clientes.id')
            ->where('numIdentificacionPedido', 'like', '%' . $order_id . '%')
            ->first();
        //Check the entity exist..
        if (empty($pedido)) {
            return redirect()->to('/');
        }
        //Check the entity is paid..
        if($pedido->isPaid && isset($pedido->paid_at)){
            return redirect()->to('/');
        }
        return view('pedidos/cancelarClientePedido', ['title' => "Cancelar pedido", 'pedido' => $pedido]);

    }

    /**
     * @param $order_id
     * @param $env
     */
    public function webhook($order_id, $env)
    {
        // to do with next blog post
    }

    public function savePayer($idPedido, Request $request, $paypal_data)
    {
        if (Browser::deviceFamily() == 'Unknown') {
            $deviceFamily = "";
        } else {
            $deviceFamily = Browser::deviceFamily();
        }
        $payer = array(
            'idPedido' => $idPedido,
            'PayerID' => $request->get('PayerID'),
            'statusTransaction' => $paypal_data['PAYMENTINFO_0_PAYMENTSTATUS'],
            'pendingReason' => $paypal_data['PAYMENTINFO_0_PENDINGREASON'],
            'reasonCode' => $paypal_data['PAYMENTINFO_0_REASONCODE'],
            'amountPay' => $paypal_data['PAYMENTINFO_0_AMT'],
            'browser' => Browser::browserFamily(),
            'version_browser' => Browser::browserVersion(),
            'deviceFamily' => $deviceFamily,
            'deviceModel' => Browser::deviceModel(),
            'platform' => Browser::platformName()
        );
        $payer = New Payer($payer);
        $payer->save();
    }
}