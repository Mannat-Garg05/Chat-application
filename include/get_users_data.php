<?php
    $con=mysqli_connect('localhost','root','') or die("Connection not established");
    mysqli_select_db($con,'my_chat');
    
    $user="select * from users";
    $run_user=mysqli_query($con,$user); 

    while($row_user=mysqli_fetch_array($run_user)){
        $user_name=$row_user[0];
        $user_profile=$row_user[3];
        $login=$row_user[7];

        echo"<li>
            <div class='chat-left-img'>
                <img src='$user_profile'>
            </div>
            <div class='chat-left-details'><p>
                <a href='home.php?user_name=$user_name'>$user_name</a>
            </p></div>";

            if($login=='Online'){
                echo"<span>
                <i class='fa fa-circle' aria-hidden='true'> </i>
                    Online
                </span>";
            }
            else{
                echo"<span>
                <i class='fa fa-circle-o' aria-hidden='true'> </i>
                    Offline
                </span>";
            }
            echo"</div></li>"; 
    }
?>