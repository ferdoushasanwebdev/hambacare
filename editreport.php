<?php include("./includes/header.php");
include("./classes/class.patient.php");

$patientObj = new Patient();

$reports = $patientObj->fetchReportbyId($_GET['patient_id']);



?>

<div class="container mt-5">
    <div class="report-form">
        <?php if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $patientObj->updateReport($_GET['patient_id'], $_POST["heartRate"], $_POST["bloodPressure"], $_POST["respiratoryRate"], $_POST["oxygenSaturation"], $_POST["bodyTemperature"], $_POST["bloodGlucoseLevel"], $_POST["bmi"], $_POST["cholesterolLevels"], $_POST["hemoglobinLevels"], $_POST["painScale"]);
            $reports = $patientObj->fetchReportbyId($_GET['patient_id']);
        } ?>
        <h2 class="mb-4"><?php echo ($reports[0]['user_name']); ?>'s Test Report</h2>
        <form class="mb-3" method="post">
            <div class="form-group">
                <label for="heartRate">Heart Rate</label>
                <input type="text" class="form-control" name="heartRate" id="heartRate" placeholder="Enter heart rate" value=<?php echo ($reports[0]['heart_rate']) ?> required>
            </div>
            <div class="form-group">
                <label for="bloodPressure">Blood Pressure</label>
                <input type="text" class="form-control" name="bloodPressure" id="bloodPressure" placeholder="Enter blood pressure" value=<?php echo ($reports[0]['blood_pressure']) ?> required>
            </div>
            <div class="form-group">
                <label for="respiratoryRate">Respiratory Rate</label>
                <input type="text" class="form-control" name="respiratoryRate" id="respiratoryRate" placeholder="Enter respiratory rate" value=<?php echo ($reports[0]['respiratory_rate']) ?> required>
            </div>
            <div class="form-group">
                <label for="oxygenSaturation">Oxygen Saturation (SpO2)</label>
                <input type="text" class="form-control" name="oxygenSaturation" id="oxygenSaturation" placeholder="Enter oxygen saturation" value=<?php echo ($reports[0]['oxygen_saturation']) ?> required>
            </div>
            <div class="form-group">
                <label for="bodyTemperature">Body Temperature</label>
                <input type="text" class="form-control" name="bodyTemperature" id="bodyTemperature" placeholder="Enter body temperature" value=<?php echo ($reports[0]['body_temperature']) ?> required>
            </div>
            <div class="form-group">
                <label for="bloodGlucoseLevel">Blood Glucose Level (Diabetic Rate)</label>
                <input type="text" class="form-control" name="bloodGlucoseLevel" id="bloodGlucoseLevel" placeholder="Enter blood glucose level" value=<?php echo ($reports[0]['glucose_level']) ?> required>
            </div>
            <div class="form-group">
                <label for="bmi">Body Mass Index (BMI)</label>
                <input type="text" class="form-control" name="bmi" id="bmi" placeholder="Enter BMI" value=<?php echo ($reports[0]['bmi']) ?> required>
            </div>
            <div class="form-group">
                <label for="cholesterolLevels">Cholesterol Levels</label>
                <input type="text" class="form-control" name="cholesterolLevels" id="cholesterolLevels" placeholder="Enter cholesterol levels" value=<?php echo ($reports[0]['cholesterol_level']) ?> required>
            </div>
            <div class="form-group">
                <label for="hemoglobinLevels">Hemoglobin Levels</label>
                <input type="text" class="form-control" name="hemoglobinLevels" id="hemoglobinLevels" placeholder="Enter hemoglobin levels" value=<?php echo ($reports[0]['hemoglobin_level']) ?> required>
            </div>
            <div class="form-group">
                <label for="painScale">Pain Scale (e.g., 1-10)</label>
                <input type="text" class="form-control" name="painScale" id="painScale" placeholder="Enter pain scale" value=<?php echo ($reports[0]['pain_scale']) ?> required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Submit Report</button>
        </form>
    </div>
</div>
<?php include("./includes/footer.php") ?>