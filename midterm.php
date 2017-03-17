<!DOCTYPE html>
<?php 
session_start();
include_once 'db.php';
$id = $_GET['mid_id'];
$sql = "SELECT * FROM midterm WHERE id = '$id'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$subs = $stmt->fetchAll();
?>
<html>
<head>
	<title>Subjects</title>
</head>
<style type="text/css">
	*{margin:0;padding:0;}
	body,html{background-color:#bdc3c7}
	h1{text-align:center;color:#2c3e50;}
	.professor{text-align:center;color:#2c3e50}
	.subject-container{padding:15px;}
	.header{border-bottom:1px solid #bababa;width:95%;margin:0 auto;}
	.content{width:100%;min-height:150px;background-color:#fff;color:#9b9b9b;font-size:2vh}
	.content p{padding:20px;}
	.container,.content-container{width:95%;background-color:#fff;margin:0 auto;}
</style>
<body>
<?php 
foreach($subs as $sub){
?>
<div class="subject-container">
	<div class="container">
		.<div class="header">
			<h1><?php echo $sub['subject']; ?></h1>
			<p class="professor"><?php echo $sub['professor']?></p>
		</div>
	<div class="content-container">
		<div class="content">
			<p><?php echo $sub['content']; ?></p>
		</div>
	</div>
	</div>
</div>
<?php 
}
?>
</body>
</html>