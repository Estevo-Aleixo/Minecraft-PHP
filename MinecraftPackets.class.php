<?php

require_once('util/DataUtil.class.php');
require_once('SocketManager.class.php');

class MinecraftPackets {
	/*
	 * TODO:
	 * EVERYTHING ...
	 */

	/**
	 * Represents the SocketManager class
	 *
	 * @var SocketManager()
	 */
	private $socketManager = null;

	public function __construct() {
		$this->socket = new SocketManager();
	}

	/**
	 * Sends the login package.
	 *
	 * @param string $username
	 */
	public function packet1Write($username) {
		$package = DataUtil::toInt(15);
		$package .= DataUtil::toStr16($username);
		$package .= DataUtil::toLong(0);
		$package .= DataUtil::toByte(0);

		$this->socketManager->writetoSocket($package);
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

		$this->socketManager->writetoSocket($package);
	}

	/**
	 * Reads the handshake return.
	 *
	 * @param  Str16  $data
	 * @return string
	 */
	public function packet2string($data) {
		return DataUtil::readStr16($data);
	}

}

?>