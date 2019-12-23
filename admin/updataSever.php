<?php
header("Content-type:text/html;charset=UTF-8");
$ueContent=$_POST['ueContent'];
$title=$_POST['title'];
$date=$_POST['date'];
$author=$_POST['author'];
$type=$_POST['type'];
$keyWords=$_POST['keyWords'];
$imgH=$_POST['imgH'];
$id=$_REQUEST["id"];
$jianjie=$_POST['jianjie'];
$imgH=str_replace("<p>","",$imgH);
$imgH=str_replace("</p>","",$imgH);
$weight=$_POST['weight'];

preg_match('/<img.+src=\"?(.+?\.(jpg|gif|bmp|bnp|png))\"?.+>/i',$imgH,$match);
// preg_match('/<img.+src=\"?(.+\.(jpg|gif|bmp|bnp|png))\"?.+>/i',$imgH,$match);对比一下就是多了一个？，没有这个会出来多个jpg的匹配，正则还得研究

$imgUrl= $match[1];



session_start();
if(!isset($_SESSION['username'])){
echo "你还没有登录，<a href='login.html'>请登录</a>,稍后自动跳转到登录页面";
	header("Refresh:3;url=login.html");
}else{	
	



	require "connet.php";
   $conn=new Mysql();
 	
$sql="UPDATE  news SET title='".$title."',content='".$ueContent."',date='".$date."',imgH='".$imgH."',imgUrl='".$imgUrl."',author='".$author."',type='".$type."',jianjie='".$jianjie."',weight=".$weight.",keyWords='".$keyWords."'  WHERE id=".$id;
  $result=$conn->sql($sql);
  
  
  

if ($result === TRUE) {
    echo "提交成功";
	header("Refresh:2;url=admin.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
};
   
$conn->close();

	
}
	
	
	



