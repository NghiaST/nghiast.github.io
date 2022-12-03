 <?php
include("init.php");
include("config.php");
$file = $_GET["file"];
if ((strpos($file,"[".$user['username']."]") > 0)&&($publish == 1)) {
	header('Content-type: text/plain');
	header('Content-Disposition: attachment; filename="'.$file.'"');
	readfile($logsDir."\\".$file);
}
else echo "Phat hien nghi van hack kaka...";