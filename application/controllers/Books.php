<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Books extends CI_Controller {
    
       function __construct()
    {

        parent::__construct();
    }

    
   public function search_books(){
    
       
           $this->load->model("Book_Model");
       if(isset($_REQUEST)) {

            $id = $this->input->post("id");
            $searchString = $this->input->post("searchString");
        
            $searchResult = $this->Book_Model->searchBooks($id,$searchString);
        
         $count = count($searchResult);
           
            if($searchResult == "error")  {
                
                
                echo "<br/><div class='alert alert-danger'>The books searched for are not in stock</div>"; 
                
            } else {
            forEach($searchResult as $row) {
                
               
               $isbn = $row->ISBN;
                $sqlCheckStock = "select SUM(number) as sum from stocks where ISBN='$isbn'";
                
                $resultCheckStock = $this->db->query($sqlCheckStock);
                $resultOFStocks = $resultCheckStock->result();
               
              if($resultOFStocks[0]->sum>0) {
                  
                    echo '<div class="col-sm-6 col-md-3">
                        <div class="thumbnail">
                            <a href="#">
                                <img src="../assets/images/books/'.$row->ISBN.'.jpg" class="img-thumbnail" />   
                            </a> 

                            <div class="caption text-center">

                                <h6><a href="#" >'.$row->title.', '.$row->year.'</a></h6>
                                <h5> Items in stock: '.$resultOFStocks[0]->sum.'</h5>
                                <h5> ISBN: '.$row->ISBN.'</h5>
                                <button class="btn btn-primary btn-xs addToCart" data-ISBN="'.$row->ISBN.'" data-totalItems= "'.$resultOFStocks[0]->sum.'"><span class="glyphicon glyphicon-shopping-cart"></span>&nbsp;Add to cart</button></span>
                                <label for="movie"></label><input style="width:60px;" id="number_'.$row->ISBN.'" type="number" value="1" min="1" max="'.$resultOFStocks[0]->sum.'"/>
                         </div>
                    </div>
                    </div>';
                } else {
                    $count = $count - 1;
                }
              
                
            }
            
              if($count == 0) {
                    echo "<br/><div class='alert alert-danger'>The books searched for are not in stock</div>"; 
                }
            }
            
        }
    }
    
    
    
}