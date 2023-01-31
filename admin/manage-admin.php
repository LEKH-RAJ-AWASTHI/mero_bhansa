<?php
include("partials/menu.inc.php");
?>

<!-- Main content section initiated -->
<div class="main-content">

    <div class="wrapper">
        <h1>Manage Admin</h1>
        <br>
        <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];//Displaying session message
                unset($_SESSION['add']);// removing session message
            }
            if(isset($_SESSION['delete']))
            {
                echo $_SESSION['delete'];//Displaying session message
                unset($_SESSION['delete']);// removing session message
            }
            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];//Displaying session message
                unset($_SESSION['update']);// removing session message
            }
            if(isset($_SESSION['change_password']))
            {
                echo $_SESSION['change_password'];//Displaying session message
                unset($_SESSION['change_password']);// removing session message
            }
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
            //   if(isset($_SESSION['user_already_exist'])){
            //       echo $_SESSION['user_already_exist']; //Displaying session message
            //       unset($_SESSION['user_already_exist']); //removing session message
            //   }

        ?>
        <br>

        <!-- button for admin -->
        <a href="<?php echo SITEURL; ?>admin/add-admin.php" class="btn btn-primary">Add Admin</a>
        <br>
        <br>

        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>

            <?php
                $sql="SELECT * FROM tbl_admin";
                $res= mysqli_query($con,$sql);

                if($res){
                    //count rows
                    $count=mysqli_num_rows($res);// function to show the number of rows
                    if($count>0)
                    {
                        $sn=1;
                       while($rows=mysqli_fetch_assoc($res))
                       {
                            $id= $rows['id'];
                            $full_name=$rows['full_name'];
                            $username=$rows['username'];
                            
                            // displaying the value in table
                            ?>
                            <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $full_name; ?></td>
                            <td><?php echo $username; ?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id ?>" class="btn btn-link">Change Password</a>
                                <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id ?>" class="btn btn-secondary">Update Admin</a>
                                <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id ?>" class="btn btn-danger">Remove Admin</a>

                            </td>
                        </tr>
                        <?php 
                        }
                    }
                    else
                    {
                        // echo "We donot have data in database";
                    }
                }
            ?>
        </table>



        <div class="clearfix"></div>
    </div>


</div>
<!-- main content section terminated -->

<?php
 include("partials/footer.inc.php");
 ?>