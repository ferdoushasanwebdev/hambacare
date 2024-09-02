<?php
include("./includes/header.php");

if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_name']) || !isset($_SESSION['user_phone']) || !isset($_SESSION['user_role'])) {
  header("Location: index.php");
  exit;
}

//print_r($_SESSION);

// Retrieve session data
// $user_id = $_SESSION['user_id'];
// $username = $_SESSION['username'];
// $email = $_SESSION['email'];
?>

<div class="container mt-5">
  <h2 class="mb-4">Dashboard</h2>
  <h5>Hello! <?php echo ($_SESSION['user_name']) ?></h5>
  <ul class="list-unstyled">
    <li class="list-item"><span class="font-weight-bold">Your ID:</span> <?php echo ($_SESSION['user_id']) ?></li>
    <li class="list-item"><span class="font-weight-bold">Your Phone:</span> <?php echo ($_SESSION['user_phone']) ?></li>
    <li class="list-item"><span class="font-weight-bold">Your Role:</span> <span class="text-capitalize"><?php echo ($_SESSION['user_role']) ?></span></li>
  </ul>
  <div style="opacity: 1;" class="alert alert-danger" role="alert"><a class="nav-link font-weight-bold text-danger" href="alert.php">Please check the notifications...</a></div>
  <div class="row">
    <?php if ($_SESSION['user_role'] == "admin") {
    ?>
      <div class="col-md-4 dashboard-option">
        <div class="card text-center">
          <div class="card-body">
            <h5 class="card-title">Add <?php echo ($_SESSION['user_role'] == "admin") ? "User" : "Patient" ?></h5>
            <a href="./adduser.php" class="btn btn-primary">Add <?php echo ($_SESSION['user_role'] == "admin") ? "User" : "Patient" ?></a>
          </div>
        </div>
      </div>
      <div class="col-md-4 dashboard-option">
        <div class="card text-center">
          <div class="card-body">
            <h5 class="card-title">View Staff</h5>
            <a href="./viewstaff.php" class="btn btn-primary">View Staff</a>
          </div>
        </div>
      </div>
      <div class="col-md-4 dashboard-option">
        <div class="card text-center">
          <div class="card-body">
            <h5 class="card-title">View Patient</h5>
            <a href="./viewpatient.php" class="btn btn-primary">View Patient</a>
          </div>
        </div>
      </div>
      <div class="col-md-4 dashboard-option">
        <div class="card text-center">
          <div class="card-body">
            <h5 class="card-title">Settings</h5>
            <a href="./settings.php" class="btn btn-primary">Settings</a>
          </div>
        </div>
      </div>
    <?php } ?>
    <?php if ($_SESSION['user_role'] == "staff") {
    ?>
      <div class="col-md-4 dashboard-option">
        <div class="card text-center">
          <div class="card-body">
            <h5 class="card-title">Add <?php echo ($_SESSION['user_role'] == "admin") ? "User" : "Patient" ?></h5>
            <a href="./adduser.php" class="btn btn-primary">Add <?php echo ($_SESSION['user_role'] == "admin") ? "User" : "Patient" ?></a>
          </div>
        </div>
      </div>
      <div class="col-md-4 dashboard-option">
        <div class="card text-center">
          <div class="card-body">
            <h5 class="card-title">View Patient</h5>
            <a href="./viewpatient.php" class="btn btn-primary">View Patient</a>
          </div>
        </div>
      </div>
      <div class="col-md-4 dashboard-option">
        <div class="card text-center">
          <div class="card-body">
            <h5 class="card-title">Create Report</h5>
            <a href="./addreport.php" class="btn btn-primary">Create Report</a>
          </div>
        </div>
      </div>
      <div class="col-md-4 dashboard-option">
        <div class="card text-center">
          <div class="card-body">
            <h5 class="card-title">Settings</h5>
            <a href="./settings.php" class="btn btn-primary">Settings</a>
          </div>
        </div>
      </div>
    <?php } ?>
    <?php if ($_SESSION['user_role'] == "patient") {
    ?>
      <div class="col-md-4 dashboard-option">
        <div class="card text-center">
          <div class="card-body">
            <h5 class="card-title">Add Family Member Into The List</h5>
            <a href="./addpatientfamily.php" class="btn btn-primary">Add Family Member</a>
          </div>
        </div>
      </div>
      <div class="col-md-4 dashboard-option">
        <div class="card text-center">
          <div class="card-body">
            <h5 class="card-title">View Family Members</h5>
            <a href="./viewfamilymember.php" class="btn btn-primary">View Family Members</a>
          </div>
        </div>
      </div>
      <div class="col-md-4 dashboard-option">
        <div class="card text-center">
          <div class="card-body">
            <h5 class="card-title">View Report</h5>
            <a href="./patientdetails.php?user_id=<?php echo ($_SESSION["user_id"]) ?>" class="btn btn-primary">View Patient</a>
          </div>
        </div>
      </div>
      <div class="col-md-4 dashboard-option">
        <div class="card text-center">
          <div class="card-body">
            <h5 class="card-title">Settings</h5>
            <a href="./settings.php" class="btn btn-primary">Settings</a>
          </div>
        </div>
      </div>
    <?php } ?>
    <?php if ($_SESSION['user_role'] == "familymember") {
    ?>
      <div class="col-md-4 dashboard-option">
        <div class="card text-center">
          <div class="card-body">
            <h5 class="card-title">Add Patient Into The List</h5>
            <a href="./addpatientfamily.php" class="btn btn-primary">Add Patient</a>
          </div>
        </div>
      </div>
      <div class="col-md-4 dashboard-option">
        <div class="card text-center">
          <div class="card-body">
            <h5 class="card-title">View Patient</h5>
            <a href="./viewpatient.php" class="btn btn-primary">View Patient</a>
          </div>
        </div>
      </div>
      <div class="col-md-4 dashboard-option">
        <div class="card text-center">
          <div class="card-body">
            <h5 class="card-title">Settings</h5>
            <a href="./settings.php" class="btn btn-primary">Settings</a>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>
</div>
<?php include("./includes/footer.php") ?>