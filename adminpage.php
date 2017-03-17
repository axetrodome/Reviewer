<!DOCTYPE html>
<?php 

$errphp = false;
$err_content = false;
$empty = "";
$user_err = "";
$num_err = "";
$pass_len = "";
$empty_content = "";
$time_elapsed = time();
include_once 'db.php';
if(isset($_POST['btn-login'])){
$user = $_POST['user'];
$pass = $_POST['pass'];
if($_SERVER["REQUEST_METHOD"] == "POST"){
		$sql = $conn->prepare("SELECT user,password FROM admin WHERE user = :username and password = :password");
		$sql->bindParam(":username",$user);
		$sql->bindParam(":password",$pass);
		$sql->execute();
		$row = $sql->fetch();
		if($pass != $row['password'] || $user != $row['user']){
			$err_user = "Wrong password or username!";
			$errphp = true;
			// $query = "SELECT COUNT(*) FROM loginAttempts WHERE (datetime > now() - INTERVAL 5 MINUTE) AND address = '".$_SERVER['REMOTE_ADDR']."'";
		}else{
			header("Location:adminpage.php");
		}
	 }
}
	if(isset($_POST['submit'])){
		$user = $_POST['user'];
		$pass = $_POST['password'];
		$id_num = $_POST['id_num'];
			if($_SERVER["REQUEST_METHOD"] == "POST"){
					if(empty($user) || empty($pass) || empty($id_num)){
						$empty = "Fill out all the fields,";
						$errphp = true;
					}
					if(strlen($pass) < 6){
						$pass_len = "Password too short";
						$errphp = true;
					}
					if(!preg_match("/^[a-zA-z ]*$/",$user)){
						$user_err = "Only letters are allowed in Username,";
						$errphp = true;
					}
					if(!preg_match("/^[0-9]*$/",$id_num)){
						$num_err = "Numbers only in ID number";
						$errphp = true;
					}
					if($errphp == false){
						$insertion = "INSERT IGNORE INTO student (user,password,id_number)VALUES(:user,:password,:id_number)";
						$sql = $conn->prepare($insertion);
						$sql->bindParam(":user",$user);
						$sql->bindParam(":password",$pass);
						$sql->bindParam(":id_number",$id_num);
							$sql->execute();
				}
			}
		}
if(isset($_POST['add']))
{
	$professor = $_POST['professor'];
	$subject = $_POST['subject'];
	$title = $_POST['title'];
	$content = $_POST['content'];
		if($_SERVER["REQUEST_METHOD"] == "POST"){
			if(empty($professor) || empty($subject) || empty($title) || empty($content)){
				$err_content = true;
				$empty_content = "Fill out all the fields";
			}
			if(!preg_match("/^[a-zA-z ]*$/",$professor)){
					$user_err = "Only letters are allowed in Username,";
					$errphp = true;
					}
			if($err_content == false){
				foreach($_POST['select'] as $select){
					if($select == "prelim"){
							$query = "INSERT INTO prelim(professor,subject,title,content,time_elapsed)VALUES(:professor,:subject,:title,:content,:time_elapsed)";
							$sql = $conn->prepare($query);
							$sql->bindParam(":professor",$professor);
							$sql->bindParam(":subject",$subject);
							$sql->bindParam(":title",$title);
							$sql->bindParam(":content",$content);
							$sql->bindParam(":time_elapsed",$time_elapsed);
							$sql->execute();
					}
					if($select == "midterm"){
							$query = "INSERT INTO midterm(professor,subject,title,content,time_elapsed)VALUES(:professor,:subject,:title,:content,:time_elapsed)";
							$sql = $conn->prepare($query);
							$sql->bindParam(":professor",$professor);
							$sql->bindParam(":subject",$subject);
							$sql->bindParam(":title",$title);
							$sql->bindParam(":content",$content);
							$sql->bindParam(":time_elapsed",$time_elapsed);
							$sql->execute();
					}
					if($select == "final"){
							$query = "INSERT INTO final(professor,subject,title,content,time_elapsed)VALUES(:professor,:subject,:title,:content,:time_elapsed)";
							$sql = $conn->prepare($query);
							$sql->bindParam(":professor",$professor);
							$sql->bindParam(":subject",$subject);
							$sql->bindParam(":title",$title);
							$sql->bindParam(":content",$content);
							$sql->bindParam(":time_elapsed",$time_elapsed);
							$sql->execute();
					}
				}
			}
		}
	}
?>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<title>Reviewer</title>
	<link rel="icon" type="image/jpeg" href="">
</head>
<style type="text/css">
/*add user here*/
	*{margin:0;padding:0;font-family:"Avant Garde",AvantGarde,"Century Gothic",CenturyGothic,"Apple Gothic",sans-serif;}
	.header{background-color:#2c3e50;color:#fff;text-align:center;padding:15px;font-size:4vh;}
	.form-container,.form-reviewer{padding:70px 0px 140px;}
	.header-form{background-color:#2980b9;padding:12px;display:block;text-align:center;}
	.header-form h1{color:#fff;text-align:center;font-size:4vh;letter-spacing:3px;}
	.header-form p{color:#bfbfbf;text-align:center;}
	.add-student{width:90%;margin:0 auto;box-shadow: 0px 10px 25px #888;}
	.form-group,.content-form{width:80%;margin:0 auto}
	.input{padding:10px;}
	input,textarea{width:100%;display:inline-block;padding:12px;border:1px solid #ddd;outline:none;}
	input:focus,textarea:focus{box-shadow:0 0 5px rgba(81, 203, 238 , 1);border:1px solid rgba(81,203,238,1);-webkit-transition:all 0.30s ease-in-out;}
	.sub{padding:12px;}
	.sub-btn{width:100%;background-color:#3498db;border:none;cursor:pointer;padding:12px;color:#fff;font-size:1.5vh ;transition:0.4s;font-weight:bold;}
	.sub-btn:hover{background-color:#2980b9;}
	.error{background-color:#ff4436;color:#fff;padding:12px;transition:opacity 0.6s;margin:8px 0px;text-align:center;display:none;}
	.errors{background-color:#ff4436;color:#fff;padding:12px;transition:opacity 0.6s;margin:8px 0px;text-align:center;display:none; }
	.close-btn{float:right;font-size:16px;font-weight:bold;cursor:pointer;}
/*information here*/
	.information{background-color:#34495e;}
	.information p{color:#fff;padding:12px;font-size:1.5vh;}
	.fa{color:#fff;font-size:10vw;}
	.user,.question,.comment{width:30%;text-align:center;padding:15px;display:inline-block;}
	@media screen and (max-width:500px){
		.user,.question,.comment{width:100%;}
		.fa{font-size:10vh;}
	}
/*reviewer content here*/
	.reviewer-content{width:90%;margin:0 auto;box-shadow: 0px 10px 25px #888;}
	.content-header{background-color:#1abc9c;padding:12px;display:block;}
	.input-title{color:#b1b1b1;}
	.add{padding:12px;width:100%;cursor:pointer;color:#fff;background-color:#2ecc71;font-size:1.7vh;border:none;font-weight:bold; }
	.add:hover{background-color:#27ae60;transition:0.4s;}
	.semester-btn{padding:15px;}
	.content-header{color:#fff;text-align:center;}
	.content-header h1{color:#fff;text-align:center;font-size:4vh;letter-spacing:3px;display:inline-block;}
	/*panel*/
	.panel{width:100%;padding-top:15px;}
	.panel-container{margin:0 auto;width:90%;}
	.panel-btn{width:19.5%;border:none;cursor:pointer;background-color:#e74c3c;}
	.panel-btn:hover{background-color:#c0392b}
	.panel-btn a{color:#333;text-decoration:none;font-size:10.5vh;color:#fff;}
</style>
<body>
<div class="panel">
	<div class="panel-container">
		<button class="panel-btn"><a href="reviewer-content.php" class="fa fa-book"></a></button>
		<button class="panel-btn"><a href="adminpage.php" class="fa fa-plus"></a></button>
		<button class="panel-btn"><a href="users.php" class="fa fa-user"></a></button>
		<button class="panel-btn"><a href="recyclebin.php" class="fa fa-recycle"></a></button>
		<button class="panel-btn"><a href="logout.php" class="fa fa-power-off"></a></button>
	</div>
</div>
<div class="form-container">
	<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="add-student">
		<div class="header-form">
		<i class="fa fa-user-o"></i>
			<h1>Add user</h1>
			<p>Fill out all the fields.</p>
		</div>
			<div class="form-group">	
					<div class="input" id="input">
						<input type="text" name="user" placeholder="Username" class="input">
					</div>
					<div class="input" id="input_pass">
						<input type="password" name="password" placeholder="password" class="input">
					</div>
					<div class="input" id="input_num">
						<input type="text" name="id_num" placeholder="ID number" class="input">
					</div>
					<div class="sub">
						<button class="sub-btn" name="submit">Submit</button>
					</div>
			</div>
		<div class="error" id="myAlert">
			<span class="close-btn" onclick="this.parentElement.style.display ='none';">&times</span>
			<strong><?php echo $empty; ?></strong>
			<strong><?php echo $user_err; ?></strong>
			<strong><?php echo $num_err; ?></strong>
			<strong><?php echo $pass_len; ?></strong>
		</div>
	</form>
</div>
<div class="information">
	<div class="user">
		<i class="fa fa-user-o"></i>
		<p>Lorem ipsum Excepteur in elit in veniam aliquip aliqua dolore nulla aute consectetur quis mollit Ut ex amet velit pariatur.</p>
	</div>
	<div class="question">
		<i class="fa fa-question"></i>
		<p>Lorem ipsum Excepteur in elit in veniam aliquip aliqua dolore nulla aute consectetur quis mollit Ut ex amet velit pariatur.</p>
	</div>
	<div class="comment">
		<i class="fa fa-comment"></i>
		<p>Lorem ipsum Excepteur in elit in veniam aliquip aliqua dolore nulla aute consectetur quis mollit Ut ex amet velit pariatur.</p>
	</div>
</div>
<div class="form-reviewer">
	<form method="POST" class="reviewer-content" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
		<div class="content-header">
			<i class="fa fa-book"></i>
			<h1>Add Content</h1>
			<p>Add reviewer content and select if prelim, midterm or final.</p>
		</div>
		<div class="content-form">	
			<div class="input">
				<span class="input-title"><strong>Professor:</strong></span>
				<input type="text" name="professor">
			</div>
			<div class="input">
				<span class="input-title"><strong>Subject:</strong></span>
				<input type="text" name="subject">
			</div>
			<div class="input">
				<span class="input-title"><strong>title:</strong></span>
				<input type="text" name="title">
			</div>
			<div class="input"> 
				<span class="input-title"><strong>Content:</strong></span>
				<textarea class="content" name="content" ></textarea>
			</div>
			<select class="input" name="select[]">
				  <option value="prelim" name="prelim">Prelim</option>
				  <option value="midterm" name="midterm">Midterm</option>
				  <option value="final" name="final">Final</option>
			</select>
			<div class="semester-btn">
				<button class="add" type="submit" name="add">Add</button>
			<div class="errors" id="myAlerts">
				<span class="close-btn" onclick="this.parentElement.style.display ='none';">&times</span>
				<strong><?php echo $empty_content?></strong>
		</div>
			</div>
		</div>
	</form>
</div>
<?php 
if($errphp == true){
?>
<script type="text/javascript">
	document.getElementById("myAlert").style.display = "block";
<?php
}
?>
</script>
<?php 
if($err_content == true){
?>
<script type="text/javascript">
	document.getElementById("myAlerts").style.display = "block";
<?php
}
?>
</script>
</body>
</html>
<!-- https://www.w3schools.com/howto/tryit.asp?filename=tryhow_css_modal2 -->
<!-- http://stackoverflow.com/questions/4554758/how-to-read-if-a-checkbox-is-checked-in-php -->