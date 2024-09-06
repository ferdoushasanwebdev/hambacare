<?php
include_once("./db/db.php");
class User
{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->createConnection();
    }

    public function login($userid, $password)
    {
        $sql = "SELECT * FROM user where user_id = ?";
        try {
            $stmt = $this->conn->prepare($sql);

            $stmt->bind_param("s", $userid);
            $stmt->execute();

            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $user = $result->fetch_all(MYSQLI_ASSOC);

                if (password_verify($password, $user[0]['user_password'])) {
                    session_start();
                    $_SESSION['user_id'] = $user[0]['user_id'];
                    $_SESSION['user_name'] = $user[0]['user_name'];
                    $_SESSION['user_phone'] = $user[0]['user_phone'];
                    $_SESSION['user_role'] = $user[0]['user_role'];
                    header("Location: dashboard.php");
                }
            }
        } catch (\Throwable $th) {
            echo ($th);
        }
    }

    public function register($username, $phone, $password, $role)
    {
        $hashedpassword = password_hash($password, PASSWORD_BCRYPT);
        $sql = "INSERT INTO user (user_name, user_phone, user_password, user_role) VALUES (?, ?, ?, ?)";

        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ssss", $username, $phone, $hashedpassword, $role);

            if ($stmt->execute()) {
                session_start();
                $_SESSION['user_id'] = $stmt->insert_id;
                $_SESSION['user_name'] = $username;
                $_SESSION['user_phone'] = $phone;
                $_SESSION['user_role'] = $role;

                header("Location: dashboard.php");
            } else {
                echo ("user register failed.");
            }
        } catch (\Throwable $th) {
            echo ($th);
        }
    }

    public function createUser($username, $phone, $password, $role)
    {
        $hashedpassword = password_hash($password, PASSWORD_BCRYPT);
        $sql = "INSERT INTO user (user_name, user_phone, user_password, user_role) VALUES (?, ?, ?, ?)";

        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ssss", $username, $phone, $hashedpassword, $role);

            if ($stmt->execute()) {
                header("Location: dashboard.php");
            } else {
                echo ("user register failed.");
            }
        } catch (\Throwable $th) {
            echo ($th);
        }
    }

    public function fetchUser($role)
    {
        $sql = "SELECT user_id, user_name FROM user WHERE user_role = ?";

        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("s", $role);
            $stmt->execute();

            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $users = $result->fetch_all(MYSQLI_ASSOC);
                return $users;
            }
        } catch (\Throwable $th) {
            echo ($th);
        }
    }

    public function fetchUserById($user_id)
    {
        $sql = "SELECT * FROM user WHERE user_id=?";

        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $user_id);

            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                return $result->fetch_all(MYSQLI_ASSOC);
            }
        } catch (\Throwable $th) {
            echo ($th);
        }
    }

    public function updateSettings($user_id, $username, $phone, $newpassword, $confirmpassword)
    {
        try {
            if (!empty($newpassword) && !empty($confirmpassword)) {
                if ($newpassword == $confirmpassword) {
                    $password = password_hash($newpassword, PASSWORD_BCRYPT);
                    $sql = "UPDATE user SET user_name=?, user_phone=?, user_password=? WHERE user_id=?";

                    $stmt = $this->conn->prepare($sql);
                    $stmt->bind_param("sssi", $username, $phone, $password, $user_id);


                    if ($stmt->execute()) {
                        $_SESSION['message'] = "saved change.";
                        $_SESSION['user_name'] = $username;
                        $_SESSION['user_phone'] = $phone;
                    }
                } else {
                    $_SESSION['message'] = "password not matched.";
                    $this->conn->close();
                }
            } else {
                $sql = "UPDATE user SET user_name=?, user_phone=? WHERE user_id=?";
                $stmt = $this->conn->prepare($sql);
                $stmt->bind_param("ssi", $username, $phone, $user_id);

                if ($stmt->execute()) {
                    $_SESSION['message'] = "saved change.";
                    $_SESSION['user_name'] = $username;
                    $_SESSION['user_phone'] = $phone;
                }
            }
        } catch (\Throwable $th) {
            echo ($th);
        }
    }
}
