<?php include("./includes/header.php");
include("./classes/class.patient.php");

$patientObj = new Patient();
?>

<div class="container mt-5">
    <div class="alerts-list">
        <h2 class="mb-4">Alerts</h2>
        <?php
        $patientObj->displayAlerts($_GET['patient_id']);
        ?>
    </div>
</div>
<?php include("./includes/footer.php") ?>