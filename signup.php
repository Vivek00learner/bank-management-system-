<?php
    include 'config.php';
    session_start();
    $name = $_POST['name'];
    $dob = $_POST['dob'];
    $address = $_POST['address'];
    $branch = $_POST['branch'];
    $account = $_POST['account'];
    $password = $_POST['password'];
    $balance = $_POST['balance'];
    
    if(!empty($name) && !empty($dob) && !empty($address) && !empty($branch) && !empty($account) && !empty($password) && !empty($balance)){
    $res = $conn->query("select * from customer where customer_account=".$account."");
    if($res->num_rows > 0){
        header('location: register.php?error=User Already Exist');
    }



    $sql = "insert into customer values (".$account.",'".$name."','".$dob."','".$address."','".$branch."','".$password."',".$balance.", 'Active')";
    if($conn->query($sql)){
        echo 'Login Successfully';
        $_SESSION['account'] = $account;
        header('location: dashboard.php');
    }else{
        header('location: register.php?error=User Already Exist');
    }
}else{
    header('location: register.php?error=Some Fields Are Empty');
}

    ?>