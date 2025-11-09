<script type="text/javascript">
document.addEventListener('DOMContentLoaded', () => {
    console.log('DOM fully loaded and parsed');
    document.querySelectorAll('.add-to-cart').forEach(button => {
        button.addEventListener('click', handleAddToCart);
    });
});

function handleAddToCart(event) {
    const button = event.target;
    button.disabled = true; // Disable the button to prevent double submissions

    const productItem = button.closest('.product-item');
    const productName = productItem.querySelector('input[name="product_name"]').value;
    const productPrice = productItem.querySelector('input[name="product_price"]').value;
    const productImage = productItem.querySelector('input[name="product_image"]').value;
    const productDescription = productItem.querySelector('input[name="product_description"]').value;

    fetch('product.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: new URLSearchParams({
            add_to_cart: 'true',
            product_name: productName,
            product_price: productPrice,
            product_image: productImage,
            product_description: productDescription
        })
    })
    .then(response => response.text())
    .then(data => {
        console.log('Response from product.php:', data);
        alert('Product added to cart!');
        loadCart();
    })
    .catch(error => console.error('Error:', error))
    .finally(() => {
        button.disabled = false; // Re-enable the button after processing
    });
}
</script>

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

if (isset($_POST['add_to_cart'])) {
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = 1;
    $product_description = $_POST['product_description'];

    // Use prepared statements to avoid SQL injection and potential duplicate entries
    $stmt = $conn->prepare("SELECT * FROM cart WHERE name = ?");
    $stmt->bind_param("s", $product_name);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $message[] = 'Product already added to cart';
    } else {
        $stmt = $conn->prepare("INSERT INTO cart (name, price, image, quantity, description) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssis", $product_name, $product_price, $product_image, $product_quantity, $product_description);
        $stmt->execute();
        $message[] = 'Product added to cart successfully';
    }
    $stmt->close();
}

// Fetch products from the database
$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/product.css">
	<script type="text/javascript" src="JS/cart.js"></script>

<title>EVARA: Product Page</title>

<link rel="shortcut icon" href="pics/icon.png" type="image/x-icon">

</head>
<body>
<header>
         <div class="logo"><b>EVARA</b></div>
<!--------------------------------------------------- Navigation bar ---------------------------------------------------------------->
    <nav>
         <ul>
            <li><a href="index.php"><b>Home</b></a></li>
            <li><a href="product.php"><b>Products</b></a></li>
            <li><a href="customize.php"><b>Customize</b></a></li>
            <li><a href="cart.php"><b>Cart</b></a></li>
            <li><a href="loginORsignup.php"><b>Account</b></a></li>
            <li><a href="support.php"><b>Support &nbsp;</b></a></li>
        </ul>
    </nav>
</header>
<main>

<!-----------------------------------------------Section for EvaraProducts----------------------------------------------------------->
<section class="Evara_Products">

<!-------------------------------------------------Gold Priducts-------------------------------------------------------------------->
<div class="category">
    <h2>Gold Products</h2>
    <div class="product-grid gold">
        <?php
        // Fetch gold products
        $sql_gold = "SELECT * FROM products WHERE category='gold'";
        $result_gold = $conn->query($sql_gold);

        if ($result_gold->num_rows > 0) {
            while($row = $result_gold->fetch_assoc()) {
                echo '<div class="product-item">';
                echo '<img src="pics/' . $row['image'] . '" alt="' . $row['name'] . '">';
                echo '<h3>' . $row['name'] . '</h3>';
                echo '<p>' . $row['description'] . '</p>';
                echo '<p class="price">Rs ' . $row['price'] . '</p>';
                echo '<form method="post" action="product.php">';
                echo '<input type="hidden" name="product_name" value="' . $row['name'] . '">';
                echo '<input type="hidden" name="product_price" value="' . $row['price'] . '">';
                echo '<input type="hidden" name="product_image" value="' . $row['image'] . '">';
                echo '<input type="hidden" name="product_description" value="' . $row['description'] . '">';
                echo '<button type="submit" name="add_to_cart" class="add-to-cart">Add to Cart</button>';
                echo '</form>';
                echo '</div>';
            }
        } else {
            echo "No products available.";
        }
        ?>
    </div>
</div>
<!-------------------------------------------------Silver Priducts------------------------------------------------------------------>
<div class="category">
    <h2>Silver Products</h2>
    <div class="product-grid silver">
        <?php
        // Fetch silver products
        $sql_silver = "SELECT * FROM products WHERE category='silver'";
        $result_silver = $conn->query($sql_silver);

        if ($result_silver->num_rows > 0) {
            while($row = $result_silver->fetch_assoc()) {
                echo '<div class="product-item">';
                echo '<img src="pics/' . $row['image'] . '" alt="' . $row['name'] . '">';
                echo '<h3>' . $row['name'] . '</h3>';
                echo '<p>' . $row['description'] . '</p>';
                echo '<p class="price">Rs ' . $row['price'] . '</p>';
                echo '<form method="post" action="product.php">';
                echo '<input type="hidden" name="product_name" value="' . $row['name'] . '">';
                echo '<input type="hidden" name="product_price" value="' . $row['price'] . '">';
                echo '<input type="hidden" name="product_image" value="' . $row['image'] . '">';
                echo '<input type="hidden" name="product_description" value="' . $row['description'] . '">';
                echo '<button type="submit" name="add_to_cart" class="add-to-cart">Add to Cart</button>';
                echo '</form>';
                echo '</div>';
            }
        } else {
            echo "No products available.";
        }
        ?>
    </div>
</div>
<!----------------------------------------------------------------Pearl Priducts----------------------------------------------------------------------------->
<div class="category">
    <h2>Pearl Products</h2>
    <div class="product-grid pearl">
        <?php
        // Fetch pearl products
        $sql_pearl = "SELECT * FROM products WHERE category='pearl'";
        $result_pearl = $conn->query($sql_pearl);

        if ($result_pearl->num_rows > 0) {
            while($row = $result_pearl->fetch_assoc()) {
                echo '<div class="product-item">';
                echo '<img src="pics/' . $row['image'] . '" alt="' . $row['name'] . '">';
                echo '<h3>' . $row['name'] . '</h3>';
                echo '<p>' . $row['description'] . '</p>';
                echo '<p class="price">Rs ' . $row['price'] . '</p>';
                echo '<form method="post" action="product.php">';
                echo '<input type="hidden" name="product_name" value="' . $row['name'] . '">';
                echo '<input type="hidden" name="product_price" value="' . $row['price'] . '">';
                echo '<input type="hidden" name="product_image" value="' . $row['image'] . '">';
                echo '<input type="hidden" name="product_description" value="' . $row['description'] . '">';
                echo '<button type="submit" name="add_to_cart" class="add-to-cart">Add to Cart</button>';
                echo '</form>';
                echo '</div>';
            }
        } else {
            echo "No products available.";
        }
        ?>
    </div>
</div>

</section>
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

<!------------------------------------------------Customization Section------------------------------------------------------------->
	
    <div class="customization-section">
        <h2>Customize Your Jewelry</h2>
        <p>Choose from a variety of customization options to create a unique piece of jewelry just for you.</p>
        <br>
        <a href="customize.php" target="_blank"><button class="customize-button">Customize</button></a>
    </div>
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
<!--------------------------------------------------Social media buttons------------------------------------------------------------>

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