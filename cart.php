<?php
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

$action = $_GET['action'] ?? '';
$id = $_GET['id'] ?? '';

if ($action === 'load') {
    echo json_encode(loadCart());
    exit;
}

if ($action === 'remove') {
    removeItem($id);
    echo json_encode(loadCart());
    exit;
}

if ($action === 'update') {
    $data = json_decode(file_get_contents('php://input'), true);
    updateItem($id, $data);
    echo json_encode(loadCart());
    exit;
}

if ($action === 'placeOrder') {
    $orderData = $_POST;
    $result = placeOrder($orderData);
    echo json_encode(['success' => $result]);
    exit;
}

function loadCart() {
    global $conn;
    $cartItems = [];
    
    $query = "SELECT * FROM cart";
    $result = $conn->query($query);
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $cartItems[$row['id']] = [
                'name' => $row['name'],
                'price' => $row['price'],
                'image' => $row['image'],
                'quantity' => $row['quantity'],
                'description' => $row['description']
            ];
        }
    }
    return $cartItems;
}

function removeItem($id) {
    global $conn;
    $query = "DELETE FROM cart WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

function updateItem($id, $data) {
    global $conn;
    $quantity = intval($data['quantity']);
    
    $query = "UPDATE cart SET quantity = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $quantity, $id);
    $stmt->execute();
}

function placeOrder($orderData) {
    global $conn;

    // Get user data from orderData
    $name = $orderData['name'];
    $email = $orderData['email'];
    $address = $orderData['address'];
    $paymentMethod = $orderData['payment'];

    // Get user_id from session or create a guest order
    $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;

    // Begin transaction (optional but safer for multiple inserts)
    $conn->begin_transaction();

    try {
        // Get cart items and calculate total
        $cartItems = loadCart();
        $total = 0;
        foreach ($cartItems as $cartItem) {
            $total += $cartItem['price'] * $cartItem['quantity'];
        }

        // Insert into orders table
        $query = "INSERT INTO orders (user_id, total, status) VALUES (?, ?, 'pending')";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("id", $userId, $total);
        
        if (!$stmt->execute()) {
            throw new Exception("Error inserting into orders: " . $stmt->error);
        }

        // Get the inserted order ID
        $orderId = $stmt->insert_id;

        // Loop through each cart item and insert into order_items
        foreach ($cartItems as $cartItemId => $cartItem) {
            $productId = $cartItemId;  // Using cart item ID as product ID
            $quantity = $cartItem['quantity'];
            $material = 'default';  // If you have a material field, you can adjust this

            $query = "INSERT INTO order_items (order_id, product_id, quantity, material) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("iiis", $orderId, $productId, $quantity, $material);

            if (!$stmt->execute()) {
                throw new Exception("Error inserting into order_items: " . $stmt->error);
            }
        }

        // Clear cart after successful order placement
        $query = "DELETE FROM cart";
        if (!$conn->query($query)) {
            throw new Exception("Error clearing cart: " . $conn->error);
        }

        // Commit transaction
        $conn->commit();
        return true;

    } catch (Exception $e) {
        // Rollback transaction if something goes wrong
        $conn->rollback();
        error_log($e->getMessage());  // Log the error message
        return false;
    }
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/cart.css">
    <link rel="stylesheet" href="CSS/style.css">
    <title>EVARA: Cart Page</title>
    <link rel="shortcut icon" href="pics/icon.png" type="image/x-icon">
	<script type="text/javascript" src="JS/cart.js"></script>
    <style>
        /* General Cart Table Styling */
        .cart-table {
            max-width: auto;
            margin: 20px auto;
            border-collapse: collapse;
            border-radius: 8px;
            overflow: hidden;
        }

        .cart-table thead {
            background-color:  #146744;
            color: #fff;
            text-align: left;
        }

        .cart-table th, .cart-table td {
            padding: 15px;
            text-align: center;
        }

        .cart-table th {
            font-weight: bold;
            text-transform: uppercase;
        }

        .cart-table tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        /* Cart Image Styling */
        .cart-image {
            max-width: 100px;
            max-height: 100px;
            border-radius: 8px;
            object-fit: cover;
        }

        /* Cart Item Details */
        .item-name {
            font-size: 18px;
            font-weight: 600;
        }

        .item-description {
            font-size: 14px;
            color: #666;
        }

        .item-price {
            font-size: 16px;
            font-weight: bold;
            color: #333;
        }

        /* Quantity Input Styling */
        .item-quantity input[type="number"] {
            width: 60px;
            padding: 5px;
            font-size: 16px;
            text-align: center;
            border: 1px solid #ddd;
            border-radius: 5px;
            outline: none;
        }

        .item-quantity input[type="number"]:focus {
            border-color: #333;
        }

        /* Button Styling */
        .remove-from-cart {
            background-color: #ff6666;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .remove-from-cart:hover {
            background-color: #ff4d4d;
        }
    </style>
    
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
        <h1>Your Shopping Cart</h1>
<!--------------------------------------------------Section for Cart---------------------------------------------------------------->

        <section class="cart">
        <table class="cart-table">
            <thead>
                <tr class="headings">
                    <th>Item</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>if u wanna remove</th>
                    
                </tr>
            </thead>
        </table>
           
        </section>
        <section class="cart-total">
            <div class="total-label">Total:</div>
            <div class="total-amount" id="totalAmount">Rs 0</div>
        </section>
        <div class="checkout">
            <button class="checkout-btn" id="checkoutBtn">Proceed to Checkout</button>
        </div>
        <section class="order-details">
            <h2>Order Details</h2>
            <form id="orderForm" action="cart.php" method="POST">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="address">Shipping Address:</label>
                    <textarea id="address" name="address" rows="4" required></textarea>
                </div>
                <div class="form-group">
                    <label for="payment">Payment Method:</label>
                    <select id="payment" name="payment" required>
                        <option value="credit-card">Credit Card</option>
                        <option value="debit-card">Debit Card</option>
                        <option value="paypal">PayPal</option>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="submit-btn">Place Order</button>
                </div>
            </form>
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
<!----------------------------------------------- Section for footer --------------------------------------------------------->
    <footer>
<!------------------------------------------------Social media buttons-------------------------------------------------------------->

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