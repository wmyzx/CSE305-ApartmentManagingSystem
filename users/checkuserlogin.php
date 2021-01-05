 <?php 
 session_start();
 if($_SESSION['isadmin'] == 0){
               

 } else { echo "Unauthorized user. Access denied.";
        die; 
        header('location: ../login.php');
    }?>