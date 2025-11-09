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

// Fetch order details
if (isset($_GET['id'])) {
    $order_id = $_GET['id'];
    $query = "SELECT * FROM orders WHERE order_id = $order_id";
    $result = mysqli_query($conn, $query);
    $order = mysqli_fetch_assoc($result);
}

// Update order status
if (isset($_POST['update'])) {
    $status = $_POST['status'];
    $update_query = "UPDATE orders SET status = '$status' WHERE order_id = $order_id";
    if (mysqli_query($conn, $update_query)) {
        echo "<script>alert('Order status updated successfully!');</script>";
        
    } else {
        echo "Error updating order: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Order</title>
    <link rel="stylesheet" href="CSS/admin.css">
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/managePro.css">
    <link rel="shortcut icon" href="pics/icon.png" type="image/x-icon">
</head>
<body>
    <header>
        <div class="logo"><b>EVARA</b></div>
        <nav>
            <ul>
                <li><a href="admin_order_management.php"><b>Back to Order Management</b></a></li>
            </ul>
        </nav>
    </header>
    <main>
    <section id="userManagment">
    <h1>Update Order Status</h1>
        <div class="admin-image">
                    <img src="pics/update.png" alt="admin Image">
                </div>
                <br>
                <div class="table-container">
        <?php if ($order) { ?>
            <form method="POST" action="">
            <table class="admin-table">
            <thead>
                <tr>
                    <th>Order ID </th>
                    <th>User ID</th>
                    <th>Total</th>
                    <th>Date </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $order['order_id']; ?></td>
                    <td><?php echo $order['user_id']; ?></td>
                    <td><?php echo $order['total']; ?></td>
                    <td><?php echo $order['order_date']; ?></td>
                </tr>
            </tbody>
                
                <label for="status">Order Status:</label>
                <select name="status" id="status">
                    <option value="Pending" <?php if ($order['status'] == 'Pending') echo 'selected'; ?>>Pending</option>
                    <option value="Shipped" <?php if ($order['status'] == 'Shipped') echo 'selected'; ?>>Shipped</option>
                    <option value="Delivered" <?php if ($order['status'] == 'Delivered') echo 'selected'; ?>>Delivered</option>
                    <option value="Cancelled" <?php if ($order['status'] == 'Cancelled') echo 'selected'; ?>>Cancelled</option>
                </select>
                </table>
                
                <br><br>
                <input type="submit" name="update" value="Update Status">
            </form>
        </div>
        <?php } else { ?>
            <p>No order details found.</p>
        <?php } ?>

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
