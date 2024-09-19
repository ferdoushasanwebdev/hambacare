<?php
include_once("./db/db.php");
include_once("./classes/class.user.php");

class Patient
{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->createConnection();
    }

    public function createReport($user_id, $heart_rate, $blood_pressure, $respiratory_rate, $oxygen_saturation, $body_temperature, $glucose_level, $bmi, $cholesterol_level, $hemoglobin_level, $pain_scale)
    {
        if (
            !is_int($heart_rate) ||
            !is_int($blood_pressure) ||
            !is_int($respiratory_rate) ||
            !is_int($oxygen_saturation) ||
            !is_int($glucose_level) ||
            !is_int($pain_scale)
        ) {
            echo ("parameters are not integers.");
            return;
        }

        if (
            !is_numeric($body_temperature) || !is_numeric($bmi) ||
            !is_numeric($cholesterol_level) || !is_numeric($hemoglobin_level)
        ) {
            echo ("parameters are invalid.");
            return;
        }

        $userObj = new User();
        $user = $userObj->fetchUserById($user_id);

        if (empty($user) || $user[0]['user_role'] != "patient") {
            echo ("No patient found!");
        } else {
            $sql = "INSERT INTO report (patient_id, heart_rate,	blood_pressure,	respiratory_rate, oxygen_saturation, body_temperature, glucose_level, bmi, cholesterol_level, hemoglobin_level,	pain_scale) VALUES (?,?,?,?,?,?,?,?,?,?,?)";

            try {
                $stmt = $this->conn->prepare($sql);
                $stmt->bind_param("issssssssss", $user_id, $heart_rate, $blood_pressure, $respiratory_rate, $oxygen_saturation, $body_temperature, $glucose_level, $bmi, $cholesterol_level, $hemoglobin_level, $pain_scale);
                if ($stmt->execute()) {
                    echo ("successfully inserted.");
                }
            } catch (\Throwable $th) {
                echo ($th);
            }
        }
    }

    public function updateReport($patient_id, $heart_rate, $blood_pressure, $respiratory_rate, $oxygen_saturation, $body_temperature, $glucose_level, $bmi, $cholesterol_level, $hemoglobin_level, $pain_scale)
    {
        if (
            !is_numeric($heart_rate) ||
            !is_numeric($blood_pressure) ||
            !is_numeric($respiratory_rate) ||
            !is_numeric($oxygen_saturation) ||
            !is_numeric($glucose_level) ||
            !is_numeric($pain_scale) ||
            !is_numeric($body_temperature) ||
            !is_numeric($bmi) ||
            !is_numeric($cholesterol_level) ||
            !is_numeric($hemoglobin_level)
        ) {
            echo ("parameters are invalid.");
            return;
        }

        $sql = "UPDATE report SET heart_rate = ? ,	blood_pressure = ?,	respiratory_rate = ?, oxygen_saturation = ?, body_temperature = ?, glucose_level = ?, bmi = ?, cholesterol_level = ?, hemoglobin_level = ?,	pain_scale = ? WHERE patient_id = ?";
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ssssssssssi", $heart_rate, $blood_pressure, $respiratory_rate, $oxygen_saturation, $body_temperature, $glucose_level, $bmi, $cholesterol_level, $hemoglobin_level, $pain_scale, $patient_id);

            if ($stmt->execute()) {
                echo ("<div style='opacity: 1;' class='alert alert-success' role='alert'>successfully updated.</div>");
            }
        } catch (\Throwable $th) {
            echo ($th);
        }
    }

    public function fetchReportbyId($patientId)
    {
        $sql = "SELECT user_name, patient_id, heart_rate,	blood_pressure,	respiratory_rate, oxygen_saturation, body_temperature, glucose_level, bmi, cholesterol_level, hemoglobin_level,	pain_scale FROM user INNER JOIN report ON user.user_id = report.patient_id WHERE report.patient_id=?";

        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $patientId);
            $stmt->execute();

            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                return $result->fetch_all(MYSQLI_ASSOC);
            } else {
                echo ("no test report.");
            }
        } catch (\Throwable $th) {
            echo ($th);
        }
    }

    public function fetchFamilyMember($patient_id)
    {
        $sql = "SELECT * 
        FROM familymember INNER JOIN user ON familymember.member_id = user.user_id 
        WHERE familymember.patient_id = ?";


        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $patient_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                return $result->fetch_all(MYSQLI_ASSOC);
            }
        } catch (\Throwable $th) {
            echo ($th);
        }
    }

    public function addFamilyMember($patient_id, $member_id)
    {
        $sql = "SELECT * FROM user WHERE user_id=? and user_role='familymember'";

        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $member_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows == 0) {
                echo ("<div style='opacity: 1;' class='alert alert-danger' role='alert'>The member ID does not exist.</div>");
                return;
            }
        } catch (\Throwable $th) {
            echo ($th);
            return;
        }

        $sql = "SELECT * FROM familymember WHERE patient_id=? and member_id=?";

        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ii", $patient_id, $member_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                echo ("<div style='opacity: 1;' class='alert alert-danger' role='alert'>You have already added this member.</div>");
            } else {
                $sql = "INSERT INTO familymember (patient_id, member_id) VALUES (?, ?)";

                try {
                    $stmt = $this->conn->prepare($sql);
                    $stmt->bind_param("ii", $patient_id, $member_id);

                    if ($stmt->execute()) {
                        echo ("<div style='opacity: 1;' class='alert alert-success' role='alert'>Successfully Family Member Added.</div>");
                    } else {
                        echo ("<div style='opacity: 1;' class='alert alert-danger' role='alert'>Something weng wrong!</div>");
                    }
                } catch (\Throwable $th) {
                    echo ($th);
                }
            }
        } catch (\Throwable $th) {
            echo ($th);
        }
    }

    public function displayAlerts($patient_id)
    {
        $sql = "SELECT * FROM report WHERE patient_id = ?";
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $patient_id);
            $stmt->execute();

            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $report = $result->fetch_all(MYSQLI_ASSOC);
                if ($report[0]["heart_rate"] < 60 || $report[0]["heart_rate"] > 100) {
                    echo ("<div style='opacity: 1;' class='alert alert-danger text-capitalize' role='alert'>heart rate is abnormal!</div>");
                }
                if ($report[0]["blood_pressure"] < 90 || $report[0]["blood_pressure"] > 120) {
                    echo ("<div style='opacity: 1;' class='alert alert-danger text-capitalize' role='alert'>blood pressure is abnormal!</div>");
                }
                if ($report[0]["respiratory_rate"] < 12 || $report[0]["respiratory_rate"] > 20) {
                    echo ("<div style='opacity: 1;' class='alert alert-danger text-capitalize' role='alert'>Respiratory Rate is abnormal!</div>");
                }
                if ($report[0]["oxygen_saturation"] < 95 || $report[0]["oxygen_saturation"] > 100) {
                    echo ("<div style='opacity: 1;' class='alert alert-danger text-capitalize' role='alert'>oxygen saturation is abnormal!</div>");
                }
                if ($report[0]["body_temperature"] < 97 || $report[0]["body_temperature"] > 99) {
                    echo ("<div style='opacity: 1;' class='alert alert-danger text-capitalize' role='alert'>body temperature is abnormal!</div>");
                }
                if ($report[0]["glucose_level"] < 70 || $report[0]["glucose_level"] > 99) {
                    echo ("<div style='opacity: 1;' class='alert alert-danger text-capitalize' role='alert'>glucose level is abnormal!</div>");
                }
                if ($report[0]["bmi"] < 18.5 || $report[0]["bmi"] > 25) {
                    echo ("<div style='opacity: 1;' class='alert alert-danger text-capitalize' role='alert'>BMI is abnormal!</div>");
                }
                if ($report[0]["cholesterol_level"] >= 200) {
                    echo ("<div style='opacity: 1;' class='alert alert-danger text-capitalize' role='alert'>cholesterol level is abnormal!</div>");
                }
                if ($report[0]["hemoglobin_level"] < 12 || $report[0]["hemoglobin_level"] > 16) {
                    echo ("<div style='opacity: 1;' class='alert alert-danger text-capitalize' role='alert'>hemoglobin level is abnormal!</div>");
                }
                if ($report[0]["pain_scale"] > 0) {
                    if ($report[0]["pain_scale"] <= 3 || $report[0]["pain_scale"] >= 1) {
                        echo ("<div style='opacity: 1;' class='alert alert-danger text-capitalize' role='alert'>mid pain.</div>");
                    } else if ($report[0]["pain_scale"] <= 6 || $report[0]["pain_scale"] >= 4) {
                        echo ("<div style='opacity: 1;' class='alert alert-danger text-capitalize' role='alert'>moderate pain.</div>");
                    } else if ($report[0]["pain_scale"] <= 10 || $report[0]["pain_scale"] >= 7) {
                        echo ("<div style='opacity: 1;' class='alert alert-danger text-capitalize' role='alert'>severe pain.</div>");
                    }
                }
            }
        } catch (\Throwable $th) {
            echo ($th);
        }
    }

    public function checkingAlert($patient_id)
    {
        $sql = "SELECT * FROM report WHERE patient_id = ?";
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $patient_id);
            $stmt->execute();

            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $report = $result->fetch_all(MYSQLI_ASSOC);
                if ($report[0]["heart_rate"] < 60 || $report[0]["heart_rate"] > 100) {
                    return 1;
                } else if ($report[0]["blood_pressure"] < 90 || $report[0]["blood_pressure"] > 120) {
                    return 1;
                } else if ($report[0]["respiratory_rate"] < 12 || $report[0]["respiratory_rate"] > 20) {
                    return 1;
                } else if ($report[0]["oxygen_saturation"] < 95 || $report[0]["oxygen_saturation"] > 100) {
                    return 1;
                } else if ($report[0]["body_temperature"] < 97 || $report[0]["body_temperature"] > 99) {
                    return 1;
                } else if ($report[0]["glucose_level"] < 70 || $report[0]["glucose_level"] > 99) {
                    return 1;
                } else if ($report[0]["bmi"] < 18.5 || $report[0]["bmi"] > 25) {
                    return 1;
                } else if ($report[0]["cholesterol_level"] >= 200) {
                    return 1;
                } else if ($report[0]["hemoglobin_level"] < 12 || $report[0]["hemoglobin_level"] > 16) {
                    return 1;
                } else if ($report[0]["pain_scale"] > 0) {
                    return 1;
                } else {
                    return 0;
                }
            }
        } catch (\Throwable $th) {
            echo ($th);
        }
    }

    public function removeFamilyMember($patient_id, $member_id)
    {
        $sql = "DELETE FROM familymember WHERE patient_id=? AND member_id=?";
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ii", $patient_id, $member_id);

            if ($stmt->execute()) {
                $_SESSION['message'] = "Deleted successfully!";
            } else {
                $_SESSION['message'] = "Something went wrong!";
            }
        } catch (\Throwable $th) {
            echo ($th);
        }
    }
}
