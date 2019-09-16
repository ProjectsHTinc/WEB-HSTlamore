<?php
ob_start();
	error_reporting(0);
    include('Crypto.php');
    include("connection.php");

	$workingKey = '7FB71109FBD688214546E4C2BFF63D8B';		//Working Key should be provided here.
	$encResponse = $_POST["encResp"];			            //This is the response sent by the CCAvenue Server
	$rcvdString = decrypt($encResponse,$workingKey);		//Crypto Decryption used as per the specified working key.
	$order_status = "";
	$decryptValues = explode('&', $rcvdString);
	$dataSize = sizeof($decryptValues);


	// echo "<table cellspacing=4 cellpadding=4>";
 	// for($i = 0; $i < $dataSize; $i++)
 	// {
 	// 	$information=explode('=',$decryptValues[$i]);
 	//     	echo '<tr><td>'.$information[0].'</td><td>'.$information[1].'</td></tr>';
 	//     		if($i==2)	echo $bank=$information[2];
 	//     	echo '<tr><td>'.$information[$i].'</td><td>'.$information[$i].'</td></tr>';
 	// }
 	// echo "</table><br>";



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


    	$string = $orderid;
        $result = explode("-", $string);
        $order_id=$result[0];
        $user_id= $result[1];
        $service_id=$result[2];

       $sQuery = "INSERT INTO online_payment_history (order_id,user_id,track_id,bank_ref_no,order_status,failure_message,payment_mode,card_name,status_code,status_message,currency,amount,billing_name,billing_address, billing_city,billing_state,billing_zip,billing_country,billing_tel,billing_email,delievery_name,delievery_address,delievery_city,delievery_state,delievery_zip,delievery_country,delievery_tel,merch_param1,merch_param2,merch_param3,merch_param4,merch_param5,vault,offer_type,offer_code,discount_value, mer_amt,eci_value,retry,response_code,billing_notes,trans_date,bin_country) VALUES ('$orderid','$user_id','$track_id','$bank_ref_no','$order_status','$failure_message','$payment_mode','$card_name','$status_code','$status_message','$currency','$amount','$billing_name','$billing_address','$billing_city','$billing_state','$billing_zip','$billing_country','$billing_tel','$billing_email','$delievery_name','$delievery_address','$delievery_city','$delievery_state','$delievery_zip','$delievery_country','$delievery_tel','$merch_param1','$merch_param2','$merch_param3','$merch_param4','$merch_param5','$vault','$offer_type','$offer_code','$discount_value','$mer_amt','$eci_value','$retry','$response_code','$billing_notes','$transdate','$bin_country')";
       $objRs  = mysql_query($sQuery) or die("Could not select Query ");
        

    	if($order_status=="Success")
    	{
                /* $enc_order_id = base64_encode($order_id);
                $sbooking_date = date("d-m-Y", strtotime($booking_date));
                $transaction_date = date("d-m-Y H:i:s"); 
                $subject = "Heyla App Ticket Booking";
                $email_message ='<html>
                    			 <body>
                    			    <p>Order Id : '.$order_id.'</p>
                    				<p>Event Name : '.$event_name.'</p>
                    				<p>Plan Name : '.$plan_name.'</p>
                    				<p>No. of Seats : '.$number_of_seats.'</p>
                    				<p>Booking Date : '.$sbooking_date.' '.$show_time.'</p>
                    				<p>Transaction Date : '.$transdate.'</p>
                    				<p>More detail please <a href="https://goo.gl/A6DGuZ">login</a></p>
                    			 </body>
                    			 </html>';
                
                
                $Message = "Hi Customer, Booking Id : ".$order_id. "Seats : ".$plan_name."," .$number_of_seats." for ".$event_name." on ".$sbooking_date." ".$show_time.". Transaction Date : ".$transdate." More detail https://goo.gl/A6DGuZ";
              //Your authentication key
                $authKey = "191431AStibz285a4f14b4";
                
                //Multiple mobiles numbers separated by comma
                $mobileNumber = "$created_mobile,$user_mobile";
                
                //Sender ID,While using route4 sender id should be 6 characters long.
                $senderId = "HEYLAA";
                
                //Your message to send, Add URL encoding here.
                $message = urlencode($Message);
                
                //Define route 
                $route = "transactional";
                
                //Prepare you post parameters
                $postData = array(
                    'authkey' => $authKey,
                    'mobiles' => $mobileNumber,
                    'message' => $message,
                    'sender' => $senderId,
                    'route' => $route
                );
                
                //API URL
                $url="https://control.msg91.com/api/sendhttp.php";
                
                // init the resource
                $ch = curl_init();
                curl_setopt_array($ch, array(
                    CURLOPT_URL => $url,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_POST => true,
                    CURLOPT_POSTFIELDS => $postData
                    //,CURLOPT_FOLLOWLOCATION => true
                ));
                
                
                //Ignore SSL certificate verification
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                
                
                //get response
                $output = curl_exec($ch);
                
                //Print error if any
                if(curl_errno($ch))
                {
                    echo 'error:' . curl_error($ch);
                }
                
                curl_close($ch);
                
                
                $sender_emails = $created_email.','.$user_email;
                
                // Set content-type header for sending HTML email
        		$headers = "MIME-Version: 1.0" . "\r\n";
        		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        		// Additional headers
        		$headers .= 'From: Heyla App<hello@heylaapp.com>' . "\r\n";
        		mail($sender_emails,$subject,$email_message,$headers);
        		
                
                
                
            	$sQuery = "INSERT INTO booking_history (order_id,event_id,plan_id,plan_time_id,user_id,number_of_seats,booking_date,total_amount,created_at) VALUES ('". $order_id . "','". $event_id . "','". $plan_id . "','". $plan_time_id . "','". $user_id . "','". $number_of_seats . "','". $booking_date . "','". $total_amount . "','". $created_at . "')";
                $insert_query = mysql_query($sQuery) or die("Could not select Query ");
            	
            	$activity_sql = "INSERT INTO user_activity (date,user_id,event_id,rule_id,activity_detail) VALUES (NOW(),'". $user_id . "','". $event_id . "','5','Booking')";
                $insert_activity = mysql_query($activity_sql) or die("Could not select Query ");
    
                $activity_points = "UPDATE user_points_count SET booking_count  = booking_count+1,booking_points=booking_points+20,total_points=total_points+20 WHERE user_id ='$user_id'";
                $insert_points = mysql_query($activity_points) or die("Could not select Query "); */
                
                
                
           header("Location: https://heylaapp.com/home/order_confirm/");
                
    	}

    	
    	if($order_status=="Aborted")
    	{
    	   header("Location: https://heylaapp.com/home/paymenterror/");
    	}
    	
    	if($order_status=="Failure")
    	{
    	    header("Location: https://heylaapp.com/home/paymenterror/");
    	}
    	
    	if($order_status=="Invalid")
    	{
    	    header("Location: https://heylaapp.com/home/paymenterror/");

    	}

?>