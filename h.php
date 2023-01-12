<?php
$userChoice=null;
$ch= curl_init();

curl_setopt($ch, CURLOPT_URL,'http://localhost/Payment/PaypalCheckout/');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
$respo = curl_exec($ch); 


echo "$respo";
 

curl_close($ch);