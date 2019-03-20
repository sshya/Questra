<?php
  include("./includes/session.php");
  include("./includes/db_connection.php");
  include("./includes/functions.php");


  if(!isset($_SESSION['uid'])) {
      redirect_to('index.php');
    }
    if(!isset($_GET['uid'])) {
      redirect_to('index.php');
    }
    
  
?>

<?php

$result_user = find_userdetails($_GET['uid']);

   if(isset($_POST['updatedetails']))
    {
    $email = $_POST['email'];// user email
    $uid = $_GET['uid'];
    $gravatar = $_POST['optradio'];
    $imgFile = $_FILES['user_image']['name'];
    $tmp_dir = $_FILES['user_image']['tmp_name'];
    $imgSize = $_FILES['user_image']['size'];
          
    if($imgFile)
    {
      $upload_dir = 'userimages/'; // upload directory 
      $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
      $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
      $userpic = rand(1000,1000000).".".$imgExt;
      if(in_array($imgExt, $valid_extensions))
      {     
        if($imgSize < 5000000)
        {
          unlink($upload_dir.$result_user['user_image']);
          move_uploaded_file($tmp_dir,$upload_dir.$userpic);
        }
        else
        {
          $_SESSION["message"] = "Sorry, your file is too large it should be less then 5MB";
        }
      }
      else
      {
        $_SESSION["message"] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";    
      } 
    }
    else
    {
      // if no image selected the old image remain as it is.
      $userpic = $result_user['user_image']; // old image from database
    }

    if(!isset($_SESSION["message"]))
    {
      update_user($_SESSION['uid'],$email,$userpic,$gravatar);
      //echo("<script>location.href = '/Questra/myprofile.php?uid=".$uid."';</script>");
      redirect_to("myprofile.php?uid=".$uid);
    }
  }
  include("./htmlheader.php");
  include("./includes/nav.php");
?>
<link href="css/pagination.css" rel="stylesheet">
<div class="container">
<div  id="errormsg" role="alert">
       <?php echo message(); ?>
    </div>
<div style="text-align: center">
    <div class="span3 well">
        
        <div class="row">
        <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12"></div>
        <div class="col-lg-5 col-md-4 col-sm-6 col-xs-12">
        <div class="hovereffect">

          <?php $image_url = getimageurl($result_user['gravatar'], $result_user['email'], $result_user['user_image']);?>
          <img src="<?php echo $image_url; ?>" alt="" width="175" height="175" class="img-circle">
          
          <div class="overlay">
             <a class="info" href="#aboutModal" data-toggle="modal" data-target="#myModal">Click here</a>
          </div>
        </div>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
        <h3><?php echo $result_user['user_id']; ?></h3>
        <?php
        $result_user_score = get_user_score($_GET['uid']);
        $row_user_score = mysqli_fetch_assoc($result_user_score);
        ?>
        <div><i class='fa fa-certificate fa-2x' aria-hidden='true'> <?php echo $row_user_score["SCORE"] ?> </i></div>
        <?php if($_GET['uid'] == $_SESSION['uid']) { ?> <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal2">Edit Details</button> <?php } ?>
        </div>
        
        </div>
        
    </div>
</div>
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">More About <?php echo $result_user['user_id']; ?></h4>
                    </div>
                <div class="modal-body">
                    <div style="text-align: center;">
                    <img src="userimages/<?php echo $result_user['user_image']; ?>" alt="" width="140" height="140" class="img-circle">
                    <h3 class="media-heading"><?php echo $result_user['user_id']; ?></h3>
                    <span><strong>Tags: </strong></span>
                        <span class="label label-warning">HTML5/CSS</span>
                        <span class="label label-info">PHP</span>
                        <span class="label label-info">MySQL</span>
                        <span class="label label-success">Linux Redhat</span>
                    </div>
                    <hr>
                    <div style="text-align: center;">
                    <p class="text-left"><strong>Email: </strong><br>
                        <?php echo $result_user['email']; ?></p>
                    <br>
                    </div>
                </div>
                <div class="modal-footer">
                    <div style="text-align: center">
                    <button type="button" class="btn btn-default" data-dismiss="modal">I'm done</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title" id="myModalLabel">More About <?php echo $result_user['user_id']; ?></h4>
                    </div>
                <div class="modal-body">
                  
                  <form method="post" enctype="multipart/form-data" class="form-horizontal">
                    <div class="form-group">
                      <label>Email</label>
                      <input type="text" class="form-control" placeholder="Enter Email" id="newemail" name="email" value = "<?php echo $result_user['email']; ?>" />
                      <p class='help-block'></p>
                    </div>
                    <div class="form-group">
                      <label>Avatar</label>
                      <p><img src="<?php echo $image_url; ?>" height="150" width="150" alt=""/></p>
                      <input class="input-group" type="file" name="user_image" accept="image/*" />
                      <p class='help-block'></p>
                      <div class="radio">
                        <label><input type="radio" name="optradio" value="TRUE">Gravatar</label>
                      </div>
                      <div class="radio">
                        <label><input type="radio" name="optradio" value="FALSE">Portal</label>
                      </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary" name="updatedetails">Questra!</button>
                    </div>
                    </div>
                  </form>
                  
                </div>
                <div class="modal-footer">
                    <div style="text-align: center">
                    <button type="button" class="btn btn-default" data-dismiss="modal">I'm not ready</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

       
</div>

<div class="row">
<div class="col-sm-1"></div>
<div class="col-sm-10 well">

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#myhome" role="tab" data-toggle="tab"><h4><b>User Questions</b></h4></a></li>
    <li role="presentation"><a href="#myans" role="tab" data-toggle="tab"><h4><b>User's Answered Questions</b></h4></a></li>

  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="myhome">
		<p></p>
    <br>

 		<?php
		$user_id= $_GET['uid'];
    $page = ''; 
    $rec_limit = 5;


    if( isset($_GET{'page'} ) AND $_GET{'page'}>0) {
        $page = $_GET{'page'};
        $offset = $rec_limit * $page ;

        }
    elseif (isset($_GET{'page'} ) AND $_GET{'page'}<0) {
         $page = 0;
         $offset = 0;             
        }    
    else {
         $page = 0;
         $offset = 0;
         }                     


    $result = get_questions($user_id,$offset, $rec_limit);
		while($row = mysqli_fetch_assoc($result))	
		{
			$question_id = $row["Q_ID"];

                                                            


		echo "<div class='row'>

				  <div class='col-xs-6 col-md-3'> 
			           <button type='button' class='btn btn-sm'> " . $row["UP_VOTE"] . "<br>" . "Votes" . " </button> 
			           <button type='button' class='btn btn-sm' style='background-color:rgba(127, 230, 161, 0.77)' >" . $row["ANSWERS_COUNT"] . "<br>" . "Answers" . " </button> 
			           <button type='button' class='btn btn-sm'>" . $row["VIEWS"] . "<br>" . "Views" . " </button> 
		          </div>


			      <div class='col-xs-12 col-md-6'> 
			           <div> 
			               <a href='view_question.php?q_id=".$question_id."'>" . verify_output($row["Q_TITLE"]) . "</a> 
			           </div> 
			           <br>";

                                                     $Tag_String = $row['Q_TAG'];
                                    
                                    $Tag_Array = explode(' ', $Tag_String);
                                    $i=0;
                                             for($i=0;$i<=(count($Tag_Array)-1);$i++)
                                              {
                                                echo "<button type='button' class='btn btn-sm' >
                                                       <a href='questionsbytag.php?q_tag=".$Tag_Array[$i]."'>".$Tag_Array[$i]."</a></button>";

                                              }    
			           //<button type='button' class='btn btn-sm' style='background-color:#d6ecff;'>" . $row["Q_TAG"] . " </button> 
echo "
			      </div>
			      <div class='col-xs-6 col-md-3'>
				        <p></p>
				          
				  </div>	

			  </div> <hr/>";
		}


              $page_name = 'myprofile.php';
              $query_name = 'get_questions';     
              $p1_name = 'uid';
              $p1_value = $user_id;

              $cnt = get_row_count($query_name,$p1_name,$p1_value);
              //echo $cnt;
              echo generate_pagination_buttons($rec_limit,$cnt,$page,$page_name,$p1_name,$p1_value);

  ?>
	</div>
    <div role="tabpanel" class="tab-pane" id="myans">
    <br>
    Not as per requirement.</div>
  </div>

</div>
<div class="col-sm-1"></div>

</div>



    <!-- Custom styles for this page -->
    <link href="css/postquestion.css" rel="stylesheet">
    <script src="js/validations.js"></script>


<?php
// 4. Release returned data

  	require_once("footer.php");
?>