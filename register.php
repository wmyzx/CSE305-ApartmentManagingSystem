<!DOCTYPE html>
<html lang="en">

<?php
include "config.php";

$errors = array(); 

if (isset($_POST['but_submit'])) {

  $fname = mysqli_real_escape_string($con, $_POST['fname']);
  $lname = mysqli_real_escape_string($con, $_POST['lname']);
  $username = mysqli_real_escape_string($con, $_POST['username']);
  $phonenumber = mysqli_real_escape_string($con, $_POST['phonenumber']);
  $email = mysqli_real_escape_string($con, $_POST['email']);
  $doornumber = mysqli_real_escape_string($con, $_POST['doornumber']);
  $password_1 = mysqli_real_escape_string($con, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($con, $_POST['password_2']);


  if (empty($fname)) { array_push($errors, "First Name is required"); }
  if (empty($lname)) { array_push($errors, "Last Name is required");}
  if (empty($phonenumber)) { array_push($errors, "Phone number is required"); }
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($doornumber)) { array_push($errors, "Door Number is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
   array_push($errors, "The two passwords do not match");
  }


  $user_check_query = "SELECT * FROM users WHERE loginname='$username' OR email='$email' OR doornumber='$doornumber' LIMIT 1";
  $result = mysqli_query($con, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { 
    if ($user['loginname'] == $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] == $email) {
      array_push($errors, "Email already exists");
    }
    if ($user['doornumber'] == $doornumber && $user['status'] == 'active') {
      array_push($errors, "Door number already exists");
    }

  }

 
  if (count($errors) == 0) {
    $password = md5($password_1);

    $query = "INSERT INTO users (firstname, lastname, loginname, pwd, email, phonenumber, doornumber, status) 
              VALUES('$fname', '$lname', '$username', '$password', '$email', '$phonenumber', '$doornumber', 'active')";
    mysqli_query($con, $query);
    $_SESSION['username'] = $username;
    header('location: login.php');
  }
}


?>






    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Daloglu Apartment - Registration </title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Create Account</h3></div>
                                    <div class="card-body">
                                        <form method="post" action="register.php">
                                            <?php include('errors.php'); ?>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">First Name</label>
                                                        <input class="form-control py-4" id="inputFirstName" name="fname" type="text" placeholder="Enter First Name" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputLastName">Last Name</label>
                                                        <input class="form-control py-4" id="inputLastName" name="lname" type="text" placeholder="Enter Last Name" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Email</label>
                                                <input class="form-control py-4" id="inputEmailAddress" name="email" type="email" aria-describedby="emailHelp" placeholder="Enter Email Address" />
                                            </div>

                                            <div class="form-group">
                                                <label class="small mb-1" for="inputUsername">Phone Number</label>
                                                <input class="form-control py-4" id="inputPhoneNumber" name="phonenumber" type="text" placeholder="Enter Phone Number" />
                                            </div>
                                            <?php 
                                            $query = "SELECT doornumber FROM flat ORDER BY doornumber ASC" ?>
                                            <div class="form-group">
                                                <label for="c-form-profession">
                                               <span class="label-text">Door number</span> 
                                              <span class="contact-error"></span>
                                              </label>
                                              <select name="doornumber" class="c-form-profession form-control" id="c-form-profession">
                                          <?php
                                            $result = mysqli_query($con, $query);
                                            while($row = mysqli_fetch_array($result)){   
                                                    unset($id, $name);
                                                    $id = $row['id'];
                                                     $doornumber = $row['doornumber']; 
                                                      echo '<option value="'.$doornumber.'">'.$doornumber.'</option>';
                                            }
                                            ?>
                                 </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputUsername">Username</label>
                                                <input class="form-control py-4" id="inputUsername" name="username" type="text" placeholder="Enter Username" />
                                            </div>
                                            
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputPassword">Password</label>
                                                        <input class="form-control py-4" id="inputPassword" name="password_1" type="password" placeholder="Enter Password" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputConfirmPassword">Confirm Password</label>
                                                        <input class="form-control py-4" id="inputConfirmPassword" name="password_2" type="password" placeholder="Confirm Password" />
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="submit" class="btn btn-primary btn-block" value="Create Account" name="but_submit" id="but_submit" href="login.php"/>
                                    
                                        </form>
                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="small"><a href="login.php">Have an account? Go to login</a></div>
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
