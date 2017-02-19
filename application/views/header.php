
<script src="<?php echo base_url() ?>resources/javbus/StackBlur.js"></script>
<nav class="navbar navbar-default navbar-fixed-top top-bar">
      <div class="container">
        <div class="navbar-header">
        	<a href="https://avmo.pwfk/cn" class="logo"></a>
            <div class="btn-group pull-right visible-xs-inline" role="group" style="margin-top:8px;margin-right:8px;">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                  <span class="glyphicon glyphicon-globe"></span> 简体中文                  <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="https://avmo.pwfk/en/movie/5mf2">English</a></li>
                    <li><a href="https://avmo.pwfk/ja/movie/5mf2">日本语</a></li>
                    <li><a href="https://avmo.pwfk/tw/movie/5mf2">正體中文</a></li>
                    <li><a href="https://avmo.pwfk/cn/movie/5mf2">简体中文</a></li>
                </ul>
            </div>
        </div>

        <div id="navbar" class="collapse navbar-collapse">
          <form class="navbar-form navbar-left fullsearch-form" action="https://avmo.pwfk/cn/search" onsubmit="return false">
            <div class="input-group">
              <input name="keyword" type="text" class="form-control" placeholder="搜寻 识别码, 影片, 演员">
              <span class="input-group-btn">
                <button class="btn btn-default" type="submit">搜寻</button>
              </span>
            </div>
          </form>
          <ul class="nav navbar-nav">
            <li><a href="<?php echo base_url() ?>index.php/welcome/homeonline/">全部</a></li>
			<li><a href="https://avmo.pwfk/cn/released">已发布</a></li>
			<li><a href="https://avmo.pwfk/cn/popular">热门</a></li>
            <li><a href="https://avmo.pwfk/cn/actresses">女优</a></li>
            <li><a href="<?php echo base_url() ?>index.php/welcome/genretm/">类别</a></li>
          </ul>
         <!-- <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a href="https://avmo.pwfk/cn/movie/5mf2#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-globe" style="font-size:12px;"></span> <span class="hidden-sm">简体中文</span> <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="https://avmo.pwfk/en/movie/5mf2">English</a></li>
                <li><a href="https://avmo.pwfk/ja/movie/5mf2">日本语</a></li>
                <li><a href="https://avmo.pwfk/tw/movie/5mf2">正體中文</a></li>
                <li><a href="https://avmo.pwfk/cn/movie/5mf2">简体中文</a></li>
              </ul>
            </li>
          </ul> -->
        </div><!--/.nav-collapse -->
      </div>
    </nav>