<?php
  include("./includes/session.php");
  include("./includes/db_connection.php");
  include("./includes/functions.php");
  include("./htmlheader.php");
?>

    <div class="container">

    <?php $obj = $_POST['myData'];
    $qid = $obj["forid"];
    $answer = $obj["answer"];
    $uid = $_SESSION["uid"];


    if (insert_answer($answer,$qid,$uid)){

        echo 'ok';

    }
    
    
    ?>  

    </div> <!-- /container -->

    <!-- Custom styles for this page -->
    <link href="css/signin.css" rel="stylesheet">
   


<?php
// 4. Release returned data
    mysqli_free_result($result);
    require_once("footer.php");
?> 

    


