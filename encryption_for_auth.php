<?php include("head.php"); ?>

<div class="title">
	<h2>Anti-pattern: </h2><h3>Using encryption for authentication</h3>
</div>

<?php

require_once('encryption_helper.php');

$plainTextId = '100000';
echo '<h4>"Secure" URL for image ' . $plainTextId . ':</h4>';

$cryptTextId = bin2hex(mcrypt_encrypt(MCRYPT_BLOWFISH, $key, $plainTextId,
    MCRYPT_MODE_OFB, $initializationVector));
$secretImageBasePath = dirname(htmlspecialchars($_SERVER['REQUEST_URI']));
$secretImageUrl = 'http://' . $_SERVER[HTTP_HOST] . $secretImageBasePath
    . "/private_image.php?secure_id=". $cryptTextId;
echo '<a href="'. $secretImageUrl .'">' . $secretImageUrl . '</a>';

?>

<?php include("foot.php"); ?>
