<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="bootstrap-3.3.5-dist/bootstrap-3.3.5-dist/css/bootstrap.min.css" rel="stylesheet">


<?php

include 'config.php';
session_start();


if(empty($_SESSION['account'])){
    header('location: index.php');
}
$acc = $_SESSION['account'];

$result = $conn->query("select * from customer where customer_account =".$acc."");
$rec = $result->fetch_assoc();
$balance = $rec['customer_balance'];
?>

</head>
<body>

<nav class="navbar navbar-inverse success">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="#" class="navbar-brand">FUTURE BANK </a>

               </div>

               <ul class="nav navbar-nav">
                   <li><a href="dashboard.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
                   <li><a href="balanceinquiry.php"><span class="glyphicon glyphicon-usd"></span> Balance Inquiry</a></li>
                   <li><a href="transfer.php"><span class="glyphicon glyphicon-transfer"></span> Transfer Funds</a></li>
                   <li><a href="loan.php"><span class="glyphicon glyphicon-file"></span> Loan</a></li>
                   <li class="active"><a href="profile.php"><span class="glyphicon glyphicon-user"></span> Edit Profile</a></li>
               </ul>

                <ul class="nav navbar-nav navbar-right">
                    <li><a href="index.php"><span class="glyphicon glyphicon-log-in"></span> Log Out</a></li>
                </ul>
            </div>
        </div>
    </nav>


    <!--Body-->
   


    <div class="container" style="max-width: 800px;min-width:400px;border-radius: 10px;box-shadow: 2px 3px 3px 3px rgba(0,0,0,0.3);padding: 20px 20px;">
    <h3 style="text-align:center">Register!</h3>
        <form method="post" action="updateprofile.php" >
           

      

              <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-edit"></i></span>
                <input value="<?php echo $rec['customer_name'] ?>" id="password" type="text" class="form-control" name="name" placeholder="Name">
              </div>

              <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                <input value="<?php echo $rec['customer_dob'] ?>"  id="password" type="date" class="form-control" name="dob" placeholder="Date of Birth">
              </div>

              <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                <input value="<?php echo $rec['customer_address'] ?>"  id="password" type="text" class="form-control" name="address" placeholder="Address">
              </div>

              
            


              
            <br>
            <button class="btn btn-success">Update</button>
          </form>
</div>

   


</body>
</html>