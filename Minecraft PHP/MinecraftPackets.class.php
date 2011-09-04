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
			$package .= self::writeStr16($username);
			
			$sock->write($package);
		}
		
		/*
		 * This functions reads the Handshake package sent from server as answer to its handshake packet.
		 */
		public function Packet2Read($data) {
			$return = substr($data, 1); //strip packet id
			$return = self::readStr16($return);
			return $return;
		}
		
		public static function writeStr16($data) {
			$return  = pack("n", strlen($data));
			$return .= mb_convert_encoding($data, "UCS-2LE");
			return $return;
		}
		
		public static function readStr16($data) {
			return $data;
		}
	}
?>