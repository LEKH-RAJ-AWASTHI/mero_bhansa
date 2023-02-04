    
    <?php include('partials/menu.inc.php'); ?>
<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL;?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
    
            <?php 
                $sql="SELECT * FROM tbl_food WHERE active='yes'";
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
                            $price=$row['price'];
                            $description=$row['description'];
                            $image_name=$row['image_name'];


                            ?>
                            <div class="food-menu-box">
                                <div class="food-menu-img">
                                    <?php

                                        // if image is availabe only then we are displaying the image
                                        if($image_name=='')
                                        {
                                            echo '<p style="color: red">Sorry, Image not available</p>';
                                        }
                                        else
                                        {
                                            ?>
                                            <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name;?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">
                                            
                                            <?php

                                        }
                                    ?>
                                </div>
                                <div class="food-menu-desc">
                                    <h4><?php echo $title; ?></h4>
                                    <p class="food-price">Rs.<?php echo $price; ?></p>
                                    <p class="food-detail">
                                    <?php echo $description; ?>
                                    </p>
                                    <br>

                                    <a href="<?php echo SITEURL; ?>order.php?id=<?php echo $id;?>&image_name=<?php echo $image_name; ?>" class="btn btn-primary">Order Now</a>
                                </div>
                            </div>
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
    <!-- fOOD Menu Section Ends Here -->

    <!-- social Section Starts Here -->
    <?php include('partials/footer.inc.php'); ?>