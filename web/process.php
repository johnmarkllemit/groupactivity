<?php
include 'conn.php';

if (isset($_POST['registerUser'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $pass = $_POST['pass1'];
    $confirmPass = $_POST['pass2'];

    if ($pass == $confirmPass) {
        $hash = password_hash($pass, PASSWORD_DEFAULT);
        $addUser = $conn->prepare("INSERT INTO users (user_fname, user_lname, user_email, user_pass) VALUES(?, ?, ?, ?)");
        $addUser->execute([
            $fname,
            $lname,
            $email,
            $hash
        ]);

        $msg = "User registered succesfully!";
        header("Location: register.php?msg=$msg");
    } else {
        $msg = "Password do not match!";
        header("Location: register.php?msg=$msg");
    }
}

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    $getData = $conn->prepare("SELECT * FROM users WHERE user_email = ?");
    $getData->execute([$email]);

    foreach ($getData as $data) {
        if ($data['user_email'] == $email && password_verify($pass, $data['user_pass'])) {
            session_start();
            $_SESSION['logged_in'] = true;
            $_SESSION['user_id'] = $data['user_id'];

            $msg = "User logged-in successfully!";
            header("Location: index.php?msg=$msg");
        } else {
            $msg = "Email or Password do not match";
            header("Location: login.php?msg=$msg");
        }
    }
}

if (isset($_GET['logout'])) {
    session_start();
    unset($_SESSION['logged_in']);
    unset($_SESSION['user_id']); 
    
    header("Location: login.php");
}