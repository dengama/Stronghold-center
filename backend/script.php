<div id="sensors">		<!--Данные сенсоров системного блока -->
	<?php
			echo "<pre>";
		passthru("sensors");
			echo "</pre>";
	?>
</div>

<div id="cpu">			<!--Нагрузка процессора -->
	<?php
			echo "<pre>";
		passthru("mpstat -u");
			echo "</pre>";
	?>
</div>

<div id="net">		<!--Статистика сети -->
	<?php
			echo "<pre>";
		passthru("netstat -i");
			echo "</pre>";
	?>
</div>

<div id="status">
	<?php
		$str = exec("ping -c 1 192.168.1.1", $input, $result);		/* вызов консольной команды ping и помещение ее вывода в $str */
		if ($result == '1'){		/* если условие выполнено */
			echo "<span style='color: red;'>i_router: online, </span>";		/* вывод статуса "онлайн" */
		}else{		/* при невыполнении условия */
			echo "<span style='color: green'>i_router: offline, </span>";		/* вывод статуса "офлайн" */
		}
	?>
	<?php 
		//$str = exec("ping -c 1 google.com", $input, $result);
		$str2 = exec("ping -c 1 192.168.2.100", $input2, $result2);
		
		if ($result2 == '1'){	/* если условие выполнено */
			echo "<span style='color: red'>pmain: ofline, </span>";
		//}else if ($result2 == 0){	/* иначе выполнить */
			//echo "<span style='color: yellow;'>pmain: localnet, </span>";
		}else{	/* в остальных случаях */
			echo "<span style='color: green;'>pmain: online, </span>";
			}
	?>
	<?php  
		$str = exec("ping -c 1 google.com", $input, $result);
		if ($result == '1'){
		  echo "<span style='color: yellow;'>pserver: ethernet</span>";
		}else{
		  echo "<span style='color: green;'>pserver: localnet</span>";
		}
	?>
</div>

<div id="s_time">			<!--Аптайм-->
	<?php
		$data = shell_exec('uptime');	// вызов команды из шелла
		$uptime = explode(' up ', $data);	//отделяет up
		$uptime = explode(',', $uptime[1]);	//отделяет ","
		$uptime = $uptime[0].', '.$uptime[1];	//вид вывода
		header('Refresh: 180');	// рефреш каждые 60 сек
				  
			echo "$uptime"; //вызов скрипта
	?>
</div>

<div id="mem">		<!--Свободное место в оперативной памяти -->
	<?php
			echo "<pre>";
		passthru("free -o -m");
			echo "</pre>";
	?>
</div>

<div id="mot_l">		<!--Лог Motion'а-->
	<?php
		$output = shell_exec("tail -n 60 /var/log/motion/motion.log");
			echo "<pre>$output</pre>";
	?>
</div>

<div id="free">			<!--Свободное сесто на диске -->
	<p>STORAGE TOTAL\USED\FREE SPACE:</p>
	<?php  
		$str = exec("df -h | grep dev/sda6", $result);
			echo $str;
	?>
</div>

<div id="cam_f_tab">		<!--Спсок последних записей-->
	<?php
		$dir  = '/home/pavel/arch/cam1/';

		$files = array_diff(scandir($dir), array('..','.'));

		foreach ($files as $key => $value) {
			echo '<a href="http://'.$_SERVER['HTTP_HOST'].'/home/pavel/arch/cam1/'.$value.'">'.$value.'</a> <br/>';
		}
	?>
</div>
