<?php
include_once("inc/conn.php");
include_once("inc/function.php");

$query=$db->query("Select id,kgtime from {$web_dbtop}game28 where kj=0 Order by id asc");
if($rs=$db->fetch_array($query)){
	$kgqh=$rs["id"];
	$kgtime=DateDiff($rs["kgtime"],date("Y-m-d H:i:s"),"s")+25;	//开奖时间比数据库里取出来的延迟25秒？？
	
}

$query=$db->query("Select gfid,kgjg,kgwh from {$web_dbtop}game28 where kj=1 Order by id desc");
if($rs=$db->fetch_array($query)){
	$gfid=$rs["gfid"];
	$kgwh=$rs["kgwh"];
	$kgjg=explode("|",$rs["kgjg"]);
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>luck28-game center-<?=$web_name;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<meta name="keywords" content="<?=$web_keywords;?>" />
<meta name="description" content="<?=$web_description;?>" />
<META http-equiv=X-UA-Compatible content=IE=EmulateIE7>
<link href="style/default.css" rel="stylesheet" type="text/css" />
</head>
<?php include_once("top.php");?>
<script language="javascript">
qiehuan(2);
document.getElementById("qh_con2").getElementsByTagName('li')[0].className="current";
</script>
<DIV class="wrapper">
	<DIV class="page_content">
		<DIV class="webgame-info-title">
		  <UL>
			<LI class="current"><A href="luck.php">Luck28 home</A></LI>
			<LI><A href="luckhelp.php">Luck28 guide</A></LI>
			<LI><A href="luckmylist.php">My press history</A></LI>
			<LI><A href="luckmodel.php">Edit press pattern</A></LI>
			<LI><A href="luckautoset.php">Autopress</A></LI>
			<LI><A href="luckdirection.php">Trend chart</A></LI>
		  </UL>
		</DIV>
		<DIV class="webgame-info">
			<DIV class="webgame-info-tabs">
			  <table width="100%" border="0" cellspacing="2" cellpadding="2">
                <tr>
				  <td width="100" align="center">&nbsp;</td>
                  <td align="center" height="28"><span id="fSound"></span><font id="fLuck" style="font-weight:bold;font-size:14px;color:#FF6633;"></font></td>
				  <td width="100"><!--<a href="bbs/forum.php?forumsid=3" target="_blank"><img src="images/bbs_jl.gif" border="0" /></a>--></td>
                </tr>
              </table>
				
					<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                          <tr>
                            <td bgcolor="#248301"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="1">
                                <tr>
                                  <td width="68" height="28" align="center" background="images/310-bj.jpg" bgcolor="#FFFFFF" class="wf">Draw</td>
                                  <td width="100" height="28" align="center" background="images/310-bj.jpg" bgcolor="#FFFFFF" class="wf">Time</td>
                                  <td width="134" align="center" background="images/310-bj.jpg" bgcolor="#FFFFFF" class="wf">Winning number</td>
                                  <td width="72" align="center" background="images/310-bj.jpg" bgcolor="#FFFFFF" class="wf">Pressed</td>
                                  <td width="127" align="center" background="images/310-bj.jpg" bgcolor="#FFFFFF" class="wf"><?//=$web_moneyname?>Total</td>
                                  <td width="85" align="center" background="images/310-bj.jpg" bgcolor="#FFFFFF" class="wf">Winners</td>
                                  <td width="118" align="center" background="images/310-bj.jpg" bgcolor="#FFFFFF" class="wf">Pressed/Gained</td>
                                  <td width="70" align="center" background="images/310-bj.jpg" bgcolor="#FFFFFF" class="wf">Operation</td>
                                </tr>
                <?php
				$i=0;
				$intpage = 20;
				if (isset($_GET['page'])) {
					$rsnum = (intval($_GET['page']) -1)*$intpage;
				}
				else {
					$rsnum = 0;
				}
				$sql="Select * from {$web_dbtop}game28 Order by id desc";
				$query=$db->query($sql);
				if($db->fetch_array($query)) 
				$intnum=$db->num_rows($query);
				$query=$db->query($sql." limit $rsnum,$intpage");
				while($rs=$db->fetch_array($query)){
				//print_r($rs);
					$kgh=explode("|",$rs["kgjg"]);
					$hdpoints=0;
					$sumnumtzpoints=0;
					if($rs["kj"]!=1){
						$query_f=$db->query("Select sum(tzpoints) as points,sum(hdpoints) as hdpoints from {$web_dbtop}game28_kg_users_tz where NO=".$rs["id"]." and uid=".intval($_COOKIE["usersid"])." Order by id desc");
					}else{
						$query_f=$db->query("Select points,hdpoints from {$web_dbtop}game28_users_tz where NO=".$rs["id"]." and uid=".intval($_COOKIE["usersid"])." Order by id desc");
					}
					if($rs_f=$db->fetch_array($query_f)){
						$sumnumtzpoints=$rs_f["points"];
						$hdpoints=$rs_f["hdpoints"];
					}
				$bgcolor=($i%2==0?"#E6F7E5":"#ECECEC");
				?>
                                <tr>
                                  <td height="32" align="center" bgcolor="#E6F7E0" class="font12game"><?=$rs["id"];?></td>
                                  <td align="center" bgcolor="<?=$bgcolor;?>" class="font12game"><?=date("M d H:i",strtotime($rs["kgtime"]));?>
								  <?php
									 /* $gm_date   = strtotime(gmdate('Y-m-d H:i:s')); //获取格林威治标准时间
									  $date   = strtotime(date('Y-m-d H:i:s')); //获取本地时间   
									  $zone_diff = ($date - $gm_date) / 3600; //获取本地时间与标准时间之间的时差
									  echo gmdate('Y-m-d H:i:s', strtotime($rs['kgtime']) + 3600 * $zone_diff);//在标准时间上加上时差数乖以每小时秒数就可以在不同地区显示不同地区的时间  */
								  ?>
								  
								  </td>
                                  <td align="center" bgcolor="<?=$bgcolor;?>" class="font12game"><?
					if($rs["kgjg"]){
					?>
                                      <?=substr($kgh[0],-1);?> + <?=substr($kgh[1],-1);?> + <?=substr($kgh[2],-1);?>＝<img align="absmiddle" src="images/luck/number_<?=$kgh[3];?>.gif" />
                                      <?
					 }else{
					 	echo"-";
					 }
					 ?>
                                  </td>
                                  <td align="center" bgcolor="<?=$bgcolor;?>" class="font12game"><?=$rs["tznum"];?></td>
                                  <td align="center" bgcolor="<?=$bgcolor;?>" class="font12game"><?=number_format($rs["tzpoints"]);?></td>
                                  <td align="center" bgcolor="<?=$bgcolor;?>" class="font12game"><? if($rs["kj"]==1){ echo"<a href=\"luckwinlist.php?luckno=".$rs["id"]."\" class=\"b\">".$rs["zjrnum"]."</a>";}else{echo"-";}?></td>
                                  <td align="center" bgcolor="<?=$bgcolor;?>" class="font12game"><? 
					if($rs["kj"]==1){
						if($sumnumtzpoints) {
							echo "<a href=\"luckmydetail.php?luckno=".$rs["id"]."\"><font color=\"".($sumnumtzpoints>$hdpoints?"#FF0000":"#006600")."\">".number_format($sumnumtzpoints)." / ".number_format($hdpoints)."</font></a>";
						}else{
							echo "0 / 0";
						}
					}else{
						if($sumnumtzpoints){
							echo"<a href=\"luckmydetail.php?luckno=".$rs["id"]."\"><font color=\"#FF0000\">".number_format($sumnumtzpoints)." / 0</font>";
						}else{
							echo "0 / 0";
						}
					}
					?></td>
                                  <td align="center" bgcolor="<?=$bgcolor;?>">
								  <? if($rs["kj"]==0 && $rs["iscancel"]!="yes"){ 
									echo"<a href=\"luckinsert.php?luckno=".$rs["id"]."\" class=\"b\">PRESS</a>";
								  }else if($rs["kj"]==0 && $rs["iscancel"]=="yes"){
									echo "<span style='color:gray;'>canceled</span>";
								  }else if($rs["kj"]==1 && $rs["iscancel"]=="yes"){
									echo "<span style='color:gray;'>canceled</span>";
								  }else{
									echo"<a href=\"luckmyinsert.php?luckno=".$rs["id"]."\"><span style='color:green;'>completed</span></a>";
								  }?>
								  </td>
                                </tr>
                <?
				$i++;
				}
				?>
                            </table></td>
                          </tr>
              </table>
						<table width="100%" border="0" align="center" cellpadding="2" cellspacing="4">
                          <tr>
                            <td align="center"><?php
		  include_once("inc/page_class.php");
		  $page=new page(array('total'=>$intnum,'perpage'=>$intpage));
		  echo $page->show(5,"","");?></td>
                          </tr>
              </table>
						<script type="text/javascript">
						<!--
						var luckno = "<?=$kgqh;?>";
						if(readCookie('cSound')=='1'){
							imgSound = '<img src="images/sound1.gif" onclick="setSound(this,0)" align="absmiddle" style="cursor:pointer" title="turn off alarm">';
						}
						else{
							imgSound = '<img src="images/sound0.gif" onclick="setSound(this,1)" align="absmiddle" style="cursor:pointer" title="turn on alarm">';
						}
						document.getElementById("fSound").innerHTML = imgSound;
						function ShowSecond(cDate){
							if(luckno != ""){
								if(cDate > 1){
									document.getElementById("fLuck").innerHTML = (--cDate)+" seconds left for draw #"+luckno;
									setTimeout("ShowSecond("+cDate+")",1000);
								}
								else{
									wavSound = '';
									if(readCookie('cSound')=='1'){
										wavSound = '<embed src="images/sound/security.wav" autostart=true hidden=true loop=false>';
									}
									document.getElementById("fLuck").innerHTML = "please refresh to view the winning number of draw# "+luckno+wavSound;
								}
							}
						}
						ShowSecond(parseInt("<?=$kgtime;?>"));
						function setSound(obj,v){
							if(v=='1'){
								obj.src='images/sound1.gif';
								obj.title='turn off alarm';
								obj.onclick=function (){setSound(this,0);}
							}
							else{
								obj.src='images/sound0.gif';
								obj.title='turn on alarm';
								obj.onclick=function (){setSound(this,1);}
							}
							setCookie('cSound',v);
						}
						function setCookie(cookieName,cookieValue){
							var date = new Date();
							date.setTime(date.getTime() + 24*60*60*1000000);
							document.cookie = cookieName + "=" + cookieValue + ";expires=" + date.toGMTString() + ";path=/";
						}
						function readCookie(cookieName){
							var aCookie = document.cookie.split("; ");
							for (var i=0; i < aCookie.length; i++){
							var aCrumb = aCookie[i].split("=");
							if(cookieName == aCrumb[0])
								return unescape(aCrumb[1]);
							}
							return null;
						}
						-->
						</script>
		  </DIV>
		  <DIV class=cl></DIV>
		</DIV>
		<DIV class="area960-b h5px"></DIV>
	<!--Flink End-->
	<div class="blank10"></div>
	<!--Footer Start-->
<?php include_once("footer.php");?>
</DIV>