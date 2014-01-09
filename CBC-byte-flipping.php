#!/usr/bin/php
<?php

// http://resources.infosecinstitute.com/cbc-byte-flipping-attack-101-approach/

declare(ticks = 1);

define('PADDING', 50);

set_include_path(get_include_path() . PATH_SEPARATOR . (__DIR__ . '/php-cli-tools/'));
require_once('lib/cli/cli.php');
\cli\register_autoload();

function test_bad_encryption($id) {
	\cli\line("\nmessage: ".$id);

	$key = '0123456789abcdefghij<>?:"{}|_+,./;"[]\-=';

	$cryptText = mcrypt_encrypt(MCRYPT_BLOWFISH, $key, $id, MCRYPT_MODE_OFB, $key);
	$hexCryptText = bin2hex($cryptText);
	$base64CryptText = base64_encode($cryptText);
	\cli\line(sprintf("cryptText binary: %s", $cryptText));
	\cli\line(sprintf("cryptText hex: %s", $hexCryptText));
	\cli\line(sprintf("cryptText base64: %s", $base64CryptText));

	$plaintext = rtrim(mcrypt_decrypt(MCRYPT_BLOWFISH, $key, hextobin($hexCryptText), MCRYPT_MODE_OFB, $key), "\0");
	\cli\line(sprintf("plaintext: %s", $plaintext));

	$testString = '6f';
	$testPlainText = rtrim(mcrypt_decrypt(MCRYPT_BLOWFISH, $key, hextobin($testString), MCRYPT_MODE_OFB, $key), "\0");
	\cli\line(sprintf("testplaintext: %s", $testPlainText));
}

function check_killed() {
	global $killed;
	
	if ($killed) {
		echo "Killed!\n";
		exit(2);
	}
}

function sig_handler($signo) {
	global $killed;
	
	$killed = true;
	echo "Caught signal $signo\nCleaning up...\n";
}

function hextobin($hexstr)
{
	$n = strlen($hexstr);
	$sbin="";
	$i=0;
	while($i<$n)
	{
		$a =substr($hexstr,$i,2);
		$c = pack("H*",$a);
		if ($i==0){$sbin=$c;}
		else {$sbin.=$c;}
		$i+=2;
	}
	return $sbin;
}

$killed = false;
pcntl_signal(SIGINT, "sig_handler");
pcntl_signal(SIGTERM, "sig_handler");
pcntl_signal(SIGHUP,  "sig_handler");

check_killed();

test_bad_encryption("10");
test_bad_encryption("10");
test_bad_encryption("11");
test_bad_encryption("12");

echo "Done!\n";
