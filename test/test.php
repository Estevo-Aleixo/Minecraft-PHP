<?php

require_once('../MinecraftPHP.class.php');

$mc = new \de\wbbaddons\minecraft\api\MinecraftPHP();
$mc->init();
$mc->disconnect();

?>