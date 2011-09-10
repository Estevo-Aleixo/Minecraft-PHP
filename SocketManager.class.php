<?php

/**
 * Creates and manage the socket things.
 *
 * @author  kurtextem <kurtextrem@gmail.com>, Max
 * @license GNU Lesser General Public License <http://opensource.org/licenses/lgpl-license.php>
 * @package Minecraft-PHP
 */
class SocketManager {

	/**
	 * Represents the before opened socket.
	 *
	 * @var socket
	 */
	private $socket = null;

	/**
	 * Represents the server ip / url.
	 *
	 * @var mixed
	 */
	public $serverIP;

	/**
	 * Represents the port from the server.
	 *
	 * @var integer
	 */
	public $serverPort = 25565;

	/**
	 * Are we connected yet?
	 *
	 * @var boolean
	 */
	public $isConnected = false;

	const SOCKET_READ_MAX = 512;
	
	/**
	 * Calls the socket initiator.
	 *
	 * @param mixed   $serverIP
	 * @param integer $serverPort
	 */
	public function __construct($serverIP, $serverPort) {
		$this->serverIP = $serverIP;
		$this->serverPort = $serverPort;

		$this->initSocket();
	}

	/**
	 * Initiates the socket.
	 *
	 * @return mixed
	 */
	private function initSocket() {
		if (!$this->isConnected) {
			$this->socket = socket_create(AF_INET, SOCK_STREAM, getprotobyname('tcp'));
			if ($this->socket === false)
				$this->socketError();
			$result = socket_connect($this->socket, $this->serverIP, $this->serverPort);
			if ($result === false)
				$this->socketError();

			$this->isConnected = true;

			return $result;
		}

		return false;
	}

	/**
	 * Returns the socket.
	 *
	 * @return socket
	 */
	public function getSocket() {
		return $this->socket();
	}

	/**
	 * Handles a socketError.
	 *
	 * @todo go out of hardcoded strings.
	 */
	public function socketError() {
		$errorCode = socket_last_error();
		$errorMsg = socket_strerror($errorCode);

		die('There was a problem with the sockets:\n['.$errorCode.'] '.$errorMsg);
	}

	/**
	 * Writes $data to the initiated socket.
	 *
	 * @param  mixed $data
	 * @return int   (how many bytes are written)
	 */
	public function write($data) {
		if ($this->isConnected) {
			$socketWrite = socket_write($this->socket, $data, strlen($data));
			if ($socketWrite === false) {
				$this->socketError();
			}

			return $socketWrite;
		}

		return false;
	}

	/**
	* Returns a count of modified sockets
	* Note: This returns 0 if no sockets modified
	*
	* @return integer
	*/
	public function check() {
		$read   = array($this->socket);
		$write  = array($this->socket);
		$except = array($this->socket);
		if (($state = socket_select($read, $write, $except, self::SOCKET_CHECK_TIMEOUT, self::SOCKET_CHECK_TIMEOUT)) === false)
			die("An error occoured: ".socket_strerror(socket_last_error($this->socket)), socket_last_error($this->socket));
		
		return count($read);
	}
	
	/**
	 * Reads data from the socket.
	 *
	 * @todo create the function.
	 */
	public function read() {
		if (($data = socket_read($this->socket, self::SOCKET_READ_MAX, PHP_NORMAL_READ)) === false)
			die("An error occoured while reading from socket: ".socket_strerror(socket_last_error($this->socket)), socket_last_error($this->socket));
	}

	/**
	 * Change the server connection.
	 *
	 * @param  mixed   $newServerIP
	 * @param  integer $newServerPort
	 * @return mixed
	 */
	public function changeServer($newServerIP, $newServerPort = 25565) {
		if (!$this->isConnected) {
			$this->isConnected = false;
			$this->serverIP = $newServerIP;
			$this->serverPort = $newServerPort;

			return $this->initSocket();
		}

		return false;
	}

	/**
	 * Disconnects from server.
	 *
	 * @return mixed
	 */
	public function disconnect() {
		if ($this->isConnected) {
			$this->write(DataUtil::toStr16('Bye from PHP Minecraft API @.@'));
			$close = socket_close($this->socket);

			$this->isConnected = false;

			if ($close === false)
				$this->socketError();

			return $close;
		}

		return false;
	}

	/**
	 * Reconnets to server (after disconnect).
	 *
	 * @return boolean
	 */
	public function reconnect() {
		if (!$this->isConnected) {
			$this->initSocket();

			return true;
		}

		return false;
	}

}

?>