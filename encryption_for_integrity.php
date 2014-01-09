<?php include("head.php"); ?>

<div class="title">
	<h2>Anti-pattern: </h2><h3>Using encryption for integrity</h3>
</div>

<pre class="prettyprint" id="decodedMessage">
</pre>

<script>
	var messageObj = <?php
require_once('encryption_helper.php');

$plainText = file_get_contents("bankDeposit.txt");
echo $plainText;
?>

	var messageStr = JSON.stringify(messageObj, null, 4);
	document.getElementById('decodedMessage').innerHTML = messageStr;
</script>

<?php
$plainText = file_get_contents("bankDeposit.txt");
echo "<button>Send</button>";
?>

<?php include("foot.php"); ?>
