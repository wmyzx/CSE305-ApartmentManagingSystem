 <?php 
 session_start();
 if($_SESSION['isadmin'] != 1){
        echo "Unauthorized user. Access denied.";
        die; 
 } ?>