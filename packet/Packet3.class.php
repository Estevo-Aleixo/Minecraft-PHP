<?php
namespace de\wbbaddons\minecraft\api\packet;
use de\wbbaddons\minecraft\api\util\DataUtil;
use de\wbbaddons\minecraft\api\MinecraftPHP;

class Packet3 {
	public static function writePacketData($message) {
		$packet  = chr(3);
		//replace all non allowed chars and strip the message down to max. 199 chars.
		$message = preg_replace("~[^ !\"#$%&'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\\]^_abcdefghijklmnopqrstuvwxyz{|}\~¦ÇüéâäàåçêëèïîìÄÅÉæÆôöòûùÿÖÜø£Ø×ƒáíóúñÑªº¿®¬½¼¡«»]~", '', substr($message, 0, 119));
		$packet .= DataUtil::toStr16($message);
		
		MinecraftPHP::$socket->write($packet);
	}

	public static function readPacketData() {
		//get length of the str16 value.
		$length = DataUtil::fromShort(MinecraftPHP::$socket->read(2));
		$message = DataUtil::fromStr16(MinecraftPHP::$socket->read($length));
		
		//log message
		if(isset($message) && !empty($message)) MinecraftPHP::$logger->log("CHAT: " . $message);

		return (isset($message) && !empty($message)) ? $message : '';
	}
}