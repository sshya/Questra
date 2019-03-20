<?php
  include("./includes/session.php");
  include("./includes/db_connection.php");
  include("./includes/functions.php");
?>
<?php
if(isset($_GET['code']))
    {
            $code = $_GET['code'];
            $post = http_build_query(array(
                'client_id' => 'b981ea758eaf4d37d9f4',
                'redirect_url' => 'http://rvajrapu.cs518.cs.odu.edu/login.php',
                'client_secret' => 'a8a4af5d33caa01d04966449f63b6d6650d89b2e',
                'code' => $code,
            ));

            $context = stream_context_create(
                array(
                    "http" => array(
                        "method" => "POST",
                        'header'=> "Content-type: application/x-www-form-urlencoded\r\n" .
                                    "Content-Length: ". strlen($post) . "\r\n".
                                    "Accept: application/json" ,  
                        "content" => $post,
                    )
                )
            );

            $json_data = file_get_contents("https://github.com/login/oauth/access_token", false, $context);
            $r = json_decode($json_data , true);
            $access_token = $r['access_token'];
            $scope = $r['scope']; 

            $url = "https://api.github.com/user?access_token=".$access_token."";
            $options  = array('http' => array('user_agent'=> $_SERVER['HTTP_USER_AGENT']));
            $context  = stream_context_create($options);
            $data = file_get_contents($url, false, $context); 
            $user_data  = json_decode($data, true);
            $username = $user_data['login'];
            $username_1 = $user_data['login'];


            /*- Get User e-mail Details -*/                
            $url = "https://api.github.com/user/emails?access_token=".$access_token."";
            $options  = array('http' => array('user_agent'=> $_SERVER['HTTP_USER_AGENT']));
            $context  = stream_context_create($options);
            $emails =  file_get_contents($url, false, $context);
            $email_data = json_decode($emails, true);
            $email_id = $email_data[0]['email'];
            $email_primary = $email_data[0]['primary'];
            $email_verified = $email_data[0]['verified'];


            $result = git_validate_user($username);
            $row = mysqli_fetch_assoc($result);


            if ($row["u_id"] != NULL)
            {
                //echo "User Exists";
                $_SESSION["uid"] = (int)$row["u_id"];
                //echo $_SESSION["uid"];
                $_SESSION["username"] = $row["user_id"];
                //echo $_SESSION["username"];
                $_SESSION["git_user"] = 'True';
                //echo $_SESSION["git_user"];
                $_SESSION["git_image"] = 'https://github.com/'.$row["user_id"].'png';
                //echo $_SESSION["git_image"];

                redirect_to("index.php");
            }
            else
            {
                //echo "User do not Exists";
                insert_user($user_data['login'],$email_data[0]['email'],'gituser','');
                $result_new = git_validate_user($user_data['login']);
                $row_new = mysqli_fetch_assoc($result_new);
                if ($row_new["u_id"] != NULL)
                {
                    $_SESSION["uid"] = (int)$row_new["u_id"];
                  //  echo $_SESSION["uid"];
                    $_SESSION["username"] = $row_new["user_id"];
                  //  echo $_SESSION["username"]; 
                    $_SESSION["git_user"] = 'True';
                   // echo $_SESSION["git_user"];
                    $_SESSION["git_image"] = 'https://github.com/'.$row_new["user_id"].'.png';
                   // echo $_SESSION["git_image"];

                   redirect_to("index.php");
                }
    }

    }
 ?>   