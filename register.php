<?php
session_start();
require_once 'config.php'; 

$username_err = $email_err = "";
$password_match = $password_long = "";


// verificam daca form-u a fost trimis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm-password"];
    $email = $_POST["email"];
    if ($password !== $confirm_password) {
      $password_match = "Password and confirm password fields must match.";
  } elseif (strlen($password) < 8) {
        $password_long = "Password must be at least 8 characters long.";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $email_err = "Invalid email format.";
    } else {
        // Verifica daca email-u este deja folosit in baza de date
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
          $email_err = "Email already exists.";
        } else {
            // Verificam daca user-ul este in baza de date si afisam o eroare in caz de este,daca inregistreaza user-ul in baza de date.
            $sql = "SELECT * FROM users WHERE username = '$username'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
              $username_err = "Username already exists.";
            } else {
                // Inregistreaza user-ul
                $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hashurarea parolei 
                $sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$hashed_password', '$email')";
                if ($conn->query($sql) === TRUE) {
                    ob_start(); // Start output buffering
                    $_SESSION['message'] = "You have successfully registered!";
                    ob_end_flush(); // Send buffered output to browser
                    header("Location: index.php?success=1");
                    exit(); // End script execution after redirect
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
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
<div id="register-form">
<button id="close-login-form" class="close-btn" onclick="window.location.href = 'index.php';">&times;</button>
  <form method="post" action="register.php">
    <div class="mb-3">
      <label for="username" class="form-label">Username</label>
      <input type="text" class="form-control" id="username" name="username">
      <?php if (!empty($username_err)): ?>
        <div class="alert alert-danger"><?php echo $username_err; ?></div>
      <?php endif; ?>
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      <input type="password" class="form-control" id="password" name="password">
      <?php if (!empty($password_long)): ?>
        <div class="alert alert-danger"><?php echo $password_long; ?></div>
      <?php endif; ?>
    </div>
    <div class="mb-3">
      <label for="confirm-password" class="form-label">Confirm Password</label>
      <input type="password" class="form-control" id="confirm-password" name="confirm-password">
      <?php if (!empty($password_match)): ?>
        <div class="alert alert-danger"><?php echo $password_match; ?></div>
      <?php endif; ?>
    </div>
    <div class="mb-3">
      <label for="email" class="form-label">Email</label>
      <input type="email" class="form-control" id="email" name="email">
      <?php if (!empty($email_err)): ?>
        <div class="alert alert-danger"><?php echo $email_err; ?></div>
      <?php endif; ?>
    </div>
    <button type="submit" class="btn btn-primary">Register</button>
  </form>
  <p>Already have an account? <a href="login.php">Click here</a> to login.</p>
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