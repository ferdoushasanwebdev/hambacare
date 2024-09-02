<?php include("./includes/header.php");
include("./classes/class.user.php");

$user = new User();
$userInfo = $user->fetchUserById($_SESSION['user_id']);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $user->updateSettings($_SESSION['user_id'], $_POST['username'], $_POST['phone'], $_POST['newpassword'], $_POST['confirmpassword']);
    $userInfo = $user->fetchUserById($_SESSION['user_id']);
}

?>

<div class="container mt-5">
    <h2 class="mb-4">Settings</h2>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <?php if (isset($_SESSION['message'])) { ?>
                <div class="bg-success" role="alert">
                    <?php echo ($_SESSION['message']); ?>
                </div>
            <?php
            } ?>
            <div class="card mb-3">
                <div class="card-body">
                    <h4 class="card-title mb-4">Update Account Information</h4>
                    <!-- Settings Form -->
                    <form id="settingsForm" method="post">
                        <div class="form-group">
                            <label for="registerName">Name</label>
                            <input type="text" name="username" class="form-control" id="registerName" placeholder="Enter your name" value="<?php echo ($userInfo[0]['user_name']) ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="registerPhone">Phone Number</label>
                            <input type="phone" name="phone" class="form-control" id="registerPhone" placeholder="Enter phone number" value="<?php echo ($userInfo[0]['user_phone']) ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="settingsPassword">New Password</label>
                            <input type="password" name="newpassword" class="form-control" id="settingsPassword" placeholder="New Password">
                        </div>
                        <div class="form-group">
                            <label for="settingsConfirmPassword">Confirm New Password</label>
                            <input type="password" name="confirmpassword" class="form-control" id="settingsConfirmPassword" placeholder="Confirm New Password">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Update Settings</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("./includes/footer.php") ?>