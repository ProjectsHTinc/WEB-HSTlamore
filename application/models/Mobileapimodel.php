<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mobileapimodel extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }


//#################### Email ####################//

	public function sendMail($to,$subject,$email_message)
	{
		// Set content-type header for sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		// Additional headers
		$headers .= 'From: Heyla App<hello@heylaapp.com>' . "\r\n";
		mail($to,$subject,$email_message,$headers);
	}

//#################### Email End ####################//


//#################### Notification ####################//

	public function sendNotification($gcm_key,$Title,$Message,$mobiletype)
	{
		if ($mobiletype =='1'){

		    require_once 'assets/notification/Firebase.php';
            require_once 'assets/notification/Push.php';

            $device_token = explode(",", $gcm_key);
            $push = null;

//        //first check if the push has an image with it
		    $push = new Push(
					$Title,
					$Message,
					'http://heylaapp.com/assets/notification/images/events.jpg'
				);

// 			//if the push don't have an image give null in place of image
 			// $push = new Push(
 			// 		'HEYLA',
 			// 		'Hi Testing from maran',
 			// 		null
 			// 	);

    		//getting the push from push object
    		$mPushNotification = $push->getPush();

    		//creating firebase class object
    		$firebase = new Firebase();

    	foreach($device_token as $token) {
    		 $firebase->send(array($token),$mPushNotification);
    	}

		} else {

			$device_token = explode(",", $gcm_key);
			$passphrase = 'hs123';
		    $loction ='assets/notification/heylaapp.pem';

			$ctx = stream_context_create();
			stream_context_set_option($ctx, 'ssl', 'local_cert', $loction);
			stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

			// Open a connection to the APNS server
			$fp = stream_socket_client('ssl://gateway.sandbox.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);

			if (!$fp)
				exit("Failed to connect: $err $errstr" . PHP_EOL);

			$body['aps'] = array(
				'alert' => array(
					'body' => $Message,
					'action-loc-key' => 'Heyla App',
				),
				'badge' => 2,
				'sound' => 'assets/notification/oven.caf',
				);

			$payload = json_encode($body);

			foreach($device_token as $token) {

				// Build the binary notification
    			$msg = chr(0) . pack("n", 32) . pack("H*", str_replace(" ", "", $token)) . pack("n", strlen($payload)) . $payload;
        		$result = fwrite($fp, $msg, strlen($msg));
			}

				fclose($fp);
		}
	}

//#################### Notification End ####################//


//#################### SMS ####################//

	public function sendSMS($Phoneno,$Message)
	{
        //Your authentication key
        $authKey = "191431AStibz285a4f14b4";

        //Multiple mobiles numbers separated by comma
        $mobileNumber = "$Phoneno";

        //Sender ID,While using route4 sender id should be 6 characters long.
        $senderId = "LAMORE";

        //Your message to send, Add URL encoding here.
        $message = urlencode($Message);

        //Define route
        $route = "transactional";

        //Prepare you post parameters
        $postData = array(
            'authkey'=> $authKey,
            'mobiles'=> $mobileNumber,
            'message'=> $message,
            'sender'=> $senderId,
            'route'=> $route
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
	}

//#################### SMS End ####################//

//#################### Main Login ####################//
	public function Login($username,$password,$mob_key,$mobile_type)
	{
	    $cust_id = '';

		$sql = "SELECT * FROM customers WHERE password = md5('".$password."') AND status = 'Active' AND (phone_number = '$username' OR email = '$username')";

		$user_result = $this->db->query($sql);
		$ress = $user_result->result();
		if($user_result->num_rows()>0)
		{
			foreach ($user_result->result() as $rows)
			{
			  $cust_id = $rows->id;
			  $login_count = $rows->login_count+1;
			}

			$sql = "SELECT
					A.id AS customer_id,
					A.phone_number,
					A.email,
					B.first_name,
					B.last_name,
					B.birth_date,
					B.gender,
					B.profile_picture,
					B.newsletter_status,
					A.login_count,
					A.last_login
				FROM
					customers A,
					customer_details B
				WHERE
					A.id = B.customer_id AND A.id = '$cust_id'";
			$cust_result = $this->db->query($sql);
			$ress = $cust_result->result();

			if($cust_result->num_rows()>0)
			{
				foreach ($cust_result->result() as $rows)
				{
				  $profile_picture = $rows->profile_picture;
				}

				if ($profile_picture != ''){
			        $profile_picture = base_url().'assets/front/profile/'.$profile_picture;
			    }else {
			         $profile_picture = '';
			    }

				$userData  = array(
							"customer_id" => $ress[0]->customer_id,
							"phone_number" => $ress[0]->phone_number,
							"email" => $ress[0]->email,
							"first_name" => $ress[0]->first_name,
							"last_name" => $ress[0]->last_name,
							"birth_date" => $ress[0]->birth_date,
							"gender" => $ress[0]->gender,
							"profile_picture" => $profile_picture,
							"newsletter_status" => $ress[0]->newsletter_status,
							"login_count" => $ress[0]->login_count,
							"last_login" => $ress[0]->last_login
				);
			}
				$update_sql = "UPDATE customers SET last_login=NOW(),login_count='$login_count' WHERE id='$cust_id'";
				$update_result = $this->db->query($update_sql);

				$gcmQuery = "SELECT * FROM cus_notification_master WHERE mob_key like '%" .$mob_key. "%' LIMIT 1";
				$gcm_result = $this->db->query($gcmQuery);
				$gcm_ress = $gcm_result->result();

				if($gcm_result->num_rows()==0)
				{
					$sQuery = "INSERT INTO cus_notification_master (cus_id,mob_key,mobile_type,created_at ) VALUES ('". $cust_id . "','". $mob_key . "','". $mobile_type . "',now())";
					$update_gcm = $this->db->query($sQuery);
				}

    				$response = array("status" => "Success", "msg" => "Login Successfully", "userData" => $userData);
    				return $response;
		} else {

					$response = array("status" => "Error", "msg" => "Invalid login");
					return $response;
		}
	}

//#################### Main Login End ####################//


//#################### User Registration ####################//
	public function cust_registration($name,$phone,$email,$password,$newsletter,$mob_key,$mobile_type)
	{
	    $cust_id = "";

	    $sql = "SELECT * FROM customers WHERE email ='".$email."' OR phone_number = '".$phone."'";
		$user_result = $this->db->query($sql);
		$ress = $user_result->result();

		if($user_result->num_rows() == 0)
		{
	    	$pwd = md5($password);
			$create = "INSERT INTO customers(name,phone_number,email,password,status) VALUES('$name','$phone','$email','$pwd','Active')";
			$res=$this->db->query($create);
			$last_id=$this->db->insert_id();

			$user_details="INSERT INTO customer_details(customer_id,first_name,newsletter_status) VALUES('$last_id','$name','$newsletter')";
			$result=$this->db->query($user_details);

			$update_sql = "UPDATE customers SET created_at =NOW(),created_by ='$last_id' WHERE id='$last_id'";
			$update_result = $this->db->query($update_sql);

			$gcmQuery = "SELECT * FROM cus_notification_master WHERE mob_key like '%" .$mob_key. "%' LIMIT 1";
			$gcm_result = $this->db->query($gcmQuery);
			$gcm_ress = $gcm_result->result();

			if($gcm_result->num_rows()==0)
			{
				$sQuery = "INSERT INTO cus_notification_master (cus_id,mob_key,mobile_type,created_at ) VALUES ('". $last_id . "','". $mob_key . "','". $mobile_type . "',now())";
				$update_gcm = $this->db->query($sQuery);
			}


			//$subject = "Customer Registration";
			//$htmlContent = 'Dear '. $name . '<br><br>' .  'Username : '. $email .'<br>Password : '. $pwdconfirm .'<br><br><br>Regards<br>LittleAMore';
			//$this->sendMail($email,$subject,$htmlContent);

			$response = array("status" => "Success", "msg" => "Signup Successfully");
		} else {
		    $response = array("status" => "Error", "msg" => "User Already Register");
		}
	    return $response;
	}


//#################### User Registration End ####################//

}
?>
