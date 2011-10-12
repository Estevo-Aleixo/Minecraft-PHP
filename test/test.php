<?php
require_once(__DIR__ . '/../MinecraftPHP.class.php');

$mc = new \de\wbbaddons\minecraft\api\MinecraftPHP();
//$mc->setUsername(substr(md5(time() * rand()), 0, 4));
//$mc::$debug = true;
$mc->setServerPort(25565);
$mc->init();
$mc->listen();
$mc->disconnect();

?>