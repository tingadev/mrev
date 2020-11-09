<?php
namespace Payment;
use Omnipay\Omnipay;
class Payment
{
   /**
    * @return mixed
    */
   public function gateway()
   {
       $gateway = Omnipay::create('PayPal_Express');
       $gateway->setUsername("tingavu_api1.gmail.com");
       $gateway->setPassword("Q9MYRMLFFPA2HMCC");
       $gateway->setSignature("Aqla5ZDBsH-zDTAifrJfUq1Y-WOxA64VzsqGCWpnK8DzHVOCPes5gIwO");
       $gateway->setTestMode(true);
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
   public function getCancelUrl($order = "")
   {
       return $this->route('http://phpstack-275615-1077014.cloudwaysapps.com/cancel.php', $order);
   }
   /**
    * @param $order
    */
   public function getReturnUrl($order = "")
   {
       return $this->route('http://phpstack-275615-1077014.cloudwaysapps.com/return.php', $order);
   }
   public function route($name, $params)
   {
       return $name; // ya change hua hai
   }
}