<?php
namespace de\wbbaddons\minecraft\api;

class PacketHandler {
	public static function parse($id) {
		$packet = "de\wbbaddons\minecraft\api\packet\Packet".$id;
		
		if(is_file(__DIR__ . '/packet/Packet' . $id . '.class.php')) {
			try {
				$packet::readPacketData();
			} catch (\Exception $e) {
				$code = $e->getCode();		
				switch($code) {
					case 666:
					case 1337:
						break;
				}
			}
		}
	}
}