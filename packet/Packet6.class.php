<?php
namespace de\wbbaddons\minecraft\api\packet;
use de\wbbaddons\minecraft\api\util\DataUtil;
use de\wbbaddons\minecraft\api\MinecraftPHP;
use de\wbbaddons\minecraft\api\exception\ProtocolException;

class Packet6 {
	public static function writePacketData() {
		throw new ProtocolException('Server to client only', 1337);
	}

	public static function readPacketData() {
		$x = DataUtil::fromInt(MinecraftPHP::$socket->read(4));
		$y = DataUtil::fromInt(MinecraftPHP::$socket->read(4));
		$z = DataUtil::fromInt(MinecraftPHP::$socket->read(4));
		
		$return = array(
			"x" => $x,
			"y" => $y,
			"z" => $z
		);
		
		return $return;
	}
}