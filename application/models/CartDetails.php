<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CartDetails extends CI_Model
{

    public function __construct() {
        parent::__construct();
        
        // Load the database library
        $this->load->database();
    }

    function cart_data(){

        $query = $this->db->get('cart');
        if($query->num_rows() > 0){
            return $query->num_rows();;
        }else{
            return false;
        }

   }


    function cart_details(){

        $query= $this->db->select('cart.cart_id,cart.product_id,cart.quantity,product.product_id,product.product_name,product.product_price,product.product_img')
        ->from('cart')
        ->join('product','cart.product_id = product.product_id')
        ->get();
        if($query->num_rows() > 0){
            return $query->result();;
        }else{
            return false;
        }

   }


    function add_cart(){

        $product_id = $this->input->post('pro_id');
        $this->db->where('product_id',$product_id);
        $query = $this->db->get('cart');
        if($query->num_rows() > 0){
            return false;
        }else{
            $data = array(
                'product_id' => $this->input->post('pro_id'),
                'quantity' => 1,
                    );
    
            $query = $this->db->insert('cart',$data);
            if($this->db->affected_rows() > 0){
                return true;
            }else{
                return false;
            }
            
        }

   }
    function cart_update(){

        $id = $this->input->post('id');

        $data = array(
            'quantity' => $this->input->post('qty'),
                );

        $this->db->where('cart_id',$id);
        $query = $this->db->update('cart',$data);
        if($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }

   }


   function cart_delete(){

    $id = $this->input->post('id');

    $this->db->where('cart_id',$id);
    $this->db->delete('cart');
    if($this->db->affected_rows() > 0){
        return true;
    }else{
        return false;
    }

}
}


?>