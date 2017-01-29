<?php

session_start();
class Book_Model extends CI_Model {


    function __construct()
    {

        parent::__construct();
    }

     function searchBooks($id,$searchString) {
        
        // echo $id;
        if($id === "searchByAuthor") {
            
            if($searchString == "") {
                $sql = "select * from book";
            } else {

            $sql = "select * from book where ISBN IN (select ISBN from author JOIN writtenby ON author.ssn= writtenby.ssn where name LIKE   '%$searchString%')";     
            }
                        
        } else {
                  
            if($searchString == "") {
                $sql = "select * from book";
            } else {

            $sql = "select * from book where title LIKE '%$searchString%'";
            }
        }

        $searchResult = $this->db->query($sql); 
        $count = $searchResult->num_rows();
        
        if ($count > 0) {
            
            return $searchResult->result();   
        } else{
            
            return "error";
        }

    
     }
    

}