 <?php 
 session_start();
 if($_SESSION['isadmin'] == 1){
              

 } else { echo "Unauthorized user. Access denied.";
        die; 
        header('location: ../login.php');
    }?>