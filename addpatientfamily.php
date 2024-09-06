<?php include("./includes/header.php");
include("./classes/class.patient.php");
include("./classes/class.familymember.php");

$obj = new Patient();
$familymemberObj = new FamilyMember();
?>

<div class="container">
    <h1 class="my-3">Add <?php echo (($_SESSION['user_role'] == 'familymember') ? "Patient" : "Family Member") ?> Into The List</h1>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if ($_SESSION['user_role'] == "patient") {
            $obj->addFamilyMember($_SESSION["user_id"], $_POST["id"]);
        }

        if ($_SESSION['user_role'] == "familymember") {
            $familymemberObj->addPatient($_POST["id"], $_SESSION["user_id"]);
        }
    }
    ?>
    <div class="row">
        <div class="col">
            <form method="post">
                <div class="form-group">
                    <label for="patientfamily">ID</label>
                    <input type="text" name="id" class="form-control" id="patientfamily" placeholder="Enter id" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Add</button>
            </form>
        </div>
    </div>
</div>

<?php include("./includes/footer.php") ?>