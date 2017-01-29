<html>
 <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>COMP5335-Assign#4 </title>

    <!-- Bootstrap -->
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="assets/bootstrap/js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  
      <br/>
    <div class="container">
    
<div class="jumbotron">
        
            <h3>Cheapbooks </h3>
        
   <?php 
    if(isset($_GET["loginFailed"])) {

    echo "<div class='alert alert-danger'><strong>Error!</strong> Please try with valid credentials.</div>";
} ?>
    <form class="form-signin" action="home/searchPage" method="post">
        <h2 class="form-signin-heading">Please sign in</h2>
        <label for="username" class="sr-only">User Name</label>
        <input type="text" name="username" class="form-control" placeholder="User name" id="username" required="" autofocus="">
        <label for="password" class="sr-only">Password</label>
        <input type="password" name="password" id="password" class="form-control" placeholder="Password" required=""><br/>
        <button type="submit" name="login" class="btn btn-primary btn-block">Login</button><br/>
        <p>New users must register <a href="register/register" class="btn btn-success">here</a></p>
        
    </form>
</div>

    </div>
</body>
</html>