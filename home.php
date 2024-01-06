<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <!-- <link rel="stylesheet" type="text/css" href="css/signin.css"> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="css/home.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</head>
<body>
    <div class="container main-section">
        <div class="row">
            <div class="col-md-3 col-sm-3 col-xs-12 left-sidebar">
                <div class="input-group searchbox">
                    <div class="input-group-btn">
                        <center>
                            <a href="include/find_friends.php"><button class="btn btn-primary search-icon" name="search_user" type="submit">Add New User</button></a>
                        </center>
                    </div>
                </div>
                <div class="left-chat">
                    <ul>
                        <?php
                        include("include/get_users_data.php");
                        ?>
                    </ul>
                </div>
            </div>
            <div class="col-md-9 col-sm-9 col-xs-12 right-sidebar">
                <div class="row">
                    <!-- to get the info of the user who is logged in -->
                    <?php
                        session_start();
                        $user=$_SESSION['user_email'];
                        $get_user='select * from users where user_email= "$user" ';
                        $run_user=mysqli_query($con,$get_user) or die (mysqli_error($con));
                        $row= mysqli_fetch_array($run_user);
                        $user_name=$row[0];
                   
                  //  <!-- getting data of the other user on which we click-->
                  
                       
                        global $con;
                        // $user_name;
                        $get_username=$_SESSION['user_name'];
                        $get_user='select * from users where user_name="$get_username" ';
                        $run_user=mysqli_query($con,$get_user) or die( mysqli_error($con));
                        $row_user=mysqli_fetch_array($run_user);
                        $username=$row_user[0];
                        $user_profile_image=$row_user[3];
                        $total_messages= "select * from user_chat where (sender_username='$user_name' AND receiver_username='$username' ) OR ( receiver_username='$user_name' AND sender_username='$username')";
                        $run_messages=mysqli_query($con,$total_messages) or die (mysqli_error($con));
                        $total=mysqli_num_rows($run_messages);
                        
                    ?>
                    <div class="col-md-12 right-header">
                        <div class="right-header-img">
                            <img str="<?php
                                echo"$user_profile_image";
                            ?>">
                        </div>
                        <div class="right-header-detail">
                            <form action="" method="post">
                                <p><?php echo"$username"; ?></p>
                                <span><?php echo $total; ?> messages </span>&emsp;
                                <button name="logout" class="btn btn-danger">Logout</button>
                            </form>
                            <?php
                            if(isset($_POST['logout'])){
                               $run='update users set `log_in`= "Offline" where `user_name`="$get_username" ';
                                $update_msg=mysqli_query($con,$run) or die(mysqli_error($con));
                                // session_start();
                               echo"<script>window.open('signin.php','_self')</script>";
                                
                                exit();
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div id="scrolling_to_bottom" class="col-md-12 right-header-contentChat">
                        <?php
                         $update_msg=mysqli_query($con,"update user_chat set msg_status= 'Read' where sender_username ='$username' AND receiver_username='$user_name' ");
                         $sel_msg="select * from user_chat where (sender_username ='$username' AND receiver_username='$user_name' ) OR (sender_username ='$user_name' AND receiver_username='$username' )  ORDER by 1 ASC";
                         $run_msg=mysqli_query($con,$sel_msg) or die(mysqli_error($con));

                         while($row=mysqli_fetch_array($run_msg)){
                            $sender_username=$row[1];
                            $receiver_username=$row[2];
                            $msg_content=$row[3];
                            $msg_date=$row[5];
                         
                               
                        ?>
                        <ul>

                            <?php
                                if($user_name==$sender_username And $username==$receiver_username){
                                    echo "
                                    <li>
                                        <div class='rightside-chat'>
                                            <span>$username<small>$msg_date</small></span>
                                            <p>$msg_content</p>
                                        </div>
                                    </li>";
                                }

                                else if($user_name==$receiver_username And $username==$sender_username){
                                    echo "
                                    <li>
                                        <div class='rightside-chat'>
                                            <span>$username<small>$msg_date</small></span>
                                            <p>$msg_content</p>
                                        </div>
                                    </li>";
                                }
                            ?>
                        </ul>
                        <?php
                         }
                         ?>
                    </div>

                </div>
            <div class="row">
                <!-- this is to send the message-->
                <div class="col-md-12 right-chat-textbox">
                    <form method="post">

                    <input type="text" placeholder="What's in your mind!!" name="msg_content"> 
                    <button class="btn" name="submit">
                        <i class="fa fa-telegram" aria-hidden="true"></i>

                    </button>
                        </form>
                    
                </div>   

            </div>
            </div>
        </div>

    </div>
    <?php
        if(isset($_POST['submit'])){
            $msg=$_REQUEST['msg_content'];
            if($msg==""){
                echo"<div class=''alert alert-danger>
                Message was unable to send</div>";
            }
            else if(strlen($msg)>=100){
                echo"<div class=''alert alert-danger>
                Message was unable to send due to more characters</div>";
            }
            else{
                $date = date('d-m-y h:i:s');

                $insert="insert into user_chat(sender_username,receiver_username,msg_content,msg_status,msg_date) values ('$user_name','$username','$msg','unread','$date')";
                $run_insert=mysqli_query($con,$insert) or die( mysqli_error($con));
            }
        }
    ?>
    <script>
        $('scrolling_to_bottom').animate({
            scrollTop: $('#scrolling_to_bottom').get(0).scrollHeight},1000);
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            var height= $(window).height();
            $('.left-chat').css('height',(height - 92)+ 'px');
            $('.right-chat-contentChat').css('height',(height - 163)+ 'px');
        });
        </script>
</body>
</html>