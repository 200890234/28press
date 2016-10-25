<?php error_reporting(E_ALL ^ E_NOTICE);?>
<!--分享到-->
<!-- AddThis Button BEGIN -->
<!--
<style type="text/css">
.addthis_floating_style{background:green;}
.atm-i{background:#FEFEFE;}
</style>
<div class="addthis_toolbox addthis_floating_style addthis_32x32_style" style="left:0px;top:150px;">
<a class="addthis_button_preferred_1"></a>
<a class="addthis_button_preferred_2"></a>
<a class="addthis_button_preferred_3"></a>
<a class="addthis_button_preferred_4"></a>
<a class="addthis_button_compact"></a>
</div>
<script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-512725a93e8ba1a1"></script>
-->
<!-- AddThis Button END -->
<!--分享到-->
<div class="wrapper-head" style="width:100%;">
<div id="head">
	<div class="logo">
	<a href="<?=$web_dir?>" title="<?=$web_name?>" target="_self"><img src="<?=$web_dir?><?=$web_logo?>" alt="<?=$web_name?>" border="0" /></a>
	</div>
	<!--<div style="float:left;margin:27px auto auto 30px;color:#50C102;font-size:40px;font-weight:600;">Time</div>-->
	<div style="float:left;margin:20px 50px;"><!--网页时钟-->
		<!--<script src="inc/embed.js"></script><script type="text/javascript" language="JavaScript">obj=new Object;obj.clockfile="5005-green.swf";obj.TimeZone="GMT-0500";obj.width=120;obj.height=40;obj.wmode="transparent";showClock(obj);</script>-->
		<!--flash版-->
		<!--
		<embed src="http://www.clocklink.com/clocks/5005-green.swf?TimeZone=GMT-0500&"  width="120" height="40" wmode="transparent" type="application/x-shockwave-flash">
		-->
		<!--夏令时-->
		<script src="http://www.clocklink.com/embed.js"></script><script type="text/javascript" language="JavaScript">obj=new Object;obj.clockfile="5005-green.swf";obj.TimeZone="EST";obj.width=120;obj.height=40;obj.wmode="transparent";showClock(obj);</script>
	</div>
	<div class="top">
		<div class="default">
			<div class="left"></div>
			<div class="right">
				<p><a href="<?=$web_dir?>deposit.php">Deposit</a>&nbsp;&nbsp; <a href="<?=$web_dir?>game.php">Start Press</a>&nbsp;&nbsp; <a href="<?=$web_dir?>help_lest.php">User Guide</a>&nbsp;&nbsp; <a href="#" onclick="this.style.behavior='url(#default#homepage)';this.setHomePage('<?=$web_url?>');" onmouseout="window.status='<?=$web_name?>';return true;" onmouseover="window.status='<?=$web_name?>';return true;">Set Homepage</a>&nbsp;&nbsp;<a href="mailto:service.28press@gmail.com">Contact Us</a>&nbsp;&nbsp;</p>
			</div>
		</div>
		<div class="cl">
			<p class="topp"><?php
		  $query=$db->query("Select * From {$web_dbtop}users where id=".intval($_COOKIE["usersid"])." and password='".str_check($_COOKIE["password"])."'");
		  if($rs=$db->fetch_array($query)){
		  	echo"<strong>Account</strong>: <a href=\"".$web_dir."useraccount.php\"><font class=rf><strong>".$rs["id"]."</strong></font></a>&nbsp;&nbsp; <strong>Balance：</strong><font class=rf>".number_format($rs["points"])."</font></a> ".$web_moneyname."&nbsp;&nbsp; <A href=\"".$web_dir."usersms.php\"><SPAN ".(msg_num(0)!=0?"class=rf":"").">Message(".msg_num(0).")</SPAN></A>&nbsp;&nbsp; <a href=\"".$web_dir."login.php?act=logout\">Logout</a>";
		  }else{
		  	echo"Welcome Guest please <A href=\"".$web_dir."login.php\"><SPAN class=rf>login</SPAN></A> or <A href=\"".$web_dir."reg.php\"><SPAN class=rf>register</SPAN></A>";
		  }
		  ?></p>
		</div>
	</div>
</div>
</div>
<div class="wrapper-menu" style="background:#429617;width:960px;margin:auto;margin-top:10px;border-radius: 10px;">
<div id=menu_out>
	<div id=menu_in>
		<div id=menu>
			<UL id=nav>
				<LI><A class=nav_on id=mynav0 href="<?=$web_dir?>index.php"><SPAN>HOME</SPAN></A></LI>
				<LI class="menu_line"></LI><li><a href="<?=$web_dir?>about.php" id="mynav1" class="nav_off"><span>About 28press</span></a></li>
				<li class="menu_line"></li><li><a href="<?=$web_dir?>game.php" id="mynav2" class="nav_off"><span>Games Center</span></a></li>
				<li class="menu_line"></li><li><a href="<?=$web_dir?>userrecom.php" id="mynav3" class="nav_off"><span>Invite Friends</span></a></li>
				<li class="menu_line"></li><li><a href="<?=$web_dir?>prizes.php" id="mynav4" class="nav_off"><span>Withdraw</span></a></li>
				<li class="menu_line"></li><li><a href="<?=$web_dir?>activities.php" id="mynav5" class="nav_off"></a></li>
				<li style="display:none;"><a href="<?=$web_dir?>prop.php" id="mynav6" class="nav_off"></a></li>
				<li class="menu_line"></li><li><a href="<?=$web_dir?>useraccount.php" id="mynav7" class="nav_off"><span>Member Area</span></a></li>
				<li class="menu_line"></li><LI><A class=nav_off id=mynav8 href="<?=$web_dir?>bbs/index.php"><SPAN>Forum</SPAN></A></LI>
				<LI class="menu_line"></li><li><A href="<?=$web_dir?>deposit.php" id="mynav9" class="nav_off"><SPAN>Deposit</SPAN></A></LI>
			</UL>
			<div id=menu_con>
				<div id=qh_con0 style="DISPLAY: block">
					<UL>
					  <LI style="color:#93C938;"><span style="float:left;">Welcome to 28press <?//=$web_name?></span><span style="float:left;font-size:14px;"><a href="luck.php"><!--Press it now--></a></span></LI>
					</UL>
				</div> 
				<div id=qh_con1 style="DISPLAY: none">
					<UL>
					
					</UL>
					
				</div> 
				<div id=qh_con2 style="DISPLAY: none">
					<UL>
					  <LI><a href="<?=$web_dir?>luck.php"><span>Luck28</span></A></LI><LI class=menu_line2></LI>
					  <LI><A href="<?=$web_dir?>happy.php"><SPAN>Luck16</SPAN></A></LI><LI class=menu_line2></LI>
					  <!--<LI><A href="<?=$web_dir?>joyous.php"><SPAN>Luck11</SPAN></A></LI><LI class=menu_line2></LI>-->
					  <!--<LI><A href="<?=$web_dir?>dodge.php"><SPAN>猜拳</SPAN></A></LI><LI class=menu_line2></LI>
					  <LI><A href="<?=$web_dir?>box.php"><SPAN>开宝箱</SPAN></A></LI><LI class=menu_line2></LI>-->
					</UL>
				</div> 
				<div id=qh_con3 style="DISPLAY: none">
					<UL>
					  <LI><a href="<?=$web_dir?>usertg.php"><span>My Invited Friends</span></A></LI><LI class=menu_line2></LI>
					  <LI><A href="<?=$web_dir?>usertgsy.php"><SPAN>Promotional Revenue</SPAN></A></LI><LI class=menu_line2></LI>
					  <LI><A href="<?=$web_dir?>userrecom.php"><SPAN>Referrer Link</SPAN></A></LI>
					</UL>
				</div> 
				<div id=qh_con4 style="DISPLAY: none">
					<UL>
					  <LI><a href="<?=$web_dir?>prizes.php"><span>Prizes List</span></A></LI><LI class=menu_line2></LI>
					  <LI><a href="<?=$web_dir?>prizes_rank_u.php"><span>Withdraw List</span></A></LI><LI class=menu_line2></LI>
					  <LI><A href="<?=$web_dir?>prizes_rank.php"><SPAN>Withdraw Ranking</SPAN></A></LI><LI class=menu_line2></LI>
					  <LI><A href="<?=$web_dir?>userprizes.php"><SPAN>My Withdrawal</SPAN></A></LI>
					</UL>
				</div>
				<div id=qh_con5 style="DISPLAY: none">
					<UL>
					  <LI></LI>
					</UL>
				</div>
				<div id=qh_con6 style="DISPLAY: none">
					<UL>
					  <LI><a href="<?=$web_dir?>prop.php"><span>道具中心</span></A></LI><LI class=menu_line2></LI>
					  <LI><A href="<?=$web_dir?>card.php"><SPAN>道具使用</SPAN></A></LI><LI class=menu_line2></LI>
					  <LI><A href="<?=$web_dir?>card.php?act=use"><SPAN>种豆领取</SPAN></A></LI>
					</UL>
				</div>
				<div id=qh_con7 style="DISPLAY: none">
					<UL>
					  <LI><a href="<?=$web_dir?>usersms.php"><span>Messages</span></A></LI><LI class=menu_line2></LI>
					  <LI style="width:0px;overflow:hidden;margin:0;padding:0;"><a href="<?=$web_dir?>useraccess.php"><span><!--存取My Bank--><?//=$web_moneyname?></span></A></LI><LI class=menu_line2></LI>
					  <LI><a href="<?=$web_dir?>useraccount.php"><span>Account Info</span></A></LI><LI class=menu_line2></LI>
					  <LI><a href="<?=$web_dir?>userprizes.php"><span>My withdrawal</span></A></LI><LI class=menu_line2></LI>
					  <LI><a href="<?=$web_dir?>userinfo.php"><span>Edit Profile</span></A></LI><LI class=menu_line2></LI>
					  <LI><A href="<?=$web_dir?>userpwd.php"><SPAN>Change Password</SPAN></A></LI><LI class=menu_line2></LI>
					  <!--<LI><A href="<?=$web_dir?>uservalid.php"><SPAN>身份验证</SPAN></A></LI>-->
					</UL>
				</div>
				<div id=qh_con8 style="DISPLAY: none">
					<UL>
					<?
					$query=$db->query("Select * from {$web_dbtop}bbs_section Order by sort asc");
					while($rs=$db->fetch_array($query)){
						echo "<LI id=\"bbs_".$rs["id"]."\"><a href=\"".$web_dir."bbs/forum.php?forumsid=".$rs["id"]."\"><span>".$rs["name"]."</span></a></LI><LI class=menu_line2></LI>";
					}
					?>
					</UL>
				</div>
				<div id=qh_con9 style="DISPLAY: none">
					<UL>
					  <LI></LI>
					</UL>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<script language="javascript">
	function qiehuan(num){
		for(var id = 0;id<=9;id++)
		{
			if(id==num)
			{
				document.getElementById("qh_con"+id).style.display="block";
				document.getElementById("mynav"+id).className="nav_on";
			}
			else
			{
				document.getElementById("qh_con"+id).style.display="none";
				document.getElementById("mynav"+id).className="";
			}
		}
	}
</script>
<DIV class=blank10></DIV>