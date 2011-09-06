<?php 
	require_once("SocketManager.class.php");
	
	class MinecraftPackets {
		
		public function __construct() {
			$this->sock = new SocketManager();
		}
		
		public function Packet1Write($username) {
			$package  = self::writeInt(15);
			$package .= self::writeStr16($username);
			$package .= self::writeLong(0);
			$package .= self::writeByte(0);
			
			$this->sock->write($package);
		}
		
		/*
		 * This function sends a handshake to the server.
		 * The handshake must be sent before the login package (Packet1) 
		 */
		public function Packet2Write($username) {
			$package  = chr(2); //Packet prefix
			$package .= self::writeStr16($username);
			
			$this->sock->write($package);
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
		
		public static function writeByte($b) {
			return pack('c' ,$b);
		}
		
		public static function writeInt($v) {
			$data  = self::writeByte($v >> 24 & 0xFF);
			$data .= self::writeByte($v >> 16 & 0xFF);
			$data .= self::writeByte($v >>  8 & 0xFF);
			$data .= self::writeByte($v >>  0 & 0xFF);
			
			return $data;
		}
		
		public static function writeShort($v) {
			$data .= self::writeByte($v >>  8 & 0xFF);
			$data .= self::writeByte($v >>  0 & 0xFF);
			
			return $data;
		}
		
		public static function writeLong($v) {
			$data  = self::writeByte($v >> 56 & 0xFF);
			$data  = self::writeByte($v >> 48 & 0xFF);
			$data  = self::writeByte($v >> 40 & 0xFF);
			$data  = self::writeByte($v >> 32 & 0xFF);
			$data  = self::writeByte($v >> 24 & 0xFF);
			$data .= self::writeByte($v >> 16 & 0xFF);
			$data .= self::writeByte($v >>  8 & 0xFF);
			$data .= self::writeByte($v >>  0 & 0xFF);
				
			return $data;
		}		
	}
?>