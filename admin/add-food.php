<!DOCTYPE html>
<html>

<head>
  <title>Add food</title>
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
    if(isset($_SESSION['db-error'])){
      echo $_SESSION['db-error']; //Displaying session message
      unset($_SESSION['db-error']); //removing session message
    }
    ?>
    <h2>Add food</h2>
    <?php

    ?>
    
    <form action="" method="post" enctype="multipart/form-data">
      <label for="title">Food Title:</label>
      <input type="text" id="title" name="title" placeholder="Enter food title" ><br><br>
      
      <label for="desc">Food Description:</label>
      <textarea name="description" rows="5" cols="10" placeholder="Enter Description"></textarea>      
      <label for="price">Food price:</label>
      <input type="number" id="price" name="price" placeholder="Enter food price" ><br><br>
      
      <label for="image">Select Image:</label>
      <input type="file" id="" name="image" accept="image/*"><br><br>
      
      <label for="category">Category</label>
      <select name="category">
        <?php
            //php code to display the categories from the tbl_category
            $sql="SELECT * FROM tbl_category WHERE active='yes' ";
            $res=mysqli_query($con, $sql);
            if($res)
            {
                $count=mysqli_num_rows($res);
                if($count)
                {
                    while($rows=mysqli_fetch_assoc($res))
                    {
                        $category_id=$rows['id'];
                        $category_title=$rows['title'];
                        ?>
                        <option value="<?php echo $category_id; ?>"><?php echo $category_title;?></option>
                        <?php
                    }
                }
                else
                {
                    // we donot have any value in database
                    ?>
                    <option value="0">No category found</option>
                    <?php
                }
            }
            else
            {
                //create session for database error
                $_SESSION['db-error']='

                <div id="delete" class="alert alert-danger" role="alert">
                Database Error occured
                
              </div>
              ';
            }
        ?>
       
        
      </select>      
      <label for="featured">Featured:</label>
      <input type="radio" name="featured" value="yes" > Yes<br><br>
      <input type="radio" name="featured" value="no" > No<br><br>

      <label for="active">Active:</label>
      <input type="radio" name="active" value="yes" > Yes<br><br>
      <input type="radio" name="active" value="no" > No<br><br>

      <input type="submit" name="submit" value="Add food">
    </form>
  </div>
   
  <?php 
    if(isset($_POST['submit']))
    {
        // echo "clicked";
        // get the values from form
        $title=get_safe_value($con,$_POST['title']);
        $description =get_safe_value($con, $_POST['description']);
        $price=get_safe_value($con,$_POST['price']);
        $category=get_safe_value($con,$_POST['category']);

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
                
                $image_name="food_food_".time().".".$ext; 
                $source_path=$_FILES['image']['tmp_name'];
                $destination_path='../images/food/'.$image_name;
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
                if(!$upload)
                {
                    $_SESSION['upload']=
                    '<div id="add" class="alert alert-danger" role="alert">
                        Failed to upload image.
                        </div>';
                    header("location:".SITEURL."admin/add-food.php");
                    die();
      
                }
          }
         

        }
        else
        {
        //don't upload image and 
        $image_name='';
        }

      $sql="insert into tbl_food set
            title='$title',
            description='$description',
            price='$price',
            image_name='$image_name',
            category_id='$id',
            featured='$featured',
            active='$active'
            ";
      
      $res= mysqli_query($con, $sql);

      if($res)
      {
         $_SESSION['add']='
    
         <div id="add" class="alert alert-success" role="alert">
         food added Successfully
        
         </div>
         ';


         // REDIRECT TO MANAGE ADMIN 
         header("location:".SITEURL."admin/manage-food.php");
       }
      else
      {
        //failed to add food
            $_SESSION['db-error']='

            <div id="delete" class="alert alert-danger" role="alert">
            Database Error occured
            
            </div>
            ';
            header("location:".SITEURL."admin/add-food.php");
       }
    }
  ?>
<?php include("partials/footer.inc.php"); ?>