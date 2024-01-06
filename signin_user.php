<?php
session_start();
$con=mysqli_connect('localhost','root','') or die(mysqli_connect_error());
mysqli_select_db($con,'my_chat');
if(isset($_POST['sign_in'])){
    $pass=$_POST["password"];
    $email=$_POST["email"];
    $select_user="select * from users where user_email='$email' AND user_pass='$pass' ";
    $query= mysqli_query($con,$select_user) or die(mysqli_error($con));
    $check_user= mysqli_num_rows($query);

    if($check_user==1){
        $_SESSION['user_email']=$email;
        $update_message=mysqli_query($con," UPDATE users SET log_in='Online' where user_email='$email' ") or die(mysqli_error($con));
        $user=$_SESSION['user_email'];
        $get_user="select * from users where user_email='$user'";
        $run_user=mysqli_query($con,$get_user) or die(mysqli_error($con));
        $row= mysqli_fetch_array($run_user);
        $user_name=$row[0];
        $_SESSION['user_name']=$user_name;
        echo"<script>window.open('home.php?user_name=$user_name', '_self')</script>";
    }
    else{
        echo"
        <div><strong>Incorrect E-mail or Password...PLease Try again!!!</strong></div>
        ";
    }
}

?>