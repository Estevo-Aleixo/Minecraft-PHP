<?php
namespace de\wbbaddons\minecraft\api\packet;
use de\wbbaddons\minecraft\api\util\DataUtil;
use de\wbbaddons\minecraft\api\MinecraftPHP;
use de\wbbaddons\minecraft\api\exception\ProtocolException;

class Packet16 {
	public static function writePacketData($slot) {
		$packet  = chr(16);
		$packet .= DataUtil::toShort($slot);
			
		MinecraftPHP::$socket->write($packet);
	}

	public static function readPacketData() {
		throw new ProtocolException('Client to Server only', 666);
	}
}