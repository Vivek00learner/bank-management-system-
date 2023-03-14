<?php
include 'config.php';
session_start();


$type = $_GET['stat'];
$amt = $_GET['bal'];
$sender = $_SESSION['account'];
$now = date('y-m-d');
if($type == 'Deposite'){
$conn->query("update customer set customer_balance = (customer_balance+".$amt.") where customer_account = ".$sender."");
$conn->query("insert into transaction (customer_account, reciever_account, transaction_type, transaction_amount,transaction_date) values (".$sender.",".$sender.",'".$type."',".$amt.",'".$now."')");
}else{
$conn->query("update customer set customer_balance = (customer_balance-".$amt.") where customer_account = ".$sender."");
$conn->query("insert into transaction (customer_account, reciever_account, transaction_type, transaction_amount,transaction_date) values (".$sender.",".$sender.",'".$type."',".$amt.",'".$now."')");

}
echo "Successfully ".$type;


?>