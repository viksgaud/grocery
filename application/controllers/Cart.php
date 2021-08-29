<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('cart');
	}

	public function cart_item()
	{
		$this->load->model("CartDetails");
        $response = $this->CartDetails->cart_details();
        echo json_encode($response);
	}
	
	public function update_cart()
	{
		$this->load->model("CartDetails");
        $response = $this->CartDetails->cart_update();
        echo json_encode($response);
	}
	public function delete_cart()
	{
		$this->load->model("CartDetails");
        $response = $this->CartDetails->cart_delete();
        echo json_encode($response);
	}

	public function product()
	{
		$this->load->model("Product");
        $response = $this->Product->product_details();
        echo json_encode($response);
	}
}