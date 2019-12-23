<!DOCTYPE html>
<html lang="zh-CN">
	
<?php      
		header("Content-type:text/html;charset=UTF-8");
		require "admin/connet.php";   //导入mysql.php访问数据库 		
		$conn=new Mysql();
		$id=$_GET['id'];

		
		
		$sql="SELECT * FROM news WHERE id=".$id;
  		$result=$conn->sql($sql);
		$row = $result -> fetch_assoc();
         	
         								
?>		
	
	

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" >
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <meta name="renderer" content="webkit">
    <!-- 目前仅限360急速浏览 webkit:急速  ie-comp:ie兼容模式   ie-stand: ie标准模式 -->
    <title><?=$row['title'] ?></title>
    <meta name="keywords" content="">
    <meta name="description" content="<?=$row['jianjie'] ?>">
    <!-- Bootstrap中文字体版 -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- 自定义样式 -->
    <link href="css/common.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.min.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
<!-- <!-- 整站通用的头部及导航条 -->
<div id="header">
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" style="padding:0 0 0 15px;" href="index.html"><img alt="Brand" style="max-width:130px;"
                                                                                  src="images/logo.png"></a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                <ul class="nav navbar-nav navbar-right">
                    <li  ><a href="index.html">首页 <span class="sr-only">(current)</span></a><p class="line-top hidden-xs"></p></li>
                                        <li ><a href="#">优惠开户</a></li>
                                        <li class="active"><a href="newslist.php">财经十二</a></li>
                                        <li ><a href="xuexijinjie.html">学习进阶</a></li>
                                        <li ><a href="xuexijinjie.html">财经博文</a></li>  <!--放seo文章的-->
                                        <li ><a href="#">联系我们</a></li>
                                      
                                    </ul>
                            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
</div>
<!-- <!-- 整站通用的头部及导航条 -->
<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<ol class="breadcrumb" style="margin-top: 10px; margin-bottom: 10px;">
				<li><a href="/www.yugyud.com/index.html">首页</a></li>
				<li><a href="/www.yugyud.com/newslist.html">财经十二</a></li>				
				<li class="active">资讯正文</li>
			</ol>
		</div>
	</div>
</div>

<div class="main-container">
	<div class="container">
		<div class="row main-container-row" style="position: relative">
			<div class="col-xs-12 col-sm-9 news-article">
				<div class="article-title">		
					<h1 class="h2" style="text-align: center;"><?=$row['title'] ?></h1>
					<p style="font-size: small;color: darkgray;">时间：<span class="riqi"><?=$row['date'] ?></span></p> 
					<p style="font-size: small;color: darkgray;">作者：<span class="author"><?=$row['author'] ?></span></p> 
					<p style="font-size: small;color: darkgray;">重要度：<span class="author"><?=$row['weight'] ?></span></p> 
				</div>
				
				
				<div class="article-content">
					<?=$row['content'] ?>
				</div>

				<div class="article-footer">
					<ul class="pager">
						<li class="previous"><a href="" title="">&larr; 上一篇</a></li>
						
						<li class="next"><a href="javascript:alert('最后一页');" title="最后一页">下一篇 &rarr;</a></li>
					</ul>
				</div>
			</div>
			
			
<!--右侧导引栏开始-->
<div class="col-sm-3">
    <div id="sidebar">
        <div id="sidebar-content" class="sidebar-right">
            <h4 class="hidden-xs">客户服务</h4>
            <div class="sidebar-contact hidden-xs">
                <a class="sidebar-phone" title="免费电话咨询">17710722720</a>
                <a class="sidebar-qq" target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=1036167988&site=qq&menu=yes">点击QQ咨询</a>
                
            </div>
            <h4>年度重磅新闻</h4>
            
<?php  
		$sql2="SELECT * FROM news WHERE weight=5 order by id desc";
  		$result2=$conn->sql($sql2);
		$num2=$result2 -> num_rows;
		if($num2==0){
			
			
?>
            <ul>
                <li><a target="_blank" href="">暂时还没有重要的新闻</a></li>
                 
            </ul>

<?php			
			
		}else{
		
		
	  for($i =0  ;$i < $num2 ;$i++)//循环输出每组元素 
      {
	 
    $row2 = $result2 -> fetch_assoc();//提取元素，一次一行，fetch_assoc()提取出的元素，有属性以及值 		
?>          
	        
 		
            <ul>
                <li><a target="_blank" href="/yugyud/newcontent.php?id=<?=$row2['id'] ?>"><?=$row2['title'] ?></a></li>
                 
            </ul>     
            
<?php            
 }
 }   
?>	            
     

             
             <hr />
            <h4>常用工具</h4>
            <ul>
                <li><a target="_blank" href="">宏观数据查询</a></li>
                <li><a target="_blank" href="">新闻查询</a></li>
                <li><a href="">研究报告下载</a></li>
                <li><a href="">财经书籍下载</a></li>
            </ul>
        </div>
    </div>
</div>
<!--右侧导引栏结束-->


<p class="hidden-xs" id="right-line"></p>		</div>
	</div>
</div>

<script type="text/javascript">
	/** 响应式sidebar 通用版块 **/
	$(function () {
		//页面加载时初始化
		var sidebar = $('#sidebar');
		var sidebarContent = $('#sidebarContent');
		var sidebarBg = $('#sidebar-bg');

		var navHeight = (window.innerWidth < 768) ? 0 : 82;

		//点击显示菜单按钮
		$('#slider-menu').click(function(event){
			if( sidebar.is(':hidden')){
				sidebar.show();
				sidebarBg.css({
					"position" : "fixed",
					"top" : 0,
					"left" : 0,
					"display" : "block",
					"width" : "100%",
					"height" : "100%",
					"z-index" : 1090,
					"background-color" : "rgba(0,0,0,0.5)"
				});
			}else{
				sidebar.hide();
				sidebarBg.hide();
			}
		});
		//如果是手机屏幕, 点周空白处隐藏菜单
		sidebarBg.click(function(){
			sidebar.hide();
			sidebarBg.hide();
		});

		//浮动菜单函数
		var flowMenu = function(validHeight){
			if($('.main-container-row').offset().top < $(window).scrollTop()+navHeight){
				//console.log('跑出去了');
				sidebar.css({
					"position" : "fixed",
					"width" :sidebar.parent().width(),
					"height" : validHeight,
					//"top" : $(window).scrollTop()+navHeight-$('.main-container-row').offset().top,
					"top" : navHeight
				});
			}else{
				sidebar.css({
					"position" : "relative",
					"width" : sidebar.parent().width(),
					"height" : validHeight,
					"top" : ""
				});
			}
		}

		//视口改变时
		$(window).resize(function () {
			navHeight = (window.innerWidth < 768) ? 0 : 82;
			sidebar.css({
				"width" : sidebar.parent().width()
			});
			if(window.innerWidth>=768){
				sidebar.show();
				sidebarBg.hide();
				var validHeight = $('.main-container-row').offset().top + $('.main-container-row').outerHeight()-$(window).scrollTop()-navHeight;
				flowMenu(validHeight);
			}else{
				sidebar.hide();
				sidebarBg.hide();
			}
		});
		//页面滚动时
		$(window).scroll(function(){
			var validHeight = $('.main-container-row').offset().top + $('.main-container-row').outerHeight()-$(window).scrollTop()-navHeight;
			if(window.innerWidth>=768){
				flowMenu(validHeight);
			}
		});
	});
	/** 响应式sidebar 通用版块 **/
</script>
<!-- 返回顶部滑块 -->
<div id="clan-slider">
    <ul>
        <li class="hidden-xs">
            <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=1036167988&site=qq&menu=yes" id="slider-qq"></a>             
            <div class="clan-slider-tips">
                QQ咨询
            </div>
        </li>
        <li class="hidden-xs">
            <a id="slider-phone" href="javascript:void(0);"></a>
            <div class="clan-slider-tips">
                17710722720
            </div>
        </li>
        <li class="hidden-xs">
            <a id="slider-wechat" href="javascript:void(0);"></a>
            <div class="clan-slider-tips-wechat">
                <img src="images/wechat.png">
            </div>
        </li>
        <li><a id="slider-goTop" href="javascript:void(0);"></a></li>
        <!--
        <li class="visible-xs-block">
            <a id="slider-menu" href="javascript:void(0);"></a>
        </li>
        -->
    </ul>
</div>
<!-- 返回顶部滑块 --><!-- 整站通用的尾部 -->
<div id="sidebar-bg" style="display: none;"></div>
<!-- 立即咨询 -->

<!-- 立即咨询 -->
<!-- 通用页脚 -->
<div id="footer">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-sm-2 footer-item">
                <div class="footer-list">
                    <h4>常用工具</h4>
                    <ul>
                        <li><a href="" target="_blank">数据查询</a></li>
                        <li><a href="">股民论坛</a></li>
                        <li><a href="">资料下载</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-xs-6 col-sm-2 footer-item">
                <div class="footer-list">
                    <h4>快捷裢接</h4>
                    <ul>
                        <li><a href="">财经十二</a></li>
                        <li><a href="">开户指导</a></li>
                        <li><a href="">常见问题</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-xs-6 col-sm-2 footer-item">
                <div class="footer-list">
                    <h4>关于我们</h4>
                    <ul>
                        <li><a href="">联系我们</a></li>
                        <li><a href="">服务咨询</a></li>
                        <li><a href="javascript:AddFavorite('北京股票开户','http://www.yugyud.com/');">收藏本站</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-xs-6 col-sm-2 footer-item">
                <div class="footer-wechat">
                    <img class="img-responsive" src="images/wechat.png">
                  
                </div>
            </div>
            <div class="col-xs-12 col-sm-4 footer-item footer-item-last">
                <div class="footer-contact">
                    
                    <h2><img src="images/pc-footer-qq.png">1036167988</h2>
                    <h2><img src="images/pc-footer-mob.png">17710722720</h2>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<div id="copyright">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <p>北京股票开户 </p>


            </div>
        </div>
    </div>
</div>
<!-- 通用页脚 -->
<!-- 手机端底部 -->
<div id="mob-bottom" class="visible-xs-block">
    <div class="container">
        <div class="row">
            <div class="col-xs-3 mob-bottom-item">
                <a href="tel:17710722720">
                    <img class="img-responsive center-block" src="images/mob-footer-phone.png">
                    <span>电话咨询</span>
                </a>
            </div>
            <div class="col-xs-3 mob-bottom-item">
                <a href="tel:17710722720">
                    <img class="img-responsive center-block" src="images/mob-footer-mob.png">
                    <span>紧急电话</span>
                </a>
            </div>
            <div class="col-xs-3 mob-bottom-item">
                <a href="http://wpa.qq.com/msgrd?v=3&uin=1036167988&site=qq&menu=yes">
                    <img class="img-responsive center-block web-chat" src="images/mob-footer-chat.png">
                    <span>在线咨询</span>
                </a>
            </div>
            <div class="col-xs-3 mob-bottom-item">
                <a href="sms:17710722720">
                    <img class="img-responsive center-block" src="images/mob-footer-msm.png">
                    <span>短信咨询</span>
                </a>
            </div>
        </div>
    </div>
</div>
<!-- 手机端底部 -->
<!-- 整站通用的尾部 -->



<script type="text/javascript" src="js/common.js"></script>



</body>
</html>