<?php
/**
 * Created by PhpStorm.
 * User: surid
 * Date: 11/3/2018
 * Time: 10:21 AM
 */
include "db.php";
session_start();
if(isset($_SESSION["uid"])){
    $uid = $_SESSION["uid"];
}else{
    header("location : login.php");
}
?>
<html>
    <head><title>Encoding</title></head>
<body>


    <?php //  display  file  upload  form
//  check  uploaded  file  size
    if(isset($_POST["send"])){
        $sender = $uid;
        $receiver = $_POST["user"];

        if  ($_FILES['encodedFile']['size']  ==  0)  {
            die("ERROR:  Zero  byte  file  upload");
        }
        if  ($_FILES['decodedFile']['size']  ==  0)  {
            die("ERROR:  Zero  byte  file  upload");
        }
        //  check  if  this  is  a  valid  upload
        if  (!is_uploaded_file($_FILES['encodedFile']['tmp_name']))   {
            die("ERROR:  Not  a  valid  file  upload");
        }

        if  (!is_uploaded_file($_FILES['decodedFile']['tmp_name']))   {
            die("ERROR:  Not  a  valid  file  upload");
        }//  set  the  name  of  the  target  directory
        $uploadDir  =  "./encodedFile/"; //  copy  the  uploaded  file  to  the  directory
        $uploadDir_d = "./decodedFile/";
        move_uploaded_file($_FILES['encodedFile']['tmp_name'],  $uploadDir  .  $_FILES['encodedFile']['name'])  or  die("Cannot  copy  uploaded  file"); //  display  success  message
        move_uploaded_file($_FILES['decodedFile']['tmp_name'],  $uploadDir_d  .  $_FILES['decodedFile']['name'])  or  die("Cannot  copy  uploaded  file"); //  display  success  message

        echo  "Encoded  "  .  $_FILES['encodedFile']['name']. " to ".$_FILES['decodedFile']['name'];

        $sql = "insert into encode(encodedFile, decodedFile, senderId, receiverId) values ('".$_FILES['encodedFile']['name']."', '".$_FILES['decodedFile']['name']."', '$sender', '$receiver')";
        $run = $conn->prepare($sql);
        $run->execute();
    }


        ?>


    <form action="" method="post" enctype="multipart/form-data">
        <label>Encode this File</label><br>
        <input type="file" name="encodedFile"><br>
        <label>Decode with this File</label><br>
        <input type="file" name="decodedFile"><br>
        <label>Add a message</label><br>
        <input type="text" name="message"><br>
        <label>Send To : </label><br>
        <select name="user">
            <?php
                $sql = "Select * from users where id != '$uid'";

                $run = $conn->prepare($sql);
                $run->execute();

                if($run->rowCount() > 0){
                    while ($row = $run->fetch(PDO::FETCH_ASSOC)){
                        $id = $row["id"];
                        $name = $row["name"];
                        echo '<option value="'.$id.'">'.$name.'</option>';
                    }
                }

            ?>

        </select><br>
        <input type="submit" name="send">
    </form>

    <br><br>
    <hr>

    <?php
        $sql = "Select * from (encode inner join users on (encode.senderId = users.id)) where receiverId = '$uid'";

        $run = $conn->prepare($sql);
        $run->execute();

        if($run->rowCount() > 0){
            while ($row = $run->fetch(PDO::FETCH_ASSOC)){
                $senderName = $row["name"];
                $encodedFile = $row["encodedFile"];
                $decodedFile = $row["decodedFile"];

                echo '
                    <p>Message from '.$senderName.'</p>
                    <img src="decodedFile/'.$decodedFile.'" width="200px" height="200px">
                    <p><a href="decode.php?file='.$decodedFile.'">Decode this file</a></p>
                ';
            }
        }
    ?>

</body>
</html>