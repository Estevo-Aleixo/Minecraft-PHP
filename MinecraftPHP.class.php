<?php
require_once('MinecraftPackets.class.php');
require_once('SocketManager.class.php');

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
	private $createSession = false;
	private $password 		= "";
	public  $username  		= "MinecraftPHP-Bot";
	public  $serverHost 	= "127.0.0.1";
	public  $serverPort 	= 25565;
	
	/**
	 * Initiates a new minecraft-server connection.
	 *
	 */
	public function init() {
		if($this->createSession == true) { //should be tested after handshake, but for now this is good enough ... if sever returns a "-", we don't need to create a sesseion, if it returns a "+", we have to. It could also return a unique hash, I don't know, what it is for ...
			require_once('LoginManager.class.php');
			new LoginManager($this->username, $this->password);
		}
		$this->socket  = new SocketManager($this->serverHost, $this->serverPort);
		$this->packets = new MinecraftPackets($this->socket);
		
		$this->connect();
	}
	
	public function connect() {
		$this->packets->packet2Write($this->username);
		//TODO: Check what the server returns ...
		$this->packets->packet1Write($this->username);
		//TODO: Check if successed or failed ...
		sleep(5); //dirty
		$this->packets->packet3Write("Hello");
		$this->packets->packet3Write("and");
		$this->packets->packet3Write("bye");
		sleep(2);
	}
	
	public function setUsername($username) {
		$this->username = substr($username, 0, 16);
	}
	
	public function getUsername() {
		return $this->username;
	}
	
	public function setPassword($password) {
		$this->password = $password;
	}
	
	public function setServerPort($port) {
		$this->serverPort = $port;
	}
	
	//should be obsolete if SocketManager is completely implemented.
	public function setCreateSession($s) {
		$this->createSesseion = $s;
	}
}

?>