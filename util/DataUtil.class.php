<?php
namespace de\wbbaddons\minecraft\api\util;
use de\wbbaddons\minecraft\api\MinecraftPHP;

/**
 * Convert from X to Y.
 *
 * @author  	Max
 * @license 	GNU Lesser General Public License <http://opensource.org/licenses/lgpl-license.php>
 * @package 	de\wbbaddons\minecraft\api
 * @subpackage	util
 */
class DataUtil {


	public static function toStr16($v) {
		$str16 = self::toShort(strlen($v));
		$str16 .= mb_convert_encoding($v, "UTF-16");
		
		if(MinecraftPHP::$debug) MinecraftPHP::$logger->log("DEBUG: DataUtil::toStr16->v = " . $v);
		if(MinecraftPHP::$debug) MinecraftPHP::$logger->log("DEBUG: DataUtil::toStr16->str16 = " . $str16);
		
		return $str16;
	}

	public static function fromStr16($v) {
		if(MinecraftPHP::$debug) MinecraftPHP::$logger->log("DEBUG: DataUtil::fromStr16->v = " . $v);
		if(MinecraftPHP::$debug) MinecraftPHP::$logger->log("DEBUG: DataUtil::fromStr16->decoded = " . mb_convert_encoding($v, "UTF-8"));
		
		return mb_convert_encoding($v, "UTF-8");
	}


	public static function toByte($v) {
		$byte = pack('c', $v);
		
		if(MinecraftPHP::$debug) MinecraftPHP::$logger->log("DEBUG: DataUtil::toByte->v = " . $v);
		if(MinecraftPHP::$debug) MinecraftPHP::$logger->log("DEBUG: DataUtil::toByte->byte = " . $byte);
		
		return $byte;
	}

	public static function fromByte($v) {
		$ord = ord($v);
		if ($ord > 127) {
			$ord =  -$ord - 2 * (128 - $ord);
		}
		
		if(MinecraftPHP::$debug) MinecraftPHP::$logger->log("DEBUG: DataUtil::fromByte->v = " . $v);
		if(MinecraftPHP::$debug) MinecraftPHP::$logger->log("DEBUG: DataUtil::fromByte->ord = " . $ord);
		
		return $ord;
	}


	public static function toShort($v) {
		$short  = self::toByte($v >> 8 & 0xFF);
		$short .= self::toByte($v >> 0 & 0xFF);

		if(MinecraftPHP::$debug) MinecraftPHP::$logger->log("DEBUG: DataUtil::toShort->v = " . $v);
		if(MinecraftPHP::$debug) MinecraftPHP::$logger->log("DEBUG: DataUtil::toShort->short = " . $short);
		
		return $short;
	}

	public static function fromShort($v) {
		list(, $int) = unpack('s*', $v);
		
		if(MinecraftPHP::$debug) MinecraftPHP::$logger->log("DEBUG: DataUtil::fromShort->v = " . $v);
		if(MinecraftPHP::$debug) MinecraftPHP::$logger->log("DEBUG: DataUtil::fromShort->int = " . $int);
		
		return $int;
	}


	public static function toInt($v) {
		$int = self::toByte($v >> 24 & 0xFF);
		$int .= self::toByte($v >> 16 & 0xFF);
		$int .= self::toByte($v >> 8 & 0xFF);
		$int .= self::toByte($v >> 0 & 0xFF);
		
		if(MinecraftPHP::$debug) MinecraftPHP::$logger->log("DEBUG: DataUtil::toInt->v = " . $v);
		if(MinecraftPHP::$debug) MinecraftPHP::$logger->log("DEBUG: DataUtil::toInt->int = " . $int);

		return $int;
	}

	public static function fromInt($v) {
		list(, $int) = unpack('l*', $v);
		
		if(MinecraftPHP::$debug) MinecraftPHP::$logger->log("DEBUG: DataUtil::fromInt->v = " . $v);
		if(MinecraftPHP::$debug) MinecraftPHP::$logger->log("DEBUG: DataUtil::fromInt->int = " . $int);
		
		return $int;
	}


	public static function toLong($v) {
		$long = self::toByte($v >> 56 & 0xFF);
		$long .= self::toByte($v >> 48 & 0xFF);
		$long .= self::toByte($v >> 40 & 0xFF);
		$long .= self::toByte($v >> 32 & 0xFF);
		$long .= self::toByte($v >> 24 & 0xFF);
		$long .= self::toByte($v >> 16 & 0xFF);
		$long .= self::toByte($v >> 8 & 0xFF);
		$long .= self::toByte($v >> 0 & 0xFF);
		
		if(MinecraftPHP::$debug) MinecraftPHP::$logger->log("DEBUG: DataUtil::toLong->v = " . $v);
		if(MinecraftPHP::$debug) MinecraftPHP::$logger->log("DEBUG: DataUtil::toLong->long = " . $long);

		return $long;
	}

	public static function fromLong($v) {
		@list(, $hihi, $hilo, $lohi, $lolo) = unpack('n*', $v);
		return ($hihi * (0xffff+1) + $hilo) * (0xffffffff+1) + ($lohi * (0xffff+1) + $lolo);
	}


	public static function toFloat($v) {

	}

	public static function fromFloat($v) {
		list(, $float) = unpack('f', $v);
		return $float;
	}

	public static function toDouble($v) {

	}

	public static function fromDouble($v) {
		list(, $double) = unpack('d', $v);
		return $double;
	}

	public static function toBool($v) {
		if($v >= 1) $v = 1;
		elseif($v <= 0) $v = 0;
		
		return self::toByte($v);
	}

	public static function fromBool($v) {
		return ord($v);
	}
}
