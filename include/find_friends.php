<!DOCTYPE html>
<?php
session_start();
include('find_friends_function.php');
$con=mysqli_connect('localhost','root','') or die(mysqli_connect_error());
mysqli_select_db($con,'my_chat');

if(!isset($_SESSION['user_email'])){
    header("loaction:signin.php");
}
else{

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <!-- <link rel="stylesheet" type="text/css" href="css/signin.css"> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="../css/find_people.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</head>
<body>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark" href="">
        <a href="" class="navbar-brand">
            <?php
           
                $user=$_SESSION['user_email'];
                $get_user="select * from users where user_email='$user'";
                $run_user=mysqli_query($con,$get_user);
                $row=mysqli_fetch_array($run_user);
                $user_name=$row[0];
                echo"<a class='navbar-brand' href='../home.php?user_name=$user_name'>MYChat</a> ";
            ?>
            
        </a>
        <ul class="navbar-nav">
                <li><a style="color:white; text-decoration:none; font-size:20px;" href="../account_settings.php">Settings</a></li>
        </ul>
    </nav> 
    <br>
    <div class="row" >
       
        <div class="col-sm-4"style="width:100%;">
            <form class="select_form" action="">
                <div style="display:flex; align-items:center; justify-content:center">
                <input style="height:180;" type="text" name="search_query" placeholder="find friends" autocomplete="off" required >&emsp;
                <button class="btn btn-primary" type="submit" name='search_btn' style="width:10%; height:50%;">search</button>

                </div>
            </form>    
        <div>
        <div class="col-sm-4">

        </div>    
    </div>
    <br>
    <br>
    <?php
    search_friend();?>
</body>

</html>

<?php
}
?>