<?php
header("Content-type:text/html;charset=UTF-8");
$ueContent=$_POST['ueContent'];
$title=$_POST['title'];
$date=$_POST['date'];
$author=$_POST['author'];
$type=$_POST['type'];
$keyWords=$_POST['keyWords'];
$imgH=$_POST['imgH'];
$jianjie=$_POST['jianjie'];
$weight=$_POST['weight'];
$imgH=str_replace("<p>","",$imgH);
$imgH=str_replace("</p>","",$imgH);

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
 $sql="INSERT INTO news(title,content,date,imgUrl,imgH,author,type,jianjie,weight,keyWords) VALUES('".$title."','".$ueContent."','".$date."','".$imgUrl."','".$imgH."','".$author."','".$type."','".$jianjie."',".$weight.",'".$keyWords."')";
//一定要注意单引号和双引号，我就是忘写单引号总是失败,数据库操作一定要注意数据类型，决定是否加引号

  $result=$conn->sql($sql);
  
  
  

//$servername = "localhost";
//$username = "root";
//$password = "821120";
//$dbname = "yugyud";
//
//// 创建连接
//$conn = new mysqli($servername, $username, $password, $dbname);
//// 检测连接
//if ($conn->connect_error) {
//  die("连接失败: " . $conn->connect_error);
//} 
// $sql="INSERT INTO news(title,content,date,imgUrl,author,type) VALUES('".$title."','".$umContent."','".$date."','".$imgUrl."','".$author."','".$type."')";
//一定要注意单引号和双引号，我就是忘写单引号总是失败
if ($result === TRUE) {
    echo "提交成功，<a href='admin.php'>继续编辑请点击</a>,稍后自动跳转到编辑页面";
	header("Refresh:2;url=admin.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
};
   
$conn->close();

	
}
	
	
	



