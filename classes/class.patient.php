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
        $sql = "UPDATE report SET heart_rate = ? ,	blood_pressure = ?,	respiratory_rate = ?, oxygen_saturation = ?, body_temperature = ?, glucose_level = ?, bmi = ?, cholesterol_level = ?, hemoglobin_level = ?,	pain_scale = ? WHERE patient_id = ?";
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ssssssssssi", $heart_rate, $blood_pressure, $respiratory_rate, $oxygen_saturation, $body_temperature, $glucose_level, $bmi, $cholesterol_level, $hemoglobin_level, $pain_scale, $patient_id);

            if ($stmt->execute()) {
                echo ("successfully updated.");
            }
        } catch (\Throwable $th) {
            echo ($th);
        }
    }

    public function fetchReportbyId($patientId)
    {
        $sql = "SELECT * FROM report WHERE patient_id=?";

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
                echo ("The member ID does not exist in the user table.");
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
                echo ("You have already added this member.");
            } else {
                $sql = "INSERT INTO familymember (patient_id, member_id) VALUES (?, ?)";

                try {
                    $stmt = $this->conn->prepare($sql);
                    $stmt->bind_param("ii", $patient_id, $member_id);

                    if ($stmt->execute()) {
                        echo ("Family Member Added.");
                    } else {
                        echo ("Something weng wrong!");
                    }
                } catch (\Throwable $th) {
                    echo ($th);
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
