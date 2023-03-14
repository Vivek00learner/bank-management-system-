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




?>

</head>
<body>

<nav class="navbar navbar-inverse success">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="#" class="navbar-brand">FUTURE BANK</a>

               </div>

               <ul class="nav navbar-nav">
                   <li><a href="dashboard.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
                   <li  class="active"><a href="balanceinquiry.php"><span class="glyphicon glyphicon-usd"></span> Balance Inquiry</a></li>
                   <li><a href="transfer.php"><span class="glyphicon glyphicon-transfer"></span> Transfer Funds</a></li>
                   <li><a href="loan.php"><span class="glyphicon glyphicon-file"></span> Loan</a></li>
                   <li><a href="profile.php"><span class="glyphicon glyphicon-user"></span> Edit Profile</a></li>
               </ul>

                <ul class="nav navbar-nav navbar-right">
                    <li><a href="index.php"><span class="glyphicon glyphicon-log-in"></span> Log Out</a></li>
                </ul>
            </div>
        </div>
    </nav>


 


    <!--Body-->
   


    <div class="container" style="max-width: 800px;min-width:400px;border-radius: 10px;box-shadow: 2px 3px 3px 3px rgba(0,0,0,0.3);padding: 20px 20px;">
        
            <h3>Transfer To</h3>
    <div class="table-responsive">
        <table class="table table-striped table-dark">
            <tr class="primary">
                <th>Account #</th>
                <th>Name</th>
                <th>Amount</th>
                <th>Date</th>
                
                
                
                
            </tr>
        <?php
        $result = $conn->query("select * from transaction where customer_account =".$acc." and transaction_type = 'Transfer'");
        while($rec = $result->fetch_assoc()){
            $nameres = $conn->query("select customer_name from customer where customer_account = ".$rec['reciever_account']." ")->fetch_assoc();
            $name = $nameres['customer_name']

        ?>
          <tr class="success">
                <td><?php echo $rec['reciever_account'] ?></td>
                <td><?php echo $name ?></td>
                <td><?php echo $rec['transaction_amount'] ?></td>
                <td><?php echo $rec['transaction_date'] ?></td>
                
                
                

        </tr>
          <?php } ?>
         

        </table>
    </div>


    <h3>Recieved From</h3>
    <div class="table-responsive">
        <table class="table table-striped table-dark">
            <tr class="primary">
                <th>Account #</th>
                <th>Name</th>
                <th>Amount</th>
                <th>Date</th>
                
                
                
                
            </tr>
        <?php
        $result = $conn->query("select * from transaction where reciever_account =".$acc." and transaction_type = 'Transfer'");
        while($rec = $result->fetch_assoc()){
            $nameres = $conn->query("select customer_name from customer where customer_account = ".$rec['customer_account']." ")->fetch_assoc();
            $name = $nameres['customer_name']

        ?>
          <tr class="danger">
                <td><?php echo $rec['customer_account'] ?></td>
                <td><?php echo $name ?></td>
                <td><?php echo $rec['transaction_amount'] ?></td>
                <td><?php echo $rec['transaction_date'] ?></td>
                
        </tr>
          <?php } ?>
         

        </table>
    </div>


    

    <h3>Withdrawal And Deposite</h3>
    <div class="table-responsive">
        <table class="table table-striped table-dark">
            <tr class="primary">
                <th>Amount</th>
                <th>Type</th>
                <th>Date</th>
                
                
                
                
            </tr>
        <?php
        $result = $conn->query("select * from transaction where customer_account =".$acc." and (transaction_type = 'Deposite' or transaction_type = 'Withdrawal'  ) ");
        while($rec = $result->fetch_assoc()){
            
                $name = '';
                if($rec['transaction_type'] == 'Deposite'){
                    $name = 'success';
                }else{
                    $name = 'danger';
                }
        ?>
          <tr class="<?php  echo $name; ?>">
                
                
                <td><?php echo $rec['transaction_amount'] ?></td>
                <td><?php echo $rec['transaction_type'] ?></td>
                <td><?php echo $rec['transaction_date'] ?></td>
                
        </tr>
          <?php } ?>
         

        </table>
    </div>
        </div>

       

      


    <script src="bootstrap-3.3.5-dist/bootstrap-3.3.5-dist/js/bootstrap.min.js"></script>



</body>
</html>