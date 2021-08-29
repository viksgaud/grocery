<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Model
{

    public function __construct() {
        parent::__construct();
        
        // Load the database library
        $this->load->database();
    }

    function product_details(){

        $query = $this->db->get('product');
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return false;
        }

   }
}


?>