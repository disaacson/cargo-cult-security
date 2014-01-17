#!/usr/bin/php
<?php

// http://resources.infosecinstitute.com/cbc-byte-flipping-attack-101-approach/

declare(ticks = 1);

define('PADDING', 50);

set_include_path(get_include_path() . PATH_SEPARATOR . (__DIR__ . '/php-cli-tools/'));
require_once('lib/cli/cli.php');
\cli\register_autoload();

function test_prng($num) {
    for ($i = 0; $i < $num; $i++)
    {
//        echo $i . " , " . rand(0, 100000) .  "\n";
        echo rand(0, 100000) .  "\n";
    }
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

test_prng("100000");

