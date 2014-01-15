<?php include("head.php"); ?>

<div class="title">
	<h2>Anti-pattern: </h2><h3>Using encryption for integrity</h3>
</div>

<h4>Decrypted message</h4>
<pre class="prettyprint" id="decodedMessage">
</pre>

<script>
	var messageObj = <?php
require_once('encryption_helper.php');

$plainText = file_get_contents("bankDeposit.txt");

$b = array();
$cipherText = array();
$cipherText = @encrypt($plainText);
$cipherText[45] =  chr(ord($cipherText[45]) ^ ord(".") ^ ord ("0"));
$decryptedPlainText = @decrypt($cipherText);
echo $decryptedPlainText;
?>
	
	var messageStr = JSON.stringify(messageObj, null, 4);
	document.getElementById('decodedMessage').innerHTML = messageStr;
</script>

<?php include("foot.php"); ?>
