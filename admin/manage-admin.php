<?php
include("partials/menu.inc.php");
?>

<!-- Main content section initiated -->
<div class="main-content">

    <div class="wrapper">
        <h1>Manage Admin</h1>
        <br>
        <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
            }
        ?>
        <br>

        <!-- button for admin -->
        <a href="add-admin.php" class="btn-primary">Add Admin</a>
        <br>
        <br>

        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>
            <tr>
                <td>1.</td>
                <td>Sujan Dahal</td>
                <td>sujan</td>
                <td><a href="#" class="btn-secondary">Update Admin</a>
                    <a href="#" class="btn-danger">Remove Admin</a>
                </td>
            </tr>
            <tr>
                <td>2.</td>
                <td>Sagar Saud</td>
                <td>sagar</td>
                <td>
                    <a href="#" class="btn-secondary">Update Admin</a>
                    <a href="#" class="btn-danger">Remove Admin</a>
                </td>
            </tr>
            <tr>
                <td>3.</td>
                <td>Tekendra Katuwal</td>
                <td>tek</td>
                <td>
                    <a href="#" class="btn-secondary">Update Admin</a>
                    <a href="#" class="btn-danger">Remove Admin</a>
                </td>
            </tr>
        </table>



        <div class="clearfix"></div>
    </div>


</div>
<!-- main content section terminated -->

<?php
 include("partials/footer.inc.php");
 ?>