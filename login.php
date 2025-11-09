<?php
// login.php

session_start();
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "evara_db";

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    
    
    // Prepare and execute SQL statement
    $stmt = $conn->prepare("SELECT id, password, role FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hashed_password, $role);
        $stmt->fetch();
        
        // Verify password
        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $role;
            
            // Redirect to the appropriate dashboard
            if ($role == 'admin') {
                header("Location: admin_dashboard.php");
            } else {
                header("Location: user_dashboard.php");
            }
            exit();
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "No user found with this username.";
    }

    
    
    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/login.css">
    <link rel="stylesheet" href="CSS/style.css">

    <title>EVARA: Login Page</title>

    <link rel="shortcut icon" href="pics/icon.png" type="image/x-icon">

</head>
<body>
    <header>
        <div class="logo"><b>EVARA</b></div>
<!---------------------------------------------------Navigation bar----------------------------------------------------------------->
        <nav>
            <ul>
                <li><a href="index.php"><b>Home</b></a></li>
                <li><a href="product.php"><b>Products</b></a></li>
                <li><a href="customize.php"><b>Customize</b></a></li>
                <li><a href="cart.php"><b>Cart</b></a></li>
                <li><a href="loginORsignup.php"><b>Account</b></a></li>
                <li><a href="support.php"><b>Support&nbsp;</b></a></li>
            </ul>
        </nav>
    </header>
    <main>
<!---------------------------------------------------Section for login-------------------------------------------------------------->
        <section class="login-section">
            <div class="login-details">
                <h2>Account Details</h2>
                <br>
                <div class="login-image">
                    <img src="pics/user_Icon.png" alt="User Image">
                </div>
                <form action="login_process.php" method="POST">
                    
                    <label for="role">Role</label>
                    <select id="type-select" name="role">
                        <option value="null">who r u ?</option>
                        <option value="customer">Customer</option>
                        <option value="admin">Admin</option>
                    </select>
                    <br>

                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>

                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>

                    <button type="submit">Login</button>
                </form>
            </div>
        </section>
    </main>
<!--------------------------------------------------Logo name marquee--------------------------------------------------------------->
    <section class="marqueeBox ">
        <div class="marquee">
            EVARA   &nbsp;    &nbsp;  &nbsp; EVARA  &nbsp;   &nbsp; &nbsp; EVARA     &nbsp;  &nbsp;    &nbsp; EVARA  &nbsp; &nbsp;   &nbsp; EVARA     &nbsp;    &nbsp;  &nbsp; EVARA  &nbsp;   &nbsp; &nbsp; 
            EVARA   &nbsp;    &nbsp;  &nbsp; EVARA  &nbsp;   &nbsp; &nbsp; EVARA     &nbsp;  &nbsp;    &nbsp; EVARA  &nbsp; &nbsp;   &nbsp; EVARA     &nbsp;    &nbsp;  &nbsp; EVARA  &nbsp;   &nbsp; &nbsp; 
            EVARA   &nbsp;    &nbsp;  &nbsp; EVARA  &nbsp;   &nbsp; &nbsp; EVARA     &nbsp;  &nbsp;    &nbsp; EVARA  &nbsp; &nbsp;   &nbsp; EVARA     &nbsp;    &nbsp;  &nbsp; EVARA  &nbsp;   &nbsp; &nbsp; 
            EVARA   &nbsp;    &nbsp;  &nbsp; EVARA  &nbsp;   &nbsp; &nbsp; EVARA     &nbsp;  &nbsp;    &nbsp; EVARA  &nbsp; &nbsp;   &nbsp; EVARA     &nbsp;    &nbsp;  &nbsp; EVARA  &nbsp;   &nbsp; &nbsp;
            EVARA   &nbsp;    &nbsp;  &nbsp; EVARA  &nbsp;   &nbsp; &nbsp; EVARA     &nbsp;  &nbsp;    &nbsp; EVARA  &nbsp; &nbsp;   &nbsp; EVARA     &nbsp;    &nbsp;  &nbsp; EVARA  &nbsp;   &nbsp; &nbsp; 
            EVARA   &nbsp;    &nbsp;  &nbsp; EVARA  &nbsp;   &nbsp; &nbsp; EVARA     &nbsp;  &nbsp;    &nbsp; EVARA  &nbsp; &nbsp;   &nbsp; EVARA     &nbsp;    &nbsp;  &nbsp; EVARA  &nbsp;   &nbsp; &nbsp; 
            EVARA   &nbsp;    &nbsp;  &nbsp; EVARA  &nbsp;   &nbsp; &nbsp; EVARA     &nbsp;  &nbsp;    &nbsp; EVARA  &nbsp; &nbsp;   &nbsp; EVARA     &nbsp;    &nbsp;  &nbsp; EVARA  &nbsp;   &nbsp; &nbsp; 
            EVARA   &nbsp;    &nbsp;  &nbsp; EVARA  &nbsp;   &nbsp; &nbsp; EVARA     &nbsp;  &nbsp;    &nbsp; EVARA  &nbsp; &nbsp;   &nbsp; EVARA     &nbsp;    &nbsp;  &nbsp; EVARA  &nbsp;   &nbsp; &nbsp;
            EVARA   &nbsp;    &nbsp;  &nbsp; EVARA  &nbsp;   &nbsp; &nbsp; EVARA     &nbsp;  &nbsp;    &nbsp; EVARA  &nbsp; &nbsp;   &nbsp; EVARA     &nbsp;    &nbsp;  &nbsp; EVARA  &nbsp;   &nbsp; &nbsp; 
            EVARA   &nbsp;    &nbsp;  &nbsp; EVARA  &nbsp;   &nbsp; &nbsp; EVARA     &nbsp;  &nbsp;    &nbsp; EVARA  &nbsp; &nbsp;   &nbsp; EVARA     &nbsp;    &nbsp;  &nbsp; EVARA  &nbsp;   &nbsp; &nbsp; 
            EVARA   &nbsp;    &nbsp;  &nbsp; EVARA  &nbsp;   &nbsp; &nbsp; EVARA     &nbsp;  &nbsp;    &nbsp; EVARA  &nbsp; &nbsp;   &nbsp; EVARA     &nbsp;    &nbsp;  &nbsp; EVARA  &nbsp;   &nbsp; &nbsp; 
            EVARA   &nbsp;    &nbsp;  &nbsp; EVARA  &nbsp;   &nbsp; &nbsp; EVARA     &nbsp;  &nbsp;    &nbsp; EVARA  &nbsp; &nbsp;   &nbsp; EVARA     &nbsp;    &nbsp;  &nbsp; EVARA  &nbsp;   &nbsp; &nbsp;
        </div>
    </section>

    <footer>
<!--------------------------------------------------Secton for Socialmedia--------------------------------------------------------------->
        <section class="homeMedia">
            <div class="social">
                <h4>LET'S CATCH UP ON SOCIAL MEDIA !!!</h4>
                <br>
                <a href="https://wa.me/0740665317" target="_blank"><img src="pics/whtsapp.png" alt="WhatsApp"></a>
                <a href="https://www.instagram.com/" target="_blank"><img src="pics/insta.png" alt="Instagram"></a>
                <a href="https://www.tiktok.com/" target="_blank"><img src="pics/tiktok.png" alt="TikTok"></a>
                <a href="mailto:contactus@gmail.com" target="_blank"><img src="pics/mail.png" alt="Email"></a>
            </div>
        </section>
        <br>
        <br>
<!--------------------------------------------------Logo name marquee--------------------------------------------------------------->
        <section class="marqueeBox">
            <div class="marquee">
                EVARA   &nbsp;    &nbsp;  &nbsp; EVARA  &nbsp;   &nbsp; &nbsp; EVARA     &nbsp;  &nbsp;    &nbsp; EVARA  &nbsp; &nbsp;   &nbsp; EVARA     &nbsp;    &nbsp;  &nbsp; EVARA  &nbsp;   &nbsp; &nbsp; 
                EVARA   &nbsp;    &nbsp;  &nbsp; EVARA  &nbsp;   &nbsp; &nbsp; EVARA     &nbsp;  &nbsp;    &nbsp; EVARA  &nbsp; &nbsp;   &nbsp; EVARA     &nbsp;    &nbsp;  &nbsp; EVARA  &nbsp;   &nbsp; &nbsp; 
                EVARA   &nbsp;    &nbsp;  &nbsp; EVARA  &nbsp;   &nbsp; &nbsp; EVARA     &nbsp;  &nbsp;    &nbsp; EVARA  &nbsp; &nbsp;   &nbsp; EVARA     &nbsp;    &nbsp;  &nbsp; EVARA  &nbsp;   &nbsp; &nbsp; 
                EVARA   &nbsp;    &nbsp;  &nbsp; EVARA  &nbsp;   &nbsp; &nbsp; EVARA     &nbsp;  &nbsp;    &nbsp; EVARA  &nbsp; &nbsp;   &nbsp; EVARA     &nbsp;    &nbsp;  &nbsp; EVARA  &nbsp;   &nbsp; &nbsp;
                EVARA   &nbsp;    &nbsp;  &nbsp; EVARA  &nbsp;   &nbsp; &nbsp; EVARA     &nbsp;  &nbsp;    &nbsp; EVARA  &nbsp; &nbsp;   &nbsp; EVARA     &nbsp;    &nbsp;  &nbsp; EVARA  &nbsp;   &nbsp; &nbsp; 
                EVARA   &nbsp;    &nbsp;  &nbsp; EVARA  &nbsp;   &nbsp; &nbsp; EVARA     &nbsp;  &nbsp;    &nbsp; EVARA  &nbsp; &nbsp;   &nbsp; EVARA     &nbsp;    &nbsp;  &nbsp; EVARA  &nbsp;   &nbsp; &nbsp; 
                EVARA   &nbsp;    &nbsp;  &nbsp; EVARA  &nbsp;   &nbsp; &nbsp; EVARA     &nbsp;  &nbsp;    &nbsp; EVARA  &nbsp; &nbsp;   &nbsp; EVARA     &nbsp;    &nbsp;  &nbsp; EVARA  &nbsp;   &nbsp; &nbsp; 
                EVARA   &nbsp;    &nbsp;  &nbsp; EVARA  &nbsp;   &nbsp; &nbsp; EVARA     &nbsp;  &nbsp;    &nbsp; EVARA  &nbsp; &nbsp;   &nbsp; EVARA     &nbsp;    &nbsp;  &nbsp; EVARA  &nbsp;   &nbsp; &nbsp;
                EVARA   &nbsp;    &nbsp;  &nbsp; EVARA  &nbsp;   &nbsp; &nbsp; EVARA     &nbsp;  &nbsp;    &nbsp; EVARA  &nbsp; &nbsp;   &nbsp; EVARA     &nbsp;    &nbsp;  &nbsp; EVARA  &nbsp;   &nbsp; &nbsp; 
                EVARA   &nbsp;    &nbsp;  &nbsp; EVARA  &nbsp;   &nbsp; &nbsp; EVARA     &nbsp;  &nbsp;    &nbsp; EVARA  &nbsp; &nbsp;   &nbsp; EVARA     &nbsp;    &nbsp;  &nbsp; EVARA  &nbsp;   &nbsp; &nbsp; 
                EVARA   &nbsp;    &nbsp;  &nbsp; EVARA  &nbsp;   &nbsp; &nbsp; EVARA     &nbsp;  &nbsp;    &nbsp; EVARA  &nbsp; &nbsp;   &nbsp; EVARA     &nbsp;    &nbsp;  &nbsp; EVARA  &nbsp;   &nbsp; &nbsp; 
                EVARA   &nbsp;    &nbsp;  &nbsp; EVARA  &nbsp;   &nbsp; &nbsp; EVARA     &nbsp;  &nbsp;    &nbsp; EVARA  &nbsp; &nbsp;   &nbsp; EVARA     &nbsp;    &nbsp;  &nbsp; EVARA  &nbsp;   &nbsp; &nbsp;
            </div>
        </section>
        <br>
        <br>
        <p>&copy; 2024 EVARA. All rights reserved.</p>
    </footer>
</body>
</html>