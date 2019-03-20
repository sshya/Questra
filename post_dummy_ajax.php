<?php
  include("./includes/session.php");
  include("./includes/db_connection.php");
  include("./includes/functions.php");
  //include("./htmlheader.php");
$obj = $_POST['myData'];

    $Name = $obj["Name"];
    $message = 'ok';
    //error_log("\nInside best answer" . $a_id , 3, "C:/xampp/apache/logs/error.log");

    if (insert_dummy($Name)){

        echo 'hello';

    }
    //echo 'hello';
    ?>