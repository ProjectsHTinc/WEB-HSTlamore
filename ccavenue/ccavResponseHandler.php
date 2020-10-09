<?php
include('Crypto.php');
include("connection.php");
	error_reporting(0);
	
	$workingKey='3A5F7172E7947B223888492581B32ED2';		//Working Key should be provided here.
	$encResponse=$_POST["encResp"];			//This is the response sent by the CCAvenue Server
	$rcvdString=decrypt($encResponse,$workingKey);		//Crypto Decryption used as per the specified working key.
	$order_status="";
	$decryptValues=explode('&', $rcvdString);
	$dataSize=sizeof($decryptValues);

/*
	echo "<center>";

	for($i = 0; $i < $dataSize; $i++) 
	{
		$information=explode('=',$decryptValues[$i]);
		if($i==3)	$order_status=$information[1];
	}


	echo "<table cellspacing=4 cellpadding=4>";
	for($i = 0; $i < $dataSize; $i++) 
	{
		$information=explode('=',$decryptValues[$i]);
	    	echo '<tr><td>'.$information[0].'</td><td>'.$information[1].'</td></tr>';
	}
	echo "</table><br>";
	echo "</center>";
*/
	for($i = 0; $i < $dataSize; $i++) 
	{
		$information=explode('=',$decryptValues[$i]);
		if($i==0)   $orderid=$information[1];
		if($i==1)   $track_id=$information[1];
		if($i==2)	$bank_ref_no=$information[1];
		if($i==3)	$order_status=trim($information[1]);
		if($i==4)   $failure_message=$information[1];
		if($i==5)   $payment_mode=$information[1];	
		if($i==6)   $card_name=$information[1];	
		if($i==7)   $status_code=$information[1];
		if($i==8)   $status_message=$information[1];
		if($i==9)   $currency=$information[1];
		if($i==10)  $amount=$information[1];
		if($i==11)  $billing_name=$information[1];
		if($i==12)  $billing_address=$information[1];
		if($i==13)  $billing_city=$information[1];
		if($i==14)  $billing_state=$information[1];
		if($i==15)  $billing_zip=$information[1];
		if($i==16)  $billing_country=$information[1];
		if($i==17)  $billing_tel=$information[1];
		if($i==18)  $billing_email=$information[1];
		if($i==19)  $delievery_name=$information[1];
		if($i==20)  $delievery_address=$information[1];
		if($i==21)  $delievery_city=$information[1];
		if($i==22)  $delievery_state=$information[1];
		if($i==23)  $delievery_zip=$information[1];
		if($i==24)  $delievery_country=$information[1];
		if($i==25)  $delievery_tel=$information[1];
		if($i==26)  $merch_param1=$information[1];
		if($i==27)  $merch_param2=$information[1];
		if($i==28)  $merch_param3=$information[1];
		if($i==29)  $merch_param4=$information[1];
		if($i==30)  $merch_param5=$information[1];
		if($i==31)  $vault=$information[1];
		if($i==32)  $offer_type=$information[1];
		if($i==33)  $offer_code=$information[1];
		if($i==34)  $discount_value=$information[1];
		if($i==35)  $mer_amt=$information[1];
		if($i==36)  $eci_value=$information[1];
		if($i==37)  $retry=$information[1];
		if($i==38)  $response_code=$information[1];
		if($i==39)  $billing_notes=$information[1];
		if($i==40)  $transdate=$information[1];
		if($i==41)  $bin_country=$information[1];	
	}
	
	if($order_status==="Success")
	{
		//echo "<br>Thank you for shopping with us. Your credit card has been charged and your transaction is successful. We will be shipping your order to you soon.";
		
		$query = "UPDATE purchase_order SET status = 'Success' WHERE order_id = '" .$orderid. "'";
	    $result = $mysqli->query($query);
	    
	    
	    header("Location: https://www.happysanztech.com/lamore/cust_orders/");
        exit();
		
	}
	else if($order_status==="Aborted")
	{
		echo "<br>Thank you for shopping with us.We will keep you posted regarding the status of your order through e-mail";
	
	}
	else if($order_status==="Failure")
	{
		echo "<br>Thank you for shopping with us.However,the transaction has been declined.";
	}
	else
	{
		echo "<br>Security Error. Illegal access detected";
	
	}
?>
