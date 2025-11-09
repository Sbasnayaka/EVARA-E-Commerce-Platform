<?php
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

// Fetch FAQs from the database
$query = "SELECT * FROM faqs";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EVARA: FAQ Management</title>
    <link rel="stylesheet" href="CSS/admin.css">
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="shortcut icon" href="pics/icon.png" type="image/x-icon">
</head>
<body>
    <header>
        <div class="logo"><b>EVARA</b></div>
        <nav>
            <ul>
                <li><a href="index.php"><b>Home</b></a></li>
                <li><a href="admin_user_management.php"><b>Manage Users</b></a></li>
                <li><a href="admin_faq_management.php"><b>Manage FAQs</b></a></li>
                <li><a href="logout.php"><b>Logout</b></a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section id="faqManagement">
        <h1>FAQ Management</h1>
        <div class="admin-image">
                    <img src="pics/question.png" alt="admin Image">
                </div>
                <br>
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Question</th>
                    <th>Answer</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $row['faq_id']; ?></td>
                        <td><?php echo $row['question']; ?></td>
                        <td><?php echo $row['answer']; ?></td>
                        <td>
                            <button><a href="edit_faq.php?id=<?php echo $row['faq_id']; ?>">Edit</a></button> | 
                            <button><a href="delete_faq.php?id=<?php echo $row['faq_id']; ?>" onclick="return confirm('Are you sure?')">Delete</a></button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
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