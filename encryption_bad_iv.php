<?php include("head.php"); ?>

<h2>Your private image URL</h2>

<?php

require_once('encryption_helper.php');

$plainTextId = '100000';
$cryptTextId = bin2hex(mcrypt_encrypt(MCRYPT_BLOWFISH, $key, $plainTextId,
    MCRYPT_MODE_OFB, $initializationVector));
$secretImageUrl = 'private_image.php?secure_id='. $cryptTextId;
echo '<a href="'. $secretImageUrl .'" height="300" width="400">' . $secretImageUrl
    . '</a>';

?>

<?php include("foot.php"); ?>
