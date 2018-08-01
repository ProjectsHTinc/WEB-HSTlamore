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
        $postdatas = array(
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
            CURLOPT_POSTFIELDS => $postdatas
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
	
	function generate_orderid() {
			$check_order = "SELECT * FROM purchase_order ORDER BY id DESC LIMIT 1";
			$res=$this->db->query($check_order);

			if($res->num_rows()>0){
				foreach($res->result() as $rows) { 
					$old_order_id = $rows->id;
				}
				$order_id = $old_order_id+1;
			} else {
				$order_id = 1;
			}
			
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$unique_ref = substr( str_shuffle( $chars ), 0, 8 );
		
      	$unique_order_id = 'LAM-'.$unique_ref.'-'.$order_id;
    	//echo 'Our unique reference number is: '.$unique_order_id;  
		//exit;
		return $unique_order_id;
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

	function zipcode_check($zipcode){
		$check_email="SELECT * FROM zipcode_masters WHERE zip_code='$zipcode'";
		$res=$this->db->query($check_email);
		
		if($res->num_rows()>0){
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
				 	$data =  array("cust_session_id"=>$cust_id,"cust_name" => $cust_name,"cust_mobile"=>$cust_mobile,"cust_email"=>$cust_email);
   	            	$this->session->set_userdata($data);
					
					$update_sql = "UPDATE customers SET last_login =NOW(),login_count='$login_count' WHERE id='$cust_id'";
				 	$update_result = $this->db->query($update_sql);
					
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
				$customer_details_update = "UPDATE customer_details SET first_name = '$fname',last_name = '$lname',birth_date  = '$dob',gender  ='$gender',newsletter_status ='$newsletter',profile_picture = '$cust_pic',updated_at =now(), updated_by = '$cust_id' WHERE id  ='$cust_id'";
			} else {
				$customer_details_update = "UPDATE customer_details SET first_name = '$fname',last_name = '$lname',birth_date = '$dob',gender  ='$gender',newsletter_status ='$newsletter',updated_at =now(),updated_by = '$cust_id' WHERE id  ='$cust_id'";
			}
			$cust_detail_update = $this->db->query($customer_details_update);
			
			if ($cust_detail_update){
				$datas=array('status'=>'success');
			}else {
				$datas=array('status'=>'failure');;
			}
			return $datas;
   }


	function get_cust_address($cust_id){
		$sql="SELECT A.*, B.country_name, C.address_type FROM cus_address A, country_master B, address_master C WHERE A.cus_id = '$cust_id' AND A.country_id = B.id AND A.address_type_id  = C.id AND A.status = 'Active' ORDER BY A.address_mode DESC";
	  	$resu=$this->db->query($sql);
	  	$res=$resu->result();
	  	return $res;
   }
   
   function get_cust_address_default($cust_id){
   		 $check_address = "SELECT * FROM cus_address WHERE cus_id = '$cust_id' AND address_mode = '1'";
		$add_res=$this->db->query($check_address);
		$res=$add_res->result();
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
							$address_datas =  array("address_id"=>$add_rows->id,"address_country_id"=>$add_rows->country_id,"address_state"=>$add_rows->state,"address_city"=>$add_rows->city,"address_pincode"=>$add_rows->pincode,"address_house_no"=>$add_rows->house_no,"address_street"=>$add_rows->street,"address_landmark"=>$add_rows->landmark,"address_full_name"=>$add_rows->full_name,"address_mobile"=>$add_rows->mobile_number,"address_mobile_alter"=>$add_rows->alternative_mobile_number,"address_email"=>$add_rows->email_address,"address_type_id "=>$add_rows->address_type_id);
						}
						$this->session->set_userdata($address_datas);
					}
			
			if ($cust_update){
				$datas=array('status'=>'success');
			}else {
				$datas=array('status'=>'failure');;
			}
			return $datas;
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
			$datas=array('status'=>'success');
			return $datas;
   }
   
   
	function cust_change_password($cust_id,$password){
			$pwd = md5($password);
			$customer_update = "UPDATE customers SET password = '$pwd',updated_at =now(), updated_by = '$cust_id' WHERE id  ='$cust_id'";
			$cust_update = $this->db->query($customer_update);
	
			$datas = $this->session->userdata();
			$this->session->unset_userdata($datas);
			$this->session->sess_destroy();
			
			if ($cust_update){
				$datas=array('status'=>'success');
			}else {
				$datas=array('status'=>'failure');;
			}
			return $datas;
			
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
	   
	   	$c_update = "UPDATE product_view_count SET view_count = view_count+1 WHERE product_id = '$prod_id'";
		$c_update = $this->db->query($c_update);
		
		$sql="SELECT * FROM products WHERE id ='$prod_id' AND status = 'Active'";
	  	$resu=$this->db->query($sql);
	  	$res=$resu->result();
	  	return $res;
   }
   
   function get_cproduct_details($prod_id){
		$sql="SELECT * FROM product_combined WHERE product_id ='$prod_id' AND prod_default = '1' AND status = 'Active' ";
	  	$resu=$this->db->query($sql);
	  	$res=$resu->result();
	  	return $res;
   }
   
   function get_size($prod_id){
		$sql="SELECT B.id, B.attribute_value FROM product_combined A, attribute_masters B WHERE A.mas_size_id = B.id AND A.product_id = '$prod_id' AND B.attribute_type = '1' AND A.status = 'Active' GROUP BY A.mas_size_id";
	  	$resu=$this->db->query($sql);
	  	$res=$resu->result();
	  	return $res;
   }
      function get_colour($product_id,$size_id){
		$sql="SELECT B.id,B.attribute_name,B.attribute_value FROM product_combined A, attribute_masters B WHERE A.mas_color_id = B.id AND A.product_id = '$product_id' AND A.mas_size_id = '$size_id' AND B.attribute_type ='2' AND A.status = 'Active'  GROUP BY A.mas_color_id";
	  	$resu=$this->db->query($sql);
	  	$res=$resu->result();
	  	return $res;
   } 
   
   function get_price($product_id,$size_id,$colour_id){
		$sql="SELECT * FROM product_combined WHERE product_id = '$product_id' AND mas_color_id = '$colour_id' AND mas_size_id = '$size_id' AND status = 'Active'";
	  	$resu=$this->db->query($sql);
	  	$res=$resu->result();
	  	return $res;
   } 
   
    function get_colour_size($product_combined_id){
		$sql="SELECT am.attribute_value, am.attribute_name, pc.mas_color_id, pc.mas_size_id, ams.attribute_value AS size, pc.* FROM product_combined AS pc LEFT JOIN attribute_masters AS am ON am.id = pc.mas_color_id LEFT JOIN attribute_masters AS ams ON ams.id = pc.mas_size_id WHERE pc.id = '$product_combined_id' ";
	  	$resu=$this->db->query($sql);
	  	$res=$resu->result();
	  	return $res;
   } 
   
   
   function cart_insert($product_id,$com_product_id,$browser_sess_id,$cust_id,$quantity,$price,$total_amount){
	   
	   $sel_cart = "SELECT * FROM product_cart WHERE product_id = '$product_id' AND product_combined_id ='$com_product_id' AND browser_sess_id ='$browser_sess_id'";
		$cart_res = $this->db->query($sel_cart);
			if($cart_res->num_rows()>0){
				foreach($cart_res->result() as $cart_rows) { 
					$cart_id = $cart_rows->id;
				}
				$cart_update = "UPDATE product_cart SET quantity = quantity+$quantity,total_amount = total_amount+$total_amount,updated_at =now(), updated_by = '$cust_id' WHERE id  ='$cart_id'";
				$result = $this->db->query($cart_update);
			} else {
	   			$cart_insert="INSERT INTO product_cart(product_id,product_combined_id,browser_sess_id,cus_id,quantity,price,total_amount,status,created_at,created_by) VALUES('$product_id','$com_product_id','$browser_sess_id','$cust_id','$quantity','$price','$total_amount','Pending',now(),'$cust_id')";
				$result=$this->db->query($cart_insert);
			}
	   
	   		if ($result){
				$datas=array('status'=>'success');
			}else {
				$datas=array('status'=>'failure');;
			}
			return $datas;

   } 
    
	 function add_cart($product_id,$browser_sess_id,$cust_id){
		$sel_product = "SELECT * FROM products WHERE id = '$product_id'";
		$product_res=$this->db->query($sel_product);
			if($product_res->num_rows()>0){
				foreach($product_res->result() as $pro_rows) { 
					$prod_actual_price = $pro_rows->prod_actual_price;
				}
			}
			
		$sel_cart = "SELECT * FROM product_cart WHERE product_id = '$product_id' AND browser_sess_id ='$browser_sess_id' ";
		$cart_res = $this->db->query($sel_cart);
			if($cart_res->num_rows()>0){
				foreach($cart_res->result() as $cart_rows) { 
					$cart_id = $cart_rows->id;
				}
				if ($cust_id!=''){
					$cart_update = "UPDATE product_cart SET quantity = quantity+1,total_amount = total_amount+$prod_actual_price,cus_id ='$cust_id', updated_at =now(), updated_by = '$cust_id' WHERE id  ='$cart_id'";
				} else {
					$cart_update = "UPDATE product_cart SET quantity = quantity+1,total_amount = total_amount+$prod_actual_price,updated_at =now(), updated_by = '$cust_id' WHERE id  ='$cart_id'";
				}
				$result = $this->db->query($cart_update);
			} else {
	   			$cart_details="INSERT INTO product_cart(product_id,product_combined_id,browser_sess_id,cus_id,quantity,price,total_amount,status,created_at,created_by) VALUES('$product_id','0','$browser_sess_id','$cust_id','1','$prod_actual_price','$prod_actual_price','Pending',now(),'$cust_id')";
			$result=$this->db->query($cart_details);
			}
			
			if ($result){
				$datas=array('status'=>'success');
			}else {
				$datas=array('status'=>'failure');;
			}
			return $datas;

   } 
			
	function cart_list(){
		$browser_sess_id = $this->session->userdata('browser_sess_id');
		$sql = "SELECT A.*,B.product_name,B.product_cover_img FROM product_cart A,products B WHERE A.product_id = B.id AND A.browser_sess_id = '$browser_sess_id' AND A.order_id = '' AND A.status='Pending' ORDER BY A.id";
		$resu=$this->db->query($sql);
		$res=$resu->result();
		return $res;
   }
   
	function update_cart($cart_id,$quantity,$price){
		$cust_id = $this->session->userdata('cust_session_id');
		$cont_cart = count($cart_id);

			for($i=0;$i<$cont_cart;$i++){
				$sqty = $quantity[$i];
				$sprice = $price[$i];
				$stotal = $sqty * $sprice;
				if ($cust_id!=''){
					$update="UPDATE product_cart SET quantity='$quantity[$i]',total_amount='$stotal',cus_id ='$cust_id' WHERE id='$cart_id[$i]'";
				} else {
					$update="UPDATE product_cart SET quantity='$quantity[$i]',total_amount='$stotal' WHERE id='$cart_id[$i]'";
				}
			$res=$this->db->query($update);	
			}
			if ($res){
				$datas=array('status'=>'success');
			}else {
				$datas=array('status'=>'failure');;
			}
			return $datas;
   }
   
    function cart_delete($cart_id){
			$del_cart = "DELETE FROM product_cart WHERE id = '$cart_id'";
			$res=$this->db->query($del_cart);

			if ($res){
				$datas=array('status'=>'success');
			}else {
				$datas=array('status'=>'failure');;
			}
			return $datas;
   }
   
    function checkout_address($cust_id,$ncountry_id,$nname,$naddress1,$naddress2,$ntown,$nstate,$nzip,$nemail,$nphone,$nphone1,$nlandmark,$ncheckout_mess,$total_amt){
		
			$browser_sess_id  = $this->session->userdata('browser_sess_id');
			$check_order = "SELECT * FROM purchase_order ORDER BY id DESC LIMIT 1";
			$res=$this->db->query($check_order);

			if($res->num_rows()>0){
				foreach($res->result() as $rows) { 
					$old_order_id = $rows->id;
				}
				$order_id = $old_order_id+1;
			} else {
				$order_id = 1;
			}
			
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
		
		
		$sql="SELECT A.*, B.country_name, C.address_type FROM cus_address A, country_master B, address_master C WHERE A.cus_id = '$cust_id' AND A.country_id = B.id AND A.address_type_id  = C.id AND A.id = '$address_id' AND A.status = 'Active'";
	  	$resu=$this->db->query($sql);
	  	$address=$resu->result();
	  	
		$today = date("Ymd");
		$rand = strtoupper(substr(uniqid(sha1(time())),0,4));
		$order_id = 'Lil'.$today . $rand . $order_id;
		

		$inssql = "INSERT INTO purchase_order(order_id ,browser_sess_id ,cus_id ,purchase_date,cus_address_id,total_amount,status,cus_notes,created_at,created_by) VALUES('$order_id','$browser_sess_id','$cust_id',now(),'$address_id','$total_amt','Pending','$ncheckout_mess',now(),'$cust_id')";
		$insert = $this->db->query($inssql);

		$updatesql = "UPDATE product_cart SET order_id='$order_id' WHERE browser_sess_id='$browser_sess_id'";
		$update = $this->db->query($updatesql);

		$res=array('order_id'=>$order_id,'address'=>$address);
		
		return $res;
   }



   function checkout_addressid($cust_id,$ocountry_id,$oname,$oaddress1,$oaddress2,$otown,$ostate,$ozip,$oemail,$ophone,$ophone1,$olandmark,$scheckout_mess,$address_id,$total_amt){
		$browser_sess_id  = $this->session->userdata('browser_sess_id');
		
			$update="UPDATE cus_address SET country_id ='$ocountry_id',state ='$ostate',city ='$otown',pincode='$ozip',house_no ='$oaddress1',street ='$oaddress2',landmark ='$olandmark',full_name ='$oname',mobile_number ='$ophone',email_address ='$oemail',alternative_mobile_number='$ophone1' WHERE id='$address_id'";
			$res=$this->db->query($update);	
		
		$check_order = "SELECT * FROM purchase_order ORDER BY id DESC LIMIT 1";
		$res=$this->db->query($check_order);

			if($res->num_rows()>0){
				foreach($res->result() as $rows) { 
					$old_order_id = $rows->id;
				}
					$order_id = $old_order_id+1;
			} else {
				$order_id = 1;
			}
		
		$sql="SELECT A.*, B.country_name, C.address_type FROM cus_address A, country_master B, address_master C WHERE A.cus_id = '$cust_id' AND A.country_id = B.id AND A.address_type_id  = C.id AND A.id = '$address_id' AND A.status = 'Active'";
	  	$resu=$this->db->query($sql);
	  	$address=$resu->result();
	  	
		$today = date("Ymd");
		$rand = strtoupper(substr(uniqid(sha1(time())),0,4));
		$order_id = 'Lil'.$today . $rand . $order_id;

		
		$inssql = "INSERT INTO purchase_order(order_id ,browser_sess_id ,cus_id ,purchase_date,cus_address_id,total_amount,status,cus_notes,created_at,created_by) VALUES('$order_id','$browser_sess_id','$cust_id',now(),'$address_id','$total_amt','Pending','$scheckout_mess',now(),'$cust_id')";
		$insert = $this->db->query($inssql);
		
		$updatesql = "UPDATE product_cart SET order_id='$order_id' WHERE browser_sess_id='$browser_sess_id'";
		$update = $this->db->query($updatesql);
		
		$res=array('order_id'=>$order_id,'address'=>$address);
		
		return $res;
   }
   
      
   function cart_process(){
		echo $unique_order_id = $this->generate_orderid();
   }
   
   function list_wishlist(){
		$guest_session = $this->session->userdata('cust_id');
		//$sql = "SELECT A.*,B.product_name,B.product_cover_img FROM product_cart A,products B WHERE A.product_id = B.id AND A.browser_sess_id = '$guest_session' ORDER BY A.id";
		//$resu=$this->db->query($sql);
		//$res=$resu->result();
		//return $res;
   }
   
    function newproducts(){
		$sql = "SELECT * FROM products WHERE status='Active' ORDER BY created_at LIMIT 10";
		$resu=$this->db->query($sql);
		$res=$resu->result();
		return $res;
   }
   
   function popularproducts(){
		$sql = "SELECT * FROM products A,product_view_count B WHERE A.status='Active' AND A.id = B.product_id ORDER BY view_count DESC LIMIT 10";
		$resu=$this->db->query($sql);
		$res=$resu->result();
		return $res;
   }
   
      function related_products($cat_id,$product_id){
		$sql = "SELECT * FROM products WHERE cat_id ='$cat_id' AND id!='$product_id' AND status='Active' ORDER BY created_at LIMIT 10";
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
     
   function homepromotions(){
		$sql = "SELECT * FROM products WHERE status='Active' ORDER BY created_at LIMIT 10";
		$resu=$this->db->query($sql);
		$res=$resu->result();
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
