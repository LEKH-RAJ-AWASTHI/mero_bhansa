<?php
include("partials/menu.inc.php");
?>
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Order</h1>
        <br>
        <br>
        <?php
            if(isset($_SESSION['update'])){
            echo $_SESSION['update'];
            unset($_SESSION['update']);
            }
            if(isset($_SESSION['sql-error'])){
                echo $_SESSION['sql-error']; //Displaying session message
                unset($_SESSION['sql-error']); //removing session message
            }
            if(isset($_SESSION['order-not-exist'])){
                echo $_SESSION['order-not-exist'];
                unset($_SESSION['order-not-exist']);
            }
        ?>
        <!-- button for order -->
        <br>
        <br>

        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Food</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Total</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Customer Name</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Address</th>
                <th>Action</th>
            </tr>


            <?php
                $sql="SELECT * FROM tbl_order ORDER BY id DESC";
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
                            $food=$rows['food'];
                            $price=$rows['price'];
                            $qty=$rows['qty'];
                            $total=$rows['total'];
                            $order_date=$rows['order_date'];
                            $status=$rows['status'];
                            $customer_name=$rows['customer_name'];
                            $customer_contact=$rows['customer_contact'];
                            $customer_email=$rows['customer_email'];
                            $customer_address=$rows['customer_address'];
                            
                            // displaying the value in table
                            ?>
                            <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $food; ?></td>
                            <td><?php echo $price; ?></td>
                            <td><?php echo $qty; ?></td>
                            <td><?php echo $total; ?></td>
                            <td><?php echo $order_date; ?></td>
                            <td>
                                <?php
                                    if($status=="Ordered")
                                        echo "<label>$status<label>";
                                    elseif($status=="On-Delivery")
                                        echo '<label style="color: orange;">'.$status.'<label>';
                                    elseif($status=="Delivered")
                                        echo '<label style="color: green;">'.$status.'<label>';
                                    else
                                        echo '<label style="color: red;">'.$status.'<label>';


                                ?>
                            </td>
                            <td><?php echo $customer_name; ?></td>
                            <td><?php echo $customer_contact; ?></td>
                            <td><?php echo $customer_email; ?></td>
                            <td><?php echo $customer_address; ?></td>

                            <td>
                                <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id ?>" class="btn btn-secondary">Update order</a>

                            </td>
                        </tr>
                        <?php 
                        }
                    }
                    else
                    {
                        // echo "We donot have data in database";
                        echo '<tr style="color:red;"><td colspan="12">orders not available</td></tr>';
                    }
                }
            ?>
        </table>
           
    </div>
</div>
<?php
include("partials/footer.inc.php");
?>
