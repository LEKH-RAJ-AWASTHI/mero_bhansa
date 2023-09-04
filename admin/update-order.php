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
    <h2>Update order</h2>
    <?php
        // step 1: get the id of selected admin
        if(isset($_GET['id']))
        {
            $id=$_GET['id'];

            // step 2: run query to update
            $sql="SELECT * FROM tbl_order WHERE id='$id'";
            $res= mysqli_query($con, $sql);
            if($res)
            {
                $count= mysqli_num_rows($res);

                if($count==1)
                {
                    // echo "Admin available";
                    $row=mysqli_fetch_assoc($res);

                    $food=$row['food'];
                    $qty=$row['qty'];
                    $price=$row['price'];
                    $total=$qty *$price;
                    $status=$row['status'];
                    $customer_name=$row['customer_name'];
                    $customer_contact=$row['customer_contact'];
                    $customer_email=$row['customer_email'];
                    $customer_address=$row['customer_address'];
                }
                else
                {
                    $_SESSION['order-not-exist']=
                '<div id="add" class="alert alert-danger" role="alert">
                    order Not found.
                    </div>';
                    header('location:'.SITEURL.'admin/manage-order.php');

                }
                }
                else
                {
                    $_SESSION['order-not-exist']=
                    '<div id="add" class="alert alert-danger" role="alert">
                    order Not found.
                    </div>';
                    header('location:'.SITEURL.'admin/manage-order.php');
                }
            }
        else
        {
            header('location:'.SITEURL.'admin/manage-order.php');

        }
    ?>
    <!-- form for updation of orders -->
    <form action="" method="post" enctype="multipart/form-data">
      <h3><?php echo $food;?></h3>
      <label for=""><?php echo 'Price: Rs. '. $price; ?></label>
      <label for="qty">Quantity</label>
      <input type="text" id="qty" name="qty" value="<?php echo $qty;?>" placeholder="Enter order Quantity" ><br><br>
      

      <!-- Select category -->
      <label for="status">Status</label>
      <select name="status">
        <option value="Ordered" <?php if("Ordered"==$status) echo "selected"; ?>>Ordered</option>
        <option value="On-Delivery" <?php if("On-Delivery"==$status) echo "selected"; ?>>On-Delivery</option>
        <option value="Delivered" <?php if("Delivered"==$status) echo "selected"; ?>>Delivered</option>
        <option value="Cancelled" <?php if("Cancelled"==$status) echo "selected"; ?>>Cancelled</option>
      </select><br>
      <label for="customer_name">Customer_name</label>
      <input type="text" name="customer_name" value="<?php echo $customer_name;?>" ><br><br>
      <label for="customer_contact">Customer_contact</label>
      <input type="text" name="customer_contact" value="<?php echo $customer_contact;?>" ><br><br>
      <label for="customer_email">Customer_email</label>
      <input type="text" name="customer_email" value="<?php echo $customer_email;?>" ><br><br>
      <label for="customer_address">Customer_address</label>
      <input type="text" name="customer_address" value="<?php echo $customer_address;?>" ><br><br>



      <input style="margin-top:2%;" type="submit" name="submit" value="Update order">
    </form>
</div>
<?php
  // for checking the validity of the input from user and process the data to insert in the database
  


  //check whether the submit button is clicked or not

  if(isset($_POST['submit']))
  {
    $qty=get_safe_value($con,$_POST['qty']);
    $status=get_safe_value($con,$_POST['status']);
    $total=$qty*$price;
    $customer_name=get_safe_value($con,$_POST['customer_name']);
    $customer_contact=get_safe_value($con,$_POST['customer_contact']);
    $customer_email=get_safe_value($con,$_POST['customer_email']);
    $customer_address=get_safe_value($con,$_POST['customer_address']);


    //sql query to insert value
    $sql2="UPDATE tbl_order SET 
      qty='$qty',
      status='$status',
      total='$total',
      customer_name='$customer_name',
      customer_contact='$customer_contact',
      customer_email='$customer_email',
      customer_address='$customer_address'
      WHERE id='$id'";

    $res2= mysqli_query($con, $sql2) or die(mysqli_error());
  

    if($res2) {
      // data insertion successful
      // echo "<script>showRibbon();</script>";

      //create a session varible to display message
      $_SESSION['update']='

      <div id="add" class="alert alert-info" role="alert">
      Data Updated Successfully
      
    </div>
    ';


      // REDIRECT TO MANAGE order 
      header("location:".SITEURL."admin/manage-order.php");

    }
    

    else{
      $_SESSION['update']="Failed to update";
      header("location:".SITEURL."admin/update-order.php");
    }

}

  ?>

<?php
include('partials/footer.inc.php');
?>