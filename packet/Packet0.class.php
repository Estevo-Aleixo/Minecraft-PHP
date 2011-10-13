<?php
namespace de\wbbaddons\minecraft\api\packet;
use de\wbbaddons\minecraft\api\util\DataUtil;
use de\wbbaddons\minecraft\api\MinecraftPHP;

class Packet0 {
	public static function writePacketData($id) {
		$packet  = chr(0);
		$packet .= DataUtil::toInt($id);
		
		MinecraftPHP::$socket->write($packet);		
	}

	public static function readPacketData() {
		$hash = DataUtil::fromInt(MinecraftPHP::$socket->read(4));
		
		return $hash;
	}
}