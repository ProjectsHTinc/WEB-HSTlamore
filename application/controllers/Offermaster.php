<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Offermaster extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('adsmodel');
		$this->load->model('offermodel');
		$this->load->model('productmodel');
	}
	public function index()
	{
		$data=$this->session->userdata();
		$user_id=$this->session->userdata('id');
		$user_role=$this->session->userdata('role_type_id');
			if($user_role=='1' || $user_role=='2'){
				$data['res_prod']=$this->productmodel->get_all_active_product();
			 	$data['res_offer_prod']=$this->offermodel->get_all_offer_product();
				$this->load->view('siteadmin/header',$data);
				$this->load->view('siteadmin/offer/create_offer',$data);
				$this->load->view('siteadmin/footer');
		}else{
			$this->load->view('siteadmin/login');
		}
	}

	public function create_offer()
	{
		$data=$this->session->userdata();
		$user_id=$this->session->userdata('id');
		$user_role=$this->session->userdata('role_type_id');
		if($user_role=='1' || $user_role=='2'){
			$prod_id= $this->db->escape_str($this->input->post('prod_id'));
			$offer_name= $this->db->escape_str($this->input->post('offer_name'));
			$offer_percentage= $this->db->escape_str($this->input->post('offer_percentage'));
			$prod_actucal_price= $this->db->escape_str($this->input->post('prod_actucal_price'));
			$offer_price= $this->db->escape_str($this->input->post('offer_price'));
			$offer_status= $this->db->escape_str($this->input->post('offer_status'));
			$data=$this->offermodel->create_offer($prod_id,$offer_name,$offer_percentage,$prod_actucal_price,$offer_price,$offer_status,$user_id);
						if($data['status']=="success"){
							$this->session->set_flashdata('msg', 'offer Created Successfully');
									redirect('admin/offers#view');
					}else{
							$this->session->set_flashdata('msg', 'Failed to create');
								redirect('admin/offers#view');
					}
		}else{
			redirect('/');
		}
	}

	public function update_offer()
	{
		$data=$this->session->userdata();
		$user_id=$this->session->userdata('id');
		$user_role=$this->session->userdata('role_type_id');
		if($user_role=='1' || $user_role=='2'){
			$prod_id= $this->db->escape_str($this->input->post('prod_id'));
			$offer_name= $this->db->escape_str($this->input->post('offer_name'));
			$offer_percentage= $this->db->escape_str($this->input->post('offer_percentage'));
			$prod_actucal_price= $this->db->escape_str($this->input->post('prod_actucal_price'));
			$offer_price= $this->db->escape_str($this->input->post('offer_price'));
			$offer_status= $this->db->escape_str($this->input->post('offer_status'));
			$prod_offer_token= $this->db->escape_str($this->input->post('prod_offer_token'));
			$data=$this->offermodel->update_offer($prod_id,$offer_name,$offer_percentage,$prod_actucal_price,$offer_price,$offer_status,$user_id,$prod_offer_token);
						if($data['status']=="success"){
							$this->session->set_flashdata('msg', 'offer Created Successfully');
									redirect('admin/offers#view');
					}else{
							$this->session->set_flashdata('msg', 'Failed to create');
								redirect('admin/offers#view');
					}
		}else{
			redirect('/');
		}
	}

	public function get_product_price(){
		$prod_id= $this->db->escape_str($this->input->post('prod_id'));
		$data['res']=$this->productmodel->get_product_price($prod_id);
		echo json_encode($data['res']);
	}




	public function check_offer_product(){
		$data=$this->session->userdata();
		$user_id=$this->session->userdata('id');
		$user_role=$this->session->userdata('role_type_id');
		$prod_id= $this->db->escape_str($this->input->post('prod_id'));
		$data=$this->offermodel->check_offer_product($prod_id,$user_id);
	}
	public function check_offer_product_exist(){
		$data=$this->session->userdata();
		$user_id=$this->session->userdata('id');
		$user_role=$this->session->userdata('role_type_id');
		$offer_id=$this->uri->segment(3);
		$prod_id= $this->db->escape_str($this->input->post('prod_id'));
		$data=$this->offermodel->check_offer_product_exist($offer_id,$prod_id,$user_id);
	}

	public function edit_offer()
	{
		$data=$this->session->userdata();
		$user_id=$this->session->userdata('id');
		$user_role=$this->session->userdata('role_type_id');
			if($user_role=='1' || $user_role=='2'){
				$offer_id=$this->uri->segment(3);
				$data['res_prod']=$this->productmodel->get_all_active_product();
			 	$data['res_offer_prod']=$this->offermodel->get_offer_product($offer_id);

				$this->load->view('siteadmin/header',$data);
				$this->load->view('siteadmin/offer/edit_offer',$data);
				$this->load->view('siteadmin/footer');
		}else{
			$this->load->view('siteadmin/login');
		}
	}



}
