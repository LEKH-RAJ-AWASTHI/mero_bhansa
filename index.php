
    <?php include('partials/menu.inc.php'); ?>

    <!-- Navbar Section Ends Here -->
    <?php
    if(isset($_SESSION['order']))
    {
        echo $_SESSION['order'];
        unset($_SESSION['order']);
    }
    ?>
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

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php 
                $sql="SELECT * FROM tbl_category where featured='yes' AND active='yes' LIMIT 3";
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

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php 
                $sql="SELECT * FROM tbl_food WHERE featured='yes' AND active='yes' LIMIT 6";
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

        <p class="text-center">
            <a href="<?php echo SITEURL; ?>foods.php">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

    <!-- social Section Starts Here -->
    <?php include('partials/footer.inc.php'); ?>
