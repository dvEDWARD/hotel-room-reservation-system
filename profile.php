<?php
session_start();
require_once 'config.php';
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
?>
<html>
<head>
	<title>Hotel Booking</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>
	<link rel="stylesheet" href="book.css">
	
</head>
<body>


<?php

// Verifica daca userul este logat,daca da va da display la content
if (isset($_SESSION['username'])) {
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
    // Daca nu este logat va da display la content-u asta
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

<?php
$username = $_SESSION['username']; // Înlocuiește cu utilizatorul dorit

$sql = "SELECT b.room_type, b.check_in_date, b.check_out_date, h.name AS hotel_name
        FROM bookings AS b
        INNER JOIN hotels AS h ON b.hotel_id = h.id
        WHERE b.username = '$username'
        ORDER BY b.check_in_date DESC";

$bookingsSql = "SELECT r.comment, r.created_at, h.name AS hotel_name
                FROM reviews AS r
                INNER JOIN hotels AS h ON r.hotel_id = h.id
                WHERE r.username = '$username'
                ORDER BY r.created_at DESC";

$bookingsResult = $conn->query($bookingsSql);

$result = $conn->query($sql);

// Verificarea și afișarea rezultatelor
if ($result->num_rows > 0) {
    echo '<br>';
    echo "<h2>Istoricul rezervărilor tale:</h2>";
    echo "<table>";
    echo "<tr>
            <th>Room Type</th>
            <th>Check-in Date</th>
            <th>Check-out Date</th>
            <th>Hotel Name</th>
          </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["room_type"] . "</td>
                <td>" . $row["check_in_date"] . "</td>
                <td>" . $row["check_out_date"] . "</td>
                <td>" . $row["hotel_name"] . "</td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "<p>Nu ai facut rezervări.</p>";
}

if ($bookingsResult->num_rows > 0) {
    echo '<br><br>';
    echo "<h2>Istoricul recenzilor tale:</h2>";
    echo "<table>";
    echo "<tr>
            <th>Review</th>
            <th>Hotel Name</th>
          </tr>";

    while ($row = $bookingsResult->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["comment"] . "</td>
                <td>" . $row["hotel_name"] . "</td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "<p>Nu ai facut nici o recenzie .</p>";
}


?>

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
<html>