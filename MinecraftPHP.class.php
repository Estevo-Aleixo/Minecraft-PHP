<?php

require_once('MinecraftPackets.class.php');

class MinecraftPHP {

	/**
	 * Initiates a new minecraft-server connection.
	 *
	 * @param string $username
	 */
	public function __construct($username) {
		new MinecraftPackets($username);
	}

}

new MinecraftPHP('kurtextrem');

?>