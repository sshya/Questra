<?php
  include("./includes/session.php");
  include("./includes/db_connection.php");
  include("./includes/functions.php");
  include("./htmlheader.php");
?>

    <div class="container">

    <?php  

    if(isset($_SESSION['uid'])) {
      redirect_to('index.php');
    }
    
  if(isset($_POST)){
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result_uid = find_uid($username);
    $subject = find_user($username);
    print_r($subject);
  ?>
    <?php
        // 3. Use returned data (if any)
        
        $privatekey = "6Lf8Ag4UAAAAAOnMfFAxzyNOXPJCZttjlLJ2Ecwo";
        // $resp = recaptcha_check_answer ($privatekey,
        //                               $_SERVER["REMOTE_ADDR"],
        //                               $_POST["recaptcha_challenge_field"],
        //                               $_POST["recaptcha_response_field"]);
        if(isset($_POST['g-recaptcha-response'])){
          $captcha=$_POST['g-recaptcha-response'];
        }
        if(!$captcha){
          $_SESSION["message"] = "Please select the CAPTCHA form";
          redirect_to("login.php");
        }
        $ip = $_SERVER['REMOTE_ADDR'];
        $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$privatekey."&response=".$captcha."&remoteip=".$ip);
        $responseKeys = json_decode($response,true);
        if(intval($responseKeys["success"]) !== 1) {
          $_SESSION["message"] = "Invalid CAPTCHA";
          redirect_to("login.php");
        }
        // else {
        //   echo '<h2>Thanks for posting comment.</h2>';
        // }
        // var_dump($_POST);

      //   if (!$resp->is_valid) {
      //     // What happens when the CAPTCHA was entered incorrectly
      //     $messg = $resp->is_valid;
      //     $_SESSION["message"] = $messg;
      //     redirect_to("login.php");
      //   }
        

          // output data from each row
          if ($subject) {
        // successful login
        $userpwd = find_pwd($username);
        if ($userpwd["pass_code"] == $password) {
          $_SESSION["uid"] = (int)$result_uid["u_id"];
          $_SESSION["username"] = $username;
          redirect_to("index.php");
        }
        else {
          $_SESSION["message"] = "Invalid Password";
          redirect_to("login.php");
        } 

      } else {
        $_SESSION["message"] = "User is not registered";
        //error_log("Inside Validate\n" . $subject , 3, "C:/xampp/apache/logs/error.log");
        redirect_to("login.php");
      }
    }
      ?>
    </div> <!-- /container -->
      <?php
      // 4. Release returned data
      //mysqli_free_result($result);
    ?>

    <!-- Custom styles for this page -->
    <link href="css/signin.css" rel="stylesheet">


<?php
  require_once("footer.php");
?>