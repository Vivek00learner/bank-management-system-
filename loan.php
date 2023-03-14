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
                <a href="#" class="navbar-brand">FUTURE BANK</a>

               </div>

               <ul class="nav navbar-nav">
                   <li><a href="dashboard.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
                   <li><a href="balanceinquiry.php"><span class="glyphicon glyphicon-usd"></span> Balance Inquiry</a></li>
                   <li><a href="transfer.php"><span class="glyphicon glyphicon-transfer"></span> Transfer Funds</a></li>
                   <li class="active"><a href="loan.php"><span class="glyphicon glyphicon-file"></span> Loan</a></li>
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
        <h3>Request Loan</h3>
        
        <form method="post" action="loanrequest.php">
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>
              <input  id="balance" type="text" class="form-control" name="balance" placeholder="Balance">
            </div>
           <br>
           
            <button class="btn btn-primary">Request Loan</button>
        </form>
            
        <br>

        <h3>Loan History</h3>
    <div class="table-responsive">
        <table class="table table-striped table-dark">
            <tr class="primary">
                <th>Loan Id</th>
                <th>Amount</th>
                <th>Date</th>
                <th>Status</th>
                <th>Pay</th>
                
                
                
                
            </tr>
        <?php
        $result = $conn->query("select * from loan where customer_account =".$acc."");
        while($rec = $result->fetch_assoc()){
            

        ?>
          <tr class="success">
                <td><?php echo $rec['loan_id'] ?></td>
                <td><?php echo $rec['loan_amount'] ?></td>
                <td><?php echo $rec['loan_date'] ?></td>
                <td><?php echo $rec['loan_status'] ?></td>
                <td><?php if($rec['loan_status'] == 'Pending'){
                    echo "<button onclick='cancel(".$rec['loan_id'].")' class='btn btn-danger'>Cancel</button>";
                }elseif($rec['loan_status'] == 'Approved'){
                    echo "<button onclick='payback(".$rec['loan_id'].",".$rec['customer_account'].",".$rec['loan_amount'].")' class='btn btn-success'>Pay Back</button>";
                }elseif($rec['loan_status'] == 'Cancel'){
                    echo "<span style='color:#ff2000;'>Loan Cancel</span>";
                }elseif($rec['loan_status'] == 'Payed'){
                    echo "<span style='color:#00ff20;'>Loan Payed</span>";
                } elseif($rec['loan_status'] == 'Reject'){
                    echo "<span style='color:#ff2000;'>Loan Rejected</span>";
                }
                ?></td>
                
                
                

        </tr>
          <?php } ?>
         

        </table>
    </div>
            
        
        </div>

       

      
<script>
    

    function cancel(id){
        
        var xml = new XMLHttpRequest();
        xml.onreadystatechange = function(){
            setTimeout(function(){
                window.location.href= 'loan.php';
            },100);
            
        }
        xml.open('get','modifiedloan.php?state=Cancel&loanid='+id,true);
        xml.send();
    }

    function payback(id,uid,amt){
    
        var xml = new XMLHttpRequest();
        xml.onreadystatechange = function(){
            setTimeout(function(){
                window.location.href= 'loan.php';
            },100);
            
        }
        xml.open('get','modifiedloan.php?state=Pay&loanid='+id+'&uid='+uid+'&amt='+amt,true);
        xml.send();
    }
    </script>


    <script src="bootstrap-3.3.5-dist/bootstrap-3.3.5-dist/js/bootstrap.min.js"></script>


   


</body>
</html>