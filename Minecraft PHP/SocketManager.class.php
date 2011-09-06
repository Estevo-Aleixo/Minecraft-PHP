<?php 
	class SocketManager {
		
		/**
		* Initiates the socket
		*
		* @param string $config
		*/
		public function __construct($config) {
			$this->initSocket();
		}
		
		/**
		* Creates a new socket
		*/
		private function initSocket() {
			$this->socket = socket_create(AF_INET, SOCK_STREAM, getprotobyname('tcp'));
		}
		
		/**
		* Writes data to the socket
		* 
		* @param string $data
		*/
		public function write($data) {
			socket_write($this->socket, $data, strlen($data));
		}
	}
?>