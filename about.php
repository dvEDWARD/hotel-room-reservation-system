<?php
session_start();
require_once 'config.php';


?>

<!DOCTYPE html>
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

<div class="container">
    <h1>About Hotel Booking 2023</h1>
    <p>Welcome to Hotel Booking 2023, a project aimed at simplifying the hotel booking experience for travelers around the world.</p>
    <p>At Hotel Booking 2023, we believe that travel should be accessible to everyone. That's why we have curated a wide range of hotels, from budget-friendly options to luxury resorts, so that travelers can find accommodations that fit their preferences and budget.</p>
    <p>Thank you for choosing Hotel Booking 2023 for your travel needs. We hope that our platform makes your next travel experience more enjoyable and stress-free.</p>
  </div>

  <section class="location">
  <h2>Location</h2>
  <div class="mapouter">
    <div id="map">
      <div class="gmap_canvas">
        <iframe width="600" height="500" id="gmap_canvas" src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d4000.7128446712713!2d25.87619217753668!3d44.84333957965121!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sro!2sro!4v1680974186373!5m2!1sro!2sro" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
    </div>
  </div>
</section>

<footer>
  <div class="container-fluid">
    <div class="row justify-content-between">
      <div class="col-md-4">
        <h5>Address</h5>
        <p>Prahova,Ploiesti Str.Bahluiului</p>
      </div>
      <div class="col-md-4 text-center">
        <h5>Email</h5>
        <p>HotelBooking@yahoo.com</p>
      </div>
      <div class="col-md-4 text-end">
        <h5>Phone</h5>
        <p>+40 736 125 973</p>
      </div>
    </div>
    <hr>
    <div class="row justify-content-between">
      <div class="col-md-6">
        <p>&copy; 2023 Hotel Booking. All rights reserved.</p>
      </div>
      <div class="col-md-6 text-end">
        <ul class="list-inline">
          <li class="list-inline-item"><a class="privacy-policy" href="privacy-policy.php">Privacy Policy</a></li>
          <li class="list-inline-item"><a class="terms-conditions" href="terms-conditions.php">Terms & Conditions</a></li>
        </ul>
      </div>
    </div>
  </div>
</footer>


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
  
  

</body>
</html>