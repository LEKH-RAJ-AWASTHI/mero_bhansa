<?php
include("partials/menu.inc.php");
?>
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Category</h1>
        <br>
        <br>
        <?php
    if(isset($_SESSION['add'])){
      echo $_SESSION['add'];
      unset($_SESSION['add']);
    }
    if(isset($_SESSION['delete'])){
      echo $_SESSION['delete'];
      unset($_SESSION['delete']);
    }
    if(isset($_SESSION['remove'])){
      echo $_SESSION['remove'];
      unset($_SESSION['remove']);
    }
    if(isset($_SESSION['category-not-exist'])){
      echo $_SESSION['category-not-exist'];
      unset($_SESSION['category-not-exist']);
    }
    if(isset($_SESSION['update'])){
      echo $_SESSION['update'];
      unset($_SESSION['update']);
    }
    if(isset($_SESSION['upload'])){
      echo $_SESSION['upload'];
      unset($_SESSION['upload']);
    }
    ?>

        <!-- button for admin -->
        <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Add Category</a>
        <br>
        <br>
        <br>
        <br>

        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Title</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>
            <?php
                $sql="SELECT * FROM tbl_category";
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
                            $title=$rows['title'];
                            $image_name= $rows['image_name'];
                            $featured=$rows['featured'];
                            $active=$rows['active'];
                            
                            // displaying the value in table
                            ?>
                            <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $title; ?></td>

                            <td>
                                <?php 
                                    if($image_name!=''){
                                        // display image
                                        ?>
                                        <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name?>" width="70px" alt="Image">
                                        <?php
                                    }
                                    else
                                    {
                                        // Display the message
                                        echo '<p style="color:red;"">No image found</p>';

                                    }
                                ?>
                            </td>

                            <td><?php echo $featured; ?></td>
                            <td><?php echo $active; ?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id ?>&image_name=<?php echo $image_name?>" class="btn btn-secondary">Update category</a>
                                <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id ?>&image_name=<?php echo $image_name?>" class="btn btn-danger">Remove category</a>

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
    </div>
</div>
<?php
include("partials/footer.inc.php");
?>
