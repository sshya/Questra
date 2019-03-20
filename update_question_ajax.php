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
    $q_id = $obj["q_id"];
    $uid = $_SESSION["uid"];


    if (update_question($title,$question,$tag,$q_id)){

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

    


