<?php
include('partials/menu.inc.php');
?>
<div class="add-admin">
    <?php
    $msg='';
    if(isset($_SESSION['change-pwd'])){
      echo $_SESSION['change-pwd']; //Displaying session message
      unset($_SESSION['change-pwd']); //removing session message
    }
    if(isset($_SESSION['user-not-found'])){
        echo $_SESSION['user-not-found']; //Displaying session message
        unset($_SESSION['user-not-found']); //removing session message
    }
    if(isset($_SESSION['pwd-not-matched'])){
        echo $_SESSION['pwd-not-matched']; //Displaying session message
        unset($_SESSION['pwd-not-matched']); //removing session message
    }
    if(isset($_SESSION['sql-error'])){
        echo $_SESSION['sql-error']; //Displaying session message
        unset($_SESSION['sql-error']); //removing session message
    }

    if(isset($_GET['id'])){
        $id=$_GET['id'];
    }
    ?>
    <h2>Change Password</h2>
    
    <form action="" method="post">
      <label for="current-pwd">Current Password:</label>
      <input type="text" id="current-pwd" name="current-pwd" placeholder="Enter current password" required><br><br>

      <label for="new-pwd">New Password:</label>
      <input type="text" id="new-pwd" name="new-pwd" placeholder="Enter new password" required><br><br>

      <label for="con-pwd">Confirm New Password:</label>
      <input type="text" id="con-pwd" name="con-pwd" placeholder="Confirm new password" required><br><br>

      <input type="hidden" name="id" value="<?php echo $id;?>">
      <input type="submit" name="submit" value="Change Password">
    </form>
  </div>
  <?php
  // for checking the validity of the input from user and process the data to insert in the database
  


  //check whether the submit button is clicked or not

  if(isset($_POST['submit']))
  {
    $current_password=md5(get_safe_value($con,$_POST['current-pwd']));
    $new_password=md5(get_safe_value($con,$_POST['new-pwd']));
    $confirm_password=md5(get_safe_value($con,$_POST['con-pwd'])); 
    $id=$_POST['id'];

    // echo "$current_password, $new_password, $conf_new_password, $id";
    
    // step 1: fetch the current password from the database
    $sql="SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password' ";
    $res=mysqli_query($con, $sql);
    pr($res);
    if($res){
        $count=mysqli_num_rows($res);
        // step 2: check if user typed correct confirm password_get_info
        echo $count;
        if($count==1){
            echo $count;
            // step 3: if step 2 is true then compare new pwd and conf-pwd
            if($new_password==$confirm_password){
                // $encrypted_new_password= md5($new_password);
                $sql2="UPDATE tbl_admin SET password='$new_password' where id='$id'";
                $res2=mysqli_query($con,$sql2);
                if($res2){
                    $_SESSION['change_password']='

                    <div id="add" class="alert alert-dark" role="alert">
                    Password changed Successfully
                    
                  </div>';
                
                  header("location:".SITEURL."admin/manage-admin.php");


                }   
                else
                {

                    $_SESSION['sql-error']='

                    <div id="add" class="alert alert-danger" role="alert">
                    Database error: command not executed.
                    
                  </div>';
                
                  // header("location:".SITEURL."admin/update-password.php?id=$id");
                  header("location:".SITEURL."admin/manage-admin.php");
                }

                

                
            }
            else
            {

                $_SESSION['pwd-not-matched']= ' <div id="add" class="alert alert-danger" role="alert">
                New password and confirm password must be same.
                
              </div>';
              // header("location:".SITEURL."admin/update-password.php?id=$id");
              header("location:".SITEURL."admin/manage-admin.php");

            }

        }
        else
        {

            $_SESSION['user-not-found']=' <div id="add" class="alert alert-danger" role="alert">
            Current password does not match.
            
          </div>';
          // header("location:".SITEURL."admin/update-password.php?id=$id");
          header("location:".SITEURL."admin/manage-admin.php");


        }
    }
    else
    {

        $_SESSION['sql-error']='
    
        <div id="add" class="alert alert-danger" role="alert">
        Database error: command not executed.
        
        </div>';
                    
        // header("location:".SITEURL."admin/update-password.php?id=$id");
        header("location:".SITEURL."admin/manage-admin.php");
    }

  }

  ?>

<?php 
include('partials/footer.inc.php');
?>