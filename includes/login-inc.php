<?php

if (isset($_POST["login-submit"])) {

    require "db-inc.php";

    $mailuid = $_POST["mailuid"];
    $password = $_POST["pwd"];

    if(empty($mailuid) || empty($password)) {
        header("Location: ../index.php?error=emptyfields");
        exit();
    }

    else {
        $sql = "SELECT * FROM users WHERE user_name=? OR user_email=?;";
        $statement = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($statement, $sql)) {
            header("Location: ../index.php?error=sqlerror");
            exit();
        }
        
        else {

            mysqli_stmt_bind_param($statement,"ss", $mailuid, $mailuid);
            mysqli_stmt_execute($statement);
            $result = mysqli_stmt_get_result($statement);

            if($row = mysqli_fetch_assoc($result)) {
                $pwdCheck = password_verify($password, $row["user_pwd"]);
                
                if($pwdCheck == false) {
                    header("Location: ../index.php?error=wrongpwd");
                    exit();
                }
                
                else if ($pwdCheck == true ) {
                    session_start();
                    $_SESSION["userID"] = $row["user_id"];
                    $_SESSION["uname"] = $row["user_id"];

                    header("Location: ../index.php?login=success");
                    exit();
                }

                else {
                    header("Location: ../index.php?error=wrongpwd");
                    exit();

                }
            }

            else {
                header("Location: ../index.php?error=nouser");
                exit();
            }
        }
    }
}

else {
    header("Location: ../index.php");
    exit();
}
