<?php
namespace de\wbbaddons\minecraft\api;
spl_autoload_register(function ($class) {
	require_once(__DIR__.'/'.str_replace(array('de\\wbbaddons\\minecraft\\api', '\\'), array('', DIRECTORY_SEPARATOR), $class).'.class.php');
});

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
	private $password = '';
	private $username = 'MinecraftPHP-Bot';
	private $serverHost = "127.0.0.1";
	private $serverPort = 25565;
	
	/**
	 * Initiates a new minecraft-server connection.
	 *
	 */
	public function init() {
		if($this->createSession == true) {
			//should be tested after handshake, but for now this is good enough ... 
			//if sever returns a "-", we don't need to create a sesseion, if it returns a "+", we have to.
			//It could also return a unique hash, if so: http://www.minecraft.net/game/joinserver.jsp?user=<username>&sessionId=<session id>&serverId=<server hash>
			require_once('LoginManager.class.php');
			new LoginManager($this->username, $this->password);
		}
		$this->socket  = new SocketManager($this->serverHost, $this->serverPort);
		$this->packets = new MinecraftPackets($this->socket);
		
		$this->connect();
		$this->listen();
	}
	
	public function connect() {
		$this->packets->packet2Write($this->username);
		
		do {
			if ($this->socket->check() > 0) {
				$data = $this->socket->read();
				$answered = CommandParser::parse($data);
			}
		} while(!$answered);
		
		$this->packets->packet1Write($this->username);
		
		do {
			if ($this->socket->check() > 0) {
				$data = $this->socket->read();
				$loggedIn = CommandParser::parse($data);
			}
		} while(!$loggedIn);
		
		$this->packets->packet3Write("Hello, here it is " . date("d.m.y - H:i:s"));
	}
	
	/**
	* Connection main loop
	*/
	protected function listen() {
		while ($this->socket->isConnected == true) {
			if ($this->socket->check() > 0) {
				$data = $this->socket->read();
				CommandParser::parse($data);
			}
		}
	}	
	
	public function disconnect() {
		$this->socket->disconnect();
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