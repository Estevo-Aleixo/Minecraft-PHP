<?php

require_once('MinecraftPackets.class.php');

define('MINECRAFT_VERSION', 15); // update this if you get problems

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
	 */
	public function __construct($username, $password) {
		new MinecraftPackets($username, $password);
	}

}

new MinecraftPHP('hans', 'mypassword');

?>