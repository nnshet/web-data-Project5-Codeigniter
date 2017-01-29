<?php

class Login_Model extends CI_Model {


    function __construct()
    {

        parent::__construct();
    }

    function validateUser($username,$password) {

         $sql = "select * from customer where username= '".$username."' and password= '".$password."'";
    //        echo $sql;
        $result = $this->db->query($sql);

        if($result->num_rows()>0) {

            return true;

        } else {
            return false;

        }

    }
    
    function getBasketID($username) {
        
        $getBasketId = "select * from shoppingbasket where username = '$username'";
        
        $queryResult = $this->db->query($getBasketId);
        $basketId;
        foreach ($queryResult->result() as $row)
        {
            $basketId = $row->basketID;
          
        }
        return $basketId;
    }
    
    function getBasketDetails($basketId){
        
        $getBasketdetails = "select * from book JOIN contains ON book.ISBN=contains.ISBN where contains.ISBN IN (select ISBN from contains JOIN shoppingbasket ON contains.basketID = shoppingbasket.basketID where shoppingbasket.basketID = '$basketId') and contains.basketID = '$basketId'";
        $resultOfCart = $this->db->query($getBasketdetails);

            
        $_SESSION["totalBasketItems"] =  $resultOfCart->num_rows();
        
        $_SESSION['cartItems'] = array();
        if($resultOfCart->num_rows() > 0) {
            foreach($resultOfCart->result() as $basketResult) {
                
                $_SESSION['cartItems'][]= $basketResult;
                
            }
        }
           
    }
}