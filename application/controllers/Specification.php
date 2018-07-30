<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Specification extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
			$this->load->model('specificationmodel');
	}
	public function index()
	{
		$data=$this->session->userdata();
		$user_id=$this->session->userdata('id');
		$user_role=$this->session->userdata('role_type_id');
			if($user_role=='1' || $user_role=='2'){
				$data['res']=$this->specificationmodel->get_all_specification();
				$this->load->view('siteadmin/header',$data);
				$this->load->view('siteadmin/specification/spec_create',$data);
				$this->load->view('siteadmin/footer');
		}else{
			$this->load->view('siteadmin/login');
		}
	}

	public function create_spec_name()
	{
		$data=$this->session->userdata();
		$user_id=$this->session->userdata('id');
		$user_role=$this->session->userdata('role_type_id');
		if($user_role=='1' || $user_role=='2'){
				$spec_name= $this->db->escape_str($this->input->post('spec_name'));
				$spec_status=$this->input->post('spec_status');
				$data=$this->specificationmodel->create_spec_name($spec_name,$spec_status,$user_id);
			}else{
			redirect('/');
		}

	}

	public function update_specification()
	{
		$data=$this->session->userdata();
		$user_id=$this->session->userdata('id');
		$user_role=$this->session->userdata('role_type_id');
		if($user_role=='1' || $user_role=='2'){
			$spec_name= $this->db->escape_str($this->input->post('spec_name'));
			$spec_id= $this->db->escape_str($this->input->post('spec_id'));
			$spec_status=$this->input->post('spec_status');
			$data=$this->specificationmodel->update_spec_name($spec_name,$spec_status,$user_id,$spec_id);
		}else{
			redirect('/');
		}

	}


	public function check_spec_name(){
		$data=$this->session->userdata();
		$user_id=$this->session->userdata('id');
		$user_role=$this->session->userdata('role_type_id');
		$spec_name= $this->db->escape_str($this->input->post('spec_name'));
		$data=$this->specificationmodel->check_spec_name($spec_name,$user_id);
	}

	public function check_spec_exist(){
		$data=$this->session->userdata();
		$user_id=$this->session->userdata('id');
		$user_role=$this->session->userdata('role_type_id');
		$specs_id=$this->uri->segment(3);
		$specs_name= $this->db->escape_str($this->input->post('spec_name'));
		$data=$this->specificationmodel->check_spec_exist($specs_id,$specs_name,$user_id);
	}



	public function edit()
	{
		$data=$this->session->userdata();
		$user_id=$this->session->userdata('id');
		$user_role=$this->session->userdata('role_type_id');
			if($user_role=='1' || $user_role=='2'){
				$spec_id=$this->uri->segment(3);
				$data['res']=$this->specificationmodel->get_specification_edit($spec_id);
				$this->load->view('siteadmin/header',$data);
				$this->load->view('siteadmin/specification/edit_specs',$data);
				$this->load->view('siteadmin/footer');
		}else{
			$this->load->view('siteadmin/login');
		}
	}






}
