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
	<link rel="stylesheet" href="newcss.css">
	
</head>
<body>
<?php


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
<div class="sidebar">
    <h4>Filters</h4>
    <form action="" method="GET">
    <label for="location">Location:</label>
        <select name="location" id="location">
            <option value="">-- All Locations --</option>
            <option value="Bucuresti" <?php if(isset($_GET['location']) && $_GET['location'] === 'Bucuresti') echo 'selected'; ?>>Bucuresti</option>
            <option value="Brasov" <?php if(isset($_GET['location']) && $_GET['location'] === 'Brasov') echo 'selected'; ?>>Brasov</option>
            <option value="Iasi" <?php if(isset($_GET['location']) && $_GET['location'] === 'Iasi') echo 'selected'; ?>>Iasi</option>
            <option value="Timisoara" <?php if(isset($_GET['location']) && $_GET['location'] === 'Timisoara') echo 'selected'; ?>>Timisoara</option>
            <option value="Cluj" <?php if(isset($_GET['location']) && $_GET['location'] === 'Cluj') echo 'selected'; ?>>Cluj</option>
            <option value="Ploiesti" <?php if(isset($_GET['location']) && $_GET['location'] === 'Ploiesti') echo 'selected'; ?>>Ploiesti</option>
            <option value="Constanta" <?php if(isset($_GET['location']) && $_GET['location'] === 'Constanta') echo 'selected'; ?>>Constanta</option>
        </select>

        <label for="sort">Sort by Price:</label>
        <select name="sort" id="sort">
            <option value="">-- Select Sort Order --</option>
            <option value="asc" <?php if(isset($_GET['sort']) && $_GET['sort'] === 'asc') echo 'selected'; ?>>Lowest to Highest Price</option>
            <option value="desc" <?php if(isset($_GET['sort']) && $_GET['sort'] === 'desc') echo 'selected'; ?>>Highest to Lowest Price</option>
        </select>

        <label for="stars">Stars:</label><br>
     <input type="checkbox" name="stars[]" value="2" <?php if(isset($_GET['stars']) && in_array('2', $_GET['stars'])) echo 'checked'; ?>>
        <label for="2">2 Stars</label><br>
      <input type="checkbox" name="stars[]" value="3" <?php if(isset($_GET['stars']) && in_array('3', $_GET['stars'])) echo 'checked'; ?>>
        <label for="3">3 Stars</label><br>
        <input type="checkbox" name="stars[]" value="4" <?php if(isset($_GET['stars']) && in_array('4', $_GET['stars'])) echo 'checked'; ?>>
        <label for="4">4 Stars</label><br>
        <input type="checkbox" name="stars[]" value="5" <?php if(isset($_GET['stars']) && in_array('5', $_GET['stars'])) echo 'checked'; ?>>
        <label for="5">5 Stars</label><br>

        <label for="facilities">Facilities:</label><br>
<div class="facilities">
    <div class="column">
    <input type="checkbox" name="facilities[]" value="Swimming pool" <?php if (isset($_GET['facilities']) && in_array('Swimming pool', $_GET['facilities'])) echo 'checked'; ?>>
<label for="Swimming pool">Swimming pool</label><br>
<input type="checkbox" name="facilities[]" value="sauna" <?php if (isset($_GET['facilities']) && in_array('sauna', $_GET['facilities'])) echo 'checked'; ?>>
<label for="sauna">Sauna</label><br>
<input type="checkbox" name="facilities[]" value="fitness center" <?php if (isset($_GET['facilities']) && in_array('fitness center', $_GET['facilities'])) echo 'checked'; ?>>
<label for="fitness center">Fitness center</label><br>
<input type="checkbox" name="facilities[]" value="Private beach" <?php if (isset($_GET['facilities']) && in_array('Private beach', $_GET['facilities'])) echo 'checked'; ?>>
<label for="Private beach">Private beach</label><br>
<input type="checkbox" name="facilities[]" value="spa" <?php if (isset($_GET['facilities']) && in_array('spa', $_GET['facilities'])) echo 'checked'; ?>>
<label for="spa">Spa</label><br>
<input type="checkbox" name="facilities[]" value="restaurant" <?php if (isset($_GET['facilities']) && in_array('restaurant', $_GET['facilities'])) echo 'checked'; ?>>
<label for="restaurant">Restaurant</label><br>
<input type="checkbox" name="facilities[]" value="Conference room" <?php if (isset($_GET['facilities']) && in_array('Conference room', $_GET['facilities'])) echo 'checked'; ?>>
<label for="Conference room">Conference room</label><br>
    </div>
    <div class="column">
    <input type="checkbox" name="facilities[]" value="free Wi-Fi" <?php if (isset($_GET['facilities']) && in_array('free Wi-Fi', $_GET['facilities'])) echo 'checked'; ?>>
<label for="free Wi-Fi">Free Wi-Fi</label><br>
<input type="checkbox" name="facilities[]" value="Bar" <?php if (isset($_GET['facilities']) && in_array('Bar', $_GET['facilities'])) echo 'checked'; ?>>
<label for="Bar">Bar</label><br>
<input type="checkbox" name="facilities[]" value="business center" <?php if (isset($_GET['facilities']) && in_array('business center', $_GET['facilities'])) echo 'checked'; ?>>
<label for="business center">Business center</label><br>
<input type="checkbox" name="facilities[]" value="jacuzzi" <?php if (isset($_GET['facilities']) && in_array('jacuzzi', $_GET['facilities'])) echo 'checked'; ?>>
<label for="jacuzzi">Jacuzzi</label><br>
<input type="checkbox" name="facilities[]" value="free parking" <?php if (isset($_GET['facilities']) && in_array('free parking', $_GET['facilities'])) echo 'checked'; ?>>
<label for="free parking">Free parking</label><br>
<input type="checkbox" name="facilities[]" value="rooftop terrace" <?php if (isset($_GET['facilities']) && in_array('rooftop terrace', $_GET['facilities'])) echo 'checked'; ?>>
<label for="rooftop terrace">Rooftop terrace</label><br>
<input type="checkbox" name="facilities[]" value="Outdoor pool" <?php if (isset($_GET['facilities']) && in_array('Outdoor pool', $_GET['facilities'])) echo 'checked'; ?>>
<label for="Outdoor pool">Outdoor pool</label><br>
    </div>
</div>

        <input type="submit" value="Apply Filters" id="apply">
    </form>
</div>

<?php
$selectedFacilities = isset($_GET['facilities']) ? $_GET['facilities'] : [];
// Query pentru database ca sa aplicam filtrele
$query = "SELECT * FROM hotels WHERE 1";

if (isset($_GET['location']) && !empty($_GET['location'])) {
    $location = $_GET['location'];
    $query .= " AND location = '$location'";
    //query pentru filtrul de locatie,restrange rezultatele la locatia seelectata de user 
}

if (isset($_GET['sort']) && ($_GET['sort'] === 'asc' || $_GET['sort'] === 'desc')) {
  $sort = $_GET['sort'];
  $query .= " ORDER BY price $sort";
  //query pentru sortare de pret
}

if (isset($_GET['stars']) && !empty($_GET['stars'])) {
    $stars = $_GET['stars'];
    $starsFilter = implode(',', $stars);
    $query .= " AND stars IN ($starsFilter)";
    //filtreaza stelele in functie de ce selecteaza user-u
}

if (!empty($selectedFacilities)) {
  $query .= " AND (";
  $facilitiesCount = count($selectedFacilities);
  for ($i = 0; $i < $facilitiesCount; $i++) {
      $facility = $selectedFacilities[$i];
      $query .= "facilities LIKE '%$facility%'";
      if ($i !== $facilitiesCount - 1) {
          $query .= " OR ";
      }
  }
  $query .= ")";
}

$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        // extragem detalile
        $id = $row["id"];
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

    


    // Construct the photo file name based on the current photo index
    $photoFileName = $name . '_' . $currentPhoto . '.jpg';
        

        // Display the hotel details in HTML
        echo '<div class="card" style="width: 40rem; margin: 40px auto;">';
        echo '<div class="hotels">';
        echo '<div class="hotel-image-box"><a href="hotel_details.php?id=' . $id . '"><img src="images/' . $photoFileName . '" alt="' . $name . '"></a></div>';
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
        echo '<div class="stars">Number of stars: '. $stars .'</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
}
?>
</div>

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