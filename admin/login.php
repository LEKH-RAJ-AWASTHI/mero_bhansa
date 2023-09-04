<?php require('../config/constants.inc.php'); ?>
<?php require('../config/functions.inc.php'); ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>Admin Login | FOOD ORDER SYSTEM</title>
</head>
<body>
    <?php
    if(isset($_SESSION['login']))
    {
        echo $_SESSION['login'];
        unset($_SESSION['login']);
    }
    if(isset($_SESSION['no-login']))
    {
        echo $_SESSION['no-login'];
        unset($_SESSION['no-login']);
    }

    ?>
    
<div class="login-container">
    <h1 style="margin-top: 20px; text-decoration: underline;">Login</h1>
    <form action="" method="POST">
      <label for="username">Username:</label>
      <input type="text" id="username" name="username">
      <br>
      <label for="password">Password:</label>
      <input type="password" id="password" name="password">
      <br><br>
      <button type="submit" name="submit">Login</button>
      <a href="#">Forgot Password?</a>
    </form>
    <p>Created by @LekhRajAwasthi</p>
  </div>

  <?php
  $full_name;
    if(isset($_POST['submit']))
    {
        $username=get_safe_value($con, $_POST['username']);
        $password=get_safe_value($con,(md5($_POST['password'])));

        // echo "$username, $password";
        //sql to check the username and password in database
        $sql= "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";
        $res=mysqli_query($con, $sql);
        // pr($res);
        $count=mysqli_num_rows($res);
        // echo $count;
        if($count==1)
        {
          $row=mysqli_fetch_assoc($res);
          $full_name=$row['full_name'];
          echo $full_name;  
            //user available login success
            $_SESSION['login']='
    
            <div id="add" class="alert alert-success" role="alert">
            Login Succesfull
            
          </div>
          ';
          $_SESSION['user']=$username;//it is used to check if the user is logged in or not and logout will unset it
          $_SESSION['full_name']='<p style="display:inline; font-weight:bold;">'.$full_name.'</p>';

          header('location:'.SITEURL.'admin/');
        }
        else
        {
            $_SESSION['login']='
    
            <div id="add" class="alert alert-danger" role="alert">
            Login unsuccesful: username or password does not match
            
          </div>
          ';
          header('location:'.SITEURL.'admin/login.php');
        }

    }
  ?>
</body>
</html>