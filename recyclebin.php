<!DOCTYPE html>
<?php 
include_once 'db.php';
$sql = "SELECT * FROM recyclebin ORDER BY id DESC";
$stmt = $conn->prepare($sql);
$stmt->execute();
$del_contents = $stmt->fetchAll();
?>
<html>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
<head>
	<title>Recycle Bin</title>
</head>
<style type="text/css">
	*{padding:0;margin:0;}
	.recyclebin-header{background-color:#16a085;color:#2c3e50;text-align:center;letter-spacing:2px;padding:15px;font-size:1.7vh; }
	.deleted-contents{display:inline-block;float:left;padding:15px;}
	a{text-decoration:none;color:#95a5a6;font-size:2vh}
	.panel{width:100%;padding:15px 0px 15px;}
	.panel-container{margin:0 auto;width:95%;}
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
<div class="recyclebin-header">
	<h1>DELETED CONTENTS</h1>
	<p>All deleted contents will go here</p>
</div>
<?php 
foreach($del_contents as $del_content){
?>
<div class="deleted-contents">
	<a href=""><?php echo $del_content['subject']; ?></a>
</div>
<?php 
}
?>
</body>
</html>