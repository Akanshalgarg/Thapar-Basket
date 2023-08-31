<!DOCTYPE html>
<html>
<body>
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
            $user = $_POST['username'];
            $mobile = $_POST['mobile'];
            $email = $_POST['mail'];
            $pass = $_POST['password'];

            $checkStmt = $conn->prepare("SELECT mobile FROM userinfo WHERE mobile = ?");
            $checkStmt->bind_param("s", $mobile);
            $checkStmt->execute();
            $checkResult = $checkStmt->get_result();

            if ($checkResult->num_rows > 0) {
                echo "User with the same phone number already signed up,
                Please try with different phone number / login to continue";
            } else {
                $stmt = $conn->prepare("INSERT INTO userinfo (username, mobile, email, password) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("ssss", $user, $mobile, $email, $pass);

                if ($stmt->execute()) {
                    echo '<script>
                            alert("Signup successful!, Please login to continue");
                            setTimeout(function(){
                                window.location.href = "logincart.php?mobile=' . $mobile . '&productid=null";
                            }, 1000); // 1 seconds delay before redirecting
                        </script>';
                    exit();
                } else {
                    echo "Error: " . $stmt->error;
                }

                $stmt->close();
            }

            $checkStmt->close();
        }
    }

    $conn->close();
    ?>
</body>
</html>