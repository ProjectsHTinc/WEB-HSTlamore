<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tagmaster extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
			$this->load->model('tagmodel');
	}
	public function index()
	{
		$data=$this->session->userdata();
		$user_id=$this->session->userdata('id');
		$user_role=$this->session->userdata('role_type_id');
			if($user_role=='1' || $user_role=='2'){
				$data['res']=$this->tagmodel->get_all_tag();
				$this->load->view('siteadmin/header',$data);
				$this->load->view('siteadmin/tagmaster/tag_create',$data);
				$this->load->view('siteadmin/footer');
		}else{
			$this->load->view('siteadmin/login');
		}
	}

	public function create_tag_name()
	{
		$data=$this->session->userdata();
		$user_id=$this->session->userdata('id');
		$user_role=$this->session->userdata('role_type_id');
		if($user_role=='1' || $user_role=='2'){
				 $tag_name= $this->db->escape_str($this->input->post('tag_name'));
				$tag_status=$this->input->post('tag_status');
				$data=$this->tagmodel->create_tag_name($tag_name,$tag_status,$user_id);
			}else{
			redirect('/');
		}

	}

	public function update_tag()
	{
		$data=$this->session->userdata();
		$user_id=$this->session->userdata('id');
		$user_role=$this->session->userdata('role_type_id');
		if($user_role=='1' || $user_role=='2'){
			$tag_name= $this->db->escape_str($this->input->post('tag_name'));
			$tag_status=$this->input->post('tag_status');
			$tag_id=$this->input->post('tag_id');
			$data=$this->tagmodel->update_tag_name($tag_name,$tag_status,$user_id,$tag_id);
		}else{
			redirect('/');
		}

	}


	public function check_tag_name(){
		$data=$this->session->userdata();
		$user_id=$this->session->userdata('id');
		$user_role=$this->session->userdata('role_type_id');
		$tag_name= $this->db->escape_str($this->input->post('tag_name'));
		$data=$this->tagmodel->check_tag_name($tag_name,$user_id);
	}

	public function check_tag_exist(){
		$data=$this->session->userdata();
		$user_id=$this->session->userdata('id');
		$user_role=$this->session->userdata('role_type_id');
		$tag_id=$this->uri->segment(3);
		$tag_name= $this->db->escape_str($this->input->post('tag_name'));
		$data=$this->tagmodel->check_tag_exist($tag_id,$tag_name,$user_id);
	}



	public function edit()
	{
		$data=$this->session->userdata();
		$user_id=$this->session->userdata('id');
		$user_role=$this->session->userdata('role_type_id');
			if($user_role=='1' || $user_role=='2'){
				$tag_id=$this->uri->segment(3);
				$data['res']=$this->tagmodel->get_tag_edit($tag_id);
				$this->load->view('siteadmin/header',$data);
				$this->load->view('siteadmin/tagmaster/edit_tag',$data);
				$this->load->view('siteadmin/footer');
		}else{
			$this->load->view('siteadmin/login');
		}
	}






}
