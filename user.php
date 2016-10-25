<?php
include_once("inc/conn.php");
include_once("inc/function.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Member-<?=$web_name;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<meta name="keywords" content="<?=$web_keywords;?>" />
<meta name="description" content="<?=$web_description;?>" />
<META http-equiv=X-UA-Compatible content=IE=EmulateIE7>
<link href="style/default.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="inc/area.js"></script>
</head>
<?php include_once("top.php");?>
<DIV class="wrapper">
	<DIV class="page_content">
  		<!--主体右边 Start-->
    	<div class="area260 fl" style="float:left;">
			<DIV class="news-title">
				<span><a href="news_lest.php">More&raquo;</a></span>
				 <H3 style="color:white;font-size:15px;">Latest News</H3>
			</DIV>
			<ul class="area260-info news-list">
				<?
				$query=$db->query("Select * from {$web_dbtop}news Order by top desc,id desc limit 10");
				while($rs=$db->fetch_array($query)){
				?>
				<LI><A title="<?=$rs["title"]?>" href="news_content.php?id=<?=$rs["id"]?>"><?=$rs["title"]?></A></LI>
				<?
				}
				?>
			</ul>
			 <DIV class="area260-b h5px"></DIV>
			 <DIV class=blank10></DIV>
			 <DIV class="news-title">
				<span><a href="help_lest.php">More&raquo;</a></span>
				 <H3 style="color:white;font-size:15px;">Users Guide</H3>
			</DIV>
			<ul class="area260-info news-list">
				<?
				$query=$db->query("Select * from {$web_dbtop}help Order by top desc,id desc limit 10");
				while($rs=$db->fetch_array($query)){
				?>
				<LI><A title="<?=$rs["title"]?>" href="help_content.php?id=<?=$rs["id"]?>"><?=$rs["title"]?></A></LI>
				<?
				}
				?>
			</ul>
			 <DIV class="area260-b h5px"></DIV>
			 <DIV class=blank10></DIV>
		</div>
		<!--主体左边 Start-->
		<div class="area690 fr">
			<DIV class="users-title">
				 <H3>User Info</H3>
			</DIV>
        	<div class="users-content">
       		  <?
			$query=$db->query("Select id,name,points,maxexperience,vip,head,sex,job,bent,caption,address from {$web_dbtop}users where id=".intval($_GET["id"]));
			if($rs=$db->fetch_array($query)){
			?>
              <table width="100%" border="0" align="center" cellpadding="0" cellspacing="10">
                <tr>
                  <td width="226" valign="top"><table width="80%" border="0" align="center" cellpadding="3" cellspacing="9">
                      <tr>
                        <td align="center"><img src="<?=$rs["head"]?>" onerror="this.src='images/head/0_0.jpg'" width="150" height="150" /></td>
                      </tr>
                      <tr>
                        <td align="center">AccountID：<span style="color:#C8F14D;font-weight:700"><?=$rs["id"]?></span> <?//=($rs["vip"]==1?"<img src=\"images/vip.gif\" />":"")?></td>
                      </tr>
                      <tr>
                        <td align="center"><a href="usersms.php?act=addSms&smsReceiver=<?=$rs["id"]?>"><img src="images/mpnew_21.gif" width="140" height="29" border="0" /></a></td>
                      </tr>
                      <tr>
                        <td align="center"><a href="prizes_rank_u.php?id=<?=$rs["id"]?>"><img src="images/mpnew_24.gif" width="140" height="29" border="0" /></a></td>
                      </tr>
                  </table></td>
                  <td valign="top">
				  <table width="460" border="0" align="center" cellpadding="0" cellspacing="0" style="font-size:14px;">
                      <tr>
                        <td width="15" height="40">&nbsp;</td>
                        <td width="80" align="right">Nickname：</td>
                        <td style="color:#f60;font-weight:700"><?=$rs["name"]?></td>
                      </tr>
                      <tr>
                        <td height="40">&nbsp;</td>
                        <td align="right">Gender：</td>
                        <td style="color:#f60"><?=($rs["sex"]==1?"Female":"Male")?></td>
                      </tr>
                      <tr>
                        <td height="40">&nbsp;</td>
                        <td align="right">Total <?=$web_moneyname?>：</td>
                        <td style="color:#f60;font-weight:700;"><?=number_format($rs["points"])?></td>
                      </tr>
                      <!--<tr>
                        <td height="30">&nbsp;</td>
                        <td>等　　级：</td>
                        <td><? //showstars(userslive($rs["maxexperience"]));?> (<?//=userslive($rs["maxexperience"])?>级)</td>
                      </tr>
					  
                      <tr>
                        <td height="30">&nbsp;</td>
                        <td>所在城市：</td>
                        <td><? //$address=explode("-",$rs["address"])?> <script>document.write(arrProvince[<?//=$address[0]?>]+'-'+arrCity[<?//=$address[0]?>][<?//=$address[1]?>]);</script> - <?//=$address[2]?></td>
                      </tr>
                      <tr>
                        <td height="30">&nbsp;</td>
                        <td>职　　业：</td>
                        <td><?//=$rs["job"]?></td>
                      </tr>
                      <tr>
                        <td height="30">&nbsp;</td>
                        <td>兴趣爱好：</td>
                        <td><?//=$rs["bent"]?></td>
                      </tr>
					  -->
                      <tr>
                        <td height="40">&nbsp;</td>
                        <td align="right">Introduction：</td>
                        <td style="color:#f60;"><?=$rs["caption"]?></td>
                      </tr>
                  </table></td>
                </tr>
              </table>
              <?
			}
			?>
        	</div>
			<div class="area690-b h5px"></div>
        	<div class="blank10"></div>
		</div>
		<!--主体左边 End-->
	</DIV>
	<!--Flink End-->
	<div class="blank10"></div>
	<!--Footer Start-->
<?php include_once("footer.php");?>
</DIV>