<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adminlogin extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
			$this->load->model('loginmodel');
	}

	public function home()
	{
		$data=$this->session->userdata();
		$user_id=$this->session->userdata('id');
		$user_role=$this->session->userdata('role_type_id');
		if($user_role=='1' || $user_role=='2'){
				$this->load->view('siteadmin/header',$data);
				$this->load->view('siteadmin/index',$data);
				$this->load->view('siteadmin/footer');
		}else{
			redirect('/');
		}

	}

	public function index()
	{


		$this->load->view('siteadmin/login');

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


	 public function updatepassword(){
		 $data=$this->session->userdata();
		 $user_id=$this->session->userdata('id');
		 $user_role=$this->session->userdata('role_type_id');
		 if($user_role=='1' || $user_role=='2'){
			$password=md5($this->input->post('newpassword'));
			$data=$this->loginmodel->updatepassword($password,$user_id);
		 }else{

		 }

	 }

}
