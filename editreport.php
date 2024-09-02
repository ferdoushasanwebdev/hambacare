<?php include("./includes/header.php");
include("./classes/class.patient.php");

$patientObj = new Patient();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $patientObj->createReport($_POST["patientId"], $_POST["heartRate"], $_POST["bloodPressure"], $_POST["respiratoryRate"], $_POST["oxygenSaturation"], $_POST["bodyTemperature"], $_POST["bloodGlucoseLevel"], $_POST["bmi"], $_POST["cholesterolLevels"], $_POST["hemoglobinLevels"], $_POST["painScale"]);
}

?>

<div class="container mt-5">
    <div class="report-form">
        <h2 class="mb-4">Create Patient Test Report</h2>
        <form class="mb-3" method="post">
            <div class="form-group">
                <label for="patientId">Patient ID</label>
                <input type="text" class="form-control" name="patientId" id="patientId" placeholder="Enter patient ID" required>
            </div>
            <div class="form-group">
                <label for="heartRate">Heart Rate</label>
                <input type="text" class="form-control" name="heartRate" id="heartRate" placeholder="Enter heart rate" required>
            </div>
            <div class="form-group">
                <label for="bloodPressure">Blood Pressure</label>
                <input type="text" class="form-control" name="bloodPressure" id="bloodPressure" placeholder="Enter blood pressure" required>
            </div>
            <div class="form-group">
                <label for="respiratoryRate">Respiratory Rate</label>
                <input type="text" class="form-control" name="respiratoryRate" id="respiratoryRate" placeholder="Enter respiratory rate" required>
            </div>
            <div class="form-group">
                <label for="oxygenSaturation">Oxygen Saturation (SpO2)</label>
                <input type="text" class="form-control" name="oxygenSaturation" id="oxygenSaturation" placeholder="Enter oxygen saturation" required>
            </div>
            <div class="form-group">
                <label for="bodyTemperature">Body Temperature</label>
                <input type="text" class="form-control" name="bodyTemperature" id="bodyTemperature" placeholder="Enter body temperature" required>
            </div>
            <div class="form-group">
                <label for="bloodGlucoseLevel">Blood Glucose Level (Diabetic Rate)</label>
                <input type="text" class="form-control" name="bloodGlucoseLevel" id="bloodGlucoseLevel" placeholder="Enter blood glucose level" required>
            </div>
            <div class="form-group">
                <label for="bmi">Body Mass Index (BMI)</label>
                <input type="text" class="form-control" name="bmi" id="bmi" placeholder="Enter BMI" required>
            </div>
            <div class="form-group">
                <label for="cholesterolLevels">Cholesterol Levels</label>
                <input type="text" class="form-control" name="cholesterolLevels" id="cholesterolLevels" placeholder="Enter cholesterol levels" required>
            </div>
            <div class="form-group">
                <label for="hemoglobinLevels">Hemoglobin Levels</label>
                <input type="text" class="form-control" name="hemoglobinLevels" id="hemoglobinLevels" placeholder="Enter hemoglobin levels" required>
            </div>
            <div class="form-group">
                <label for="painScale">Pain Scale (e.g., 1-10)</label>
                <input type="text" class="form-control" name="painScale" id="painScale" placeholder="Enter pain scale" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Submit Report</button>
        </form>
    </div>
</div>
<?php include("./includes/footer.php") ?>