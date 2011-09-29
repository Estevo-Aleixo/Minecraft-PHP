<?php
namespace de\wbbaddons\minecraft\api\packet;
use de\wbbaddons\minecraft\api\util\DataUtil;
use de\wbbaddons\minecraft\api\MinecraftPHP;

class Packet2 implements Packet {
	public static function writePacketData($data) {
		$package  = chr(2); // Packet prefix
		$package .= DataUtil::toStr16($data);
		
		MinecraftPHP::$socket->write($package);
	}

	public static function readPacketData() {
		$length = DataUtil::fromShort(MinecraftPHP::$socket->read(2));
		if(MinecraftPHP::$debug) MinecraftPHP::$logger->log("DEBUG: Packet2->readPacketData()->length: " . $length);
		if($length > 0)	return DataUtil::fromStr16(MinecraftPHP::$socket->read($length));
		else return false;
	}
}