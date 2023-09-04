<?php 
include("partials/menu.inc.php");
?>

        <!-- Main content section initiated -->
        <div class="main-content">

            <div class="wrapper">
                <h1>DASHBOARD</h1>

                <div class="col-4 text-center">
                    <h1>
                        <?php 
                        $sql= "SELECT id FROM tbl_category";
                        $res=mysqli_query($con, $sql);
                        // pr($res);
                        $count=mysqli_num_rows($res);
                        echo $count;
                        ?>
                    </h1>
                    <br>
                    Categories
                </div>
                <div class="col-4 text-center">
                    <h1>
                        <?php 
                            $sql= "SELECT id FROM tbl_food";
                            $res=mysqli_query($con, $sql);
                            // pr($res);
                            $count=mysqli_num_rows($res);
                            echo $count;
                        ?>
                    </h1>
                    <br>
                    Foods
                </div>
                <div class="col-4 text-center">
                    <h1>
                        <?php 
                            $sql= "SELECT id FROM tbl_order";
                            $res=mysqli_query($con, $sql);
                            // pr($res);
                            $count=mysqli_num_rows($res);
                            echo $count;
                        ?>
                    </h1>
                    <br>
                    Orders
                </div>
                <div class="col-4 text-center">
                    <h1>
                        <?php 
                            $sql= "SELECT sum(total) AS Total FROM tbl_order WHERE status='Delivered'";
                            $res=mysqli_query($con, $sql);
                            // pr($res);
                            $row=mysqli_fetch_assoc($res);
                            $revenue= $row['Total'];
                            echo "Rs. $revenue";
                            // $count=mysqli_num_rows($res);
                            // echo $count;
                        ?>
                    </h1>
                    <br>
                    Revenue
                </div>

                <div class="clearfix"></div>
            </div>


        </div>
        <!-- main content section terminated -->
<?php 
include("partials/footer.inc.php");
?>
    