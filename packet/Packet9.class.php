<?php
namespace de\wbbaddons\minecraft\api\packet;
use de\wbbaddons\minecraft\api\util\DataUtil;
use de\wbbaddons\minecraft\api\MinecraftPHP;

class Packet9 {
	public static function writePacketData() {
		$packet  = chr(9);
		$packet .= DataUtil::toByte(0);
		$packet .= DataUtil::toByte(0);
		$packet .= DataUtil::toByte(0);
		$packet .= DataUtil::toShort(0);
		$packet .= DataUtil::toLong(0);
		
		MinecraftPHP::$socket->write($packet);
	}

	public static function readPacketData() {
		$world = DataUtil::fromByte(MinecraftPHP::$socket->read(1));
		$difficulty = DataUtil::fromByte(MinecraftPHP::$socket->read(1));
		$creativeMode = DataUtil::fromByte(MinecraftPHP::$socket->read(1));
		$worldHeight = DataUtil::fromShort(MinecraftPHP::$socket->read(2));
		$mapSeed = DataUtil::fromLong(MinecraftPHP::$socket->read(8));
		
		$return = array(
			"world" => $world,
			"difficulty" => $difficulty,
			"creativeMode" => $creativeMode,
			"worldHeight" => $worldHeight,
			"mapSeed" => $mapSeed
		);
		
		return $return;
	}
}