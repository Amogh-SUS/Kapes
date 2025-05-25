<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,300;0,400;0,500;0,600;1,200;1,300&display=swap" rel="stylesheet">
<link rel="stylesheet" href="dark.css">
    <script src="dark.js" defer></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <style>
    .product-item {
    width: 400px; /* Adjust the width of the container */
     }
     .order {
            background-color: #4CAF50; /* Green */
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-top: 10px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        /* Change button color on hover */
        .order:hover {
            background-color: #45a049;
        }
    </style>

</head>

<body>
    <nav>
        <img src="images/logo.png" alt="" class="logo">
        <ul id="menu-links">
            <li><a href="index.html">Home</a></li>
            <li><a href="http://localhost/cwh/tshirts.php">T-shirts</a></li>
            <li><a href="http://localhost/cwh/mousepads.php">Mousepads</a></li>
            <li><a href="http://localhost/cwh/mugs.php">Mugs</a></li>
            <li><i class="bi bi-brightness-high-fill" id="toggleDark"></i></li>
    
        </ul>
        <button class="nav-btn" onclick="window.location.href='contactus.html'">Contact Us <img src="images/arrow-white.png" alt=""></button>
        <img src="images/menu.png" alt="" class="menu-icon" onclick="toogleMenu()">
    </nav>
    <div class="header">
        <div class="title">
            <h1>Mugs</h1><center><hr></center><br><br>
            <p>Please contact us for customization</p>
        </div>
        <div class="product-center">
            <div class="product-item">
                <div class="overlay">
                        <img src="products/mug1.jpg" alt="" class="product-thumb">
                    </div>
                <div class="product-info">
                    <span>Mug</span>
                    <h4>Rs 299</h4><br>
                    <button class="order" onclick="order('M001')">Order</button>
                </div>
            </div>
            <div class="product-item">
                <div class="overlay">
                        <img src="products/mug2.jpg" alt="" class="product-thumb">
                    </div>
                <div class="product-info">
                    <span>Mug</span>
                    <h4>Rs 349</h4><br>
                    <button class="order" onclick="order('M002')">Order</button>
                </div>
            </div>
        </div>
        <div class="product-item">
            <div class="overlay">
                    <img src="products/mug3.jpg" alt="" class="product-thumb">
                </div>
            <div class="product-info">
                <span>mug</span>
                <h4>Rs 399</h4><br>
                <button class="order" onclick="order('M003')">Order</button>
            </div>
        </div>
    </div>
    <br><br><br>

        


    <footer>
        <div class="footerContainer">
            <div class="icons">
    
                
                <a href="https://www.instagram.com/its.kapes/"><i class="fa-brands fa-instagram"></i></a>
                <a href=""><i class="fa-brands fa-twitter"></i></a>
                
            </div>
            <div class="footerNav">
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="">About us</a></li>      
                    <li><a href="mailto:kapescollections@gmail.com">Email</a></li> 
                    <li><a href="contactus.html">Contact</a></li> 
                    <li><a href="#">Team</a></li> 
                </ul>
                </div>
            </div>
            <div class="footerBottom">
                <p>Copyright &copy;2024: Designed by designed by ..</p>
            </div>
    
    </footer>


    
<script src="script.js"></script>
<script>
    let navbar = document.querySelector('nav');
    let menuLinks = document.getElementById("menu-links")

    function toogleMenu(){
        menuLinks.classList.toogle('show-menu');

    }



    window.onscroll = function(){
        if(window.scrollY > 0){
            navbar.style.background = '#eefff9';
        }
        else{
            navbar.style.background = 'transparent';
        }

    }

    function order(productId) {
            // Create a form element
            var form = document.createElement('form');
            form.method = 'post';
            form.action = 'order.php';

            // Create an input element to hold the product ID
            var input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'product_id';
            input.value = productId;

            // Append the input to the form
            form.appendChild(input);

            // Append the form to the document body and submit it
            document.body.appendChild(form);
            form.submit();
        }

</script>
</body>
</html>