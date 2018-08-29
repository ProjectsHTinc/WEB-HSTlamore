<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mobileapimodel extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->model('smsmodel');
        $this->load->model('mailmodel');
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

              $response = array("status" => "success", "msg" => "Login Successfully", "userData" => $userData);
              return $response;
      } else {

            $response = array("status" => "error", "msg" => "Invalid login");
            return $response;
      }



	}


   function social_login($username,$mob_key,$mobile_type,$login_type,$first_name,$last_name)
  {
    if($login_type=='g+' || $login_type=='fb'){
      $select="SELECT * FROM customers WHERE  email = '$username'";
      $user_res= $this->db->query($select);
      if($user_res->num_rows()==0){
        $insert="INSERT INTO customers (name,email,login_type,login_count,status) VALUES('$first_name','$username','$login_type','1','Active')";
        $cus_result = $this->db->query($insert);
        $insert_id = $this->db->insert_id();
        $insert_details="INSERT INTO customer_details(customer_id,first_name,last_name,newsletter_status,created_at,created_by)VALUES('$insert_id','$first_name','$last_name','1',NOW(),'$insert_id')";
        $cus_result_details = $this->db->query($insert_details);
        $sql = "SELECT  A.id AS customer_id,A.phone_number,A.email,B.first_name,B.last_name,B.birth_date,B.gender,B.profile_picture,B.newsletter_status,A.login_count,A.last_login FROM customers A,customer_details B  WHERE  A.id = B.customer_id AND A.id = '$insert_id'";
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


                    $gcmQuery = "SELECT * FROM cus_notification_master WHERE mob_key like '%" .$mob_key. "%' LIMIT 1";
                    $gcm_result = $this->db->query($gcmQuery);
                    $gcm_ress = $gcm_result->result();

                    if($gcm_result->num_rows()==0)
                    {
                      $sQuery = "INSERT INTO cus_notification_master (cus_id,mob_key,mobile_type,created_at ) VALUES ('". $id . "','". $mob_key . "','". $mobile_type . "',now())";
                      $update_gcm = $this->db->query($sQuery);
                    }

            $response = array("status" => "success", "msg" => "Login Successfully", "userData" => $userData);
            return $response;



      }else{
        $res_check=$user_res->result();
        foreach($res_check as $rows_check){}
        $check_status=$rows_check->status;
        $id=$rows_check->id;
        $login_count = $rows_check->login_count+1;
        if($check_status=='Active'){
  $sql = "SELECT  A.id AS customer_id,A.phone_number,A.email,B.first_name,B.last_name,B.birth_date,B.gender,B.profile_picture,B.newsletter_status,A.login_count,A.last_login FROM customers A,customer_details B  WHERE  A.id = B.customer_id AND A.id = '$id'";
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
                    $update_sql = "UPDATE customers SET last_login=NOW(),login_count='$login_count' WHERE id='$id'";
                    $update_result = $this->db->query($update_sql);

                    $gcmQuery = "SELECT * FROM cus_notification_master WHERE mob_key like '%" .$mob_key. "%' LIMIT 1";
                    $gcm_result = $this->db->query($gcmQuery);
                    $gcm_ress = $gcm_result->result();

                    if($gcm_result->num_rows()==0)
                    {
                      $sQuery = "INSERT INTO cus_notification_master (cus_id,mob_key,mobile_type,created_at ) VALUES ('". $id . "','". $mob_key . "','". $mobile_type . "',now())";
                      $update_gcm = $this->db->query($sQuery);
                    }

                        $response = array("status" => "success", "msg" => "Login Successfully", "userData" => $userData);
                        return $response;
                } else {

                  $response = array("status" => "error", "msg" => "Account blocked");
                  return $response;
                }
      }
    }else{
      $response = array("status" => "error", "msg" => "Something Went Wrong");
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

			$response = array("status" => "success", "msg" => "Signup Successfully");
		} else {
		    $response = array("status" => "error", "msg" => "User Already Register");
		}
	    return $response;
	}


//#################### Home page  list ####################//

    function home_page(){

      //----- Home  Banner----//
      $select="SELECT * FROM banner WHERE  status='Active'";
      $res=$this->db->query($select);
         if($res->num_rows()>0){
           $result=$res->result();
           foreach($result  as $rows){
             $banner_list[]=array(
               "id"=>$rows->id,
               "banner_title"=>$rows->banner_title,
               "banner_desc"=>$rows->banner_desc,
               "banner_image"=>base_url().'assets/banner/'.$rows->banner_image,
               "product_id"=>$rows->product_id,
             );
           }
          $banner_list= array("status" => "success","msg"=>"Banner list","data"=>$banner_list);

         }else{
         $banner_list = array("status" => "error","msg"=>"No Banner list Found");
         }


         //----- ads  Banner----//
         $select="SELECT * FROM ads_master WHERE  status='Active'";
         $res=$this->db->query($select);
            if($res->num_rows()>0){
              $result=$res->result();
              foreach($result  as $rows){
                $ads_list[]=array(
                  "id"=>$rows->id,
                  "ad_title"=>$rows->ad_title,
                  "sub_cat_id"=>$rows->sub_cat_id,
                  "ad_img"=>base_url().'assets/ads/'.$rows->ad_img,
                );
              }
            $ads_list = array("status" => "success","msg"=>"Ads List","data"=>$ads_list);
            }else{
            $ads_list = array("status" => "error","msg"=>"No Ads List Found");
            }

            //--------New Product  list----//
            $select="SELECT * FROM products WHERE status='Active' ORDER BY id DESC LIMIT 5";
            $res=$this->db->query($select);
             if($res->num_rows()>0){
                $result=$res->result();
                foreach($result  as $rows){
                    $product_list[]=array(
                      "id"=>$rows->id,
                      "product_name"=>$rows->product_name,
                      "sku_code"=>$rows->sku_code,
                      "product_cover_img"=>base_url().'assets/products/'.$rows->product_cover_img,
                      "prod_size_chart"=>base_url().'assets/products/'.$rows->prod_size_chart,
                      "product_description"=>$rows->product_description,
                      "offer_status"=>$rows->offer_status,
                      "specification_status"=>$rows->specification_status,
                      "combined_status"=>$rows->combined_status,
                      "prod_actual_price"=>$rows->prod_actual_price,
                      "prod_mrp_price"=>$rows->prod_mrp_price,
                      "offer_percentage"=>$rows->offer_percentage,
                      "delivery_fee_status"=>$rows->delivery_fee_status,
                      "prod_return_policy"=>$rows->prod_return_policy,
                      "prod_cod"=>$rows->prod_cod,
                      "product_meta_title"=>$rows->product_meta_title,
                      "product_meta_desc"=>$rows->product_meta_desc,
                      "product_meta_keywords"=>$rows->product_meta_keywords,
                      "stocks_left"=>$rows->stocks_left,
                    );
                }
              $prd_list = array("status" => "success","msg"=>"products list","data"=>$product_list);
             }else{
              $prd_list = array("status" => "error","msg"=>"No Products found");
             }



             //--------Popular  Product  list----//
             $select="SELECT pvc.*,p.* FROM product_view_count AS pvc LEFT JOIN products AS p ON p.id=pvc.product_id WHERE p.status='Active' ORDER BY pvc.view_count DESC";
             $res=$this->db->query($select);
              if($res->num_rows()>0){
                 $result=$res->result();
                 foreach($result  as $rows){
                     $popular_product_list[]=array(
                       "id"=>$rows->id,
                       "product_name"=>$rows->product_name,
                       "sku_code"=>$rows->sku_code,
                       "product_cover_img"=>base_url().'assets/products/'.$rows->product_cover_img,
                       "prod_size_chart"=>base_url().'assets/products/'.$rows->prod_size_chart,
                       "product_description"=>$rows->product_description,
                       "offer_status"=>$rows->offer_status,
                       "specification_status"=>$rows->specification_status,
                       "combined_status"=>$rows->combined_status,
                       "prod_actual_price"=>$rows->prod_actual_price,
                       "prod_mrp_price"=>$rows->prod_mrp_price,
                       "offer_percentage"=>$rows->offer_percentage,
                       "delivery_fee_status"=>$rows->delivery_fee_status,
                       "prod_return_policy"=>$rows->prod_return_policy,
                       "prod_cod"=>$rows->prod_cod,
                       "product_meta_title"=>$rows->product_meta_title,
                       "product_meta_desc"=>$rows->product_meta_desc,
                       "product_meta_keywords"=>$rows->product_meta_keywords,
                       "stocks_left"=>$rows->stocks_left,
                     );
                 }
               $popular_prd_list = array("status" => "success","msg"=>"popular products","data"=>$popular_product_list);
                }else{
              $popular_prd_list = array("status" => "error","msg"=>"No popular products");
              }




      $data=array("status"=>"success","msg"=>"Home page data","banner_list"=>$banner_list,"ads_list"=>$ads_list,"new_product"=>$prd_list,"popular_product_list"=>$popular_prd_list);
    //  $data=array("status"=>"success","msg"=>"Home page data","data"=>$response);
        return $data;
    }



//#################### Category list ####################//

    function category_list(){
      $select="SELECT * FROM category_masters WHERE parent_id='1'  AND status='Active'";
      $res=$this->db->query($select);
         if($res->num_rows()>0){
           $result=$res->result();
           foreach($result  as $rows){
             $category_list[]=array(
               "id"=>$rows->id,
               "parent_id"=>$rows->parent_id,
               "category_name"=>$rows->category_name,
               "category_image"=>base_url().'assets/category/'.$rows->category_image,
               "category_desc"=>$rows->category_desc,
             );
           }
           $data = array("status" => "success","msg"=>"Category found","category_list"=>$category_list);
         }else{
         $data = array("status" => "error","msg"=>"No category found");
         }
        return $data;
    }

//#################### Sub Category list ####################//

        function sub_cat_list($cat_id){
          $select="SELECT * FROM category_masters WHERE parent_id='$cat_id'  AND status='Active'";
          $res=$this->db->query($select);
             if($res->num_rows()>0){
               $result=$res->result();
               foreach($result  as $rows){
                 $sub_cat_list[]=array(
                   "id"=>$rows->id,
                   "parent_id"=>$rows->parent_id,
                   "category_name"=>$rows->category_name,
                   "category_image"=>base_url().'assets/category/'.$rows->category_image,
                   "category_desc"=>$rows->category_desc,
                 );
               }
               $data = array("status" => "success","msg"=>"category found","sub_category_list"=>$sub_cat_list);
             }else{
             $data = array("status" => "error","msg"=>"No category found");
             }
            return $data;
        }


//#################### Category and sub category based product list ####################//


  function product_list($cat_id,$sub_cat_id,$user_id){
    if($user_id=='0'){
      $cus_id=0;
    }else{
      $cus_id=$user_id;
    }
    $select="SELECT p.*,IFNULL(cw.customer_id,'0') AS wishlisted FROM products AS p
    LEFT JOIN  cus_wishlist AS cw ON cw.product_id=p.id AND cw.customer_id='$cus_id' WHERE cat_id='$cat_id' AND sub_cat_id='$sub_cat_id' AND status='Active'";
    $res=$this->db->query($select);
     if($res->num_rows()>0){
        $result=$res->result();
        foreach($result  as $rows){
            $product_list[]=array(
              "id"=>$rows->id,
              "product_name"=>$rows->product_name,
              "sku_code"=>$rows->sku_code,
              "product_cover_img"=>base_url().'assets/products/'.$rows->product_cover_img,
              "prod_size_chart"=>base_url().'assets/products/'.$rows->prod_size_chart,
              "product_description"=>$rows->product_description,
              "offer_status"=>$rows->offer_status,
              "specification_status"=>$rows->specification_status,
              "combined_status"=>$rows->combined_status,
              "prod_actual_price"=>$rows->prod_actual_price,
              "prod_mrp_price"=>$rows->prod_mrp_price,
              "offer_percentage"=>$rows->offer_percentage,
              "delivery_fee_status"=>$rows->delivery_fee_status,
              "prod_return_policy"=>$rows->prod_return_policy,
              "prod_cod"=>$rows->prod_cod,
              "product_meta_title"=>$rows->product_meta_title,
              "product_meta_desc"=>$rows->product_meta_desc,
              "product_meta_keywords"=>$rows->product_meta_keywords,
              "stocks_left"=>$rows->stocks_left,
              "wishlisted"=>$rows->wishlisted,
            );
        }
      $data = array("status" => "success","msg"=>"Products found","product_list"=>$product_list);
     }else{
        $data = array("status" => "error","msg"=>"No Products found");
     }
      return $data;

  }


    //-------Product details -------///

    function product_details($product_id,$user_id){
      if($user_id=='0'){
        $cus_id=0;
      }else{
        $cus_id=$user_id;
      }

      //---product detail---//
      $select="SELECT p.*,IFNULL(cw.customer_id,'0') AS wishlisted FROM products as p LEFT JOIN  cus_wishlist AS cw ON cw.product_id=p.id AND cw.customer_id='$cus_id' WHERE p.id='$product_id'  AND p.status='Active'";
      $res=$this->db->query($select);
       if($res->num_rows()>0){
          $result=$res->result();
          foreach($result  as $rows){  }
              $prd_details=array(
                "id"=>$rows->id,
                "product_name"=>$rows->product_name,
                "sku_code"=>$rows->sku_code,
                "product_cover_img"=>base_url().'assets/products/'.$rows->product_cover_img,
                "prod_size_chart"=>base_url().'assets/products/'.$rows->prod_size_chart,
                "product_description"=>$rows->product_description,
                "offer_status"=>$rows->offer_status,
                "specification_status"=>$rows->specification_status,
                "combined_status"=>$rows->combined_status,
                "prod_actual_price"=>$rows->prod_actual_price,
                "prod_mrp_price"=>$rows->prod_mrp_price,
                "offer_percentage"=>$rows->offer_percentage,
                "delivery_fee_status"=>$rows->delivery_fee_status,
                "prod_return_policy"=>$rows->prod_return_policy,
                "prod_cod"=>$rows->prod_cod,
                "product_meta_title"=>$rows->product_meta_title,
                "product_meta_desc"=>$rows->product_meta_desc,
                "product_meta_keywords"=>$rows->product_meta_keywords,
                "stocks_left"=>$rows->stocks_left,
                "wishlisted"=>$rows->wishlisted,
              );

        $product_details = array("status" => "success","msg"=>"product details","product_details"=>$prd_details);
       }else{
          $product_details = array("status" => "error","msg"=>"No Records Found");
       }


       //---product combination ---//
       $select="SELECT am.attribute_value,am.attribute_name,pc.mas_color_id,pc.mas_size_id,ams.attribute_value AS size,pc.* FROM product_combined AS pc LEFT JOIN attribute_masters AS am ON am.id=pc.mas_color_id LEFT JOIN attribute_masters AS ams ON ams.id=pc.mas_size_id WHERE product_id='$product_id' AND ams.status='Active'";
       $res=$this->db->query($select);
        if($res->num_rows()>0){
           $result=$res->result();
           foreach($result  as $rows){
               $comb_product_list[]=array(
                 "id"=>$rows->id,
                 "product_id"=>$rows->product_id,
                 "mas_size_id"=>$rows->mas_size_id,
                 "size"=>$rows->size,
                 "mas_color_id"=>$rows->mas_color_id,
                 "color_name"=>$rows->attribute_name,
                 "color_code"=>$rows->attribute_value,
                 "prod_actual_price"=>$rows->prod_actual_price,
                 "prod_mrp_price"=>$rows->prod_mrp_price,
                 "prod_default"=>$rows->prod_default,
                 "stocks_left"=>$rows->stocks_left,
               );
           }
         $comb_prod = array("status" => "success","msg"=>"Combined Products","comb_product_list"=>$comb_product_list);
        }else{
           $comb_prod = array("status" => "error","msg"=>"No Record Found");
        }



         //---product specification ---//
         $select="SELECT sm.spec_name,ps.* FROM product_specification AS ps LEFT JOIN specification_masters AS sm ON sm.id=ps.spec_id WHERE product_id='$product_id' AND ps.status='Active'";
         $res=$this->db->query($select);
          if($res->num_rows()>0){
             $result=$res->result();
             foreach($result  as $rows){
                 $spec_prods[]=array(
                   "id"=>$rows->id,
                   "spec_name"=>$rows->spec_name,
                   "product_id"=>$rows->product_id,
                   "spec_value"=>$rows->spec_value,
                 );
             }
           $prod_specs = array("status" => "success","msg"=>"product specification","spec_prod"=>$spec_prods);
          }else{
            $prod_specs = array("status" => "error","msg"=>"No specification");
          }


          //---product rating ---//
          $select="SELECT COUNT(product_id) AS review_count,ROUND(AVG(rating)) AS average FROM product_review AS pr WHERE product_id='$product_id'";
          $res=$this->db->query($select);
           if($res->num_rows()>0){
              $result=$res->result();
              foreach($result  as $rows){}
                  $prd_review=array(
                    "review_count"=>$rows->review_count,
                    "average"=>$rows->average,
                  );

            $product_review = array("status" => "success","msg"=>"Review found","product_review"=>$prd_review);
           }else{
             $product_review = array("status" => "error","msg"=>"No Review");
           }



        $data=array("status"=>"success","msg"=>"product details","product_details"=>$product_details,"comb_product"=>$comb_prod,"product_specification"=>$prod_specs,"product_review"=>$product_review);
        return $data;

    }



    function get_product_color($product_id,$size_id){
      $select="SELECT am.attribute_value,am.attribute_name,pc.mas_color_id,pc.mas_size_id,ams.attribute_value AS size,pc.* FROM product_combined AS pc LEFT JOIN attribute_masters AS am ON am.id=pc.mas_color_id LEFT JOIN attribute_masters AS ams ON ams.id=pc.mas_size_id WHERE pc.product_id='$product_id' AND pc.mas_size_id='$size_id'  AND ams.status='Active'";
      $res=$this->db->query($select);
       if($res->num_rows()>0){
          $result=$res->result();
          foreach($result  as $rows){
              $product_color[]=array(
                "id"=>$rows->id,
                "product_id"=>$rows->product_id,
                "mas_color_id"=>$rows->mas_color_id,
                "color_name"=>$rows->attribute_name,
                "color_code"=>$rows->attribute_value,
                "prod_actual_price"=>$rows->prod_actual_price,
                "prod_mrp_price"=>$rows->prod_mrp_price,
                "prod_default"=>$rows->prod_default,
                "stocks_left"=>$rows->stocks_left,
              );
          }
        $data = array("status" => "success","msg"=>"Product Color found","product_color"=>$product_color);
       }else{
          $data = array("status" => "error","msg"=>"No Record Found");
       }
       return $data;

    }



    //-------Product Wishlist -------///
    function prod_wishlist_add($product_id,$user_id){
     $select="SELECT * FROM cus_wishlist WHERE  customer_id='$user_id' AND product_id='$product_id'";
      $res=$this->db->query($select);
         if($res->num_rows()>0){
           $data = array("status" => "error","msg"=>"Already");
         }else{
           $insert="INSERT INTO cus_wishlist (customer_id,product_id,created_at,updated_at) VALUES('$user_id','$product_id',NOW(),NOW())";
           $res=$this->db->query($insert);
           if($res){
             $data = array("status" => "success","msg"=>"Wishlist Added");
           }else{
             $data = array("status" => "error","msg"=>"Something Went Wrong");
           }
         }
        return $data;
    }

    function remove_wishlist($product_id,$user_id){
      $delete="DELETE FROM cus_wishlist WHERE customer_id='$user_id' AND product_id='$product_id'";
      $res=$this->db->query($delete);
      if($res){
        $data = array("status" => "success","msg"=>"Wishlist Removed");
      }else{
        $data = array("status" => "error","msg"=>"Something Went Wrong");
      }
        return $data;
    }

    function view_wishlist($user_id){
      $select="SELECT p.* FROM cus_wishlist AS cw LEFT JOIN products AS p ON p.id=cw.product_id WHERE cw.customer_id='$user_id' AND p.status='Active'";
      $res=$this->db->query($select);
       if($res->num_rows()==0){
        $data = array("status" => "error","msg"=>"No records found");
       }else{

        $result=$res->result();
        foreach($result  as $rows){
            $product_list[]=array(
              "id"=>$rows->id,
              "product_name"=>$rows->product_name,
              "sku_code"=>$rows->sku_code,
              "product_cover_img"=>base_url().'assets/products/'.$rows->product_cover_img,
              "prod_size_chart"=>base_url().'assets/products/'.$rows->prod_size_chart,
              "product_description"=>$rows->product_description,
              "offer_status"=>$rows->offer_status,
              "specification_status"=>$rows->specification_status,
              "combined_status"=>$rows->combined_status,
              "prod_actual_price"=>$rows->prod_actual_price,
              "prod_mrp_price"=>$rows->prod_mrp_price,
              "offer_percentage"=>$rows->offer_percentage,
              "delivery_fee_status"=>$rows->delivery_fee_status,
              "prod_return_policy"=>$rows->prod_return_policy,
              "prod_cod"=>$rows->prod_cod,
              "product_meta_title"=>$rows->product_meta_title,
              "product_meta_desc"=>$rows->product_meta_desc,
              "product_meta_keywords"=>$rows->product_meta_keywords,
              "stocks_left"=>$rows->stocks_left,
            );
        }
      $data = array("status" => "success","msg"=>"wishlist found","product_list"=>$product_list);
       }
        return $data;
    }



    //---------Product cart------//

    function product_cart($product_id,$prod_comb_id,$quantity,$user_id){
        $check="SELECT * FROM products WHERE id='$product_id'";
        $res=$this->db->query($check);
        $result=$res->result();
        foreach($result as $rows_result){ }
        $check_quantity=$rows_result->stocks_left;
        if($prod_comb_id=='0'){
          $old_price=$rows_result->prod_actual_price;
          $offer_status=$rows_result->offer_status;
          if($offer_status=='1'){
            $offer_percentage=$rows_result->offer_percentage;
            $discount_value = ($old_price / 100) * $offer_percentage;
            $offer_pirce = $old_price - $discount_value;
          }else{
            $offer_pirce=$rows_result->prod_actual_price;
          }
        }else{
          $select="SELECT * FROM product_combined WHERE product_id='$product_id' AND id='$prod_comb_id'";
          $res=$this->db->query($select);
          $result_com=$res->result();
          foreach($result_com as $row_comb){ }
           $old_price_comb=$row_comb->prod_actual_price;
           $offer_status=$rows_result->offer_status;

          if($offer_status=='1'){
            $offer_percentage=$rows_result->offer_percentage;
            $discount_value = ($old_price_comb / 100) * $offer_percentage;
            $offer_pirce = $old_price_comb - $discount_value;
          }else{
            $offer_pirce=$rows_result->prod_actual_price;
          }
        }
         $prod_actual_price=round($offer_pirce);


        if($quantity < $check_quantity){
          $total_amount=$prod_actual_price * $quantity;
          $check_cart="SELECT * FROM product_cart WHERE product_id='$product_id' AND cus_id='$user_id' AND status='Pending'";
          $res_update=$this->db->query($check_cart);
          $res_update->num_rows();
          if($res_update->num_rows()==0){
            $insert="INSERT INTO product_cart(product_id,product_combined_id,cus_id,quantity,price,total_amount,status,created_at,created_by) VALUES('$product_id','$prod_comb_id','$user_id','$quantity','$prod_actual_price','$total_amount','Pending',NOW(),'$user_id')";
            $res=$this->db->query($insert);
            if($res){
              $data = array("status" => "success","msg"=>"Product added to cart Successfully");
            }else{
                $data = array("status" => "error","msg"=>"Something Went wrong");
            }
          }else{
            $update="UPDATE product_cart SET product_id='$product_id',product_combined_id='$prod_comb_id',quantity='$quantity',price='$prod_actual_price',total_amount='$total_amount',status='Pending',updated_at=NOW(),updated_by='$user_id' WHERE cus_id='$user_id' AND product_id='$product_id' AND product_combined_id='$prod_comb_id' AND status='Pending'";
            $re_update=$this->db->query($update);
            if($re_update){
              $data = array("status" => "success","msg"=>"Product added to cart Successfully");
            }else{
                $data = array("status" => "error","msg"=>"Something Went wrong");
            }
          }


        }else{
          $data = array("status" => "error","msg"=>"Out of Stocks");
        }
      return $data;
    }


    function product_cart_remove($cart_id,$user_id){
      $delete="DELETE FROM product_cart WHERE cus_id='$user_id' AND id='$cart_id'";
      $res=$this->db->query($delete);
      if($res){
        $data = array("status" => "success","msg"=>"Product removed from cart");
      }else{
        $data = array("status" => "error","msg"=>"Something Went Wrong");
      }
        return $data;
    }

    function view_cart_items($user_id){
      $Select_price="SELECT * FROM products WHERE status='Active'";
      $res_price=$this->db->query($Select_price);
      if($res_price->num_rows()>0){
        $result=$res_price->result();
        foreach($result as $rows_price){
          $offer_status=$rows_price->offer_status;
          $combined_status=$rows_price->combined_status;
          $id=$rows_price->id;
          if($combined_status=='1'){
            $select_comb="SELECT * FROM product_combined WHERE product_id='$id' AND status='Active'";
            $res_comb=$this->db->query($select_comb);
            $result_comb=$res_comb->result();
            foreach($result_comb as $rows_comb){
            $comb_prd_price=$rows_comb->prod_actual_price;
            if($offer_status=='1'){
                $offer_percentage=$rows_price->offer_percentage;
                $discount_value = ($comb_prd_price / 100) * $offer_percentage;
                $offer_pirce = $comb_prd_price - $discount_value;
            }else{
              $offer_pirce=$rows_price->prod_actual_price;
            }
            $prod_actual_price=round($offer_pirce);
            $update_cart_price="UPDATE product_cart SET price='$prod_actual_price',total_amount=quantity *'$prod_actual_price'  WHERE product_id='$id' AND status='Pending'";
            $res=$this->db->query($update_cart_price);
            }
          }else{
            $old_price_comb=$rows_price->prod_actual_price;
            if($offer_status=='1'){
              $offer_percentage=$rows_price->offer_percentage;
              $discount_value = ($old_price_comb / 100) * $offer_percentage;
              $offer_pirce = $old_price_comb - $discount_value;
            }else{
              $offer_pirce=$rows_price->prod_actual_price;
            }
            $prod_actual_price=round($offer_pirce);
            $update_cart_price="UPDATE product_cart SET price='$prod_actual_price',total_amount=quantity *'$prod_actual_price'  WHERE product_id='$id' AND status='Pending'";
            $res=$this->db->query($update_cart_price);
          }
        }
      }


      $select="SELECT p.product_name,p.stocks_left,p.product_cover_img,p.product_description,cm.category_name,IFNULL(am.attribute_value,' ') AS color_code,IFNULL(am.attribute_name,' ') AS color_name,IFNULL(ams.attribute_value,' ') AS size,pc.* FROM product_cart AS pc LEFT JOIN products AS p ON p.id=pc.product_id LEFT JOIN category_masters AS cm ON p.cat_id=cm.id LEFT JOIN product_combined AS comb ON comb.id=pc.product_combined_id LEFT JOIN attribute_masters AS am ON am.id=comb.mas_color_id LEFT JOIN attribute_masters AS ams ON ams.id=comb.mas_size_id WHERE pc.cus_id='$user_id' AND pc.status='Pending'";
      $res=$this->db->query($select);
     if($res->num_rows()>0){
          $result=$res->result();
          foreach($result  as $rows){
              $cart_items[]=array(
                "id"=>$rows->id,
                "product_name"=>$rows->product_name,
                "product_id"=>$rows->product_id,
                "category_name"=>$rows->category_name,
                "color_code"=>$rows->color_code,
                "color_name"=>$rows->color_name,
                "stocks_left"=>$rows->stocks_left,
                "size"=>$rows->size,
                "product_cover_img"=>base_url().'assets/products/'.$rows->product_cover_img,
                "product_description"=>$rows->product_description,
                "quantity"=>$rows->quantity,
                "price"=>$rows->price,
                "total_amount"=>$rows->total_amount,
                "status"=>$rows->status,
              );
          }

        $cart_total="SELECT SUM(total_amount) as cart_total FROM product_cart AS pc WHERE pc.cus_id='$user_id' AND pc.status='Pending'";
        $res_cart=$this->db->query($cart_total);
       if($res_cart->num_rows()>0){
            $result_cart=$res_cart->result();
            foreach($result_cart  as $rows_cart){ }
              $cart_total_amt=$rows_cart->cart_total;
              $cart = array("status" => "error","msg"=>"Payment Total","cart_payment"=>$cart_total_amt);
          }else{
              $cart = array("status" => "error","msg"=>"No amount");
          }

        $data = array("status" => "success","msg"=>"Cart found","view_cart_items"=>$cart_items,"cart_payment"=>$cart);
       }else{
        $data = array("status" => "error","msg"=>"No records found");
       }
        return $data;
    }



    function cart_quantity($cart_id,$quantity,$user_id){
      $select="SELECT * FROM product_cart WHERE id='$cart_id'";
      $res_cart=$this->db->query($select);
      $result_cart=$res_cart->result();
      foreach($result_cart  as $rows_cart){}
      $prod_id=$rows_cart->product_id;
      $current_quantity=$rows_cart->quantity;
      $check="SELECT * FROM products WHERE id='$prod_id'";
      $res=$this->db->query($check);
      $result=$res->result();
      foreach($result as $rows_result){ }
      $update_quantity=$current_quantity+$quantity;
      $check_quantity=$rows_result->stocks_left;
      $prod_actual_price=$rows_result->prod_actual_price;
      if($update_quantity < $check_quantity){
        $update_cart="UPDATE product_cart SET quantity='$update_quantity' WHERE id='$cart_id' AND cus_id='$user_id'";
        $res_cart=$this->db->query($update_cart);
        if($res_cart){
          $data = array("status" => "success","msg"=>"Product Quantity Updated");
        }else{
          $data = array("status" => "error","msg"=>"Something Went Wrong");
        }
      }else{
        $data = array("status" => "error","msg"=>"Out of stocks");
      }
        return $data;
    }


      //--- Product review---//

      function product_reviews($product_id){
        $select="SELECT c.name,pr.* FROM  product_review AS pr LEFT JOIN customers AS c ON c.id=pr.cus_id WHERE pr.product_id='$product_id' AND pr.status='Active'";
        $res=$this->db->query($select);
       if($res->num_rows()>0){
            $result=$res->result();
            foreach($result  as $rows){
                $prod_review[]=array(
                  "id"=>$rows->id,
                  "customer_name"=>$rows->name,
                  "product_id"=>$rows->product_id,
                  "rating"=>$rows->rating,
                  "comment"=>$rows->comment,
                );
            }
              $data = array("status" => "success","msg"=>"Reviews found","product_review"=>$prod_review);
          }else{
              $data = array("status" => "error","msg"=>"No Review found");
          }
          return $data;
      }

      function product_reviews_add($product_id,$user_id,$rating,$comment){
        $check="SELECT * FROM product_review WHERE product_id='$product_id' AND cus_id='$user_id'";
        $result=$this->db->query($check);
       if($result->num_rows()==0){
         $insert="INSERT INTO product_review (cus_id,product_id,rating,comment,status,created_at,created_by) VALUES('$user_id','$product_id','$rating','$comment','Active',NOW(),'$user_id')";
         $res=$this->db->query($insert);
         if($res){
             $data = array("status" => "success","msg"=>"Review Added");
         }else{
             $data = array("status" => "error","msg"=>"Something Went wrong");
         }
       }else{
         $data = array("status" => "error","msg"=>"Review added already");
       }
         return $data;
      }

      function product_review_check($product_id,$user_id){
        $check="SELECT * FROM product_review WHERE product_id='$product_id' AND cus_id='$user_id'";
        $result=$this->db->query($check);
       if($result->num_rows()==0){
         $data = array("status" => "success","msg"=>"Add Review");
       }else{
         $select="SELECT * FROM product_review WHERE product_id='$product_id' AND cus_id='$user_id'";
         $result=$this->db->query($select);
         $result_rev=$result->result();
         foreach($result_rev  as $rows){}
             $prod_review=array(
               "id"=>$rows->id,
               "product_id"=>$rows->product_id,
               "rating"=>$rows->rating,
               "comment"=>$rows->comment,
             );
          $data = array("status" => "success","msg"=>"Reviews found","product_review"=>$prod_review);
       }
       return $data;
      }


      function review_update($user_id,$rating,$comment,$review_id){
        $check="UPDATE product_review SET rating='$rating',comment='$comment' WHERE cus_id='$user_id' AND id='$review_id'";
        $result=$this->db->query($check);
       if($result){
         $data = array("status" => "success","msg"=>"Review Updated");
       }else{
          $data = array("status" => "error","msg"=>"Something Went Wrong");
       }
       return $data;
      }

      function address_list($user_id){
        $select="SELECT * FROM cus_address  AS ca WHERE ca.cus_id='$user_id'";
        $res=$this->db->query($select);
        if($res->num_rows()>0){
            $result=$res->result();
            foreach($result  as $rows){
                $addrss_list[]=array(
                  "id"=>$rows->id,
                  "state"=>$rows->state,
                  "city"=>$rows->city,
                  "pincode"=>$rows->pincode,
                  "house_no"=>$rows->house_no,
                  "street"=>$rows->street,
                  "landmark"=>$rows->landmark,
                  "full_name"=>$rows->full_name,
                  "mobile_number"=>$rows->mobile_number,
                  "email_address"=>$rows->email_address,
                  "alternative_mobile_number"=>$rows->alternative_mobile_number,
                );
            }
              $data = array("status" => "success","msg"=>"Address found","address_list"=>$addrss_list);
          }else{
              $data = array("status" => "error","msg"=>"No Address found");
          }
          return $data;

      }


      function address_create($user_id,$country_id,$state,$city,$pincode,$house_no,$street,$landmark,$full_name,$mobile_number,$email_address,$alternative_mobile_number,$address_type,$address_mode){
        $insert="INSERT INTO cus_address (cus_id,country_id,state,city,pincode,house_no,street,landmark,full_name,mobile_number,email_address,alternative_mobile_number,address_type_id,address_mode,status,created_at,created_by)
         VALUES('$user_id','$country_id','$state','$city','$pincode','$house_no','$street','$landmark','$full_name','$mobile_number','$email_address','$alternative_mobile_number','$address_type','$address_mode','Active','$user_id',NOW())";
        $result=$this->db->query($insert);
       if($result){
         $data = array("status" => "success","msg"=>"Address Added");
       }else{
          $data = array("status" => "error","msg"=>"Something Went Wrong");
       }
       return $data;
      }


      function check_pincode($pin_code){
        $select = "SELECT * FROM zipcode_masters WHERE zip_code='$pin_code' AND status='Active'";
        $res=$this->db->query($select);
        if($res->num_rows()==0){
           $data = array("status" => "error","msg"=>"No Delivery for this Area");
        }else{
            foreach($res->result() as $rows) {}
            $return_delivery=array(
                "id"=>$rows->id,
                "zipcode"=>$rows->zip_code,
                "zip_desc"=>$rows->zip_desc,
              );
             $data = array("status" => "success","msg"=>"Delivery found","delivery_status"=>$return_delivery);
            }
          return $data;

      }


      function place_order($user_id,$address_id,$cus_notes){
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
        $today = date("Ymd");
        $rand = strtoupper(substr(uniqid(sha1(time())),0,4));
        $order_id = 'Lil'.$today . $rand . $order_id;
        $select_cart="SELECT sum(total_amount) as total_amount,sum(quantity) as total_quantity FROM product_cart WHERE cus_id='$user_id' AND status='Pending'";
        $result=$this->db->query($select_cart);
        $res_cart=$result->result();
        foreach($res_cart as $total_amount){}
        $total=$total_amount->total_amount;

        $tot_quantity=$total_amount->total_quantity;
        $insert="INSERT INTO purchase_order (order_id,cus_id,purchase_date,cus_address_id,total_amount,status,cus_notes,created_at,created_by) VALUES('$order_id','$user_id',NOW(),'$address_id','$total','Success','$cus_notes',NOW(),'$user_id')";
        $res=$this->db->query($insert);

        //---Stocks left Update--//
        $select_stock="SELECT * FROM product_cart WHERE cus_id='$user_id' AND status='Pending'";
        $result_stock=$this->db->query($select_stock);
        $res_stock=$result_stock->result();
        foreach($res_stock as $rows_stock){
          $prd_qu=$rows_stock->quantity;
          $prd_id=$rows_stock->product_id;
          $prd_com_id=$rows_stock->product_combined_id;
          $update_stoc="UPDATE products SET stocks_left=stocks_left-'$prd_qu' WHERE id='$prd_id'";
          $resu_stock=$this->db->query($update_stoc);
          if($prd_com_id=='1'){
            $update_comb_stoc="UPDATE product_combined SET stocks_left=stocks_left-'$prd_qu' WHERE id='$prd_com_id' AND product_id='$prd_id'";
            $resu_stock=$this->db->query($update_comb_stoc);
          }
        }
          //---Stocks left Update--//

          //---Update Cart to Success--//
        $update_cart="UPDATE product_cart SET order_id='$order_id',cus_id='$user_id',status='Success' WHERE cus_id='$user_id' AND status='Pending'";
        $res_cart=$this->db->query($update_cart);
        if($res_cart){
          $data = array("status" => "success","msg"=>"Order Successfully Placed");
        }else{
          $data = array("status" => "error","msg"=>"Payment Error");
        }
          return $data;
      }



      function password_update($user_id,$password){
        $new_pwd=md5($password);
        $update="UPDATE customers SET password='$new_pwd' WHERE id='$user_id'";
        $res=$this->db->query($update);
        if($res){
          $data = array("status" => "success","msg"=>"Password Updated Successfully");
        }else{
          $data = array("status" => "error","msg"=>"Password Error");
        }
          return $data;
      }

      function check_password($user_id,$password){
        $new_pwd=md5($password);
        $update="SELECT * FROM  customers  WHERE id='$user_id' AND password='$new_pwd'";
        $res=$this->db->query($update);
        if($res->num_rows()==0){
          $data = array("status" => "error","msg"=>"Password error");
        }else{
          $data = array("status" => "success","msg"=>"Password Verified");
        }
          return $data;
      }

      function get_profile_details($user_id){
        $select = "SELECT c.*,cd.* FROM customers as c left join customer_details as cd on c.id=cd.customer_id where c.id='$user_id' and c.status='Active'";
        $res=$this->db->query($select);
        if($res->num_rows()==0){
           $data = array("status" => "error","msg"=>"No Profile found");
        }else{
            foreach($res->result() as $rows) {}
            $profile=array(
                "id"=>$rows->id,
                "first_name"=>$rows->first_name,
                "last_name"=>$rows->last_name,
                "birth_date"=>$rows->birth_date,
                "gender"=>$rows->gender,
                "profile_picture"=>base_url().'assets/front/profile/'.$rows->profile_picture,
                "newsletter_status"=>$rows->newsletter_status,
                "phone_number"=>$rows->phone_number,
                "email"=>$rows->email,
              );
             $data = array("status" => "success","msg"=>"Profile found","get_profile_details"=>$profile);
            }
          return $data;
      }


      function update_profile_details($user_id,$first_name,$last_name,$email,$mobile_number,$gender,$dob,$newsletter_status){
        $check_email="SELECT * FROM customers WHERE email='$email' AND id!='$user_id'";
        $res=$this->db->query($check_email);
        if($res->num_rows()==0){
           $check_mobile="SELECT * FROM customers WHERE phone_number='$mobile_number' AND id!='$user_id'";
          $res_mob=$this->db->query($check_mobile);
            if($res_mob->num_rows()==0){
              $update="UPDATE customer_details SET first_name='$first_name',last_name='$last_name',birth_date='$dob',gender='$gender',newsletter_status='$newsletter_status' WHERE customer_id='$user_id'";
              $res=$this->db->query($update);
              $update_main="UPDATE customers SET name='$first_name',phone_number='$mobile_number',email='$email' WHERE id='$user_id'";
              $res_main=$this->db->query($update_main);
              if($res_main){
                $data = array("status" => "success","msg"=>"Profile Updated Successfully");
              }else{
                $data = array("status" => "error","msg"=>"Profile Error");
              }

            }else{
              $data = array("status" => "error","msg"=>"Mobile number Already Exist");
            }
        }else{
          $data = array("status" => "error","msg"=>"Email Already Exist");
        }
        return  $data;
      }

      function forgot_password($email_phone){
        $check="SELECT * FROM customers where phone_number='$email_phone' or email='$email_phone'";
        $res=$this->db->query($check);
        if($res->num_rows()==0){
            $data = array("status" => "error","msg"=>"No Email or Mobile number registered");
        }else{
          $result=$res->result();
          foreach($result as $rows){}
           $phone=$rows->phone_number;

          $id=$rows->id;
          $email= $rows->email;
          $otp= rand(100000, 999999);
          $textmessage='Password Reset OTP '.$otp.'';
          $notes =utf8_encode($textmessage);
          $this->smsmodel->send_sms($phone,$notes);
          $update_otp="UPDATE customers SET mobile_otp='$otp' WHERE id='$id'";
          $res_otp=$this->db->query($update_otp);
          if($res_otp){
            $data = array("status" => "success","msg"=>"OTP has sent to regsitered Mobile number");
          }else{
            $data = array("status" => "error","msg"=>"No Email or phone number registered");
          }
        }
          return $data;
      }

      function verify_otp_password($email_phone,$otp){
        $check="SELECT * FROM customers where phone_number='$email_phone' or email='$email_phone'";
        $res=$this->db->query($check);
        if($res->num_rows()==0){
            $data = array("status" => "error","msg"=>"No Email or Mobile number registered");
          }else{
            $result=$res->result();
            foreach($result as $rows){}
            $mobile_otp=$rows->mobile_otp;
            if($mobile_otp==$otp){
              $data = array("status" => "success","msg"=>"OTP Verified Successfully");
            }else{
              $data = array("status" => "error","msg"=>"You have entered invalid OTP");
            }
          }
          return $data;
      }



      function view_orders($user_id){
        $select="SELECT po.*,ca.* FROM purchase_order as po left join cus_address as ca on ca.id=po.cus_address_id where po.cus_id='$user_id'";
        $res=$this->db->query($select);
        if($res->num_rows()>0){
            $result=$res->result();
            foreach($result  as $rows){
                $order_details[]=array(
                  "id"=>$rows->id,
                  "order_id"=>$rows->order_id,
                  "cus_id"=>$rows->cus_id,
                  "purchase_date"=>$rows->purchase_date,
                  "total_amount"=>$rows->total_amount,
                  "status"=>$rows->status,
                  "cus_notes"=>$rows->cus_notes,
                  "state"=>$rows->state,
                  "city"=>$rows->city,
                  "pincode"=>$rows->pincode,
                  "house_no"=>$rows->house_no,
                  "street"=>$rows->street,
                  "landmark"=>$rows->landmark,
                  "full_name"=>$rows->full_name,
                  "mobile_number"=>$rows->mobile_number,
                  "email_address"=>$rows->email_address,
                  "alternative_mobile_number"=>$rows->alternative_mobile_number,
                );
            }
              $data = array("status" => "success","msg"=>"orders found","order_details"=>$order_details);
          }else{
              $data = array("status" => "error","msg"=>"No orders found");
          }
          return $data;

      }


      function check_my_order($order_id){
        $select="SELECT pc.id as cart_id,ca.*,pur.cus_address_id,c.*,p.id as product_id,p.product_name,p.product_cover_img,am.attribute_value,am.attribute_name,ams.attribute_value AS size,pc.*,comb.id FROM product_cart AS pc
LEFT JOIN products AS p ON p.id=pc.product_id LEFT JOIN product_combined AS comb ON comb.id=pc.product_combined_id LEFT JOIN attribute_masters AS am ON am.id=comb.mas_color_id
LEFT JOIN attribute_masters AS ams ON ams.id=comb.mas_size_id LEFT JOIN purchase_order AS pur ON pur.order_id=pc.order_id LEFT JOIN customers AS c ON pur.cus_id=c.id
LEFT JOIN cus_address AS ca ON ca.id=pur.cus_address_id WHERE pc.order_id='$order_id'";
        $res=$this->db->query($select);
        if($res->num_rows()>0){
            $result=$res->result();
            foreach($result  as $rows){
                $my_order_details[]=array(
                  "id"=>$rows->cart_id,
                  "product_name"=>$rows->product_name,
                  "product_id"=>$rows->product_id,
                  "product_cover_img"=>base_url().'assets/products/'.$rows->product_cover_img,
                  "color_name"=>$rows->attribute_name,
                  "size"=>$rows->size,
                  "price"=>$rows->price,
                  "quantity"=>$rows->quantity,
                );
            }
              $data = array("status" => "success","msg"=>"orders found","my_order_details"=>$my_order_details);
          }else{
              $data = array("status" => "error","msg"=>"No orders found");
          }
          return $data;
      }



      function search_product($search_name,$user_id){
        $select="SELECT tm.id as tag_id,tm.tag_name,p.*,IFNULL(cw.customer_id,'0') AS wishlisted FROM tag_masters as tm left join product_tags as pt on tm.id=pt.tag_id left join products as p on  p.id=pt.product_id LEFT JOIN  cus_wishlist AS cw ON cw.product_id=p.id AND cw.customer_id='$user_id' WHERE tm.tag_name LIKE '$search_name%' AND p.status='Active'  GROUP by p.id";
       $res=$this->db->query($select);
       if($res->num_rows()==0){
          $data = array("status" => "failure","msg"=>"No Product found");
        }else{
            $result_search=$res->result();
            foreach($result_search  as $rows){
                $product_list[]=array(
                  "id"=>$rows->id,
                  "product_name"=>$rows->product_name,
                  "sku_code"=>$rows->sku_code,
                  "product_cover_img"=>base_url().'assets/products/'.$rows->product_cover_img,
                  "prod_size_chart"=>base_url().'assets/products/'.$rows->prod_size_chart,
                  "product_description"=>$rows->product_description,
                  "offer_status"=>$rows->offer_status,
                  "specification_status"=>$rows->specification_status,
                  "combined_status"=>$rows->combined_status,
                  "prod_actual_price"=>$rows->prod_actual_price,
                  "prod_mrp_price"=>$rows->prod_mrp_price,
                  "offer_percentage"=>$rows->offer_percentage,
                  "delivery_fee_status"=>$rows->delivery_fee_status,
                  "prod_return_policy"=>$rows->prod_return_policy,
                  "prod_cod"=>$rows->prod_cod,
                  "product_meta_title"=>$rows->product_meta_title,
                  "product_meta_desc"=>$rows->product_meta_desc,
                  "product_meta_keywords"=>$rows->product_meta_keywords,
                  "stocks_left"=>$rows->stocks_left,
                  "wishlisted"=>$rows->wishlisted,
                );
            }
        $data = array("status" => "success","msg"=>"Product Search  found","product_list"=>$product_list);
        }
        return $data;
      }


}
?>
