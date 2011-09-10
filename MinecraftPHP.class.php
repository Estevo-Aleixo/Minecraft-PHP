<?php

require_once('MinecraftPackets.class.php');

/**
 * Update this if you get problems
 *
 * @todo get newest version automatically.
 */

/**
 * Initiates a server connection.
 *
 * @author  kurtextem <kurtextrem@gmail.com>, Max
 * @license GNU Lesser General Public License <http://opensource.org/licenses/lgpl-license.php>
 * @package Minecraft-PHP
 */
class MinecraftPHP {
		
	/**
	 * Initiates a new minecraft-server connection.
	 *
	 * @param string  $username
	 * @param string  $password
	 * @param mixed   $serverIP
	 * @param integer $serverPort
	 */
	public function __construct($username, $password, $serverIP, $serverPort = 25565) {
		new MinecraftPackets($username, $password, $serverIP, $serverPort);
	}

}

?>