<?php
require_once('../util/DataUtil.class.php');

$username = "Bot";

$fp = fsockopen("max-m.dyndns.org", 25565, $errno, $errstr, 5);
stream_set_timeout($fp, 2);
if (!$fp) {
	echo "$errstr ($errno)<br />\n";
} else {
	$package = chr(2); // Packet prefix
	$package .= DataUtil::toStr16($username);
	fwrite($fp, $package);
	while (!feof($fp)) {
		$data = fgets($fp, 128);
		$data = substr($data, 4);
		if($data != "") {
			$package =  chr(1);
			$package .= DataUtil::toInt(14);
			$package .= DataUtil::toStr16($username);
			$package .= DataUtil::toLong(0);
			$package .= DataUtil::toByte(0);
			
			fwrite($fp, $package);
			while (!feof($fp)) {
				$data = fgets($fp, 128);
				
				echo $data;
				exit;
			}
		}
	}
	fclose($fp);
}
?>