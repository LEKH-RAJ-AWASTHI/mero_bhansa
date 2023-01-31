<!DOCTYPE html>
<html>

<head>
  <title>Add Category</title>
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
    if(isset($_SESSION['upload'])){
      echo $_SESSION['upload']; //Displaying session message
      unset($_SESSION['upload']); //removing session message
    }
    ?>
    <h2>Add Category</h2>
    <?php

    ?>
    
    <form action="" method="post" enctype="multipart/form-data">
      <label for="title">Category Title:</label>
      <input type="text" id="title" name="title" placeholder="Enter Category title" ><br><br>
      <label for="title">Select Image:</label>
      <input type="file" id="title" name="image" accept="image/*"><br><br>

      <label for="featured">Featured:</label>
      <input type="radio" name="featured" value="yes" > Yes<br><br>
      <input type="radio" name="featured" value="no" > No<br><br>

      <label for="active">Active:</label>
      <input type="radio" name="active" value="yes" > Yes<br><br>
      <input type="radio" name="active" value="no" > No<br><br>

      <input type="submit" name="submit" value="Add Category">
    </form>
  </div>
   
  <?php 
    if(isset($_POST['submit']))
    {
        // echo "clicked";
        // get the values from form
        $title=get_safe_value($con,$_POST['title']);

        //check if button is selected or not
        if(isset($_POST['featured'])){
          // get the value from form
          $featured=$_POST['featured'];

        }
        else{
          $featured="no";
        }
        if(isset($_POST['active'])){
          // get the value from form
          $active=$_POST['active'];

        }
        else{
          $active="no";
        }

        //checking whether image is selected or not and doing futher operations
        if(isset($_FILES['image']['name']))//checking if image is selected or not and if file has name or not( name can be shown by using print_r the value of $_FILES['image'])
        {
        // pr($_FILES['image']);
        // die();
          //upload the image
          // to upload image we need image we need image name, source path and destination path
          $image_name=$_FILES['image']['name'];
          //Renaming the image to be uploaded to remove the conflict between the files
          // step 1: get the extention of the image
          if($image_name!="")
          {
            $ext = pathinfo($image_name, PATHINFO_EXTENSION);//extracting extention from the image name
            // echo time(); //generates random value
            // echo $ext;
            // die();
            
            $image_name="food_category_".time().".".$ext; 
            $source_path=$_FILES['image']['tmp_name'];
            $destination_path='../images/category/'.$image_name;
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
              header("location:".SITEURL."admin/add-category.php");
              die();
      
            }
          }
         

      }
      else{
        //don't upload image and 
        $image_name='';
      }

      $sql="insert into tbl_category set
            title='$title',
            image_name='$image_name',
            featured='$featured',
            active='$active'
            ";
      
      $res= mysqli_query($con, $sql);

      if($res){
        $_SESSION['add']='
    
        <div id="add" class="alert alert-success" role="alert">
        Category added Successfully
        
      </div>
      ';


        // REDIRECT TO MANAGE ADMIN 
        header("location:".SITEURL."admin/manage-category.php");

      }
      else{
        //failed to add category
        $_SESSION['add']="Failed to add category";
          header("location:".SITEURL."admin/add-category.php");

      }
    }
  ?>
<?php include("partials/footer.inc.php"); ?>