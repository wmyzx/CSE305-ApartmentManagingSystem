<!DOCTYPE html>
<html lang="en">

 <?php 
include "checkadminlogin.php";
include "../config.php";

        $duesquery = "SELECT SUM(price) FROM transaction WHERE MONTH(paydate) = MONTH(CURRENT_DATE()) AND YEAR(paydate) = YEAR(CURRENT_DATE())";
         $result = mysqli_query($con, $duesquery);
         $row = mysqli_fetch_array($result);

         $duesquery22 = "SELECT SUM(amount) FROM dues WHERE MONTH(ddate) = MONTH(CURRENT_DATE()) AND YEAR(ddate) = YEAR(CURRENT_DATE()) AND isactivedue = '0'";
         $result22 = mysqli_query($con, $duesquery22);
         $row22 = mysqli_fetch_array($result22);
         
         $monthquery = "SELECT SUM(amount) FROM dues WHERE MONTH(ddate) = MONTH(CURRENT_DATE()) AND YEAR(ddate) = YEAR(CURRENT_DATE()) ";
         $result1 = mysqli_query($con, $monthquery);
         $row1 = mysqli_fetch_array($result1);
         
    

         $subs = $row1[0] - $row22[0];
         
         $userid = $_SESSION['id'];
         $doornumber = $_SESSION['doornumber'];
         
         $monthquery2 = "SELECT amount FROM dues WHERE flatid='$doornumber' AND MONTH(ddate) = MONTH(CURRENT_DATE()) AND YEAR(ddate) = YEAR(CURRENT_DATE())";
         $result3 = mysqli_query($con, $monthquery2);
         $row3 = mysqli_fetch_array($result3);
         
         $duesquery3 = "SELECT SUM(price) FROM expense WHERE MONTH(date) = MONTH(CURRENT_DATE()) AND YEAR(date) = YEAR(CURRENT_DATE())";
         $result4 = mysqli_query($con, $duesquery3);
         $row4 = mysqli_fetch_array($result4);
  ?>





<head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Daloglu Apartment - Admin Main Page</title>
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
                        <a class="dropdown-item" href="logoutadmin.php">Logout</a>
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
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDues1" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Payment
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseDues1" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="aidat.php">Dues</a>
                                    <a class="nav-link" href="dueshistoryadmin.php">Dues History</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDues" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Payment(Apartment)
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseDues" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="adddues.php">Add Monthly Dues</a>
                                    <a class="nav-link" href="detduesdoornumber.php">Determine Dues(Door Number)</a>
                                    <a class="nav-link" href="detdues.php">Determine Dues(Block)</a>
                                    <a class="nav-link" href="dueshistory.php">Dues History</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseExpenses" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Expense
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseExpenses" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="expenses.php">Expense</a>
                                    <a class="nav-link" href="expenselist.php">Expense List</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    
                                </nav>
                            </div>
                            <div class="sb-sidenav-menu-heading">Resident</div>
                            <a class="nav-link" href="neighbours.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Residents List(Active)
                            </a>
                            <a class="nav-link" href="addnewresident.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Add New Resident
                            </a>
                            <a class="nav-link" href="moveout.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Move Out Resident
                            </a>
                            <a class="nav-link" href="neighboursall.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Residents List(All)
                            </a>
                            <a class="nav-link" href="uncollected.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Uncollected Dues List
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
                    <div class="row">
                      <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Dues (Monthly)</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $row3[0] . " TL "; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Pending Debt</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $subs . " TL "; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Total Income</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $row[0] . " TL "; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                Total Expanse</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $row4[0] . " TL "; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    <div class="container-fluid">
                        <h1 class="mt-4">Announcement</h1>
                        <div class="card mb-4">
                            <div class="card-body">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
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
    </body>
</html>