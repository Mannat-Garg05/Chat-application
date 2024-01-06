
<!DOCTYPE html>
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
    
</body>
</html>
<?php
    $con=mysqli_connect('localhost','root','') or die("Connection not established");
    mysqli_select_db($con,'my_chat');

    function search_friend(){
        global $con;
        if(isset($_REQUEST['search_btn'])){
            $search_query=$_REQUEST['search_query'];
            $get_user="select * from users where user_name like '%$search_query%' OR user_country like '%$search_query%' ";

        }   
        else{
            $get_user="select * from users order by user_country, user_name DESC LIMIT 5";
        }
        $run_user=mysqli_query($con,$get_user);
        while($row_user=mysqli_fetch_array($run_user)){
            $user_name=$row_user[0];
            $user_profile=$row_user[3];
            $country=$row_user[4];
            $gender=$row_user[5];   

            echo"
                <div class='card' style='width:100%;'>
                    <img src='../$user_profile'>
                    <h1>$user_name</h1>
                    <p class='title'>$country</p>
                    <p>$gender</p>

                    <form method='post' style='width:100%;' >
                        <p><button name='add' style='width:100%;'>
                        Chat with $user_name
                        
                        </button></p>
                    </form>
            </div><br><br>

                ";

                if(isset(($_POST['add']))){
                  header('location: ../home.php?user_name=$user_name');
                }
            }
    }
?>