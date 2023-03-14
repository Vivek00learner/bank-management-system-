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



$res = $conn->query("select sum(transaction_amount) as total from transaction where customer_account =".$acc." and transaction_type = 'Deposite'");
$row = $res->fetch_assoc();
if($res->num_rows > 0){
$total_deposite =  $row['total'];
}

$res = $conn->query("select sum(loan_amount) as total from loan where customer_account=".$acc." and (loan_status = 'Approved' or loan_status = 'Payed')");
$row = $res->fetch_assoc();

if($res->num_rows > 0){
    $total_loan =  $row['total'];
    }

$res = $conn->query("select sum(loan_amount) as total from loan where customer_account=".$acc." and loan_status = 'Approved'");
$row = $res->fetch_assoc();
if($res->num_rows > 0){
    $total_loan_payable =  $row['total'];
    }



$res = $conn->query("select sum(transaction_amount) as count from transaction where customer_account = ".$acc." and transaction_type = 'Transfer' ");
$row = $res->fetch_assoc();
if($res->num_rows > 0){
    $total_transfer =  $row['count'];
    }



    $res = $conn->query("select sum(transaction_amount) as total from transaction where customer_account =".$acc." and transaction_type = 'Withdrawal'");
$row = $res->fetch_assoc();
if($res->num_rows > 0){
    $total_withdrawal =  $row['total'];
    }


    $res = $conn->query("select sum(transaction_amount) as total from transaction where reciever_account = ".$acc." and transaction_type = 'Transfer' ");
$row = $res->fetch_assoc();
if($res->num_rows > 0){
    $total_recieve=  $row['total'];
    }


    if($total_deposite == null){
        $total_deposite = 0;
    }
    if($total_loan == null){
        $total_loan = 0;
    }
    if($total_loan_payable== null){
        $total_loan_payable = 0;
    }
    if($total_recieve == null){
        $total_recieve = 0;
    }
    if($total_transfer == null){
        $total_transfer = 0;
    }
    if($total_withdrawal == null){
        $total_withdrawal = 0;
    }
?>

<link rel="stylesheet" href="admin/style.css">
</head>
<body>

<nav class="navbar navbar-inverse success">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="#" class="navbar-brand">FUTURE BANK</a>

               </div>

               <ul class="nav navbar-nav">
                   <li  class="active"><a href="dashboard.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
                   <li><a href="balanceinquiry.php"><span class="glyphicon glyphicon-usd"></span> Balance Inquiry</a></li>
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
    <h4>Customer Detail</h4>  
    <div class="rows" >
        
            <div style="width:50%; min-width:300px" class="list-group">
                <li class="list-group-item">Account Number : <?php echo $rec['customer_account']; ?></li>
                <li class="list-group-item">Name : <?php echo $rec['customer_name']; ?></li>
                <li class="list-group-item">Date of Birth : <?php echo $rec['customer_dob']; ?></li>
                <li class="list-group-item">Address : <?php echo $rec['customer_address']; ?></li>
                <li class="list-group-item">Balance : <?php echo $rec['customer_balance']; ?></li>
                <li class="list-group-item">Branch Name : <?php echo $rec['branch_no']; ?></li>
            </div>


            <div>

            

            <div style="border-left:1px solid #ddd;" class='rows'>
            <div class="cols">
                        <div class="number">
                            <span style="font-size:20px" class="primary-text">$<?php echo $total_deposite; ?></span>
                        </div>
                        <div class="hr"></div>
                        <div class="des">
                            <span>Total Deposite</span>

                        </div>
                    </div>

                    <div class="cols">
                    <div class="number">
                       <span style="font-size:20px" class="success-text">$<?php echo $total_loan; ?></span>
                    </div>
                    <div class="hr"></div>
                        <div class="des">
                            <span>Total Loan</span>

                        </div>
                    </div>

                    <div class="cols">
                    <div class="number">
                       <span style="font-size:20px" class="danger-text">$<?php echo $total_loan_payable; ?></span>
                    </div>
                    <div class="hr"></div>
                        <div class="des">
                            <span>Loan Payable</span>

                        </div>
                    </div>

            </div>

            <div  style="border-left:1px solid #ddd;"class='rows'>
            <div class="cols">
                        <div class="number">
                            <span style="font-size:20px" class="primary-text">$<?php echo $total_transfer; ?></span>
                        </div>
                        <div class="hr"></div>
                        <div class="des">
                            <span>Total Transfer</span>


                        </div>
                    </div>

                    <div class="cols">
                    <div class="number">
                       <span style="font-size:20px" class="success-text">$<?php echo $total_withdrawal; ?></span>
                    </div>
                    <div class="hr"></div>
                        <div class="des">
                            <span>Total withdrawal</span>

                        </div>
                    </div>

                    <div class="cols">
                    <div class="number">
                       <span style="font-size:20px" class="success-text">$<?php echo $total_recieve; ?></span>
                    </div>
                    <div class="hr"></div>
                        <div class="des">
                            <span>Total Recieved</span>

                        </div>
                    </div>

            </div>
</div>
</div>
    </div>
        </div>

       

      


    <script src="bootstrap-3.3.5-dist/bootstrap-3.3.5-dist/js/bootstrap.min.js"></script>



</body>
</html>