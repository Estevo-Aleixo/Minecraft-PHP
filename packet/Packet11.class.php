<?php
namespace de\wbbaddons\minecraft\api\packet;
use de\wbbaddons\minecraft\api\util\DataUtil;
use de\wbbaddons\minecraft\api\MinecraftPHP;
use de\wbbaddons\minecraft\api\exception\ProtocolException;

class Packet11 {
	public static function writePacketData($x, $y, $stance, $z, $onGround) {
		$packet  = chr(11);
		$packet .= DataUtil::toDouble($x);
		$packet .= DataUtil::toDouble($y);
		$packet .= DataUtil::toDouble($stance);
		$packet .= DataUtil::toDouble($z);
		$packet .= DataUtil::toBool($onGround);
		
		MinecraftPHP::$socket->write($packet);
	}

	public static function readPacketData() {
		throw new ProtocolException('Client to Server only', 666);
	}
}