<?php
namespace de\wbbaddons\minecraft\api\packet;
use de\wbbaddons\minecraft\api\util\DataUtil;
use de\wbbaddons\minecraft\api\MinecraftPHP;
use de\wbbaddons\minecraft\api\exception\ProtocolException;

class Packet7 {
	public static function writePacketData($user, $target, $lClick) {
		$packet  = chr(7);
		$packet .= DataUtil::toInt($user);
		$packet .= DataUtil::toInt($target);
		$packet .= DataUtil::toBool($lClick);
		
		MinecraftPHP::$socket->write($packet);
	}

	public static function readPacketData() {
		throw new ProtocolException('Client to Server only', 666);
	}
}