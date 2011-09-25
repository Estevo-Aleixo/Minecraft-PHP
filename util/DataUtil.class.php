<?php

namespace de\wbbaddons\minecraft\api\util;

/**
 * Convert from X to Y.
 *
 * @author  	Max
 * @license 	GNU Lesser General Public License <http://opensource.org/licenses/lgpl-license.php>
 * @package 	de\wbbaddons\minecraft\api
 * @subpackage	util
 */
class DataUtil {


	public static function toStr16($data) {
		$return = pack("n", strlen($data));
		$return .= mb_convert_encoding($data, "UTF-16");

		return $return;
	}

	public static function readStr16($data) {
		return mb_convert_encoding($data, "UTF-8");
	}

	
	public static function toByte($b) {
		return pack('c', $b);
	}
	
	public static function fromByte($b) {

	}	

	
	public static function toShort($v) {
		$data = self::toByte($v >> 8 & 0xFF);
		$data .= self::toByte($v >> 0 & 0xFF);

		return $data;
	}

	public static function fromShort($v) {

	}
	
	
	public static function toInt($v) {
		$data = self::toByte($v >> 24 & 0xFF);
		$data .= self::toByte($v >> 16 & 0xFF);
		$data .= self::toByte($v >> 8 & 0xFF);
		$data .= self::toByte($v >> 0 & 0xFF);

		return $data;
	}

	public static function fromInt($v) {

	}
	
	
	public static function toLong($v) {
		$data = self::toByte($v >> 56 & 0xFF);
		$data .= self::toByte($v >> 48 & 0xFF);
		$data .= self::toByte($v >> 40 & 0xFF);
		$data .= self::toByte($v >> 32 & 0xFF);
		$data .= self::toByte($v >> 24 & 0xFF);
		$data .= self::toByte($v >> 16 & 0xFF);
		$data .= self::toByte($v >> 8 & 0xFF);
		$data .= self::toByte($v >> 0 & 0xFF);

		return $data;
	}

	public static function fromLong($v) {

	}
	
	
	public static function toFloat($v) {

	}
	
	public static function fromFloat($v) {

	} 
}
