<?php

namespace de\wbbaddons\minecraft\api;
spl_autoload_register(function ($class) {
		require_once(__DIR__.'/'.str_replace(array('de\\wbbaddons\\minecraft\\api', '\\'), array('', DIRECTORY_SEPARATOR), $class).'.class.php');
	});

/**
 * Initiates a server connection.
 *
 * @author  	kurtextem <kurtextrem@gmail.com>, Max
 * @license 	GNU Lesser General Public License <http://opensource.org/licenses/lgpl-license.php>
 * @package 	de\wbbaddons\minecraft\api
 */
class MinecraftPHP {

	/**
	 * Should we create a session?
	 *
	 * @var boolean
	 */
	private $createSession = false;

	/**
	 * Password from user.
	 *
	 * @var string
	 */
	private $password = '';

	/**
	 * Nickname from User.
	 *
	 * @var string
	 */
	private $username = 'MinecraftPHP-Bot';

	/**
	 * Server IP / host.
	 *
	 * @var mixed
	 */
	private $serverHost = 'localhost';

	/**
	 * Server port.
	 *
	 * @var integer
	 */
	private $serverPort = 25565;

	/**
	 * Initiates a new minecraft-server connection.
	 *
	 */
	public function init() {
		if ($this->createSession == true) {
			//should be tested after handshake, but for now this is good enough ... 
			//if sever returns a "-", we don't need to create a sesseion, if it returns a "+", we have to.
			//It could also return a unique hash, if so: http://www.minecraft.net/game/joinserver.jsp?user=<username>&sessionId=<session id>&serverId=<server hash>
			new LoginManager($this->username, $this->password);
		}
		$this->socket = new SocketManager($this->serverHost, $this->serverPort);
		$this->packets = new MinecraftPackets($this->socket);

		$this->connect();
		$this->listen();
	}

	/**
	 * Connects to server.
	 */
	public function connect() {
		$this->packets->packet2Write($this->username);

		do {
			if ($this->socket->check() > 0) {
				$data = $this->socket->read();
				$answered = CommandParser::parse($data);
			}
		} while (!$answered);

		$this->packets->packet1Write($this->username);

		do {
			if ($this->socket->check() > 0) {
				$data = $this->socket->read();
				$loggedIn = CommandParser::parse($data);
			}
		} while (!$loggedIn);

		$this->packets->packet3Write("Hello, here it is ".date("d.m.y - H:i:s"));
	}

	/**
	 * Connection main loop.
	 */
	protected function listen() {
		while ($this->socket->isConnected) {
			if ($this->socket->check() > 0) {
				$data = $this->socket->read();
				CommandParser::parse($data);
			}
		}
	}

	/**
	 * Disconnects from Server.
	 */
	public function disconnect() {
		$this->socket->disconnect();
	}

	/**
	 * Returns the username.
	 *
	 * @return string
	 */
	public function getUsername() {
		return $this->username;
	}

	/**
	 * Sets the username.
	 *
	 * @param string $username
	 */
	public function setUsername($username) {
		$this->username = substr($username, 0, 16);
	}

	/**
	 * Sets the password.
	 *
	 * @param string $password
	 */
	public function setPassword($password) {
		$this->password = $password;
	}

	/**
	 * Sets the server port.
	 *
	 * @param integer $port
	 */
	public function setServerPort($port) {
		$this->serverPort = $port;
	}

	/**
	 * Sets the server host.
	 *
	 * @param mixed $host
	 */
	public function setServerHost($host) {
		$this->serverHost = $host;
	}

	// should be obsolete if SocketManager is completely implemented.
	public function setCreateSession($s) {
		$this->createSesseion = $s;
	}

}
