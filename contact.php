<?php
session_start(); // Start a new session

require_once 'config.php';

$nameErr = $emailErr = $subjectErr = $messageErr = "";
$name = $email = $subject = $message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Get the values from the form
  $name = $_POST["nameInput"];
  $email = $_POST["emailInput"];
  $subject = $_POST["subjectInput"];
  $message = $_POST["messageInput"];

  // Validate the data
  $name = trim($name);
  $email = trim($email);
  $subject = trim($subject);
  $message = trim($message);

  if (empty($name)) {
      // Handle errors if name is empty
      $nameErr = "Name is required.";
  }
  if (empty($email)) {
      // Handle errors if email is empty
      $emailErr = "Email is required.";
  } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      // Handle errors if the email is invalid
      $emailErr = "Invalid email address.";
  }
  if (empty($subject)) {
      // Handle errors if subject is empty
      $subjectErr = "Subject is required.";
  }
  if (empty($message)) {
      // Handle errors if message is empty
      $messageErr = "Message is required.";
  }

  if (empty($nameErr) && empty($emailErr) && empty($subjectErr) && empty($messageErr)) {
      // Insert the data into the database
      $sql = "INSERT INTO Contact (name, email, subject, message)
              VALUES ('$name', '$email', '$subject', '$message')";

if ($conn->query($sql) === TRUE) {
  
  $response = array("success" => true);
} else {

  $response = array("success" => false, "error" => $conn->error);
}
echo json_encode($response);
  }
}

// Close the database connection
$conn->close();
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
    <?php

// Check if the user is logged in
if (isset($_SESSION['username'])) {
    // User is logged in
    // Display additional content or modify existing content
    echo '<nav class="navbar navbar-expand-lg navbar-light bg-light">';
    echo '  <div class="container-fluid">';
    echo '    <a class="navbar-brand" href="#">Hotel Booking</a>';
    echo '    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">';
    echo '      <span class="navbar-toggler-icon"></span>';
    echo '    </button>';
    echo '    <div class="collapse navbar-collapse" id="navbarNav">';
    echo '      <ul class="navbar-nav me-auto">';
    echo '        <li class="nav-item">';
    echo '          <a class="nav-link btns" href="index.php">Home</a>';
    echo '        </li>';
    echo '        <li class="nav-item">';
    echo '          <a class="nav-link btns" href="hotels.php">Hotels</a>';
    echo '        </li>';
    echo '        <li class="nav-item">';
    echo '          <a class="nav-link btns" href="contact.php">Contact</a>';
    echo '        </li>';
    echo '        <li class="nav-item">';
    echo '          <a class="nav-link btns" href="about.php">About us</a>';
    echo '        </li>';
    echo '      </ul>';
    echo '      <ul class="navbar-nav ml-auto">';
    echo '        <li class="nav-item dropdown">';
    echo '          <a class="nav-link dropdown-toggle btns" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">';
    echo '            '.$_SESSION['username'];
    echo '          </a>';
    echo '          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">';
    echo '            <li><a class="dropdown-item" href="profile.php">Profile</a></li>';
    echo '            <li><a class="dropdown-item" href="logout.php">Logout</a></li>';
    echo '          </ul>';
    echo '        </li>';
    echo '      </ul>';
    echo '    </div>';
    echo '  </div>';
    echo '</nav>';
} else {
    // User is not logged in
    // Display default content for non-logged-in users
    echo '<nav class="navbar navbar-expand-lg navbar-light bg-light">';
    echo '  <div class="container-fluid">';
    echo '    <a class="navbar-brand" href="#">Hotel Booking</a>';
    echo '    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">';
    echo '      <span class="navbar-toggler-icon"></span>';
    echo '    </button>';
    echo '    <div class="collapse navbar-collapse" id="navbarNav">';
    echo '      <ul class="navbar-nav me-auto">';
    echo '        <li class="nav-item">';
    echo '          <a class="nav-link btns" href="index.php">Home</a>';
    echo '        </li>';
    echo '        <li class="nav-item">';
    echo '          <a class="nav-link btns" href="hotels.php">Hotels</a>';
    echo '        </li>';
    echo '        <li class="nav-item">';
    echo '          <a class="nav-link btns" href="contact.php">Contact</a>';
    echo '        </li>';
    echo '        <li class="nav-item">';
    echo '          <a class="nav-link btns" href="about.php">About us</a>';
    echo '        </li>';
    echo '      </ul>';
    echo '      <ul class="navbar-nav">';
    echo '        <li class="nav-item">';
    echo '          <a id="login-button" class="nav-link login-btn" href="login.php">Login</a>';
    echo '        </li>';
    echo '        <li class="nav-item">';
    echo '          <a id="register-button" class="nav-link login-btn" href="register.php">Register</a>';
    echo '        </li>';
    echo '      </ul>';
    echo '    </div>';
    echo '  </div>';
    echo '</nav>';
}
?>

    <div id="contact-form">
    <h2>Send a Message</h2>
      <form method="post" action="contact.php" id="contactForm">
  <div class="mb-3">
    <label for="nameInput" class="form-label">Name</label>
    <input type="text" class="form-control" id="nameInput" placeholder="Enter your name" required name="nameInput">
    <?php if (!empty($nameErr)): ?>
        <div class="alert alert-danger"><?php echo $nameErr; ?></div>
      <?php endif; ?>
  </div>
  <div class="mb-3">
    <label for="emailInput" class="form-label">Email</label>
    <input type="email" class="form-control" id="emailInput" placeholder="Enter your email" required name="emailInput">
    <?php if (!empty($emailErr)): ?>
        <div class="alert alert-danger"><?php echo $emailErr; ?></div>
      <?php endif; ?>
  </div>
  <div class="mb-3">
    <label for="subjectInput" class="form-label">Subject</label>
    <input type="text" class="form-control" id="subjectInput" placeholder="Enter subject" required name="subjectInput">
    <?php if (!empty($subjectErr)): ?>
        <div class="alert alert-danger"><?php echo $subjectErr; ?></div>
      <?php endif; ?>
  </div>
  <div class="mb-3">
    <label for="messageInput" class="form-label">Message</label>
    <textarea class="form-control" id="messageInput" rows="5" placeholder="Enter your message" required name="messageInput"></textarea>
    <?php if (!empty($messageErr)): ?>
        <div class="alert alert-danger"><?php echo $messageErr; ?></div>
      <?php endif; ?>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
<div id="successMsg" style="display:none;"></div>
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
    <script
      src="https://code.jquery.com/jquery-3.6.0.min.js"
      integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
      crossorigin="anonymous"
    ></script>
  <script src="index.js"></script>

  <script>
document.getElementById("contactForm").addEventListener("submit", function(event) {
  // Sa nu mai trimitem 100 de form-uri 
  event.preventDefault();
  
  // Luam datele dinf orm 
  var formData = new FormData(document.getElementById("contactForm"));
  
  // dam submit la form cu  AJAX
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      // Afisarea mesajului de success fara sa se dea refresh la pagina
      document.getElementById("successMsg").innerHTML = "Message sent successfully!";
      document.getElementById("successMsg").style.display = "block";
      
      // curatarea form-ului dupa trimitere
      document.getElementById("contactForm").reset();
    }
  };
  xhr.open("POST", "contact.php", true);
  xhr.send(formData);
});
</script>

    </body>
</html>