<!DOCTYPE html>
<?php

session_start();
$wrong = "";
$errphp = false;
$err = "";
$err_user = "";
$userIP = $_SERVER['REMOTE_ADDR'];
include_once 'db.php';
 ?>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
	<link rel="icon" type="image/jpg" href="my_logo.jpg">
	<link>
</head>
<style type="text/css">
/*admin*/
	*{margin:0;padding:0;font-family:"AvantGarde", Avantgarde,"Century Gothic", Centuryghotic ,"Apple Gothic",sans-serif}
	.form-container{margin:15px}
	.header{text-align:center;background-color:#2c3e50;padding:12px;color:#fff;}
	input{border:none;display:inline-block;width:100%;margin:8px 0px;padding:12px 20px;box-sizing:border-box;border:1px solid #ccc;font-size:15px;}
	.login{padding:15px;background-color:#2980b9 }
	.admin-container{width:80%;margin:0 auto;box-shadow:0 4px 25px 0 rgba(0,0,0,0.5),0 6px 20px 0 rgba(0,0,0,0.19);}
	.submit-btn{padding:12px 35px;border:none;cursor:pointer;background-color:#2c3e50;color:#fff;font-size:18px;display:block;width:100%;margin-bottom:5px;}
	.member-sub{padding:12px 35px;border:none;cursor:pointer;background-color:#2ecc71;color:#fff;font-size:18px;display:block;width:100%;}
	.member-sub:hover{background-color:#27ae60}
	.submit-btn:hover{background-color:#34495e}
	.alert{background-color:#f44336;padding:12px;color:#fff;transition:opacity 0.6s;opacity:1;margin:8px 0px;display:none;}
	.close-btn{color:#fff;font-weight:bold;font-size:16px;cursor:pointer;float:right;transition:0.4s;}
/*member*/
	*{margin:0;padding:0;font-family:"AvantGarde", Avantgarde,"Century Gothic", Centuryghotic ,"Apple Gothic",sans-serif}
	.member-form-container{margin:15px;}
	.header{text-align:center;background-color:#2c3e50;padding:12px;color:#fff;}
	input{border:none;display:inline-block;width:100%;margin:8px 0px;padding:12px 20px;box-sizing:border-box;border:1px solid #ccc;font-size:15px;}
	.login{padding:15px;background-color:#2980b9 }
	.member-container{width:80%;margin:0 auto;box-shadow:0 4px 25px 0 rgba(0,0,0,0.5),0 6px 20px 0 rgba(0,0,0,0.19);}
	.submit-btn{padding:12px 35px;border:none;cursor:pointer;background-color:#2c3e50;color:#fff;font-size:18px;display:block;width:100%;margin-bottom:5px;}
	.member-sub{padding:12px 35px;border:none;cursor:pointer;background-color:#2ecc71;color:#fff;font-size:18px;display:block;width:100%;}
	.member-sub:hover{background-color:#27ae60}
	.submit-btn:hover{background-color:#34495e}
	.alert{background-color:#f44336;padding:12px;color:#fff;transition:opacity 0.6s;opacity:1;margin:8px 0px;display:none;}
	.close-btn{color:#fff;font-weight:bold;font-size:16px;cursor:pointer;float:right;transition:0.4s;}
</style>
<body>
<div class="member-form-container">
	<form action="adminpage.php" method="POST" class="admin-container">
	<div class="header">
		<h1>Login</h1>
	</div>
	<div class="login">
		<input type="text" name="user" placeholder="Username" required>
		<input type="password" name="pass" placeholder="password" required>
		<button type="submit" class="submit-btn" name="btn-login">Login as admin</button>
			<div class="alert" id="myAlert">
		<span class="close-btn" onclick="this.parentElement.style.display='none';">&times</span>
			<strong><?php echo $err_user; ?></strong>
		</div>
	</div>
	</form>
</div>
<div class="form-container">
	<form action="userpage.php" method="POST">
	<div class="header">
		<h1>Login</h1>
	</div>
	<div class="login">
		<input type="hidden" name="id" >
		<input type="text" name="id" style="display:none;">
		<input type="text" name="user" placeholder="Username" required>
		<input type="password" name="pass" placeholder="password" required>
		<button type="submit" class="member-sub" name="user-login">Login as user</button>
			<div class="alert" id="myAlert">
		<span class="close-btn" onclick="this.parentElement.style.display='none';">&times</span>
			<strong><?php echo $err_user; ?></strong>
		</div>
	</div>
	</form>
</div>
</body>
<?php 
if($errphp == true){
	?>
	<script type="text/javascript">
		document.getElementById("myAlert").style.display = "block";
	</script>
	<?php
}
?>
</html>