<?php
namespace de\wbbaddons\minecraft\api;

class PacketHandler {
	public static function parse($data) {
		$packet = "Packet".ord($data);
		
		
		echo "<p><span class='time'>" . date("[H:i:s]", time()) . "</span> <span class='message'>DEBUG: "; print_r($packet); echo "</span></p>";
	}	
}