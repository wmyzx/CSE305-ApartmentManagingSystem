<!DOCTYPE html>
<html lang="en">

 <?php 
 session_start();
 if($_SESSION['isadmin'] != 0){
        echo "Unauthorized user. Access denied.";
        die; // stop further execution
 } ?>



<body>

<?php
	
	echo 'Logged in as: ' . $_SESSION['name'] . '!';
?>

</body>
</html>


