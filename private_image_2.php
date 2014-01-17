<?php include("head.php"); ?>

<h4>Your private image</h4>

<?php

require_once('encryption_helper.php');

$plainTextId = $_GET["id"];
$signature = $_GET["hmac"];
$hmac = hash_hmac("sha256", $key, $plainTextId);
if ($hmac == $signature)
{
    $imageData = file_get_contents("img/" . $plainTextId . ".jpg");
    echo '<img src="data:image/png;base64,'. base64_encode($imageData)
        .'" height="460" width="613">';
}
else
{
    echo '<h4 class="error">Invalid URL</h4>';
}
?>

<?php include("foot.php"); ?>
