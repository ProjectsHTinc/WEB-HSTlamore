<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tracking extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('trackingmodel');

	}

	public function index()
	{
		$data=$this->session->userdata();
		$user_id=$this->session->userdata('id');
		$user_role=$this->session->userdata('role_type_id');
			if($user_role=='1' || $user_role=='2'){
				$data['res_orders']=$this->trackingmodel->get_all_recent_orders();
				$this->load->view('siteadmin/header',$data);
				$this->load->view('siteadmin/tracking/view_orders',$data);
				$this->load->view('siteadmin/footer');
		}else{
			$this->load->view('siteadmin/login');
		}
	}

	public function check_orders()
	{
		$data=$this->session->userdata();
		$user_id=$this->session->userdata('id');
		$user_role=$this->session->userdata('role_type_id');
		if($user_role=='1' || $user_role=='2'){
			$order_id=$this->uri->segment(3);
			$data['res_cart']=$this->trackingmodel->check_orders($order_id);
			$this->load->view('siteadmin/header',$data);
			$this->load->view('siteadmin/tracking/view_order_cart',$data);
			$this->load->view('siteadmin/footer');
		}else{
			redirect('/');
		}
	}


	public function print_order()
	{
		$data=$this->session->userdata();
		$user_id=$this->session->userdata('id');
		$user_role=$this->session->userdata('role_type_id');
		if($user_role=='1' || $user_role=='2'){
			$order_id=$this->uri->segment(3);
			$data['res_cart']=$this->trackingmodel->check_orders($order_id);
			$this->load->view('siteadmin/header',$data);
			$this->load->view('siteadmin/tracking/print_invoice',$data);
			$this->load->view('siteadmin/footer');
		}else{
			redirect('/');
		}
	}


	public function list_of_orders()
	{
		$data=$this->session->userdata();
		$user_id=$this->session->userdata('id');
		$user_role=$this->session->userdata('role_type_id');
			if($user_role=='1' || $user_role=='2'){
				$data['res_orders']=$this->trackingmodel->get_all_orders();
				$this->load->view('siteadmin/header',$data);
				$this->load->view('siteadmin/tracking/list_of_orders',$data);
				$this->load->view('siteadmin/footer');
		}else{
			$this->load->view('siteadmin/login');
		}
	}
	public function get_status_msg(){
		$status_name= $this->db->escape_str($this->input->post('status_name'));
		$data['res']=$this->trackingmodel->get_status_msg($status_name);
		echo json_encode($data['res']);
	}



	public function get_update_status()
	{
		$data=$this->session->userdata();
		$user_id=$this->session->userdata('id');
		$user_role=$this->session->userdata('role_type_id');
		if($user_role=='1' || $user_role=='2'){
			$current_order_status= $this->db->escape_str($this->input->post('current_order_status'));
			$order_status= $this->db->escape_str($this->input->post('order_status'));
			$order_id= $this->db->escape_str($this->input->post('order_id'));
			$msg_to_customer= $this->db->escape_str($this->input->post('msg_to_customer'));
			$data=$this->trackingmodel->get_update_status($current_order_status,$order_id,$order_status,$msg_to_customer,$user_id);

		}else{
			redirect('/');
		}
	}











}
