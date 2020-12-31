 <?php 
 session_start();
 if($_SESSION['isadmin'] != 0){
        echo "Unauthorized user. Access denied.";
        die; 
 } ?>