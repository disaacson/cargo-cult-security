<?php include("head.php"); ?>

<h2>Your private image</h2>

<?php

require_once('encryption_helper.php');

$cryptTextId = $_GET["secure_id"];
$plainTextId = rtrim(mcrypt_decrypt(MCRYPT_BLOWFISH, $key, hex2bin($cryptTextId), MCRYPT_MODE_OFB, $initializationVector));
$imageData = base64_encode(file_get_contents("img/" . $plainTextId . ".jpg"));
echo '<img src="data:image/png;base64,'. $imageData .'" height="600" width="800">'
?>

<?php include("foot.php"); ?>
