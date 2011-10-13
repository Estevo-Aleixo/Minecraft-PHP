<?php
namespace de\wbbaddons\minecraft\api\packet;
use de\wbbaddons\minecraft\api\util\DataUtil;
use de\wbbaddons\minecraft\api\MinecraftPHP;
use de\wbbaddons\minecraft\api\exception\ProtocolException;

class Packet8 {
	public static function writePacketData() {
		throw new ProtocolException('Server to client only', 1337);
	}

	public static function readPacketData() {
		$health = DataUtil::fromShort(MinecraftPHP::$socket->read(2));
		$food = DataUtil::fromShort(MinecraftPHP::$socket->read(2));
		$foodSaturation = DataUtil::fromFloat(MinecraftPHP::$socket->read(4));
		
		$return = array(
			"health" => $health,
			"food" => $food,
			"foodSaturation" => $foodSaturation
		);
		
		return $return;
	}
}