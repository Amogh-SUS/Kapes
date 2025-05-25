<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Kapes";

$message = "Please Enter The Details!"; // Initialize message variable
$totalAmount = 0; // Initialize total amount variable

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the product ID is provided
    if(isset($_POST["product_id"])) {
        $product_id = $_POST["product_id"];

        // Retrieve product type and price from the database
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("SELECT product_type, price FROM product WHERE product_id = ?");
        $stmt->bind_param("s", $product_id);
        $stmt->execute();
        $stmt->bind_result($product_type, $price);
        $stmt->fetch();
        $stmt->close();

        // Check if the product details were retrieved successfully
        if ($product_type !== null && $price !== null) {
            // Calculate total amount
            $quantity = $_POST["quantity"] ?? 0;
            $totalAmount = $price * $quantity;

            // Insert into customer table if form is submitted
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Retrieve other form data
                $name = $_POST["name"] ?? '';
                $age = $_POST["age"] ?? '';
                $phone = $_POST["phone"] ?? '';
                $address = $_POST["address"] ?? '';
                $email = $_POST["email"] ?? '';

                if (!empty($name) && !empty($age) && !empty($phone) && !empty($address) && !empty($email) && !empty($quantity)) {
                    // Create connection
                    $conn = new mysqli($servername, $username, $password, $dbname);

                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // Update total amount in customer table and retrieve it
                    $stmt = $conn->prepare("INSERT INTO customer (name, age, phone, address, email, product_id, product_type, quantity, total_amount) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                    $stmt->bind_param("sisssssii", $name, $age, $phone, $address, $email, $product_id, $product_type, $quantity, $totalAmount);

                    // Execute insertion
                    if ($stmt->execute()) {
                        // Close previous statement
                        $stmt->close();
                        
                        // Retrieve total amount from database
                        $stmt = $conn->prepare("SELECT total_amount FROM customer WHERE product_id = ?");
                        $stmt->bind_param("s", $product_id);
                        $stmt->execute();
                        $stmt->bind_result($totalAmount);
                        $stmt->fetch();
                        $stmt->close();

                        $message = "Your order was successful! A confirmation message will be sent to you through WhatsApp soon! Total Amount: Rs." . number_format($totalAmount, 2);
                    } else {
                        $message = "Error inserting data into database: " . $stmt->error;
                    }

                    $conn->close();
                } else {
                    $message = "Please Enter The Details!";
                }
            }
        } else {
            $message = "Error: Invalid product ID!";
        }
    } else {
        $message = "Error: Product ID is missing!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Form</title>
    <link rel="stylesheet" type="text/css" href="style-dark.css" id="dark-theme">
    <link rel="stylesheet" type="text/css" href="style-light.css" id="light-theme" disabled>
    <style>
        /* Your CSS styles here */
        .container {
            width: 30%; /* Adjust width for smaller screens */
            max-width: 500px; /* Set a maximum width */
            margin: 0 auto;
            background-color: peachpuff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        @media only screen and (max-width: 600px) {
            /* Adjustments for smaller screens */
            .container {
                width: 90%;
            }
        }
        input[type="text"], input[type="number"], input[type="tel"], input[type="email"], input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: orange;
            color: white;
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: orangered;
        }

        .success-message {
            text-align: center;
            padding: 20px;
            background-color: #4CAF50;
            color: white;
            border-radius: 4px;
        }

        #error-message {
            color: red;
            margin: 15px;
            text-align: center;
        }

        #total-price {
            font-weight: bold;
            text-align: center;
        }
    </style>
</head>
<body>
    <header>
        <img src="logo.png" alt="" width="60" height="60">
        <h1>Kapes</h1>
        <div class="home">
            <a href="chowta.html" style="text-decoration: none;">Home</a>
        </div>
        <button id="modeToggleButton">Theme</button>

        <div class="header-right">
            <input type="text" id="searchBar" placeholder="Search">
            <button id="loginButton">Login</button>
        </div>
    </header>
    <div class="container">
        <h2 style="text-align: center;">Order Form</h2>
        <br>
     
        <h3 id="error-message"><?php echo $message; ?></h3>
        <form id="orderForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit="return validateForm();">
            <!-- Form inputs -->
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required><br><br>

            <label for="age">Age:</label>
            <input type="number" id="age" name="age" required><br><br>

            <label for="phone">Phone:</label>
            <input type="tel" id="phone" name="phone" required><br><br>

            <label for="address">Address:</label>
            <input type="text" id="address" name="address" required><br><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br><br>

            <!-- Hidden input to store the product ID -->
            <input type="hidden" name="product_id" value="<?php echo isset($product_id) ? $product_id : ''; ?>">

            <input type="hidden" name="product_type" value="<?php echo isset($product_type) ? $product_type : ''; ?>">

            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" required><br><br>

        
   
            <input type="submit" value="Submit">
        </form>
    </div>
    <script>
        function validateForm() {
            let name = document.getElementById("name").value;
            let age = document.getElementById("age").value;
            let phone = document.getElementById("phone").value;
            let address = document.getElementById("address").value;
            let email = document.getElementById("email").value;
            let quantity = document.getElementById("quantity").value;

            var errorMessage = "";

            if (name.trim() == "") {
                errorMessage += "Please enter your name.\n";
            }
            if (age.trim() == "") {
                errorMessage += "Please enter your age.\n";
            }
            if (phone.trim() == "") {
                errorMessage += "Please enter your phone number.\n";
            }
            if (address.trim() == "") {
                errorMessage += "Please enter your address.\n";
            }
            if (email.trim() == "") {
                errorMessage += "Please enter your email address.\n";
            }
            if (quantity.trim() == "") {
                errorMessage += "Please enter the quantity.\n";
            }

            if (errorMessage !== "") {
                document.getElementById("error-message").innerText = errorMessage;
                return false; // Prevent form submission
            }
            
            return true; // Allow form submission
        }
    </script>

    <footer>
        <div id="aboutUs">About Us</div>
        <div id="contact">
            <a href="contactus.html" style="text-decoration: none;">Contact Us</a>
        </div>
        <div><a href="mailto:kapescollections@gmail.com" style="text-decoration: none;">Email: kapescollections@gmail.com</a></div>
        <div><a href="https://www.instagram.com/its.kapes/" style="text-decoration: none;">Social Media: its.kapes</a></div>
    </footer>
</body>
</html>
