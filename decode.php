<?php
/**
 * Created by PhpStorm.
 * User: surid
 * Date: 11/3/2018
 * Time: 11:08 AM
 */
include "db.php";

if(isset($_POST["submit"])){
    $pass = $_POST["pass"];

    $sql = "Select encodedFile from encode where decodePass = '$pass'";
    $run = $conn->prepare($sql);
    $run->execute();

    if($run->rowCount() > 0){
        echo "Encoded File is : ";
        while ($row = $run->fetch(PDO::FETCH_ASSOC)){
            $encodeFile = $row["encodedFile"];

            echo '
                <a href="encodedFile/'.$encodeFile.'">'.$encodeFile.'</a>
            ';
        }
        echo "(Click to download)";
    }else{
        echo "Sorry no file found";
    }
}

?>

