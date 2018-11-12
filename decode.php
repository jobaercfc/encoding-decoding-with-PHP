<?php
/**
 * Created by PhpStorm.
 * User: surid
 * Date: 11/3/2018
 * Time: 11:08 AM
 */
include "db.php";

if(isset($_GET["submit"])){
    $file = $_GET["file"];

    $sql = "Select encodedFile from encode where decodedFile = '$file'";
    $run = $conn->prepare($sql);
    $run->execute();

    if($run->rowCount() > 0){
        while ($row = $run->fetch(PDO::FETCH_ASSOC)){
            echo $row["encodedFile"]."<br>";
        }
    }else{
        echo "Sorry no file found";
    }
}

?>
<form method="get" action="">
    <input type="text" name="file">
    <input type="submit" name="submit">
</form>

