<?php

class Logger {

	static public function log($msg, $level = 1)
	{
		if ($level == 0 && $level >= LOG_LEVEL)
		{
			echo "\n".$msg."\n\n";
			return;
		}

		if ($level > LOG_LEVEL)
		{
			return;
		}

		$microtime = strstr(microtime(true), '.');
		$d = debug_backtrace();
		$line = isset($d[0]['line']) ? $d[0]['line'].str_repeat(' ', 5-strlen($d[0]['line'])) : FALSE;
		$origin = isset($d[1]['object']) ? get_class($d[1]['object']) : FALSE;
		
		$max = 10;
		$len = strlen($origin);
		$origin = $len > $max ? substr($origin, 0, $max-3).'.. ' : $origin.str_repeat(' ', $max-$len);
		$log = date('y-m-d H:i:s').$microtime.str_repeat(' ', 6-strlen($microtime)).'- '.$line.$origin.$msg;
		$logLength = 140;
		if (strlen($log) > $logLength)
		{
			$log = substr($log, 0, $logLength-2).'...';
		}
		echo $log."\n";
	}
}
