<html>
    <head>
   <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>COMP5335-Assign#5 </title>

    <!-- Bootstrap -->
    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
         <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="../assets/bootstrap/js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
      <script>
     $(document).ready(function(){
      
         $('#buyBooks').click(function(){
             
             var data = {
                 
                 "action":"buyBooks"
             };
              $.ajax({ // this bit doesn't seem to do anything

                    url: '<?php echo site_url("cart/buy_items") ?>',
                    type: 'POST',
                    success: function(data) {
                        
                        alert(data);
                       window.location.reload();
                        
                    },
                    error: function(log) {
                        
                        //alert("error")
                        //$('#ajaxdata').html('<div class="alert alert-danger"><strong>There was an error processing your request</strong></div>')
                        //console.log(log.message);
                    }
                });
             
         })
         
  }); 
    </script>
  </head>
  <body>
      <?php 
        session_start();
        if(!isset($_SESSION['valid']) && !isset($_SESSION['username'])) {
            
            header("Location:login.php");
            
        }  
      
    ?>

      <nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Assign 5</a>
             <a class="navbar-brand text-center">CHEAPBOOKS</a>
            
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <form method="POST" class="navbar-form navbar-right" action="../login/logout">
                <li><button type="submit" class="btn btn-primary btn-lg" name="logout"> Logout <span class="glyphicon glyphicon-off"> </span></button></li>
            </form>
        
        
        <ul class="nav navbar-nav navbar-right">
            <li><a  href="<?php echo base_url ('cart/cart_items'); ?>" class="btn btn-default btn-lg"><?php echo $_SESSION['totalBasketItems']?> <span class="glyphicon glyphicon-shopping-cart"> </span> </a></li>
            
        </ul>
            <ul class="nav navbar-nav navbar-right">
            <li><a> <?php echo "Welcome ".$_SESSION['username']?></a></li>
        </ul>
        </div><!--/.nav-collapse -->
           
      </div>
    </nav>
      
      
    <div class="container">
        <div class="row">
            <?php
    $total = count($_SESSION['cartItems']);
                
                if($total>0) {
                    echo '
            <table class="table">
                <thead class="thead-inverse">
    <tr>
      <th>Sr No</th>
      <th></th>
      <th>Book Details</th>
      <th>Price</th>
      <th>Number</th>
      <th>total</th>
    </tr>
  </thead>
  <tbody>';
                
                $srNo =0;
                $totalPrice = 0;
                   // $_SESSION["cartItems"] = json_decode($_SESSION["cartItems"], true);
        foreach($_SESSION['cartItems'] as $item) {
            echo '<tr>
                    <td>
                        <h3>'.++$srNo.'</h3>   
                    </td>
                    <td><div class="thumbnail">
                                <img src="../assets/images/books/'.$item->ISBN.'.jpg"/>
                        </div>
                        </td>
                    <td>
                        <div>
                            <h3>Book Title: '.$item->title.'</h3>
                            <h6>Publisher: '.$item->publisher.'</h6>
                            <h6>ISBN: '.$item->ISBN.'</h6>
                            
                        </div>
                    </td>
                    <td>
                        <h3>$'.$item->price.'</h3>
                    </td>
                    <td>
                        <h3>'
                         .$item->number.   
                        '</h3>
                    </td>
                    <td>
                        <h3>$';
                    $totalPrice = $item->price*$item->number + $totalPrice;
                         echo $item->price*$item->number.   
                        '</h3>
                    </td>
                </tr>';
        }
     
            
              echo '</tbody>
            </table>
            <hr/>
            <h3 class="pull-right"> Total Price: $'.$totalPrice.'&nbsp;&nbsp;<Button class="btn btn-success" id="buyBooks"> BUY </Button></h3>';
                } else {
                          
                    echo '<h3>Your cart is empty</h3>';    
                }
            
    echo '    
        </div>
    </div>';
                ?>

</body>
</html>