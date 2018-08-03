<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adminlogin extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('loginmodel');
		$this->load->model('productmodel');
		$this->load->model('customerprofilemodel');
		$this->load->model('trackingmodel');
	}
	public function index()
	{
		$data=$this->session->userdata();
		$user_id=$this->session->userdata('id');
		$user_role=$this->session->userdata('role_type_id');
			if($user_role=='1' || $user_role=='2'){
				redirect('adminlogin/home');
		}else{
			$this->load->view('siteadmin/login');
		}

	}

	public function home()
	{
		$data=$this->session->userdata();
		$user_id=$this->session->userdata('id');
		$user_role=$this->session->userdata('role_type_id');
		if($user_role=='1' || $user_role=='2'){
				$data['res_count_product']=$this->productmodel->get_count_of_active_product();
				$data['res_count_cust']=$this->customerprofilemodel->get_count_of_active_customer();
				$data['res_recent_orders']=$this->trackingmodel->get_all_success_orders();
				$data['res_prod_stocks']=$this->productmodel->get_all_products();
				$this->load->view('siteadmin/header',$data);
				$this->load->view('siteadmin/index',$data);
				$this->load->view('siteadmin/footer');
		}else{
			redirect('/');
		}

	}



	public function check_login(){
		$username=$this->input->post('user_name');
		$password=md5($this->input->post('password'));
		$result = $this->loginmodel->login($username,$password);
		echo $result['status'];
	}

	public function logout(){
		$datas=$this->session->userdata();
		$this->session->unset_userdata($datas);
		$this->session->sess_destroy();
		redirect('adminlogin/');
	}

	 public function changepassword(){
		 $data=$this->session->userdata();
		 $user_id=$this->session->userdata('id');
		 $user_role=$this->session->userdata('role_type_id');
		 if($user_role=='1' || $user_role=='2'){
				 $this->load->view('siteadmin/header',$data);
				 $this->load->view('siteadmin/changepassword',$data);
				 $this->load->view('siteadmin/footer');
		 }else{
			 redirect('/');
		 }
	 }

	 public function checkpassword(){
		 $data=$this->session->userdata();
		 $user_id=$this->session->userdata('id');
		 $user_role=$this->session->userdata('role_type_id');
		 $password=md5($this->input->post('currentpassword'));
		 $data=$this->loginmodel->checkpassword($password,$user_id);
	 }

	 public function checkemail(){
		 $data=$this->session->userdata();
		 $user_id=$this->session->userdata('id');
		 $user_role=$this->session->userdata('role_type_id');
		 $email=$this->input->post('email');
		 $data=$this->loginmodel->checkemail($email,$user_id);
	 }
	 public function checkphone(){
		 $data=$this->session->userdata();
		 $user_id=$this->session->userdata('id');
		 $user_role=$this->session->userdata('role_type_id');
		 $phone_number=$this->input->post('phone_number');
		 $data=$this->loginmodel->checkphone($phone_number,$user_id);
	 }
	 public function updateprofile(){
		 $data=$this->session->userdata();
		 $user_id=$this->session->userdata('id');
		 $user_role=$this->session->userdata('role_type_id');
			if($user_role=='1' || $user_role=='2'){
			$phone_number=$this->input->post('phone_number');
			$email=$this->input->post('email');
			$name=$this->input->post('name');
			$data=$this->loginmodel->updateprofile($email,$phone_number,$name,$user_id);
		}else{
			redirect('/');
		}

	 }
	 public function updatepassword(){
		 $data=$this->session->userdata();
		 $user_id=$this->session->userdata('id');
		 $user_role=$this->session->userdata('role_type_id');
		 if($user_role=='1' || $user_role=='2'){
			$password=md5($this->input->post('newpassword'));
			$data=$this->loginmodel->updatepassword($password,$user_id);
		 }else{
			 redirect('/');
		 }

	 }
	 public function profile(){
		 $data=$this->session->userdata();
		 $user_id=$this->session->userdata('id');
		 $user_role=$this->session->userdata('role_type_id');
		 if($user_role=='1' || $user_role=='2'){
			 	 $data['res']=$this->loginmodel->get_admin_details($user_id);
				 $this->load->view('siteadmin/header',$data);
				 $this->load->view('siteadmin/profile',$data);
				 $this->load->view('siteadmin/footer');
		 }else{
			 redirect('/');
		 }
	 }

	 public function forgotpassword(){
		 $this->load->view('siteadmin/forgotpassword');
	 }

	 public function resetpassword(){
		 	 $email=$this->input->post('email');
			$data=$this->loginmodel->resetpassword($email);
	 }


}
