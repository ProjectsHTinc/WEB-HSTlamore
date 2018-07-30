<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Banner extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
			$this->load->model('bannermodel');
	}
	public function index()
	{
		$data=$this->session->userdata();
		$user_id=$this->session->userdata('id');
		$user_role=$this->session->userdata('role_type_id');
			if($user_role=='1' || $user_role=='2'){
				$data['res_prod']=$this->bannermodel->get_all_active_product();
				$data['res_banner']=$this->bannermodel->get_all_banner();
				$this->load->view('siteadmin/header',$data);
				$this->load->view('siteadmin/banner/create_banner',$data);
				$this->load->view('siteadmin/footer');
		}else{
			$this->load->view('siteadmin/login');
		}
	}

	public function create_banner()
	{
		$data=$this->session->userdata();
		$user_id=$this->session->userdata('id');
		$user_role=$this->session->userdata('role_type_id');
		if($user_role=='1' || $user_role=='2'){
				$prod_id= $this->db->escape_str($this->input->post('prod_id'));
				$banner_title= $this->db->escape_str($this->input->post('banner_title'));
				$banner_status=$this->input->post('banner_status');
				$banner_desc= $this->db->escape_str($this->input->post('banner_desc'));
				$banner_cover_img = $_FILES['banner_img']['name'];
					if(empty($banner_cover_img)){
						$banner_img='';
					}else{
					 	$temp = pathinfo($banner_cover_img, PATHINFO_EXTENSION);
						$banner_img = 'B_'.round(microtime(true)) . '.' . $temp;
						$uploaddir = 'assets/banner/';
						$trade_file = $uploaddir.$banner_img;
						move_uploaded_file($_FILES['banner_img']['tmp_name'], $trade_file);
					}

						$data=$this->bannermodel->create_banner($prod_id,$banner_title,$banner_status,$banner_desc,$banner_img,$user_id);
						if($data['status']=="success"){
							$this->session->set_flashdata('msg', 'Banner Created Successfully');
									redirect('admin/banner#view');
					}else{
							$this->session->set_flashdata('msg', 'Failed to create');
								redirect('admin/banner#view');
					}
		}else{
			redirect('/');
		}

	}

	public function update_banner()
	{
		$data=$this->session->userdata();
		$user_id=$this->session->userdata('id');
		$user_role=$this->session->userdata('role_type_id');
		if($user_role=='1' || $user_role=='2'){
			$prod_id= $this->db->escape_str($this->input->post('prod_id'));
			$banner_token= $this->db->escape_str($this->input->post('banner_token'));
			$banner_old_image=$this->db->escape_str($this->input->post('banner_old_image'));
			$banner_title= $this->db->escape_str($this->input->post('banner_title'));
			$banner_status=$this->input->post('banner_status');
			$banner_desc= $this->db->escape_str($this->input->post('banner_desc'));
			$banner_cover_img = $_FILES['banner_img']['name'];
			if(empty($banner_cover_img)){
				$banner_img=$banner_old_image;
			}else{
				$temp = pathinfo($banner_cover_img, PATHINFO_EXTENSION);
				$banner_img = 'B_'.round(microtime(true)) . '.' . $temp;
				$uploaddir = 'assets/banner/';
				$trade_file = $uploaddir.$banner_img;
				move_uploaded_file($_FILES['banner_img']['tmp_name'], $trade_file);
			}
			$data=$this->bannermodel->update_banner($prod_id,$banner_token,$banner_title,$banner_status,$banner_desc,$banner_img,$user_id);
			if($data['status']=="success"){
				$this->session->set_flashdata('msg', 'Banner Updated Successfully');
					redirect('admin/banner#view');
		}else{
				$this->session->set_flashdata('msg', 'Failed to create');
				redirect('admin/banner#view');
		}
		}else{
			redirect('/');
		}

	}


	public function check_banner(){
		$data=$this->session->userdata();
		$user_id=$this->session->userdata('id');
		$user_role=$this->session->userdata('role_type_id');
		$prod_id= $this->db->escape_str($this->input->post('prod_id'));
		$data=$this->bannermodel->check_banner($prod_id,$user_id);
	}
	public function check_banner_exist(){
		$data=$this->session->userdata();
		$user_id=$this->session->userdata('id');
		$user_role=$this->session->userdata('role_type_id');
		$ban_id=$this->uri->segment(3);
		$prod_id= $this->db->escape_str($this->input->post('prod_id'));
		$data=$this->bannermodel->check_banner_exist($ban_id,$prod_id,$user_id);
	}

	public function edit_banner()
	{
		$data=$this->session->userdata();
		$user_id=$this->session->userdata('id');
		$user_role=$this->session->userdata('role_type_id');
			if($user_role=='1' || $user_role=='2'){
				$ban_id=$this->uri->segment(3);
				$data['res_prod']=$this->bannermodel->get_all_active_product();
				$data['res_ban']=$this->bannermodel->get_banner_edit($ban_id);
				$this->load->view('siteadmin/header',$data);
				$this->load->view('siteadmin/banner/edit_banner',$data);
				$this->load->view('siteadmin/footer');
		}else{
			$this->load->view('siteadmin/login');
		}
	}



}
