<?php

/**
 * Convert from X to Y.
 *
 * @author  Max
 * @license GNU Lesser General Public License <http://opensource.org/licenses/lgpl-license.php>
 * @package Minecraft-PHP
 * @todo    create function for missing things.
 */

class DataUtil {

	/**
	 * This function returns the given data as modified string16.
	 * 
	 * @param  string   $data
	 * @return string16
	 */
	public static function toStr16($data) {
		$return = pack("n", strlen($data));
		$return .= mb_convert_encoding($data, "UTF-16");

		return $return;
	}

	/**
	 * This functions returns the data as decoded string16.
	 * 
	 * @param  mixed  $data
	 * @return string
	 */
	public static function readStr16($data) {
		// todo: write readStr16 function
		return $data;
	}

	// todo: test the following functions.

	/**
	 * This functions returns the given data as packed byte.
	 *
	 * @param  int  $b
	 * @return byte
	 */
	public static function toByte($b) {
		return pack('c', $b);
	}

	/**
	 * This function returns the given data as int like Java does.
	 * 
	 * @param  int $v
	 * @return int
	 */
	public static function toInt($v) {
		$data = self::toByte($v >> 24 & 0xFF);
		$data .= self::toByte($v >> 16 & 0xFF);
		$data .= self::toByte($v >> 8 & 0xFF);
		$data .= self::toByte($v >> 0 & 0xFF);

		return $data;
	}

	/**
	 * This function returns the given data as short like Java does.
	 * 
	 * @param  int   $v
	 * @return short
	 */
	public static function toShort($v) {
		$data = self::toByte($v >> 8 & 0xFF);
		$data .= self::toByte($v >> 0 & 0xFF);

		return $data;
	}

	/**
	 * This function returns the given data as long like Java does.
	 * 
	 * @param  int  $v
	 * @return long
	 */
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

}

?>
