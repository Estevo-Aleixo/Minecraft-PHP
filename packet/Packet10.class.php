<?php
namespace de\wbbaddons\minecraft\api\packet;
use de\wbbaddons\minecraft\api\util\DataUtil;
use de\wbbaddons\minecraft\api\MinecraftPHP;
use de\wbbaddons\minecraft\api\exception\ProtocolException;

class Packet10 {
	public static function writePacketData($onGround) {
		$packet  = chr(10);
		$packet .= DataUtil::toBool($onGround);
		
		MinecraftPHP::$socket->write($packet);
	}

	public static function readPacketData() {
		throw new ProtocolException('Client to Server only', 666);
	}
}