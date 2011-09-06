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
		$package  = self::writeInt(15);
		$package .= self::writeStr16($username);
		$package .= self::writeLong(0);
		$package .= self::writeByte(0);
			
		//Write to socket with SockManager
	}

	/**
	 * This function sends a handshake to the server.
	 * The handshake must be sent before the login package (Packet1)
	 * @param string $username
	 */
	public function Packet2Write($username) {
		$package  = chr(2); //Packet prefix
		$package .= self::writeStr16($username);
			
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
	public static function writeStr16($data) {
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
	public static function writeByte($b) {
		return pack('c' ,$b);
	}

	/**
	 *
	 * This function returns the given data as int like Java does.
	 * @param int $v
	 */
	public static function writeInt($v) {
		$data  = self::writeByte($v >> 24 & 0xFF);
		$data .= self::writeByte($v >> 16 & 0xFF);
		$data .= self::writeByte($v >>  8 & 0xFF);
		$data .= self::writeByte($v >>  0 & 0xFF);
			
		return $data;
	}

	/**
		*
		* This function returns the given data as short like Java does.
		* @param int $v
		*/
	public static function writeShort($v) {
		$data .= self::writeByte($v >>  8 & 0xFF);
		$data .= self::writeByte($v >>  0 & 0xFF);
			
		return $data;
	}

	/**
		*
		* This function returns the given data as long like Java does.
		* @param int $v
		*/
	public static function writeLong($v) {
		$data  = self::writeByte($v >> 56 & 0xFF);
		$data  = self::writeByte($v >> 48 & 0xFF);
		$data  = self::writeByte($v >> 40 & 0xFF);
		$data  = self::writeByte($v >> 32 & 0xFF);
		$data  = self::writeByte($v >> 24 & 0xFF);
		$data .= self::writeByte($v >> 16 & 0xFF);
		$data .= self::writeByte($v >>  8 & 0xFF);
		$data .= self::writeByte($v >>  0 & 0xFF);

		return $data;
	}
}
?>