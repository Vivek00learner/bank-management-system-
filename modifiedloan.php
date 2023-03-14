<?php
include 'config.php';
session_start();

$state = $_GET['state'];
$id =  $_GET['loanid'];

if($state === 'Cancel'){
    $conn->query("update loan set loan_status = 'Cancel' where loan_id = ".$id."");
}
if($state === 'Reject'){
    $conn->query("update loan set loan_status = 'Reject' where loan_id = ".$id."");
}
if($state === 'Accept'){
    $uid = $_GET['uid'];
    $amt = $_GET['amt'];
    $conn->query("update loan set loan_status = 'Approved' where loan_id = ".$id."");
    $conn->query("update customer set customer_balance = customer_balance + ".$amt." where customer_account = ".$uid." ");

}
if($state === 'Pay'){
    $uid = $_GET['uid'];
    $amt = $_GET['amt'];

    
    $res = $conn->query("select * from customer where customer_account = ".$_SESSION['account']."");
    $amtres = $res->fetch_assoc();
    if($amtres['customer_balance'] > $amt){
    $conn->query("update loan set loan_status = 'Payed' where loan_id = ".$id."");
    $conn->query("update customer set customer_balance = customer_balance - ".$amt." where customer_account = ".$uid." ");
    }else{
        echo "error";
    }
}
?>