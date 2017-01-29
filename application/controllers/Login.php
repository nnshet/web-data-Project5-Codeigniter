<?php
//defined('BASEPATH') OR exit('No direct script access allowed');
session_start();
class Login extends CI_Controller {

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
		$this->load->view('login');
	}
    
    public function loginCheck() {
        
        if(!isset($_SESSION['valid'])) {
            
            
        
            $this->load->model("Login_Model");

            $form_data = $this->input->post();
            // or just the username:
            $username = $this->input->post("username");
            $password = MD5($this->input->post("password"));

            $isValid = $this->Login_Model->validateUser($username,$password);
            if($isValid) {

                $_SESSION['valid'] = true;
                $_SESSION['timeout'] = time();
                $_SESSION['username'] = $username;
                $basketID = $this->Login_Model->getBasketID($username);
                $_SESSION["basketID"] = $basketID; 

                $this->Login_Model->getBasketDetails($basketID);
                $this->load->view('books');
            } else {
                
                die(header("location:../index.php?loginFailed=true&reason=password"));
                //redirect("index.php");
                
                 //echo "<div class='alert alert-danger'><strong>Error!</strong> Please try with valid credentials.</div>";
                
            }
        } else {
            $this->load->view('books');
            
        }
 
}
    
    public function logout() {
        
        
        session_destroy();
        redirect("index.php");
    }
}
