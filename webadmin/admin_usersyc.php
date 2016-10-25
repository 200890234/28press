<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/

set_time_limit( 0 );
include_once( dirname( __FILE__ )."/../inc/conn.php" );
include_once( dirname( __FILE__ )."/inc/function.php" );
login_check( "users" );
echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd\">\r\n<HTML xmlns=\"http://www.w3.org/1999/xhtml\">\r\n<HEAD>\r\n<TITLE>帐户异常检测--雷风积分游戏系统</TITLE>\r\n<META http-equiv=Content-Type content=\"text/html; charset=gb2312\">\r\n<LINK href=\"images/css_body.css\" type=text/css rel=stylesheet>\r\n<META content=\"MSHTML 6.00.3790.4275\" name=GENERATOR>\r\n</HEAD>\r\n<BODY>\r\n<DIV class=bodytitle>\r\n<DIV class=bodytitleleft></DIV>\r\n<DIV class=bodytitletxt>帐户异常检测</DIV>\r\n<DIV class=bodytitletxt2><a href=\"admin_users.php\">返回用户管理</a></DIV>\r\n</DIV>\r\n<TABLE width=\"96%\" border=0 align=center cellpadding=\"5\" cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n  <TBODY>\r\n    <TR bgColor=\"#f5fafe\">\r\n      <TD align=\"center\">异常帐号</TD>\r\n      <TD width=\"30%\" align=\"center\">异常情况</TD>\r\n      <TD width=\"20%\" align=\"center\">注册时间</TD>\r\n    </TR>\r\n\t";
$query = $db->query( "Select id,points,back,authentication,vip,maxexperience,time from ".$web_dbtop."users Order by points+back desc" );
while ( $rs = $db->fetch_array( $query ) )
{
		$id = $rs['id'];
		$time = $rs['time'];
		$points = $rs['points'];
		$back = $rs['back'];
		$vip = $rs['vip'];
		$maxexperience = $rs['maxexperience'];
		$authentication = $rs['authentication'];
		$query_f = $db->query( "Select * from ".$web_dbtop."game_log where uid={$id}" );
		if ( $rs_f = $db->fetch_array( $query_f ) )
		{
				$reg_hd = $rs_f['reg_hd'];//注册获得游戏币数量
				$game11_hd = $rs_f['game11_hd'];
				$game16_hd = $rs_f['game16_hd'];
				$game28_hd = $rs_f['game28_hd'];
				$gamebox_hd = $rs_f['gamebox_hd'];
				$gamedodge_hd = $rs_f['gamedodge_hd'];
				$dj_hd = $rs_f['dj_hd'];
				$ad_hd = $rs_f['ad_hd'];
				$jj_hd = $rs_f['jj_hd'];
				$xx_hd = $rs_f['xx_hd'];
				$hd_hd = $rs_f['hd_hd'];
				$dj_doudou = $rs_f['dj_doudou'];
		}
		//$hspoints = $reg_points + $game16_hd + $game28_hd + $game11_hd + $gamedodge_hd + $gamebox_hd + $dj_hd + $ad_hd + $jj_hd + $xx_hd + $hd_hd - $dj_doudou - $back - $points;
		$hspoints = $reg_hd + $game16_hd + $game28_hd + $game11_hd + $gamedodge_hd + $gamebox_hd + $dj_hd + $ad_hd + $jj_hd + $xx_hd + $hd_hd - $dj_doudou - $back - $points;//注册送游戏币的数量应以注册时的数量一致
		if ( $authentication == 1 )
		{
				$hspoints += $web_authentication;
		}
		if ( $hspoints != 0 )
		{
				echo "    <TR bgcolor=\"#FFFFFF\">\r\n      <TD>";
				echo $id;
				echo "        ";
				if ( $vip == 1 )
				{
						echo "        <img src=\"../images/vip.gif\" />\r\n        ";
				}
				echo "        ";
				showstars( userslive( $maxexperience ) );
				echo "        ";
				echo $rs['authentication'] == 1 ? "<a href=\"#\" onclick=\"AddWin('W_SFYZ_".$id."','用户 ".$id." 身份验证查看','admin_authentication.php?action=look&id=".$id."',550,320,0);return false\"><img src=\"images/CreateTableTemplatesGallery.gif\" width=\"16\" height=\"16\"></a>" : "";
				echo "        <a href=\"#\" onclick=\"AddWin('W_HD_";
				echo $id;
				echo "','用户 ";
				echo $id;
				echo " 数据核对','admin_usersdz.php?id=";
				echo $id;
				echo "',480,340,0);return false\"><img src=\"images/CreateFormMoreFormsGallery.gif\" width=\"16\" height=\"16\"></a> <a href=\"#\" onclick=\"AddWin('W_SMS_";
				echo $id;
				echo "','用户 ";
				echo $id;
				echo " 短信通知','admin_sms.php?action=sms&uid=";
				echo $id;
				echo "',480,220,0);return false\"><img src=\"images/sms.gif\" width=\"16\" height=\"16\"></a></TD>\r\n      <TD align=\"center\">";
				if ( 0 < $hspoints )
				{
						echo "帐户异常,缺少 ".$hspoints.$web_moneyname;
				}
				else if ( $hspoints < 0 )
				{
						echo "帐户异常,多余 ".abs( $hspoints ).$web_moneyname;
				}
				echo "</TD>\r\n      <TD align=\"center\">";
				echo $time;
				echo "</TD>\r\n    </TR>\r\n\t";
		}
}
echo "  </TBODY>\r\n</TABLE>\r\n<script language=\"javascript\" src=\"inc/QJ_Display.js\"></script>\r\n</BODY>\r\n</HTML>\r\n";
?>
