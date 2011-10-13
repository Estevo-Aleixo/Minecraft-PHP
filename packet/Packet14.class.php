<?php
namespace de\wbbaddons\minecraft\api\packet;
use de\wbbaddons\minecraft\api\util\DataUtil;
use de\wbbaddons\minecraft\api\MinecraftPHP;
use de\wbbaddons\minecraft\api\exception\ProtocolException;

class Packet14 {
	public static function writePacketData($status, $x, $y, $z, $face) {
		$packet  = chr(14);
		$packet .= DataUtil::toByte($status);
		$packet .= DataUtil::toInt($x);
		$packet .= DataUtil::toByte($y);
		$packet .= DataUtil::toInt($z);
		$packet .= DataUtil::toByte($face);
		
		MinecraftPHP::$socket->write($packet);
	}

	public static function readPacketData() {
		throw new ProtocolException('Client to Server only', 666);
	}
}