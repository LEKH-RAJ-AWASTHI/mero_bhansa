<?php

    require('../config/constants.inc.php');
    //1. get the id of admin to be deleted
    if(isset($_GET['id']) && isset($_GET['image_name']))
    {
        $id=$_GET['id'];
        $image_name=$_GET['image_name'];
        // if image file is present then we are going to remove the image file
        if($image_name!="")
        {
            $path="../images/category/".$image_name;

            $remove= unlink($path); //unlink function returns true if the file is removed

            if(!$remove)
            {
                $_SESSION['remove']='

                <div id="delete" class="alert alert-danger" role="alert">
                    Failed to remove category
                
              </div>
              ';
              header("location:".SITEURL."admin/manage-category.php");
              die();
            }
        }
     
        // then we will remove the category from the database

        // echo $id;
        //2. execute the query to delete
        $sql="DELETE FROM tbl_category WHERE id=$id";
        $res= mysqli_query($con, $sql);
        if($res)
        {
            // echo "category deleted succesfully";
            // create session variable to display message
            $_SESSION['delete']='

            <div id="delete" class="alert alert-danger" role="alert">
            Category Deleted Successfully
            
            </div>
            ';
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        else
        {
            // echo "category deletion unsuccessfully";
            $_SESSION['delete']='

            <div id="delete" class="alert alert-danger" role="alert">
            Category Deleted Successfully
            
            </div>
            ';            
            header('location:'.SITEURL.'admin/manage-category.php');

        }
    }


?>