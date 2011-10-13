<?php
namespace de\wbbaddons\minecraft\api\packet;
use de\wbbaddons\minecraft\api\util\DataUtil;
use de\wbbaddons\minecraft\api\MinecraftPHP;
use de\wbbaddons\minecraft\api\exception\ProtocolException;

class Packet15 {
	public static function writePacketData() {
		$packet  = chr(15);
		$packet .= DataUtil::toInt($x);
		$packet .= DataUtil::toByte($y);
		$packet .= DataUtil::toInt($z);
		$packet .= DataUtil::toByte($direction);
		$packet .= DataUtil::toShort($id);
		$packet .= DataUtil::toByte($amount);
		$packet .= DataUtil::toShort($damage);
		
		MinecraftPHP::$socket->write($packet);
	}

	public static function readPacketData() {
		throw new ProtocolException('Client to Server only', 666);
	}
}