<?php
include 'config.php';
session_start();
$account = $_POST['account'];
$password = $_POST['password'];

$sql = "select * from customer where customer_account = '".$account."' and customer_password = '".$password."'";
$result = $conn->query($sql);
if($result->num_rows > 0){
  
    $row=$result->fetch_assoc();
   if($row['customer_status'] === 'Active'){ 
    

    $_SESSION['account'] = $row['customer_account'];

    header('location: dashboard.php');
   }else{
    header('location: index.php?error=User is Blocked By Admin');
   }
}else{
    header('location: index.php?error=User Not Found');
}


?>