<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Order</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="vendors/base/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <link rel="stylesheet" href="vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/favicon.png" />
</head>

<body>
<!-- Top Nav -->
<div class="container-scroller">
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="navbar-brand-wrapper d-flex justify-content-center">
            <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">  
            <a class="navbar-brand brand-logo" href="index.php">ParcelMe Admin</a>
            <a class="navbar-brand brand-logo-mini" href="#">ParcelMe</a>
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-sort-variant"></span>
            </button>
            </div> 
        </div>

        <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <ul class="navbar-nav mr-lg-4 w-100">
          <li class="nav-item nav-search d-none d-lg-block w-100">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text" id="search">
                  <i class="mdi mdi-magnify"></i>
                </span>
              </div>
              <input type="text" class="form-control" placeholder="Search now" aria-label="search" aria-describedby="search">
            </div>
          </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
        <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <img src="images/faces/face5.jpg" alt="profile"/>
              <span class="nav-profile-name">Safal Kafle</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item">
                <i class="mdi mdi-settings text-primary"></i>
                Settings
              </a>
              <a href="../controller/logout.php" class="dropdown-item">
                <i class="mdi mdi-logout text-primary"></i>
                Logout
              </a>
            </div>

        </ul>
        </div>
    
    </nav>
</div>
<!-- partial -->
<!-- Side nav -->
<div class="container-fluid page-body-wrapper">
 <!-- partial:partials/_sidebar.html -->
  <nav class="sidebar sidebar-offcanvas" id="sidebar">
      <ul class="nav">
          <li class="nav-item">
              <a class="nav-link" href="index.php">
              <i class="mdi mdi-home menu-icon"></i>
              <span class="menu-title">Dashboard</span>
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="addParcel.php">
              <i class="mdi mdi-account menu-icon"></i>
              <span class="menu-title">Add Parcel</span>
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="order.php">
              <i class="mdi mdi-account menu-icon"></i>
              <span class="menu-title">Orders</span>
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="user.php">
              <i class="mdi mdi-view-headline menu-icon"></i>
              <span class="menu-title">Users</span>
              </a>
          </li>
      </ul>
     </nav>

      <!-- Starting of content area of dashboard -->
      <div class="main-panel">
        <div class="content-wrapper">
         
        <div class="container">
            <div class="card">
                <div class="card-header bg-white">
                    <strong>Orders</strong> 
                </div>
            </div>
        </div>
        
        <div class="container ">
        <div class="row">
            <div class="card">
          <div class="card-body">
          <table class="table table-bordered" style="overflow-x: auto;">
          <thead>
            <tr>
              <th scope="col">Order ID</th>
              <th scope="col">User Name</th>
              <th scope="col">User Email</th>
              <th scope="col">User Address</th>
              <th scope="col">Phone</th>
              <th scope="col">Receiver Name</th>
              <th scope="col">Receiver Email</th>
              <th scope="col">Receiver Address</th>
              <th scope="col">Receiver Phone</th>
              <th scope="col"></th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
          <?php
            $str_data = file_get_contents("http://localhost:8888/parcelme/api/getAllOrders");
            $data = json_decode($str_data, true);
            foreach($data as $order){
          ?>
            <tr style="background-color: <?php echo $order['status_id']==1?'#ceebbc':($order['status_id']==2?'#f5d5d0':'#f5ec9a') ?>">
              <td><?php print_r($order['order_id']);?></td>
              <td><?php echo($order['users_name']);?></td>
              <td><?php echo($order['users_email']);?></td>
              <td><?php echo($order['users_address']);?></td>
              <td><?php echo($order['users_phone']);?></td>
              <td><?php echo($order['receiver_name']);?></td>
              <td><?php echo($order['delivery_email']);?></td>
              <td><?php echo($order['delivery_address']);?> </td>
              <td><?php echo($order['delivery_phone']);?></td>
              <td>
              <form action="../controller/changeStatus.php" method="POST"> 
                <input type="hidden" name="order_id" value="<?php echo($order['order_id']);?>">
                <input type="hidden" name="status_id" value="1">
                <button type="submit" class="btn btn-success mb-2">Approve</button>
              </form>
              <form action="../controller/changeStatus.php" method="POST"> 
                <input type="hidden" name="order_id" value="<?php echo($order['order_id']);?>">
                <input type="hidden" name="status_id" value="2">
                <button type="submit" class="btn btn-danger mb-2">Decline</button>
              </form>
              </td>
            </tr>
          <?php } ?>
          </tbody>
        </table>
                </div>
            </div>
        </div>
        </div>
      

  </div>
  <!-- plugins:js -->
  <script src="vendors/base/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <script src="vendors/chart.js/Chart.min.js"></script>
  <script src="vendors/datatables.net/jquery.dataTables.js"></script>
  <script src="vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="js/dashboard.js"></script>
  <script src="js/data-table.js"></script>
  <script src="js/jquery.dataTables.js"></script>
  <script src="js/dataTables.bootstrap4.js"></script>
  <!-- End custom js for this page-->
</body>
