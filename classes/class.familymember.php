<?php
include_once("./db/db.php");
include_once("./classes/class.patient.php");

class FamilyMember
{
    private $conn;
    private $patientObj;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->createConnection();
        $this->patientObj = new Patient();
    }

    public function fetchPatient($member_id)
    {
        $sql = "SELECT * 
        FROM familymember INNER JOIN user ON familymember.patient_id = user.user_id 
        WHERE familymember.member_id = ?";


        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $member_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                return $result->fetch_all(MYSQLI_ASSOC);
            }
        } catch (\Throwable $th) {
            echo ($th);
        }
    }

    public function getPatientAlert($member_id)
    {
        $results = $this->fetchPatient($member_id);
        if ($results) {
            foreach ($results as $result) {
                $hasAlert = $this->patientObj->checkingAlert($result['patient_id']);
                if ($hasAlert == 1) {
                    echo ("<div style='opacity: 1;' class='alert alert-danger text-capitalize' role='alert'><a class='nav-link font-weight-bold text-danger' href='alert.php?patient_id=" . $result['patient_id'] . "'> " . $result['user_name'] . " has abnormal situation!</a></div>");
                }
            }
        }
    }

    public function addPatient($patient_id, $member_id)
    {
        $sql = "SELECT * FROM user WHERE user_id=? and user_role='patient'";

        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $patient_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows == 0) {
                echo ("<div style='opacity: 1;' class='alert alert-danger' role='alert'>The patient ID does not exist.</div>");
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
                echo ("<div style='opacity: 1;' class='alert alert-danger' role='alert'>You have already added this patient.</div>");
            } else {
                $sql = "INSERT INTO familymember (patient_id, member_id) VALUES (?, ?)";

                try {
                    $stmt = $this->conn->prepare($sql);
                    $stmt->bind_param("ii", $patient_id, $member_id);

                    if ($stmt->execute()) {
                        echo ("<div style='opacity: 1;' class='alert alert-success' role='alert'>Successfully Patient Added.</div>");
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

    public function removePatient($patient_id, $member_id)
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
