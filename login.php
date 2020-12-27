<!DOCTYPE html>
<html lang="en">


<?php
session_start();
include "config.php";

if(isset($_POST['but_submit'])){

    $uname = mysqli_real_escape_string($con,$_POST['txt_uname']);
    $password = mysqli_real_escape_string($con,$_POST['txt_pwd']);

    if (empty($uname)) {
             echo '<script language="javascript">';
             echo 'alert("Username is required")';
             echo '</script>';
  }
  if (empty($password)) {
             echo '<script language="javascript">';
             echo 'alert("Password is required")';
             echo '</script>';
  }

    if ($uname != "" && $password != ""){

        $sql_query = "select count(*) as cntUser from users where loginname='".$uname."' and pwd='".$password."'";
        $result = mysqli_query($con,$sql_query);
        $row = mysqli_fetch_array($result);

        $sql_query1 = "select * from users where loginname='".$uname."' and pwd='".$password."'";
        $result1 = mysqli_query($con,$sql_query1);
        $row1 = mysqli_fetch_array($result1);


        $count = $row['cntUser'];
        $admin = $row1['level'];

        
        if($count > 0){
            
            if ($admin == "admin")
                {
                $_SESSION['uname'] = $user;
                header("location: home.php");
                exit();
                }   
            else {
                $_SESSION['uname'] = $user;
                header("location: users.php");
                exit();
            }
        }else{
             echo '<script language="javascript">';
             echo 'alert("Invalid username or password")';
             echo '</script>';
        }

    }

}
?>





    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Daloglu Apartment - Login Page</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                                    <div class="card-body">
                                        <form method="post" action="">
                                            <div id="div_login" class="form-group">
                                                <label class="small mb-1" for="txt_uname">Username</label>
                                                <input class="form-control py-4" name="txt_uname" id="txt_uname" type="text" placeholder="Enter username" />
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputPassword">Password</label>
                                                <input class="form-control py-4" name="txt_pwd" id="txt_uname" type="password" placeholder="Enter password" />
                                            </div>
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" name="rememberme" id="rememberMe" type="checkbox" />
                                                    <label class="custom-control-label" for="rememberMe">Remember me</label>
                                                </div>
                                            </div>
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small" href="password.php">Forgot Password?</a>
                                                <input type="submit" class="btn btn-primary" value="Submit" name="but_submit" id="but_submit" />
                                                
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="small"><a href="register.php">Need an account? Sign up!</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Daloglu 2020</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
