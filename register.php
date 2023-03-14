<?php

include 'config.php';





?>


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
                    <li><a href="index.php"><span class="glyphicon glyphicon-log-in"></span> Sign In</a></li>
                </ul>
            </div>
        </div>
    </nav>


    <!--Body-->
    <div class="container" style="max-width: 500px;min-width:400px;border-radius: 10px;box-shadow: 2px 3px 3px 3px rgba(0,0,0,0.3);padding: 20px 20px;">
      <h3 style="text-align:center">Register!</h3>
        <form method="post" action="signup.php" >
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
              <input id="email" type="text" class="form-control" name="account" placeholder="Account Number">
            </div>

            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
              <input id="password" type="password" class="form-control" name="password" placeholder="Password">
            </div>

              <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-edit"></i></span>
                <input id="password" type="text" class="form-control" name="name" placeholder="Name">
              </div>

              <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                <input id="password" type="date" class="form-control" name="dob" placeholder="Date of Birth">
              </div>

              <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                <input id="password" type="text" class="form-control" name="address" placeholder="Address">
              </div>

              
              <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>
                <input id="password" type="number" class="form-control" name="balance" placeholder="Balance">
              </div>



              <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                <select id="password" type="password" class="form-control" name="branch" placeholder="Branch">
                <?php
                    $branches =$conn->query('select branch_no , branch_city from branch');
                    if($branches->num_rows > 0){
                        while($row = $branches->fetch_assoc()){

                            ?>
                        <option value='<?php echo $row['branch_no']; ?>  '><?php echo $row['branch_city']; ?> <?php echo $row['branch_no']; ?>  </option>
                 <?php           
                        }
                    }

                ?>
                
                  
                </select>
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
            <button class="btn btn-success">Sign Up</button>
          </form>
    </div>

 
   
    <script src="bootstrap-3.3.5-dist/bootstrap-3.3.5-dist/js/bootstrap.min.js"></script>




    
  </body>
</html>