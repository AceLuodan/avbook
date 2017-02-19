<!DOCTYPE html>
<!-- saved from url=(0030)https://www.javbus5.com/page/2 -->
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="renderer" content="webkit">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo str_replace('?&', '', $send)?> </title>
 
<link href="<?php echo base_url() ?>resources/javbus/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url() ?>resources/javbus/bootstrap-theme.min.css" rel="stylesheet">
<link href="<?php echo base_url() ?>resources/javbus/magnific-popup.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>resources/javbus/base.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>resources/javbus/nav.overlay.css">
<script src="<?php echo base_url() ?>resources/javbus/saved_resource" async="" type="text/javascript"></script>

<script src="<?php echo base_url() ?>resources/javbus/jquery.min.js"></script>
<script src="<?php echo base_url() ?>resources/javbus/bootstrap.min.js"></script>
<script src="<?php echo base_url() ?>resources/javbus/jquery.magnific-popup.min.js"></script>
<script src="<?php echo base_url() ?>resources/javbus/jquery.cookie.min.js"></script>
<script src="<?php echo base_url() ?>resources/javbus/base.js"></script>
<script src="<?php echo base_url() ?>resources/javbus/bootstrap-hover-dropdown.js"></script>
<!--[if lt IE 9]> <script src='../js/html5shiv.min.js'></script><script src='../js/respond.min.js'></script><![endif]-->
<style type="text/css">
@media screen and (max-width: 1490px) { 
.ad-table {display:none;}  
} 
@media screen and (min-width: 1490px) { 
.ad-list {display:none;}  
}
</style> 
</head>
<body>
<script language="JavaScript">
var mod = 0;
var lang = 'zh';
var info = '查询车牌号 , 车名, 司机';
function searchs(obj){
	var searchinput = $("#"+obj);
	if(searchinput.val()=='')
	{
		$('#magnet-url-post').trigger("click");	
		   return false;
	}
	else
	{
		$('#search-loading').show();
		window.location.href="?&tit="+encodeURIComponent($.trim(searchinput.val()));
	}
}

$(function(){
	var url ='https://www.javbus5.com/ajax/search-modal.php?floor='+Math.floor(Math.random()*1000+1)+'&lang='+lang;
       $.ajax({url: url,type: 'GET',success: function(msg){
			$("#searchModal").append(msg);										  
	   }});
});
</script>
<div id="search-loading">
    <table class="search-loading-box" border="0" cellpadding="0" cellspacing="0">
        <tbody>
            <tr>
                <td align="center">
                    <table height="80" width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tbody>
                            <tr>
                                <td height="40" align="center">
                                	<div class="search-loading-text">搜尋中...</div>
                                </td>
                            </tr>
                            <tr>
                                <td height="40" align="center">
                                    <img src="<?php echo base_url() ?>resources/javbus/search_loading.gif" border="0">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</div>


<!-- Modal Search -->
<div id="searchModal" class="modal fade" tabindex="-1" role="dialog">  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      	<a href="https://www.javbus5.com/page/2#searchModal" class="hide" data-toggle="modal"><button class="btn" id="magnet-url-post" type="button"></button></a>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title">請輸入搜尋內容！</h4>
      </div>
      <div class="modal-body">
        <p>您沒有輸入搜尋內容，請輸入您要搜尋的內容！</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div> 
  </div>
 <?php $this->load->view('javheader.php')?>
<div class="row visible-xs-inline footer-bar">
    <div class="col-xs-3 text-center">
        <a id="menu" class="btn btn-default trigger-overlay"><span class="glyphicon glyphicon-align-justify"></span></a>
    </div>
    <div class="col-xs-3 text-center">
             <a id="prev" class="btn btn-default" href="https://www.javbus5.com/page/1" style=""><span class="glyphicon glyphicon-chevron-left"></span></a>
         </div>
    <div class="col-xs-3 text-center">
            <a id="prev" class="btn btn-default" href="https://www.javbus5.com/page/3" style=""><span class="glyphicon glyphicon-chevron-right"></span></a>
        </div>    
    <div class="col-xs-3 text-center">
        <a id="back" class="btn btn-default" href="javascript:window.history.back()"><span class="glyphicon glyphicon-share-alt flipx"></span></a>
    </div>    
</div>    
<script src="<?php echo base_url() ?>resources/javbus/focus.js"></script>    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>resources/javbus/main.css">
<script src="<?php echo base_url() ?>resources/javbus/jquery.masonry.min.js"></script>
<div class="container-fluid">
    <div class="row">
	<!--
<table class="ad-table">
    <tbody>
	<tr>
        <td><iframe src="<?php echo base_url() ?>resources/javbus/iframe.html" width="728" height="90" scrolling="no" marginwidth="0" marginheight="0" frameborder="0" style="padding-top:3px;"></iframe></td>
        <td><a href="http://www.sbav18.com/?Intr=25360117" target="_blank" rel="nofollow"><img src="<?php echo base_url() ?>resources/javbus/hg728x90_3.gif" width="728" height="90"></a></td>
    </tr>
    <tr>
        <td><a href="http://222ylg.com/?Agent=javbus" target="_blank" rel="nofollow"><img src="<?php echo base_url() ?>resources/javbus/ylg4.gif"></a></td>
        <td><a href="http://www.1495013.com/?Agent=ad0092" target="_blank" rel="nofollow"><img src="<?php echo base_url() ?>resources/javbus/pj728x90_1.gif"></a></td>
    </tr>
         
</tbody></table>

<div class="ad-list">
<div class="hidden-xs pt10 text-center"><iframe src="<?php echo base_url() ?>resources/javbus/iframe(1).html" width="728" height="90" scrolling="no" marginwidth="0" marginheight="0" frameborder="0" style="padding-top:3px;"></iframe></div> <div class="pt10 text-center bn728-93"><a href="http://www.sbav18.com/?Intr=25360117" target="_blank" rel="nofollow"><img src="<?php echo base_url() ?>resources/javbus/hg728x90_3.gif" width="728" height="90"></a></div> <div class="pt10 text-center bn728-93"><a href="http://222ylg.com/?Agent=javbus" target="_blank" rel="nofollow"><img src="<?php echo base_url() ?>resources/javbus/ylg4.gif"></a></div> <div class="pt10 text-center bn728-93"><a href="http://www.1495013.com/?Agent=ad0092" target="_blank" rel="nofollow"><img src="<?php echo base_url() ?>resources/javbus/pj728x90_1.gif"></a></div> <div class="pt10 text-center bn728-93"><a href="http://vns800600.net/?aff=646908" target="_blank" rel="nofollow"><img src="<?php echo base_url() ?>resources/javbus/hg728x90_4.gif"></a></div> <div class="pt10 text-center bn728-93"><a href="http://www.kxmav2.com/?aff=646884" target="_blank" rel="nofollow"><img src="<?php echo base_url() ?>resources/javbus/hg728x90_2.gif" width="728" height="90"></a></div>  </div>
                -->
<!--  
<div class="alert alert-info alert-dismissable alert-common" style="position:relative">
    <button type="button" class="close" style="position:absolute; right:8px; top:3px;"
data-dismiss="alert" 
onclick='javascript:$.cookie("cnadd5", "off",{expires: 365,path: "/"})'>×</button>
    <div class="row">
    	<div class="col-xs-12 col-md-6 col-lg-3 text-center"><strong>防屏蔽地址發布頁：</strong><a href="https://announce.javbus8.com/website.php" target="_blank">https://announce.javbus8.com/website.php</a></div>
<div class="col-xs-12 col-md-6 col-lg-3 text-center"><strong>防屏蔽地址：</strong><a href="https://www.javbus5.com/" rel="nofollow">https://www.javbus5.com</a></div><div class="col-xs-12 col-md-6 col-lg-3 text-center"><strong>防屏蔽地址：</strong><a href="https://www.javbus2.com/" rel="nofollow">https://www.javbus2.com</a></div><div class="col-xs-12 col-md-6 col-lg-3 text-center"><strong>防屏蔽地址：</strong><a href="https://www.javbus3.com/" rel="nofollow">https://www.javbus3.com</a></div>         	
	</div>
</div>     		

-->
        <div id="waterfall" class="masonry" style="position: relative; height: 2173px; width: 1309px;">
        
         <?php  if(!empty($res_star)):?>
            	   <div class="item masonry-brick" style="position: absolute; top: 0px; left: 0px;">
                <div class="avatar-box">
                    <div class="photo-frame">
                        <img class="star_pic" src="https://jp.netcdn.space/mono/actjpgs/<?php echo $res_star['star_pic'] ?>" title="<?php echo $res_star['star_name'] ?>">
                    </div>
                    <div class="photo-info">
                        <span class="pb10"><?php echo $res_star['star_name'] ?></span>  
                          <p>生日: <?php echo $res_star['star_birthday'] ?></p>
							<p>年龄: <?php echo $res_star['star_age'] ?></p>
							<p>身高: <?php echo $res_star['star_height'] ?>cm</p>
							<p>罩杯: <?php echo $res_star['star_cupsize'] ?></p>
							<p>胸围: <?php echo $res_star['star_bust'] ?>cm</p>
							<p>腰围: <?php echo $res_star['star_waist'] ?>cm</p>	
							<p>臀围: <?php echo $res_star['star_hip'] ?>cm</p>	
							<p>出生地: <?php echo $res_star['hometown'] ?></p>
							<p>爱好: <?php echo $res_star['hobby'] ?></p>
							<p><a href="<?php echo base_url() ?>index.php/jav/javhome/?st0=<?php echo $res_star['star_code_36'] ?>" target="_blank" style="color:#CC0000;">just she</a></p>
						    <p><a href="https://avso.pw/cn/search/<?php echo $res_star['star_code_36'] ?>" target="_blank" style="color:#CC0000;"> </a></p>
						                
                        
                        
                          </div>
                </div>
            </div>
			 <?php endif; ?>
        
      
          <?php
$b=2;
if ($b==1) {
    $picurl ='https://jp.netcdn.space/';
}elseif ($b==2){
    $picurl ="https://pics.dmm.co.jp/";
    //$picurl ="";
}?>
          <?php  foreach($list as $value):  ?>	 
				   <div class="item masonry-brick" style="position: absolute; top: 0px; left: 0px;">
                <a class="movie-box"  target="_blank" href="<?php echo base_url() ?>index.php/jav/javsg/<?php echo $value['censored_id'] ?>?id=<?php echo $value['code_36'] ?>">
                    <div class="photo-frame">
                        <img   class = 'blur0' src="<?php echo $picurl.str_replace('pl.jpg', 'ps.jpg', $value['movie_pic_cover'] )?>"
    	                     onerror="this.src='<?php echo base_url() ?>resources/javbus/deft.jpg'"
    	                     title="<?php echo $value['movie_title'] ?>">
                    </div>                     
					<div class="photo-info">                                   
						<span  title="<?php echo $value['movie_title'] ?>" >
						
						<mark class='hh3' ><?php echo mb_substr(str_replace($value['censored_id'], '', $value['movie_title']) , 0,10)?></mark><br>
						<div class="item-tag">
						<?php if($value['have_mgbtso']==0):?>
                            <button   onclick="seturl('&mg=1')" class="btn btn-xs btn-danger "  title="包含最新出種的磁力連結">无</button>
                        <?php endif;?>
                        
						<?php if($value['have_mgbtso']==1):?>
                            <button class="btn btn-xs btn-warning " onclick="seturl('&mg=1')" title="包含最新出種的磁力連結">磁</button>
                            <?php if($value['have_sub']==1):?>
                                <button class="btn btn-xs btn-warning "onclick="seturl('&sub=1')" title="已下载，有文件">字</button>
                            <?php endif;?>
                            <?php if($value['have_hdbtso']==1):?>
                                <button class="btn btn-xs btn-primary " onclick="seturl('&hd=1')" title="已下载，有文件">高</button>
                            <?php endif;?>
                            
    						<?php if($value['have_file']==3):?>
                                <button class="btn btn-xs btn-success " onclick="seturl('&file=3')" title="已下载，有文件">文</button>
                            <?php elseif($value['have_file']!=0):?>
                                 <button class="btn btn-xs btn-danger " onclick="seturl('&file=<?php echo $value['have_file']?>')" title="已标注未下载"><?php echo $value['have_file']?></button>
                          
                            <?php endif;?>
                             
                            <!-- 
                             <?php if($value['have_file']==8):?>
                                <button class="btn btn-xs btn-danger " onclick="seturl('&file=8')" title="已标注未下载">标</button>
                            <?php endif;?>
                            <?php if($value['have_file']==9):?>
                                <button class="btn btn-xs btn-danger " onclick="seturl('&file=9')" title="正在下载，未完成">待</button>
                            <?php endif;?>
                            -->
                        <?php endif;?>
                       
                            
                         <?php if(strrpos($value['Genre'], '[4m]')!==false && @$_GET['gc']!='4m0'):?>
                                <button class="btn btn-xs btn-info " onclick="seturl('&gc=4m')" title="已下载，有文件">z</button>
                            <?php endif;?>
                            
                            <?php  if(strrpos($value['Genre'], '[8]')!==false && @$_GET['gc']!='8' ):?>
                                <button class="btn btn-xs btn-info " onclick="seturl('&gc=8')" title="已下载，有文件">y</button>
                            <?php endif;?>
                        
                        <!--  
                            <button class="btn btn-xs btn-primary" disabled="disabled" title="包含高清HD的磁力連結">清</button> 
                            <button class="btn btn-xs btn-danger " disabled="disabled" title="包含最新出種的磁力連結">天</button>
                            <button class="btn btn-xs btn-warning" disabled="disabled" title="包含字幕的磁力連結">0</button>
                            <button class="btn btn-xs btn-default" disabled="disabled" title="包含字幕的磁力連結">0</button>
                            <button class="btn btn-xs btn-info" disabled="disabled" title="包含字幕的磁力連結">0</button> -->
                        </div>   
                        <date class="code_36" style="display: none;"><?php echo $value['code_36'] ?></date>                     	
						<date  ><?php echo $value['censored_id'] ?></date> / <date><?php echo $value['release_date'] ?></date></span>
					</div>
                </a>
            </div>
							  <?php endforeach; ?>
        </div>
    </div>
</div>
<script language="JavaScript">
    (function($) {
        $('#waterfall').masonry({
            itemSelector: ".item",
            isAnimated: false,
            isFitWidth: true
        });
    })(jQuery);
</script>
 <div class="text-center hidden-xs">
       <?php echo $page_list ;?> 
</div>

<!-- <footer class="footer hidden-xs"> -->
<!-- 	<div class="container-fluid"> -->
<!--         <p><a href="https://www.javbus5.com/doc/terms">Terms</a> / <a href="https://www.javbus5.com/doc/privacy">Privacy</a> / <a href="https://www.javbus5.com/doc/usc">2257</a> / <a href="http://www.rtalabel.org/" target="_blank" rel="external nofollow">RTA</a> / <a href="javascript:bootstr(1);" r="">廣告投放</a> / <a href="javascript:bootstr(2);">聯絡我們</a> / <a href="https://announce.javbus8.com/website.php" target="_blank">防屏蔽地址發布頁</a><br><a href="https://www.javbus5.com/page/2#formModal" id="adscontact" data-toggle="modal"></a> -->
<!--         Copyright © 2013 JavBus. All Rights Reserved. All other trademarks and copyrights are the property of their respective holders. The reviews and comments expressed at or through this website are the opinions of the individual author and do not reflect the opinions or views of JavBus. JavBus is not responsible for the accuracy of any of the information supplied here.</p> -->
<!-- 	</div> -->
<!-- </footer> -->
<div class="visible-xs-block footer-bar-placeholder"></div>

<script language="javascript">
    function bootstr(type){
    	ads = "廣告投放";
    	contact = "聯絡我們";
    	translate = "翻譯";
    	$("#adstype").val(type);
    	if(type==1){
    		$("#contactModalLab").html(ads);
    		$("#qqskype").show();
    		$("#transinfo").hide();
    		$("#translanguage").hide();
    		$("#mailcontent").show();		
    	}else if(type==2){
    		$("#contactModalLab").html(contact);
    		$("#qqskype").show();
    		$("#transinfo").hide();
    		$("#translanguage").hide();
    		$("#mailcontent").show();
    	}else if(type==3){
    		$("#contactModalLab").html(translate);
    		$("#qqskype").hide();
    		$("#transinfo").show();
    		$("#translanguage").show();
    		$("#mailcontent").hide();
    	}
    	$("#adscontact").trigger("click");
		getverifycode();    	
    };
    function getverifycode(){
       $('#verify').attr("src","/post/verify?"+Math.random()*10000);
    };
    
    function seturl(s){
    	var str=location.href;
    	//var n=str.indexOf("?");
    	//var t=str.substring(0,n+1); 
    	//alert(t);
    	$('.movie-box').click(function (e) { 
        	e.preventDefault();
        	}); 
    	
    	location.href=str +s;
   	};
    function IsMail(mail){
     var remail= /^([a-zA-Z0-9_-])+(\.)?([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/;
     return(remail.test(mail));
    };
    function checkform(){
    	var post = true; 
      if($("#verifycode").val().length!=5){
    	  	alert("驗證碼輸入錯誤!") 
    		$("#verifycode").focus(); 
    		post = false;
    	  }
      if($("#contact").val().length>255){
    	  	alert("聯繫方式字數過多!") 
    		$("#contact").focus(); 
    		post = false;
    	  }
      
      if(!IsMail($("#mail").val())){
    	alert("請輸入正確的電郵地址!") 
     	$("#mail").focus(); 
        post = false;
      }
      
      if($("#intention").val().length>25500){
    	  	alert("投放意向字數過多!") 
    		$("#intention").focus(); 
    		post = false;
    	  }
    	  
      if($("#trans").val().length>255){
    	  	alert("Too many words in your language textbox!") 
    		$("#intention").focus(); 
    		post = false;
    	  }	  
      if(post== true){
    	  $("#modalclose").trigger("click");
    	  $("#postform").attr("action", "/post/contact");
    	  $("#postform").submit();
    	}
      return post;
    };
</script>


<!-- Modal Forms -->
<div id="formModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button id="modalclose" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="contactModalLab">聯絡我們</h4>
            </div>
            <div class="modal-body">                     
                <form class="form-horizontal" name="postform" method="post" id="postform" enctype="multipart/form-data">
                    <fieldset>
                                                <div class="form-group" id="qqskype">
                            <label class="col-sm-4 control-label" for="contact">QQ / Skype</label>
                            <div class="col-sm-6">
                                <input id="contact" name="contact" type="text" placeholder="" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="mail">Email</label>
                            <div class="col-sm-6">
                                <input id="mail" name="mail" type="text" placeholder="" class="form-control">  
                            </div>
                        </div>
                        <div class="form-group" id="translanguage">
                            <label class="col-sm-4 control-label" for="trans">Your Language</label>
                            <div class="col-sm-6">
                                <input id="trans" name="trans" type="text" placeholder="" class="form-control">  
                            </div>
                        </div>
                        <div class="form-group" id="mailcontent">
                            <label class="col-sm-4 control-label" for="intention" id="inten-trans">內容</label>
                            <div class="col-sm-6">                     
                                <textarea id="intention" name="intention" rows="9" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="verify">驗證碼</label>
                            <div class="col-sm-6">                     
                                <input type="text" id="verifycode" name="verifycode" style="width:50px">
                                <img id="verify" src="https://www.javbus5.com/page/2" style="cursor: pointer; vertical-align:middle;" onclick="getverifycode()">
                            </div>
                        </div>
                        <input type="hidden" id="adstype" name="adstype" value="1">
                    </fieldset>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" button="" class="btn btn-primary" onclick="checkform()">送出</button>  
                <button type="button" button="" class="btn btn-default" data-dismiss="modal">關閉</button>
            </div>
        </div>
    </div>
</div>


<!-- ////////////////////////////////////////////////// -->
<div class="overlay overlay-contentscale">
    <div class="row">
        <div class="col-xs-12 text-center ptb20">
                 <div class="input-group col-xs-offset-2 col-xs-8">
                      <input id="search-input-mobile" type="text" class="form-control" placeholder="查询 车牌号 , 车名, 司机">
                      <span class="input-group-btn">
                      <button class="btn btn-default" type="submit" onclick="searchs('search-input-mobile');">搜尋</button>
                      </span>
                 </div>
        </div>             
        <div class="col-xs-6 text-center"><a href="https://www.javbus5.com/">有碼</a></div>
        <div class="col-xs-6 text-center"><a href="https://www.javbus5.com/uncensored">無碼</a></div>   
        <div class="col-xs-6 text-center"><a href="https://www.javbus5.com/genre">有碼類別</a></div>
        <div class="col-xs-6 text-center"><a href="https://www.javbus5.com/uncensored/genre">無碼類別</a></div>
        <div class="col-xs-6 text-center"><a href="https://www.javbus5.com/actresses">有碼女優</a></div>
        <div class="col-xs-6 text-center"><a href="https://www.javbus5.com/uncensored/actresses">無碼女優</a></div>
        <div class="col-xs-6 text-center"><a href="https://www.javbus.xyz/">歐美</a></div>
        <div class="col-xs-6 text-center"><a href="https://www.javbus5.com/forum/">論壇</a></div>            
    
       <div class="col-xs-12 text-center overlay-close">
          <i class="glyphicon glyphicon-remove"></i>
       </div>  
    </div>
</div>

 
<script src="<?php echo base_url() ?>resources/javbus/nav.overlay.js"></script>
<!-- Statistics START (aync) -->

<!-- 
<script type="text/javascript">var _Hasync= _Hasync|| [];
_Hasync.push(['Histats.start', '1,3517660,4,0,0,0,00010000']);
_Hasync.push(['Histats.fasi', '1']);
_Hasync.push(['Histats.track_hits', '']);
(function() {
var hs = document.createElement('script'); hs.type = 'text/javascript'; hs.async = true;
hs.src = ('//s10.histats.com/js15_as99.js');
(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(hs);
})();</script>


<script async="" type="text/javascript" src="<?php echo base_url() ?>resources/javbus/0.php"></script>
<script async="" src="<?php echo base_url() ?>resources/javbus/saved_resource(1)"></script>



Statistics END -->

<script async="" src="<?php echo base_url() ?>resources/javbus/auto.js"></script>
<script async="" src="<?php echo base_url() ?>resources/javbus/mask.js"></script>
</body></html>