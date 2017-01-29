<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {
    
       function __construct()
    {

        parent::__construct();
    }

    
   public function add_to_cart(){
    
       
       $this->load->model("Cart_Model");
       $isbn = $this->input->post('isbn');
       $number = $this->input->post('number');
       $total_stock = $this->input->post('totalStock');
       //echo $isbn;
       //echo $number;
       //echo $total_stock;
         $this->Cart_Model->addToCart($isbn,$number,$total_stock);
        //echo $output;
       
    }
    public function cart_items() {
        
        $this->load->view('showCartItems');
        
    }
    
    public function buy_items(){
        
        $this->load->model("Cart_Model");
        
        $this->Cart_Model->buy_items();
        
    }
}