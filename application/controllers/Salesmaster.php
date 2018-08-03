<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Salesmaster extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('salesmodel');

	}

	public function index()
	{
		$data=$this->session->userdata();
		$user_id=$this->session->userdata('id');
		$user_role=$this->session->userdata('role_type_id');
			if($user_role=='1' || $user_role=='2'){
				//$data['res_orders']=$this->trackingmodel->get_all_recent_orders();
				$this->load->view('siteadmin/header',$data);
				$this->load->view('siteadmin/sales/get_report_form',$data);
				$this->load->view('siteadmin/footer');
		}else{
			$this->load->view('siteadmin/login');
		}
	}

	public function day_wise_sales()
	{
		$data=$this->session->userdata();
		$user_id=$this->session->userdata('id');
		$user_role=$this->session->userdata('role_type_id');
		if($user_role=='1' || $user_role=='2'){
			$day_name= $this->db->escape_str($this->input->post('day_name'));
			$data['res_day_wise']=$this->salesmodel->day_wise_sales($day_name);
			$this->load->view('siteadmin/header',$data);
			$this->load->view('siteadmin/sales/day_wise_sales',$data);
			$this->load->view('siteadmin/footer');
		}else{
			redirect('/');
		}
	}

	public function month_wise_sales()
	{
		$data=$this->session->userdata();
		$user_id=$this->session->userdata('id');
		$user_role=$this->session->userdata('role_type_id');
		if($user_role=='1' || $user_role=='2'){
			$month_id= $this->db->escape_str($this->input->post('month_id'));
			$year_id= $this->db->escape_str($this->input->post('year_id'));
			$data['res_day_wise']=$this->salesmodel->month_wise_sales($month_id,$year_id);
			$this->load->view('siteadmin/header',$data);
			$this->load->view('siteadmin/sales/month_wise_sales',$data);
			$this->load->view('siteadmin/footer');
		}else{
			redirect('/');
		}
	}













}
