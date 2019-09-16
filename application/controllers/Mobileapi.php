<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mobileapi extends CI_Controller {

	public function index()
	{
		$this->load->view('welcome_message');
	}

	function __construct()
    {
        parent::__construct();
		$this->load->model("mobileapimodel");
		$this->load->helper("url");
		$this->load->library('session');
    }

	public function checkMethod()
	{
		if($_SERVER['REQUEST_METHOD'] != 'POST')
		{
			$res = array();
			$res["scode"] = 203;
			$res["message"] = "Request Method not supported";

			echo json_encode($res);
			return FALSE;
		}
		return TRUE;
	}


//-----------------------------------------------//

	public function login()
	{

	  $_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Login";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$username = '';
		$password = '';
		$gcmkey ='';
		$mobiletype ='';
		$login_type ='';

	 	$username = $this->input->post("username");
		$password = $this->input->post("password");
		$mob_key = $this->input->post("mob_key");
		$mobile_type = $this->input->post("mobile_type");
		$login_type=$this->input->post("login_type");
		$data['result']=$this->mobileapimodel->Login($username,$password,$mob_key,$mobile_type,$login_type);
		$response = $data['result'];
		echo json_encode($response);
	}


		public function social_login()
		{

		 $_POST = json_decode(file_get_contents("php://input"), TRUE);

			if(!$this->checkMethod())
			{
				return FALSE;
			}

			if($_POST == FALSE)
			{
				$res = array();
				$res["opn"] = "Login";
				$res["scode"] = 204;
				$res["message"] = "Input error";

				echo json_encode($res);
				return;
			}

			$username = '';
			$password = '';
			$gcmkey ='';
			$mobiletype ='';
			$login_type ='';

		 	$username = $this->input->post("username");
			$password = $this->input->post("password");
			$mob_key = $this->input->post("mob_key");
			$mobile_type = $this->input->post("mobile_type");
			$login_type=$this->input->post("login_type");
			$first_name=$this->input->post("first_name");
			$last_name=$this->input->post("last_name");
			$data['result']=$this->mobileapimodel->social_login($username,$mob_key,$mobile_type,$login_type,$first_name,$last_name);
			$response = $data['result'];
			echo json_encode($response);
		}


//-----------------------------------------------//

//-----------------------------------------------//

	public function registration()
	{
	   $_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Registration";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$name = '';
		$phone ='';
		$email = '';
		$password = '';
		$newsletter ='';
		$mob_key ='';
		$mobile_type = '';

	     $name = $this->input->post("name");


		$phone = $this->input->post("phone");
		$email = $this->input->post("email");
		$password = $this->input->post("password");
		$newsletter = $this->input->post("newsletter");
		$mob_key = $this->input->post("mob_key");
		$mobile_type = $this->input->post("mobile_type");

		$data['result']=$this->mobileapimodel->cust_registration($name,$phone,$email,$password,$newsletter,$mob_key,$mobile_type);
		$response = $data['result'];
		echo json_encode($response);
	}

	public function check_password()
	{

	 $_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Login";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}
		$user_id = $this->input->post("user_id");
		$password = $this->input->post("password");
		$data['result']=$this->mobileapimodel->check_password($user_id,$password);
		$response = $data['result'];
		//print_r($response);
		echo json_encode($response);
	}



	public function password_update()
	{

	 $_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Login";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}
		$user_id = $this->input->post("user_id");
		$password = $this->input->post("password");
		$data['result']=$this->mobileapimodel->password_update($user_id,$password);
		$response = $data['result'];
		//print_r($response);
		echo json_encode($response);
	}

	public function forgot_password()
	{

	 $_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Login";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$email_phone = $this->input->post("email_phone");
		$data['result']=$this->mobileapimodel->forgot_password($email_phone);
		$response = $data['result'];
		//print_r($response);
		echo json_encode($response);
	}


	public function verify_otp_password()
	{

	 $_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Login";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$email_phone = $this->input->post("email_phone");
		$otp = $this->input->post("otp");
		$data['result']=$this->mobileapimodel->verify_otp_password($email_phone,$otp);
		$response = $data['result'];
		//print_r($response);
		echo json_encode($response);
	}



	public function get_profile_details()
	{

	 $_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Login";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}
		$user_id = $this->input->post("user_id");
		$data['result']=$this->mobileapimodel->get_profile_details($user_id);
		$response = $data['result'];
		//print_r($response);
		echo json_encode($response);
	}

	public function update_profile_details()
	{

	 $_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Login";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}
		$user_id = $this->input->post("user_id");
		$first_name = $this->input->post("first_name");
		$last_name = $this->input->post("last_name");
		$email = $this->input->post("email");
		$mobile_number = $this->input->post("phone_number");
		$gender = $this->input->post("gender");
		$dob = $this->input->post("dob");
		$newsletter_status = $this->input->post("newsletter_status");
		$data['result']=$this->mobileapimodel->update_profile_details($user_id,$first_name,$last_name,$email,$mobile_number,$gender,$dob,$newsletter_status);
		$response = $data['result'];
		//print_r($response);
		echo json_encode($response);
	}

//-----------------------------------------------//

//--------------------Home page list---------------------------//

	public function home_page()
	{

	 $_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Login";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$data['result']=$this->mobileapimodel->home_page();
		$response = $data['result'];
		//print_r($response);
		echo json_encode($response);
	}

//-----------------------------------------------//

//--------------------Category list---------------------------//

	public function category_list()
	{

	  $_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Login";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$data['result']=$this->mobileapimodel->category_list();
		$response = $data['result'];
		//print_r($response);
		echo json_encode($response);
	}

//-----------------------------------------------//

//--------------------Category list---------------------------//

	public function sub_cat_list()
	{

	  $_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Login";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}
		$cat_id = $this->input->post("cat_id");
		$data['result']=$this->mobileapimodel->sub_cat_list($cat_id);
		$response = $data['result'];
		//print_r($response);
		echo json_encode($response);
	}

//-----------------------------------------------//

//-----------------------------------------------//

	public function product_list()
	{

	  $_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Login";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}


	 	$cat_id = $this->input->post("cat_id");
		$sub_cat_id = $this->input->post("sub_cat_id");
		$user_id = $this->input->post("user_id");
		$data['result']=$this->mobileapimodel->product_list($cat_id,$sub_cat_id,$user_id);
		$response = $data['result'];
		//print_r($response);
		echo json_encode($response);
	}

//-----------------------------------------------//

//--------------------Product details page---------------------------//

	public function product_details()
	{

	  $_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Login";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}
		$product_id = $this->input->post("product_id");
		$user_id = $this->input->post("user_id");
		$data['result']=$this->mobileapimodel->product_details($product_id,$user_id);
		$response = $data['result'];
		//print_r($response);
		echo json_encode($response);
	}


	public function get_product_color()
	{

		$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Login";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}
		$product_id = $this->input->post("product_id");
		$size_id = $this->input->post("size_id");
		$data['result']=$this->mobileapimodel->get_product_color($product_id,$size_id);
		$response = $data['result'];
		//print_r($response);
		echo json_encode($response);
	}



//-----------------------------------------------//



//--------------------Product Wishlist  ---------------------------//

	public function wishlist()
	{

	  $_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Login";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}
		$product_id = $this->input->post("product_id");
		$user_id = $this->input->post("user_id");
		$data['result']=$this->mobileapimodel->prod_wishlist_add($product_id,$user_id);
		$response = $data['result'];
		//print_r($response);
		echo json_encode($response);
	}


	public function remove_wishlist()
	{

	  $_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Login";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}
		$product_id = $this->input->post("product_id");
		$user_id = $this->input->post("user_id");
		$data['result']=$this->mobileapimodel->remove_wishlist($product_id,$user_id);
		$response = $data['result'];
		//print_r($response);
		echo json_encode($response);
	}



	public function view_wishlist()
	{

	  $_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Login";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}
		$user_id = $this->input->post("user_id");
		$data['result']=$this->mobileapimodel->view_wishlist($user_id);
		$response = $data['result'];
		//print_r($response);
		echo json_encode($response);
	}

//------------------Product cart -----------------------------//

		public function product_cart()
		{

			$_POST = json_decode(file_get_contents("php://input"), TRUE);

			if(!$this->checkMethod())
			{
				return FALSE;
			}

			if($_POST == FALSE)
			{
				$res = array();
				$res["opn"] = "Login";
				$res["scode"] = 204;
				$res["message"] = "Input error";

				echo json_encode($res);
				return;
			}
			$product_id = $this->input->post("product_id");
			$prod_comb_id = $this->input->post("product_comb_id");
			$quantity = $this->input->post("quantity");
			$user_id = $this->input->post("user_id");
			$data['result']=$this->mobileapimodel->product_cart($product_id,$prod_comb_id,$quantity,$user_id);
			$response = $data['result'];
			//print_r($response);
			echo json_encode($response);
		}

		public function product_cart_remove()
		{

			$_POST = json_decode(file_get_contents("php://input"), TRUE);

			if(!$this->checkMethod())
			{
				return FALSE;
			}

			if($_POST == FALSE)
			{
				$res = array();
				$res["opn"] = "Login";
				$res["scode"] = 204;
				$res["message"] = "Input error";

				echo json_encode($res);
				return;
			}

			$cart_id = $this->input->post("cart_id");
			$user_id = $this->input->post("user_id");
			$data['result']=$this->mobileapimodel->product_cart_remove($cart_id,$user_id);
			$response = $data['result'];
			//print_r($response);
			echo json_encode($response);
		}


		public function view_cart_items()
		{

			$_POST = json_decode(file_get_contents("php://input"), TRUE);

			if(!$this->checkMethod())
			{
				return FALSE;
			}

			if($_POST == FALSE)
			{
				$res = array();
				$res["opn"] = "Login";
				$res["scode"] = 204;
				$res["message"] = "Input error";

				echo json_encode($res);
				return;
			}

			$user_id = $this->input->post("user_id");
			$data['result']=$this->mobileapimodel->view_cart_items($user_id);
			$response = $data['result'];
			//print_r($response);
			echo json_encode($response);
		}


		public function cart_quantity()
		{

			$_POST = json_decode(file_get_contents("php://input"), TRUE);

			if(!$this->checkMethod())
			{
				return FALSE;
			}

			if($_POST == FALSE)
			{
				$res = array();
				$res["opn"] = "Login";
				$res["scode"] = 204;
				$res["message"] = "Input error";

				echo json_encode($res);
				return;
			}

			$cart_id = $this->input->post("cart_id");
			$quantity = $this->input->post("quantity");
			$user_id=$this->input->post("user_id");
			$data['result']=$this->mobileapimodel->cart_quantity($cart_id,$quantity,$user_id);
			$response = $data['result'];
			//print_r($response);
			echo json_encode($response);
		}


		//------Product Review----//

		public function product_reviews()
		{

			$_POST = json_decode(file_get_contents("php://input"), TRUE);

			if(!$this->checkMethod())
			{
				return FALSE;
			}

			if($_POST == FALSE)
			{
				$res = array();
				$res["opn"] = "Login";
				$res["scode"] = 204;
				$res["message"] = "Input error";

				echo json_encode($res);
				return;
			}


			$product_id=$this->input->post("product_id");
			$data['result']=$this->mobileapimodel->product_reviews($product_id);
			$response = $data['result'];
			//print_r($response);
			echo json_encode($response);
		}


		public function product_reviews_add()
		{

			$_POST = json_decode(file_get_contents("php://input"), TRUE);

			if(!$this->checkMethod())
			{
				return FALSE;
			}

			if($_POST == FALSE)
			{
				$res = array();
				$res["opn"] = "Login";
				$res["scode"] = 204;
				$res["message"] = "Input error";

				echo json_encode($res);
				return;
			}

			$product_id=$this->input->post("product_id");
			$user_id=$this->input->post("user_id");
			$rating=$this->input->post("rating");
			$comment=$this->input->post("comment");
			$data['result']=$this->mobileapimodel->product_reviews_add($product_id,$user_id,$rating,$comment);
			$response = $data['result'];
			//print_r($response);
			echo json_encode($response);
		}

		public function product_review_check()
		{

			$_POST = json_decode(file_get_contents("php://input"), TRUE);

			if(!$this->checkMethod())
			{
				return FALSE;
			}

			if($_POST == FALSE)
			{
				$res = array();
				$res["opn"] = "Login";
				$res["scode"] = 204;
				$res["message"] = "Input error";

				echo json_encode($res);
				return;
			}

			$product_id=$this->input->post("product_id");
			$user_id=$this->input->post("user_id");
			$data['result']=$this->mobileapimodel->product_review_check($product_id,$user_id);
			$response = $data['result'];
			//print_r($response);
			echo json_encode($response);
		}


		public function review_update()
		{

			$_POST = json_decode(file_get_contents("php://input"), TRUE);

			if(!$this->checkMethod())
			{
				return FALSE;
			}

			if($_POST == FALSE)
			{
				$res = array();
				$res["opn"] = "Login";
				$res["scode"] = 204;
				$res["message"] = "Input error";

				echo json_encode($res);
				return;
			}

			$user_id=$this->input->post("user_id");
			$rating=$this->input->post("rating");
			$comment=$this->input->post("comment");
			$review_id=$this->input->post("review_id");
			$data['result']=$this->mobileapimodel->review_update($user_id,$rating,$comment,$review_id);
			$response = $data['result'];
			//print_r($response);
			echo json_encode($response);
		}


		public function address_list()
		{

			$_POST = json_decode(file_get_contents("php://input"), TRUE);

			if(!$this->checkMethod())
			{
				return FALSE;
			}

			if($_POST == FALSE)
			{
				$res = array();
				$res["opn"] = "Login";
				$res["scode"] = 204;
				$res["message"] = "Input error";

				echo json_encode($res);
				return;
			}

			$user_id=$this->input->post("user_id");
			$data['result']=$this->mobileapimodel->address_list($user_id);
			$response = $data['result'];
			//print_r($response);
			echo json_encode($response);
		}


				public function address_create()
				{

					$_POST = json_decode(file_get_contents("php://input"), TRUE);

					if(!$this->checkMethod())
					{
						return FALSE;
					}

					if($_POST == FALSE)
					{
						$res = array();
						$res["opn"] = "Login";
						$res["scode"] = 204;
						$res["message"] = "Input error";

						echo json_encode($res);
						return;
					}

					$user_id=$this->input->post("user_id");
					$country_id=$this->input->post("country_id");
					$state=$this->input->post("state");
					$city=$this->input->post("city");
					$pincode=$this->input->post("pincode");
					$house_no=$this->input->post("house_no");
					$street=$this->input->post("street");
					$landmark=$this->input->post("landmark");
					$full_name=$this->input->post("full_name");
					$mobile_number=$this->input->post("mobile_number");
					$email_address=$this->input->post("email_address");
					$alternative_mobile_number=$this->input->post("alternative_mobile_number");
					$address_type=$this->input->post("address_type");
					$address_mode=$this->input->post("address_mode");
					$data['result']=$this->mobileapimodel->address_create($user_id,$country_id,$state,$city,$pincode,$house_no,$street,$landmark,$full_name,$mobile_number,$email_address,$alternative_mobile_number,$address_type,$address_mode);
					$response = $data['result'];
					//print_r($response);
					echo json_encode($response);
				}



				public function check_pincode()
				{

					$_POST = json_decode(file_get_contents("php://input"), TRUE);

					if(!$this->checkMethod())
					{
						return FALSE;
					}

					if($_POST == FALSE)
					{
						$res = array();
						$res["opn"] = "Login";
						$res["scode"] = 204;
						$res["message"] = "Input error";

						echo json_encode($res);
						return;
					}

					 $pin_code=$this->input->post("pin_code");
					
					$data['result']=$this->mobileapimodel->check_pincode($pin_code);
					$response = $data['result'];
					//print_r($response);
					echo json_encode($response);
				}



				public function place_order()
				{

					$_POST = json_decode(file_get_contents("php://input"), TRUE);

					if(!$this->checkMethod())
					{
						return FALSE;
					}

					if($_POST == FALSE)
					{
						$res = array();
						$res["opn"] = "Login";
						$res["scode"] = 204;
						$res["message"] = "Input error";

						echo json_encode($res);
						return;
					}

					$user_id=$this->input->post("user_id");
					$address_id=$this->input->post("address_id");
					$cus_notes=$this->input->post("cus_notes");
					$data['result']=$this->mobileapimodel->place_order($user_id,$address_id,$cus_notes);
					$response = $data['result'];
					//print_r($response);
					echo json_encode($response);
				}


				public function view_orders()
				{

					$_POST = json_decode(file_get_contents("php://input"), TRUE);

					if(!$this->checkMethod())
					{
						return FALSE;
					}

					if($_POST == FALSE)
					{
						$res = array();
						$res["opn"] = "Login";
						$res["scode"] = 204;
						$res["message"] = "Input error";

						echo json_encode($res);
						return;
					}

					$user_id=$this->input->post("user_id");
					$data['result']=$this->mobileapimodel->view_orders($user_id);
					$response = $data['result'];
					//print_r($response);
					echo json_encode($response);
				}

				public function check_my_order()
				{

				$_POST = json_decode(file_get_contents("php://input"), TRUE);

					if(!$this->checkMethod())
					{
						return FALSE;
					}

					if($_POST == FALSE)
					{
						$res = array();
						$res["opn"] = "Login";
						$res["scode"] = 204;
						$res["message"] = "Input error";

						echo json_encode($res);
						return;
					}

					$order_id=$this->input->post("order_id");
					$data['result']=$this->mobileapimodel->check_my_order($order_id);
					$response = $data['result'];
					//print_r($response);
					echo json_encode($response);
				}


				public function search_product()
				{

				$_POST = json_decode(file_get_contents("php://input"), TRUE);

					if(!$this->checkMethod())
					{
						return FALSE;
					}

					if($_POST == FALSE)
					{
						$res = array();
						$res["opn"] = "Login";
						$res["scode"] = 204;
						$res["message"] = "Input error";

						echo json_encode($res);
						return;
					}

					$search_name=$this->input->post("search_name");
					$user_id=$this->input->post("user_id");
					$data['result']=$this->mobileapimodel->search_product($search_name,$user_id);
					$response = $data['result'];
					//print_r($response);
					echo json_encode($response);
				}


}
