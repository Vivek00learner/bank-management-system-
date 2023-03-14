<?php
include 'config.php';
session_start();

$amt = $_GET['bal'];
$acc = $_GET['acc'];
$sender = $_SESSION['account'];

$now = date('y-m-d');
$conn->query("update customer set customer_balance = (customer_balance+".$amt.") where customer_account = ".$acc."");
$conn->query("update customer set customer_balance = (customer_balance-".$amt.") where customer_account = ".$sender."");
$conn->query("insert into transaction (customer_account, reciever_account, transaction_type, transaction_amount,transaction_date) values (".$sender.",".$acc.",'Transfer',".$amt.",'".$now."')");



?>