<?php
namespace de\wbbaddons\minecraft\api\exception;
use de\wbbaddons\minecraft\api\util\Logger;

class ProtocolException extends SystemException {
	public function __construct($message, $code = 0, $description = '') {
		switch($code) {
			case 666:
				$description = "This packet is only sent by the client and can't be read from the socket.";
				break;
			case 1337:
				$description = "This packet is only sent by the server and can't be written to the socket.";
				break;
		}
		parent::__construct($message, $code, $description);
	}
	
	public function show() {
		parent::show();
	}
}