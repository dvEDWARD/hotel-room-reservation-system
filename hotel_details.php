<?php
session_start();
require_once 'config.php';

// Se verifica daca form-u a fost trimit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the user is logged in
    if (isset($_SESSION['username'])) {
        $comment = $_POST['comment'];
        $hotelId = $_POST['hotel_id'];
        $username = $_SESSION['username'];

        // Get the user ID based on the username
        $userIdQuery = "SELECT id FROM users WHERE username = '$username'";
        $userIdResult = mysqli_query($conn, $userIdQuery);
        $userIdRow = mysqli_fetch_assoc($userIdResult);
        $userId = $userIdRow['id'];

        // Insert la review in table-u comments
        $insertQuery = "INSERT INTO reviews (hotel_id, id, comment, username) VALUES ($hotelId, NULL, '$comment', '$username')";
        mysqli_query($conn, $insertQuery);

        // redirect la aceeasi pagina in caz de userul da refresh la pagina si se trimite de 2 ori form-u
        header("Location: {$_SERVER['PHP_SELF']}?id=$hotelId");
        exit();
    }
}
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
	<link rel="stylesheet" href="hotel.css">
	
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
$id = $_GET['id'];

$query = "SELECT * FROM hotels WHERE id = $id";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    // Extract details
    $name = $row["name"];
    $location = $row["location"];
    $description = $row["description"];
    $facilities = $row["facilities"];
    $price = $row["price"];
    $rooms = $row["rooms"];
    $stars = $row["stars"];
    $photoCount = 4; // Total number of photos for a hotel

    // Determine the current photo index
    $currentPhoto = isset($_GET['photo']) ? intval($_GET['photo']) : ($photoCount > 0 ? 1 : 0);
    if ($currentPhoto < 1 || $currentPhoto > $photoCount) {
        $currentPhoto = $currentPhoto < 1 ? $photoCount : 1; // Set the default photo index to the last photo or 1 if no photos
    }

    $hasRestaurant = strpos($facilities, 'restaurant') !== false;


    // Construct the photo file name based on the current photo index
    $photoFileName = $name . '_' . $currentPhoto . '.jpg';

    // Display the hotel details and current photo
    echo '<div class="card" style="width: 40rem; margin: 40px auto;">';
    echo '<div class="hotels">';
    echo '<div class="photo-container">';
    
    // Display the current photo
    echo '<div class="hotel-image-box"><img id="hotel-photo" src="images/' . $photoFileName . '" alt="' . $name . '"></div>';
    
    // Display navigation arrows for photo change
    echo '<div class="photo-navigation">';
    echo '<a class="arrow-left" href="?id=' . $id . '&photo=' . ($currentPhoto > 1 ? $currentPhoto - 1 : $photoCount) . '">&lt;</a>';
    echo '<a class="arrow-right" href="?id=' . $id . '&photo=' . ($currentPhoto < $photoCount ? $currentPhoto + 1 : 1) . '">&gt;</a>';
    echo '</div>';
    echo '</div>';
    echo '<h2>' . $name . '</h2>';
    echo '<h3>' . $location . '</h3>';
    echo '<p>' . $description . '</p>';
    echo '<ul>';
    foreach (explode(',', $facilities) as $facility) {
        echo '<li>' . $facility . '</li>';
    }
    echo '</ul>';
    echo '<div class="prices">';
    echo '<div class="standard-price">Rooms: €' . $price . ' per night</div>';
    echo '<div class="stars">Number of stars: ' . $stars . '</div>';
    echo '</div>';
    echo '<br>';

    if ($hasRestaurant) {
      echo "<p>Acest hotel are restaurant.</p>";
      echo "<p>Orele de servire a meselor pentru restaurantul nostru sunt:</p>";
      echo "<p>Masa de după-amiază: 14:00 - 17:00</p>";
      echo "<p>Cina: 18:30 - 22:00</p>";
    }
    


    

    if (isset($_SESSION['username'])) {
        echo '<form action="book.php" method="post">';
        echo '<input type="hidden" name="hotel_id" value="' . $id . '">';

        // Check-in date input
        echo '<label for="check_in_date">Check-in Date:</label>';
        echo '<input type="date" id="check_in_date" name="check_in_date" required>';

        // Check-out date input
        echo '<label for="check_out_date">Check-out Date:</label>';
        echo '<input type="date" id="check_out_date" name="check_out_date" required>';

        echo '<br><br>';

        // Room type selection
        echo '<label for="room_type">Room Type:</label>';
        echo '<select id="room_type" name="room_type" required onchange="showRoomDescription()">';
        echo '<option value="">Alegeți tipul de camera</option>';
        echo '<option value="apartment">Apartment</option>';
        echo '<option value="standard room">Standard Room</option>';
        echo '<option value="triple room">Triple Room</option>';
        echo '<option value="quad room">Quad Room</option>';
        echo '</select>';
        echo '<br>';
        echo '<div id="room_description"></div>';

        echo '<br><br>';

        echo '<div>';
        echo '<label for="breakfast">Mic dejun:</label>';
        echo '<select id="breakfast" name="breakfast" required onchange="showDescription()">';
        echo '<option value="">Alegeți tipul de mic dejun</option>';
        echo '<option value="continental">Mic dejun continental</option>';
        echo '<option value="american">Mic dejun american</option>';
        echo '<option value="bufet">Mic dejun bufet</option>';
        echo '<option value="englezesc">Mic dejun englezesc</option>';
        echo '<option value="sănătos">Mic dejun sănătos</option>';
        echo '</select>';
        echo '</div>';
        echo '<div id="description"></div>';

        echo '<br><br>';
        

        echo '<input type="submit" value="Book Now" class="btn btn-primary">';
        echo '</form>';
    } else {
        echo '<label for="check_in_date">Check-in Date:</label>';
        echo '<input type="date" id="check_in_date" name="check_in_date" required>';
        echo '<label for="check_out_date">Check-out Date:</label>';
        echo '<input type="date" id="check_out_date" name="check_out_date" required>';
        echo '<br><br>';
        echo '<label for="room_type">Room Type:</label>';
        echo '<select id="room_type" name="room_type" required onchange="showRoomDescription()">';
        echo '<option value="apartment">Apartment</option>';
        echo '<option value="standard room">Standard Room</option>';
        echo '<option value="triple room">Triple Room</option>';
        echo '<option value="quad room">Quad Room</option>';
        echo '</select>';
        echo '<br>';
        echo '<div id="room_description"></div>';
        echo '<br><br>';
        echo '<div>';
        echo '<label for="breakfast">Mic dejun:</label>';
        echo '<select id="breakfast" name="breakfast" required onchange="showDescription()">';
        echo '<option value="">Alegeți tipul de mic dejun</option>';
        echo '<option value="continental">Mic dejun continental</option>';
        echo '<option value="american">Mic dejun american</option>';
        echo '<option value="bufet">Mic dejun bufet</option>';
        echo '<option value="englezesc">Mic dejun englezesc</option>';
        echo '<option value="sănătos">Mic dejun sănătos</option>';
        echo '</select>';
        echo '</div>';
        echo '<br>';
        echo '<div id="description"></div>';

        echo '<br><br>';

        echo '<p>You must be logged in to book this hotel. <a href="login.php">Log in</a> or <a href="register.php">register</a>.</p>';

    }

    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
  }
?>

<script>
  function showDescription() {
    var breakfast = document.getElementById("breakfast").value;
    var description = "";

    // Set the description based on the selected breakfast option
    switch (breakfast) {
      case "continental":
        description = "Mic dejun continental conține produse de patiserie, pâine, cereale, fructe, cafea și ceai.";
        break;
      case "american":
        description = "Mic dejun american include ouă, bacon, șuncă, cartofi prăjiți, iaurt, cereale, fructe și băuturi calde.";
        break;
      case "bufet":
        description = "Mic dejun bufet oferă o varietate mai mare de opțiuni, cum ar fi ouă preparate în diferite stiluri, mezeluri, brânzeturi, salate, cereale, prăjituri și multe altele.";
        break;
      case "englezesc":
        description = "Mic dejun englezesc include ouă fierte sau ochiuri, bacon, cârnați, fasole în sos de roșii, ciuperci, roșii și pâine prăjită.";
        break;
      case "sănătos":
        description = "Mic dejun sănătos se concentrează pe opțiuni mai sănătoase, cum ar fi iaurturi, fructe proaspete, fulgi de ovăz, cereale integrale și smoothie-uri.";
        break;
    }

    // Update the description element with the selected breakfast description
    document.getElementById("description").textContent = description;
  }
  window.onload = showDescription;
</script>

<script>
function showRoomDescription() {
  var roomType = document.getElementById("room_type").value;
  var description = "";
  
  switch (roomType) {
    case "apartment":
      description = "Apartamentul este o cazare spațioasă și complet echipată, cu zone separate pentru living și dormitor.";
      break;
    case "standard room":
      description = "Camera standard este o cazare confortabilă și bine utilată, cu facilități esențiale pentru o ședere plăcută.";
      break;
    case "triple room":
      description = "Camera triple este o cameră mai mare potrivită pentru cazarea a trei persoane, cu paturi suplimentare și facilități adiționale.";
      break;
    case "quad room":
      description = "Camera quad este o cameră spațioasă concepută pentru cazarea a patru persoane în mod confortabil, cu spațiu generos și facilități.";
      break;
  }
  
  document.getElementById("room_description").textContent = description;
}
document.addEventListener("DOMContentLoaded", showRoomDescription);
  </script>
<br>
<div class="faq-section">
  <h2>Întrebări frecvente</h2>
  <br>
  <div class="faq">
    <h3>1. Ce metode de plată acceptați?</h3>
    <p>Se acceptă plata doar prin cardul de credit.</p>
  </div>
  
  <div class="faq">
    <h3>2. Pot face o rezervare fără un card de credit?</h3>
    <p>Nu,nu poti face o rezervare fără un card de credit.</p>
  </div>
  
  <div class="faq">
    <h3>3. Pot rezerva mai multe camere în același timp?</h3>
    <p>Da,se pot rezerva mai multe camere în același timp.</p>
  </div>
  
  <div class="faq">
    <h3>4. Ce tipuri de camere sunt disponibile?</h3>
    <p>Standard room,apartment,triple room și quad room.</p>
  </div>
  
  <div class="faq">
    <h3>5. Care sunt orele de check-in și check-out?</h3>
    <p>Ora de check-in este în jurul orei 14:00, iar ora de check-out este în jurul orei 11:00. </p>
  </div>
  
  <div class="faq">
    <h3>6 . Cum pot să adaug un mic dejun la rezervarea mea?</h3>
    <p>Micul dejun se poate adăuga selectând in căsuța "Mic dejun",tipul de mic dejun pe care îl doriți.</p> 
  </div>
</div>
<br><br><br>
<?php

if (isset($_SESSION['username'])) {
  echo '<h4>Add a Review</h4>';
  echo '<br>';
    echo '<div id="review-form">';
    echo '<form action="' . $_SERVER['PHP_SELF'] . '?id=' . $id . '" method="post">';
    echo '<input type="hidden" name="hotel_id" value="' . $id . '">';
    echo '<div class="form-group">';
    echo '<label for="comment">Leave a comment:</label>';
    echo '<textarea class="form-control" name="comment" id="comment" rows="3"></textarea>';
    echo '</div>';
    echo '<br>';
    echo '<button type="submit" class="btn btn-primary">Submit</button>';
    echo '</form>';
    echo '</div>';
}

echo '</div>';
echo '</div>';

$commentsQuery = "SELECT r.comment, r.created_at, r.username FROM reviews r WHERE r.hotel_id = '$id' ORDER BY r.created_at DESC";
$commentsResult = mysqli_query($conn, $commentsQuery);

if (!$commentsResult) {
    die('Query Error: ' . mysqli_error($conn));
}
   

if (mysqli_num_rows($commentsResult) > 0) {
    echo '<br><br>';
    echo '<h4>Reviews</h4>';
    echo '<div class="reviews-container">';
    while ($commentRow = mysqli_fetch_assoc($commentsResult)) {
        $comment = $commentRow['comment'];
        $createdAt = $commentRow['created_at'];
        $username = $commentRow['username'];

        echo '<div class="review">';
        echo '<div class="review-header">';
        echo '<span class="username">' . $username . '</span>';
        echo '<span class="created-at">' . $createdAt . '</span>';
        echo '</div>';
        echo '<div class="review-content">' . $comment . '</div>';
        echo '</div>';
    }
    echo '</div>';
} else {
  echo '<br><br>';
    echo '<p>No reviews yet.</p>';
}
?>
<br><br>

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