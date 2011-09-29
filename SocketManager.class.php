<?php
namespace de\wbbaddons\minecraft\api;

use de\wbbaddons\minecraft\api\util\DataUtil;
use de\wbbaddons\minecraft\api\exception\ConnectionException;

class SocketManager {
	private $socket;
	private $host;
	private $port;
	public $isConnected = false;
	const SOCKET_CHECK_TIMEOUT = 2; 
	
	public function __construct($host, $port) {
		$this->host = $host;
		$this->port = $port;
				
		if (!$this->isConnected) {
			if(MinecraftPHP::$debug) MinecraftPHP::$logger->log("DEBUG: Creating socket.");
			
			if (($this->socket = socket_create(AF_INET, SOCK_STREAM, getprotobyname('tcp'))) === false)
				new ConnectionException('Failed to initiate a socket.');
			if (($result = socket_connect($this->socket, $this->host, $this->port))=== false)
				new ConnectionException('Failed to connect via socket.');
				
			$this->isConnected = true;
			
			return $result;
		}
		return false;
	}
	
	public function write($data) {
		if ($this->isConnected) {
			if(MinecraftPHP::$debug) MinecraftPHP::$logger->log("DEBUG: Writing to socket: " . $data);
			$socketWrite = socket_write($this->socket, $data, strlen($data));
			if ($socketWrite === false) {
				new ConnectionException('writing data');
			}

			return $socketWrite;
		}

		return false;
	}

	public function check() {
		if ($this->isConnected) {
			if(MinecraftPHP::$debug) MinecraftPHP::$logger->log("DEBUG: Checking socket for updates.");
			$read = array($this->socket);
			$write = $except = null;
			if (($state = socket_select($read, $write, $except, self::SOCKET_CHECK_TIMEOUT, self::SOCKET_CHECK_TIMEOUT)) === false)
				new ConnectionException('checking modified sockets');
		}
		
		return $state;
	}

	public function read($length = 1) {
		if ($this->isConnected) {
			if (($data = socket_read($this->socket, $length)) === false)
				new ConnectionException('reading from the socket');
			if(MinecraftPHP::$debug) MinecraftPHP::$logger->log("DEBUG: Read the fullowing data from socket: " . $data);
		}
		
		return $data;
	}
	
	public function disconnect() {
		if ($this->isConnected) {
			if(MinecraftPHP::$debug) MinecraftPHP::$logger->log("DEBUG: Disconnecting.");
			$this->write(chr(255).DataUtil::toStr16('Quit(self::Life);'));
			$close = socket_close($this->socket);

			$this->isConnected = false;

			if ($close === false)
				new ConnectionException('Failed to close socket.');

			return $close;
		}

		return false;
	}	
}