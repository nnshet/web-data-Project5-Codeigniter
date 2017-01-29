<html>
    <head>
   <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>COMP5335-Assign#5</title>

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
        $('.carousel').carousel({
          interval: 3000
        });
         var BASE_URL = '<?= base_url(); ?>';
        $(document).on('click','.addToCart',function(){
       
            var isbn = $(this).attr("data-ISBN");
            var number = $("#number_"+isbn).val();
            var total_stock = $(this).attr("data-totalItems");
            
          //  alert("here")
            console.log(isbn);
            console.log(number);
            console.log(total_stock);
             $.ajax({ // this bit doesn't seem to do anything

                    url: '<?php echo site_url("cart/add_to_cart") ?>',
                    data: {
                        
                        isbn:isbn,
                        number:number,
                        totalStock:total_stock
                    
                    },
                    type: 'POST',
                    success: function(data) {
                      
                        console.log(data);
                    alert(data);
                        window.location.reload();
                        
                    },
                    error: function(log) {
                        alert("error")
                        //$('#ajaxdata').html('<div class="alert alert-danger"><strong>There was an error processing your request</strong></div>')
                        //console.log(log.message);
                    }
                }); 
        }); 
         
         
         $(".searchBooks").click(function(){
             
             var id = $(this).attr('id');
             var searchString = $("#searchById").val();
             console.log(searchString)
             console.log(id)
             var data = {
                 
                 id:id,
                 searchString : searchString
             }
         
                $.ajax({ // this bit doesn't seem to do anything

                    url: '<?php echo site_url("books/search_books") ?>',
                    data: data,
                    type: 'POST',
                    success: function(data) {
                        
                        //console.log(data);
                        $('#booksdisplay').empty().append(data);
                        //$('#searchTitle').val("");
                    },
                    error: function(log) {
                        alert("error")
                        //$('#ajaxdata').html('<div class="alert alert-danger"><strong>There was an error processing your request</strong></div>')
                        //console.log(log.message);
                    }
                });
         
         
         });
         

         
  }); 
    </script>
  </head>
  <body>
      <?php 
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
        
        <form method="POST" class="navbar-form navbar-right" action="<?php echo base_url ('login/logout')?>">
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

            

            <div class="col-md-9">
                <div clas="row">
                    <h3>Search Books</h3>
                    <input type="text" id="searchById" />
                    <button id="searchByAuthor" class="btn btn-primary searchBooks"> Search By Author</button> 
                    <button id="searchByTitle" class="btn btn-primary searchBooks">Search by Title</button>
                </div>
                <br/>

    <div id="booksdisplay">


            <input id="username" type="hidden" value="<?php $_SESSION['username']?>"/>
         </div>
         </div>
      </div>
      </div>
</body>
</html>