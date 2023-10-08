<?php
// Retrieve the hotel ID and photo index from the query string
$id = $_GET['id'];
$photoIndex = $_GET['photo'];

// Construct the photo file name based on the photo index
$photoFileName = $name . '_' . $photoIndex . '.jpg';

// Return the photo file name as the response
echo 'images/' . $photoFileName;
?>