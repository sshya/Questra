<?php
  include("./includes/session.php");
  include("./includes/db_connection.php");
  include("./includes/functions.php");
  include("./htmlheader.php");
  include("./includes/nav.php");    
?>
<link href="css/view_question.css" rel="stylesheet">
<link href="css/postquestion.css" rel="stylesheet">
<link href="css/pagination.css" rel="stylesheet">



    <div class="container-fluid">
      <div  id="errormsg" role="alert">
       <?php echo message(); ?>
      </div>
        <p></p>
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-10" style="background-color:#fff;">
                <div class="col-sm-12">
                    <div class="col-sm-12">
                        <?php 

                        if (!isset($_GET["q_id"])){
                          redirect_to('index.php');
                        }
                        $page = '';
                        $rec_limit = 3;

                        if( isset($_GET{'page'} ) ) {
                                $page = $_GET{'page'};

                                $offset = $rec_limit * $page ;
                        }
                        else {
                                $page = 0;
                                $offset = 0;
                        }


                        $ques_id = trim($_GET["q_id"]);                    
                        $result_1 = get_result_1($ques_id,$offset, $rec_limit);
                        //echo $result_1;
                        $result_2 = get_result_2($ques_id);
                        ?>
                        <p></p>
                        <div class = 'row'>

                            <?php        
                                    $row_2 = mysqli_fetch_assoc($result_2);
                                                                             
                                    echo "<h2>".verify_output($row_2['Q_TITLE'])."</h2>";
                                    echo "<hr>";

                            ?>

                        </div>

                        <div class="col-sm-12">
                            <div class = "row">
                                <p></p>
                                <div class="col-sm-1" >                                

                               <?php
                               $v_type = 'Q';
                               echo user_votes($ques_id,$v_type);
                               ?>

                                </div>

                                <div class="col-sm-10" >
                                    <?php

                                    echo verify_output($row_2["Q_TEXT"]);
                                    echo "<p></p>";
                                    $Tag_String = $row_2['Q_TAG'];
                                    
                                    $Tag_Array = explode(' ', $Tag_String);
                                    $i=0;
                                             for($i=0;$i<=(count($Tag_Array)-1);$i++)
                                              {
                                                echo "<button type='button' class='btn btn-sm' >
                                                       <a href='questionsbytag.php?q_tag=".$Tag_Array[$i]."'>".$Tag_Array[$i]."</a></button>";

                                              }                                  
                                    ?>
                                </div>

                                <div class="row">
                                  <div class="col-sm-3"> </div>
                                  <div class="col-sm-5"> </div>
                                  <div class="col-sm-3"  style="background-color:#e0eaf1;">
                                      <p></p>
                                      <div style='background-color:#e0eaf1;width: 80%;'>
                                      <?php $image_urlques = getimageurl($row_2["gravatar"], $row_2["email"], $row_2["user_image"]);
                                      echo '<img src="' . $image_urlques . '" width="55" height="55" alt="" style="float: left;padding: 0 0px 0 0;margin: 0 6% 0 0;">';
                                      ?>

                                      <div>Posted on: <a><?php echo $row_2["CREATION_DATE"] ?></a><br>Posted by: <a href='myprofile.php?uid=<?php echo $row_2["U_ID"] ?>'><?php echo $row_2["FIRST_NAME"] ?></a>
                                      <div><i class='fa fa-certificate' aria-hidden='true'> <?php echo $row_2["SCORE"] ?></i></div></div>

                                      <!-- <div>Posted on: <a><?php echo $row_2["CREATION_DATE"] ?></a></div>
                                      <div>Posted by: <a><?php echo $row_2["FIRST_NAME"] ?></a></div> -->
                                      <p></p>
                                  </div>
                                  <div class="col-sm-1"> </div>
                                </div>

                                <div class="col-sm-1" > </div>
                            </div>

                                <p></p>
                                <h3>Answer</h3>
                                <hr/>

                                    <?php
                                    function bbc2html($content) {
              $search = array (
                '/(\[b\])(.*?)(\[\/b\])/',
                '/(\[i\])(.*?)(\[\/i\])/',
                '/(\[u\])(.*?)(\[\/u\])/',
                '/(\[ul\])(.*?)(\[\/ul\])/',
                '/(\[li\])(.*?)(\[\/li\])/',
                '/(\[url=)(.*?)(\])(.*?)(\[\/url\])/',
                '/(\[url\])(.*?)(\[\/url\])/'
              );

              $replace = array (
                '<strong>$2</strong>',
                '<em>$2</em>',
                '<u>$2</u>',
                '<ul>$2</ul>',
                '<li>$2</li>',
                '<a href="$2" target="_blank">$4</a>',
                '<a href="$2" target="_blank">$2</a>'
              );

              return preg_replace($search, $replace, $content);
            }

                                    while($row_1 = mysqli_fetch_assoc($result_1))
                                    {
                                    $a_id = $row_1["A_ID"];  


                                    echo "<div class = 'row' >
                                          <div class='col-sm-1'>
                                          <div class='votes'>";
                                                                        
                                    

                                    $v_type = 'A';
                                    echo user_votes($a_id,$v_type);                                    
                                                                             
                                    echo "
                                          </div>
                                          </div>

                                          <div class='col-sm-10' style='background-color:#eee;'> <br>" .
                                   
                                          bbc2html(verify_output($row_1["A_TEXT"])) .
                                
                                         " <br>
                                           <br>
                                           </div>       
                                           </div>
                                           <br>

                                           <div class='row'>
                                           <div class='col-sm-3'> 
                                           <p></p>";
                                    //echo $row_2["BA_ID"] . $row_2['U_ID'];
                                    echo best_answer($row_1["A_ID"],$row_2["BA_ID"],$row_2['U_ID'],$ques_id,$row_2['STATE']);
                                    echo  '</div>
                                          <div class="col-sm-5"> </div>
                                          <div class="col-sm-3"  style="background-color:#e0eaf1;">
                                              <p></p>
                                              <div style="background-color:#e0eaf1;width: 80%;">';
                                              $image_url = getimageurl($row_1["gravatar"], $row_1["email"], $row_1["user_image"]);
                                              echo '<img src="' . $image_url . '" width="55" height="55" alt="" style="float: left;padding: 0 0px 0 0;margin: 0 6% 0 0;">';
                                              echo '<div>Ans on: <a>' . $row_1["CREATION_DATE"] . '</a><br>Ans by: <a href = "myprofile.php?uid='.$row_1['U_ID'].'">' . $row_1["FIRST_NAME"] . '</a></div>
                                              </div>
                                              <div><i class="fa fa-certificate" aria-hidden="true"> ' . $row_1["SCORE"] . ' </i></div>
                                              <p></p>
                                          </div>
                                          <div class="col-sm-1"> </div>
                                        </div>';

                                    echo "<hr/>";                            

                                    }

              $page_name = 'view_question.php';
              $query_name = 'get_result_1';
              $p1_name = 'q_id';
              $p1_value = $ques_id;
              $cnt = get_row_count($query_name,$p1_name,$p1_value);
    
              echo generate_pagination_buttons($rec_limit,$cnt,$page,$page_name,$p1_name,$p1_value);

                                    ?>

                                    <?php if(logged_in() && $row_2['STATE'] == 'TRUE'){ ?>
                                    <p></p>
                                    <div class="row">                            
                                        <div class="col-sm-1">                                            

                                        </div>
                                        <div class="col-sm-10">
                                            <h3>Your Answer</h3>
                                            <form  action="#" method ="post" id="postanswer" name = "myform">
                                            <input type="hidden" name="forid" id="textedit" value= <?php echo $ques_id ?> />
                                            <div class="summernote">

                                            </div>
                                            <button type="submit" class="btn btn-primary"> Post Your Answer</button>
                                            <p class='help-block'></p>
                                            </form>  
                                        </div>
                                    </div>
                                    <p></p>
                                    <?php } ?>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-1"></div>

        </div>
    </div>
    </div>

<script>
    $(document).ready(function() {
        $('.summernote').summernote({
          height: 200,                 // set editor height
        });
    });

</script>


<link href="libs/summernote/summernote.css" rel="stylesheet">
<link href="css/signin.css" rel="stylesheet">

<script src="libs/summernote/summernote.js"> </script> 
<script src="js/validations.js"></script>   

<?php
      require_once("footer.php");
?>
