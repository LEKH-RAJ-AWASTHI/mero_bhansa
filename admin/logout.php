<?php
require('../config/constants.inc.php'); 


//destroy sessions and redirect to login page
session_destroy(); //destroy $_SESSION['user'];
header('location:'.SITEURL.'admin/login.php');
?>
