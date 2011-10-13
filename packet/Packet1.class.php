<?php
namespace de\wbbaddons\minecraft\api\packet;
use de\wbbaddons\minecraft\api\util\DataUtil;
use de\wbbaddons\minecraft\api\MinecraftPHP;

class Packet1 {
	public static function writePacketData($username) {
		$packet  = chr(1); // Packet prefix
		$packet .= DataUtil::toInt(20); //must be edited if a new protocol version comes out.
		$packet .= DataUtil::toStr16($username); //username
		$packet .= DataUtil::toLong(0); //not used
		$packet .= DataUtil::toInt(0);  //not used
		$packet .= DataUtil::toByte(0); //not used
		$packet .= DataUtil::toByte(0); //not used
		$packet .= DataUtil::toByte(0); //not used
		$packet .= DataUtil::toByte(0); //not used
		
		MinecraftPHP::$socket->write($packet);
	}

	public static function readPacketData() {
		if(MinecraftPHP::$debug) MinecraftPHP::$logger->log("DEBUG: Packet1->readPacketData()");
		
		$entityID    = DataUtil::fromInt(MinecraftPHP::$socket->read(4));
		$length      = DataUtil::fromShort(MinecraftPHP::$socket->read(2));
		$notUsed     = DataUtil::fromStr16(MinecraftPHP::$socket->read($length));
		$mapSeed     = DataUtil::fromLong(MinecraftPHP::$socket->read(8));
		$serverMode  = DataUtil::fromInt(MinecraftPHP::$socket->read(4));
		$dimension   = DataUtil::fromByte(MinecraftPHP::$socket->read(1));
		$difficulty  = DataUtil::fromByte(MinecraftPHP::$socket->read(1));
		$worldHeight = DataUtil::fromUnsignedByte(MinecraftPHP::$socket->read(4));
		$maxPlayers  = DataUtil::fromUnsignedByte(MinecraftPHP::$socket->read(4));
		
		if(MinecraftPHP::$debug) print_r(array($entityID, $length, $notUsed, $mapSeed, $serverMode, $dimension, $worldHeight, $maxPlayers));
		
		$return = array(
			"entityID" => $entityID, 
			"length" => $length, 
			$notUsed, 
			"mapSeed" => $mapSeed, 
			"serverMode" => $serverMode, 
			"dimension" => $dimension,
			"difficulty" => $difficulty,
			"worldHeight" => $worldHeight, 
			"maxPlayers" => $maxPlayers
		);
		
		return $return;
	}
}