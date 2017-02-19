<link rel="apple-touch-icon" href="<?php echo base_url() ?>resources/javbus/apple-touch-icon.png">
<link rel="shortcut Icon" href="<?php echo base_url() ?>resources/javbus/favicon2.ico">
<link rel="bookmark" href="<?php echo base_url() ?>resources/javbus/favicon2.ico">
<link href="<?php echo base_url() ?>resources/javbus/blurmask.css" rel="stylesheet">
<nav class="navbar navbar-default navbar-fixed-top top-bar" style="z-index:2">
    <div class="container-fluid">
        <div class="navbar-header mh50">
            <a href="<?php echo base_url() ?>index.php/jav/javhome/" >
                <img class="hidden-xs" height="50" alt="JavBus" src="<?php echo base_url() ?>resources/javbus/logo.png" style="height:40px; margin-top:5px;">
                <img class="visible-xs-inline" height="50" alt="JavBus" src="<?php echo base_url() ?>resources/javbus/logo.png">
            </a>                                                 

            <div class="btn-group pull-right visible-xs-inline" role="group" style="margin:8px 8px 0 0;">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <span class="glyphicon glyphicon-globe"></span>  <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="https://www.javbus5.com/en/CHN-120">English</a></li>
                    <li><a href="https://www.javbus5.com/ja/CHN-120">日本语</a></li>
                    <li><a href="https://www.javbus5.com/ko/CHN-120">한국의</a></li>
                    <li><a href="  ">中文</a></li>   
                </ul>
            </div>
 
 		   
 
        </div>
 
        <div id="navbar" class="collapse navbar-collapse">
            <div class="navbar-form navbar-left fullsearch-form">
                <div class="input-group">
                    <input id="search-input" type="text" class="form-control" placeholder="查询 车牌号 , 车名, 司机">
                    <span class="input-group-btn">
                    <button class="btn btn-default" type="submit" onclick="searchs('search-input')">搜尋</button>
                    </span>
                </div>
            </div>
            <ul class="nav navbar-nav">
            	<li class="active"><a href="<?php echo base_url() ?>index.php/jav/javhome/?">有碼</a></li>                    
                <li><a href="<?php echo base_url() ?>index.php/jav/pag404">無碼</a></li>
                <li class="hidden-md hidden-sm"><a href="<?php echo base_url() ?>index.php/jav/pag404">歐美</a></li>
             
             <!--  <li><a href="JavaScript:;" onclick="setall('4m');">allz</a></li> 
                <li><a href="JavaScript:;" onclick="setall('8');">yj</a></li>  -->
               
                <script>
                //var censored_ids= [];
                function ajaxaddallgc(s){  //HuiFang.Funtishi("请输入名字。");return;
                	
                	var t = "../ajaxaddgc/?Genre="+s+"&code_36="+code_36  ;
            	    $.ajax({
            	        url: t,
            	        type: "GET",
            	        data: {censored_ids:$("#username").val(), content:$("#content").val()},
            	        success: function(ree) {
            	        	ShowMsg(ree);
            	        	//AlertMY('-------');
            	        	//window.location.href
            	        	//location.href=location.href;
            	            //$("#magnet-table").append(e)--
            	        }
            	    });
               	};  
					function setall(str){
						 var code_36s= [];
						 $(".code_36").each(function(){
							 
							   // console.log($(this).text());
							 code_36s.push($(this).text());
							  });
						 console.log(code_36s);
//return 
						 var t = "../ajaxaddallgc/?Genre="+str ;
		            	    $.ajax({
		            	        url: t,
		            	        type: "GET",
		            	        data: {'code_36s':code_36s},
		            	        success: function(ree) {
		            	        	ShowMsg(ree);
		            	        	//AlertMY('-------');
		            	        	//window.location.href
		            	        	//location.href=location.href;
		            	            //$("#magnet-table").append(e)--
		            	        }
		            	    });
						 
						}
                </script>
<!--                 https://www.javbus5.com/forum/           	 -->
                <li class="dropdown hidden-sm">
                    <a href="  #" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" role="button" aria-expanded="false">類別 <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="<?php echo base_url() ?>index.php/jav/genretmjav/">有碼類別</a></li>
                        <li><a href="<?php echo base_url() ?>index.php/jav/pag404">無碼類別</a></li>				
                    </ul>
                </li>
                <li class="dropdown hidden-sm">
                    <a href="  #" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" role="button" aria-expanded="false">女優 <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="<?php echo base_url() ?>index.php/jav/javactresses/">有碼女優</a></li>
                        <li><a href= "<?php echo base_url() ?>index.php/jav/pag404">無碼女優</a></li>				
                    </ul>
                </li>                
                <li class="dropdown"><a href="https://www.javbus5.com/" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-menu-hamburger"></span></a>
                    <ul class="dropdown-menu" role="menu">
                    	<li class="visible-md-block visible-sm-block"><a href="<?php echo base_url() ?>index.php/jav/pag404">歐美</a></li>
                        <li class="visible-sm-block"><a href="https://www.javbus5.com/genre">有碼類別</a></li>
                        <li class="visible-sm-block"><a href="<?php echo base_url() ?>index.php/jav/pag404">無碼類別</a></li>
                        <li class="visible-sm-block"><a href="https://www.javbus5.com/actresses">有碼女優</a></li>
                        <li class="visible-sm-block"><a href= "<?php echo base_url() ?>index.php/jav/pag404">無碼女優</a></li>                        
                        <li><a href="<?php echo base_url() ?>index.php/jav/javhome/?&hd=1">高清</a></li>
                        <li><a href="<?php echo base_url() ?>index.php/jav/javhome/?&sub=1">字幕</a></li>
                    </ul>
				</li> 
            </ul>
           <!-- 
            
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="  #" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-globe" style="font-size:12px;"></span> <span class="hidden-md hidden-sm">English</span> <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="https://www.javbus5.com/en/CHN-120">English</a></li>
                        <li><a href="https://www.javbus5.com/ja/CHN-120">日本语</a></li>
                        <li><a href="https://www.javbus5.com/ko/CHN-120">한국의</a></li>
                        <li><a href="  ">中文</a></li>   
                    </ul>
                </li>
            </ul> -->
            
             <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" role="button" aria-expanded="false">
                    <span class="glyphicon glyphicon-magnet" style="font-size:12px;"></span> 
                    <span class="hidden-md hidden-sm">当前结果筛选</span>
                    <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li id="cellshowall">
                        <a  href="<?php $s='http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];echo str_replace('per_page', 'per_page0', $s) ?>&file=3" target="_blank" >
                        <span class="glyphicon glyphicon-film"></span>已有文件</a></li>
                        <li id="cellshowall">
                        <a  href="<?php $s='http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];echo str_replace('per_page', 'per_page0', $s) ?>&hd=1" target="_blank" >
                        <span class="glyphicon glyphicon-film"></span>已有高清</a></li>
					    <li id="cellshowall">
                        <a  href="<?php $s='http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];echo str_replace('per_page', 'per_page0', $s) ?>&gc=4m" target="_blank" >
                        <span class="glyphicon glyphicon-film"></span>主观视角</a></li>
                         
                    </ul>
                </li>
            </ul>
<ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" role="button" aria-expanded="false">
                    <span class="glyphicon glyphicon-film" style="font-size:12px;"></span>
                     <span class="hidden-md hidden-sm">全部影片筛选</span>
                     <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li id="cellshowmag">
                        <a  href="<?php $s= base_url().'index.php/jav/javhome/'?>?&mg=1"  >
                        <span class="glyphicon glyphicon-magnet"></span> 已有磁力</a></li>
                        <li id="cellshowmag"><a  href="<?php $s= base_url().'index.php/jav/javhome/'; //echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>?&file=3"  ><span class="glyphicon glyphicon-magnet"></span> 已有文件</a></li>
                        <li id="cellshowmag"><a  href="<?php $s= base_url().'index.php/jav/javhome/';   ?>?&hd=1"  ><span class="glyphicon glyphicon-magnet"></span> 已有高清</a></li>
					  
                    </ul>
                </li>
            </ul>
                         
        </div>
        <!--/.nav-collapse -->
    </div>
</nav>

<script>
/*
//自动关闭提示框  
function AlertMY(str) {  
    var msgw,msgh,bordercolor;  
    msgw=350;//提示窗口的宽度  
    msgh=100;//提示窗口的高度  
    titleheight=25 //提示窗口标题高度  
    bordercolor="#666";//提示窗口的边框颜色  
    titlecolor="#BCD";//提示窗口的标题颜色  
    var sWidth,sHeight;  
    //获取当前窗口尺寸  
    sWidth = document.body.offsetWidth;  
    sHeight = document.body.offsetHeight;  
//    //背景div  
    var bgObj=document.createElement("div");  
    bgObj.setAttribute('id','alertbgDiv');  
    bgObj.style.position="absolute";  
    bgObj.style.top="0";  
    bgObj.style.background="#FFF";  
    bgObj.style.filter="progid:DXImageTransform.Microsoft.Alpha(style=3,opacity=25,finishOpacity=75";  
    bgObj.style.opacity="0.6";  
    bgObj.style.left="0";  
    bgObj.style.width = sWidth + "px";  
    bgObj.style.height = sHeight + "px";  
    bgObj.style.zIndex = "10000";  
    document.body.appendChild(bgObj);  
    //创建提示窗口的div  
    var msgObj = document.createElement("div")  
    msgObj.setAttribute("id","alertmsgDiv");  
    msgObj.setAttribute("align","center");  
    msgObj.style.background="white";  
    msgObj.style.border="1px solid " + bordercolor;  
    msgObj.style.position = "absolute";  
    msgObj.style.left = "50%";  
    msgObj.style.font="12px/1.6em Verdana, Geneva, Arial, Helvetica, sans-serif";  
    //窗口距离左侧和顶端的距离   
    msgObj.style.marginLeft = "-225px";  
    //窗口被卷去的高+（屏幕可用工作区高/2）-150  
    msgObj.style.top = document.body.scrollTop+(window.screen.availHeight/2)-150 +"px";  
    msgObj.style.width = msgw + "px";  
    msgObj.style.height = msgh + "px";  
    msgObj.style.textAlign = "center";  
    msgObj.style.lineHeight ="25px";  
    msgObj.style.zIndex = "10001";  
    document.body.appendChild(msgObj);  
    //提示信息标题  
    var title=document.createElement("h4");  
    title.setAttribute("id","alertmsgTitle");  
    title.setAttribute("align","left");  
    title.style.margin="0";  
    title.style.padding="3px";  
    title.style.background = "#D1E9F7";  
    title.style.filter="progid:DXImageTransform.Microsoft.Alpha(startX=20, startY=20, finishX=100, finishY=100,style=1,opacity=75,finishOpacity=100);";  
    title.style.opacity="0.75";  
    title.style.border="1px solid " + bordercolor;  
    title.style.height="18px";  
    title.style.font="12px Verdana, Geneva, Arial, Helvetica, sans-serif";  
    title.style.color="black";  
    title.innerHTML="提示信息!";  
    document.getElementById("alertmsgDiv").appendChild(title);  
    //提示信息  
    var txt = document.createElement("p");  
    txt.setAttribute("id","msgTxt");  
    txt.style.margin="16px 0";  
    txt.innerHTML = str;  
    document.getElementById("alertmsgDiv").appendChild(txt);  
    //设置关闭时间  
    window.setTimeout("closewin()",500);   
}  
function closewin() {  
    document.body.removeChild(document.getElementById("alertbgDiv"));  
    document.getElementById("alertmsgDiv").removeChild(document.getElementById("alertmsgTitle"));  
    document.body.removeChild(document.getElementById("alertmsgDiv"));  
}

*/
//tip是提示信息，type:'success'是成功信息，'danger'是失败信息,'info'是普通信息
function ShowTip(tip, type) {

    /* var $tip = $('#tip');
    if ($tip.length == 0) {
        $tip = $('<span id="tip" style="font-weight:bold;position:absolute;top:50%;left: 50%;z-index:9999"></span>');
        $('body').append($tip);
    }
    $('#tip').attr('top',document.body.scrollTop+(window.screen.availHeight/2)-150 +"px");
    $tip.stop(true).attr('class', 'alert alert-' + type).text(tip).css('margin-left', -$tip.outerWidth() / 2).fadeIn(500).delay(2000).fadeOut(500);
	 */
	// alert(tip)
	$('#addmsg').html(tip);
	$('#add-loading').show();
	  setTimeout(function(){
		  $('#add-loading').hide();
		  }, 2000);
	
}

function ShowMsg(msg) {
	
    ShowTip(msg, 'info');
}

function ShowSuccess(msg) {
    ShowTip(msg, 'success');
}

function ShowFailure(msg) {
    ShowTip(msg, 'danger');
}

function ShowWarn(msg, $focus, clear) {
    ShowTip(msg, 'warning');
    if ($focus) $focus.focus();
    if (clear) $focus.val('');
    return false;
}
</script>
