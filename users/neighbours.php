<!DOCTYPE html>
<html lang="en">


 <?php 
include "checkuserlogin.php";
include "../config.php";

	

	$neigquery = "SELECT * FROM users WHERE isactive='1'";
  	$result = mysqli_query($con, $neigquery);
  	
  	
?>


<head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Daloglu Apartment - Resident List Page</title>
        <link href="styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="home.php">Daloglu Apartment</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            
            <!-- Navbar-->
            <ul class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="logoutcustomer.php">Logout</a>
                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Main Page</div>
                            <a class="nav-link" href="home.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Main Page
                            </a>
                            <div class="sb-sidenav-menu-heading">Payment</div>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Payment
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="aidat.php">Dues</a>
                                    <a class="nav-link" href="dueshistory.php">Dues History</a>
                                    <a class="nav-link" href="paymenthistory.php">Payment History</a>
                                </nav>
                            </div>
                            <a class="nav-link" href="expenselist.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Expense List
                            </a>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    
                                </nav>
                            </div>
                            <div class="sb-sidenav-menu-heading">Neighbours</div>
                            <a class="nav-link" href="neighbours.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Neighbour List
                            </a>
                            <a class="nav-link" href="flathistory.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Flat History
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small"><?php echo 'Logged in as: ' . $_SESSION['name'] . '' ; ?></div>
                        Daloglu Apartment
                    </div>
                </nav>
            </div>

            <div id="layoutSidenav_content">
                <main>
                	 
                	 <div class="container-fluid">
                        <h1 class="mt-4">Neighbour List</h1>
                        
                        
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                Neighbour List
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Door Number</th>
                                                <th>Name</th>
                                                <th>Surname</th>
                                                <th>Phone Number</th>
                                                <th>E-mail</th>
                                                <th>Is Admin</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Door Number</th>
                                                <th>Name</th>
                                                <th>Surname</th>
                                                <th>Phone Number</th>
                                                <th>E-mail</th>
                                                <th>Is Admin</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                        	<?php
                                        	while($row = mysqli_fetch_array($result)){ 
                                                if($row['isadmin'] == '1'){
                                                    $ispaid = "Yes";
                                                } else {
                                                    $ispaid = "No";
                                                }
											echo "<tr><td>" . $row['doornumber'] . "</td><td>" . $row['firstname'] . "</td><td>" . $row['lastname'] ."</td><td>" . $row['phonenumber'] . "</td><td>" . $row['email'] . "</td><td>" . $ispaid . "</td></tr>";  //$row['index'] the index here is a field name
											}
											?>
                                            
                                          
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>


                    
                </main>
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
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-demo.js"></script>
    </body>
</html>