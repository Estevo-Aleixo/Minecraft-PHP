<?php
namespace de\wbbaddons\minecraft\api\packet;
use de\wbbaddons\minecraft\api\util\DataUtil;
use de\wbbaddons\minecraft\api\MinecraftPHP;

class Packet0 {
	public static function writePacketData($id) {
		DataUtil::toInt($id);
	}

	public static function readPacketData() {
		DataUtil::fromInt(MinecraftPHP::$socket->read(4));
	}
}