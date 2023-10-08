<?php
session_start(); // Start a new session

require_once 'config.php'; // Include database configuration

// eror
$error_msg = "";

// verificam daca form-ul a fost trimis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Verificam daca user-ul este in baza de date
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);
    if ($result->num_rows == 0) {
        $error_msg = "Incorrect username or password. Please try again.";
    } else {
        // Verify password
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            $_SESSION["username"] = $username; // Set session variable
            // Redirect catre index.php 
            header("Location: index.php");
            exit;
        } else {
            $error_msg = "Incorrect username or password. Please try again.";
        }
    }
}

$conn->close(); // Close database connection
?>

<html>
    <head>
        <title>Hotel Booking</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>
        <link rel="stylesheet" href="loginregister.css">
    </head>
    <body>
        <div id="login-form">
            <button id="close-login-form" class="close-btn" onclick="window.location.href = 'index.php';">&times;</button>
            <form method="post" action="login.php">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary" id="login-btn">Login</button>
                <?php if ($error_msg != ""): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error_msg; ?>
                    </div>
                <?php endif; ?>
            </form>
            <p>Don't have an account? <a href="register.php">Click here</a> to register.</p>
        </div>

        <div class="swiper-container">
  <div class="swiper-wrapper">
    <div class="swiper-slide"><img src="photos2/image1.jpg"></div>
    <div class="swiper-slide"><img src="photos2/image2.jpg"></div>
    <div class="swiper-slide"><img src="photos2/image3.jpg"></div>
  </div>
  <div class="swiper-pagination"></div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="index.js"></script>

    </body>
</html>