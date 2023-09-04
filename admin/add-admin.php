<!DOCTYPE html>
<html>

<head>
  <title>Add Admin</title>
  <?php 
    include("partials/menu.inc.php");
  ?>
</head>

<body>
  <div class="add-admin">
    <?php
    if(isset($_SESSION['add'])){
      echo $_SESSION['add']; //Displaying session message
      unset($_SESSION['add']); //removing session message
    }
    if(isset($_SESSION['user_already_exist'])){
      echo $_SESSION['user_already_exist']; //Displaying session message
      unset($_SESSION['user_already_exist']); //removing session message
    }
    ?>
    <h2>Add Admin</h2>
    
    <form action="" method="post">
      <label for="name">Name:</label>
      <input type="text" id="name" name="full_name" placeholder="Enter your name" required><br><br>

      <label for="Username">Username:</label>
      <input type="text" id="username" name="username" placeholder="Enter username" required><br><br>

      <label for="password">Password:</label>
      <input type="text" id="password" name="password" placeholder="Enter password" required><br><br>

      <input type="submit" name="submit" value="Add Admin">
    </form>
  </div>
  

  <?php
  // for checking the validity of the input from user and process the data to insert in the database
  


  //check whether the submit button is clicked or not

  if(isset($_POST['submit']))
  {
    $full_name=get_safe_value($con,$_POST['full_name']);
    $username=get_safe_value($con,$_POST['username']);
    $password=md5(get_safe_value($con,$_POST['password'])); //password is encrypted with md5

    // echo "$full_name , $username, $password";
    $check_existing_sql="select username from tbl_admin where username='$username'";

    $res=mysqli_query($con, $check_existing_sql);
    if($res)
    {
      $count_rows=mysqli_num_rows($res);
      if($count_rows)
      {
        $_SESSION['user_already_exist']='
    
          <div id="add" class="alert alert-success" role="alert">
          Username already exists please select another username
          
        </div>
        ';
        header("location:".SITEURL."admin/add-admin.php");

      }
      else
      {
        $sql="INSERT INTO tbl_admin (full_name, username, password) VALUES('$full_name','$username', '$password')";

        $res= mysqli_query($con, $sql) or die(mysqli_error($con));
      
    
        if ($res) {
          // data insertion successful
          // echo "<script>showRibbon();</script>";
    
          //create a session varible to display message
          $_SESSION['add']='
    
          <div id="add" class="alert alert-success" role="alert">
          Data Inserted Successfully
          
        </div>
        ';
    
    
          // REDIRECT TO MANAGE ADMIN 
          header("location:".SITEURL."admin/manage-admin.php");
    
        }
        
    
        else{
          $_SESSION['add']="Failed to add data";
          header("location:".SITEURL."admin/add-admin.php");
        }
    
      }
    }

    else
    {
      $_SESSION['sql-error']='<div id="add" class="alert alert-danger" role="alert">
      Database error: command not executed.
      
      </div>';
      header("location:".SITEURL."admin/manage-admin.php");
  
    }
  }

  ?>

<?php include("partials/footer.inc.php"); ?>