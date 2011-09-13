<?php

namespace de\wbbaddons\minecraft\api\packets;
use Packet;

class Packet2 implements Packet {
	public static function writePacketData($data) {
		$package  = chr(3); // Packet prefix
		$package .= DataUtil::toStr16($data); //message
		
		//socketManager->write($package);
	}

	public static function readPacketData() {
		//$length = DataUtil::fromShort(socketManager->read(2));
		//return = DataUtil::readStr16(socketManager->read($length));
	}
}