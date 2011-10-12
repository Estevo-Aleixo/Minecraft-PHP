<?php
namespace de\wbbaddons\minecraft\api\packet;
use de\wbbaddons\minecraft\api\util\DataUtil;
use de\wbbaddons\minecraft\api\MinecraftPHP;

class Packet1 {
	public static function writePacketData($username) {
		$package  = chr(1); // Packet prefix
		$package .= DataUtil::toInt(19); //must be edited if a new protocol version comes out.
		$package .= DataUtil::toStr16($username); //username
		$package .= DataUtil::toLong(0); //not used
		$package .= DataUtil::toInt(0);  //not used
		$package .= DataUtil::toByte(0); //not used
		$package .= DataUtil::toByte(0); //not used
		$package .= DataUtil::toByte(0); //not used
		$package .= DataUtil::toByte(0); //not used
		
		MinecraftPHP::$socket->write($package);
	}

	public static function readPacketData() {
		if(MinecraftPHP::$debug) MinecraftPHP::$logger->log("DEBUG: Packet1->readPacketData()");
		
		$entityID    = DataUtil::fromInt(MinecraftPHP::$socket->read(4));
		$length      = DataUtil::fromShort(MinecraftPHP::$socket->read(2));
		$notUsed     = DataUtil::fromStr16(MinecraftPHP::$socket->read($length));
		$mapSeed     = DataUtil::fromLong(MinecraftPHP::$socket->read(8));
		$serverMode  = DataUtil::fromInt(MinecraftPHP::$socket->read(4));
		$dimension   = DataUtil::fromInt(MinecraftPHP::$socket->read(4));
		$worldHeight = DataUtil::fromInt(MinecraftPHP::$socket->read(4));
		$maxPlayers  = DataUtil::fromInt(MinecraftPHP::$socket->read(4));
		
		if(MinecraftPHP::$debug) print_r(array($entityID, $length, $notUsed, $mapSeed, $serverMode, $dimension, $worldHeight, $maxPlayers));
		
		$return = array(
						"entityID" => $entityID, 
						"length" => $length, 
						$notUsed, 
						"mapSeed" => $mapSeed, 
						"serverMode" => $serverMode, 
						"dimension" => $dimension, 
						"worldHeight" => $worldHeight, 
						"maxPlayers" => $maxPlayers
						);
		
		return $return;
	}
}