<?php
namespace de\wbbaddons\minecraft\api\packet;
use de\wbbaddons\minecraft\api\util\DataUtil;
use de\wbbaddons\minecraft\api\MinecraftPHP;
use de\wbbaddons\minecraft\api\exception\ProtocolException;

class Packet4 {
	public static function writePacketData() {
		throw new ProtocolException('Server to client only', 1337);
	}

	public static function readPacketData() {
		$time = DataUtil::fromLong(MinecraftPHP::$socket->read(8));
		
		return $time;
	}
}