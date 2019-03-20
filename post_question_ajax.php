<?php
  include("./includes/session.php");
  include("./includes/db_connection.php");
  include("./includes/functions.php");
  include("./htmlheader.php");
?>

    <div class="container">

    <?php $obj = $_POST['myData'];
    $title = $obj["questiontitle"];
    $question = $obj["question"];
    $tag = $obj["questiontag"];
    $uid = $_SESSION["uid"];


    if (insert_question($title,$question,$tag,$uid)){

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

    


