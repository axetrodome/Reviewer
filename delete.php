<?php 
include_once 'db.php';
$del_id = $_GET['delete_id'];
if(isset($del_id)){
$sql = "INSERT IGNORE INTO recyclebin SELECT * FROM prelim WHERE id = $del_id;
DELETE FROM prelim WHERE id = $del_id";	
$stmt = $conn->prepare($sql);
$stmt->execute();
header("Location:reviewer-content.php");
}
$mid_id = $_GET['mid_id'];
if(isset($mid_id)){
$mid_sql = "INSERT IGNORE INTO recyclebin SELECT * FROM midterm WHERE id = $mid_id;
DELETE FROM midterm WHERE id = $mid_id";	
$mid_stmt = $conn->prepare($mid_sql);
$mid_stmt->execute();
header("Location:reviewer-content.php");
}
$final_id = $_GET['final_id'];
if(isset($final_id)){
$sqls = "INSERT IGNORE INTO recyclebin SELECT * FROM final WHERE id = $final_id;
DELETE FROM final WHERE id = $final_id";	
$final_stmt = $conn->prepare($sqls);
$final_stmt->execute();
header("Location:reviewer-content.php");
}
?>