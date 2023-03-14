<?php
session_start();
include 'config.php';
$acc = $_SESSION['account'];

$result = $conn->query("select * from customer where customer_account =".$acc."");
$rec = $result->fetch_assoc();
    $name = $_POST['name'];
    $dob = $_POST['dob'];
    $address = $_POST['address'];
    $branch = $rec['branch_no'];
    $account = $rec['customer_account'];
    $password = $rec['customer_password'];
    $balance = $rec['customer_balance'];
    


    $sql = "update customer set customer_name ='".$name."' , customer_dob = '".$dob."' , customer_address = '".$address."' where customer_account = ".$acc."";
    
    if($conn->query($sql)){
        echo 'Login Successfully';
        header('location: profile.php');
    }else{
        echo 'Something went wrong!';
    }

    ?>