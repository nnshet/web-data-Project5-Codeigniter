<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {
    
       function __construct()
    {

        parent::__construct();
    }

    
   public function register(){
        
        $this->load->view('register');
   }
    public function registerSubmit(){
    
        $this->load->model("Register_Model");
       
        //$form_data = $this->input->post();
       
        $username = $this->input->post("username");
        $password = MD5($this->input->post("password"));
        $address = $this->input->post('address'); 
        $number = $this->input->post('number'); 
        $email = $this->input->post('email');
        $this->Register_Model->register($username,$password,$address,$number,$email);
   }
    
    
    
}