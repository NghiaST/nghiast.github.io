 <?php
$_F = __FILE__;
include("init.php");
include("config.php");
$dir = opendir($logsDir);
$session = $user['username'];
$output = array();
$output[] = '<table class="tbl-content">';
$output[] = '          <thead>';
$output[] = '            <tr>';
$output[] = '              <th><font size="3">STT </font></th>';
$output[] = '              <th><font size="3">Tên bài </font></th>';
$output[] = '              <th><font size="3">File kết quả </font></th>';
$output[] = '              <th><font size="3">Điểm </font></th>';
$output[] = '              <th><font size="3">Trạng thái </font></th>';
$output[] = '            </tr>';
$output[] = '          </thead>';
$output[] = '          <tbody>';
$count = 1;
while ($file = readdir($dir)) {
	$pos = strpos($file, "[" . $session . "]");
	if ($pos > 0) {
		$output[] = '            <tr>';
		$output[] = '              <td><font size="3">' . $count . '</font></td>';
		if ($publish == 1) {
			$finp = fopen($logsDir."/".$file,"r");
			$str = substr(fgets($finp),strlen($session)+3);
			$parts = explode(":", $str);
			$diem = isset($parts[1]) ? $parts[1] : "---";
			$ten_bai = fgets($finp);
			fclose($finp);
			$output[] = '              <td><font size="2">' . $ten_bai . '</font></td>';
			$output[] = '              <td><font size="2">' . "<a href='download.php?file=".$file."'>" . substr($file, $pos + strlen($session)+2) . "</a>" . '</font></td>';
			$output[] = '              <td><font size="2">' . $diem . '</font></td>';
			$output[] = '              <td><font size="2">Đã chấm xong</font></td>';
		}
		else {
			$output[] = '              <td>' . "<a href='#'>".substr($file, $pos+strlen($session)+2)."</a>" . '</td>';
			$output[] = '              <td><font size="2">Chưa chấm xong</font></td>';
		}
		$output[] = '            </tr>';
		$count ++;		
	}
}
$output[] = '          </tbody>';
$output[] = '        </table>';
echo implode("\n", $output);
