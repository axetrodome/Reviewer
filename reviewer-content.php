<!DOCTYPE html>
<?php 
session_start();

include_once 'db.php';

function time_elapsed($ptime){
	$etime = time() - $ptime;
	$count = array(365 * 24 * 60 * 60 => 'year',
					30 * 24 * 60 * 60 => 'month',
					24 * 60 * 60 * 60 => 'day',
								60 * 60 => 'hour',
									60 => 'minute',
									1 => 'second'
												);
	$count_plural = array( 'year' => 'years',
							'month' => 'months',
							'day' => 'days',
							'hour' => 'hours',
							'minute' => 'minutes',
							'second' => 'seconds',
												);
	foreach($count as $secs => $str){
		$d = $etime / $secs;
		if($d >= 1){
			$r = round($d);
			if($r > 1){
				$r = $r.' '.$count_plural[$str].' ago';
			}else{
				$r = $r.' '.$str.'ago';
			}			
		return $r;
		}
	}
}
$prelim = $conn->prepare("SELECT * FROM prelim ORDER BY id DESC");
$prelim->execute();
?>
<html>
	<link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<head>
	<title>Reviewer content</title>
</head>
<style type="text/css">
	*{margin:0;padding:0;}
	.prelim{max-height:50%;margin-bottom:15px;	}
	.prelim-header{background-color:#e74c3c;color:#2c3e50;text-align:center;letter-spacing:2px;padding:15px;}
	.prelim-header p{color:#34495e;}
	.subject-btn{padding:15px;}
	.subject-btn .professor{display:inline-block;font-weight:bold;font-size:2.5vh;position:absolute;padding-left:15px;color:#2c3e50}
	.subject-btn .professor p{font-size:2.5vh;padding:10px;min-width:150px;color:#b1b1b1}
	.prelim-sub-btn{cursor:pointer;padding:12px;min-width:90px;background-color:#e74c3c;color:#ecf0f1;border:none;font-size:2vh;}
	.prelim-sub-btn:hover{box-shadow: 3px 5px 15px 0px rgba(0,0,0,0.4);transition:all 0.4s;}
	/*midterm*/
	.midterm{max-height:50%;margin-bottom:15px;}
	.midterm-header{background-color:#2ecc71;color:#2c3e50;text-align:center;letter-spacing:2px;padding:15px;}
	.midterm-sub{padding:15px;}
	.midterm-btn .professor{display:inline-block;font-weight:bold;font-size:2.5vh;position:absolute;padding-left:15px;color:#2c3e50}
	.midterm-btn .professor p{font-size:1.5vh;padding:10px;min-width:150px;color:#b1b1b1}
	.midterm-sub-btn{cursor:pointer;padding:12px;min-width:90px;background-color:#2ecc71;color:#ecf0f1;border:none;font-size:2vh;}
	.midterm-sub-btn:hover{box-shadow: 3px 5px 15px 0px rgba(0,0,0,0.4);transition:all 0.4s;}
	/*finals*/
	.final{max-height:50%;}
	.final-header{background-color:#8e44ad;color:#2c3e50;text-align:center;letter-spacing:2px;padding:15px;}
	.final-sub{padding:15px;}
	.final-btn .professor{display:inline-block;font-weight:bold;font-size:2.5vh;position:absolute;padding-left:15px;color:#2c3e50}
	.final-btn .professor p{font-size:1.5vh;padding:10px;min-width:150px;color:#b1b1b1}
	.final-sub-btn{cursor:pointer;padding:12px;min-width:90px;background-color:#8e44ad;color:#ecf0f1;border:none;font-size:2vh;}
	.final-sub-btn:hover{box-shadow: 3px 5px 15px 0px rgba(0,0,0,0.4);transition:all 0.4s;}
	/*panel*/
	.panel{width:100%;padding:15px 0px 15px;}
	.panel-container{margin:0 auto;width:95%;}
	.panel-btn{width:19.5%;border:none;cursor:pointer;background-color:#e74c3c;}
	.panel-btn:hover{background-color:#c0392b}
	.panel-btn a{color:#333;text-decoration:none;font-size:10.5vh;color:#fff;}
	/*time*/
	span{display:block;padding:5px;font-size:1.7vh}
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
<div class="prelim">
	<div class="prelim-header">
		<h1>Prelim</h1>
		<p>Reviewer content on prelim</p>
	</div>
<?php 
$prelim_subs = $prelim->fetchAll();
foreach($prelim_subs as $prelim_sub){
	$getID = $prelim_sub['id'];
	$getTime = $prelim_sub['time_elapsed'];
	$timeElapsed = time_elapsed($getTime);
?>
	<div class="subjects">
		<div class="subject-btn">
			<a href="subjects.php?subject_id=<?php echo $prelim_sub['id']; ?>"><button class="prelim-sub-btn">View</button></a>
			<a href="delete.php?delete_id=<?php echo $prelim_sub['id']; ?>"><button class="prelim-sub-btn">Remove</button></a>
			<div class="professor"><?php echo $prelim_sub['professor']; ?>
			<p><?php echo $prelim_sub['title']?>
				<span><?php echo  $timeElapsed; ?></span>
			</p>
			
			</div>
		</div>
	</div>
<?php 
}
?>
</div>
<div class="midterm">
	<div class="midterm-header">
		<h1>Midterm</h1>
		<p>Reviewer content on midterm</p>
	</div>
<?php 
$midterm = $conn->prepare("SELECT * FROM midterm ORDER BY id DESC");
$midterm->execute();
$mid_subs = $midterm->fetchAll();
foreach($mid_subs as $mid_sub){
	$getTime = $mid_sub['time_elapsed'];
	$timeElapsed = time_elapsed($getTime);
?>	<div class="midterm-sub">
			<div class="midterm-btn">
				<a href="midterm.php?mid_id=<?php echo $mid_sub['id']; ?>"><button class="midterm-sub-btn">View</button></a>
				<a href="delete.php?mid_id=<?php echo $mid_sub['id']; ?>"><button class="midterm-sub-btn">Remove</button></a>
				<div class="professor"><?php echo $mid_sub['professor']; ?>
					<p><?php echo $mid_sub['title']; ?>
						<span><?php echo $timeElapsed; ?></span>
					</p>
				</div>
			</div>
		</div>
	</div>
<?php
}
?>
<div class="final">
	<div class="final-header">
		<h1>Final</h1>
		<p>Reviewer content on Final</p>
	</div>
<?php

$final = $conn->prepare("SELECT * FROM final ORDER BY id DESC");
$final->execute();
$final_subs = $final->fetchAll();
foreach($final_subs as $final_sub){
	$getTime = $final_sub['time_elapsed'];
	$timeElapsed = time_elapsed($getTime);
?>
	<div class="final-sub">
			<div class="final-btn">
				<a href="final.php?final_id=<?php echo $final_sub['id']; ?>"><button class="final-sub-btn">View</button></a>
				<a href="delete.php?final_id=<?php echo $final_sub['id']; ?>"><button class="final-sub-btn">Remove</button></a>
				<div class="professor"><?php echo $final_sub['professor']; ?>
					<p><?php echo $final_sub['title']; ?>
						<span><?php echo $timeElapsed; ?></span>
					</p>
				</div>
			</div>
		</div>
	</div>
<?php 
}
?>
</body>
</html>