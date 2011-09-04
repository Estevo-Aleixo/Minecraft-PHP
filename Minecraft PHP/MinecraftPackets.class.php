<?php 
	require_once("SocketManager.php");
	
	class MinecraftPackets {
		
		public function construct() {
			$sock = new SocketManager();
		}
		/*
		 * This function sends a handshake to the server.
		 * The handshake must be sent before the login package (Packet1) 
		 */
		public function Packet2Write($username) {
			$package  = chr(2); //Packet prefix
			$package .= str16($username);
			
			//SocketManager write function should be here ...
		}
		
		public static function str16($data) {
			$return  = pack("n", strlen($data));
			$return .= mb_convert_encoding($data, "UCS-2LE");
			return $return;
		}
	}
?>