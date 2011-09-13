<?php

namespace de\wbbaddons\minecraft\api\packets;

/**
 * 
 * This class defines which functions a packet must have.
 * @author Max
 *
 */
interface Packet {
	/**
	 * 
	 * This function writes the given data to the socket.
	 * @param unknown_type $data
	 */
	public static function writePacketData($data);
	
	/**
	 * 
	 * This function returns the read data
	 * It will be called after the incoming packet was identified (at this point, just one byte is read from the socket)
	 * then it will read the package specific data from the socket).
	 * @return package specific data
	 */
	public static function readPacketData();
}