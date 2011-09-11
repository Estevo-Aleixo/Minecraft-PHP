<?php
namespace de\wbbaddons\minecraft\api;
use util\DataUtil;

/**
 * Handles all packages.
 *
 * @author  	kurtextem <kurtextrem@gmail.com>, Max
 * @license 	GNU Lesser General Public License <http://opensource.org/licenses/lgpl-license.php>
 * @package 	de\wbbaddons\minecraft\api
 */
class MinecraftPackets {

	/**
	 * Represents the SocketManager class
	 *
	 * @var SocketManager
	 */
	private $socketManager = null;

	/**
	 * Represents the Protocol version.
	 */
	const PROTOCOL_VERSION = 15;

	/**
	 * Initiates the minecraft-server connection.
	 *
	 * @param string $username
	 */
	public function __construct(SocketManager $socket) {
		$this->socketManager = $socket;
	}

	/**
	 * Sends the first package.
	 *
	 * @param mixed $data
	 */
	public function packet0Write($data) {
		$package = chr(0);
		$package .= $data;

		$this->socketManager->write($package);
	}

	/**
	 * Reads the first-package return.
	 *
	 * @param mixed $data
	 */
	public function packet0Read($data) {
		$this->packet0Write($data);
	}

	/**
	 * Sends the login package.
	 *
	 * @param string $username
	 */
	public function packet1Write($username) {
			$package =  chr(1);
			$package .= DataUtil::toInt(self::PROTOCOL_VERSION);
			$package .= DataUtil::toStr16($username);
			$package .= DataUtil::toLong(0);
			$package .= DataUtil::toInt(0);
			$package .= DataUtil::toByte(0);
			$package .= DataUtil::toByte(0);
			$package .= DataUtil::toByte(0);

		$this->socketManager->write($package);
	}

	/**
	 * This function sends a handshake to the server.
	 * The handshake must be sent before the login package (packet1)
	 *
	 * @param string $username
	 */
	public function packet2Write($username) {
		$package = chr(2); // Packet prefix
		$package .= DataUtil::toStr16($username);

		$this->socketManager->write($package);
	}

	/**
	 * Reads the handshake return.
	 *
	 * @param  Str16  $data
	 * @return string
	 */
	public function packet2string($data) {
		return DataUtil::readStr16($data);
	}

	/**
	 * Writes the 4th package.
	 *
	 * @param string $message
	 */
	public function packet3Write($message) {
		//$message = preg_replace('/[^A-Za-z0-9 !"#$%&\'()*+,-.\/:;<=>\?@\[\]\^_{\|}\\~¦ÇüéâäàåçêëèïîìÄÅÉæÆôöòûùÿÖÜø£Ø×ƒáíóúñÑªº¿®¬½¼¡«»]*/i', '', $message);
		$package = chr(3); // Packet prefix
		$package .= DataUtil::toStr16($message);

		$this->socketManager->write($package);
	}

}
