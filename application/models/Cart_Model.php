<?php

session_start();
class Cart_Model extends CI_Model {


    function __construct()
    {

        parent::__construct();
    }

     function addToCart($isbn,$number,$total_stock) {
//        
        
       $basketID = $_SESSION["basketID"];
//        
//        $sql = "INSERT INTO contains (ISBN, basketID, number) 
//VALUES ('$isbn', '$basketID','$number')
//ON DUPLICATE KEY UPDATE
//ISBN='$isbn', basketID='$basketID', number= number + '$number'";
//        $resultSql = $conn->query($sql);
//        
//        if($resultSql) {
//            
//            echo "Added to cart succeffully";
//        } else {
//            
//            echo "error";
//        }
        
        $sqlCheckIfExists = "select * from contains where ISBN = '$isbn' and basketID = '$basketID'";
       
        
        $resultSql = $this->db->query($sqlCheckIfExists);
        if ($resultSql->num_rows() > 0) {

            // output data of each row
            foreach($resultSql->result() as $row) {
                if($number < ( $total_stock - $row->number)){
                    $updateQuery = "update contains set number = number + '$number' where ISBN = '$isbn' and basketID = '$basketID'";
                    if($this->db->query($updateQuery)) {

                        echo "Added to cart Succesfully";
                         $getBasketdetails = "select * from book JOIN contains ON book.ISBN=contains.ISBN where contains.ISBN IN (select ISBN from contains JOIN shoppingbasket ON contains.basketID = shoppingbasket.basketID where shoppingbasket.basketID = '$basketID') and contains.basketID = '$basketID'";
        $resultOfCart = $this->db->query($getBasketdetails);
        
        $_SESSION["totalBasketItems"] =  $resultOfCart->num_rows();
        
        $_SESSION['cartItems'] = array();
        if($resultOfCart->num_rows() > 0) {
            foreach($resultOfCart->result() as $basketResult) {
                
                $_SESSION['cartItems'][]= $basketResult;
                
            }
        }
                    } else {

                        echo "There was an issue";
                      }
                } else if($number > ( $total_stock - $row->number) && $total_stock - $row->number != 0){
                    
                    $number = $total_stock - $row->number;
                     $updateQuery = "update contains set number = number + '$number' where ISBN = '$isbn' and basketID = '$basketID'";
                    if($this->db->query($updateQuery)) {

                        echo "Added to cart Succesfully";
                         $getBasketdetails = "select * from book JOIN contains ON book.ISBN=contains.ISBN where contains.ISBN IN (select ISBN from contains JOIN shoppingbasket ON contains.basketID = shoppingbasket.basketID where shoppingbasket.basketID = '$basketID') and contains.basketID = '$basketID'";
                        $resultOfCart = $this->db->query($getBasketdetails);

                        $_SESSION["totalBasketItems"] =  $resultOfCart->num_rows();

                        $_SESSION['cartItems'] = array();
                        if($resultOfCart->num_rows() > 0) {
                            foreach($resultOfCart->result() as $basketResult) {

                                $_SESSION['cartItems'][]= $basketResult;

                            }
                        }
                    } else {

                        echo "There was an issue in adding item to cart";
                    }
                    
                } else {
                    
                    echo "Cart already contains the total items in the stock. Cannot add more item.Select the items in stock.";
                }
            }
        } else {
            
            $sql= "insert into contains values('$isbn','$basketID','$number')";
            $result = $this->db->query($sql);

            if ($result) {

                echo "Added to cart Successfully.";
                $_SESSION['cartItems'] = array();
                $getBasketdetails = "select * from book JOIN contains ON book.ISBN=contains.ISBN where contains.ISBN IN (select ISBN from contains JOIN shoppingbasket ON contains.basketID = shoppingbasket.basketID where shoppingbasket.basketID = '$basketID') and contains.basketID = '$basketID'";
                $resultOfCart = $this->db->query($getBasketdetails);
                $_SESSION['cartItems'] = array();
                $_SESSION["totalBasketItems"] =  $resultOfCart->num_rows();
                if($resultOfCart->num_rows() > 0) {
                    foreach($resultOfCart->result() as $basketResult) {

                        $_SESSION['cartItems'][]= $basketResult;

                    }
                }
        } else {

                echo "There was an issue in adding item to cart";
            }
        }
    
     }
    
    function buy_items(){
        
        
         $basketID = $_SESSION["basketID"];
        $username = $_SESSION["username"];
        $getBasketdetails = "select * from contains where basketID = '$basketID'";
        $resultOfCart = $this->db->query($getBasketdetails);
       
        foreach($resultOfCart->result() as $cartDetails) {
                     
            $ISBN = $cartDetails->ISBN;
            $cartItemsNumber = $cartDetails->number;
            $getQueryForStocks = "select * from stocks where ISBN = '$ISBN' and number > 0";
            $resultOfQueryForStocks = $this->db->query($getQueryForStocks);
            if($resultOfQueryForStocks->num_rows() > 0) {
                foreach($resultOfQueryForStocks->result() as $stockDetails ) {
                    
                    $wareHouseCode = $stockDetails->warehouseCode;
                    if($cartItemsNumber > 0) {
                        if($cartItemsNumber <= $stockDetails->number) {
                            //insert normal way
                            //decrement from stcks
                            $insertIntoShiping = "insert into shippingorder values('$ISBN','$wareHouseCode','$username','$cartItemsNumber')";
                            
                            if($this->db->query($insertIntoShiping)){
                                
                                
                                $updateStockTable = "update stocks set `number` = `number` - $cartItemsNumber where ISBN = '$ISBN' and warehouseCode = '$wareHouseCode'";
                                if($this->db->query($updateStockTable)) {
                                    
                                    echo "successfully updated stocks table";
                                } else {
                                    echo "There was an error updating stocks table";
                                }
                            } else {
                                
                                echo "successfully inserted into shipppng table.";
                            }

                        } else if($stockDetails->number != 0 && $cartItemsNumber>$stockDetails->number) {
                            //insert with stock number
                            
                            $cartItemsNumber = $cartItemsNumber -($cartItemsNumber - $stockDetails->number);
                            $insertIntoShiping = "insert into shippingorder values('$ISBN','$wareHouseCode','$username','$cartItemsNumber')";
                            if($this->db->query($insertIntoShiping)){
                                
                                $updateStockTable = "update stocks set number = number - '$cartItemsNumber' where ISBN = '$ISBN' and warehouseCode = '$wareHouseCode'";
                                
                                if($this->db->query($updateStockTable)) {
                                    
                                    echo "successfully updated stocks table";
                                } else {
                                    echo "There was an error updating stocks table";
                                }
                            } else {
                                
                                echo "suceesffully inserted into shipppng table";
                            }
                        } else {
                               // echo "here in break";    
                               break;
                        }
                    } else {
                        echo "no more items in the cart";
                        break;
                    }
                    
                }
                //$_SESSION['totalBasketItems']
                $deleteFromContain = "delete from contains where ISBN = '$ISBN' and basketID = '$basketID'";
                if($this->db->query($deleteFromContain)) {
                    $_SESSION["cartItems"] = array();
                    $_SESSION['totalBasketItems'] = 0;
                    echo "items are deleted from the cart";
                } else {
                     echo "could not delete ";
                }
                
            } else {
                //no stock available 
                echo "items are no longer available.";
            }
            
            
        }
        
        
        
    }
}