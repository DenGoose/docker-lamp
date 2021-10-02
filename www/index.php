<?php

if (!file_exists("bitrixsetup.php"))
{
	set_time_limit(0);

	$fp = fopen (dirname(__FILE__) . '/bitrixsetup.php', 'w+');

	$ch = curl_init(str_replace(" ","%20","http://www.1c-bitrix.ru/download/files/scripts/bitrixsetup.php"));
	curl_setopt($ch, CURLOPT_TIMEOUT, 50);

	curl_setopt($ch, CURLOPT_FILE, $fp);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

	curl_exec($ch);
	curl_close($ch);
	fclose($fp);
}

echo "<a href='bitrixsetup.php'>Установить битрикс</a>";