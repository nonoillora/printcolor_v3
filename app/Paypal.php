<?php

namespace App;

use Omnipay\Omnipay;

/**
 * Class PayPal
 * @package App
 */
class Paypal
{
    /**
     * @return mixed
     */
    public function gateway()
    {
        $gateway = Omnipay::create('PayPal_Express');

        $gateway->setUsername(config('gateways.paypal.username'));
        $gateway->setPassword(config('gateways.paypal.password'));
        $gateway->setSignature(config('gateways.paypal.signature'));
        $gateway->setTestMode(config('gateways.paypal.sandbox'));

        return $gateway;
    }

    /**
     * @param array $parameters
     * @return mixed
     */
    public function purchase(array $parameters)
    {
        $response = $this->gateway()
            ->purchase($parameters)
            ->send();

        return $response;
    }

    /**
     * @param array $parameters
     */
    public function complete(array $parameters)
    {
        $response = $this->gateway()
            ->completePurchase($parameters)
            ->send();

        return $response;
    }

    /**
     * @param $amount
     */
    public function formatAmount($amount)
    {
        return number_format($amount, 2, '.', '');
    }

    /**
     * @param $order
     */
    public function getCancelUrl($order)
    {
        return route('paypal.checkout.cancelled', $order->numIdentificacionPedido);
    }

    /**
     * @param $order
     */
    public function getReturnUrl($order)
    {
        return route('paypal.checkout.completed', $order->numIdentificacionPedido);
    }

    /**
     * @param $order
     */
    public function getNotifyUrl($order)
    {
        $env = config('gateways.payal.sandbox') ? "sandbox" : "live";

        return route('webhook.paypal.ipn', [$order->id, $env]);
    }
}