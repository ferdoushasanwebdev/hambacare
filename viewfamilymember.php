<?php
include("./includes/header.php");
include("./classes/class.patient.php");

$obj = new Patient();

if (isset($_GET['remove']) && $_GET['remove'] == 1) {
    $patient_id = $_GET['patient_id'];
    $member_id = $_GET['member_id'];

    $obj->removeFamilyMember($patient_id, $member_id);

    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

$familymember = $obj->fetchFamilyMember($_SESSION['user_id']);
?>

<div class="container mt-5">
    <div class="user-list">
        <h2 class="mb-4">Family Member List</h2>

        <?php if (isset($_SESSION['message'])) { ?>
            <div class="alert alert-info">
                <?php echo $_SESSION['message'];
                unset($_SESSION['message']); ?>
            </div>
        <?php } ?>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>User Name</th>
                    <th>View Details</th>
                    <th>Remove</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($familymember as $user) { ?>
                    <tr>
                        <td><?php echo ($user['user_id']); ?></td>
                        <td><?php echo ($user['user_name']); ?></td>
                        <td><a href="./staffdetails.php?user_id=<?php echo ($user['user_id']) ?>" class="btn btn-primary">View</a></td>
                        <td><a href="?remove=1&patient_id=<?php echo ($_SESSION['user_id']); ?>&member_id=<?php echo ($user['user_id']); ?>" class="btn btn-danger">Remove</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<?php include("./includes/footer.php") ?>