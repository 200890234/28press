<?php error_reporting(E_ALL ^ E_NOTICE);?>
	<div class="wrapper-foot">
	<div id="footer" class="clearfix">
		<div class="footer-h h5px"></div>
		<div class="footer-info">
			<?
			$query=$db->query("Select * from {$web_dbtop}about Order by sort asc,id desc");
			while($rs=$db->fetch_array($query)){
				$title_a.="<A href=\"".$web_dir."about/about.php?id=".$rs["id"]."\" target=\"_blank\">".$rs["title"]."</A>&nbsp;&nbsp;|&nbsp;&nbsp;";
			}
			echo rtrim($title_a,"&nbsp;&nbsp;|&nbsp;&nbsp;");
			//这部分是后台网站信息编辑里面的文章列表
			?>
			<br /> 
			Copyright ? 2012-2013 28Press! All rights reserved.
			<!--51 la-->
			<script language="javascript" type="text/javascript" src="http://js.users.51.la/14908462.js"></script>
			<noscript><a href="http://www.51.la/?14908462" target="_blank"><img alt="&#x6211;&#x8981;&#x5566;&#x514D;&#x8D39;&#x7EDF;&#x8BA1;" src="http://img.users.51.la/14908462.asp" style="border:none" /></a></noscript>	
			<!--  51 la -->
			<!--百度-->
			<script type="text/javascript">
			//var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
			//document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F73aebbfdb266836a8b463439eac52a99' type='text/javascript'%3E%3C/script%3E"));			
			//_hmt.push(['_setCustomVar', index, name, value, opt_scope]);
			//_hmt.push(['_trackEvent', category, action, opt_label, opt_value]);
			</script>
			<!--百度-->
			
			<?=$web_statistics?><!--统计代码-->
		</div>
		<div class="footer-b h5px"></div>
	</div>
	</div>
	<!--Footer End-->
	<!--<div class="blank10"></div>-->

<?php
$db->close();
?>