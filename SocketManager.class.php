<?php

class SocketManager {

	/**
	 * Represents the before opened socket.
	 *
	 * @var socket
	 */
	private $socket = null;

	/**
	 * Calls the socket initiator.
	 */
	public function __construct() {
		if ($this->initSocket() === false) {
			$this->socketError();
		}
	}

	/**
	 * Initiates the socket.
	 *
	 * @return boolean
	 */
	private function initSocket() {
		$this->socket = socket_create(AF_INET, SOCK_STREAM, getprotobyname('tcp'));

		return $this->socket;
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
	 */
	public function socketError() {
		$errorCode = socket_last_error();
		$errorMsg = socket_strerror($errorCode);

		die('There was a problem with the sockets: [' . $errorCode . '] ' . $errorMsg');
	}

	/**
	 * Writes $data to the initiated socket.
	 *
	 * @param  mixed $data
	 * @return int (how many bytes are written)
	 */
	public function write($data) {
		$socketWrite = socket_write($this->socket, $data, strlen($data));
		if ($socketWrite === false) {
			$this->socketError();
		}
		
		return $socketWrite;
	}

}

?>