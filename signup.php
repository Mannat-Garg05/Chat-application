<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/signin.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>
    <div class="signin-form">
        <form action="signup_user.php" method="post">
            <div class="form-header">
                <!-- <img src="..images/signin-back"> -->
                <h2>
                    SignUp 
                </h2>
                <p> Create New Account</p>
            </div>
            <div class="form-group">
                <label>
                    Username<span style="color:red;">&ensp;*</span>
                </label>
                <input  class="form-control" type="text" name="user_name" placeholder="Example_Gomzi" autocomplete="off"  required>

            </div>
            <div class="form-group">
                <label>
                    Password<span style="color:red;">&ensp;*</span>
                </label>
                <input  class="form-control" type="password" name="user_pass" placeholder="Enter your password" autocomplete="off"  required>

            </div>
            <div class="form-group">
                <label>
                    E-mail<span style="color:red;">&ensp;*</span>
                </label>
                <input  class="form-control" type="email" name="user_email" placeholder="somebody@xyz.com" autocomplete="off"  required>

            </div>
            <div class="form-group">
                <label>
                   Country<span style="color:red;">&ensp;*</span>
                </label>
                <select class="form-control" name="user_country" required>
                    <option disabled> Select Country</option>
                    <option value="Armenia">Armenia<option>
                    <option value="Arab">Arab<option>
                    <option value="Baluchistan">Baluchistan<option>
              
                    <option value="Bangladesh">Bangladesh<option>
                    <option value="China">China<option>
                    <option value="Chile">Chile<option>
                    <option value="Denmark">Denmark<option>
                    <option value="England">England<option>
                    <option value="Finland">Finland<option>
                    <option value="Gulf">Gulf<option>
                    <option value="Holland">Holland<option>
                    <option value="India">India<option>
                </select>
            </div>
            <div class="form-group">
                <p>What is your gender?</p>
                <input type="radio" name="user_gender" value="male" checked> Male
                <input type="radio" name="user_gender" value="female"> Female

            </div>
            <div class="form-group">
                <label class="checkbox-inline">
                    <input type="checkbox" required> I accept the Areement <a href="#"> tems and uses</a>
                </label>
            </div>
            

            <br>
          
            <div class="form_group">
                <input type="submit" class="btn btn-primary btn-block btn-lg" name="sign_in" value="Create  ">
            </div>
            
        </form>
        <div class="text-center small " style="color:black; font-size: 20px;">
        ALready have an account?<a href="signin.php" style=" color:#333;" >Login</a>
        </div>
    </div>
</body>
</html>