<?php
$servername = "localhost";
$username = 'root';
$password = '';
$database = "thaparbasket";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $mobile = $_POST['mobile'];
        $pass = $_POST['password'];
        $productid = $_POST['productid'];

        if (!empty($mobile)) {
            $stmt = $conn->prepare("SELECT * FROM userinfo WHERE mobile = ?");
            $stmt->bind_param("s", $mobile);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                //checks password for a particular mobile number
                if ($row['password'] == $pass) {
                    if ($row['mobile'] == "7837251809") {
                        session_start();
                        $_SESSION['is_admin'] = true;
                        header("Location: admin.php");
                        exit();
                    } else {
                        header("Location: cart.php?mobile=" . urlencode($mobile) . "&productid=" . urlencode($productid));
                        exit();
                    }
                } else {
                    echo "<script>alert('Incorrect password!'); window.location.href = 'login.php?productid=$productid';</script>";
                }
            } else {
                echo "<script>alert('User not found!'); window.location.href = 'signup.html';</script>";
            }

            $stmt->close();
        } else {
            echo "<script>alert('Mobile field is required!'); window.location.href = 'login.php?productid=$productid';</script>";
        }
    }
}

$conn->close();
?>