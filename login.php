<?php
/**
 * Created by PhpStorm.
 * User: surid
 * Date: 11/4/2018
 * Time: 12:10 PM
 */
include "db.php";
session_start();
if(isset($_POST["login"])){
    $email = $_POST["email"];
    $password = $_POST["pass"];

    $sql = "select * from users where email = '$email' and password = '$password'";
    $run = $conn->prepare($sql);
    $run->execute();

    if($run->rowCount() == 1){
        $row = $run->fetch(PDO::FETCH_ASSOC);
        $_SESSION["uid"] = $row["id"];
        $_SESSION["name"] = $row["name"];
        header("location: index.php");


    }
}

?>

<html>
<head><title>Login</title></head>
<body>
<form method="post" action="">
    <input type="email" name="email" placeholder="Enter Email" required>
    <input type="password" name="pass" placeholder="Enter Password" required>
    <input type="submit" name="login"required>
</form>
</body>
</html>
