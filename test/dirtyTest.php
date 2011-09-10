<?php
require_once('../util/DataUtil.class.php');

$username = "§5B§1O§bT§2T§eI"; // rainboy nick

$fp = fsockopen("max-m.dyndns.org", 25566, $errno, $errstr, 5);
stream_set_timeout($fp, 2);
if (!$fp) {
	echo "$errstr ($errno)<br />\n";
} else {
	$package = chr(2); // Packet prefix
	$package .= DataUtil::toStr16($username);
	fwrite($fp, $package);
	while (!feof($fp)) {
		$data = fgets($fp, 32);
		$data = substr($data, 4);
		echo $data . "\n";
		if($data != "") {
			$package =  chr(1);
			$package .= DataUtil::toInt(15);
			$package .= DataUtil::toStr16($username);
			$package .= DataUtil::toLong(0);
			$package .= DataUtil::toInt(0);
			$package .= DataUtil::toByte(0);
			$package .= DataUtil::toByte(0);
			$package .= DataUtil::toByte(0);
			
			fwrite($fp, $package);
			$i = 0;
			while (!feof($fp)) {
				$data = fgets($fp, 32);
				echo $data;
				$package = chr(3); // Packet prefix
				$package .= DataUtil::toStr16($i);
				fwrite($fp, $package);
				$i++;
			}
		}
	}
	fclose($fp);
}
?>