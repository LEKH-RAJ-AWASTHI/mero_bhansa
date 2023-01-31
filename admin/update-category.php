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
    <h2>Update Category</h2>
    <?php
        // step 1: get the id of selected admin
        if(isset($_GET['id']))
        {
            $id=$_GET['id'];
            $image_name=$_GET['image_name'];


            // step 2: run query to update
            $sql="SELECT * FROM tbl_category WHERE id='$id'";
            $res= mysqli_query($con, $sql);
            if($res)
            {
                $count= mysqli_num_rows($res);

                if($count==1)
                {
                    // echo "Admin available";
                    $row=mysqli_fetch_assoc($res);
                    $title=$row['title'];
                    $curr_image=$row['image_name'];
                    $featured=$row['featured'];
                    $active=$row['active'];
                }
                else
                {
                    $_SESSION['category-not-exist']=
                '<div id="add" class="alert alert-danger" role="alert">
                    Category Not found.
                    </div>';
                    header('location:'.SITEURL.'admin/manage-category.php');

                }
                }
                else
                {
                    $_SESSION['category-not-exist']=
                    '<div id="add" class="alert alert-danger" role="alert">
                    Category Not found.
                    </div>';
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
            }
        else
        {
            header('location:'.SITEURL.'admin/manage-category.php');

        }
    ?>

    <form action="" method="post" enctype="multipart/form-data">
      <label for="title">Category Title:</label>
      <input type="text" id="title" name="title" value="<?php echo $title;?>" placeholder="Enter Category title" ><br><br>

      
      <label for="title">Current Image:</label>
        <!-- image will be displayed here -->
        <?php 
        if($image_name==$curr_image)
        {
            if($curr_image!='')
            {
                // display the image
                ?>
                <img src="<?php echo SITEURL;?>images/category/<?php echo $curr_image;?>" width="200px" alt="Image">
                <?php
            }   
            else
            {
                //else display the message
                echo '<p style="color:red;"">Image not Added</p>';
            }
        }
        else
        {
            $_SESSION['category-not-exist']=
                    '<div id="add" class="alert alert-danger" role="alert">
                    Image changed.
                    </div>';
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        ?>

      <label for="title">Select Image:</label>
      <input type="file" id="title" name="image" accept="image/*"><br><br>

      <label for="featured">Featured:</label>
      <input type="radio" name="featured" value="yes" <?php if ($featured=='yes') echo 'checked';?> > Yes<br><br>
      <input type="radio" name="featured" value="no" <?php if ($featured=='no') echo 'checked';?>> No<br><br>

      <label for="active">Active:</label>
      <input type="radio" name="active" value="yes" <?php if ($active=='yes') echo 'checked';?> > Yes<br><br>
      <input type="radio" name="active" value="no" <?php if ($active=='no') echo 'checked';?>> No<br><br>
      <input type="hidden" name="id" value="<?php echo $id?>">

      <input type="submit" name="submit" value="Update Category">
    </form>
</div>
<?php
  // for checking the validity of the input from user and process the data to insert in the database
  


  //check whether the submit button is clicked or not

  if(isset($_POST['submit']))
  {
    $id=get_safe_value($con,$_POST['id']);
    $title=get_safe_value($con,$_POST['title']);
    $form_image_name=get_safe_value($con,$_POST['image']);
    $featured=$_POST['featured'];
    $active=$_POST['active'];


    //whether image is selected or not

    if(isset($_FILES['image']['name']))
    {
        $form_image_name=$_FILES['image']['name'];
        if($form_image_name!='')
        {
            //upload the new image
            $ext = pathinfo($form_image_name, PATHINFO_EXTENSION);//extracting extention from the image name
            // echo time(); //generates random value
            // echo $ext;
            // die();
            
            $form_image_name="food_category_".time().".".$ext; 
            $source_path=$_FILES['image']['tmp_name'];
            $destination_path='../images/category/'.$form_image_name;
            //upload image
            $upload=move_uploaded_file($source_path, $destination_path);
          //   if ($file['error'] == 0) {
          //     $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
          //     if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif'])) {
          //         $upload=move_uploaded_file($source_path, $destination_path);
          //     }
          // }
            
            //check whether image is uploaded or not
            //if image is not uploaded then we will stop the process and redirect with error message
            if(!$upload){
              $_SESSION['upload']=
              '<div id="add" class="alert alert-danger" role="alert">
                Failed to upload image.
                </div>';
              header("location:".SITEURL."admin/manage-category.php");
              die();
            }

            if($curr_image!='')
            {
                $path="../images/category/".$curr_image;

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
        }
        
        else
        {
            $form_image_name=$curr_image;
        }
    }
    else
    {
        $form_image_name=$curr_image;
    }


    // echo "$id $full_name , $username";

    //sql query to insert value
    $sql2="UPDATE tbl_category SET 
      title='$title',
      image_name='$form_image_name',
      featured='$featured', 
      active='$active'
      WHERE id='$id'";

    $res2= mysqli_query($con, $sql2) or die(mysqli_error());
  

    if ($res2) {
      // data insertion successful
      // echo "<script>showRibbon();</script>";

      //create a session varible to display message
      $_SESSION['update']='

      <div id="add" class="alert alert-info" role="alert">
      Data Updated Successfully
      
    </div>
    ';


      // REDIRECT TO MANAGE category 
      header("location:".SITEURL."admin/manage-category.php");

    }
    

    else{
      $_SESSION['update']="Failed to update";
      header("location:".SITEURL."admin/update-category.php");
    }

}

  ?>

<?php
include('partials/footer.inc.php');
?>