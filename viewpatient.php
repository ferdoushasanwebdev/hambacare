<?php include("./includes/header.php");

if ($_SESSION['user_role'] != "familymember") {
    include("./classes/class.user.php");
    $userobj = new User();
    $users = $userobj->fetchUser("patient");
}

if ($_SESSION['user_role'] == "familymember") {
    include("./classes/class.familymember.php");
    $obj = new FamilyMember();

    if (isset($_GET['remove']) && $_GET['remove'] == 1) {
        $patient_id = $_GET['patient_id'];
        $member_id = $_GET['member_id'];

        $obj->removePatient($patient_id, $member_id);
    }

    $users = $obj->fetchPatient($_SESSION['user_id']);
}

?>

<div class="container mt-5">
    <div class="user-list">
        <h2 class="mb-4">Patient List</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>User Name</th>
                    <th>View Details</th>
                    <?php echo (($_SESSION['user_role'] == "admin" || $_SESSION['user_role'] == "staff") ? "<th>Edit Records</th>" : "<th>Remove</th>")  ?>
                </tr>
            </thead>
            <tbody>
                <?php if (isset($users)) {
                    foreach ($users as $user) { ?> <tr>
                            <td><?php echo ($user['user_id']); ?></td>
                            <td><?php echo ($user['user_name']); ?></td>
                            <td><a href="./patientdetails.php?user_id=<?php echo ($user['user_id']) ?>" class="btn btn-primary">View</a></td>
                            <?php echo (($_SESSION['user_role'] == "admin" || $_SESSION['user_role'] == "staff") ? "<td><a href='./editreport.php?patient_id=" . $user['user_id'] . "' class='btn btn-warning'>Edit</a></td>" : "<td><a href='?remove=1&patient_id=" . $user['user_id'] . "&member_id=" . $_SESSION['user_id'] . "' class='btn btn-danger'>Remove</a></td>") ?>
                        </tr><?php }
                        } ?>
            </tbody>
        </table>
    </div>
</div>
<?php include("./includes/footer.php") ?>