<?php
include('partials/menu.inc.php');
?>

<?php
    if(isset($_SESSION['update'])){
      echo $_SESSION['update']; //Displaying session message
      unset($_SESSION['update']); //removing session message
    }
    ?>
<div class="add-admin">
    <h2>Update Admin</h2>
    <?php
        // step 1: get the id of selected admin
        if(isset($_GET['id'])){
          $id=$_GET['id'];
        }
        else
        {
          header('location:'.SITEURL.'admin/manage-admin.php');

        }
        $sql="SELECT * FROM tbl_admin WHERE id=$id";
        $res= mysqli_query($con, $sql);
        if($res)
        {
            $count= mysqli_num_rows($res);

            if($count==1)
            {
                // echo "Admin available";
                $row=mysqli_fetch_assoc($res);
                $full_name=$row['full_name'];
                $username=$row['username'];
            }
            else
            {
                header('location:'.SITEURL.'admin/manage-admin.php');

            }
        }

        // step 2: run query to update
    ?>

    <form action="" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="full_name" placeholder="Enter your name" value="<?php echo $full_name; ?>" required><br><br>

        <label for="Username">Username:</label>
        <input type="text" id="username" name="username" placeholder="Enter username" value="<?php echo $username; ?>" required><br><br>

        <!-- <label for="password">Password:</label>
        <input type="text" id="password" name="password" placeholder="Enter password" required><br><br> -->
        <input type="hidden" name="id" value="<?php echo $id?>">
        <input type="submit" name="submit" value="Update Admin">
    </form>
</div>
<?php
  // for checking the validity of the input from user and process the data to insert in the database
  


  //check whether the submit button is clicked or not

  if(isset($_POST['submit']))
  {
    $id=get_safe_value($con,$_POST['id']);
    $full_name=get_safe_value($con,$_POST['full_name']);
    $username=get_safe_value($con,$_POST['username']);


    // echo "$id $full_name , $username";

    //sql query to insert value
    $sql="UPDATE tbl_admin SET 
      full_name='$full_name',
      username='$username' 
      WHERE id='$id'";

    $res= mysqli_query($con, $sql) or die(mysqli_error());
  

    if ($res) {
      // data insertion successful
      // echo "<script>showRibbon();</script>";

      //create a session varible to display message
      $_SESSION['update']='

      <div id="add" class="alert alert-info" role="alert">
      Data Updated Successfully
      
    </div>
    ';


      // REDIRECT TO MANAGE ADMIN 
      header("location:".SITEURL."admin/manage-admin.php");

    }
    

    else{
      $_SESSION['update']="Failed to add data";
      header("location:".SITEURL."admin/update-admin.php");
    }

  }

  ?>

<?php
include('partials/footer.inc.php');
?>