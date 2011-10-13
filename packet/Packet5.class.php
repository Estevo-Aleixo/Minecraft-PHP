<?php
namespace de\wbbaddons\minecraft\api\packet;
use de\wbbaddons\minecraft\api\util\DataUtil;
use de\wbbaddons\minecraft\api\MinecraftPHP;
use de\wbbaddons\minecraft\api\exception\ProtocolException;

class Packet5 {
	public static function writePacketData() {
		throw new ProtocolException('Server to client only', 1337);
	}

	public static function readPacketData() {
		$entityID = DataUtil::fromInt(MinecraftPHP::$socket->read(4));
		$slot = DataUtil::fromShort(MinecraftPHP::$socket->read(2));
		$itemID = DataUtil::fromShort(MinecraftPHP::$socket->read(2));
		$damage = DataUtil::fromShort(MinecraftPHP::$socket->read(2));
		
		$return = array(
			"entityID" => $entityID, 
			"slot" => $slot, 
			"itemID" => $itemID, 
			"damage" => $damage
		);
		
		return $return;		
	}
}