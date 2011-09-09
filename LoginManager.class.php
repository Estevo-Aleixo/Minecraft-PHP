<?php

/**
 * Creates a new user session.
 *
 * @author  kurtextem <kurtextrem@gmail.com>
 * @license GNU Lesser General Public License <http://opensource.org/licenses/lgpl-license.php>
 * @package Minecraft-PHP
 */
class LoginManager {

	/**
	 * Username.
	 *
	 * @var string
	 */
	public $username;

	/**
	 * Password from the user.
	 *
	 * @var string
	 */
	private $password;

	/**
	 * URL for the login session.
	 *
	 * @var string
	 */
	private $urlConstruct;

	/**
	 * Is the user logged in already?
	 *
	 * @var boolean
	 */
	public $loggedIn = false;

	/**
	 * Calls the login functions.
	 *
	 * @param string $username
	 * @param string $password
	 */
	public function __construct($username, $password) {
		$this->username = $username;
		$this->password = $password;

		$this->checkLogin();
	}

	/**
	 * Constructs the URL
	 *
	 * @return boolean
	 */
	private function constructURL() {
		$this->urlConstruct = 'http://www.minecraft.net/game/getversion.jsp?user='.urlencode($this->username).'&password='.urlencode($this->password).'&version='.MINECRAFT_VERSION;
	}

	/**
	 * Handles the login.
	 *
	 * @return boolean
	 */
	public function checkLogin() {
		if (!$this->loggedIn) {
			$context = $this->attempLogin() || $this->handleLoginError('stream');

			$pos = strpos($context, ":");

			if ($pos === false) {
				if (trim($context) == 'Bad login') {
					$this->handleLoginError('badLogin');
				} elseif (trim($context) == 'Old version') {
					$this->handleLoginError('oldVersion');
				} else {
					die(trim($context));
				}
			}

			$this->loggedIn = true;

			return true;

			/* $values = explode(":", $context);

			  $data = array(
			  'userName' => trim($values[2]),
			  'latestVersion' => trim($values[0]),
			  'downloadTicket' => trim($values[1]),
			  'sessionID' => trim($values[3])
			  ); */ // not needed atm
		}

		return false;
	}

	/**
	 * Attemps to login the user.
	 *
	 * @return mixed
	 */
	private function attempLogin() {
		$context = stream_context_create(array('http' => array('header' => 'Connection: close')));
		$context = file_get_contents($this->constructURL());
		if (!$context)
			return false;

		return $context;
	}

	/**
	 * Handles login error.
	 *
	 * @param string $whatError
	 * @todo  go out of hardcoded strings.
	 */
	private function handleLoginError($whatError) {
		switch ($whatError) {
			case 'stream':
				die("Couldn't fetch stream");

			case 'badLogin':
				die("Couldn't login user. Maybe wrong password?");

			case 'oldVersion':
				die("Version is outdated. Update MinecraftPHP.class.php to newest version");

			default:
				die('Undefined login error.');
		}
	}

	/**
	 * Changes the user.
	 *
	 * @param  string  $newUsername
	 * @param  string  $newPassword
	 * @return boolean
	 */
	public function changeLogin($newUsername, $newPassword) {
		$this->loggedIn = false;
		$this->username = $newUsername;
		$this->password = $newPassword;

		return $this->checkLogin();
	}

}

?>