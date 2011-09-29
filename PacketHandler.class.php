<?php
namespace de\wbbaddons\minecraft\api;

class PacketHandler {
	public static function parse($data) {
		$packet = "de\wbbaddons\minecraft\api\packet\Packet".ord($data);
		print_r($packet::readPacketData());
	}
}