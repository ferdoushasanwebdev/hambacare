<?php
include_once("./db/db.php");
class FamilyMember
{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->createConnection();
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
