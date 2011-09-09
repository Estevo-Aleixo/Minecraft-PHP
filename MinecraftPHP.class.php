<?php

require_once('MinecraftPackets.class.php');

/**
 * Update this if you get problems
 *
 * @todo get newest version automatically.
 */
define('MINECRAFT_VERSION', 17);

/**
 * Initiates a server connection.
 *
 * @author  kurtextem <kurtextrem@gmail.com>, _MaX_
 * @license GNU Lesser General Public License <http://opensource.org/licenses/lgpl-license.php>
 * @package Minecraft-PHP
 */
class MinecraftPHP {

	/**
	 * Initiates a new minecraft-server connection.
	 *
	 * @param string $username
	 * @param string $password
	 * @param mixed  $serverIP
	 */
	public function __construct($username, $password, $serverIP) {
		new MinecraftPackets($username, $password, $serverIP);
	}

}

?>