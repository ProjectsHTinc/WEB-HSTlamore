<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->helper('cookie');
		$this->load->helper('pdf_helper');
		$this->load->model('homemodel');
	}

	public function index()
	{
		$datas['main_catmenu'] = $this->homemodel->get_main_catmenu();
		$datas['count_cart_session'] = $this->homemodel->cart_list();
		$datas['count_wishlist'] = $this->homemodel->list_wishlist();
		$datas['tag_result'] = $this->homemodel->list_tags();
		$datas['home_banner'] = $this->homemodel->homebanner();
		$datas['home_newproducts'] = $this->homemodel->newproducts();
		$datas['home_advertisement'] = $this->homemodel->homeadvertisement();
		$datas['home_offers'] = $this->homemodel->homeoffer();
		$datas['home_popularproducts'] = $this->homemodel->popularproducts();
		//$datas['categories'] = $this->homemodel->categorylist();
		//$datas['home_bestsaleproducts'] = $this->homemodel->bestsaleproducts();
		//$datas['home_promotions'] = $this->homemodel->homepromotions();
		//print_r($datas['home_popularproducts']);
		$this->load->view('front_header',$datas);
		$this->load->view('index',$datas);
		$this->load->view('front_footer',$datas);
	}
	
	public function existemail(){
		$email=$this->input->post('email');
		$datas=$this->homemodel->exist_email($email);
	}

	public function checkqty(){
		$qty=$this->input->post('qty');
		$product_id=$this->input->post('product_id');
		$com_product_id=$this->input->post('com_product_id');
		$datas=$this->homemodel->check_quantity($product_id,$com_product_id,$qty);
	}

	public function zipcode_check(){
			$zipcode=$this->input->post('nzip');
		if ($zipcode==''){
			$zipcode=$this->input->post('ozip');
		}
		$datas=$this->homemodel->zipcode_check($zipcode);
	}
	
	public function existmobile(){
		$mobile=$this->input->post('mobile');
		$datas=$this->homemodel->exist_mobile($mobile);
	}
	
	public function existemailcustomer(){
		$email=$this->input->post('email');
		$cust_session_id = $this->session->userdata('cust_session_id');
		$datas=$this->homemodel->exist_email_customer($email,$cust_session_id);
	}
	
	public function existmobilecustomer(){
		$mobile=$this->input->post('mobile');
		$cust_session_id = $this->session->userdata('cust_session_id');
		$datas=$this->homemodel->exist_mobile_customer($mobile,$cust_session_id);
	}
	
	public function chkusername(){
		$username=$this->input->post('username');
		$datas=$this->homemodel->exist_username($username);
	}
	
	public function register()
	{
		$datas['main_catmenu'] = $this->homemodel->get_main_catmenu();
		$datas['count_cart_session'] = $this->homemodel->cart_list();
		$datas['count_wishlist'] = $this->homemodel->list_wishlist();
		$datas['tag_result'] = $this->homemodel->list_tags();
		$this->load->view('front_header',$datas);
		$this->load->view('register');
		$this->load->view('front_footer',$datas);
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
		$datas['main_catmenu'] = $this->homemodel->get_main_catmenu();
		$datas['count_cart_session'] = $this->homemodel->cart_list();
		$datas['count_wishlist'] = $this->homemodel->list_wishlist();
		$datas['tag_result'] = $this->homemodel->list_tags();
		$this->load->view('front_header',$datas);
		$this->load->view('login');
		$this->load->view('front_footer',$datas);
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
			$cust_session_id = $this->session->userdata('cust_session_id');
			$mobile=$this->input->post('mobile');
			$email=$this->input->post('email');
			
			$fname=$this->input->post('fname');
			$lname=$this->input->post('lname');
			$dob=$this->input->post('dob');
			$gender=$this->input->post('gender');
			$newsletter=$this->input->post('newsletter');

			$datas['res']=$this->homemodel->customer_update($cust_session_id,$fname,$lname,$mobile,$email,$dob,$gender,$cust_pic,$newsletter);
			
			
			 	if($datas['res']['status']=='success'){
					redirect(base_url()."cust_details/");
				}else{
					redirect(base_url()."error/");
				}
	}
	
	
	public function logout()
		{
			$session_datas = $this->session->userdata();
			$this->session->unset_userdata($session_datas);
			$this->session->sess_destroy();
			redirect(base_url());
		}
		
	public function forgotpassword()
	{
		$datas['main_catmenu'] = $this->homemodel->get_main_catmenu();
		$datas['count_cart_session'] = $this->homemodel->cart_list();
		$datas['count_wishlist'] = $this->homemodel->list_wishlist();
		$datas['tag_result'] = $this->homemodel->list_tags();
		$this->load->view('front_header',$datas);
		$this->load->view('forgot-password');
		$this->load->view('front_footer',$datas);
	}
	
	public function resetpassword()
	{
		$email=$this->input->post('email');
		$datas['res']=$this->homemodel->reset_password($email);
	}
	
	public function myaccount()
	{
		$datas['main_catmenu'] = $this->homemodel->get_main_catmenu();
		$datas['count_cart_session'] = $this->homemodel->cart_list();
		$datas['count_wishlist'] = $this->homemodel->list_wishlist();
		$datas['tag_result'] = $this->homemodel->list_tags();
		$cust_session_id = $this->session->userdata('cust_session_id');
		
		if ($cust_session_id !='') {
			$this->load->view('front_header',$datas);
			$this->load->view('my_account');
			$this->load->view('front_footer',$datas);
		} else {
			redirect(base_url()."login/");
		}
	}
	
	public function cust_orders()
	{
		$cust_session_id = $this->session->userdata('cust_session_id');
		$datas['main_catmenu'] = $this->homemodel->get_main_catmenu();
		$datas['count_cart_session'] = $this->homemodel->cart_list();
		$datas['count_wishlist'] = $this->homemodel->list_wishlist();
		$datas['tag_result'] = $this->homemodel->list_tags();
		$datas['orders'] = $this->homemodel->cust_orders($cust_session_id);
		//print_r($datas['orders']);
		if ($cust_session_id !='') {
			$this->load->view('front_header',$datas);
			$this->load->view('cust_orders');
			$this->load->view('front_footer',$datas);
		} else {
			redirect(base_url()."login/");
		}
	}
	
	public function cust_order_details($order_id)
	{
		$cust_session_id = $this->session->userdata('cust_session_id');
		$datas['main_catmenu'] = $this->homemodel->get_main_catmenu();
		$datas['count_cart_session'] = $this->homemodel->cart_list();
		$datas['count_wishlist'] = $this->homemodel->list_wishlist();
		$datas['tag_result'] = $this->homemodel->list_tags();
		$datas['address_details'] = $this->homemodel->cust_order_address($order_id);
		$datas['order_details'] = $this->homemodel->cust_order_details($order_id);
		if ($cust_session_id !='') {
			$this->load->view('front_header',$datas);
			$this->load->view('cust_order_details');
			$this->load->view('front_footer',$datas);
		} else {
			redirect(base_url()."login/");
		}
	}
	
	public function cust_address()
	{
		$cust_session_id = $this->session->userdata('cust_session_id');
		$datas['main_catmenu'] = $this->homemodel->get_main_catmenu();
		$datas['count_cart_session'] = $this->homemodel->cart_list();
		$datas['count_wishlist'] = $this->homemodel->list_wishlist();
		$datas['tag_result'] = $this->homemodel->list_tags();
		$datas['countrylist'] = $this->homemodel->countrylist();
		$datas['cust_details'] = $this->homemodel->customer_details($cust_session_id);
		$datas['cust_address'] = $this->homemodel->get_cust_address($cust_session_id);
		if ($cust_session_id !='') {
			$this->load->view('front_header',$datas);
			$this->load->view('cust_address',$datas);
			$this->load->view('front_footer',$datas);
		} else {
			redirect(base_url()."login/");
		}
	}
	
	public function cust_address_add()
	{
		$cust_id = $this->session->userdata('cust_session_id');
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
			
		$datas['res']=$this->homemodel->add_cust_address($cust_id,$ncountry_id,$nname,$naddress1,$naddress2,$ntown,$nstate,$nzip,$nemail,$nphone,$nphone1,$nlandmark);
		
		if($datas['res']['status']=='success'){
			redirect(base_url()."cust_address/");
		}else{
			redirect(base_url()."error/");
		}
	}
	
	public function cust_default_address()
	{
		$address_id=$this->input->post('address_id');
		$cust_session_id = $this->session->userdata('cust_session_id');
		$datas['res']=$this->homemodel->cust_default_address($cust_session_id,$address_id);
		
		if($datas['res']['status']=='success'){
			redirect(base_url()."cust_address/");
		}else{
			redirect(base_url()."error/");
		}

	}
	
	public function cust_address_delete($address_id)
	{
		$cust_session_id = $this->session->userdata('cust_session_id');
		$datas['res']=$this->homemodel->cust_address_delete($address_id,$cust_session_id);
		if($datas['res']['status']=='success'){
			redirect(base_url()."cust_address/");
		}else{
			redirect(base_url()."error/");
		}
	}
	
	public function cust_details()
	{
		$datas['main_catmenu'] = $this->homemodel->get_main_catmenu();
		$datas['count_cart_session'] = $this->homemodel->cart_list();
		$datas['count_wishlist'] = $this->homemodel->list_wishlist();
		$datas['tag_result'] = $this->homemodel->list_tags();
		$cust_session_id = $this->session->userdata('cust_session_id');
		
		if ($cust_session_id !='') {
			$datas['cust_logindetails'] = $this->homemodel->customer_logindetails($cust_session_id);
			$datas['cust_details'] = $this->homemodel->customer_details($cust_session_id);
			$this->load->view('front_header',$datas);
			$this->load->view('cust_details', $datas);
			$this->load->view('front_footer',$datas);
		} else {
			redirect(base_url()."login/");
		}
	}
	
	public function cust_change_password()
	{
		$datas['main_catmenu'] = $this->homemodel->get_main_catmenu();
		$datas['count_cart_session'] = $this->homemodel->cart_list();
		$datas['count_wishlist'] = $this->homemodel->list_wishlist();
		$datas['tag_result'] = $this->homemodel->list_tags();
		$cust_session_id = $this->session->userdata('cust_session_id');
		
		if ($cust_session_id !='') {
			$this->load->view('front_header',$datas);
			$this->load->view('change_password');
			$this->load->view('front_footer',$datas);
			
		} else {
			redirect(base_url()."login/");
		}
	}

	public function change_password(){
		$password=$this->input->post('pwdconfirm');
		$cust_session_id = $this->session->userdata('cust_session_id');
		$datas['res']=$this->homemodel->cust_change_password($cust_session_id,$password);
		
		if($datas['res']['status']=='success'){
			redirect(base_url()."login/");
		}else{
			redirect(base_url()."error/");
		}
		
	}
	
	public function categories($cat_id,$cat_name)
	{
		//echo $this->uri->segment(2);exit;
		$datas['main_catmenu'] = $this->homemodel->get_main_catmenu();
		$datas['count_cart_session'] = $this->homemodel->cart_list();
		$datas['count_wishlist'] = $this->homemodel->list_wishlist();
		$datas['tag_result'] = $this->homemodel->list_tags();
		$datas['maincat_count'] = $this->homemodel->get_maincat_count();
		$datas['category_details'] = $this->homemodel->get_categorydetails($cat_id);
		$datas['cat_products'] = $this->homemodel->get_cat_products($cat_id);
		//print_r($datas);
		$this->load->view('front_header',$datas);
		$this->load->view('categories',$datas);
		$this->load->view('front_footer',$datas);
	}
	
	public function search()
	{
		$search_tags=$this->input->post('search_tags');
		if ($search_tags==''){
			$search_tags=$this->input->post('search_tags1');
		}
		//set_cookie('search_values',$search_tags,'3600');

		$datas['main_catmenu'] = $this->homemodel->get_main_catmenu();
		$datas['count_cart_session'] = $this->homemodel->cart_list();
		$datas['count_wishlist'] = $this->homemodel->list_wishlist();
		$datas['tag_result'] = $this->homemodel->list_tags();
		$datas['search_result'] = $this->homemodel->search_result($search_tags);
		
		$this->load->view('front_header',$datas);
		$this->load->view('search',$datas);
		$this->load->view('front_footer',$datas);
	
	}
	
		public function offers()
	{
		$datas['main_catmenu'] = $this->homemodel->get_main_catmenu();
		$datas['count_cart_session'] = $this->homemodel->cart_list();
		$datas['count_wishlist'] = $this->homemodel->list_wishlist();
		$datas['tag_result'] = $this->homemodel->list_tags();
		$datas['maincat_count'] = $this->homemodel->get_maincat_count();
		$datas['offer_products'] = $this->homemodel->get_offer_products();
		//print_r($datas);
		$this->load->view('front_header',$datas);
		$this->load->view('offers',$datas);
		$this->load->view('front_footer',$datas);
	}
	
	public function subcategories($cat_id,$cat_name)
	{
		$datas['main_catmenu'] = $this->homemodel->get_main_catmenu();
		$datas['count_cart_session'] = $this->homemodel->cart_list();
		$datas['count_wishlist'] = $this->homemodel->list_wishlist();
		$datas['tag_result'] = $this->homemodel->list_tags();
		$datas['maincat_count'] = $this->homemodel->get_maincat_count();
		$datas['category_details'] = $this->homemodel->get_categorydetails($cat_id);
		$datas['cat_products'] = $this->homemodel->get_subcat_products($cat_id);
		
		$this->load->view('front_header',$datas);
		$this->load->view('categories',$datas);
		$this->load->view('front_footer',$datas);
	}
	
	public function product_details($prod_id,$prod_name)
	{
		$datas['main_catmenu'] = $this->homemodel->get_main_catmenu();
		$datas['count_cart_session'] = $this->homemodel->cart_list();
		$datas['count_wishlist'] = $this->homemodel->list_wishlist();
		$datas['tag_result'] = $this->homemodel->list_tags();
		$datas['check_review'] = $this->homemodel->check_review($prod_id);
		$datas['review_details'] = $this->homemodel->get_reviewdetails($prod_id);
		$datas['product_details'] = $this->homemodel->get_productdetails($prod_id);
		$datas['product_spec'] = $this->homemodel->get_productspec($prod_id);
		//print_r($datas);
		$this->load->view('front_header',$datas);
		$this->load->view('product_details',$datas);
		$this->load->view('front_footer',$datas);
	}
	
	public function disp_colour()
    {
		$product_id  = $this->input->post('product_id');
		$size_id  = $this->input->post('size_id');
		$datas['display_colour'] = $this->homemodel->get_colour($product_id,$size_id);
        echo json_encode($datas['display_colour']);
    }
	
	public function disp_price()
    {
		$product_id  = $this->input->post('product_id');
		$size_id  = $this->input->post('size_id');
		$colour_id  = $this->input->post('colour_id');
		$datas['display_price'] = $this->homemodel->get_price($product_id,$size_id,$colour_id);
        echo json_encode($datas['display_price']);
    }
	
	public function insertcart()
	{
		$product_id=$this->input->post('product_id');
		$com_product_id=$this->input->post('com_product_id');
		$browser_sess_id  = $this->session->userdata('browser_sess_id');
		$cust_session_id = $this->session->userdata('cust_session_id'); 
		$quantity=$this->input->post('qty');
		$price=$this->input->post('price');
		
		//$datas['main_catmenu'] = $this->homemodel->get_main_catmenu();
		$datas['res']=$this->homemodel->cart_insert($product_id,$com_product_id,$browser_sess_id,$cust_session_id,$quantity);
		
		if($datas['res']['status']=='success'){
			redirect(base_url()."viewcart/");
		}else{
			redirect(base_url()."viewcart/");
		}
	}
	
	
	public function addcart($product_id)
	{
		$browser_sess_id = $this->session->userdata('browser_sess_id');
		$cust_session_id = $this->session->userdata('cust_session_id');

		$datas['res']=$this->homemodel->add_cart($product_id,$browser_sess_id,$cust_session_id);
		if($datas['res']['status']=='success'){
			redirect(base_url()."viewcart/");
		}else{
			redirect(base_url()."viewcart/");
		}
	}
	
	public function viewcart()
	{
		$datas['main_catmenu'] = $this->homemodel->get_main_catmenu();
		$datas['count_cart_session'] = $this->homemodel->cart_list();
		$datas['count_wishlist'] = $this->homemodel->list_wishlist();
		$datas['tag_result'] = $this->homemodel->list_tags();

		$this->load->view('front_header',$datas);
		$this->load->view('cart',$datas);
		$this->load->view('front_footer',$datas);
		
	}
	
	public function cartcheck()
	{
		$browser_sess_id=$this->input->post('browser_sess_id');
		$cust_id=$this->input->post('cust_id');
		$datas=$this->homemodel->check_cart($browser_sess_id,$cust_id);
	}
	
	public function deletecart($cart_id)
	{
		$datas['res']=$this->homemodel->cart_delete($cart_id);
		if($datas['res']['status']=='success'){
			redirect(base_url()."viewcart/");
		}else{
			redirect(base_url()."error/");
		}
	}
	
	public function updatecart()
	{
		$cart_id = $this->input->post('cart_id');
		$product_id = $this->input->post('product_id');
		$quantity = $this->input->post('quantity');
		$price = $this->input->post('price');
		$datas['res'] = $this->homemodel->update_cart($cart_id,$product_id,$quantity,$price);

		if($datas['res']['status']=='success'){
			redirect(base_url()."viewcart/");
		}else{
			redirect(base_url()."error/");
		}
	}
	
	
	public function checkout()
	{
		$cust_session_id = $this->session->userdata('cust_session_id');
		$datas['main_catmenu'] = $this->homemodel->get_main_catmenu();
		$datas['count_cart_session'] = $this->homemodel->cart_list();
		$datas['count_wishlist'] = $this->homemodel->list_wishlist();
		$datas['tag_result'] = $this->homemodel->list_tags();
		$datas['cart_list'] = $this->homemodel->cart_list();
		$datas['countrylist'] = $this->homemodel->countrylist();
		$datas['default_address'] = $this->homemodel->get_cust_address_default($cust_session_id);
		if ($cust_session_id !='') {
			$this->load->view('front_header',$datas);
			$this->load->view('checkout');
			$this->load->view('front_footer',$datas);
		} else {
			redirect(base_url()."login/");
		}
	}
	
	public function cartprocess()
	{
		$datas['main_catmenu'] = $this->homemodel->get_main_catmenu();
		
		$datas['cart_list'] = $this->homemodel->cart_list();
		$datas['count_wishlist'] = $this->homemodel->list_wishlist();
		$datas['tag_result'] = $this->homemodel->list_tags();
		//$datas['cart_process'] = $this->homemodel->cart_process();
		$cust_session_id = $this->session->userdata('cust_session_id');
		
		if ($cust_session_id !='') {
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
			
			$ocountry_id = $this->input->post('ocountry_id');
			$oname = $this->input->post('oname');
			$oaddress1 = $this->input->post('oaddress1');
			$oaddress2 = $this->input->post('oaddress2');
			$otown = $this->input->post('otown');
			$ostate = $this->input->post('ostate');
			$ozip = $this->input->post('ozip');
			$oemail = $this->input->post('oemail');
			$ophone = $this->input->post('ophone');
			$ophone1 = $this->input->post('ophone1');
			$olandmark = $this->input->post('olandmark');
			
			$ncheckout_mess = $this->input->post('ncheckout_mess');
			$scheckout_mess = $this->input->post('scheckout_mess');
			$ship_box = $this->input->post('ship-box');
			$total_amt = $this->input->post('total_amt');
			
			if ($address_value == 'new')
			{
				$datas['res_orders']=$this->homemodel->checkout_address($cust_session_id,$ncountry_id,$nname,$naddress1,$naddress2,$ntown,$nstate,$nzip,$nemail,$nphone,$nphone1,$nlandmark,$ncheckout_mess,$total_amt);
			} else {
				if ($ship_box == '1') {
					$datas['res_orders']=$this->homemodel->checkout_address($cust_session_id,$ncountry_id,$nname,$naddress1,$naddress2,$ntown,$nstate,$nzip,$nemail,$nphone,$nphone1,$nlandmark,$scheckout_mess,$total_amt);
				} else {
					$datas['res_orders']=$this->homemodel->checkout_addressid($cust_session_id,$ocountry_id,$oname,$oaddress1,$oaddress2,$otown,$ostate,$ozip,$oemail,$ophone,$ophone1,$olandmark,$scheckout_mess,$address_id,$total_amt);
				}
			}
			$datas['count_cart_session'] = $this->homemodel->cart_list();
			$this->load->view('front_header',$datas);
			$this->load->view('cart_process',$datas);
			$this->load->view('front_footer',$datas);
			
			//$this->session->unset_userdata('__ci_last_regenerate');
			//$this->session->unset_userdata('browser_sess_id');
		
			} else {
			redirect(base_url()."login/");
		}
	}
	
	public function addwishlist($product_id)
	{
		$datas['res']=$this->homemodel->add_wishlist($product_id);
		if($datas['res']['status']=='success'){
			redirect(base_url()."wishlist/");
		}else{
			redirect(base_url()."error/");
		}
	}
	
	public function deletewishlist($wishlist_id)
	{
		$datas['res']=$this->homemodel->delete_wishlist($wishlist_id);
		if($datas['res']['status']=='success'){
			redirect(base_url()."wishlist/");
		}else{
			redirect(base_url()."error/");
		}
	}
		
	public function wishlist()
	{
		$datas['main_catmenu'] = $this->homemodel->get_main_catmenu();
		$datas['count_cart_session'] = $this->homemodel->cart_list();
		$datas['count_wishlist'] = $this->homemodel->list_wishlist();
		$datas['tag_result'] = $this->homemodel->list_tags();
		$this->load->view('front_header',$datas);
		$this->load->view('wish-list');
		$this->load->view('front_footer',$datas);
	}
	
	public function addreview()
	{
		$comments        = $this->db->escape_str($this->input->post('comments'));
		//$comments = $this->input->post('comments');
		$rating = $this->input->post('rating');
		$rproduct_id = $this->input->post('rproduct_id');
		$ruser_id = $this->input->post('ruser_id');
		
		$datas['res']=$this->homemodel->add_review($ruser_id,$rproduct_id,$comments,$rating);
	}
	
	public function reviewupdate()
	{
		$reviewid = $this->input->post('review_id');
		//$comments = $this->input->post('comments');
		$comments        = $this->db->escape_str($this->input->post('comments'));
		$rating = $this->input->post('rating');
		$rproduct_id = $this->input->post('rproduct_id');
		$ruser_id = $this->input->post('ruser_id');
		
		$datas['res']=$this->homemodel->update_review($reviewid,$ruser_id,$rproduct_id,$comments,$rating);
	}
	
	public function aboutus()
	{
		$datas['main_catmenu'] = $this->homemodel->get_main_catmenu();
		$datas['count_cart_session'] = $this->homemodel->cart_list();
		$datas['count_wishlist'] = $this->homemodel->list_wishlist();
		$datas['tag_result'] = $this->homemodel->list_tags();
		$this->load->view('front_header',$datas);
		$this->load->view('about-us');
		$this->load->view('front_footer',$datas);
	}
	
	
	public function contactus()
	{
		$datas['main_catmenu'] = $this->homemodel->get_main_catmenu();
		$datas['count_cart_session'] = $this->homemodel->cart_list();
		$datas['count_wishlist'] = $this->homemodel->list_wishlist();
		$datas['tag_result'] = $this->homemodel->list_tags();
		$this->load->view('front_header',$datas);
		$this->load->view('contact-us');
		$this->load->view('front_footer',$datas);
	}
	
	public function privacy()
	{
		$datas['main_catmenu'] = $this->homemodel->get_main_catmenu();
		$datas['count_cart_session'] = $this->homemodel->cart_list();
		$datas['count_wishlist'] = $this->homemodel->list_wishlist();
		$this->load->view('front_header',$datas);
		$this->load->view('privacy');
		$this->load->view('front_footer',$datas);
	}
	
	public function contact_us(){
		$name=$this->input->post('name');
		$email=$this->input->post('email');
		$website=$this->input->post('website');
		$subject=$this->input->post('subject');
		$message=$this->input->post('message');
		$datas['res']=$this->homemodel->contact_us($name,$email,$website,$subject,$message);
	}
	
	public function order_pdf()
	{
		$datas['count_cart_session'] = $this->homemodel->cart_list();
		$this->load->view('pdfreport', $datas);
	}
	
}
