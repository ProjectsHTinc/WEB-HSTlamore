<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('customermodel');
	}

	public function index()
	{
		$this->load->view('front_header');
		$this->load->view('index');
		$this->load->view('front_footer');
	}
	
	public function wishlist()
	{
		$this->load->view('front_header');
		$this->load->view('wish-list');
		$this->load->view('front_footer');
	}
	
	public function register()
	{
		$this->load->view('front_header');
		$this->load->view('register');
		$this->load->view('front_footer');
	}
	public function existemail(){
		$email=$this->input->post('email');
		$data=$this->customermodel->exist_email($email);

		}
	public function existmobile(){
		$mobile=$this->input->post('mobile');
		$data=$this->customermodel->exist_mobile($mobile);
	}
	public function customer_registration(){
		$name=$this->input->post('name');
		$mobile=$this->input->post('mobile');
		$email=$this->input->post('email');
		$password=$this->input->post('new_password');
		$datas['res']=$this->loginmodel->customer_registration($name,$mobile,$email,$password);

		}
	public function myaccount()
	{
		$this->load->view('front_header');
		$this->load->view('my_account');
		$this->load->view('front_footer');
	}
	
	public function login()
	{
		$this->load->view('front_header');
		$this->load->view('login');
		$this->load->view('front_footer');
	}
	public function cart()
	{
		$this->load->view('front_header');
		$this->load->view('cart');
		$this->load->view('front_footer');
	}
	public function checkout()
	{
		$this->load->view('front_header');
		$this->load->view('checkout');
		$this->load->view('front_footer');
	}
	
	public function categories()
	{
		$this->load->view('front_header');
		$this->load->view('categories');
		$this->load->view('front_footer');
	}
	
	public function product_details()
	{
		$this->load->view('front_header');
		$this->load->view('product_details');
		$this->load->view('front_footer');
	}
	
		public function aboutus()
	{
		$this->load->view('front_header');
		$this->load->view('about-us');
		$this->load->view('front_footer');
	}
	
	public function contactus()
	{
		$this->load->view('front_header');
		$this->load->view('contact-us');
		$this->load->view('front_footer');
	}
}
