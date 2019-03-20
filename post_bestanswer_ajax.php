<?php
  include("./includes/session.php");
  include("./includes/db_connection.php");
  include("./includes/functions.php");
  //include("./htmlheader.php");
$obj = $_POST['myData'];

    $a_id = $obj["a_id"];
    $ba_id = $obj["ba_id"];
    $q_id = $obj["q_id"];
    $uid = $_SESSION["uid"];
    $message = 'ok';
    //error_log("\nInside best answer" . $a_id , 3, "C:/xampp/apache/logs/error.log");

    if($a_id == $ba_id){
      $a_id = '0';
      $message = 'notok';
    }

    if (update_answer($a_id,$q_id,$uid)){

        echo($message) ;

    }
    
    ?>