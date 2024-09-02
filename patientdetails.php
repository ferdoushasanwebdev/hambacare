<?php include("./includes/header.php");
include("./classes/class.user.php");
include("./classes/class.patient.php");

$userObj = new User();
$user = $userObj->fetchUserById($_GET['user_id']);

$patientObj = new Patient();
$report = $patientObj->fetchReportbyId($user[0]['user_id']);

?>

<div class="container mt-5">
    <!-- Patient Details -->
    <div class="patient-details">
        <h2 class="mb-4">Patient Details</h2>
        <div class="detail-item">
            <strong>User ID:</strong>
            <span><?php echo ($user[0]['user_id']) ?></span>
        </div>
        <div class="detail-item">
            <strong>User Name:</strong>
            <span><?php echo ($user[0]['user_name']) ?></span>
        </div>
        <div class="detail-item">
            <strong>Phone Number:</strong>
            <span><?php echo ($user[0]['user_phone']) ?></span>
        </div>
    </div>

    <!-- Test Report -->
    <div class="test-report">
        <h3 class="mb-4">Test Report</h3>
        <div class="detail-item">
            <strong>Heart Rate:</strong>
            <span><?php echo ($report[0]['heart_rate']) ?> bpm</span>
        </div>
        <div class="detail-item">
            <strong>Blood Pressure:</strong>
            <span><?php echo ($report[0]['blood_pressure']) ?> mmHg</span>
        </div>
        <div class="detail-item">
            <strong>Respiratory Rate:</strong>
            <span><?php echo ($report[0]['respiratory_rate']) ?> breaths/min</span>
        </div>
        <div class="detail-item">
            <strong>Oxygen Saturation (SpO2):</strong>
            <span><?php echo ($report[0]['oxygen_saturation']) ?>%</span>
        </div>
        <div class="detail-item">
            <strong>Body Temperature:</strong>
            <span><?php echo ($report[0]['body_temperature']) ?>°F</span>
        </div>
        <div class="detail-item">
            <strong>Blood Glucose Level (Diabetic Rate):</strong>
            <span><?php echo ($report[0]['glucose_level']) ?> mg/dL</span>
        </div>
        <div class="detail-item">
            <strong>Body Mass Index (BMI):</strong>
            <span><?php echo ($report[0]['bmi']) ?></span>
        </div>
        <div class="detail-item">
            <strong>Cholesterol Levels:</strong>
            <span><?php echo ($report[0]['cholesterol_level']) ?> mg/dL</span>
        </div>
        <div class="detail-item">
            <strong>Hemoglobin Levels:</strong>
            <span><?php echo ($report[0]['hemoglobin_level']) ?> g/dL</span>
        </div>
        <div class="detail-item">
            <strong>Pain Scale (e.g., 1-10):</strong>
            <span><?php echo ($report[0]['pain_scale']) ?></span>
        </div>
    </div>
</div>

<?php include("./includes/footer.php") ?>