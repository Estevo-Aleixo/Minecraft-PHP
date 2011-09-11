<?php
require_once("../MinecraftPHP.class.php");

class Test {
	
}

$test = new Test();
$mc = 	new MinecraftPHP();
$mc->setServerPort(25566);
$mc->setUsername('jeb_'); //Muhaha, we are so evil :>
$mc->init();
$mc->disconnect();
?>