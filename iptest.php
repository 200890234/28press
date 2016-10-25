<html>
<meta charset="utf-8">
<body>
PHP代码：
<br>
if (getenv('HTTP_CLIENT_IP')) {<br>
		$ip = getenv('HTTP_CLIENT_IP');<br>
	}elseif (getenv('HTTP_X_FORWARDED_FOR')) {<br>
		$ip = getenv('HTTP_X_FORWARDED_FOR');<br>
	}elseif (getenv('HTTP_X_FORWARDED')) {<br>
		$ip = getenv('HTTP_X_FORWARDED');<br>
	}elseif (getenv('HTTP_FORWARDED_FOR')) {<br>
		$ip = getenv('HTTP_FORWARDED_FOR');<br>
	}elseif (getenv('HTTP_FORWARDED')) {<br>
		$ip = getenv('HTTP_FORWARDED');<br>
	}else {<br>
		$ip = $_SERVER['REMOTE_ADDR'];<br>
	}<br>
	echo $ip;<br>
	
	
	
	
得到的结果：<br>
<?php
if (getenv('HTTP_CLIENT_IP')) {
		$ip = getenv('HTTP_CLIENT_IP');
	}elseif (getenv('HTTP_X_FORWARDED_FOR')) {
		$ip = getenv('HTTP_X_FORWARDED_FOR');
	}elseif (getenv('HTTP_X_FORWARDED')) {
		$ip = getenv('HTTP_X_FORWARDED');
	}elseif (getenv('HTTP_FORWARDED_FOR')) {
		$ip = getenv('HTTP_FORWARDED_FOR');
	}elseif (getenv('HTTP_FORWARDED')) {
		$ip = getenv('HTTP_FORWARDED');
	}else {
		$ip = $_SERVER['REMOTE_ADDR'];
	}
	echo $ip;
?>

</body>

</html>