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
    <h2>Update food</h2>
    <?php
        // step 1: get the id of selected admin
        if(isset($_GET['id']))
        {
            $id=$_GET['id'];
            $image_name=$_GET['image_name'];


            // step 2: run query to update
            $sql="SELECT * FROM tbl_food WHERE id='$id'";
            $res= mysqli_query($con, $sql);
            if($res)
            {
                $count= mysqli_num_rows($res);

                if($count==1)
                {
                    // echo "Admin available";
                    $row=mysqli_fetch_assoc($res);
                    $title=$row['title'];
                    $description=$row['description'];
                    $price=$row['price'];
                    $curr_image=$row['image_name'];
                    $curr_category=$row['category_id'];
                    $featured=$row['featured'];
                    $active=$row['active'];
                }
                else
                {
                    $_SESSION['food-not-exist']=
                '<div id="add" class="alert alert-danger" role="alert">
                    food Not found.
                    </div>';
                    header('location:'.SITEURL.'admin/manage-food.php');

                }
                }
                else
                {
                    $_SESSION['food-not-exist']=
                    '<div id="add" class="alert alert-danger" role="alert">
                    food Not found.
                    </div>';
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
            }
        else
        {
            header('location:'.SITEURL.'admin/manage-food.php');

        }
    ?>
    <!-- form for updation of foods -->
    <form action="" method="post" enctype="multipart/form-data">
      <label for="title">Food Title:</label>
      <input type="text" id="title" name="title" value="<?php echo $title;?>" placeholder="Enter food title" ><br><br>
      
      <label for="desc">Food Description:</label>
      <textarea name="description" rows="5" cols="10" placeholder="Enter Description"><?php echo $description; ?></textarea>      
      
      <label for="price">Food price:</label>
      <input type="number" id="price" name="price" value=<?php echo $price; ?> placeholder="Enter food price" ><br><br>

      <!-- position of current image -->
      <label for="title">Current Image:</label>
        <!-- image will be displayed here -->
        <?php 
        if($image_name==$curr_image)
        {
            if($curr_image!='')
            {
                // display the image
                ?>
                <img src="<?php echo SITEURL;?>images/food/<?php echo $curr_image;?>" width="200px" alt="Image">
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
            $_SESSION['food-not-exist']=
                    '<div id="add" class="alert alert-danger" role="alert">
                    Image changed.
                    </div>';
            header('location:'.SITEURL.'admin/manage-food.php');
        }
        ?>
        <!-- select new image -->
      <label for="title">Select Image:</label>
      <input type="file" id="title" name="image" accept="image/*"><br><br>
  
      <!-- Select category -->
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
                        <option <?php if($curr_category==$category_id) echo "selected" ?> value="<?php echo $category_id; ?>"><?php echo $category_title;?></option>
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
      <input type="radio" name="featured" value="yes" <?php if ($featured=='yes') echo 'checked';?> > Yes<br><br>
      <input type="radio" name="featured" value="no" <?php if ($featured=='no') echo 'checked';?>> No<br><br>

      <label for="active">Active:</label>
      <input type="radio" name="active" value="yes" <?php if ($active=='yes') echo 'checked';?> > Yes<br><br>
      <input type="radio" name="active" value="no" <?php if ($active=='no') echo 'checked';?>> No<br><br>
      <input type="hidden" name="id" value="<?php echo $id?>">

      <input type="submit" name="submit" value="Update food">
    </form>
</div>
<?php
  // for checking the validity of the input from user and process the data to insert in the database
  


  //check whether the submit button is clicked or not

  if(isset($_POST['submit']))
  {
    $id=get_safe_value($con,$_POST['id']);
    $title=get_safe_value($con,$_POST['title']);
    $description=get_safe_value($con,$_POST['description']);
    $price=get_safe_value($con,$_POST['price']);
    $form_image_name=get_safe_value($con,$_POST['image']);
    $category_id=get_safe_value($con,$_POST['category']);
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
            
            $form_image_name="food_food_".time().".".$ext; 
            $source_path=$_FILES['image']['tmp_name'];
            $destination_path='../images/food/'.$form_image_name;
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
              header("location:".SITEURL."admin/manage-food.php");
              die();
            }

            if($curr_image!='')
            {
                $path="../images/food/".$curr_image;

                $remove= unlink($path); //unlink function returns true if the file is removed
    
                if(!$remove)
                {
                    $_SESSION['remove']='
    
                    <div id="delete" class="alert alert-danger" role="alert">
                        Failed to remove food
                    
                  </div>
                  ';
                  header("location:".SITEURL."admin/manage-food.php");
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
    $sql2="UPDATE tbl_food SET 
      title='$title',
      description='$description',
      price='$price',
      image_name='$form_image_name',
      category_id='$category_id',
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


      // REDIRECT TO MANAGE food 
      header("location:".SITEURL."admin/manage-food.php");

    }
    

    else{
      $_SESSION['update']="Failed to update";
      header("location:".SITEURL."admin/update-food.php");
    }

}

  ?>

<?php
include('partials/footer.inc.php');
?>