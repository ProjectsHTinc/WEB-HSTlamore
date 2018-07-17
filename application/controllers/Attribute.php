<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Attribute extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
			$this->load->model('attributemodel');
	}
	public function index()
	{
		$data=$this->session->userdata();
		$user_id=$this->session->userdata('id');
		$user_role=$this->session->userdata('role_type_id');
			if($user_role=='1' || $user_role=='2'){
				$data['res']=$this->attributemodel->get_all_attribute();
				$this->load->view('siteadmin/header',$data);
				$this->load->view('siteadmin/attribute/create',$data);
				$this->load->view('siteadmin/footer');
		}else{
			$this->load->view('siteadmin/login');
		}
	}

	public function create_attribute()
	{
		$data=$this->session->userdata();
		$user_id=$this->session->userdata('id');
		$user_role=$this->session->userdata('role_type_id');
		if($user_role=='1' || $user_role=='2'){
				$att_type= $this->db->escape_str($this->input->post('att_type'));
				$color_name= $this->db->escape_str($this->input->post('color_name'));
				$attribute_color_value=$this->input->post('attribute_color_value');
				$attribute_size_value= $this->db->escape_str($this->input->post('attribute_size_value'));
				$att_status= $this->db->escape_str($this->input->post('att_status'));
				$data=$this->attributemodel->create_attribute($att_type,$color_name,$attribute_color_value,$attribute_size_value,$att_status,$user_id);
			}else{
			redirect('/');
		}

	}

	public function update_attribute()
	{
		$data=$this->session->userdata();
		$user_id=$this->session->userdata('id');
		$user_role=$this->session->userdata('role_type_id');
		if($user_role=='1' || $user_role=='2'){
			 $att_type= $this->db->escape_str($this->input->post('att_type'));

			$color_name= $this->db->escape_str($this->input->post('color_name'));
			$attribute_color_value=$this->input->post('attribute_color_value');
			$attribute_size_value= $this->db->escape_str($this->input->post('attribute_size_value'));
			$att_status= $this->db->escape_str($this->input->post('att_status'));
			$att_id= $this->db->escape_str($this->input->post('att_id'));
			$data=$this->attributemodel->update_attribute($att_type,$color_name,$attribute_color_value,$attribute_size_value,$att_status,$user_id,$att_id);

		}else{
			redirect('/');
		}

	}

	public function check_att_exist(){
		$data=$this->session->userdata();
		$user_id=$this->session->userdata('id');
		$user_role=$this->session->userdata('role_type_id');
		$att_id=$this->uri->segment(3);
		$att_name= $this->db->escape_str($this->input->post('attribute_size_value'));
		$data=$this->attributemodel->check_att_exist($att_id,$att_name,$user_id);
	}


	public function edit_attr()
	{
		$data=$this->session->userdata();
		$user_id=$this->session->userdata('id');
		$user_role=$this->session->userdata('role_type_id');
			if($user_role=='1' || $user_role=='2'){
				$att_id=$this->uri->segment(3);
				$data['res']=$this->attributemodel->get_attribute_edit($att_id);
				$this->load->view('siteadmin/header',$data);
				$this->load->view('siteadmin/attribute/edit_attribute',$data);
				$this->load->view('siteadmin/footer');
		}else{
			$this->load->view('siteadmin/login');
		}
	}








}
