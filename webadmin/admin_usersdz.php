<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/

include_once( dirname( __FILE__ )."/../inc/conn.php" );
include_once( dirname( __FILE__ )."/inc/function.php" );
login_check( 1 );
echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd\">\r\n<HTML xmlns=\"http://www.w3.org/1999/xhtml\">\r\n<HEAD>\r\n<TITLE>用户管理--雷风积分游戏系统</TITLE>\r\n<META http-equiv=Content-Type content=\"text/html; charset=gb2312\">\r\n<LINK href=\"images/css_body.css\" type=text/css rel=stylesheet>\r\n<META content=\"MSHTML 6.00.3790.4275\" name=GENERATOR>\r\n</HEAD>\r\n<BODY>\r\n";
$query = $db->query( "Select id,points,back,authentication,time from ".$web_dbtop."users where id={$_GET['id']}" );
if ( $rs = $db->fetch_array( $query ) )
{
		$id = $rs['id'];
		$time = $rs['time'];
		$points = $rs['points'];
		$back = $rs['back'];
		$authentication = $rs['authentication'];
}
$query = $db->query( "Select * from ".$web_dbtop."game_log where uid={$_GET['id']}" );
if ( $rs = $db->fetch_array( $query ) )
{
		$reg_hd = $rs['reg_hd'];
		$sfyz_hd = $rs['sfyz_hd'];
		$game11_hd = $rs['game11_hd'];
		$game16_hd = $rs['game16_hd'];
		$game28_hd = $rs['game28_hd'];
		$gamebox_hd = $rs['gamebox_hd'];
		$gamedodge_hd = $rs['gamedodge_hd'];
		$dj_hd = $rs['dj_hd'];
		$ad_hd = $rs['ad_hd'];
		$jj_hd = $rs['jj_hd'];
		$xx_hd = $rs['xx_hd'];
		$hd_hd = $rs['hd_hd'];
		$dj_doudou = $rs['dj_doudou'];
}
echo "<TABLE width=\"98%\" border=0 align=center cellpadding=\"4\" cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n  <TBODY>\r\n    <TR>\r\n      <TD width=\"25%\" bgColor=#f5fafe>用户ID：</TD>\r\n      <TD bgColor=#ffffff>";
echo $id;
echo "</TD>\r\n      <TD width=\"25%\" bgColor=#f5fafe>注册时间：</TD>\r\n      <TD bgColor=#ffffff>";
echo $time;
echo "</TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>帐户余额：</TD>\r\n      <TD bgColor=#ffffff>";
echo $points;
echo "</TD>\r\n      <TD bgColor=#f5fafe>银行存款：</TD>\r\n      <TD bgColor=#ffffff>";
echo $back;
echo "</TD>\r\n\t</TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>注册奖励：</TD>\r\n      <TD bgColor=#ffffff>";
echo $reg_hd;
echo "</TD>\r\n      <TD bgColor=#f5fafe>身份验证奖励：</TD>\r\n      <TD bgColor=#ffffff>";
echo $sfyz_hd;
echo "</TD>\r\n\t</TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>开心16收益：</TD>\r\n      <TD bgColor=#ffffff>";
echo $game16_hd;
echo "      <a href=\"#\" onclick=\"parent.AddWin('W_game16_";
echo $id;
echo "','用户";
echo $id;
echo "开心16详情','admin_usersdz_tj.php?action=game16&uid=";
echo $id;
echo "',550,300,0);return false\">详细查看</a></TD>\r\n      <TD bgColor=#f5fafe>幸运28收益：</TD>\r\n      <TD bgColor=#ffffff>";
echo $game28_hd;
echo "      <a href=\"#\" onclick=\"parent.AddWin('W_game28_";
echo $id;
echo "','用户";
echo $id;
echo "幸运28详情','admin_usersdz_tj.php?action=game28&uid=";
echo $id;
echo "',550,300,0);return false\">详细查看</a></TD>\r\n\t</TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>欢乐11收益：</TD>\r\n      <TD bgColor=#ffffff>";
echo intval( $game11_hd );
echo "      <a href=\"#\" onclick=\"parent.AddWin('W_game11_";
echo $id;
echo "','用户";
echo $id;
echo "欢乐11收益详情','admin_usersdz_tj.php?action=game11&uid=";
echo $id;
echo "',550,300,0);return false\">详细查看</a></TD>\r\n      <TD bgColor=#f5fafe>猜拳收益：</TD>\r\n      <TD bgColor=#ffffff>";
echo intval( $gamedodge_hd );
echo "      <a href=\"#\" onclick=\"parent.AddWin('W_dodge_";
echo $id;
echo "','用户";
echo $id;
echo "猜拳收益详情','admin_usersdz_tj.php?action=dodge&uid=";
echo $id;
echo "',550,300,0);return false\">详细查看</a></TD>\r\n\t</TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>开箱收益：</TD>\r\n      <TD bgColor=#ffffff>";
echo intval( $gamebox_hd );
echo "      <a href=\"#\" onclick=\"parent.AddWin('W_box_";
echo $id;
echo "','用户";
echo $id;
echo "开箱收益详情','admin_usersdz_tj.php?action=box&uid=";
echo $id;
echo "',550,300,0);return false\">详细查看</a></TD>\r\n      <TD bgColor=#f5fafe></TD>\r\n      <TD bgColor=#ffffff></TD>\r\n\t</TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>游戏总收益：</TD>\r\n      <TD colspan=\"3\" bgColor=#ffffff>";
echo intval( $game16_hd ) + intval( $game28_hd ) + intval( $game11_hd ) + intval( $gamedodge_hd ) + intval( $gamebox_hd );
echo "</TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>救济领取：</TD>\r\n      <TD bgColor=#ffffff>";
echo intval( $jj_hd );
echo "      <a href=\"#\" onclick=\"parent.AddWin('W_JJ_";
echo $id;
echo "','用户";
echo $id;
echo "救济领取详情','admin_usersdz_tj.php?action=ad&type=5&uid=";
echo $id;
echo "',550,300,0);return false\">详细查看</a></TD>\r\n      <TD bgColor=#f5fafe>活动奖励：</TD>\r\n      <TD bgColor=#ffffff>";
echo intval( $hd_hd );
echo "</TD>\r\n\t</TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>广告收益：</TD>\r\n      <TD bgColor=#ffffff>";
echo intval( $ad_hd );
echo "      <a href=\"#\" onclick=\"parent.AddWin('W_AD_";
echo $id;
echo "','用户";
echo $id;
echo "广告收益详情','admin_usersdz_tj.php?action=ad&type=1&uid=";
echo $id;
echo "',550,300,0);return false\">详细查看</a></TD>\r\n      <TD bgColor=#f5fafe>下线收益：</TD>\r\n      <TD bgColor=#ffffff>";
echo intval( $xx_hd );
echo "      <a href=\"#\" onclick=\"parent.AddWin('W_XX_";
echo $id;
echo "','用户";
echo $id;
echo "下线收益详情','admin_usersdz_tj.php?action=xx&uid=";
echo $id;
echo "',480,300,0);return false\">详细查看</a></TD>\r\n\t</TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>道具";
echo $web_moneyname;
echo "：</TD>\r\n      <TD bgColor=#ffffff>";
echo intval( $dj_hd );
echo "      <a href=\"#\" onclick=\"parent.AddWin('W_DJ_";
echo $id;
echo "','用户";
echo $id;
echo "道具使用详情','admin_usersdz_tj.php?action=ad&type=2&uid=";
echo $id;
echo "',550,300,0);return false\">详细查看</a></TD>\r\n      <TD bgColor=#f5fafe>兑奖";
echo $web_moneyname;
echo "：</TD>\r\n      <TD bgColor=#ffffff>";
echo intval( $dj_doudou );
echo "       <a href=\"#\" onclick=\"parent.AddWin('W_DG_";
echo $id;
echo "','用户";
echo $id;
echo "兑奖详情','admin_usersdz_tj.php?action=dj&uid=";
echo $id;
echo "',480,300,0);return false\">详细查看</a></TD>\r\n\t</TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>核算：</TD>\r\n      <TD colspan=\"3\" bgColor=#ffffff>";
$hspoints = $reg_hd + $sfyz_hd + $game16_hd + $game28_hd + $game11_hd + $gamedodge_hd + $gamebox_hd + $dj_hd + $ad_hd + $jj_hd + $xx_hd + $hd_hd - $dj_doudou - $back - $points;
if ( $hspoints == 0 )
{
		echo "帐户".$web_moneyname."正常";
}
else if ( 0 < $hspoints )
{
		echo "帐户异常,缺少 ".$hspoints.$web_moneyname;
}
else if ( $hspoints < 0 )
{
		echo "帐户异常,多余 ".abs( $hspoints ).$web_moneyname;
}
echo "</TD>\r\n    </TR>\r\n  </TBODY>\r\n</TABLE>\r\n";
?>
