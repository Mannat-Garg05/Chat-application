<!DOCTYPE html>
<?php
session_start();

include('include/header.php');
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

 <style>

.card{
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
    max-width: 400px;
    margin: auto;
    text-align: center;
    font-family: Arial, Helvetica, sans-serif;
    width: fit-content;
    display: flex;
    align-items: center;
}
.card img{
    height:200px
}
.title{
    color:grey;
    font-size:18px;
}
button{
    outline: 0;
    border: none;
    padding: 8px;
    display: inline-block;
    color: white;
    background-color: #000;
    text-align: center;
    cursor: pointer;
    font: 18px;
    width: 100%;
}
#update_profile{
    position: absolute;
    cursor:pointer;
    padding:10px;
    border-radius:4px;
    color:white;
    background-color:#000;
}
label{
    padding:7px;
    display:table;
    color:#fff;

}
input[type='file']{
    display:none;
}
    </style>
    <body>

    <?php
        $user=$_SESSION['user_email'];
        $get_user="select * from users where user_email='$user'";
        $run_user=mysqli_query($con,$get_user) or die (mysqli_error($con));
        $row_user=mysqli_fetch_array($run_user);
        $user_name=$row_user[0];
        $user_profile=$row_user[3];

        echo"
                <div class='card'>
                    <img src='$user_profile'>
                    <h1>$user_name</h1>
                    <form method='post' enctype='multipart/form-data'>
                         <label id='update_profile'>  <i class='fa fa-circle-o' aria-hidden='true'></i>Select Profile 
                        <input type='file' name='u_image'  id='u_image' size='60'></label>
                        <br><br>
                        <button id='button_profile' name='update' style='width:108%; border-radius:4px;'><i class='fa fa-heart' aria-hidden='true'></i> 
                            Update Profile&ensp;</button>
                    </form>
                </div>
                <br>
                <br>
            ";

            if(isset($_POST['update'])){
                $image=$_REQUEST['u_image'];
                echo"$image";
                $u_image=$_FILES['u_image']['name'];
                $image_tmp=$_FILES['u_image']['tmp_name'];
                $random_number=rand(1,1000);

                if($u_image==''){
                    echo"<script>
                        alert('no image selected')
                     </script>";
                    //  echo"<script>
                    //    window.open('upload.php','_self')
                    //  </script>";
                    //  exit();
                }
                else{
                    move_uploaded_file($image_tmp,"images/$u_image.$random_number");

                    $update="update users set user_profile='images/$u_image.$random_number' where user_email='$user'";
                    $run=mysqli_query($con,$update) or die( mysqli_error($con));

                    if($run){
                        echo"<script>
                        alert('Profile updated successfully')
                     </script>";
                     echo"<script>
                       window.open('find_friends.php','_self')
                     </script>";
                    
                    }
                }
            }
?>
 </body>
 </html>
 <?php
 
 }?>