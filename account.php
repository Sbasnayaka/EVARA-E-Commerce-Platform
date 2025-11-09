<?php
// Start the session
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "evara_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Encrypt password
    $role = $_POST['role'];

    // Check if the username or email already exists
    $check_user_query = $conn->prepare("SELECT * FROM users WHERE username=? OR email=?");
    $check_user_query->bind_param("ss", $username, $email);
    $check_user_query->execute();
    $result = $check_user_query->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('Username or Email already exists!');</script>";
    } else {
        // Insert the user into the database
        $stmt = $conn->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $username, $email, $password, $role);

        if ($stmt->execute()) {
            echo "<script>alert('Registration successful!');</script>";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }
    $check_user_query->close();
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/account.css">
    <link rel="stylesheet" href="CSS/style.css">
	<script type="text/javascript" src="JS/account.js"></script>

    <title>EVARA: Account Page</title>

    <link rel="shortcut icon" href="pics/icon.png" type="image/x-icon">
</head>
	
<body>
    <header>
        <div class="logo"><b>EVARA</b></div>
<!----------------------------------------------- Navigation bar ----------------------------------------------------------->
        <nav>
            <ul>
                <li><a href="index.php"><b>Home</b></a></li>
                <li><a href="product.php"><b>Products</b></a></li>
                <li><a href="customize.php"><b>Customize</b></a></li>
                <li><a href="cart.php"><b>Cart</b></a></li>
                <li><a href="account.php"><b>Account</b></a></li>
                <li><a href="logout.php"><b>LogOut</b></a></li>
                <li><a href="support.php"><b>Support&nbsp;</b></a></li>
            </ul>
        </nav>
    </header>
    <main>


<!---------------------------------------------------Section for Account------------------------------------------------------------>
        <section class="account-section">
            <div class="account-details">
                <h2 data_temp_dwid="0">&nbsp;</h2>
                <h2>Account Details</h2>
              <br>
                <div class="account-image">
                    <img src="pics/user_Icon.png" alt="User Image">
                </div>
                <form action="account.php" method="POST">
                    
                    <label for="role">Role</label>
                    <select id="type-select" name="role">
                        <option value="null">who r u ?</option>
                        <option value="customer">Customer</option>
                        <option value="admin">Admin</option>
                    </select>
                    <br>

                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>

                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>

                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
					
					<label for="Cpassword">Confirm Password</label>
					<input type="password" id="Cpassword" name="Cpassword" required>

                    <button type="submit" onclick="handleCreateAcc()">Create Account</button>
                    <br>
                    <button type="button" class="btn-login" id="btn-login" onclick="navigateToLoginn()">Login</button>
                 </form>
            </div>

        </section>
    </main>
<!---------------------------------------------------Logo name marquee------------------------------------------------------------>

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
<!------------------------------------------------- Section for footer ------------------------------------------------------------->
    <footer>
<!-------------------------------------------------Social media buttons------------------------------------------------------------->

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
<!-------------------------------------------------Logo name marquee------------------------------------------------------------->

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