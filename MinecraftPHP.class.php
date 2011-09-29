<?php
namespace de\wbbaddons\minecraft\api;
spl_autoload_register(function ($class) {
	require_once(__DIR__.'/'.str_replace(array('de\\wbbaddons\\minecraft\\api\\', '\\'), array('', DIRECTORY_SEPARATOR), $class).'.class.php');
});

use de\wbbaddons\minecraft\api\util\Logger;
use de\wbbaddons\minecraft\api\packet\Packet1;
use de\wbbaddons\minecraft\api\packet\Packet2;
use de\wbbaddons\minecraft\api\packet\Packet3;

class MinecraftPHP {
	public static $debug = false;
	
	protected $createSession = false;
	protected $username = "MinecraftPHP";
	protected $userPassword = ""; //for authentication, not needed if server is in offline mode.
	protected $serverHost = "127.0.0.1";
	protected $serverPort = 25565;
	public static $socket;
	public static $logger;
	
	const VERSION = "1.0.0 alpha";
	
	public function __construct() {
		self::$logger = new Logger(Logger::STD, true);
		self::$logger->logfileName = "MinecraftPHP";
		self::$logger->init();
		self::$logger->log("Welcome to MinecraftPHP Version " . self::VERSION);
	}
	
	public function init() {
		if(self::$debug) self::$logger->log("--- debug mode ---");
		if(self::$debug) self::$logger->log("DEBUG: Initiating");
		self::$socket = new SocketManager($this->serverHost, $this->serverPort);
		
		$this->connect();
	}
	
	public function connect() {
		if(self::$debug) self::$logger->log("DEBUG: Connecting");	
			
		Packet2::writePacketData($this->username);
		do {
			if (($check = self::$socket->check()) > 0) {
				if(self::$debug) self::$logger->log("DEBUG: Check " . $check);
				
				self::$socket->read(1);
				$data = Packet2::readPacketData();
				$handshaked = (!empty($data)) ? $data : false;
				
				if(self::$debug) self::$logger->log("DEBUG: Handshake-data: " . $handshaked);
			} else $handshaked = false;
		} while(!$handshaked);
		
		Packet1::writePacketData($this->username);
		do {
			if (($check = self::$socket->check()) > 0) {
				if(self::$debug) self::$logger->log("DEBUG: Check " . $check);
				
				self::$socket->read(1);
				$data = Packet1::readPacketData();
				$handshaked = (!empty($data)) ? $data : false;
				
				if(self::$debug) self::$logger->log("DEBUG: Login-data: " . $handshaked);
			} else $handshaked = false;
		} while(!$handshaked);

		
		Packet3::writePacketData("Hello :D");
		self::$logger->log("Connected.");
	}
	
	public function listen() {
		if(self::$debug) self::$logger->log("DEBUG: Listening - loop");
		while (self::$socket->isConnected) {
			if (self::$socket->check() > 0) {
				$data = self::$socket->read(1);
				PacketHandler::parse($data);
			}
		}
		sleep(.5);
	}
	
	public function disconnect() {
		self::$socket->disconnect();
		self::$logger->log("Disconnected.");
		exit;
	}
	
	/*
	 * Getter and Setter block
	 */
	
	public function setUsername($username) {
		$this->username = substr($username, 0, 16);
		if(self::$debug) self::$logger->log("DEBUG: Set username to " . $this->username);
	}
	
	public function setServerHost($host) {
		$this->serverHost = $host;
	}
	
	public function setServerPort($port) {
		$this->serverPort = $port;
	}	
	
	public function getUsername() {
		return $this->username;
	}
	
	public function setUserPassword($password) {
		$this->userPassword = $password;
		if(self::$debug) self::$logger->log("DEBUG: Set a new password.");
	}
	
	public function getSocket() {
		return self::$socket;
	}
	
	public function setDebug($debug) {
		return ($debug) ? true : false;
	}
}