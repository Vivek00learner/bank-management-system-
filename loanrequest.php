<?php
    session_start();
    include 'config.php';
    $balance = $_POST['balance'];
    $account = $_SESSION['account'];
    $now = date('y-m-d');

    
    $sql = "insert into loan (customer_account,loan_amount,loan_date,loan_status) values (".$account.",".$balance.",'".$now."','Pending')";
    if($conn->query($sql)){
        echo 'Loan Place  Successfully';
        header('location: loan.php');
    }else{
        echo 'Something went wrong!';
    }

    ?>