<?php
namespace de\wbbaddons\minecraft\api\packet;
use de\wbbaddons\minecraft\api\util\DataUtil;
use de\wbbaddons\minecraft\api\MinecraftPHP;
use de\wbbaddons\minecraft\api\exception\ProtocolException;

class Packet17 {
	public static function writePacketData() {
		throw new ProtocolException('Server to client only', 1337);
	}

	public static function readPacketData() {
		$entityID = DataUtil::fromInt(MinecraftPHP::$socket->read(4));
		$inBed = DataUtil::fromByte(MinecraftPHP::$socket->read(1));
		$x = DataUtil::fromInt(MinecraftPHP::$socket->read(4));
		$y = DataUtil::fromByte(MinecraftPHP::$socket->read(1));
		$z = DataUtil::fromInt(MinecraftPHP::$socket->read(4));
		
		$return = array(
			"entityID" => $entityID,
			"inBed" => $inBed,
			"x" => $x,
			"y" => $y,
			"z" => $z
		);
		
		return $return;
	}
}