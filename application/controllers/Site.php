<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends MY_Controller {

	public function index(){
		$data = array();
		$this->load->view('site/home', $data);
	}

	public function allProduct(){
		$data = array();
		$this->load->view('site/all_products', $data);
	}

	public function detailProduct($productSlug = '', $productId = 0){
		$data = array();
		echo $productSlug.'<br/>';
		echo $productId;
		//$this->load->view('site/detail_products', $data);
	}
}
