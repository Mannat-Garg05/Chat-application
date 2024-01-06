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

    <!-- <style>

/* #box{
    display:none;
}
.info:hover + #box{
    display:block;
} */
</style>     -->

<script>document.getElementsByClassName("info").onmouseclick = function() {getAlert()};
function getAlert(){
  alert('This feild will be asked when you need to recover or change your password;');
}</script>
</head>
<body>
    <div class="row" >
        <!-- <div class="col-sm-4">
        </div> -->
        <?php
        $user=$_SESSION['user_email'];
        $get_user="select * from users where user_email='$user'";
        $run_user=mysqli_query($con,$get_user) or die (mysqli_error($con));
        $row_user=mysqli_fetch_array($run_user);
        
        $user_name=$row_user[0];
        $user_pass=$row_user[1];
        $user_email=$row_user[2];
        $user_profile=$row_user[3];
        $user_country=$row_user[4];
        $user_gender=$row_user[5];
        $forgotten_answer=$row_user[6];
        ?>

        <div class="col-sm-8">
            <form method="post" enctype="multipart/form-data">
                <table class="table table-bodered table-hover">
                    <tr align="center">
                        <td colspan="6" class="active"><h2>Change Account Settings</h2></td>
                    </tr>  
                    <tr>
                        <td style="font-weight:bold;">Change Your Username</td>
                        <td>
                            <input type="text" name="u_name" class="form_control"  value="<?php
                            
                                                        echo $user_name;?>">
                        </td> 
                    </tr>
                    <tr>
                        <td style="font-weight:bold;">Update your picture</td>
                        <td><a href="upload.php" class="btn btn-default" style="text-decoration:none;font-size:15px">
                            <i class="fa fa-user" aria-hidden="true"></i>Change Profile</a>
                        </td>
                    </tr>

                    <tr>
                        <td style="font-weight:bold;">Change Your Email</td>
                        <td>
                        <input type="email" name="u_email" class="form_control"  value="<?php
                            
                            echo $user_email;?>">

                        </td>
                    </tr>

                    <tr>
                        <td style="font-weight:bold;">Country</td>
                        <td>
                            <select class="form-control" name="u_control" style="width:45%; border:0.7px solid black;">
                                <option><?php echo $user_country; ?></option>
                                <option>USA</option>
                                <option>UK</option>
                                <option>Dubai</option>
                                <option>Canada</option>
                            </select>

                        </td>
                    </tr>
                    <tr>
                        <td style="font-weight:bold;">
                            Childhood Name <p style="display:inline;" class="info">&#8505;</p></td>
                           
                        <td>
                        <input type="text" name="u_forgot" class="form_control"  value="<?php
                            
                            echo $forgotten_answer;?>">
                            <!-- <div class="modal fade " role="dialog" id="box">
                                <div class="modal-dialog">
                                    <div class="modal-header">
                                        <button type="header" class="close" data-dismiss="modal">&times;<button>
                                    </div>
                                    <div class="modal-body">
                                        <strong> What was your Childhood name??</strong>
                                        <br>
                                        <br>
                                        <pre>
                                            This feild will be asked when you 
                                            need to recover or change your password;
                                            <br><br>
                                        </pre>
                                    </div>
                                </div>
                            </div> -->

                        </td>
                    </tr>

                    <tr>
                        <td style="font-weight:bold;"></td>
                    </tr>
                    <tr>
                        <td style="font-weight:bold;">Update your password</td>
                        <td><a href="change_password.php" class="btn btn-default" style="text-decoration:none;font-size:15px">
                            <i class="fa fa-key fa-fw" aria-hidden="true"></i>Change Password</a>
                        </td>
                    </tr>
                    <br>
                    <tr align="center">
                        <td colspan="6">
                            <input type="submit" name="update" value="Update" class="btn btn-info">
                        </td>
                    </tr>

                </table>
            </form>
<?php
    if(isset($_POST['update'])){
        $user_name_u=$_POST['u_name'];
        $user_email_u=$_POST['u_email'];
        $user_country_u=$_POST['u_control'];
        $user_forgot_u=$_POST['u_forgot'];

        $qry="update users set user_name='$user_name_u' , user_email='$user_email_u' , user_country='$user_country_u' , forgotten_answer='$user_forgot_u' where user_name='$user_name' ";
        $run=mysqli_query($con,$qry) or die(mysqli_error($con));

        if($run){
            echo"<script>alert('Data Successfully updated')</script>";
            echo"<script>window.open('account_settings.php','_self')</script>";
        }
    }   

?>
        </div>
    </div>
    
</body>
</html>
<?php
 }?>