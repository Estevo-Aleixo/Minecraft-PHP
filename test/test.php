<?php
require_once("../MinecraftPHP.class.php");

class Test {
	
}

$test = new Test();
$mc = 	new MinecraftPHP();
$mc->setServerPort(25566);
$mc->setUsername('§5B§1O§bT§2T§eI');
$mc->init();
$mc->disconnect();
?>