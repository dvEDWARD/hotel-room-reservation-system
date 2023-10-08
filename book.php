
<?php
session_start();
require_once 'config.php';
if (!isset($_SESSION['username'])) {
  header("Location: index.php");
  exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $roomType = $_POST['room_type'];
      $checkInDate = $_POST['check_in_date'];
      $checkOutDate = $_POST['check_out_date'];
      $hotelid=$_POST['hotel_id'];
      $username = $_SESSION['username'];
      $breakfast=$_POST['breakfast'];
      $query = "INSERT INTO bookings (booking_id, room_type, check_in_date, check_out_date, hotel_id, username, breakfast) VALUES (NULL, '$roomType', '$checkInDate', '$checkOutDate', '$hotelid', '$username', '$breakfast')";
        mysqli_query($conn, $query);

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

<form id="payment-form">
  <div class="form-row">
    <label for="card-number">
      Credit or debit card number
    </label>
    <div id="card-number-element" class="form-control"></div>
  </div>
  <div class="form-row">
    <label for="card-expiry">
      Expiration date
    </label>
    <div id="card-expiry-element" class="form-control"></div>
  </div>
  <div class="form-row">
    <label for="card-cvc">
      CVC code
    </label>
    <div id="card-cvc-element" class="form-control"></div>
  </div>

  <div id="card-errors" role="alert"></div>
<br>
  <button id="submit-button" type="submit">Submit Payment</button>
  <?php
  
if (isset($_GET['payment_status']) && $_GET['payment_status'] === 'success') {
  echo '<div class="success-message">Payment successful!</div>';
}
?>
</form>

<script src="https://js.stripe.com/v3/"></script>

<script>
  var stripe = Stripe('pk_test_51Mx8nsIMMWdSgUgYVL3NhTbwdd7wsOJzmKibcZQ9nd36D3BpPdNUy0wKJUXLxK6qPxx4zcdTzG43oGeD17HH79ud007QZMZfYA');
  var elements = stripe.elements();

  var cardNumberElement = elements.create('cardNumber', {style: style});
  cardNumberElement.mount('#card-number-element');

  var cardExpiryElement = elements.create('cardExpiry', {style: style});
  cardExpiryElement.mount('#card-expiry-element');

  var cardCvcElement = elements.create('cardCvc', {style: style});
  cardCvcElement.mount('#card-cvc-element');

  var form = document.getElementById('payment-form');
  var submitButton = document.getElementById('submit-button');

  form.addEventListener('submit', function(event) {
    event.preventDefault();

    submitButton.disabled = true;
    stripe.createToken(cardNumberElement, cardExpiryElement, cardCvcElement).then(function(result) {
      if (result.error) {
        var errorElement = document.getElementById('card-errors');
        errorElement.textContent = result.error.message;
        submitButton.disabled = false;
      } else {
        stripeTokenHandler(result.token);
      }
    });
  });

  function stripeTokenHandler(token) {
  var hiddenInput = document.createElement('input');
  hiddenInput.setAttribute('type', 'hidden');
  hiddenInput.setAttribute('name', 'stripeToken');
  hiddenInput.setAttribute('value', token.id);
  form.appendChild(hiddenInput);

  var successInput = document.createElement('input');
  successInput.setAttribute('type', 'hidden');
  successInput.setAttribute('name', 'payment_status');
  successInput.setAttribute('value', 'success');
  form.appendChild(successInput);

  form.submit();
}

  var style = {
    base: {
      fontFamily: 'Arial, sans-serif',
      fontSize: '16px',
      lineHeight: '24px',
      color: '#424770',
      '::placeholder': {
        color: '#aab7c4'
      }
    },
    invalid: {
      color: '#9e2146'
    }
  };
</script>

<?php
require_once('init.php');

\Stripe\Stripe::setApiKey('sk_test_51Mx8nsIMMWdSgUgYqse3Nn756OTPLmthdYMAyuietMZndx58tqnvHOIB2FvMDy25WiQMfkpARJy4ngCfsp7CWf9h00K9KqBeqD');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['stripeToken'])) {
      $token = $_POST['stripeToken'];

      try {
          $charge = \Stripe\Charge::create([
              'amount' => 1000, // $10.00
              'currency' => 'usd',
              'description' => 'Hotel booking',
              'source' => $token,
          ]);
          // Debugging statement
          echo 'Payment successful!';
          
      } catch (\Stripe\Exception\CardException $e) {
          // Handle card error
          echo 'Payment failed: ' . $e->getError()->message;
      } catch (\Stripe\Exception\RateLimitException $e) {
          // Handle rate limit error
      } catch (\Stripe\Exception\InvalidRequestException $e) {
          // Handle invalid request error
      } catch (\Stripe\Exception\AuthenticationException $e) {
          // Handle authentication error
      } catch (\Stripe\Exception\ApiConnectionException $e) {
          // Handle API connection error
      } catch (\Stripe\Exception\ApiErrorException $e) {
          // Handle generic API error
      }
  }
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
