<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>后台管理</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="../css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/dashboard.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.min.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
  </head>
<style>
	.marginRight10{
		margin-right: 10px;
	}
	.marginLeft30{
		margin-left: 30px;
	}

</style>
  <body>

<?php
session_start();

  if(isset($_SESSION['username'])&& !empty($_SESSION["username"])){
   
 
		header("Content-type:text/html;charset=UTF-8");
		require "connet.php";   //导入mysql.php访问数据库 



	$currentPage = isset($_GET["page"])?$_GET["page"]:1;//获取当前页
	$chaxun = isset($_GET["chaxun"])?$_GET["chaxun"]:"";//获取当前页
	$pageNum=12;//一页多少个数据
	$type = isset($_GET["type"])?$_GET["type"]:"";
	$date = isset($_GET["date"])?$_GET["date"]:"";
	$tollActive="";		
	
  $conn=new Mysql();
  
       
	
	
	
 

	
//把所有跳转都写一个页面不好，分类和查询的分页跳转就没法弄，最好单独写页面,因为要给跳转分页传值
//....最终做好了，哈哈，有时就是觉得复杂就不做了而已
	if($type==""&&$date==""){
			$sql="SELECT * FROM news ";
			$tollActive="active";
			$hrefValue="";
			$sql2="SELECT * FROM news order by id desc limit ".($currentPage-1)*$pageNum.",".$pageNum;
			
	}elseif($type!=""){
		$sql="SELECT * FROM news where type='".$type."'";
		$sql2="SELECT * FROM news where type='".$type."'  order by id desc  limit ".($currentPage-1)*$pageNum.",".$pageNum;;
		$hrefValue="&&type=".$type;
		
	}elseif($date!=""){
		$sql="SELECT * FROM news where date='".$date."'";
		$sql2="SELECT * FROM news where date='".$date."'  order by id desc  limit ".($currentPage-1)*$pageNum.",".$pageNum;;
		$hrefValue="&&date=".$date;
	};
	
	if($chaxun!=""){
		$sql2="SELECT * FROM news where content LIKE '%".$chaxun."%'  order by id desc limit ".($currentPage-1)*$pageNum.",".$pageNum;;
		$sql="SELECT * FROM news where content LIKE '%".$chaxun."%'";
		$hrefValue="&&chaxun=".$chaxun;
	}	;	

  $result=$conn->sql($sql);
	$sum = $result -> num_rows; //结果行数 	
	$num=$sum%$pageNum==0?($sum/$pageNum):intval($sum/$pageNum)+1;//总页数		
				
?>

<!--头部导航开始-->
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="admin.php">后台管理</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
          	<?php 
          	echo "<li><a href='#'>".$_SESSION['username'] ."</a></li>"
          	?>
            <li><a href="logout.php">退出登录</a></li>
            <li><a href="#"><?=$chaxun ?></a></li>
            <li><a href="#">Help</a></li>
          </ul>
          <form class="navbar-form navbar-right" action="admin.php" method="get">
            <input type="text" class="form-control"  id="chaxun" name="chaxun" placeholder="Search...">
          </form>
        </div>
      </div>
    </nav>
<!--头部导航结束-->

    <div class="container-fluid">
      <div class="row">
      	
   	
      	
<!--  左侧边栏 开始   	-->
        <div class="col-sm-3 col-md-2 sidebar">
         	<h3 >文章列表</h3>
          <ul class="nav nav-sidebar">
   	
            <li class=<?=$tollActive ?>><a href="admin.php">全部文章<span class="sr-only">(current)</span></a></li>
            <li >
						<a href="" class="togg">类型</a>
	          <ul class="nav nav-sidebar marginLeft30 yinChang">
	
<?php
		 
	$sql3="SELECT type FROM news GROUP BY type";
  $result3=$conn->sql($sql3);
	$num3 = $result3 -> num_rows; //结果行数 

	  for($i =0  ;$i < $num3 ;$i++)//循环输出每组元素 
{
	 
    $row3 = $result3 -> fetch_assoc();//提取元素，一次一行，fetch_assoc()提取出的元素，有属性以及值 
     	
	

	         if($type==$row3['type']){
	         	 
	         	
?>
 					<li class="active"><a href="admin.php?type=<?=$row3['type'] ?>"><?=$row3['type'] ?></a></li>

<?php	         	
	         }else{
	         	
?>
 					<li class=""><a href="admin.php?type=<?=$row3['type'] ?>"><?=$row3['type'] ?></a></li>

<?php					
	         }  

}
?>
	
	          </ul>            	
            	
            	
            </li>
            <li >
						<a href="" class="togg">时间</a>
	          <ul class="nav nav-sidebar marginLeft30 yinChang">

<?php
		 
	$sql4="SELECT date FROM news GROUP BY date";
  $result4=$conn->sql($sql4);
	$num4 = $result4 -> num_rows; //结果行数 

	  for($i =0  ;$i < $num4 ;$i++)//循环输出每组元素 
{
	 
    $row4 = $result4 -> fetch_assoc();//提取元素，一次一行，fetch_assoc()提取出的元素，有属性以及值 
     	
	
	         if($date==$row4['date']){
	         	 
	         	
?>
 					<li class="active"><a href="admin.php?date=<?=$row4['date'] ?>"><?=$row4['date'] ?></a></li>

<?php	         	
	         }else{
	         	
?>
 					<li class=""><a href="admin.php?date=<?=$row4['date'] ?>"><?=$row4['date'] ?></a></li>

<?php					
	         }  

}
?>
	
	          

	
	          </ul>            	
            	            	
            </li>
            
          </ul>


        </div>
        

        
  <!--  左侧边栏 结束   	-->    
    
<!--     右侧主体开始   -->
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">文章图文列表</h1>

		<div class="row">
	<!--新增按钮	-->		
		<div class="col-md-12">
			<p><a href="add.php" class="btn btn-success" role="button">新增+</a></p>	 
		</div>		
	<!--新增按钮	-->
<!--遍历数据库调用N次	-->			


<?php


//	$sql2="SELECT * FROM news order by id desc limit ".($currentPage-1)*$pageNum.",".$pageNum;

  $result2=$conn->sql($sql2);
	$num_results = $result2 -> num_rows; //结果行数 

	  for($i =0  ;$i < $num_results ;$i++)//循环输出每组元素 
{
	 
    $row = $result2 -> fetch_assoc();//提取元素，一次一行，fetch_assoc()提取出的元素，有属性以及值 
    
     	
	
?>
 
 		  <div class="col-sm-6 col-md-4">
		    <div class="thumbnail">
		      <?=$row['imgH'] ?> 
		      <div class="caption">
		        <h3><?=$row['title'] ?></h3>	
		        <p><span class="marginRight10">日期：<?=$row['date'] ?></span><span class="marginRight10"> 作者：<?=$row['author'] ?></span><span class="marginRight10">分类：<?=$row['type'] ?></span></p>
		        <p>简介：<?=$row['jianjie'] ?></p>
		        <p><a href="updata.php?id=<?=$row['id'] ?>" class="btn btn-primary" role="button">修改</a> <a  href="deleteSever1.php?id=<?=$row['id'] ?>" class="btn btn-danger" role="button">删除</a></p>
		      </div>
		    </div>
		  </div>
 
 
 
<?php
  } 
	$result2 -> free();
  $result -> free();//释放内存 
  $conn-> close();//断开数据库连接 					      
?>
	
<script type="text/javascript">
	
	
</script>	
	
<!--新增按钮	-->
	<div class="col-md-12">
		<p><a href="add.php" class="btn btn-success" role="button">新增+</a></p>	 
	</div>
<!--新增按钮	-->
<!--分页开始-->
<!--分页php部分-->


<div class="col-md-12" >
<nav aria-label="Page navigation">
  <ul class="pagination">
<?php  	


?>
  	
  	
<!--后退一页  	-->
	<?php if($currentPage>1){
	?>
	<li><a href="admin.php?page=<?=$currentPage-1 ?><?=$hrefValue ?>" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
	<?php }else{?>
	<li><a href="admin.php?page=1" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
	<?php }?>
		

<!--显示的页数   -->
 <?php
 		for($i=1;$i<=$num;$i++){
 			if($i==$currentPage){
?> 				
 				<li class="active"><a href="admin.php?page=<?=$i ?><?=$hrefValue ?>"><?=$i ?></a></li>
 				

<?php 				
 			}else{
?>

			<li><a href="admin.php?page=<?=$i ?><?=$hrefValue ?>"><?=$i ?></a></li>
			
			
						
<?php			
		}	
	}
 
?> 
 
<!--前进一页		-->
	<?php if($currentPage<$sum){?>
	<li><a  href="admin.php?page=<?=$currentPage+1 ?><?=$hrefValue ?>" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>
	<?php }else{?>
	<li><a  href="admin.php?page=<?=$num ?><?=$hrefValue ?>" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>
	<?php }?>



  </ul>
</nav>
</div>
<!--分页结束-->

			  
		</div>


        </div>
   <!--     右侧主体结束   -->    
        
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../js/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/jquery.min.js"><\/script>')</script>
    <script src="../js/bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="../js/holder.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>

<?php
} else{
    echo "你还没有登录，<a href='login.html'>请登录</a>,稍后自动跳转到登录页面";
	header("Refresh:3;url=login.html");

 }
?>
