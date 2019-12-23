<?php
	header("Content-type:text/html;charset=UTF-8");
	require "../admin/connet.php";   //导入mysql.php访问数据库 
	$conn=new Mysql();
	$sql="SELECT * FROM news WHERE type='新闻' order by id desc limit 0,12";
    $result=$conn->sql($sql);
	class Xinwen
	{
	    public $title;	
	    public $date;
	    public $imgUrl;
		public $imgH;
		public $jianjie;
		public $type;
		public $url;
		public $author;				
		public $content;
		public $weight;
		public $id;
		public $keyWords;
	}
	
	$num_results = $result -> num_rows; //结果行数 

	 for($i =0  ;$i < $num_results ;$i++)//循环输出每组元素
	  {
	 	$row = $result -> fetch_assoc();
		$xinwen = new Xinwen();
		$xinwen ->title=$row['title'];
		$xinwen ->date=$row['date'];
		$xinwen ->imgUrl=$row['imgUrl'];
		$xinwen ->imgH=$row['imgH'];
		$xinwen ->jianjie=$row['jianjie'];
		$xinwen ->type=$row['type'];
		$xinwen ->url=$row['url'];
		$xinwen ->author=$row['author'];
		$xinwen ->content=$row['content'];
		$xinwen ->weight=$row['weight'];
		$xinwen ->id=$row['id'];
		$xinwen ->keyWords=$row['keyWords'];
		$data[] = $xinwen;		
	 }	;
	$json_string =json_encode($data);
	echo  json_encode($data);
	

	