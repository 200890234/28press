<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/

include_once( "inc/conn.php" );
include_once( "inc/function.php" );
$query = $db->query( "Select id,kgtime from ".$web_dbtop."game28 where kj=0 Order by id asc" );
if ( $rs = $db->fetch_array( $query ) )
{
		$kgqh = $rs['id'];
		$kgtime = datediff( $rs['kgtime'], date( "Y-m-d H:i:s" ), "s" ) + 25;
}
$query = $db->query( "Select id,gfid,kgjg from ".$web_dbtop."game28 where kj=1 Order by id desc" );
if ( $rs = $db->fetch_array( $query ) )
{
		$kjid = $rs['id'];
		$gfid = $rs['gfid'];
		$kgjg = explode( "|", $rs['kgjg'] );
}
echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd\">\r\n<HTML xmlns=\"http://www.w3.org/1999/xhtml\">\r\n<head>\r\n<title>幸运28-游戏中心-";
echo $web_name;
echo "</title>\r\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=gb2312\" />\r\n<meta name=\"keywords\" content=\"";
echo $web_keywords;
echo "\" />\r\n<meta name=\"description\" content=\"";
echo $web_description;
echo "\" />\r\n<META http-equiv=X-UA-Compatible content=IE=EmulateIE7>\r\n<link href=\"style/default.css\" rel=\"stylesheet\" type=\"text/css\" />\r\n</head>\r\n";
include_once( "top.php" );
echo "<script language=\"javascript\">\r\nqiehuan(2);\r\ndocument.getElementById(\"qh_con2\").getElementsByTagName('li')[0].className=\"current\";\r\n</script>\r\n<DIV class=\"wrapper\">\r\n\t<DIV class=\"page_content\">\r\n\t\t<DIV class=\"webgame-info-title\">\r\n\t\t  <UL>\r\n\t\t\t<LI class=\"current\"><A href=\"luck.php\">幸运28首页</A></LI>\r\n\t\t\t<LI><A href=\"luckhelp.php\">幸运28规则</A></LI>\r\n\t\t\t<LI><A href=\"luckmylist.php\">我的投注记录</A></LI>\r\n\t\t\t<LI><A href=\"luckmodel.php\">投注模式编辑</A></LI>\r\n\t\t\t<LI><A href=\"luckautoset.php\">自动投注</A></LI>\r\n\t\t\t<LI><A href=\"luckdirection.php\">幸运28走势图</A></LI>\r\n\t\t  </UL>\r\n\t\t</DIV>\r\n\t\t<DIV class=\"webgame-info\">\r\n\t\t\t<DIV class=\"webgame-info-tabs\">\r\n\t\t\t  <table width=\"100%\" border=\"0\" cellspacing=\"2\" cellpadding=\"2\">\r\n                <tr>\r\n                  <td colspan=\"2\" align=\"center\"><span id=\"fSound\"></span><font id=\"fLuck\" style=\"font-size:14px;color:#FF0000;font-weight:bold;\"></font></td>\r\n                </tr>\r\n              </table>\r\n\r\n\t\t\t\t\t<table width=\"940\" border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"2\">\r\n                      <tr>\r\n                        <td width=\"100\">&nbsp;</td>\r\n                        <td align=\"center\">";
if ( $gfid )
{
		echo "<a href=\"threedata.php?id=";
		echo $kjid;
		echo "\" target=\"_blank\" class=\"rf\">第三方";
		echo $gfid;
		echo "期 查看详细开奖数据</a>&nbsp;&nbsp;";
}
else
{
		echo "本地数据";
}
echo "&nbsp;&nbsp;一区值：<font style='color:#FF0000;font-weight:bold;font-size:14px'>";
echo $kgjg[0];
echo "</font>\r\n                  　二区值：<font style='color:#FF0000;font-weight:bold;font-size:14px'>";
echo $kgjg[1];
echo "</font>\r\n                　三区值：<font style='color:#FF0000;font-weight:bold;font-size:14px'>";
echo $kgjg[2];
echo "</font></td>\r\n                        <td width=\"120\"><a href=\"bbs/forum.php?forumsid=3\" target=\"_blank\"><img src=\"images/bbs_jl.gif\" border=\"0\" /></a></td>\r\n                      </tr>\r\n                    </table>\r\n\t\t\t\t\t<table width=\"940\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\r\n                          <tr>\r\n                            <td bgcolor=\"#248301\"><table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"1\">\r\n                                <tr>\r\n                                  <td width=\"68\" height=\"28\" align=\"center\" background=\"images/310-bj.jpg\" bgcolor=\"#FFFFFF\" class=\"wf\">期号</td>\r\n                                  <td width=\"123\" height=\"28\" align=\"center\" background=\"images/310-bj.jpg\" bgcolor=\"#FFFFFF\" class=\"wf\">开奖时间</td>\r\n                                  <td width=\"134\" align=\"center\" background=\"images/310-bj.jpg\" bgcolor=\"#FFFFFF\" class=\"wf\">开奖结果</td>\r\n                                  <td width=\"72\" align=\"center\" background=\"images/310-bj.jpg\" bgcolor=\"#FFFFFF\" class=\"wf\">已投注数</td>\r\n                                  <td width=\"127\" align=\"center\" background=\"images/310-bj.jpg\" bgcolor=\"#FFFFFF\" class=\"wf\">";
echo $web_moneyname;
echo "总数</td>\r\n                                  <td width=\"85\" align=\"center\" background=\"images/310-bj.jpg\" bgcolor=\"#FFFFFF\" class=\"wf\">中奖人数</td>\r\n                                  <td width=\"118\" align=\"center\" background=\"images/310-bj.jpg\" bgcolor=\"#FFFFFF\" class=\"wf\">投注额/中奖额</td>\r\n                                  <td width=\"70\" align=\"center\" background=\"images/310-bj.jpg\" bgcolor=\"#FFFFFF\" class=\"wf\">参与</td>\r\n                                </tr>\r\n                ";
$i = 0;
$intpage = 30;
if ( isset( $_GET['page'] ) )
{
		$rsnum = ( intval( $_GET['page'] ) - 1 ) * $intpage;
}
else
{
		$rsnum = 0;
}
$sql = "Select * from ".$web_dbtop."game28 Order by id desc";
$query = $db->query( $sql );
if ( $db->fetch_array( $query ) )
{
		$intnum = $db->num_rows( $query );
}
$query = $db->query( $sql.( " limit ".$rsnum.",{$intpage}" ) );
while ( $rs = $db->fetch_array( $query ) )
{
		$kgh = explode( "|", $rs['kgjg'] );
		$hdpoints = 0;
		$sumnumtzpoints = 0;
		if ( $rs['kj'] != 1 )
		{
				$query_f = $db->query( "Select sum(tzpoints) as points,sum(hdpoints) as hdpoints from ".$web_dbtop."game28_kg_users_tz where NO=".$rs['id']." and uid=".intval( $_COOKIE['usersid'] )." Order by id desc" );
		}
		else
		{
				$query_f = $db->query( "Select points,hdpoints from ".$web_dbtop."game28_users_tz where NO=".$rs['id']." and uid=".intval( $_COOKIE['usersid'] )." Order by id desc" );
		}
		if ( $rs_f = $db->fetch_array( $query_f ) )
		{
				$sumnumtzpoints = $rs_f['points'];
				$hdpoints = $rs_f['hdpoints'];
		}
		$bgcolor = $i % 2 == 0 ? "#FFFFFF" : "#F8F8F8";
		echo "                                <tr>\r\n                                  <td height=\"32\" align=\"center\" bgcolor=\"#E6F7E0\" class=\"font12game\">";
		echo $rs['id'];
		echo "</td>\r\n                                  <td align=\"center\" bgcolor=\"";
		echo $bgcolor;
		echo "\" class=\"font12game\">";
		echo date( "m-d H:i", strtotime( $rs['kgtime'] ) );
		echo "</td>\r\n                                  <td align=\"center\" bgcolor=\"";
		echo $bgcolor;
		echo "\" class=\"font12game\">";
		if ( $rs['kgjg'] )
		{
				echo "                                      ";
				echo $kgh[0];
				echo " + ";
				echo $kgh[1];
				echo " + ";
				echo $kgh[2];
				echo "＝<img align=\"absmiddle\" src=\"images/luck/number_";
				echo $kgh[3];
				echo ".gif\" />\r\n                                      ";
		}
		else
		{
				echo "-";
		}
		echo "                                  </td>\r\n                                  <td align=\"center\" bgcolor=\"";
		echo $bgcolor;
		echo "\" class=\"font12game\">";
		echo $rs['tznum'];
		echo "</td>\r\n                                  <td align=\"center\" bgcolor=\"";
		echo $bgcolor;
		echo "\" class=\"font12game\">";
		echo number_format( $rs['tzpoints'] );
		echo "<img src=\"";
		echo $web_moneypic;
		echo "\" align=\"absmiddle\" /></td>\r\n                                  <td align=\"center\" bgcolor=\"";
		echo $bgcolor;
		echo "\" class=\"font12game\">";
		if ( $rs['kj'] == 1 )
		{
				echo "<a href=\"luckwinlist.php?luckno=".$rs['id']."\" class=\"b\">".$rs['zjrnum']."</a>";
		}
		else
		{
				echo "-";
		}
		echo "</td>\r\n                                  <td align=\"center\" bgcolor=\"";
		echo $bgcolor;
		echo "\" class=\"font12game\">";
		if ( $rs['kj'] == 1 )
		{
				if ( $sumnumtzpoints )
				{
						echo "<a href=\"luckmydetail.php?luckno=".$rs['id']."\"><font color=\"".( $hdpoints < $sumnumtzpoints ? "#006600" : "#FF0000" )."\">".number_format( $sumnumtzpoints )." / ".number_format( $hdpoints )."</font></a>";
				}
				else
				{
						echo "0 / 0";
				}
		}
		else if ( $sumnumtzpoints )
		{
				echo "<a href=\"luckmydetail.php?luckno=".$rs['id']."\"><font color=\"#FF0000\">".number_format( $sumnumtzpoints )." / 0</font>";
		}
		else
		{
				echo "0 / 0";
		}
		echo "</td>\r\n                                  <td align=\"center\" bgcolor=\"";
		echo $bgcolor;
		echo "\">";
		if ( $rs['kj'] == 0 )
		{
				echo "<a href=\"luckinsert.php?luckno=".$rs['id']."\" class=\"b\">投注</a>";
		}
		else
		{
				echo "<a href=\"luckmyinsert.php?luckno=".$rs['id']."\">已开奖</a>";
		}
		echo "</td>\r\n                                </tr>\r\n                ";
		++$i;
}
echo "                            </table></td>\r\n                          </tr>\r\n              </table>\r\n\t\t\t\t\t\t<table width=\"806\" border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"4\">\r\n                          <tr>\r\n                            <td align=\"center\">";
include_once( "inc/page_class.php" );
$page = new page( array(
		"total" => $intnum,
		"perpage" => $intpage
) );
echo $page->show( 5, "", "" );
echo "</td>\r\n                          </tr>\r\n              </table>\r\n\t\t\t\t\t\t<script type=\"text/javascript\">\r\n\t\t\t\t\t\t<!--\r\n\t\t\t\t\t\tvar luckno = \"";
echo $kgqh;
echo "\";\r\n\t\t\t\t\t\tif(readCookie('cSound')=='1'){\r\n\t\t\t\t\t\t\timgSound = '<img src=\"images/sound1.gif\" onclick=\"setSound(this,0)\" align=\"absmiddle\" style=\"cursor:pointer\" title=\"关闭开奖声音\">';\r\n\t\t\t\t\t\t}\r\n\t\t\t\t\t\telse{\r\n\t\t\t\t\t\t\timgSound = '<img src=\"images/sound0.gif\" onclick=\"setSound(this,1)\" align=\"absmiddle\" style=\"cursor:pointer\" title=\"打开开奖声音\">';\r\n\t\t\t\t\t\t}\r\n\t\t\t\t\t\tdocument.getElementById(\"fSound\").innerHTML = imgSound;\r\n\t\t\t\t\t\tfunction ShowSecond(cDate){\r\n\t\t\t\t\t\t\tif(luckno != \"\"){\r\n\t\t\t\t\t\t\t\tif(cDate > 1){\r\n\t\t\t\t\t\t\t\t\tdocument.getElementById(\"fLuck\").innerHTML = \"离第\"+luckno+\"期开奖时间还有\"+(--cDate)+\"秒\";\r\n\t\t\t\t\t\t\t\t\tsetTimeout(\"ShowSecond(\"+cDate+\")\",1000);\r\n\t\t\t\t\t\t\t\t}\r\n\t\t\t\t\t\t\t\telse{\r\n\t\t\t\t\t\t\t\t\twavSound = '';\r\n\t\t\t\t\t\t\t\t\tif(readCookie('cSound')=='1'){\r\n\t\t\t\t\t\t\t\t\t\twavSound = '<embed src=\"images/sound/security.wav\" autostart=true hidden=true loop=false>';\r\n\t\t\t\t\t\t\t\t\t}\r\n\t\t\t\t\t\t\t\t\tdocument.getElementById(\"fLuck\").innerHTML = \"第\"+luckno+\"期正在开奖，请刷新页面查看开奖号码。\"+wavSound;\r\n\t\t\t\t\t\t\t\t}\r\n\t\t\t\t\t\t\t}\r\n\t\t\t\t\t\t}\r\n\t\t\t\t\t\tShowSecond(parseInt(\"";
echo $kgtime;
echo "\"));\r\n\t\t\t\t\t\tfunction setSound(obj,v){\r\n\t\t\t\t\t\t\tif(v=='1'){\r\n\t\t\t\t\t\t\t\tobj.src='images/sound1.gif';\r\n\t\t\t\t\t\t\t\tobj.title='关闭开奖声音';\r\n\t\t\t\t\t\t\t\tobj.onclick=function (){setSound(this,0);}\r\n\t\t\t\t\t\t\t}\r\n\t\t\t\t\t\t\telse{\r\n\t\t\t\t\t\t\t\tobj.src='images/sound0.gif';\r\n\t\t\t\t\t\t\t\tobj.title='打开开奖声音';\r\n\t\t\t\t\t\t\t\tobj.onclick=function (){setSound(this,1);}\r\n\t\t\t\t\t\t\t}\r\n\t\t\t\t\t\t\tsetCookie('cSound',v);\r\n\t\t\t\t\t\t}\r\n\t\t\t\t\t\tfunction setCookie(cookieName,cookieValue){\r\n\t\t\t\t\t\t\tvar date = new Date();\r\n\t\t\t\t\t\t\tdate.setTime(date.getTime() + 24*60*60*1000000);\r\n\t\t\t\t\t\t\tdocument.cookie = cookieName + \"=\" + cookieValue + \";expires=\" + date.toGMTString() + \";path=/\";\r\n\t\t\t\t\t\t}\r\n\t\t\t\t\t\tfunction readCookie(cookieName){\r\n\t\t\t\t\t\t\tvar aCookie = document.cookie.split(\"; \");\r\n\t\t\t\t\t\t\tfor (var i=0; i < aCookie.length; i++){\r\n\t\t\t\t\t\t\tvar aCrumb = aCookie[i].split(\"=\");\r\n\t\t\t\t\t\t\tif(cookieName == aCrumb[0])\r\n\t\t\t\t\t\t\t\treturn unescape(aCrumb[1]);\r\n\t\t\t\t\t\t\t}\r\n\t\t\t\t\t\t\treturn null;\r\n\t\t\t\t\t\t}\r\n\t\t\t\t\t\t-->\r\n\t\t\t\t\t\t</script>\r\n\t\t  </DIV>\r\n\t\t  <DIV class=cl></DIV>\r\n\t\t</DIV>\r\n\t\t<DIV class=\"area960-b h5px\"></DIV>\r\n\t<!--Flink End-->\r\n\t<div class=\"blank10\"></div>\r\n\t<!--Footer Start-->\r\n";
include_once( "footer.php" );
echo "</DIV>";
?>
