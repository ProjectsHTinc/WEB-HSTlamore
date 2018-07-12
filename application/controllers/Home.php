<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
	}

	public function index()
	{
		$this->load->view('front_header');
		$this->load->view('index');
		$this->load->view('front_footer');
	}
	
	public function aboutus()
	{
		$this->load->view('front_header');
		$this->load->view('about-us');
		$this->load->view('front_footer');
	}
	
	public function contactus()
	{
		$this->load->view('front_header');
		$this->load->view('contact-us');
		$this->load->view('front_footer');
	}
	
		public function wishlist()
	{
		$this->load->view('front_header');
		$this->load->view('wish-list');
		$this->load->view('front_footer');
	}
}
