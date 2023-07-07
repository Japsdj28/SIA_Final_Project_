<?php
session_start();

if (isset($_POST['eaddress']) && isset($_POST['pass'])) {
    include "../db_conn.php";

    $eaddress = $_POST['eaddress'];
    $password = $_POST['pass'];

    $data = "eaddress=" . $eaddress;

    if (empty($eaddress)) {
        $em = "Email Address is required";
        header("Location: ../login.php?error=$em&$data");
        exit;
    } else if (empty($password)) {
        $em = "Password is required";
        header("Location: ../login.php?error=$em&$data");
        exit;
    } else {

        $sql = "SELECT * FROM users WHERE emailaddress = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $eaddress);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();

            $emailaddress =  $user['emailaddress'];
            $passwordword =  $user['password'];
            $fname =  $user['fname'];
            $id =  $user['id'];

            if ($emailaddress === $eaddress) {
                if (password_verify($password, $passwordword)) {
                    $_SESSION['id'] = $id;
                    $_SESSION['fname'] = $fname;

                    if ($id == 3) {
                        header("Location: ../Admin_homepage.php");
                        exit;
                    } else {
                        header("Location: ../Customer_homepage.php");
                        exit;
                    }
                } else {
                    $em = "Incorrect Username or password";
                    header("Location: ../login.php?error=$em&$data");
                    exit;
                }
            } else {
                $em = "Incorrect Username or password";
                header("Location: ../login.php?error=$em&$data");
                exit;
            }
        } else {
            $em = "Incorrect Username or password";
            header("Location: ../login.php?error=$em&$data");
            exit;
        }
    }
} else {
    header("Location: ../login.php?error=error");
    exit;
}
?>
