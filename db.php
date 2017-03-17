<?php 
$conn = new PDO("mysql:host=localhost;dbname=reviewer","root","");
$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
?>