<?php

Class Homemodel extends CI_Model
{

  public function __construct()
  {
      parent::__construct();

  }

//#################### Email ####################//

	public function sendMail($email,$subject,$email_message)
	{
		// Set content-type header for sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		// Additional headers
		$headers .= 'From: Webmaster<love@littleamore.in>' . "\r\n";
		mail($email,$subject,$email_message,$headers);
	}

//#################### Email End ####################//



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
	}

//#################### SMS End ####################//

	function random_password( $length = 8 ) {
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
		$password = substr( str_shuffle( $chars ), 0, $length );
		return $password;
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
   
   function exist_email_customer($email,$cust_id){
		$check_email="SELECT * FROM customers WHERE email='$email' AND id!='$cust_id'";
		$res=$this->db->query($check_email);
		
		if($res->num_rows()!=0){
			echo "false";
		}else{
			echo "true";
		}
   }
   function exist_mobile_customer($mobile,$cust_id){
		$check_email="SELECT * FROM customers WHERE phone_number='$mobile' AND id!='$cust_id'";
		$res=$this->db->query($check_email);
		
		if($res->num_rows()!=0){
			echo "false";
		}else{
			echo "true";
		}
   }

 	function exist_username($username){
		$check_email="SELECT * FROM customers WHERE phone_number='$username' OR email = '$username'";
		$res=$this->db->query($check_email);
		
		if($res->num_rows()!=0){
			echo "true";
		}else{
			echo "false";
		}
   }


	function customer_login($username,$password){
		
			$pwd = md5($password);
			
			$check_user = "SELECT * FROM customers WHERE password = '$pwd' AND status = 'Active' AND (phone_number = '$username' OR email = '$username')";
			$res=$this->db->query($check_user);

			if($res->num_rows()>0){
				foreach($res->result() as $rows) { 
					$cust_id = $rows->id;
					$login_count = $rows->login_count+1;
					$cust_name = $rows->name;
					$cust_mobile = $rows->phone_number;
					$cust_email = $rows->email;
				}
				 	$data =  array("cust_id"=>$cust_id,"cust_name" => $cust_name,"cust_mobile"=>$cust_mobile,"cust_email"=>$cust_email);
   	            	$this->session->set_userdata($data);
					
					$update_sql = "UPDATE customers SET last_login =NOW(),login_count='$login_count' WHERE id='$cust_id'";
				 	$update_result = $this->db->query($update_sql);
					
					$check_address = "SELECT * FROM cus_address WHERE cus_id = '$cust_id' AND address_mode = '1'";
					$add_res=$this->db->query($check_address);
					if($add_res->num_rows()>0){
						foreach($add_res->result() as $add_rows) { 
							$address_data =  array("address_id"=>$add_rows->id,"address_country_id"=>$add_rows->country_id,"address_state"=>$add_rows->state,"address_city"=>$add_rows->city,"address_pincode"=>$add_rows->pincode,"address_house_no"=>$add_rows->house_no,"address_street"=>$add_rows->street,"address_landmark"=>$add_rows->landmark,"address_full_name"=>$add_rows->full_name,"address_mobile"=>$add_rows->mobile_number,"address_mobile_alter"=>$add_rows->alternative_mobile_number,"address_email"=>$add_rows->email_address,"address_type_id "=>$add_rows->address_type_id);
						}
						$this->session->set_userdata($address_data);
					}
					
				echo "login";
					}else{
				echo "error";
			}
   }
   
   function customer_logindetails($cust_id){
		$sql = "SELECT * FROM customers WHERE id='$cust_id'";
		$resu=$this->db->query($sql);
		$res=$resu->result();
		return $res;
   }
   
    function customer_details($cust_id){
		$sql = "SELECT * FROM customer_details WHERE id='$cust_id'";
		$resu=$this->db->query($sql);
		$res=$resu->result();
		return $res;
   }
   
	function customer_registration($name,$mobile,$email,$pwdconfirm,$newsletter){
		
			$pwd = md5($pwdconfirm);
	   
			$create="INSERT INTO customers(name,phone_number,email,password,status) VALUES('$name','$mobile','$email','$pwd','Active')";
			$res=$this->db->query($create);
			$last_id=$this->db->insert_id();
						
			$user_details="INSERT INTO customer_details(customer_id,first_name,newsletter_status) VALUES('$last_id','$name','$newsletter')";
			$result=$this->db->query($user_details);
			
			$update_sql = "UPDATE customers SET created_at =NOW(),created_by ='$last_id' WHERE id='$last_id'";
			$update_result = $this->db->query($update_sql);
					
			//$subject = "Customer Registration";
			//$htmlContent = 'Dear '. $name . '<br><br>' .  'Username : '. $email .'<br>Password : '. $pwdconfirm .'<br><br><br>Regards<br>LittleAMore';
			//$this->sendMail($email,$subject,$htmlContent);
						
			echo "register";
   }
   
   function customer_update($cust_id,$fname,$lname,$mobile,$email,$dob,$gender,$cust_pic,$newsletter){
	   
	   		$customer_update = "UPDATE customers SET name = '$fname',phone_number = '$mobile',email ='$email',updated_at =now(), updated_by = '$cust_id' WHERE id  ='$cust_id'";
			$cust_update = $this->db->query($customer_update);

			if ($cust_pic !="") {
				echo $customer_details_update = "UPDATE customer_details SET first_name = '$fname',last_name = '$lname',birth_date  = '$dob',gender  ='$gender',newsletter_status ='$newsletter',profile_picture = '$cust_pic',updated_at =now(), updated_by = '$cust_id' WHERE id  ='$cust_id'";
			} else {
				echo $customer_details_update = "UPDATE customer_details SET first_name = '$fname',last_name = '$lname',birth_date = '$dob',gender  ='$gender',newsletter_status ='$newsletter',updated_at =now(),updated_by = '$cust_id' WHERE id  ='$cust_id'";
			}
			$cust_detail_update = $this->db->query($customer_details_update);
			 
			$redirect_url = base_url()."cust_details/";
			header("Location: ".$redirect_url);
   }


	function get_cust_address($cust_id){
		$sql="SELECT A.*, B.country_name, C.address_type FROM cus_address A, country_master B, address_master C WHERE A.cus_id = '$cust_id' AND A.country_id = B.id AND A.address_type_id  = C.id AND A.status = 'Active' ORDER BY A.address_mode DESC";
	  	$resu=$this->db->query($sql);
	  	$res=$resu->result();
	  	return $res;
   }
   
   
   function cust_default_address($cust_id,$address_id){
			$check_user = "SELECT * FROM cus_address WHERE cus_id = '$cust_id'";
			$res=$this->db->query($check_user);

			if($res->num_rows()>0){
				foreach($res->result() as $rows) { 
					$add_id = $rows->id;
					
					$c_update = "UPDATE cus_address SET address_mode = '0',updated_at =now(), updated_by = '$cust_id' WHERE id  ='$add_id'";
					$cu_update = $this->db->query($c_update);
				}
			}
			
			$customer_update = "UPDATE cus_address SET address_mode = '1',updated_at =now(), updated_by = '$cust_id' WHERE id = '$address_id' ";
			$cust_update = $this->db->query($customer_update);
			
			
			$check_address = "SELECT * FROM cus_address WHERE cus_id = '$cust_id' AND id = '$address_id'";
			$add_res=$this->db->query($check_address);
					if($add_res->num_rows()>0){
						foreach($add_res->result() as $add_rows) { 
							$address_data =  array("address_id"=>$add_rows->id,"address_country_id"=>$add_rows->country_id,"address_state"=>$add_rows->state,"address_city"=>$add_rows->city,"address_pincode"=>$add_rows->pincode,"address_house_no"=>$add_rows->house_no,"address_street"=>$add_rows->street,"address_landmark"=>$add_rows->landmark,"address_full_name"=>$add_rows->full_name,"address_mobile"=>$add_rows->mobile_number,"address_mobile_alter"=>$add_rows->alternative_mobile_number,"address_email"=>$add_rows->email_address,"address_type_id "=>$add_rows->address_type_id);
						}
						$this->session->set_userdata($address_data);
					}
					
			$redirect_url = base_url()."cust_address/";
			header("Location: ".$redirect_url);
   }
   
   function cust_address_delete($address_id,$cust_id){
			
			$del_address = "DELETE FROM cus_address WHERE id = '$address_id'";
			$res=$this->db->query($del_address);
						
			$check_user = "SELECT * FROM cus_address WHERE cus_id = '$cust_id' LIMIT 1";
			$res=$this->db->query($check_user);
			if($res->num_rows()>0){
				foreach($res->result() as $rows) { 
					$add_id = $rows->id;
					$c_update = "UPDATE cus_address SET address_mode = '1',updated_at =now(), updated_by = '$cust_id' WHERE id = '$add_id'";
					$cu_update = $this->db->query($c_update);
				}
			}
			$redirect_url = base_url()."cust_address/";
			header("Location: ".$redirect_url);
   }
   
   
	function cust_change_password($cust_id,$password){
			$pwd = md5($password);
			$customer_update = "UPDATE customers SET password = '$pwd',updated_at =now(), updated_by = '$cust_id' WHERE id  ='$cust_id'";
			$cust_update = $this->db->query($customer_update);
	
			$datas = $this->session->userdata();
			$this->session->unset_userdata($datas);
			$this->session->sess_destroy();
			 
			$redirect_url = base_url()."login/";
			header("Location: ".$redirect_url);
   }

	function reset_password($email){
		$check_email="SELECT * FROM customers WHERE email = '$email'";
		$res=$this->db->query($check_email);
		if($res->num_rows()>0){
			foreach($res as $result){ }
			$random_password = $this->random_password(8);
			$enc_password = md5($random_password);
			
			$password_sql = "UPDATE customers SET password = '$enc_password' WHERE email ='$email'";
			$reset_pass = $this->db->query($password_sql);
			
			//$subject = "Reset Password";
			//$htmlContent = 'Dear '. $email . '<br><br>' .  'New Password : '. $random_password .'<br><br><br>Regards<br>LittleAMore';
			//$this->sendMail($email,$subject,$htmlContent);
			
			echo "reset";
		}else{
			echo "error";
		}
   }
   
	function get_main_catmenu()
	{
		$sql="SELECT * FROM category_masters WHERE category_name !='Home' AND parent_id ='1' AND status = 'Active'";
		$resu=$this->db->query($sql);
		$res=$resu->result();
		return $res;
	}
		
	function get_sub_catmenu($cat_id)
	{
		$sql="SELECT * FROM category_masters WHERE category_name !='Home' AND parent_id ='$cat_id' AND status = 'Active'";
		$resu=$this->db->query($sql);
		$res=$resu->result();
		return $res;
	}
	

	function get_maincat_count()
	{
		$sql="SELECT category_masters.category_name,category_masters.id,COUNT(cat_id) AS count
			FROM
				category_masters
			LEFT JOIN products ON category_masters.id = products.cat_id
			WHERE
				category_masters.category_name != 'Home' AND parent_id ='1'
			GROUP BY
				id";
		$resu=$this->db->query($sql);
		$res=$resu->result();
		return $res;
	}
		
	function get_subcat_count($cat_id)
	{
		$sql = "SELECT category_masters.category_name,category_masters.id,COUNT(cat_id) AS count
			FROM
				category_masters
			LEFT JOIN products ON category_masters.id = products.cat_id
			WHERE
				category_masters.category_name != 'Home' AND parent_id ='$cat_id'
			GROUP BY
				id";
		$resu=$this->db->query($sql);
		$res=$resu->result();
		return $res;
	}
	
	function countrylist(){
		$sql="SELECT * FROM country_master WHERE status = 'Active'";
	  	$resu=$this->db->query($sql);
	  	$res=$resu->result();
	  	return $res;
   }
 	function categorylist(){
		$sql="SELECT * FROM category_masters WHERE category_name !='Home' AND status = 'Active'";
	  	$resu=$this->db->query($sql);
	  	$res=$resu->result();
	  	return $res;
   }
	function get_categorydetails($cat_id){
		$sql="SELECT * FROM category_masters WHERE id ='$cat_id' AND status = 'Active'";
	  	$resu=$this->db->query($sql);
	  	$res=$resu->result();
	  	return $res;
   }
   
   function get_cat_products($cat_id){
		$sql="SELECT * FROM products WHERE cat_id ='$cat_id' AND status = 'Active'";
	  	$resu=$this->db->query($sql);
	  	$res=$resu->result();
	  	return $res;
   }
   
    function get_subcat_products($cat_id){
		$sql="SELECT * FROM products WHERE sub_cat_id ='$cat_id' AND status = 'Active'";
	  	$resu=$this->db->query($sql);
	  	$res=$resu->result();
	  	return $res;
   }
   
       function get_productdetails($prod_id){
		$sql="SELECT * FROM products WHERE id ='$prod_id' AND status = 'Active'";
	  	$resu=$this->db->query($sql);
	  	$res=$resu->result();
	  	return $res;
   }
   function get_size($prod_id){
		$sql="SELECT B.id,B.attribute_value FROM product_combined A, attribute_masters B WHERE A.mas_size_id = B.attribute_type AND A.product_id = '$prod_id' AND B.attribute_type ='1' AND A.status = 'Active'";
	  	$resu=$this->db->query($sql);
	  	$res=$resu->result();
	  	return $res;
   }
      function get_colour($prod_id){
		$sql="SELECT B.id,B.attribute_name,B.attribute_value FROM product_combined A, attribute_masters B WHERE A.mas_size_id = B.attribute_type AND A.product_id = '$prod_id' AND B.attribute_type ='2' AND A.status = 'Active'";
	  	$resu=$this->db->query($sql);
	  	$res=$resu->result();
	  	return $res;
   }  
   
   	function newproducts(){
		$sql = "SELECT * FROM products WHERE status='Active' ORDER BY created_at LIMIT 10";
		$resu=$this->db->query($sql);
		$res=$resu->result();
		return $res;
   }
   
   function homebanner(){
		$sql = "SELECT * FROM products WHERE status='Active' ORDER BY created_at LIMIT 10";
		$resu=$this->db->query($sql);
		$res=$resu->result();
		return $res;
   }

    function bestsaleproducts(){
		$sql = "SELECT * FROM products WHERE status='Active' ORDER BY created_at LIMIT 10";
		$resu=$this->db->query($sql);
		$res=$resu->result();
		return $res;
   }
     
   function homepromotions(){
		$sql = "SELECT * FROM products WHERE status='Active' ORDER BY created_at LIMIT 10";
		$resu=$this->db->query($sql);
		$res=$resu->result();
		return $res;
   }
   
    function cart_list(){
		$guest_session = $this->session->userdata('guest_session');
		$sql = "SELECT * FROM product_cart WHERE browser_sess_id ='$guest_session'";
		$resu=$this->db->query($sql);
		$res=$resu->result();
		return $res;
   }
   
    function checkout_address($cust_id,$ncountry_id,$nname,$naddress1,$naddress2,$ntown,$nstate,$nzip,$nemail,$nphone,$nphone1,$nlandmark,$ncheckout_mess){
		
		$check_address="SELECT * FROM cus_address WHERE cus_id = '$cust_id'";
		$res=$this->db->query($check_address);
		if($res->num_rows()>0){
			$address_mode = '0';
		}else{
			$address_mode = '1';
		}
		$create = "INSERT INTO cus_address(cus_id,country_id,state,city,pincode,house_no,street,landmark,full_name,mobile_number,alternative_mobile_number,email_address,address_type_id,address_mode,status,created_at,created_by) VALUES('$cust_id','$ncountry_id','$nstate','$ntown','$nzip','$naddress1','$naddress2','$nlandmark','$nname','$nphone','$nphone1','$nemail','1','$address_mode','Active',now(),'$cust_id')";
		$res = $this->db->query($create);
		$address_id = $this->db->insert_id();
		
		$today = date("Ymd");
		$rand = strtoupper(substr(uniqid(sha1(time())),0,4));
		$order_id = $today . $rand;
		
		$res =  array("cust_id"=>$cust_id,"order_id"=>$order_id,"address_id"=>$address_id);
		return $res;
   }
   
   function checkout_addressid($cust_id,$address_id){
		
		$today = date("Ymd");
		$rand = strtoupper(substr(uniqid(sha1(time())),0,4));
		$order_id = $today . $rand;
		$res =  array("cust_id"=>$cust_id,"order_id"=>$order_id,"address_id"=>$address_id);
		return $res;
   }
   
   
   
	function contact_us($name,$email,$website,$subject,$message){
		// Set content-type header for sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		// Additional headers
		$headers .= 'From: '.$name.'<'.$email.'>' . "\r\n";
		$email_message = 'Dear Webmaster <br><br>Name : '. $name .'<br>Subject : '. $subject .'<br>Email : '. $email .'<br>Website : '. $website .'<br>Message : '. $message .'';
		//mail('love@littleamore.in',$subject,$email_message,$headers);
		echo "send";
   }
}
