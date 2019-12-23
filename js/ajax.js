$(function(){	
	$.ajax({
		type:'GET',
		url:'sever/newSever.php',
		timeout:2000,
		dataType:'json',
		success:function(data,textStatus){
			console.log("ok");
			console.log(data);
			var jsondatas = eval(data);
			$.each(jsondatas, function (i, item) {
												
			
			// 控制字符长度	
			// if(jsondatas[i].jianjie.length<53){
			// for(var j=0;j<(53-jsondatas[i].jianjie.length);j++){
			// jsondatas[i].jianjie+="&nbsp;";
			// }
			// }
			// if(jsondatas[i].jianjie.length>=53){
			// jsondatas[i].jianjie = jsondatas[i].jianjie.substring(0,53);
			// };	
				
			jsondatas[i].jianjie = jsondatas[i].jianjie.substring(0,53) + "..."	;		
				
			 var newsHtml = $("<div class='col-sm-6 col-md-4'><a  href='/yugyud/newcontent.php?id="
			  +jsondatas[i].id
			  +"'><div class='thumbnail'>"
              +jsondatas[i].imgH      
              +"<div class='caption' ><h4 style='height: 50px;'>"
              +jsondatas[i].title
              +"</h4><p style='height: 60px;'>"
              +jsondatas[i].jianjie
              +"...</p><p><small>"
              +jsondatas[i].author
              +"</small><small style='margin-left:10px;'>"
              +jsondatas[i].date
              +"</small><small style='margin-left:10px;'>"
              +jsondatas[i].weight
              +"星</small></p></div></div></a></div>");
    　　　　

//          <div class="col-sm-6 col-md-4">
//             	<a  href="/yugyud/newcontent.php?id=$id " >
//                  <div class="thumbnail">             
//                      {imgeUrl}

	//                  <div class="caption" >
	//                      <h4 >{title}</h4>
	//                      <p>{jianjie}</p>
	//                      <p>
	//                        <small>{author}</small>  <small style='margin-left:10px;'>{date}</small><small style='margin-left:10px;'>{weight}</small>
	//                      </p>
	//                  </div>
//                  </div>
//              </a>
//          </div>









				 $("#news").append(newsHtml);
			})
			
			
			
		},
		error: function(json){
			console.log("错误");
		}
	})
})