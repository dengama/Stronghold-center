<?php
	
	include_once 'backend/conf.php';
	
	$cpu_upd = round(exec('ps aux | awk \'{s += $3} END {print s ""}\''));		//cpu %
	$mem_upd = round(exec('ps aux | awk \'{s += $4} END {print s ""}\''));		//mem %
	
	$db = new mysql(); //~ Создаем новый объект класса
		$login = $db->screening($login);
		$db->query("UPDATE `statistics` SET `usage`= $cpu_upd WHERE id=1;");
		$db->query("UPDATE `statistics` SET `usage`= $mem_upd WHERE id=2;");
?>