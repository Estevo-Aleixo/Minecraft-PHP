<?php
namespace de\wbbaddons\minecraft\api\packet;
use de\wbbaddons\minecraft\api\util\DataUtil;
use de\wbbaddons\minecraft\api\MinecraftPHP;

class Packet13 {
	public static function writePacketData($x, $y, $stance, $z, $yaw, $pitch, $onGround) {
		$packet  = chr(13);
		$packet .= DataUtil::toDouble($x);
		$packet .= DataUtil::toDouble($y);
		$packet .= DataUtil::toDouble($stance);
		$packet .= DataUtil::toDouble($z);
		$packet .= DataUtil::toFloat($yaw);
		$packet .= DataUtil::toFloat($pitch);
		$packet .= DataUtil::toBool($onGround);		
				
		MinecraftPHP::$socket->write($packet);
	}

	public static function readPacketData() {
		$x = DataUtil::fromDouble(MinecraftPHP::$socket->read(8));
		$stance = DataUtil::fromDouble(MinecraftPHP::$socket->read(8));
		$y = DataUtil::fromDouble(MinecraftPHP::$socket->read(8));
		$z = DataUtil::fromDouble(MinecraftPHP::$socket->read(8));
		$yaw = DataUtil::fromFloat(MinecraftPHP::$socket->read(4));
		$pitch = DataUtil::fromFloat(MinecraftPHP::$socket->read(4));
		$onGround = DataUtil::fromBool(MinecraftPHP::$socket->read(1));
		
		$return = array(
			"x" => $x,
			"stance" => $stance,
			"y" => $y,
			"z" => $z,
			"yaw" => $yaw,
			"pitch" => $pitch,
			"onGround" => $onGround
		);
	}
}