<?php include("head.php"); ?>

<div class="title">
	<h2>Anti-pattern: </h2><h3>PRNG for CSRF</h3>
</div>

<h4>Form with CSRF</h4>
<form action="">
    <label>Donation amount</label>
    <input type="text" value="10.00">
    <?php
    $csrfToken = rand();
    setCookie("csrfToken", $csrfToken);
    echo "<input type=\"hidden\" value=\"$csrfToken\">"
    ?>
    <input type="submit" value="Submit">
</form>

<?php include("foot.php"); ?>
