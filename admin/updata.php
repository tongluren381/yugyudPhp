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

    <title>新闻模板</title>

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
    
    <!--富文编辑器引入-->
    <script type="text/javascript" charset="utf-8" src="../utf8-php/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="../utf8-php/ueditor.all.min.js"> </script>
    <!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
    <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
    <script type="text/javascript" charset="utf-8" src="../utf8-php/lang/zh-cn/zh-cn.js"></script>
    
  </head>

  <body>
<?php  	
session_start();
if(!isset($_SESSION['username'])){
echo "你还没有登录，<a href='login.html'>请登录</a>,稍后自动跳转到登录页面";
	header("Refresh:3;url=login.html");
}else{	
	$id=$_REQUEST["id"];
	
	require "connet.php";
	$conn=new Mysql();
	$sql="SELECT * FROM news WHERE id=".$id;  
	$result=$conn->sql($sql);
	$row = $result -> fetch_assoc();
	
	
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
          	
          	<li><a href='#'><?=$_SESSION['username'] ?></a></li>"
          	
            <li><a href="logout.php">退出登录</a></li>
            <li><a href="#">Profile</a></li>
            <li><a href="#">Help</a></li>
          </ul>
          <form class="navbar-form navbar-right">
            <input type="text" class="form-control" placeholder="Search...">
          </form>
        </div>
      </div>
    </nav>
<!--头部导航结束-->

    <div class="container-fluid">
      <div class="row">
      	
      	
<!--  左侧边栏 开始   	-->
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li class="active"><a href="#">文章列表<span class="sr-only">(current)</span></a></li>
            <li><a href="#">Reports</a></li>
            <li><a href="#">Analytics</a></li>
            <li><a href="#">Export</a></li>
          </ul>
          <ul class="nav nav-sidebar">
            <li><a href="">Nav item</a></li>
            <li><a href="">Nav item again</a></li>
            <li><a href="">One more nav</a></li>
            <li><a href="">Another nav item</a></li>
            <li><a href="">More navigation</a></li>
          </ul>
          <ul class="nav nav-sidebar">
            <li><a href="">Nav item again</a></li>
            <li><a href="">One more nav</a></li>
            <li><a href="">Another nav item</a></li>
          </ul>
        </div>
        
  <!--  左侧边栏 结束   	-->    
    
<!--     右侧主体开始   -->
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">文章编辑</h1>
          
          


<form class="form-group" action="updataSever.php?id=<?=$id ?>" method="post" >
  <div class="form-group">
    <label for="title">标题</label>
    <input type="text" class="form-control" id="title" name="title" value="<?=$row['title'] ?>">
  </div>
  <div class="form-group">
    <label for="date">时间</label>
    <input type="date " class="form-control" id="date" name="date" value="<?=$row['date'] ?>">
  </div>
  <div class="form-group">
    <label for="authoor">作者</label>
    <input type="text" class="form-control" id="author" name="author" value="<?=$row['author'] ?>">
  </div>
  <div class="form-group">
    <label for="type">类型</label>
    <input type="text" class="form-control" id="type" name="type" value="<?=$row['type'] ?>">
  </div>
  <div class="form-group">
  	<label >影响力   </label>	
		    <input type="radio" name="weight" id="optionsRadios1" value="1">1
		    <input type="radio" name="weight" id="optionsRadios2" value="2" checked="checked">2
		    <input type="radio" name="weight" id="optionsRadios2" value="3" >3
 				<input type="radio" name="weight" id="optionsRadios2" value="4">4
		    <input type="radio" name="weight" id="optionsRadios2" value="5">5						
  </div>      
  <div class="form-group">
    <label for="jianjie">内容简介:50字以内</label>
		<textarea name="jianjie" id="jianjie" style="width: 100%;height: 50px;"><?=$row['jianjie'] ?></textarea>    
  </div>  
  <div class="form-group">
    <label for="keyWords">关键词:","号分隔</label>
  		<textarea name="keyWords" id="keyWords" style="width: 100%;height: 26px;"><?=$row['keyWords'] ?></textarea>    
  </div> 
    <div class="form-group">
    <label for="imgH">封面图片232*102</label>
		<textarea name="imgH" id="imgH" style="width: 100%;height: 50px;">
		<?=$row['imgH'] ?>
		</textarea>   
	 </div> 	
<!--	简单封面图的富文	-->
	<script type="text/javascript">

	var ue2 = UE.getEditor('imgH', {
    toolbars: [
        ['fullscreen', 'source', 'undo', 'redo','simpleupload']
    ],
    autoHeightEnabled: true,
    autoFloatEnabled: true
});	
		
		
	</script>	
		
	<!--	简单封面图的富文	-->	  

  
  
  <div class="form-group">
    <label for="editor">文章内容</label>
		<textarea name="ueContent" id="editor" style="width: 100%;height: 500px;" >
		<?=$row['content'] ?>
		</textarea>    
  </div>

	<button onclick="getContent()">提交</button>
  
</form>



<script type="text/javascript">

//实例化编辑器
//建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
var ue = UE.getEditor('editor');


</script>   









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
}
?>
