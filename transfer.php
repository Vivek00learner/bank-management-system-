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
                   <li class="active"><a href="transfer.php"><span class="glyphicon glyphicon-transfer"></span> Transfer Funds</a></li>
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
        
            <div style="display:flex;flex-direction:row">
                <div style="width:50%">

                <h3 class="center">Transfer</h3>
                
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
              <input id="account" type="text" class="form-control" name="account" placeholder="Account Number">
            </div>
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>
              <input id="balance" type="number" class="form-control" name="balance" placeholder="Blanace">
            </div>
            <br>
            <button onclick="getdata(<?php echo $acc ?>)" class="btn btn-primary">Check Account</button>
          

            <hr>
            <h3 class="center">Deposite/Withdrawal</h3>
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>
              <input id="otherbalance" type="number" class="form-control" name="balance" placeholder="Blanace">
            </div>
            <div id="depwid"></div>
            <br>
            <button onclick="deposite()" class="btn btn-success">Deposit</button>
            <button onclick="withdrawal()" class="btn btn-warning">Withdrawal</button>
          
                </div>
            <div style="width:40%;padding-left:20px">
            <h3 class="center">Details</h3>
            <?php if(!empty($_GET)){
               $res =  $conn->query("select * from customer where customer_account =".$_GET['acc']." ");
               if($res->num_rows > 0){ 
               $rec = $res->fetch_assoc();
            ?>
            <div class="list-group">
                <li class="list-group-item">Name: <?php echo $rec['customer_name'] ?></li>
                <li class="list-group-item">Account: <?php echo $rec['customer_account'] ?></li>
                <li class="list-group-item">Address: <?php echo $rec['customer_address'] ?></li>
                <li class="list-group-item">Date of Birth: <?php echo $rec['customer_dob'] ?></li>
                <li class="list-group-item">Amount: <?php echo $_GET['bal']; ?></li>
                <input style="display:none;" value="<?php echo $_GET['bal'] ?>" id="hamt"/>
                <input style="display:none;" value="<?php echo $_GET['acc'] ?>" id="hacc"/>
                <div id="transferStatus"></div>


            </div>
            <?php if($balance < $_GET['bal']){ ?>
            <div class="alert alert-danger">
                <strong>Warning!</strong>
                Out of Balance
            </div>
            <?php }else{ ?>
                
            <button onclick="sendfund()" class="btn btn-success">Send</button>
            <?php } ?>
            <?php
               }else{
                   ?>
                   <div class="list-group">
                <li class="list-group-item">No User Found!</li>

            <?php
               }
            }
            ?>
            
            
            </div>
            </div>
    
        </div>

       

      
<script>
    
function getdata(){
    var amt = document.getElementById('balance');
    var acc = document.getElementById('account');
    if(amt.value != '' && acc.value != ''){
        amount = amt.value;
        account = acc.value;
        
    window.location.href = '?acc='+acc.value+'&bal='+amt.value;
    }else{
        window.location.href = '';
    }
}
function sendfund(){
    var xmls = new XMLHttpRequest();
    var amt = document.getElementById('hamt');
    var acc = document.getElementById('hacc');
    xmls.onreadystatechange = function(){
        console.log(this.responseText);
        document.getElementById('transferStatus').innerHTML = "Successfully Transfer";
    }
    var url = window.location.href;
    xmls.open('get','transferfund.php?acc='+acc.value+'&bal='+amt.value,true);
    xmls.send();
    console.log(acc.value,amt.value);
}

function deposite(){
    var xmls = new XMLHttpRequest();
    var amt = document.getElementById('otherbalance');
    
    xmls.onreadystatechange = function(){
        document.getElementById('depwid').innerHTML = "Successfully Deposite";
        
    }
    
    xmls.open('get','depwid.php?bal='+amt.value+'&stat=Deposite',true);
    xmls.send();
    
}

function withdrawal(){
    var xmls = new XMLHttpRequest();
    var amt = document.getElementById('otherbalance');
    
    xmls.onreadystatechange = function(){
        document.getElementById('depwid').innerHTML = "Successfully Withdrawal";
        
    }
    
    xmls.open('get','depwid.php?bal='+amt.value+'&stat=Withdrawal',true);
    xmls.send();
    
}
</script>

    <script src="bootstrap-3.3.5-dist/bootstrap-3.3.5-dist/js/bootstrap.min.js"></script>


   


</body>
</html>