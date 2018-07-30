<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productmaster extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('productmodel');
		$this->load->model('tagmodel');
		$this->load->model('categorymodel');
		$this->load->model('attributemodel');
		$this->load->model('specificationmodel');

	}
	public function index()
	{
		$data=$this->session->userdata();
		$user_id=$this->session->userdata('id');
		$user_role=$this->session->userdata('role_type_id');
			if($user_role=='1' || $user_role=='2'){
				$data['res_tags']=$this->tagmodel->get_all_active_tags();
				$data['res_cat']=$this->categorymodel->get_all_active_category();
				$data['res_size']=$this->attributemodel->get_all_active_size_attr();
				$data['res_color']=$this->attributemodel->get_all_active_color_attr();
				$this->load->view('siteadmin/header',$data);
				$this->load->view('siteadmin/product/create_product',$data);
				$this->load->view('siteadmin/footer');
		}else{
			$this->load->view('siteadmin/login');
		}
	}

	public function create()
	{
		$data=$this->session->userdata();
		$user_id=$this->session->userdata('id');
		$user_role=$this->session->userdata('role_type_id');
		if($user_role=='1' || $user_role=='2'){

			$product_name=$this->db->escape_str($this->input->post('product_name'));
			$sku_code=$this->db->escape_str($this->input->post('sku_code'));
			$cat_id=$this->db->escape_str($this->input->post('cat_id'));
			$sub_cat_id=$this->db->escape_str($this->input->post('sub_cat_id'));
			$product_desc=$this->db->escape_str($this->input->post('product_desc'));
			$delivery_fee=$this->db->escape_str($this->input->post('delivery_fee'));

			$product_cover_img = $_FILES['product_cover_img']['name'];
			if(empty($product_cover_img)){
				$prod_cover_img='';
			}else{
				$temp = pathinfo($product_cover_img, PATHINFO_EXTENSION);
				$prod_cover_img = 'PC_'.round(microtime(true)) . '.' . $temp;
				$uploaddir = 'assets/products/';
				$trade_file = $uploaddir.$prod_cover_img;
				move_uploaded_file($_FILES['product_cover_img']['tmp_name'], $trade_file);
			}


			$product_size_chart = $_FILES['product_size_chart']['name'];
			if(empty($product_size_chart)){
				$prod_size_chart='';
			}else{
				$temp = pathinfo($product_size_chart, PATHINFO_EXTENSION);
				$prod_size_chart = 'CH_'.round(microtime(true)) . '.' . $temp;
				$uploaddir = 'assets/products/charts/';
				$trade_file = $uploaddir.$prod_size_chart;
				move_uploaded_file($_FILES['product_size_chart']['tmp_name'], $trade_file);
			}


			$prod_actual_price=$this->db->escape_str($this->input->post('prod_actual_price'));
			$prod_mrp_price=$this->db->escape_str($this->input->post('prod_mrp_price'));
			$combined_status=$this->db->escape_str($this->input->post('combined_status'));
			$mas_size=$this->db->escape_str($this->input->post('mas_size'));
			$mas_color=$this->db->escape_str($this->input->post('mas_color'));
			$prod_comb_mrp_price=$this->db->escape_str($this->input->post('prod_comb_mrp_price'));
			$prod_comb_actual_price=$this->db->escape_str($this->input->post('prod_comb_actual_price'));
			$prod_comb_total_stocks=$this->db->escape_str($this->input->post('prod_comb_total_stocks'));
			$prod_default=$this->db->escape_str($this->input->post('prod_default'));

			$prod_offer_percentage=$this->db->escape_str($this->input->post('prod_offer_percentage'));
			$prod_return_policy=$this->db->escape_str($this->input->post('prod_return_policy'));
			$prod_cod=$this->db->escape_str($this->input->post('prod_cod'));

			$prod_stock_left=$this->db->escape_str($this->input->post('prod_stock_left'));


			$product_tags=$this->db->escape_str($this->input->post('product_tags'));


			$prod_meta_title=$this->db->escape_str($this->input->post('prod_meta_title'));
			$prod_meta_keywords=$this->db->escape_str($this->input->post('prod_meta_keywords'));
			$product_meta_desc=$this->db->escape_str($this->input->post('product_meta_desc'));
			$prod_status=$this->db->escape_str($this->input->post('prod_status'));

			$prod_total_stocks=$this->db->escape_str($this->input->post('prod_total_stocks'));
			$prod_minimum_stocks=$this->db->escape_str($this->input->post('prod_minimum_stocks'));

			$data['res']=$this->productmodel->create_product_item($product_name,$sku_code,$cat_id,$sub_cat_id,$product_desc,$delivery_fee,$prod_cover_img,$prod_size_chart,$prod_actual_price,$prod_mrp_price,$combined_status,$mas_size,$mas_color,$prod_comb_mrp_price,$prod_comb_actual_price,$prod_comb_total_stocks,$prod_default,$prod_offer_percentage,$prod_return_policy,$prod_cod,$prod_stock_left,$product_tags,$prod_meta_title,$prod_meta_keywords,$product_meta_desc,$user_id,$prod_status,$prod_total_stocks,$prod_minimum_stocks);
	//	print_r($data['res']);
			if($data['res']['status']=='success'){
				 $product_id=$data['res']['prod_last_id'];

				$prd_redirec_id=base64_encode($product_id*9876);
				redirect('/admin/products/'.$prd_redirec_id.'');
			}else if($data['res']['status']=='already'){
				$this->session->set_flashdata('in','already exist');
				redirect('/admin/products');
			}else{
			redirect('/admin/products');
			}
			}else{
			redirect('/');
		}

	}

			public function get_sub_cat_id(){
				$data=$this->session->userdata();
				$user_id=$this->session->userdata('id');
				$user_role=$this->session->userdata('role_type_id');
				if($user_role=='1' || $user_role=='2'){
					$cat_id= $this->db->escape_str($this->input->post('cat_id'));
					$data['res']=$this->categorymodel->get_sub_cat_id($cat_id);
					echo json_encode($data['res']);
				}else{
					redirect('/');
				}
			}





	public function check_product_name(){
		$data=$this->session->userdata();
		$user_id=$this->session->userdata('id');
		$user_role=$this->session->userdata('role_type_id');
		$product_name= $this->db->escape_str($this->input->post('product_name'));
		$data=$this->productmodel->check_product_name($product_name,$user_id);
	}
	public function check_sku_code(){
		$data=$this->session->userdata();
		$user_id=$this->session->userdata('id');
		$user_role=$this->session->userdata('role_type_id');
		$sku_code= $this->db->escape_str($this->input->post('sku_code'));
		$data=$this->productmodel->check_sku_code($sku_code,$user_id);
	}

	public function check_product_name_exist(){
		$data=$this->session->userdata();
		$user_id=$this->session->userdata('id');
		$user_role=$this->session->userdata('role_type_id');
		$prod_id=$this->uri->segment(3);
		$prod_name= $this->db->escape_str($this->input->post('product_name'));
		$data=$this->productmodel->check_product_name_exist($prod_id,$prod_name,$user_id);
	}

	public function check_sku_code_exist(){
		$data=$this->session->userdata();
		$user_id=$this->session->userdata('id');
		$user_role=$this->session->userdata('role_type_id');
		$prod_id=$this->uri->segment(3);
		$sku_code= $this->db->escape_str($this->input->post('sku_code'));
		$data=$this->productmodel->check_sku_code_exist($prod_id,$sku_code,$user_id);
	}



	public function edit_product()
	{
		$data=$this->session->userdata();
		$user_id=$this->session->userdata('id');
		$user_role=$this->session->userdata('role_type_id');
			if($user_role=='1' || $user_role=='2'){
				$data['res_tags']=$this->tagmodel->get_all_active_tags();
				$data['res_cat']=$this->categorymodel->get_all_active_category();
				$data['res_size']=$this->attributemodel->get_all_active_size_attr();
				$data['res_color']=$this->attributemodel->get_all_active_color_attr();
				$product_id=$this->uri->segment(3);
				$data['res_prod']=$this->productmodel->get_prod_edit($product_id);
				$data['res_comb']=$this->productmodel->get_prod_comb_edit($product_id);
				$data['res_prod_tag']=$this->productmodel->get_prod_tag_edit($product_id);
				$data['res_galley']=$this->productmodel->get_prod_gall_edit($product_id);
				$data['res_spec']=$this->productmodel->get_prod_spec_edit($product_id);
				$this->load->view('siteadmin/header',$data);
				$this->load->view('siteadmin/product/edit_product',$data);
				$this->load->view('siteadmin/footer');
		}else{
			$this->load->view('siteadmin/login');
		}
	}


		public function upload_size_chart(){
			$data=$this->session->userdata();
			$user_id=$this->session->userdata('id');
			$user_role=$this->session->userdata('role_type_id');
					if($user_role=='1' || $user_role=='2'){
							$product_token=$this->db->escape_str($this->input->post('product_token'));
							$product_size_chart = $_FILES['product_size_chart']['name'];
							if(empty($product_size_chart)){
								$prod_size_chart='';
							}else{
								$temp = pathinfo($product_size_chart, PATHINFO_EXTENSION);
								$prod_size_chart = 'CH_'.round(microtime(true)) . '.' . $temp;
								$uploaddir = 'assets/products/charts/';
								$trade_file = $uploaddir.$prod_size_chart;
								move_uploaded_file($_FILES['product_size_chart']['tmp_name'], $trade_file);
							}
							$data['res']=$this->productmodel->upload_size_chart($product_token,$prod_size_chart,$user_id);
							if($data['res']['status']=='success'){
								redirect('/admin/products/'.$product_token.'#cover');
							}else{
							redirect('/admin/products');
							}
					}else{
							$this->load->view('siteadmin/login');
					}
		}


		public function upload_cover_img(){
			$data=$this->session->userdata();
			$user_id=$this->session->userdata('id');
			$user_role=$this->session->userdata('role_type_id');
					if($user_role=='1' || $user_role=='2'){
							$product_token=$this->db->escape_str($this->input->post('product_token'));
							$product_size_chart = $_FILES['product_cover_img']['name'];
							if(empty($product_size_chart)){
								$product_cover_img='';
							}else{
								$temp = pathinfo($product_size_chart, PATHINFO_EXTENSION);
								$product_cover_img = 'CH_'.round(microtime(true)) . '.' . $temp;
								$uploaddir = 'assets/products/';
								$trade_file = $uploaddir.$product_cover_img;
								move_uploaded_file($_FILES['product_cover_img']['tmp_name'], $trade_file);
							}
							$data['res']=$this->productmodel->upload_cover_img($product_token,$product_cover_img,$user_id);
							if($data['res']['status']=='success'){
								redirect('/admin/products/'.$product_token.'#cover');
							}else{
							redirect('/admin/products');
							}
					}else{
							$this->load->view('siteadmin/login');
					}
		}

	public function edit_combined_products()
	{
		$data=$this->session->userdata();
		$user_id=$this->session->userdata('id');
		$user_role=$this->session->userdata('role_type_id');
			if($user_role=='1' || $user_role=='2'){
				$com_id=$this->uri->segment(3);
				$data['res_comb']=$this->productmodel->get_edit_combined_product($com_id);
				$data['res_size']=$this->attributemodel->get_all_active_size_attr();
				$data['res_color']=$this->attributemodel->get_all_active_color_attr();
				$this->load->view('siteadmin/header',$data);
				$this->load->view('siteadmin/product/edit_combined_products',$data);
				$this->load->view('siteadmin/footer');
		}else{
			$this->load->view('siteadmin/login');
		}
	}

	public function view_products()
	{
		$data=$this->session->userdata();
		$user_id=$this->session->userdata('id');
		$user_role=$this->session->userdata('role_type_id');
			if($user_role=='1' || $user_role=='2'){
				$zip_id=$this->uri->segment(3);
				$data['res']=$this->productmodel->get_all_products();
				$this->load->view('siteadmin/header',$data);
				$this->load->view('siteadmin/product/view_products',$data);
				$this->load->view('siteadmin/footer');
		}else{
			$this->load->view('siteadmin/login');
		}
	}

		public function update_prod_info()
		{
			$data=$this->session->userdata();
			$user_id=$this->session->userdata('id');
			$user_role=$this->session->userdata('role_type_id');
				if($user_role=='1' || $user_role=='2'){
				$product_token=$this->db->escape_str($this->input->post('product_token'));
				$sku_code=$this->db->escape_str($this->input->post('sku_code'));
				$product_name=$this->db->escape_str($this->input->post('product_name'));
				$cat_id=$this->db->escape_str($this->input->post('cat_id'));
				$sub_cat_id=$this->db->escape_str($this->input->post('sub_cat_id'));
				$product_desc=$this->db->escape_str($this->input->post('product_desc'));
				$delivery_fee=$this->db->escape_str($this->input->post('delivery_fee'));
				$prod_actual_price=$this->db->escape_str($this->input->post('prod_actual_price'));
				$prod_mrp_price=$this->db->escape_str($this->input->post('prod_mrp_price'));
				$prod_offer_percentage=$this->db->escape_str($this->input->post('prod_offer_percentage'));
				$prod_return_policy=$this->db->escape_str($this->input->post('prod_return_policy'));
				$prod_total_stocks=$this->db->escape_str($this->input->post('prod_total_stocks'));
				$prod_minimum_stocks=$this->db->escape_str($this->input->post('prod_minimum_stocks'));
				$prod_cod=$this->db->escape_str($this->input->post('prod_cod'));
				$prod_status=$this->db->escape_str($this->input->post('prod_status'));
				$prod_meta_title=$this->db->escape_str($this->input->post('prod_meta_title'));
				$prod_meta_keywords=$this->db->escape_str($this->input->post('prod_meta_keywords'));
				$product_meta_desc=$this->db->escape_str($this->input->post('product_meta_desc'));
				$combined_status=$this->db->escape_str($this->input->post('combined_status'));
				$data=$this->productmodel->update_prod_info($product_token,$sku_code,$product_name,$cat_id,$sub_cat_id,$product_desc,$delivery_fee,$prod_actual_price,$prod_mrp_price,$prod_offer_percentage,$prod_return_policy,$prod_total_stocks,$prod_minimum_stocks,$prod_cod,$prod_status,$user_id,$prod_meta_title,$prod_meta_keywords,$product_meta_desc,$combined_status);

			}else{
				$this->load->view('siteadmin/login');
			}
		}


		public function update_combined_products(){
			$data=$this->session->userdata();
			$user_id=$this->session->userdata('id');
			$user_role=$this->session->userdata('role_type_id');
				if($user_role=='1' || $user_role=='2'){
						$mas_size=$this->db->escape_str($this->input->post('mas_size'));
						$mas_color=$this->db->escape_str($this->input->post('mas_color'));
						$prod_actual_price=$this->db->escape_str($this->input->post('prod_actual_price'));
						$prod_mrp_price=$this->db->escape_str($this->input->post('prod_mrp_price'));
						$product_id=$this->db->escape_str($this->input->post('product_id'));
						$combined_token=$this->db->escape_str($this->input->post('combined_token'));
						$total_stocks=$this->db->escape_str($this->input->post('total_stocks'));
						$prod_default=$this->db->escape_str($this->input->post('prod_default'));
						$comb_status=$this->db->escape_str($this->input->post('comb_status'));
						$data['res']=$this->productmodel->update_combined_products($mas_size,$mas_color,$prod_actual_price,$prod_mrp_price,$product_id,$combined_token,$total_stocks,$comb_status,$user_id,$prod_default);
						if($data['res']['status']=='success'){
							$prd_redirec_id=base64_encode($product_id*9876);
							redirect('/admin/products/'.$prd_redirec_id.'#combined');
						}else if($data['res']['status']=='already'){
							$this->session->set_flashdata('in','already exist');
							redirect('/admin/edit_combined_products/'.$combined_token.'');
						}else{
						redirect('/admin/edit_combined_products/'.$combined_token.'');
						}

				}else{
					$this->load->view('siteadmin/login');
				}
		}



		public function add_sub_product(){
			$data=$this->session->userdata();
			$user_id=$this->session->userdata('id');
			$user_role=$this->session->userdata('role_type_id');
				if($user_role=='1' || $user_role=='2'){
					$prod_id=$this->uri->segment(3);
					$data['res_size']=$this->attributemodel->get_all_active_size_attr();
					$data['res_color']=$this->attributemodel->get_all_active_color_attr();
					$this->load->view('siteadmin/header',$data);
					$this->load->view('siteadmin/product/create_sub_product',$data);
					$this->load->view('siteadmin/footer');
				}else{

				}
			}



			public function create_combined_products(){
				$data=$this->session->userdata();
				$user_id=$this->session->userdata('id');
				$user_role=$this->session->userdata('role_type_id');
					if($user_role=='1' || $user_role=='2'){
							$mas_size=$this->db->escape_str($this->input->post('mas_size'));
							$mas_color=$this->db->escape_str($this->input->post('mas_color'));
							$prod_actual_price=$this->db->escape_str($this->input->post('prod_actual_price'));
							$prod_mrp_price=$this->db->escape_str($this->input->post('prod_mrp_price'));
							$product_token=$this->db->escape_str($this->input->post('product_id'));
							$total_stocks=$this->db->escape_str($this->input->post('total_stocks'));
							$prod_default=$this->db->escape_str($this->input->post('prod_default'));
							$comb_status=$this->db->escape_str($this->input->post('comb_status'));
							$data['res']=$this->productmodel->create_combined_products($mas_size,$mas_color,$prod_actual_price,$prod_mrp_price,$product_token,$total_stocks,$comb_status,$user_id,$prod_default);
							$prd_redirec_id=$product_token;
							if($data['res']['status']=='success'){
								redirect('/admin/products/'.$prd_redirec_id.'#combined');
							}else if($data['res']['status']=='already'){
								$this->session->set_flashdata('in','already exist');
								redirect('/admin/add_sub_product/'.$prd_redirec_id.'');
							}else{
							redirect('/admin/add_sub_product/'.$prd_redirec_id.'');
							}
					}else{
						$this->load->view('siteadmin/login');
					}
			}

			public function get_delete_sub_prod(){
				$data=$this->session->userdata();
				$user_id=$this->session->userdata('id');
				$user_role=$this->session->userdata('role_type_id');
					if($user_role=='1' || $user_role=='2'){
			 			$prod_id=$this->db->escape_str($this->input->post('prod_id'));
						$data=$this->productmodel->get_delete_sub_prod($prod_id,$user_id);
					}else{

					}
			}

			public function add_specification(){
				$data=$this->session->userdata();
				$user_id=$this->session->userdata('id');
				$user_role=$this->session->userdata('role_type_id');
					if($user_role=='1' || $user_role=='2'){
						$prod_id=$this->uri->segment(3);
						$data['res_specs']=$this->specificationmodel->get_all_active_specs();
						$this->load->view('siteadmin/header',$data);
						$this->load->view('siteadmin/product/create_specification',$data);
						$this->load->view('siteadmin/footer');
					}else{

					}
				}

			public function create_specification(){
				$data=$this->session->userdata();
				$user_id=$this->session->userdata('id');
				$user_role=$this->session->userdata('role_type_id');
					if($user_role=='1' || $user_role=='2'){
							$spec_id=$this->db->escape_str($this->input->post('spec_id'));
							$spec_value=$this->db->escape_str($this->input->post('spec_value'));
							$product_token=$this->db->escape_str($this->input->post('product_id'));
							$spec_status=$this->db->escape_str($this->input->post('spec_status'));
							$data['res']=$this->productmodel->create_specification($spec_id,$spec_value,$product_token,$spec_status,$user_id);
							$prd_redirec_id=$product_token;
							if($data['res']['status']=='success'){
								redirect('/admin/products/'.$prd_redirec_id.'#combined');
							}else if($data['res']['status']=='already'){
								$this->session->set_flashdata('in','already exist');
								redirect('/admin/add_specification/'.$prd_redirec_id.'');
							}else{
							redirect('/admin/add_specification/'.$prd_redirec_id.'');
							}
					}else{
						$this->load->view('siteadmin/login');
					}
			}

			public function edit_specifcation()
			{
				$data=$this->session->userdata();
				$user_id=$this->session->userdata('id');
				$user_role=$this->session->userdata('role_type_id');
					if($user_role=='1' || $user_role=='2'){
						$spec_id=$this->uri->segment(3);
						$data['res_spec_va']=$this->productmodel->edit_specifcation($spec_id);
						$data['res_specs']=$this->specificationmodel->get_all_active_specs();
						$this->load->view('siteadmin/header',$data);
						$this->load->view('siteadmin/product/edit_specification',$data);
						$this->load->view('siteadmin/footer');
				}else{
					$this->load->view('siteadmin/login');
				}
			}

			public function update_specification(){
				$data=$this->session->userdata();
				$user_id=$this->session->userdata('id');
				$user_role=$this->session->userdata('role_type_id');
					if($user_role=='1' || $user_role=='2'){
							$spec_id=$this->db->escape_str($this->input->post('spec_id'));
							$spec_value=$this->db->escape_str($this->input->post('spec_value'));
							 $product_token=$this->db->escape_str($this->input->post('product_token'));
							$spec_status=$this->db->escape_str($this->input->post('spec_status'));
							$spec_token=$this->db->escape_str($this->input->post('spec_token'));
							$data['res']=$this->productmodel->update_specification($spec_id,$spec_value,$product_token,$spec_status,$user_id,$spec_token);
						 	$prd_redirec_id=$product_token;
							if($data['res']['status']=='success'){
								redirect('/admin/products/'.$prd_redirec_id.'#combined');
							}else if($data['res']['status']=='already'){
								$this->session->set_flashdata('in','already exist');
								redirect('/admin/add_specification/'.$prd_redirec_id.'');
							}else{
							redirect('/admin/add_specification/'.$prd_redirec_id.'');
							}
					}else{
						$this->load->view('siteadmin/login');
					}
			}


			public function add_tags()
			{
				$data=$this->session->userdata();
				$user_id=$this->session->userdata('id');
				$user_role=$this->session->userdata('role_type_id');
					if($user_role=='1' || $user_role=='2'){
						$prod_id=$this->uri->segment(3);
						$data['res_tag_value']=$this->productmodel->get_all_active_tags_prod($prod_id);
						$this->load->view('siteadmin/header',$data);
						$this->load->view('siteadmin/product/add_tag_product',$data);
						$this->load->view('siteadmin/footer');
				}else{
					$this->load->view('siteadmin/login');
				}
			}



			public function add_tag_product()
			{
				$data=$this->session->userdata();
				$user_id=$this->session->userdata('id');
				$user_role=$this->session->userdata('role_type_id');
					if($user_role=='1' || $user_role=='2'){
				 	$product_token=$this->db->escape_str($this->input->post('product_token'));
					$product_tags=$this->input->post('product_tags');
					$data['res']=$this->productmodel->get_update_product_tags($product_token,$product_tags,$user_id);
					if($data['res']['status']=='success'){
						redirect('/admin/products/'.$product_token.'#tags');
					}else{
					redirect('/admin/products/'.$product_token.'#tags');
					}
				}else{
					$this->load->view('siteadmin/login');
				}
			}

			public function get_delete_prod_tags(){
				$data=$this->session->userdata();
				$user_id=$this->session->userdata('id');
				$user_role=$this->session->userdata('role_type_id');
					if($user_role=='1' || $user_role=='2'){
						$tag_id=$this->db->escape_str($this->input->post('tag_id'));
						$data=$this->productmodel->get_delete_prod_tags($tag_id,$user_id);
					}else{

					}
			}



			public function get_delete_prod_gallery(){
				$data=$this->session->userdata();
				$user_id=$this->session->userdata('id');
				$user_role=$this->session->userdata('role_type_id');
					if($user_role=='1' || $user_role=='2'){
						$gal_id=$this->db->escape_str($this->input->post('gal_id'));
						$data=$this->productmodel->get_delete_prod_gallery($gal_id,$user_id);
					}else{

					}
			}

			public function product_gallery(){
				$data=$this->session->userdata();
				$user_id=$this->session->userdata('id');
				$user_role=$this->session->userdata('role_type_id');
					if($user_role=='1' || $user_role=='2'){
						$product_token=$this->db->escape_str($this->input->post('product_token'));
						$name_array = $_FILES['files']['name'];
						$tmp_name_array = $_FILES['files']['tmp_name'];
						$count_tmp_name_array = count($tmp_name_array);
						$static_final_name = time();
						for($i = 0; $i < $count_tmp_name_array; $i++){
						 $extension = pathinfo($name_array[$i] , PATHINFO_EXTENSION);
						 $file_name[]=$static_final_name.$i.".".$extension;
						move_uploaded_file($tmp_name_array[$i], "assets/products/images/".$static_final_name.$i.".".$extension);
					}
						$data['res']=$this->productmodel->get_upload_gallery_file($product_token,$file_name,$user_id);
						if($data['res']['status']=='success'){
							redirect('/admin/products/'.$product_token.'#tags');
						}else{
						redirect('/admin/products/'.$product_token.'#tags');
						}
					}else{
						$this->load->view('siteadmin/login');
					}
			}

}
