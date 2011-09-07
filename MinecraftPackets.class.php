<?php

require_once("DataUtil.class.php");

class MinecraftPackets {
	/*
	 * TODO:
	 * EVERYTHING ...
	 */

	public function __construct() {
		// start SockManager?
	}

	/**
	 * Sends the login package.
	 *
	 * @param type $username
	 */
	public function packet1Write($username) {
		$package = DataUtil::toInt(15);
		$package .= DataUtil::toStr16($username);
		$package .= DataUtil::toLong(0);
		$package .= DataUtil::toByte(0);

		// todo: Write to socket with SockManager (packet1Write)
	}

	/**
	 * This function sends a handshake to the server.
	 * The handshake must be sent before the login package (packet1)
	 *
	 * @param string $username
	 */
	public function packet2Write($username) {
		$package = chr(2); // Packet prefix
		$package .= DataUtil::toStr16($username);

		// todo: Write to socket with SockManager (packet2Write)
	}

	/**
	 * Reads the handshake return.
	 *
	 * @param Str16 $data
	 * @return string
	 */
	public function packet2Read($data) {
		return DataUtil::readStr16($data);
	}

}

?>