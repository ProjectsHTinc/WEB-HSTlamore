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
		$data['result']=$this->mobileapimodel->Login($username,$password,$mob_key,$mobile_type);
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
		$cat_id = $this->input->post("id");
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
		$data['result']=$this->mobileapimodel->product_list($cat_id,$sub_cat_id);
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
		$product_id = $this->input->post("id");
		$data['result']=$this->mobileapimodel->product_details($product_id);
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
		$product_id = $this->input->post("id");
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
		$product_id = $this->input->post("id");
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
			$product_id = $this->input->post("product_id");
			$prod_comb_id = $this->input->post("product_comb_id");
			$user_id = $this->input->post("user_id");
			$data['result']=$this->mobileapimodel->product_cart_remove($product_id,$prod_comb_id,$user_id);
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




}
