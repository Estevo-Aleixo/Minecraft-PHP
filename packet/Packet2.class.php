<?php
namespace de\wbbaddons\minecraft\api\packet;
use de\wbbaddons\minecraft\api\util\DataUtil;
use de\wbbaddons\minecraft\api\MinecraftPHP;

class Packet2 {
	public static function writePacketData($username) {
		$package  = chr(2); // Packet prefix
		$package .= DataUtil::toStr16($username);
		
		MinecraftPHP::$socket->write($package);
	}

	public static function readPacketData() {
		//get length of the str16 value.
		$length = DataUtil::fromShort(MinecraftPHP::$socket->read(2));
		if(MinecraftPHP::$debug) MinecraftPHP::$logger->log("DEBUG: Packet2->readPacketData()->length: " . $length);
		//if length is greater than 0, return the decoded str16 value.
		if($length > 0)	return DataUtil::fromStr16(MinecraftPHP::$socket->read($length));
		else return false;
	}
}