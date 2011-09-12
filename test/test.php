<?php

require_once('../MinecraftPHP.class.php');

$mc = new \de\wbbaddons\minecraft\api\MinecraftPHP();
$mc->setServerPort(25566);
$mc->setUsername('MinecraftPHP-Bot');
$mc->setServerHost('localhost');
$mc->init();
$mc->disconnect();

?>