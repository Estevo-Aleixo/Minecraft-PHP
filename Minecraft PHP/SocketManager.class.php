<?php 
	class SocketManager {
		public function construct($config) {
			$this->initSocket();
		}
		
		/**
		* Creates a new socket
		*/
		public function initSocket() {
			$this->socket = socket_create(AF_INET, SOCK_STREAM, getprotobyname('tcp'));
		}
		
		public function write($data) {
			socket_write($this->socket, $data, strlen($data));
		}
	}
?>