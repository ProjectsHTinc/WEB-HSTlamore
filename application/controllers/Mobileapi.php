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




}
