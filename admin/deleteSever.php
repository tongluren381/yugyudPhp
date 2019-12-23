<?php
$id=$_REQUEST["id"];

require "connet.php";
$conn=new Mysql();
$sql="DELETE FROM news WHERE id=".$id;  
$result=$conn->sql($sql);
$conn->close();
header("location:admin.php");
