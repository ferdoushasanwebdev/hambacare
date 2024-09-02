<?php include("./includes/header.php");
include("./classes/class.user.php");

$userObj = new User();
$user = $userObj->fetchUserById($_GET['user_id']);
?>

<div class="container mt-5">
    <div class="user-details">
        <h2 class="mb-4"><?php echo ($user[0]['user_name']) ?> Details</h2>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">User ID</h5>
                <p class="card-text" id="userId"><?php echo ($user[0]['user_id']) ?></p>
            </div>
            <div class="card-body">
                <h5 class="card-title">Phone Number</h5>
                <p class="card-text" id="userPhone"><?php echo ($user[0]['user_phone']) ?></p>
            </div>
            <div class="card-body">
                <h5 class="card-title">Role</h5>
                <p class="card-text" id="userRole"><?php echo ($user[0]['user_role']) ?></p>
            </div>
        </div>
    </div>
</div>

<?php include("./includes/footer.php") ?>