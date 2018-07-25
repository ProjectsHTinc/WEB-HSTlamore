<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('homemodel');
	}

	public function index()
	{
		$data['main_catmenu'] = $this->homemodel->get_main_catmenu();
		//$data['categories'] = $this->homemodel->categorylist();
		//$data['home_banner'] = $this->homemodel->homebanner();
		//$data['home_newproducts'] = $this->homemodel->newproducts();
		//$data['home_bestsaleproducts'] = $this->homemodel->bestsaleproducts();
		//$data['home_promotions'] = $this->homemodel->homepromotions();
		$this->load->view('front_header',$data);
		$this->load->view('index',$data);
		$this->load->view('front_footer');
	}
	
	public function existemail(){
		$email=$this->input->post('email');
		$data=$this->homemodel->exist_email($email);
	}

	public function existmobile(){
		$mobile=$this->input->post('mobile');
		$data=$this->homemodel->exist_mobile($mobile);
	}
	
	public function existemailcustomer(){
		$email=$this->input->post('email');
		$cust_id = $this->session->userdata('cust_id');
		$data=$this->homemodel->exist_email_customer($email,$cust_id);
	}
	
	public function existmobilecustomer(){
		$mobile=$this->input->post('mobile');
		$cust_id = $this->session->userdata('cust_id');
		$data=$this->homemodel->exist_mobile_customer($mobile,$cust_id);
	}
	
	public function chkusername(){
		$username=$this->input->post('username');
		$data=$this->homemodel->exist_username($username);
	}
	
	public function register()
	{
		$data['main_catmenu'] = $this->homemodel->get_main_catmenu();
		$this->load->view('front_header',$data);
		$this->load->view('register');
		$this->load->view('front_footer');
	}
	
	public function customer_registration(){
		$name=$this->input->post('name');
		$mobile=$this->input->post('mobile');
		$email=$this->input->post('email');
		$password=$this->input->post('pwdconfirm');
		$newsletter=$this->input->post('newsletter');
		$datas['res']=$this->homemodel->customer_registration($name,$mobile,$email,$password,$newsletter);
		}
	
	public function login()
	{
		$data['main_catmenu'] = $this->homemodel->get_main_catmenu();
		$this->load->view('front_header',$data);
		$this->load->view('login');
		$this->load->view('front_footer');
	}
	
	public function customer_login()
	{
		$username=$this->input->post('username');
		$password=$this->input->post('pass');
		$datas['res']=$this->homemodel->customer_login($username,$password);
	}
	
	public function customer_update(){
		
		$cust_pic = "";
		
		if ($_FILES['profile_pic']['name']!="") {
			$profile_pic      = $_FILES['profile_pic']['name'];
			$temp = pathinfo($profile_pic, PATHINFO_EXTENSION);
			$file_name      = time() . rand(1, 5) . rand(6, 10);
			$cust_pic   = $file_name. '.' .$temp;
			$uploaddir      = 'assets/front/profile/';
			$profilepic     = $uploaddir . $cust_pic;
			move_uploaded_file($_FILES['profile_pic']['tmp_name'], $profilepic);
		}
			$cust_id = $this->session->userdata('cust_id');
			$mobile=$this->input->post('mobile');
			$email=$this->input->post('email');
			
			$fname=$this->input->post('fname');
			$lname=$this->input->post('lname');
			$dob=$this->input->post('dob');
			$gender=$this->input->post('gender');
			$newsletter=$this->input->post('newsletter');

			$datas['res']=$this->homemodel->customer_update($cust_id,$fname,$lname,$mobile,$email,$dob,$gender,$cust_pic,$newsletter);
	}
	
	
	public function logout()
		{
			$session_data = $this->session->userdata();
			$this->session->unset_userdata($session_data);
			$this->session->sess_destroy();
			redirect(base_url());
		}
		
	public function forgotpassword()
	{
		$data['main_catmenu'] = $this->homemodel->get_main_catmenu();
		$this->load->view('front_header',$data);
		$this->load->view('forgot-password');
		$this->load->view('front_footer');
	}
	
	public function resetpassword()
	{
		$email=$this->input->post('email');
		$datas['res']=$this->homemodel->reset_password($email);
	}
	
	public function myaccount()
	{
		$data['main_catmenu'] = $this->homemodel->get_main_catmenu();
		$cust_id = $this->session->userdata('cust_id');
		
		if ($cust_id !='') {
			$this->load->view('front_header',$data);
			$this->load->view('my_account');
			$this->load->view('front_footer');
		} else {
			redirect(base_url()."login/");
		}
	}
	
	public function cust_orders()
	{
		$data['main_catmenu'] = $this->homemodel->get_main_catmenu();
		$cust_id = $this->session->userdata('cust_id');
		
		if ($cust_id !='') {
			$this->load->view('front_header',$data);
			$this->load->view('cust_orders');
			$this->load->view('front_footer');
		} else {
			redirect(base_url()."login/");
		}
	}
	
	public function cust_address()
	{
		$cust_id = $this->session->userdata('cust_id');
		$data['main_catmenu'] = $this->homemodel->get_main_catmenu();
		$data['cust_address'] = $this->homemodel->get_cust_address($cust_id);
		//print_r ($data);
		if ($cust_id !='') {
			$this->load->view('front_header',$data);
			$this->load->view('cust_address',$data);
			$this->load->view('front_footer');
		} else {
			redirect(base_url()."login/");
		}
	}
	
	public function cust_default_address()
	{
		$address_id=$this->input->post('address_id');
		$cust_id = $this->session->userdata('cust_id');
		$datas['res']=$this->homemodel->cust_default_address($cust_id,$address_id);
	}
	
	public function cust_address_delete($address_id)
	{
		$cust_id = $this->session->userdata('cust_id');
		$datas['res']=$this->homemodel->cust_address_delete($address_id,$cust_id);
	}
	
	public function cust_details()
	{
		$data['main_catmenu'] = $this->homemodel->get_main_catmenu();
		$cust_id = $this->session->userdata('cust_id');
		
		if ($cust_id !='') {
			$data['cust_logindetails'] = $this->homemodel->customer_logindetails($cust_id);
			$data['cust_details'] = $this->homemodel->customer_details($cust_id);
			$this->load->view('front_header',$data);
			$this->load->view('cust_details', $data);
			$this->load->view('front_footer');
		} else {
			redirect(base_url()."login/");
		}
	}
	
	public function cust_change_password()
	{
		$data['main_catmenu'] = $this->homemodel->get_main_catmenu();
		$cust_id = $this->session->userdata('cust_id');
		
		if ($cust_id !='') {
			$this->load->view('front_header',$data);
			$this->load->view('change_password');
			$this->load->view('front_footer');
		} else {
			redirect(base_url()."login/");
		}
	}

	public function change_password(){
		$password=$this->input->post('pwdconfirm');
		$cust_id = $this->session->userdata('cust_id');
		$datas['res']=$this->homemodel->cust_change_password($cust_id,$password);
	}
	
	public function categories($cat_id,$cat_name)
	{
		$data['main_catmenu'] = $this->homemodel->get_main_catmenu();
		$data['maincat_count'] = $this->homemodel->get_maincat_count();
		$data['category_details'] = $this->homemodel->get_categorydetails($cat_id);
		$data['cat_products'] = $this->homemodel->get_cat_products($cat_id);
		//print_r($data);
		$this->load->view('front_header',$data);
		$this->load->view('categories',$data);
		$this->load->view('front_footer');
	}
		public function subcategories($cat_id,$cat_name)
	{
		$data['main_catmenu'] = $this->homemodel->get_main_catmenu();
		$data['maincat_count'] = $this->homemodel->get_maincat_count();
		$data['category_details'] = $this->homemodel->get_categorydetails($cat_id);
		$data['cat_products'] = $this->homemodel->get_subcat_products($cat_id);
		
		$this->load->view('front_header',$data);
		$this->load->view('categories',$data);
		$this->load->view('front_footer');
	}
	
	public function product_details()
	{
		$data['main_catmenu'] = $this->homemodel->get_main_catmenu();
		$this->load->view('front_header',$data);
		$this->load->view('product_details');
		$this->load->view('front_footer');
	}
	
	public function cart()
	{
		$data['main_catmenu'] = $this->homemodel->get_main_catmenu();
		$data['cart_list'] = $this->homemodel->cart_list();
		$this->load->view('front_header',$data);
		$this->load->view('cart',$data);
		$this->load->view('front_footer');
	}
	
	public function checkout()
	{
		$data['main_catmenu'] = $this->homemodel->get_main_catmenu();
		$data['countrylist'] = $this->homemodel->countrylist();
		$cust_id = $this->session->userdata('cust_id');
		
		if ($cust_id !='') {
			$this->load->view('front_header',$data);
			$this->load->view('checkout');
			$this->load->view('front_footer');
		} else {
			redirect(base_url()."login/");
		}
	}
	
	public function cartprocess()
	{
		$data['main_catmenu'] = $this->homemodel->get_main_catmenu();
		$cust_id = $this->session->userdata('cust_id');
		
		if ($cust_id !='') {
			$address_value = $this->input->post('address_value');
			$address_id = $this->input->post('address_id');
			
			$ncountry_id = $this->input->post('ncountry_id');
			$nname = $this->input->post('nname');
			$naddress1 = $this->input->post('naddress1');
			$naddress2 = $this->input->post('naddress2');
			$ntown = $this->input->post('ntown');
			$nstate = $this->input->post('nstate');
			$nzip = $this->input->post('nzip');
			$nemail = $this->input->post('nemail');
			$nphone = $this->input->post('nphone');
			$nphone1 = $this->input->post('nphone1');
			$nlandmark = $this->input->post('nlandmark');
			$ncheckout_mess = $this->input->post('ncheckout_mess');
			$scheckout_mess = $this->input->post('scheckout_mess');
			
			if ($address_value == 'new')
			{
				$data['orders']=$this->homemodel->checkout_address($cust_id,$ncountry_id,$nname,$naddress1,$naddress2,$ntown,$nstate,$nzip,$nemail,$nphone,$nphone1,$nlandmark,$ncheckout_mess);
			} else {
				if (isset($_POST['ship-box'])) {
					$data['orders']=$this->homemodel->checkout_address($cust_id,$ncountry_id,$nname,$naddress1,$naddress2,$ntown,$nstate,$nzip,$nemail,$nphone,$nphone1,$nlandmark,$scheckout_mess);
				} else {
					$data['orders']=$this->homemodel->checkout_addressid($cust_id,$address_id);
				}
			}
			//print_r($data);
			$this->load->view('front_header',$data);
			$this->load->view('cart_process',$data);
			$this->load->view('front_footer');
			} else {
			redirect(base_url()."login/");
		}
	}
	
	
	public function aboutus()
	{
		$data['main_catmenu'] = $this->homemodel->get_main_catmenu();
		$this->load->view('front_header',$data);
		$this->load->view('about-us');
		$this->load->view('front_footer');
	}
	
	public function wishlist()
	{
		$data['main_catmenu'] = $this->homemodel->get_main_catmenu();
		$this->load->view('front_header',$data);
		$this->load->view('wish-list');
		$this->load->view('front_footer');
	}
	
	public function contactus()
	{
		$data['main_catmenu'] = $this->homemodel->get_main_catmenu();
		$this->load->view('front_header',$data);
		$this->load->view('contact-us');
		$this->load->view('front_footer');
	}
	
	public function privacy()
	{
		$data['main_catmenu'] = $this->homemodel->get_main_catmenu();
		$this->load->view('front_header',$data);
		$this->load->view('privacy');
		$this->load->view('front_footer');
	}
	
	public function contact_us(){
		$name=$this->input->post('name');
		$email=$this->input->post('email');
		$website=$this->input->post('website');
		$subject=$this->input->post('subject');
		$message=$this->input->post('message');
		$datas['res']=$this->homemodel->contact_us($name,$email,$website,$subject,$message);
	}
	

	
	
}
