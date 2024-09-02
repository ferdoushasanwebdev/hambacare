<?php include("./includes/header.php");
include("./classes/class.user.php");

if (isset($_SESSION['user_id']) && isset($_SESSION['user_name'])  && isset($_SESSION['user_role'])) {
    header("Location: dashboard.php");
    exit;
}

$user = new User();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // print_r($_POST["username"]);
    // print_r($_POST["email"]);
    // print_r($_POST["password"]);
    if (isset($_POST['loginForm']) == "login") {
        $user->login($_POST["id"], $_POST["password"]);
    } else if ($_POST['registerForm'] == "register") {
        $user->register($_POST["username"], $_POST["phone"], $_POST["password"], $_POST["role"]);
    }
}
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title text-center mb-4">Login</h3>
                    <form id="loginForm" method="post">
                        <input type="hidden" name="loginForm" value="login" />
                        <div class="form-group">
                            <label for="loginId">User ID</label>
                            <input type="phone" name="id" class="form-control" id="loginId" placeholder="Enter your Id" required>
                        </div>
                        <div class="form-group">
                            <label for="loginPassword">Password</label>
                            <input type="password" name="password" class="form-control" id="loginPassword" placeholder="Password" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                        <p class="text-center mt-3 mb-0"><a href="#" id="createAccountLink">Create new account</a></p>
                    </form>

                    <form id="registerForm" method="post" style="display: none;">
                        <input type="hidden" name="registerForm" value="register" />
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
                                <option value="familymember">Family Member
                                <option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Register</button>
                        <p class="text-center mt-3 mb-0"><a href="#" id="backToLoginLink">Back to login</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("./includes/footer.php") ?>