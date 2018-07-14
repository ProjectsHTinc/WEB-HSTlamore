<?php

Class Customermodel extends CI_Model
{

  public function __construct()
  {
      parent::__construct();

  }

   function exist_email($email){
      $check_email="SELECT * FROM customers WHERE email='$email'";
     $res=$this->db->query($check_email);
     if($res->num_rows()==0){
       echo "true";
     }else{
       echo "false";
     }
   }
   function exist_mobile($mobile){
     $check_email="SELECT * FROM customers WHERE phone_number='$mobile'";
     $res=$this->db->query($check_email);
     if($res->num_rows()==0){
       echo "true";
     }else{
       echo "false";
     }
   }

	function customer_registration($name,$mobile,$email,$password){
		$pwd = md5($password);
	   
		 $check_username="SELECT * FROM user_master WHERE email_id='$email'";
		 $res=$this->db->query($check_username);
		 if($res->num_rows()==1)
		 {
		   echo "Already Registered";
		 }else{
		   $create="INSERT INTO user_master (user_name,mobile_no,email_id,password,user_role,email_verify,mobile_verify,status) VALUES('$name','$mobile','$email','$pwd','3','N','N','Y')";
		   $res=$this->db->query($create);
		   $last_id=$this->db->insert_id();
		   $user_points_query="INSERT INTO user_points_count(user_id) VALUES('$last_id')";
		   $exc_user_points=$this->db->query($user_points_query);
		   $user_details="INSERT INTO user_details (user_id,newsletter_status) VALUES('$last_id','Y')";
			$result=$this->db->query($user_details);
			$s=$email;
				$encrypt_email= base64_encode($s);
	
			if($result){
			  $to=$email;
			  $subject="Welcome to Heyla App";
			  $htmlContent = '
			  <html>
			  <head>
			  <title></title>
				 </head>
				 <body style="background-color:#E4F1F7;"><div style="background-image: url('.base_url().'assets/front/images/email_1.png);height:700px;margin: auto;width: 100%;background-repeat: no-repeat;">
					<div  style="padding:50px;width:400px;"><p>Dear '.$name.'</p>
				   <p style="font-size:20px;">Welcome to
					<center><img src="'.base_url().'assets/front/images/heyla_b.png" style="width:120px;"></center>
				   </p>
				   <p style="margin-left:50px;"> <br>
				   To allow us to confirm the validity of your email address,click this verification link. <center>   <a href="'. base_url().'home/emailverfiy/'.$encrypt_email.'" target="_blank"style="background-color: #478ECC;    padding: 12px;    text-decoration: none;    color: #fff;    border-radius: 20px;">Verfiy  Here</a></center>  </p>
				   <p style="font-size:20px;">Thank you and enjoy, <br>
					 The Heyla Team
					 </p>
				   </body>
				</html>';
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			// Additional headers
			$headers .= 'From: heylapp<info@heylapp.com>' . "\r\n";
			$sent= mail($to,$subject,$htmlContent,$headers);
			  echo "verify";
			}else{
			  echo "failed";
			}
		 }


   }


}
