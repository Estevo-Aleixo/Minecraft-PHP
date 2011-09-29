<?php
namespace de\wbbaddons\minecraft\api\packet;
use de\wbbaddons\minecraft\api\util\DataUtil;
use de\wbbaddons\minecraft\api\MinecraftPHP;

class Packet3 implements Packet {
	public static function writePacketData($data) {
		$package  = chr(3);
		$package .= DataUtil::toStr16($data);
		
		MinecraftPHP::$socket->write($package);
	}

	public static function readPacketData() {
		$length = DataUtil::fromShort(MinecraftPHP::$socket->read(2));
		$message = DataUtil::fromStr16(MinecraftPHP::$socket->read($length));
		
		MinecraftPHP::$logger->log("CHAT: " . $message);
		
		return $message;
	}
}