<?php include("head.php"); ?>

<h4>Your private image</h4>

<?php

require_once('encryption_helper.php');

$cryptTextId = $_GET["secure_id"];
$plainTextId = rtrim(mcrypt_decrypt(MCRYPT_BLOWFISH, $key, hex2bin($cryptTextId),
    MCRYPT_MODE_OFB, $initializationVector));
$imageData = file_get_contents("img/" . $plainTextId . ".jpg");
echo '<img src="data:image/png;base64,'. base64_encode($imageData)
    .'" height="460" width="613">'
?>

<?php include("foot.php"); ?>
