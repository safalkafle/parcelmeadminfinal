
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Add Parcel</title>
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
                <div class="card-header">
                    <strong>Add Parcel</strong> 
                </div>
                <div class="card-body">
                    <form action="../controller/addParcel.php" method="POST" id='addParcel'>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                            <label for="fname">Parcel Type</label>
                            <input type="text" class="form-control" id="ptype" name="ptype" placeholder="Parcel Type" required>
                            </div>
                            <div class="form-group col-md-6">
                            <label for="lname">Parcel Cost</label>
                            <input type="text" class="form-control" id="pcost" name="pcost" placeholder="Parcel Cost" required>
                            </div>
                        </div>
                        <button type="submit" id="submitBtn" class="btn btn-primary w-10">Add Parcel</button>
                    </form>
                </div>
            </div>

            <table class="table table-borderless">
    
    <?php 
      $str_data = file_get_contents("http://localhost:8888/parcelme/api/ptype/all");
      $data = json_decode($str_data, true);
      echo '
      <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Parcel Type</th>
        <th scope="col">Cost(in NRP)</th>
        
      </tr>
    </thead>
      ';
      foreach($data as $ptype){
        echo '
        <tbody>
      <tr>
        <td>'.$ptype['parcel_catagory_id'].'</td>
        <td>'.$ptype['parcel_type'].'</td>
        <td>'.$ptype['parcel_cost'].'</td>
        <td> <button class = "btn btn-danger" data-toggle="modal" data-target="#exampleModalLong'.$ptype['parcel_catagory_id'].'">Delete</button></td>
      </tr>
      <div class="modal fade" id="exampleModalLong'.$ptype['parcel_catagory_id'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete id '.$ptype['parcel_catagory_id'].'?
      </div>
      <div class="modal-footer">
        <form action="../controller/pardelete.php" method="POST"> 
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="hidden" name="deleteID" value="'.$ptype['parcel_catagory_id'].'">
        <button type="submit" class="btn btn-primary">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>
    </tbody>
        ';
      }

      echo '</table>';
    ?>
      
    


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
