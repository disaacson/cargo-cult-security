<?php include("head.php"); ?>

<div class="title">
	<h2>Anti-pattern: </h2><h3>Using encryption for authentication</h3>
</div>

<?php

require_once('encryption_helper.php');

$plainTextId = '100000';
echo '<h4>Secure URL for image ' . $plainTextId . ':</h4>';

$hmac = hash_hmac("sha256", $key, $plainTextId);
$secretImageBasePath = dirname(htmlspecialchars($_SERVER['REQUEST_URI']));
$secretImageUrl = 'http://' . $_SERVER[HTTP_HOST] . $secretImageBasePath
    . "/private_image_2.php?id=". $plainTextId . "&hmac=" . $hmac;
echo '<a href="'. $secretImageUrl .'">' . $secretImageUrl . '</a>';

?>

<?php include("foot.php"); ?>
