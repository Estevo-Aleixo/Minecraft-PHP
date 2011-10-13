<?php
namespace de\wbbaddons\minecraft\api\packet;
use de\wbbaddons\minecraft\api\util\DataUtil;
use de\wbbaddons\minecraft\api\MinecraftPHP;
use de\wbbaddons\minecraft\api\exception\ProtocolException;

class Packet12 {
	public static function writePacketData($yaw, $pitch, $onGround) {
		$packet  = chr(12);
		$packet .= 	DataUtil::toFloat($yaw);
		$packet .= 	DataUtil::toFloat($pitch);
		$packet .= 	DataUtil::toBool($onGround);
			
		MinecraftPHP::$socket->write($packet);
	}

	public static function readPacketData() {
		throw new ProtocolException('Client to Server only', 666);
	}
}