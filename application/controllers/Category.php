<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
			$this->load->model('categorymodel');
	}
	public function index()
	{
		$data=$this->session->userdata();
		$user_id=$this->session->userdata('id');
		$user_role=$this->session->userdata('role_type_id');
			if($user_role=='1' || $user_role=='2'){
				$data['res']=$this->categorymodel->get_all_category();
				$this->load->view('siteadmin/header',$data);
				$this->load->view('siteadmin/category/create',$data);
				$this->load->view('siteadmin/footer');
		}else{
			$this->load->view('siteadmin/login');
		}
	}

	public function create_category()
	{
		$data=$this->session->userdata();
		$user_id=$this->session->userdata('id');
		$user_role=$this->session->userdata('role_type_id');
		if($user_role=='1' || $user_role=='2'){
				$cat_name= $this->db->escape_str($this->input->post('cat_name'));
				$cat_desc= $this->db->escape_str($this->input->post('cat_desc'));
				$cat_status=$this->input->post('cat_status');
				$cat_meta_title= $this->db->escape_str($this->input->post('cat_meta_title'));
				$cat_meta_desc= $this->db->escape_str($this->input->post('cat_meta_desc'));
				$cat_meta_keywords= $this->db->escape_str($this->input->post('cat_meta_keywords'));
				$category_cover_image = $_FILES['cat_cover_img']['name'];
					if(empty($category_cover_image)){
						$cat_cover_img='';
					}else{
					 	$temp = pathinfo($category_cover_image, PATHINFO_EXTENSION);
						$cat_cover_img = 'C_'.round(microtime(true)) . '.' . $temp;
						$uploaddir = 'assets/category/';
						$trade_file = $uploaddir.$cat_cover_img;
						move_uploaded_file($_FILES['cat_cover_img']['tmp_name'], $trade_file);
					}
					$category_thumb_image = $_FILES['cat_thumb_img']['name'];
						if(empty($category_thumb_image)){
							$cat_thumb_img='';
						}else{
							$temp_thumb = pathinfo($category_thumb_image, PATHINFO_EXTENSION);
							$cat_thumb_img = 'T_'.round(microtime(true)) . '.' . $temp_thumb;
							$uploaddi_thumbr = 'assets/category/thumbnail/';
							$trade_file_thumb = $uploaddi_thumbr.$cat_thumb_img;
							move_uploaded_file($_FILES['cat_thumb_img']['tmp_name'], $trade_file_thumb);
						}
					
						$data=$this->categorymodel->create_category($cat_name,$cat_desc,$cat_status,$cat_meta_title,$cat_meta_desc,$cat_meta_keywords,$cat_cover_img,$cat_thumb_img,$user_id);
						if($data['status']=="success"){
							$this->session->set_flashdata('msg', 'Category Created Successfully');
								redirect('category/');
					}else{
							$this->session->set_flashdata('msg', 'Failed to create');
							redirect('category/');
					}
		}else{
			redirect('/');
		}

	}

	public function update_category()
	{
		$data=$this->session->userdata();
		$user_id=$this->session->userdata('id');
		$user_role=$this->session->userdata('role_type_id');
		if($user_role=='1' || $user_role=='2'){
				$cat_name= $this->db->escape_str($this->input->post('cat_name'));
				$cat_desc= $this->db->escape_str($this->input->post('cat_desc'));
				$cat_status=$this->input->post('cat_status');
				$cat_id=$this->input->post('cat_id');
				$cat_meta_title= $this->db->escape_str($this->input->post('cat_meta_title'));
				$cat_meta_desc= $this->db->escape_str($this->input->post('cat_meta_desc'));
				$cat_meta_keywords= $this->db->escape_str($this->input->post('cat_meta_keywords'));
				$cat_thumb_img_id=$this->input->post('cat_thumb_img_id');
				$cat_cover_img_id=$this->input->post('cat_cover_img_id');
				$category_cover_image = $_FILES['cat_cover_img']['name'];
					if(empty($category_cover_image)){
						$cat_cover_img=$cat_cover_img_id;
					}else{
					 	$temp = pathinfo($category_cover_image, PATHINFO_EXTENSION);
						$cat_cover_img = 'C_'.round(microtime(true)) .'.'. $temp;
						$uploaddir = 'assets/category/';
						$trade_file = $uploaddir.$cat_cover_img;
						move_uploaded_file($_FILES['cat_cover_img']['tmp_name'],$trade_file);
					}
					$category_thumb_image = $_FILES['cat_thumb_img']['name'];
						if(empty($category_thumb_image)){
							$cat_thumb_img=$cat_thumb_img_id;
						}else{
							$temp_thumb = pathinfo($category_thumb_image, PATHINFO_EXTENSION);
							$cat_thumb_img = 'T_'.round(microtime(true)).'.'.$temp_thumb;
							$uploaddi_thumbr = 'assets/category/thumbnail/';
							$trade_file_thumb = $uploaddi_thumbr.$cat_thumb_img;
							move_uploaded_file($_FILES['cat_thumb_img']['tmp_name'],$trade_file_thumb);
						}
						$data=$this->categorymodel->update_category($cat_name,$cat_desc,$cat_status,$cat_meta_title,$cat_meta_desc,$cat_meta_keywords,$cat_cover_img,$cat_thumb_img,$user_id,$cat_id);
						if($data['status']=="success"){
							$this->session->set_flashdata('msg', 'Category Updated Successfully');
								redirect('category/');
					}else{
							$this->session->set_flashdata('msg', 'Failed to create');
							redirect('category/');
					}
		}else{
			redirect('/');
		}

	}


	public function check_category(){
		$data=$this->session->userdata();
		$user_id=$this->session->userdata('id');
		$user_role=$this->session->userdata('role_type_id');
		$cat_name= $this->db->escape_str($this->input->post('cat_name'));
		$data=$this->categorymodel->check_category($cat_name,$user_id);
	}
	public function check_category_exist(){
		$data=$this->session->userdata();
		$user_id=$this->session->userdata('id');
		$user_role=$this->session->userdata('role_type_id');
		$cat_id=$this->uri->segment(3);
		$cat_name= $this->db->escape_str($this->input->post('cat_name'));
		$data=$this->categorymodel->check_category_exist($cat_id,$cat_name,$user_id);
	}

	public function add_sub()
	{
		$data=$this->session->userdata();
		$user_id=$this->session->userdata('id');
		$user_role=$this->session->userdata('role_type_id');
			if($user_role=='1' || $user_role=='2'){
				$data['res']=$this->categorymodel->get_all_category();
				$this->load->view('siteadmin/header',$data);
				$this->load->view('siteadmin/category/sub_category',$data);
				$this->load->view('siteadmin/footer');
		}else{
			$this->load->view('siteadmin/login');
		}
	}

	public function view_sub()
	{
		$data=$this->session->userdata();
		$user_id=$this->session->userdata('id');
		$user_role=$this->session->userdata('role_type_id');
			if($user_role=='1' || $user_role=='2'){
				$sub_cat=$this->uri->segment(3);
				$data['res']=$this->categorymodel->get_all_subcategory($sub_cat);
				$this->load->view('siteadmin/header',$data);
				$this->load->view('siteadmin/category/view_sub_category',$data);
				$this->load->view('siteadmin/footer');
		}else{
			$this->load->view('siteadmin/login');
		}
	}

	public function edit_cat()
	{
		$data=$this->session->userdata();
		$user_id=$this->session->userdata('id');
		$user_role=$this->session->userdata('role_type_id');
			if($user_role=='1' || $user_role=='2'){
				$cat_id=$this->uri->segment(3);
				$data['res']=$this->categorymodel->get_category_edit($cat_id);
				$this->load->view('siteadmin/header',$data);
				$this->load->view('siteadmin/category/edit_cat',$data);
				$this->load->view('siteadmin/footer');
		}else{
			$this->load->view('siteadmin/login');
		}
	}

	public function create_sub_category()
	{
		$data=$this->session->userdata();
		$user_id=$this->session->userdata('id');
		$user_role=$this->session->userdata('role_type_id');
		if($user_role=='1' || $user_role=='2'){
				$cat_name= $this->db->escape_str($this->input->post('cat_name'));
				$cat_desc= $this->db->escape_str($this->input->post('cat_desc'));
				$cat_status=$this->input->post('cat_status');
				$sub_cat_id=$this->input->post('sub_cat_id');
				$cat_meta_title= $this->db->escape_str($this->input->post('cat_meta_title'));
				$cat_meta_desc= $this->db->escape_str($this->input->post('cat_meta_desc'));
				$cat_meta_keywords= $this->db->escape_str($this->input->post('cat_meta_keywords'));
				$category_cover_image = $_FILES['cat_cover_img']['name'];
					if(empty($category_cover_image)){
						$cat_cover_img='';
					}else{
						$temp = pathinfo($category_cover_image, PATHINFO_EXTENSION);
						$cat_cover_img = 'C_'.round(microtime(true)) . '.' . $temp;
						$uploaddir = 'assets/category/';
						$trade_file = $uploaddir.$cat_cover_img;
						move_uploaded_file($_FILES['cat_cover_img']['tmp_name'], $trade_file);
					}
					$category_thumb_image = $_FILES['cat_thumb_img']['name'];
						if(empty($category_thumb_image)){
							$cat_thumb_img='';
						}else{
							$temp_thumb = pathinfo($category_thumb_image, PATHINFO_EXTENSION);
							$cat_thumb_img = 'T_'.round(microtime(true)) . '.' . $temp_thumb;
							$uploaddi_thumbr = 'assets/category/thumbnail/';
							$trade_file_thumb = $uploaddi_thumbr.$cat_thumb_img;
							move_uploaded_file($_FILES['cat_thumb_img']['tmp_name'], $trade_file_thumb);
						}
						$data=$this->categorymodel->create_sub_category($cat_name,$cat_desc,$cat_status,$cat_meta_title,$cat_meta_desc,$cat_meta_keywords,$cat_cover_img,$cat_thumb_img,$user_id,$sub_cat_id);
						if($data['status']=="success"){
							$this->session->set_flashdata('msg', 'Category Created Successfully');
								redirect('category/view_sub/'.$sub_cat_id.'');
					}else{
							$this->session->set_flashdata('msg', 'Failed to create');
							redirect('category/view_sub/'.$sub_cat_id.'');
					}
		}else{
			redirect('/');
		}

	}

	public function edit_sub_cat()
	{
		$data=$this->session->userdata();
		$user_id=$this->session->userdata('id');
		$user_role=$this->session->userdata('role_type_id');
			if($user_role=='1' || $user_role=='2'){
				$data['main_cat']=$this->categorymodel->get_all_parent_category();
				$cat_id=$this->uri->segment(3);
				$data['res']=$this->categorymodel->get_category_edit($cat_id);
				$this->load->view('siteadmin/header',$data);
				$this->load->view('siteadmin/category/edit_sub_cat',$data);
				$this->load->view('siteadmin/footer');
		}else{
			$this->load->view('siteadmin/login');
		}
	}

			public function update_sub_category(){
				$data=$this->session->userdata();
				$user_id=$this->session->userdata('id');
				$user_role=$this->session->userdata('role_type_id');
				if($user_role=='1' || $user_role=='2'){
						$cat_name= $this->db->escape_str($this->input->post('cat_name'));
						$cat_desc= $this->db->escape_str($this->input->post('cat_desc'));
						$cat_status=$this->input->post('cat_status');
						$cat_id=$this->input->post('cat_id');
						$main_cat_id=$this->input->post('main_cat_id');
						$cat_meta_title= $this->db->escape_str($this->input->post('cat_meta_title'));
						$cat_meta_desc= $this->db->escape_str($this->input->post('cat_meta_desc'));
						$cat_meta_keywords= $this->db->escape_str($this->input->post('cat_meta_keywords'));
						$cat_thumb_img_id=$this->input->post('cat_thumb_img_id');
						$cat_cover_img_id=$this->input->post('cat_cover_img_id');
						$category_cover_image = $_FILES['cat_cover_img']['name'];
							if(empty($category_cover_image)){
								$cat_cover_img=$cat_cover_img_id;
							}else{
								$temp = pathinfo($category_cover_image, PATHINFO_EXTENSION);
								$cat_cover_img = 'C_'.round(microtime(true)) .'.'. $temp;
								$uploaddir = 'assets/category/';
								$trade_file = $uploaddir.$cat_cover_img;
								move_uploaded_file($_FILES['cat_cover_img']['tmp_name'],$trade_file);
							}
							$category_thumb_image = $_FILES['cat_thumb_img']['name'];
								if(empty($category_thumb_image)){
									$cat_thumb_img=$cat_thumb_img_id;
								}else{
									$temp_thumb = pathinfo($category_thumb_image, PATHINFO_EXTENSION);
									$cat_thumb_img = 'T_'.round(microtime(true)).'.'.$temp_thumb;
									$uploaddi_thumbr = 'assets/category/thumbnail/';
									$trade_file_thumb = $uploaddi_thumbr.$cat_thumb_img;
									move_uploaded_file($_FILES['cat_thumb_img']['tmp_name'],$trade_file_thumb);
								}
								$data=$this->categorymodel->update_sub_category($cat_name,$cat_desc,$cat_status,$cat_meta_title,$cat_meta_desc,$cat_meta_keywords,$cat_cover_img,$cat_thumb_img,$user_id,$cat_id,$main_cat_id);
								$cat_id=base64_encode($main_cat_id*9876);
								if($data['status']=="success"){
									$this->session->set_flashdata('msg', 'Category Updated Successfully');
									redirect('category/view_sub/'.$cat_id.'');
							}else{
									$this->session->set_flashdata('msg', 'Failed to create');
									redirect('category/view_sub/'.$cat_id.'');
							}
				}else{
					redirect('/');
				}
			}



}
