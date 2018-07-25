<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Zipcodemaster extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
			$this->load->model('zipcodemodel');
	}
	public function index()
	{
		$data=$this->session->userdata();
		$user_id=$this->session->userdata('id');
		$user_role=$this->session->userdata('role_type_id');
			if($user_role=='1' || $user_role=='2'){
				$data['res']=$this->zipcodemodel->get_all_zipcode();
				$this->load->view('siteadmin/header',$data);
				$this->load->view('siteadmin/zipcode/zipcode_create',$data);
				$this->load->view('siteadmin/footer');
		}else{
			$this->load->view('siteadmin/login');
		}
	}

	public function create_zip_code()
	{
		$data=$this->session->userdata();
		$user_id=$this->session->userdata('id');
		$user_role=$this->session->userdata('role_type_id');
		if($user_role=='1' || $user_role=='2'){
				$zip_code= $this->db->escape_str($this->input->post('zip_code'));
				$zip_desc=$this->db->escape_str($this->input->post('zip_desc'));
				$zip_status=$this->input->post('zip_status');
				$data=$this->zipcodemodel->create_zip_code($zip_code,$zip_desc,$zip_status,$user_id);
			}else{
			redirect('/');
		}

	}

	public function update_zipcode()
	{
		$data=$this->session->userdata();
		$user_id=$this->session->userdata('id');
		$user_role=$this->session->userdata('role_type_id');
		if($user_role=='1' || $user_role=='2'){
			$zip_code= $this->db->escape_str($this->input->post('zip_code'));
			$zip_code_id= $this->db->escape_str($this->input->post('zip_code_id'));
			$zip_desc=$this->db->escape_str($this->input->post('zip_desc'));
			$zip_status=$this->input->post('zip_status');
			$data=$this->zipcodemodel->update_zipcode($zip_code,$zip_code_id,$zip_desc,$zip_status,$user_id);
		}else{
			redirect('/');
		}

	}


	public function check_zip_code(){
		$data=$this->session->userdata();
		$user_id=$this->session->userdata('id');
		$user_role=$this->session->userdata('role_type_id');
		$zip_code= $this->db->escape_str($this->input->post('zip_code'));
		$data=$this->zipcodemodel->check_zip_code($zip_code,$user_id);
	}

	public function check_zip_exist(){
		$data=$this->session->userdata();
		$user_id=$this->session->userdata('id');
		$user_role=$this->session->userdata('role_type_id');
		$zip_id=$this->uri->segment(3);
		$zip_code= $this->db->escape_str($this->input->post('zip_code'));
		$data=$this->zipcodemodel->check_zip_exist($zip_id,$zip_code,$user_id);
	}



	public function edit()
	{
		$data=$this->session->userdata();
		$user_id=$this->session->userdata('id');
		$user_role=$this->session->userdata('role_type_id');
			if($user_role=='1' || $user_role=='2'){
				$zip_id=$this->uri->segment(3);
				$data['res']=$this->zipcodemodel->get_zip_edit($zip_id);
				$this->load->view('siteadmin/header',$data);
				$this->load->view('siteadmin/zipcode/edit_zip_code',$data);
				$this->load->view('siteadmin/footer');
		}else{
			$this->load->view('siteadmin/login');
		}
	}






}
