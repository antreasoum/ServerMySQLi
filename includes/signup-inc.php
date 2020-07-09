<?php

if(isset($_POST["signup-submit"])) {
    require "db-inc.php";

    $username = $_POST["uname"];
    $email = $_POST["mail"];
    $password = $_POST["pwd"];
    $password2 = $_POST["pwd-verify"];

    if(empty($username) || empty($email) || empty($password) || empty($password2)) {
        header("Location: ../signup.php?error=emptyfields&uname=".$username."&mail=".$email);
        exit();
    }

    else if (!filter_var($email,FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: ../signup.php?error=invalidmailuname");
        exit();
    }

    else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../signup.php?error=invalidmail&uname=".$username);
        exit();
    }

    else if(!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: ../signup.php?error=invaliduname&mail=".$email);
        exit();
    }

    else if($password !== $password2) {
        header("Location: ../signup.php?error=passwordcheck&uname=".$username."&mail=".$email);
        exit();
    }

    else {
        $sql = "SELECT user_name FROM users WHERE user_name=?";
        $statement = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($statement, $sql)) {
            header("Location: ../signup.php?error=sqlerror");
            exit();
        }

        else {
            mysqli_stmt_bind_param($statement, "s", $username);
            mysqli_stmt_execute($statement);
            mysqli_stmt_store_result($statement);
            
            $resultCheck = mysqli_stmt_num_rows($statement);

            if($resultCheck > 0) {
                header("Location: ../signup.php?error=usertaken&mail=".$email);
                exit();
            }
            
            else {
                $sql = "INSERT INTO users (user_name, user_email, user_pwd) VALUES (?, ?, ?)";
                $statement = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($statement, $sql)) {
                header("Location: ../signup.php?error=sqlerror");
                exit();
            }

            else {

                $hashPwd = password_hash($password, PASSWORD_DEFAULT);

                mysqli_stmt_bind_param($statement, "sss", $username, $email, $hashPwd);
                mysqli_stmt_execute($statement);
                header("Location: ../signup.php?signup=success");
                exit();
            }
        }
    }
}

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}

else {
    header("Location: ../signup.php");
        exit();
}