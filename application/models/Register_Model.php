<?php
class Register_Model extends CI_Model {



    function __construct()
    {

        parent::__construct();
    }
    
    function register($username,$password,$address,$number,$email) {
        
        
        $sql = "insert into customer(username,address,email,phone,password) values('$username','$$address','$email','$number','$password')";

        if ($this->db->query($sql)) {
    
            $sql1 = "insert into shoppingbasket(basketID,username) values('".uniqid()."','$username')";
            if($this->db->query($sql1) ){
                echo "User is succesfullly registered.";
            }
        } else {
    
            echo "There was an error";
        }
    }
    
}



