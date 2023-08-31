<?php
session_start();

// Check if the user is already logged in
if (isset($_SESSION['userid'])) {
    header("Location: cart.php?mobile=" . urlencode($_SESSION['userid']) . "&productid=" . urlencode($_GET['productid']));
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Thapar_Basket">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thapar_Basket</title>
    <link rel="icon" type="image/x-icon" href="images/logo.png"><!-- add image logo -->
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background-color: #EAE9FF;
        }
    </style>
</head>
<body>
    <!-- top navigation bar -->
    <div id="header">
        <ul id="navbar">
            <li><a href="index.php">Home</a></li>
            <li><a href="shopping.php">Shopping</a></li>
            <li><a href="services.php">Services</a></li>
        </ul>
        <ul id="navbar">
            <li><a href="orders.php">Orders</a></li>
            <li><a href="cart.php">Cart</a></li>
        </ul>
    </div>

    <!-- login form -->
    <div class="login">
        <form action="validatelogin.php" method="POST">
            <fieldset>
                <legend style="padding-bottom: 20px;">Login Form</legend>

                <label class="login" for="mobile">Enter Mobile-No: </label><br>
                <input type="tel" id="mobile" name="mobile" placeholder="enter 10-digit mobile no" pattern="[0-9]{10}" required><br><br>

                <label class="login" for="password">Enter Password: </label><br>
                <input type="password" id="password" name="password" placeholder="enter your password" minlength="5" required><br><br>

                <!-- Hidden input field to pass the product ID -->
                <input type="hidden" name="productid" value="<?php echo $_GET['productid']; ?>">

                <a href="signup.html">Sign up</a>

                <input type="submit" value="log in" style="float: right;"><br><br>

                <marquee>
                    <a style="font-size: small; padding: 10px; cursor: pointer;" href="resetpassword.html">Forget Password, Click Here to get</a>
                </marquee>
            </fieldset>
        </form>
    </div>

    <!-- footer -->
    <footer>
        <hr />
        <h4>&copy; 2023 This is an original website by Thapar Basket</h4>
    </footer>
</body>
</html>