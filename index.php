<html>
<head>
<title>Opencart Version Selector</title>
</head>
<body>
<h1>Select Opencart Version</h1>
<ul>
<?php
foreach(scandir('.') as $dir) {
	if(is_dir($dir) && $dir != '.' && $dir != '..' && $dir != '.git') {
		echo '<li><a href="'.$dir.'/">'.$dir.'</a> <a href="'.$dir.'/admin/">Admin</a></li>';
	}
}
?>
</ul>
</body>
</html>
