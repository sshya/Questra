<?php
  include("./includes/session.php");
  include("./includes/db_connection.php");
  include("./includes/functions.php");
  include("./htmlheader.php");
  include("./includes/nav.php");
?>
<?php if(isset($_POST['questra']))
  {
    //error_log("Inside query\n" . $_POST['username'] , 3, "C:/xampp/apache/logs/error.log");
    $username = $_POST['username'];// user name
    $email = $_POST['email'];// user email
    
    $imgFile = $_FILES['user_image']['name'];
    $tmp_dir = $_FILES['user_image']['tmp_name'];
    $imgSize = $_FILES['user_image']['size'];
    $userpic = '';
    
    if(find_user($_POST['username']) != null){
      $_SESSION["message"] = "Username already exists";
      //echo("<script>location.href = 'newuser_register.php';</script>");
    }
    

    if(!empty($imgFile)){
      $upload_dir = 'userimages/'; // upload directory
  
      $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
    
      // valid image extensions
      $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
    
      // rename uploading image
      $userpic = rand(1000,1000000).".".$imgExt;
        
      // allow valid image file formats
      if(in_array($imgExt, $valid_extensions)){     
        // Check file size '5MB'
        if($imgSize < 5000000)        {
          move_uploaded_file($tmp_dir,$upload_dir.$userpic);
        }
        else{
          $_SESSION["message"] = "Sorry, your file is too large.";
        }
      }
      else{
        $_SESSION["message"] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";    
      }
    }
    
    
    // if no error occured, continue ....
    if(!isset($_SESSION["message"]))
    {
      insert_user($username,$email,$_POST['password'],$userpic);
      //exit(header("Location: login.php"));
    }
  }
?>

    <div class="container">
    <div  id="errormsg" role="alert">
       <?php echo message(); ?>
    </div>
      <div class="panel-heading"><strong>New User Registeration</strong></div>
      <div class="bs-example" data-example-id="basic-forms">

      <form method="post" enctype="multipart/form-data" id="newuser" class="form-horizontal">

        <div class="form-group">
          <label for="Title">Username</label>
          <input type="text" class="form-control" placeholder="Enter Username" id="username" name="username" value = "" onkeyup="checkduplicate(this.value,this.id)" autofocus/>
          <p class='help-block'></p>
        </div>
        <div class="form-group">
          <label for="Title">Email</label>
          <input type="text" class="form-control" placeholder="Enter Email" id="newemail" name="email" value = "" />
          <p class='help-block'></p>
        </div>
        <div class="form-group">
          <label for="Title">Password</label>
          <input type="password" class="form-control" placeholder="Enter Password" id="newpassword" name="password" />
          <p class='help-block'></p>
        </div>
        <div class="form-group">
          <label for="Title">Retype Password</label>
          <input type="password" class="form-control" placeholder="Enter Password" id="duppassword" name="duppassword" />
          <p class='help-block'></p>
        </div>
        <div class="form-group">
          <label for="Title">Avatar</label>
          <input class="input-group" type="file" name="user_image" accept="image/*" /></td>
          <p class='help-block'></p>
        </div>
        <div class="form-group">
        <button type="submit" class="btn btn-primary" name="questra">Questra!</button>
        </div>
      </form>
      </div>

    </div> <!-- /container -->


          


    <!-- Custom styles for this page -->
    <link href="css/postquestion.css" rel="stylesheet">
    <script src="js/validations.js"></script>


<?php
// 4. Release returned data

  	require_once("footer.php");
?>
