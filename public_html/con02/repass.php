<?php
include("init.php");
if (isset($_POST["repass"])) {
  $success = FALSE;
  if (($_POST["oldpass"] != $_SESSION["tpass"] && md5($_POST["oldpass"]) != $_SESSION["tpass"])||($_POST["newpass"]!=$_POST["repass"])||(strlen($_POST["newpass"]) < 5)) {
   header("Location: repass.php?err=1");
 }	
 else $success = TRUE;
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

<!-- Le styles -->
<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/bootstrap-responsive.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
</head>

<body class="repass">
<img class="bg" src="img/bg-login.jpg" alt="background">
<div class="container">
  <div class="logo">
    <img src="img/logo.jpg" alt="Logo" width="200" height="200">
    <h2 class="form-repass-heading">Đổi mật khẩu</h2>
  </div>
  <form class="form-repass" method="POST" action="<?php echo $_SERVER['PHP_SELF']?>">
    <input type="password" name="oldpass" class="input-block-level" placeholder="Mật khẩu cũ">
    <input type="password" name="newpass" class="input-block-level" placeholder="Mật khẩu mới (ít nhất 5 ký tự)">
    <input type="password" name="repass" class="input-block-level" placeholder="Nhập lại mật khẩu mới">
    <div>
      <button class="btn btn-large btn-primary btn-3 pull-left" type="submit">Đổi mật khẩu</button>
      <a class="btn btn-large btn-primary btn-3 pull-right" href="index.php">Về trang chủ</a>
      <div class="warning">
        <?php if (isset($_GET['err'])) echo "<strong>LỖI:</strong> Mật khẩu cũ không đúng, mật khẩu mới quá ngắn hoặc nhập không trùng nhau!"; ?>
      </div>
    </div>
  </form>
</div>
<!-- /container -->
<?php
   if (isset($success) && $success) {
    if (!is_file('data/tmp.xml')) {
     $fi = fopen('data/account.xml','r');
     $fo = fopen('data/tmp.xml','w');
     while (!feof($fi)) {
      $str = fgets($fi);
      if (strpos($str,">".$user['username']."<") > 0) {
       fwrite($fo,$str);
       $str = fgets($fi);
       $str = str_replace(">".$user['password']."<",">".md5($_POST['newpass'])."<",$str);
       fwrite($fo,$str);
       $str = fgets($fi);
       fwrite($fo,$str);
       $str = fgets($fi);
       $str = str_replace('>0<','>1<',$str);
     }
     fwrite($fo,$str);
   }
   fclose($fi);
   fclose($fo);
   copy('data/tmp.xml','data/account.xml');
   unlink('data/tmp.xml');
   $_SESSION['tpass']=md5($_POST['newpass']);
   ?>
<script>
    alert("Đổi mật khẩu thành công");
    window.location.assign("index.php");
  </script>
<?php
}
else {
  ?>
<script>
    alert("LỖI: Đổi mật khẩu không thành công\n Vui lòng đổi mật khẩu lại!");
    window.location.assign("repass.php");
  </script>
<?php
}
}	
?>

<!-- Le javascript
    ================================================== --> 
<!-- Placed at the end of the document so the pages load faster --> 
<script src="js/bootstrap.min.js"></script>
</body>
</html>
