<?php
// include("include/connection.php");
$con=mysqli_connect('localhost','root','') or die(mysqli_connect_error());
mysqli_select_db($con,'my_chat');

    $name=$_POST["user_name"];
    $pass=$_POST["user_pass"];
    $email=$_POST["user_email"];
    $country=$_POST["user_country"];
    $gender=$_POST["user_gender"];
    $rand=$_POST["user_gender"];

    if($name==' '){
        echo "Please enter a valis name";
    }
    if(strlen($pass)<8){
        echo "Please enter password with minimum length 8";  
        // header("location:signup.php");
        exit(); 
    }

    $check_email="select * from users where user_email='$email'";
    $run_email=mysqli_query($con,$check_email) or die(mysqli_error($con));
    $check=mysqli_num_rows($run_email);

    if($check>=1){
        echo "Email already exists .Please try again!!";
        //header("location:signup.php");
        exit();
    }

    if($rand =='male'){
        $profile="images/male.svg";
    }
    elseif($rand =='female'){
        $profile="images/female.svg";
    }
    // $profile="images/male.svg";

    $insert= "insert into users (user_name,user_pass,user_email,user_profile,user_country,user_gender) values ('$name','$pass','$email','$profile',
    '$country','$gender')";

    $query=mysqli_query($con,$insert) or die(mysqli_error($con));
    if($query){
        echo "Congratulations  your account has been created successfully";
         header("location:signin.php");
    }
    else{
        echo "Error occured , Please try again!!!";
         header("location:signup.php");
    }

?>