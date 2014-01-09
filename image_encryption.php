#!/usr/bin/php
<?php

declare(ticks = 1);

define('PADDING', 50);

include_once(__DIR__ . '/encryption_helper.php');
set_include_path(get_include_path() . PATH_SEPARATOR . (__DIR__ . '/php-cli-tools/'));
require_once('lib/cli/cli.php');
\cli\register_autoload();

function test_image_encryption($file) {
	\cli\line("\n file: ".$file);

	$key = "superSecretKey";
	$initializationVector = "totallyRandomBits_0123456789abcdefghijklmnopqrstuvwxyz";

	$plainImageData = file_get_contents($file);
	$cryptText = mcrypt_encrypt(MCRYPT_BLOWFISH, $key, $plainImageData, MCRYPT_MODE_ECB, $initializationVector);
	file_put_contents($file . ".encrypted.data", $cryptText);
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

$killed = false;
pcntl_signal(SIGINT, "sig_handler");
pcntl_signal(SIGTERM, "sig_handler");
pcntl_signal(SIGHUP,  "sig_handler");

check_killed();

test_image_encryption("/tmp/the-hobbit-index6.data");

echo "Done!\n";
