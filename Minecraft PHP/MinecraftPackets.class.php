<?php
require_once("SocketManager.class.php");

class MinecraftPackets {

	/*
	 * TODO:
	 * EVERYTHING ...
	 */

	public function __construct() {
		//start SockManager?
	}

	public function Packet1Write($username) {
		$package  = self::toInt(15);
		$package .= self::toStr16($username);
		$package .= self::toLong(0);
		$package .= self::toByte(0);
			
		//Write to socket with SockManager
	}

	/**
	 * This function sends a handshake to the server.
	 * The handshake must be sent before the login package (Packet1)
	 * @param string $username
	 */
	public function Packet2Write($username) {
		$package  = chr(2); //Packet prefix
		$package .= self::toStr16($username);
			
		//Write to socket with SockManager
	}

	public function Packet2Read($data) {
		$return = self::readStr16($return);
		return $return;
	}

	/**
	 *
	 * This function returns the given data as modified string16.
	 * @param string $data
	 * @return string16
	 */
	public static function toStr16($data) {
		$return  = pack("n", strlen($data));
		$return .= mb_convert_encoding($data, "UCS-2LE");
		return $return;
	}

	/**
	 *
	 * This functions returns the data as decoded string16.
	 * @param unknown_type $data
	 */
	public static function readStr16($data) {
		//To be written ...
		return $data;
	}

	/*
	 * The following functions must be tested ...
	 */

	/**
	 *
	 * This functions returns the given data as packed byte.
	 * @param int $b
	 */
	public static function toByte($b) {
		return pack('c' ,$b);
	}

	/**
	 *
	 * This function returns the given data as int like Java does.
	 * @param int $v
	 */
	public static function toInt($v) {
		$data  = self::toByte($v >> 24 & 0xFF);
		$data .= self::toByte($v >> 16 & 0xFF);
		$data .= self::toByte($v >>  8 & 0xFF);
		$data .= self::toByte($v >>  0 & 0xFF);
			
		return $data;
	}

	/**
	 *
	 * This function returns the given data as short like Java does.
	 * @param int $v
	 */
	public static function toShort($v) {
		$data .= self::toByte($v >>  8 & 0xFF);
		$data .= self::toByte($v >>  0 & 0xFF);
			
		return $data;
	}

	/**
	 *
	 * This function returns the given data as long like Java does.
	 * @param int $v
	 */
	public static function toLong($v) {
		$data  = self::toByte($v >> 56 & 0xFF);
		$data  = self::toByte($v >> 48 & 0xFF);
		$data  = self::toByte($v >> 40 & 0xFF);
		$data  = self::toByte($v >> 32 & 0xFF);
		$data  = self::toByte($v >> 24 & 0xFF);
		$data .= self::toByte($v >> 16 & 0xFF);
		$data .= self::toByte($v >>  8 & 0xFF);
		$data .= self::toByte($v >>  0 & 0xFF);

		return $data;
	}
}
?>