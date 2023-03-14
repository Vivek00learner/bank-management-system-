<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link href="bootstrap-3.3.5-dist/bootstrap-3.3.5-dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
    
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="#" class="navbar-brand">FUTURE BANK</a>

               </div>

                <ul class="nav navbar-nav navbar-right">
                    <li><a href="register.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                </ul>
            </div>
        </div>
    </nav>


    <!--Body-->
    <div class="container" style="max-width: 500px;min-width:400px;border-radius: 10px;box-shadow: 2px 3px 3px 3px rgba(0,0,0,0.3);padding: 20px 20px;">
        <form method="post" action="login.php">
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
              <input id="email" type="text" class="form-control" name="account" placeholder="Account Number">
            </div>
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
              <input id="password" type="password" class="form-control" name="password" placeholder="Password">
            </div>
            <br>
            <?php
            if(!empty($_GET)){
              echo "<div class='alert alert-danger'>
              <strong>Error</strong>
              ".$_GET['error']."
          </div>";
            }
            ?>
            <button class="btn btn-primary">Sign In</button>
          </form>
    </div>

 
   
    <script src="bootstrap-3.3.5-dist/bootstrap-3.3.5-dist/js/bootstrap.min.js"></script>
  </body>
</html>