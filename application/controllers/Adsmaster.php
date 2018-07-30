<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adsmaster extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
			$this->load->model('adsmodel');
	}
	public function index()
	{
		$data=$this->session->userdata();
		$user_id=$this->session->userdata('id');
		$user_role=$this->session->userdata('role_type_id');
			if($user_role=='1' || $user_role=='2'){
				$data['res_sub_cat']=$this->adsmodel->get_all_active_sub_cat();
				$data['res_ads']=$this->adsmodel->get_all_ads();
				$this->load->view('siteadmin/header',$data);
				$this->load->view('siteadmin/ads/create_ads',$data);
				$this->load->view('siteadmin/footer');
		}else{
			$this->load->view('siteadmin/login');
		}
	}

	public function create_ads()
	{
		$data=$this->session->userdata();
		$user_id=$this->session->userdata('id');
		$user_role=$this->session->userdata('role_type_id');
		if($user_role=='1' || $user_role=='2'){
				$sub_cat_id= $this->db->escape_str($this->input->post('sub_cat_id'));
				$ad_title= $this->db->escape_str($this->input->post('ad_title'));
				$ad_status=$this->input->post('ad_status');
				$ad_cover_img = $_FILES['ad_img']['name'];
					if(empty($ad_cover_img)){
						$ad_img='';
					}else{
					 	$temp = pathinfo($ad_cover_img, PATHINFO_EXTENSION);
						$ad_img = 'Ad_'.round(microtime(true)) . '.' . $temp;
						$uploaddir = 'assets/ads/';
						$trade_file = $uploaddir.$ad_img;
						move_uploaded_file($_FILES['ad_img']['tmp_name'], $trade_file);
					}

						$data=$this->adsmodel->create_ads($sub_cat_id,$ad_title,$ad_status,$ad_img,$user_id);
						if($data['status']=="success"){
							$this->session->set_flashdata('msg', 'Banner Created Successfully');
									redirect('admin/ads#view');
					}else{
							$this->session->set_flashdata('msg', 'Failed to create');
								redirect('admin/ads#view');
					}
		}else{
			redirect('/');
		}

	}

	public function update_ads()
	{
		$data=$this->session->userdata();
		$user_id=$this->session->userdata('id');
		$user_role=$this->session->userdata('role_type_id');
		if($user_role=='1' || $user_role=='2'){
			$sub_cat_id= $this->db->escape_str($this->input->post('sub_cat_id'));
			$ads_token= $this->db->escape_str($this->input->post('ads_token'));
			$ads_old_image=$this->db->escape_str($this->input->post('ads_old_image'));
			$ad_title= $this->db->escape_str($this->input->post('ad_title'));
			$ads_status=$this->input->post('ad_status');
			$ad_cover_img = $_FILES['ad_img']['name'];
			if(empty($ad_cover_img)){
				$ad_img=$ads_old_image;
			}else{
				$temp = pathinfo($ad_cover_img, PATHINFO_EXTENSION);
				$ad_img = 'AD_'.round(microtime(true)) . '.' . $temp;
				$uploaddir = 'assets/ads/';
				$trade_file = $uploaddir.$ad_img;
				move_uploaded_file($_FILES['ad_img']['tmp_name'], $trade_file);
			}
			$data=$this->adsmodel->update_ads($sub_cat_id,$ads_token,$ad_img,$ad_title,$ads_status,$user_id);
			if($data['status']=="success"){
				$this->session->set_flashdata('msg', 'Banner Updated Successfully');
					redirect('admin/ads#view');
		}else{
				$this->session->set_flashdata('msg', 'Failed to create');
				redirect('admin/ads#view');
		}
		}else{
			redirect('/');
		}

	}


	public function check_ads(){
		$data=$this->session->userdata();
		$user_id=$this->session->userdata('id');
		$user_role=$this->session->userdata('role_type_id');
		$sub_cat_id= $this->db->escape_str($this->input->post('sub_cat_id'));
		$data=$this->adsmodel->check_ads($sub_cat_id,$user_id);
	}
	public function check_ads_exist(){
		$data=$this->session->userdata();
		$user_id=$this->session->userdata('id');
		$user_role=$this->session->userdata('role_type_id');
		$ads_id=$this->uri->segment(3);
		$sub_cat_id= $this->db->escape_str($this->input->post('sub_cat_id'));
		$data=$this->adsmodel->check_ads_exist($ads_id,$sub_cat_id,$user_id);
	}

	public function edit_ads()
	{
		$data=$this->session->userdata();
		$user_id=$this->session->userdata('id');
		$user_role=$this->session->userdata('role_type_id');
			if($user_role=='1' || $user_role=='2'){
				$ads_id=$this->uri->segment(3);
				$data['res_sub_cat']=$this->adsmodel->get_all_active_sub_cat();
				$data['res_ads']=$this->adsmodel->get_ads_edit($ads_id);
				$this->load->view('siteadmin/header',$data);
				$this->load->view('siteadmin/ads/edit_ads',$data);
				$this->load->view('siteadmin/footer');
		}else{
			$this->load->view('siteadmin/login');
		}
	}



}
