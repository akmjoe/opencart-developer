<?php
// get list of versions
$versions = array();
foreach(scandir('.') as $dir) {
	if(is_dir($dir) && is_file($dir.'/index.php') && is_dir($dir.'/admin') && $dir != '.' && $dir != '..' && $dir != '.git') {
		$versions[] = $dir;
	}
}
if(!$_GET['version']) {
	$_GET['version'] = $versions[0];
}
?>
<html>
<head>
<title>Opencart Developer Version Tester</title>
<script type="text/javascript" >
	var last_version = "<?php echo $_GET['version']; ?>";
	var last_admin = <?php echo (int)$_GET['admin']; ?>;
	function setVersion() {
		var version = document.getElementById('version').value;
		var admin = document.getElementById('page').value == 'admin';
		var iframe = document.getElementById('opencart').contentWindow.location.href;
		console.log(iframe);
		if(admin) {
			version += '/admin';
		}
		console.log(version);
		console.log(last_version);
		var dest = iframe.replace(last_version, version);
		if(admin != last_admin) {
			temp = dest.split(version);
			dest = temp[0]+version;
		}
		console.log(dest);
		document.getElementById('opencart').src = dest;
		displayURL(dest);
		last_version = version;
		last_admin = admin;
	}
	function displayURL(val) {
		document.getElementById('url').value = val;
	}
</script>
<style type="text/css">
iframe {
	width:100%;
	height:90vh;
}
input#url {
	width: 50em;
}
</style>
</head>
<body>
	<!-- Build toolbar to switch versions -->
	<div>
		<label for="version">Version:</label>
		<select name="version" id="version" onchange="setVersion()">
		<?php foreach($versions as $version) { ?>
			<option value="<?php echo $version; ?>"><?php echo $version; ?></option>
		<?php } ?>
		</select>
		<label for="page">Page:</label>
		<select id="page" name="page" onchange="setVersion()">
			<option value="catalog">Catalog</option>
			<option value="admin">Admin</option>
		</select>
		<label for="url">Current URL:</label>
		<input type="text" id="url" name="url" readonly="readonly" />
		<button type="button" onclick="window.open(document.getElementById('url').value)" title="Open in new tab">Open</button>
	</div>
	<!-- load opencart in Iframe -->
	<iframe id="opencart" src="<?php echo $_GET['version'].($_GET['admin']?'/admin/':''); ?>" onload="displayURL(this.contentWindow.location)"></iframe>
</body>
</html>
