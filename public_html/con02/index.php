<?php
	include("init.php");
	include("config.php");
	include("functions.php")
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">


    <title>Themis Web</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/jumbotron.css" rel="stylesheet">
	<link href='css/ranking.css' rel=stylesheet>	
	<script src="js/jquery-latest.js"></script>
	<script>
		var refreshId = setInterval(function(){
			$('#logs').load('logs.php');
			$('#ranking').load('ranking.php');
			$('#timer').load('timer.php');
		}, 1000);
	</script>
	
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="https://dsapblog.wordpress.com/2013/12/24/themis/">Themis Web Chấm bài tự động</a>
        </div>
		
		<div class="navbar-collapse collapse">
			<div class="navbar-form navbar-right"> 
				<a class="btn btn-success" href="repass.php" title="Đổi mật khẩu">Thí sinh: <?php echo $_SESSION['tname']; ?></a> 
				<a href="logout.php">(Thoát)</a>
		</div>
		</div>  
      </div>
    </div>

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
        <h1><?php echo $contestName; ?></h1>
        <p><?php echo $description; ?></p>
<?php if ($duringTime > 0) { ?>
		<p>
			- Themis Web<br/>
			- Thời gian bắt đầu: <?php echo date_format($startTime,"H:i:s"); ?> <br/>
			- Thời gian làm bài: <?php echo $duringTime; ?> phút. <br/>
			- Thời gian còn lại: <span id="timer"> </span>
		</p>
<?php } ?>
          <form class="navbar-form navbar-right"  action="upload.php" method="POST" enctype="multipart/form-data">
 			 Nộp bài: 
			<div class="form-group">
				<input type="file" name="file" id="file" accept="*.*" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Nộp</button>
          </form>
      </div>
    </div>

    <div class="container">
      <!-- Example row of columns -->
      <div class="row">
	  
        <div class="col-md-4">
          <h3>Đề:</h3>
<?php
		$dir = opendir($problemsDir);
		while ($file = readdir($dir)) { if ($file!="." && $file!=".." && substr($file,0,strlen($file)-4)!="allproblems") {
			echo "<h4>Đề: <a href='".$problemsDir."/".$file."'>".$file."</a></h4>";
		}}
		closedir($dir);
?>		  
        </div>

	  <div class="col-md-4">
          <h3>Code tham khảo:</h3>
<?php
		$dir = opendir($codeDir);
		while ($file = readdir($dir)) { if ($file!="." && $file!="..") {
			echo "<h4>Code: <a href='".$codeDir."/".$file."'>".$file."</a></h4>";
		}}
		closedir($dir);
?>		  
        </div>
		
        <div class="col-md-4">
          <h3>Test mẫu:</h3>
<?php	
		$dir = opendir($examTestDir);
		while ($file = readdir($dir)) { if ($file!="." && $file!=".." && !is_file($examTestDir."/".$file)) {
			echo "<h4>Bài: <a href='".$examTestDir."/".$file."'>".$file."</a></h4>"; 
		}}
		echo "<p>"; echo "</p>";
		closedir($dir);
?>		  
       </div>
	<div class="col-md-4">
        </div>
	   
        <div class="col-md-4">
          <h3>Nhật ký nộp bài:</h3>
		  <p id="logs"> Đang tải... </p>
        </div>
      </div>

      <hr>    
    </div> <!-- /container -->
	<script src="js/bootstrap.min.js"></script>
    <div id="ranking" align="center"> <?php include("ranking.php"); ?> </div>
	<footer>
        <p align="center"><?php echo $footer; ?></p>
      </footer>
  </body>
</html>
