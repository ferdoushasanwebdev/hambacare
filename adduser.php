<?php include("./includes/header.php");
include("./classes/class.user.php");

$user = new User();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // print_r($_POST["username"]);
    // print_r($_POST["email"]);
    // print_r($_POST["password"]);
    $user->createUser($_POST["username"], $_POST["phone"], $_POST["password"], $_POST["role"]);
}

?>
<div class="container mt-5">
    <div class="blog-form mb-3">
        <h2 class="mb-4">Add <?php echo ($_SESSION['user_role'] == "admin") ? "User" : "Patient" ?></h2>
        <form id="registerForm" method="post">
            <div class="form-group">
                <label for="registerName">Name</label>
                <input type="text" name="username" class="form-control" id="registerName" placeholder="Enter your name" required>
            </div>
            <div class="form-group">
                <label for="registerPhone">Phone Number</label>
                <input type="phone" name="phone" class="form-control" id="registerPhone" placeholder="Enter phone number" required>
            </div>
            <div class="form-group">
                <label for="registerPassword">Password</label>
                <input type="password" name="password" class="form-control" id="registerPassword" placeholder="Password" required>
            </div>
            <div class="form-group">
                <label for="registerRole">Select Your Role</label>
                <select name="role" class="form-control" id="registerRole" required>
                    <?php if ($_SESSION['user_role'] == "admin") {
                    ?>
                        <option value="patient">Patient
                        <option>
                        <option value="familymember">Family Member
                        <option>
                        <option value="staff">Test Centre Staff
                        <option>
                        <option value="admin">Admin
                        <option>
                        <?php
                    } ?>

                        <?php if ($_SESSION['user_role'] == "staff") {
                        ?>
                        <option value="patient">Patient
                        <option>
                        <?php
                        } ?>

                </select>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Register</button>
        </form>
    </div>
</div>

<?php include("./includes/footer.php") ?>