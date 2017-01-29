
<html>
 <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>COMP5335-Assign#3 </title>

    <!-- Bootstrap -->
    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="../assets/bootstrap/js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
      <script>
      
      $(document).ready(function(){
          
         
          $("#registerForm").submit(function(){
              
              $(".validationMsg").empty();
              $(".validationMsg").addClass('hide');
              var username = $("#username").val();
              var address = $("#address").val();
              var number = $("#number").val();
              var password = $("#password").val();
              var email = $("#email").val();
              var confirm_password = $("#password_confirm").val();
              if(password != confirm_password) {
                  
                  $(".validationMsg").append("<strong>password and confirm password doesnt match");
                  $(".validationMsg").addClass("show");
                  return false;
                  
              }
              if(username == "" || address == "" || number == "" || password == "" ) {
                  
                  $(".validationMsg").append("<strong>Please fill all the required fields");
                  $(".validationMsg").addClass("show");
                  return false;
              }
              $.ajax({ // this bit doesn't seem to do anything

                    url: '<?php echo site_url("index.php/register/registerSubmit") ?>',
                    data: {
                        username:username,
                        address:address,
                        number:number,
                        email:email,
                        password:password
                    },
                    type: 'POST',
                    success: function(data) {
                        
                        //console.log(data);
                        $('.submitResult').empty().append('<div class="alert alert-success"><strong>'+data+'</strong>Click here to <a href="../index.php">login</a></div>');
                        //$('#searchTitle').val("");
                    },
                    error: function(log) {
                        alert("error")
                        //$('#ajaxdata').html('<div class="alert alert-danger"><strong>There was an error processing your request</strong></div>')
                        //console.log(log.message);
                    }
                });
              
              return false;
          })
          
      });
      
      </script>
      <br/>
    <div class="container">

      <div class="jumbotron">
<form class="form-horizontal" id="registerForm">

    <div id="legend">
      <legend class="">Register</legend>
    </div>
    
    <div class="alert alert-danger hide validationMsg">
    </div>
    <div class="form-group row">
      <label class="col-xs-2 col-form-label"  for="username">Username</label>
      <div class="col-xs-10">
        <input type="text" id="username" name="username" placeholder="Username" class="form-control">
        </div>
    </div>
    <div class="form-group row">
      <label class="col-xs-2 col-form-label" for="address">Address</label>
    <div class="col-xs-10">
        <input type="text" id="address" name="address" placeholder="Enter Address" class="form-control">
        </div>
    </div>
    <div class="form-group row">
      <label class="col-xs-2 col-form-label" for="email">E-mail</label>
      <div class="col-xs-10">
        <input type="text" id="email" name="email" placeholder="Enter email" class="form-control">
        </div>
      
    </div>
    <div class="form-group row">
      <label class="col-xs-2 col-form-label" for="number">Phone Number</label>
      <div class="col-xs-10">
        <input type="text" id="number" name="number" placeholder="Phone Number" class="form-control">
        </div>
    </div>

    <div class="form-group row">
      <label class="col-xs-2 col-form-label" for="password">Password</label>
        <div class="col-xs-10">
            <input type="password" id="password" name="password" placeholder="Password" class="form-control">
        </div>
    </div>
 
    <div class="form-group row">
        <label class="col-xs-2 col-form-label" for="password_confirm">Password (Confirm)</label>
        <div class="col-xs-10">
            <input type="password" id="password_confirm" name="password_confirm" placeholder="Confirm Password" class="form-control">
        </div>
    </div>
 
    
  <button type="submit" class="btn btn-success">Register</button>
    <a  class="btn btn-success" href="../index.php">Cancel</a>
 <div class="submitResult">
    
    </div>
</form>
</div>
      </div>  
</body>
</html>
