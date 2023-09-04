<?php include('partials/menu.inc.php'); ?>

<?php
    if(isset($_GET['id']))
    {
        $id=$_GET['id'];
        //sql

        $sql="SELECT * FROM tbl_food WHERE id='$id'";
        $res=mysqli_query($con, $sql);
        $count=mysqli_num_rows($res);
        if($count)
        {
            $row=mysqli_fetch_assoc($res);


            $title=$row['title'];
            $price=$row['price'];
            $description=$row['description'];
            $image_name=$row['image_name'];

        }
        else
        {
            header('location:'.SITEURL);
        }

    }
    else
    {
        header('location:'.SITEURL);
    }
    ?>
    <!-- Navbar Section Ends Here -->

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="post" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

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
                        <h3><?php echo $title;?></h3>
                        <p class="food-price"><?php echo 'Rs. '.$price;?></p>
                        <input type="hidden" name="title" value="<?php echo $title; ?>">
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="Enter Your name" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 98xxxxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. someone@example.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City" class="input-responsive" required></textarea>
                    <input type="hidden" name="title" value="<?php echo $title; ?>">
                    <input type="hidden" name="price" value="<?php echo $price; ?>">

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>
            
            <?php
                if(isset($_POST['submit']))
                {
                    $food_title=get_safe_value($con, $_POST['title']);
                    $price=get_safe_value($con, $_POST['price']);
                    $qty=get_safe_value($con, $_POST['qty']);
                    $total=$price * $qty;
                    $order_date=date("Y-m-d h:i:sa");
                    $status="Ordered"; //parameters will be ordered, on-delivery, delivered, cancelled. When the submit button is clicked the status will be ordered but other status are maintained by the admin.

                    $customer_name=get_safe_value($con, $_POST['full-name']);
                    $customer_contact=get_safe_value($con, $_POST['contact']);
                    $customer_email=get_safe_value($con, $_POST['email']);
                    $customer_address=get_safe_value($con, $_POST['address']);

                    //sql
                    $sql2="INSERT INTO tbl_order SET
                            food='$food_title',
                            price='$price',
                            qty='$qty',
                            total='$total',
                            order_date='$order_date',
                            status='$status',
                            customer_name='$customer_name',
                            customer_contact='$customer_contact',
                            customer_email='$customer_email',
                            customer_address='$customer_address'
                    ";
                    
                    $res2=mysqli_query($con, $sql2);
                    
                    if($res2)
                    {
                        $_SESSION['order']='

                        <h3 id="add" style="color: green;">
                            Order placed Successfully.
                        </h3>
                      ';
                      header('location:'.SITEURL);
                    }
                    else
                    {
                        //failed to execute query
                        $_SESSION['order']='<h3 id="add" style="color: red; text-align: center; width: full;">
                                                Placing Order unsuccessfull.
                                            </h3>';
                    header('location:'.SITEURL);

                    }

                }
            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <!-- social Section Starts Here -->
    <?php include('partials/footer.inc.php'); ?>
