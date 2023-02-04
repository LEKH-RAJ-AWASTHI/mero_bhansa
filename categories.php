<?php include('partials/menu.inc.php'); ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php 
                $sql="SELECT * FROM tbl_category WHERE active='yes' LIMIT 6";
                $res= mysqli_query($con,$sql);
                if($res)
                {
                    $count=mysqli_num_rows($res);
                    if($count)
                    {
                        while($row=mysqli_fetch_assoc($res))
                        {
                            $id=$row['id'];
                            $title=$row['title'];
                            $image_name=$row['image_name'];

                            ?>
                            <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id;?>">
                                <div class="box-3 float-container">
                                    <?php

                                    // if image is availabe only then we are displaying the image
                                        if($image_name=='')
                                        {
                                            echo '<p style="color: red">Sorry, Image not available</p>';
                                        }
                                        else
                                        {
                                            ?>


                                            <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name;?>" alt="Pizza" class="img-responsive img-curve">
                                            
                                            
                                            <?php

                                        }
                                    ?>

                                    <h3 class="float-text text-blue"><?php echo $title; ?></h3>
                                </div>
                            </a>
                            <?php
                        }
                    }
                    else
                    {
                        echo '<p style="color: red">Sorry, Category not available</p>';
                    }

                }
                else
                {
                    $_SESSION['db-error']='

                    <div id="delete" class="alert alert-danger" role="alert">
                        
                        Sorry! Database Error
                    
                    </div>
                  ';
                }
            ?>


            

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


    <!-- social Section Starts Here -->
 <?php include('partials/footer.inc.php'); ?>