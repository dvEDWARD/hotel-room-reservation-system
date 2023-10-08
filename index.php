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
	<link rel="stylesheet" href="index.css">
	
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
    echo '<div id="success-message" class="alert alert-success" role="alert" style="display: none; position: fixed; top: 0; left: 0; right: 0; z-index: 9999; text-align: center;">
    You have successfully registered.
</div>';
    echo '</nav>';
}
?>


	<div class="swiper-container">
  <div class="swiper-wrapper">
    <div class="swiper-slide"><img src="photos/image1.jpg"></div>
    <div class="swiper-slide"><img src="photos/image2.jpg"></div>
    <div class="swiper-slide"><img src="photos/image3.jpg"></div>
  </div>
  <div class="swiper-pagination"></div>
</div>

<section id="tourist-attractions" style="margin-top: 400px;">
  <div class="container">
  <h2 class="text-center mb-4">Tourist Attractions</h2>
      <div class="row">
      <div class="col-md-4">
        <div class="card">
          <img class="card-img-top" src="photos3/image1.jpg" alt="Tourist Attraction 1">
          <div class="card-body">
            <h5 class="card-title">Peles Castle</h5>
            <p class="card-text">Peles Castle doesn’t have a history of sieges and warfare but it does have something other European castles don’t: spectacular beauty, sitting as it does on a Carpathian hillside. This Neo-Renaissance castle was built by King Carol I who vacationed here in the 1860s. Fairytale-like in appearance, it’s considered one of the most stunning castles in Europe. A 4,000-piece weapons collection reflects the king’s military interests, while a movie room decorated with frescoes reflects the queen’s artistic interests. The first movie shown in Romania aired here.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">
          <img class="card-img-top" src="photos3/image2.jpg" alt="Tourist Attraction 2">
          <div class="card-body">
            <h5 class="card-title">Salina Turda</h5>
            <p class="card-text">If you feel like you’re working in a salt mine at home, then you should feel comfortable at Salina Turda. The salt mine, which dates as far back as the 17th century, was used for everything from a cheese storage center to a bomb shelter in WWII after excavations stopped in 1932. Today, it has been transformed into an incredible sci-fi theme park. Located in Ciuj County, Salina Turda has been called one of the coolest underground places in the world.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">
          <img class="card-img-top" src="photos3/image3.jpg" alt="Tourist Attraction 3">
          <div class="card-body">
            <h5 class="card-title">Corvin Castle</h5>
            <p class="card-text">Corvin Castle is an imposing medieval, Gothic structure, considered the most impressive medieval castle in Romania. It also is known as Hunyad Castle after the high-ranking official who built it. Corvin Castle is a fairytale castle that is accessed by a wooden bridge that bears a statue of St. John of Nepomuk, the patron saint of bridges. A raven wearing a gold ring is a symbol of the 15th century castle. See, too, the bear pit and the dungeon where people were tortured.</p>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4">
        <div class="card">
          <img class="card-img-top" src="photos3/image4.jpg" alt="Tourist Attraction 1">
          <div class="card-body">
            <h5 class="card-title">Wooden Churches of Maramures</h5>
            <p class="card-text">When foreign rulers of Maramures refused to let the people build long-lasting stone churches, they turned to wood instead. They built about 300 wood churches over a 200-year period; only about 100 of these churches remain in use today. These Gothic structures are mostly Orthodox but there are a few Greek Catholic churches. The churches, usually with tall, slim bell towers, reflect an advanced degree of carpentry. They are both simple and elegant at the same time. Hand painted murals decorate the inside of many churches.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">
          <img class="card-img-top" src="photos3/image5.jpg" alt="Tourist Attraction 2">
          <div class="card-body">
            <h5 class="card-title">Bran Castle</h5>
            <p class="card-text">Bran Castle is often associated with Dracula as his home, though there’s no indication that author Bram Stoker even knew of this medieval castle. The castle, a Romanian landmark, has a fairy tale quality, peeking out from forested a hillside near Brasov in Transylvania. With roots dating to the 13th century, this medieval castle today is a museum showcasing art and furniture collected by Queen Maria. It also is home to an open-air museum featuring Romanian peasant buildings from around the country.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">
          <img class="card-img-top" src="photos3/image6.jpg" alt="Tourist Attraction 3">
          <div class="card-body">
            <h5 class="card-title">Poiana Brasov</h5>
            <p class="card-text">When you get tired of seeking out vampires, consider Poiana Brasov for a change of pace. It’s the most popular ski resort in Romania that also draws skiers from all over Europe. Located in the Carpathian Mountains, the ski resort has seven slopes that offer a combined 25 km (15 miles) of skiing. The resort also hosts competitive alpine skiing and figure skating events. After a day on the slopes, warm yourself up with a traditional mulled wine or try some tuică, a plum based pepper-spiced drink.</p>
          </div>
        </div>
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
  
  <script>
    // Check if the success parameter is set in the URL and if the success message is set in the session
    const urlParams = new URLSearchParams(window.location.search);
    const success = urlParams.get('success');
    const message = "<?php echo isset($_SESSION['message']) ? 'true' : 'false'; ?>";

    // If success parameter is set and registration was successful, show the success message for 2.5 seconds
    if (success && message === 'true') {
        $('#success-message').fadeIn('fast', function() {
            $(this).delay(2500).fadeOut('slow');
        });
        // Clear the success message from the session
        <?php unset($_SESSION['message']); ?>
    }


</script>

</body>
</html>