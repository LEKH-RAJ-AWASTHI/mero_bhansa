<?php

    require('../config/constants.inc.php');
    //1. get the id of admin to be deleted
    $id=$_GET['id'];
    // echo $id;
    //2. execute the query to delete
    $sql="DELETE FROM tbl_admin WHERE id=$id";
    $res= mysqli_query($con, $sql);
    if($res){
        // echo "admin deleted succesfully";
        // create session variable to display message
        $_SESSION['delete']='

        <div id="delete" class="alert alert-danger" role="alert">
        Data Deleted Successfully
        
      </div>
      ';
      header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else{
        // echo "admin deletion unsuccessfully";
        $_SESSION['delete']='Admin Deletion failed';
        header('location:'.SITEURL.'admin/manage-admin.php');

    }

?>