<?php
require_once("DataUtil.class.php");

class MinecraftPackets {

	/*
	 * TODO:
	 * EVERYTHING ...
	 */

	public function __construct() {
		//start SockManager?
	}

	public function Packet1Write($username) {
		$package  = DataUtil::toInt(15);
		$package .= DataUtil::toStr16($username);
		$package .= DataUtil::toLong(0);
		$package .= DataUtil::toByte(0);
			
		//Write to socket with SockManager
	}

	/**
	 * This function sends a handshake to the server.
	 * The handshake must be sent before the login package (Packet1)
	 * @param string $username
	 */
	public function Packet2Write($username) {
		$package  = chr(2); //Packet prefix
		$package .= DataUtil::toStr16($username);
			
		//Write to socket with SockManager
	}

	public function Packet2Read($data) {
		$return = DataUtil::readStr16($return);
		return $return;
	}
?>