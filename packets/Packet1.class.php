<?php

namespace de\wbbaddons\minecraft\api\packets;
use Packet;

class Packet2 implements Packet {
	public static function writePacketData($data) {
		$package  = chr(1); // Packet prefix
		$package .= DataUtil::toInt(PROTOCOL_VERSION); //must be edited if a new protocol version comes out.
		$package .= DataUtil::toStr16($data); //username
		$package .= DataUtil::toLong(0); //not used
		$package .= DataUtil::toInt(0);  //not used
		$package .= DataUtil::toByte(0); //not used
		$package .= DataUtil::toByte(0); //not used
		$package .= DataUtil::toByte(0); //not used
		$package .= DataUtil::toByte(0); //not used
		
		//socketManager->write($package);
	}

	public static function readPacketData() {
		//$entityID    = DataUtil::fromInt(socketManager->read(4));
		//$length      = DataUtil::fromShort(socketManager->read(2));
		//$notUsed     = DataUtil::readStr16(socketManager->read($length));
		//$mapSeed     = DataUtil::fromLong(socketManager->read(8));
		//$serverMode  = DataUtil::fromInt(socketManager->read(4));
		//$dimension   = DataUtil::fromInt(socketManager->read(1));
		//$worldHeight = DataUtil::fromInt(socketManager->read(1));
		//$maxPlayers  = DataUtil::fromUnsignedInt(socketManager->read(1));
		
		//return array(^aboveVars);
	}
}