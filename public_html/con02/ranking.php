<?php
	include("config.php");	
	$dir = opendir($logsDir);
	$totalScore = null;
	$listContestant = null;
	$listProbs = null;
	$countProbs = 0;
	$member = 0;
	$tableScore = null;
	$showRanking = 0;	
	function stringToFloat($string) {
		$float = 0.0;
		$length = strlen($string); $length -= 2;
		$i = 0;
		while ($i < $length) {
			if (($string[$i] == '.') || ($string[$i] == ',')) break;
			$float = $float * 10 + $string[$i] - '0';
			$i++;
		}
		$i++;
		$cur = 1.0;
		while ($i < $length) {
			$digit = $string[$i] - '0';
			$cur *= 10.0;
			$float += (float)($digit) / $cur;
			$i++;
		}
		return $float;

	}

	while ($file = readdir($dir)) {
		$curFileName = $file;
		if ($curFileName[0] >= '0' && $curFileName[0] <= '9') {
			$showRanking = 1;			
			$nameProb = "";
			$curString = '';
			$idContestant = "";
			$lengthNameFile = strlen($curFileName); 
			$score = 0.0;
			$cur = 0;
			for ($i = 0; $i < $lengthNameFile; $i++) {
				if ($curFileName[$i] == '[') {
					$cur++;
					$curString = "";
					$j = $i + 1;
					while ($curFileName[$j] != ']') {
						$curString = $curString . $curFileName[$j];
						$j++;
					}
					$i = $j;
					if ($cur == 1) $idContestant = $curString; else $nameProb = strtoupper($curString);
				}
			} 
			$finp = fopen($logsDir."/".$file,"r");
			$curString = substr(fgets($finp),8 + strlen($idContestant) + strlen($nameProb));
			fclose($finp);
			$score = stringToFloat ($curString);			
			$tableScore[$idContestant][$nameProb] = $score;			
		}
	}
	if ($showRanking == 0) exit();
 	foreach ($tableScore as $idContestant => $listCurProbs) {
 		$curScore = 0;
		foreach ($listCurProbs as $key => $value) {
			$curScore += $value;
			$tmp = false;
			for ($i = 1; $i <= $countProbs; $i++) {
				if ($listProbs[$i] == $key) {
					$tmp = true;
					break;
				}
			}
			if ($tmp == false) {
				$countProbs++;
				$listProbs[$countProbs] = $key;
			}
		}
		$member++;
		$totalScore[$member] = $curScore;	
		$listContestant[$member] = $idContestant;
	}

	for ($i = 1; $i < $member; $i++) {
		for ($j = $i + 1; $j <= $member; $j++) {
			if ($totalScore[$i] < $totalScore[$j]) {
				$tmp1 = $totalScore[$i];
				$totalScore[$i] = $totalScore[$j];
				$totalScore[$j] = $tmp1;
				$tmp2 = $listContestant[$i];
				$listContestant[$i] = $listContestant[$j];
				$listContestant[$j] = $tmp2;
			}
		}
	}
	echo "<h3><center>BẢNG XẾP HẠNG<center></h3>";
	echo "<table class=containers";
	echo "	<thead>";
	echo "		<tr>";
	echo "			<th><h1>#</h1></th>";
	echo "			<th><h1>ACC</h1></th>";	
	echo "			<th><h1>TOTAL</h1></th>";
	for ($i = 1; $i <= $countProbs; $i++){
	echo "			<th><h1>" . $listProbs[$i] . "</h1></th>";
	}	
	echo "		</tr></thead><tbody>";
	for ($i = 1; $i <= $member; $i++){		
	if($i == 1)
		$show = "<td><font color=e94f64>";
	else if(($i == 2) || ($i == 3))
		$show = "<td><font color=e5c454>";
	else if(($i == 4) || ($i == 5) || ($i == 6))
		$show = "<td><font color=468cde>";
	else if(($i == 7) || ($i == 8) || ($i == 9) || ($i == 10))
		$show = "<td><font color=52d273>";
	else
		$show = "<td><font color=gray>";
		echo "		<tr>";
		echo $show . $i . "<font></td>";	
		echo $show . $listContestant[$i] . "<font></td>";
		echo $show . $totalScore[$i] ."<font></td>";
		for ($j = 1; $j <= $countProbs; $j++)
		{
			$tmp = array_key_exists($listProbs[$j], $tableScore[$listContestant[$i]]) ? $tableScore[$listContestant[$i]][$listProbs[$j]] : 0;
			echo $show . $tmp ."<font></td>";	
		}
		echo "		</tr>    ";	
	}		
	echo "	</tbody>";
	echo "</table>";
?>