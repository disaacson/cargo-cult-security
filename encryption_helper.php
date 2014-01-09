<?php

$key = "superSecretKey";
$initializationVector = "totallyRandomBits_0123456789abcdefghijklmnopqrstuvwxyz";


define('MY_AES_KEY', "abcdef0123456789");

function aes($data, $encrypt) {
	$aes = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', MCRYPT_MODE_CBC, '');
	$iv = "1234567891234567";
	mcrypt_generic_init($aes, MY_AES_KEY, $iv);
	return $encrypt ? mcrypt_generic($aes, $data) : mdecrypt_generic($aes, $data);
}

//define('MY_MAC_LEN', 40);

function encrypt($data) {
	return aes($data, true);
}

function decrypt($data) {
	$data = rtrim(aes($data, false), "\0");
	return $data;
}

function hex2bin($hexstr)
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

?>