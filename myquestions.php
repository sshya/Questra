<?php
  require_once("./includes/db_connection.php");
  require_once("./includes/functions.php");
  require_once("htmlheader.php");
?>

    <div class="container">

    <?php var_dump($_POST) ?>  

    </div> <!-- /container -->

    <!-- Custom styles for this page -->
    <link href="css/signin.css" rel="stylesheet">


<?php
// 4. Release returned data
  	mysqli_free_result($result);
  	require_once("footer.php");
?>