<?php
  include("./includes/session.php");
  include("./includes/db_connection.php");
  include("./includes/functions.php");
?>

    <?php 
    $userid = $_POST['myData'];


    if (!find_user($userid)){

        echo 'ok';

    }
    else echo 'notok';
?>



    


