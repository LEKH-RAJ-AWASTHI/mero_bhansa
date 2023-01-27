<?php
include("partials/menu.inc.php");
?>
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Order</h1>
        <br>
        <br>

        <!-- button for admin -->
        <a href="#" class="btn-primary">Add Order</a>
        <br>
        <br>
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
                <td><a href="#" class="btn-secondary">Update Order</a>
                    <a href="#" class="btn-danger">Remove Order</a>
                </td>
            </tr>
            <tr>
                <td>2.</td>
                <td>Sagar Saud</td>
                <td>sagar</td>
                <td>
                    <a href="#" class="btn-secondary">Update Order</a>
                    <a href="#" class="btn-danger">Remove Order</a>
                </td>
            </tr>
            <tr>
                <td>3.</td>
                <td>Tekendra Katuwal</td>
                <td>tek</td>
                <td>
                    <a href="#" class="btn-secondary">Update Order</a>
                    <a href="#" class="btn-danger">Remove Order</a>
                </td>
            </tr>
        </table>
    </div>
</div>
<?php
include("partials/footer.inc.php");
?>
