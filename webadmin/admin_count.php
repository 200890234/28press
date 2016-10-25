<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/

function main( )
{
		global $db;
		global $web_dbtop;
		global $reg_points;
		global $web_moneyname;
		$reg_num = 0;
		$reg_num = $db->result_first( "select count(id) from ".$web_dbtop."users where STR_TO_DATE(time,'%Y-%m-%d')='".date( "Y-m-d" )."'" );
		$adw_num = 0;
		$adw_num = $db->result_first( "select points from ".$web_dbtop."adtj where type=3 and STR_TO_DATE(time,'%Y-%m-%d')='".date( "Y-m-d" )."'" );
		$ads_num = 0;
		$ads_num = $db->result_first( "select points from ".$web_dbtop."adtj where type=2 and STR_TO_DATE(time,'%Y-%m-%d')='".date( "Y-m-d" )."'" );
		$ada_num = 0;
		$ada_num = $db->result_first( "select points from ".$web_dbtop."adtj where type=1 and STR_TO_DATE(time,'%Y-%m-%d')='".date( "Y-m-d" )."'" );
		$users_num = 0;
		$users_num = $db->result_first( "Select (sum(points)+sum(back)) as points from ".$web_dbtop."users" );
		$query = $db->query( "Select jjpoints,authenticationnum,authenticationpoints,indexpoints,boxpoints,tgpoints,game11,game16,game28,gamedodge,exchangepoints,card from ".$web_dbtop."webtj where time='".date( "Y-m-d" )."' Order by id desc" );
		if ( $rs = $db->fetch_array( $query ) )
		{
				$jjpoints = $rs['jjpoints'];
				$authenticationnum = $rs['authenticationnum'];
				$authenticationpoints = $rs['authenticationpoints'];
				$indexpoints = $rs['indexpoints'];
				$boxpoints = $rs['boxpoints'];
				$tgpoints = $rs['tgpoints'];
				$game11 = $rs['game11'];
				$game16 = $rs['game16'];
				$game28 = $rs['game28'];
				$gamedodge = $rs['gamedodge'];
				$dj_num = $rs['exchangepoints'];
				$card = $rs['card'];
		}
		echo "<TABLE width=\"96%\" border=0 align=center cellpadding=\"5\" cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n  <TBODY>\r\n  <TR>\r\n    <TD vAlign=center width=\"20%\" bgColor=#f5fafe>今日注册人数：</TD>\r\n    <TD bgColor=#ffffff>";
		echo $reg_num;
		echo " 人</TD>\r\n    <TD width=\"20%\" bgColor=#f5fafe>今日发放总量：</TD>\r\n    <TD bgColor=#ffffff>";
		echo $reg_num * $reg_points;
		echo " ";
		echo $web_moneyname;
		echo "</TD>\r\n  </TR>\r\n  <TR>\r\n    <TD vAlign=center bgColor=#f5fafe>今日身份验证人数：</TD>\r\n    <TD bgColor=#ffffff>";
		echo intval( $authenticationnum );
		echo " 人</TD>\r\n    <TD bgColor=#f5fafe>今日身份验发放总量：</TD>\r\n    <TD bgColor=#ffffff>";
		echo intval( $authenticationpoints );
		echo " ";
		echo $web_moneyname;
		echo "</TD>\r\n  </TR>\r\n  <TR>\r\n    <TD bgColor=#f5fafe>救济发放：</TD>\r\n    <TD colspan=\"3\" bgColor=#ffffff>";
		echo intval( $jjpoints );
		echo " ";
		echo $web_moneyname;
		echo "</TD>\r\n  </TR>\r\n  <TR>\r\n    <TD bgColor=#f5fafe>首页设置：</TD>\r\n    <TD colspan=\"3\" bgColor=#ffffff>";
		echo intval( $indexpoints );
		echo " ";
		echo $web_moneyname;
		echo "</TD>\r\n  </TR>\r\n  <TR>\r\n    <TD bgColor=#f5fafe>问卷广告发放：</TD>\r\n    <TD colspan=\"3\" bgColor=#ffffff>";
		echo intval( $adw_num );
		echo " ";
		echo $web_moneyname;
		echo "</TD>\r\n  </TR>\r\n  <TR>\r\n    <TD bgColor=#f5fafe>互动广告发放：</TD>\r\n    <TD colspan=\"3\" bgColor=#ffffff>";
		echo intval( $ada_num );
		echo " ";
		echo $web_moneyname;
		echo "</TD>\r\n  </TR>\r\n  <TR>\r\n    <TD bgColor=#f5fafe>消费体验广告发放：</TD>\r\n    <TD colspan=\"3\" bgColor=#ffffff>";
		echo intval( $ads_num );
		echo " ";
		echo $web_moneyname;
		echo "</TD>\r\n  </TR>\r\n  <TR>\r\n    <TD bgColor=#f5fafe>开宝箱送";
		echo $web_moneyname;
		echo "：</TD>\r\n    <TD colspan=\"3\" bgColor=#ffffff>";
		echo intval( $boxpoints );
		echo " ";
		echo $web_moneyname;
		echo "</TD>\r\n  </TR>\r\n  <TR>\r\n    <TD bgColor=#f5fafe>推广送";
		echo $web_moneyname;
		echo "：</TD>\r\n    <TD colspan=\"3\" bgColor=#ffffff>";
		echo intval( $tgpoints );
		echo " ";
		echo $web_moneyname;
		echo "</TD>\r\n  </TR>\r\n  <TR>\r\n    <TD bgColor=#f5fafe>今日兑奖总量：</TD>\r\n    <TD colspan=\"3\" bgColor=#ffffff>";
		echo intval( $dj_num );
		echo " ";
		echo $web_moneyname;
		echo "</TD>\r\n  </TR>\r\n    <TR>\r\n    <TD bgColor=#f5fafe>幸运28抽取：</TD>\r\n    <TD colspan=\"3\" bgColor=#ffffff>";
		echo intval( $game28 );
		echo " ";
		echo $web_moneyname;
		echo "</TD>\r\n  </TR>\r\n    <TR>\r\n    <TD bgColor=#f5fafe>开心16抽取：</TD>\r\n    <TD colspan=\"3\" bgColor=#ffffff>";
		echo intval( $game16 );
		echo " ";
		echo $web_moneyname;
		echo "</TD>\r\n  </TR>\r\n    <TR>\r\n    <TD bgColor=#f5fafe>欢乐11抽取：</TD>\r\n    <TD colspan=\"3\" bgColor=#ffffff>";
		echo intval( $game11 );
		echo " ";
		echo $web_moneyname;
		echo "</TD>\r\n  </TR>\r\n    <TR>\r\n    <TD bgColor=#f5fafe>猜拳抽取：</TD>\r\n    <TD colspan=\"3\" bgColor=#ffffff>";
		echo intval( $gamedodge );
		echo " ";
		echo $web_moneyname;
		echo "</TD>\r\n  </TR>\r\n  <TR>\r\n    <TD bgColor=#f5fafe>今日充卡总";
		echo $web_moneyname;
		echo "数：</TD>\r\n    <TD colspan=\"3\" bgColor=#ffffff>";
		echo intval( $card );
		echo " ";
		echo $web_moneyname;
		echo "</TD>\r\n  </TR>\r\n  <TR>\r\n    <TD bgColor=#f5fafe>当前用户帐号总量：</TD>\r\n    <TD colspan=\"3\" bgColor=#ffffff>";
		echo intval( $users_num );
		echo " ";
		echo $web_moneyname;
		echo "</TD>\r\n  </TR>\r\n</TBODY>\r\n</TABLE>\r\n";
}

function looklist( )
{
		global $db;
		global $web_dbtop;
		$intpage = 20;
		if ( isset( $_GET['page'] ) )
		{
				$rsnum = ( $_GET['page'] - 1 ) * $intpage;
		}
		else
		{
				$rsnum = 0;
		}
		$sql = "Select * from ".$web_dbtop."webtj";
		if ( $_GET['stopdate'] != "" && $_GET['enddate'] != "" )
		{
				$sql .= " where time between '".$_GET['stopdate']."' and '{$_GET['enddate']}'";
		}
		$sql .= " Order by id desc";
		$query = $db->query( $sql );
		if ( $db->fetch_array( $query ) )
		{
				$intnum = $db->num_rows( $query );
		}
		echo "<TABLE width=\"96%\" border=0 align=center cellpadding=\"5\" cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n  <TBODY>\r\n    <TR>\r\n      <TD vAlign=center bgColor=#f5fafe><table width=\"60%\" border=\"0\" align=\"center\" cellpadding=\"3\" cellspacing=\"1\">\r\n\t  \t<form action=\"admin_adquestionstj.php\" method=\"get\">\r\n          <tr>\r\n            <td width=\"12%\"><STRONG>按日期查询</STRONG>：</td>\r\n            <td width=\"36%\">从\r\n\t\t\t<input id=stopdate size=10 name=stopdate onfocus=setday(this) readOnly>\r\n            <IMG onclick=stopdate.focus() src=\"images/calendar.gif\" align=absmiddle>\r\n\t\t\t到\r\n\t\t\t<input id=enddate size=10 name=enddate onfocus=setday(this) readOnly>\r\n\t\t\t<IMG onclick=enddate.focus() src=\"images/calendar.gif\" align=absmiddle></td>\r\n            <td width=\"10%\" align=\"center\"><input class=inputbut type=submit value=搜索 name=Submit></td>\r\n            </tr>\r\n\t\t  </form>\r\n      </table></TD>\r\n    </TR>\r\n  </TBODY>\r\n</TABLE>\r\n<TABLE width=\"96%\" border=0 align=center cellpadding=\"5\" cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n  <TBODY>\r\n    <TR bgColor=\"#f5fafe\">\r\n      <TD align=\"center\">日期</TD>\r\n      <TD width=\"20%\" align=\"center\">发放总量</TD>\r\n      <TD width=\"20%\" align=\"center\">兑奖总量</TD>\r\n\t  <TD width=\"20%\" align=\"center\">用户帐户总量</TD>\r\n\t  <TD width=\"10%\" align=\"center\">操作</TD>\r\n    </TR>\r\n\t";
		$query = $db->query( $sql.( " limit ".$rsnum.",{$intpage}" ) );
		while ( $rs = $db->fetch_array( $query ) )
		{
				echo "    <TR bgcolor=\"#FFFFFF\">\r\n      <TD align=\"center\">";
				echo $rs['time'];
				echo "</TD>\r\n      <TD align=\"center\">";
				echo intval( $rs['regpoints'] + $rs['authenticationpoints'] + $rs['jjpoints'] + $rs['indexpoints'] + $rs['adquestionspoints'] + $rs['adcpapoints'] + $rs['adcpspoints'] + $rs['boxpoints'] + $rs['tgpoints'] );
				echo "</TD>\r\n      <TD align=\"center\">";
				echo $rs['exchangepoints'];
				echo "</TD>\r\n\t  <TD align=\"center\">";
				echo $rs['userspoints'];
				echo "</TD>\r\n\t  <TD align=\"center\"><a href=\"#\" onclick=\"AddWin('W_COUNT_";
				echo $rs['id'];
				echo "','";
				echo $rs['time'];
				echo " 统计','admin_count.php?action=look&id=";
				echo $rs['id'];
				echo "',680,310,0);return false\">详细</a></TD>\r\n    </TR>\r\n\t";
		}
		echo "\t<TR align=\"center\" bgcolor=\"#f8fbfb\">\r\n      <TD colspan=\"5\">";
		include_once( dirname( __FILE__ )."/../inc/page_class.php" );
		$page = new page( array(
				"total" => $intnum,
				"perpage" => $intpage
		) );
		echo $page->show( 4, "page", "curr" );
		echo "</TD>\r\n    </TR>\r\n  </TBODY>\r\n  </form>\r\n</TABLE>\r\n<script language=\"JavaScript\" src=\"inc/calendar.js\"></script>\r\n<script language=\"javascript\" src=\"inc/QJ_Display.js\"></script>\r\n";
}

function look( )
{
		global $db;
		global $web_dbtop;
		global $web_moneyname;
		$query = $db->query( "Select * from ".$web_dbtop."webtj where id={$_GET['id']} Order by id desc" );
		if ( $rs = $db->fetch_array( $query ) )
		{
				$regnum = $rs['regnum'];
				$regpoints = $rs['regpoints'];
				$authenticationnum = $rs['authenticationnum'];
				$authenticationpoints = $rs['authenticationpoints'];
				$jjpoints = $rs['jjpoints'];
				$indexpoints = $rs['indexpoints'];
				$adquestionspoints = $rs['adquestionspoints'];
				$adcpapoints = $rs['adcpapoints'];
				$adcpspoints = $rs['adcpspoints'];
				$exchangepoints = $rs['exchangepoints'];
				$userspoints = $rs['userspoints'];
				$boxpoints = $rs['boxpoints'];
				$tgpoints = $rs['tgpoints'];
				$game11 = $rs['game11'];
				$game16 = $rs['game16'];
				$game28 = $rs['game28'];
				$gamedodge = $rs['gamedodge'];
				$card = $rs['card'];
		}
		echo "<TABLE width=\"98%\" border=0 align=center cellpadding=\"5\" cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n  <TBODY>\r\n  <TR>\r\n    <TD vAlign=center width=\"20%\" bgColor=#f5fafe>今日注册人数：</TD>\r\n    <TD bgColor=#ffffff>";
		echo $regnum;
		echo " 人</TD>\r\n    <TD width=\"20%\" bgColor=#f5fafe>今日发放总量：</TD>\r\n    <TD bgColor=#ffffff>";
		echo $regpoints;
		echo " ";
		echo $web_moneyname;
		echo "</TD>\r\n  </TR>\r\n  <TR>\r\n    <TD vAlign=center bgColor=#f5fafe>今日身份验证人数：</TD>\r\n    <TD bgColor=#ffffff>";
		echo intval( $authenticationnum );
		echo " 人</TD>\r\n    <TD bgColor=#f5fafe>今日身份验发放总量：</TD>\r\n    <TD bgColor=#ffffff>";
		echo intval( $authenticationpoints );
		echo " ";
		echo $web_moneyname;
		echo "</TD>\r\n  </TR>\r\n  <TR>\r\n    <TD bgColor=#f5fafe>救济发放：</TD>\r\n    <TD colspan=\"3\" bgColor=#ffffff>";
		echo intval( $jjpoints );
		echo " ";
		echo $web_moneyname;
		echo "</TD>\r\n  </TR>\r\n  <TR>\r\n    <TD bgColor=#f5fafe>首页设置：</TD>\r\n    <TD colspan=\"3\" bgColor=#ffffff>";
		echo intval( $indexpoints );
		echo " ";
		echo $web_moneyname;
		echo "</TD>\r\n  </TR>\r\n  <TR>\r\n    <TD bgColor=#f5fafe>问卷广告发放：</TD>\r\n    <TD colspan=\"3\" bgColor=#ffffff>";
		echo intval( $adquestionspoints );
		echo " ";
		echo $web_moneyname;
		echo "</TD>\r\n  </TR>\r\n  <TR>\r\n    <TD bgColor=#f5fafe>互动广告发放：</TD>\r\n    <TD colspan=\"3\" bgColor=#ffffff>";
		echo intval( $adcpapoints );
		echo " ";
		echo $web_moneyname;
		echo "</TD>\r\n  </TR>\r\n  <TR>\r\n    <TD bgColor=#f5fafe>消费体验广告发放：</TD>\r\n    <TD colspan=\"3\" bgColor=#ffffff>";
		echo intval( $adcpspoints );
		echo " ";
		echo $web_moneyname;
		echo "</TD>\r\n  </TR>\r\n  <TR>\r\n    <TD bgColor=#f5fafe>开宝箱送";
		echo $web_moneyname;
		echo "：</TD>\r\n    <TD colspan=\"3\" bgColor=#ffffff>";
		echo intval( $boxpoints );
		echo " ";
		echo $web_moneyname;
		echo "</TD>\r\n  </TR>\r\n  <TR>\r\n    <TD bgColor=#f5fafe>推广送";
		echo $web_moneyname;
		echo "：</TD>\r\n    <TD colspan=\"3\" bgColor=#ffffff>";
		echo intval( $tgpoints );
		echo " ";
		echo $web_moneyname;
		echo "</TD>\r\n  </TR>\r\n  <TR>\r\n    <TD bgColor=#f5fafe>今日兑将数量：</TD>\r\n    <TD colspan=\"3\" bgColor=#ffffff>";
		echo intval( $exchangepoints );
		echo " ";
		echo $web_moneyname;
		echo "</TD>\r\n  </TR>\r\n      <TR>\r\n    <TD bgColor=#f5fafe>幸运28抽取：</TD>\r\n    <TD colspan=\"3\" bgColor=#ffffff>";
		echo intval( $game28 );
		echo " ";
		echo $web_moneyname;
		echo "</TD>\r\n  </TR>\r\n    <TR>\r\n    <TD bgColor=#f5fafe>开心16抽取：</TD>\r\n    <TD colspan=\"3\" bgColor=#ffffff>";
		echo intval( $game16 );
		echo " ";
		echo $web_moneyname;
		echo "</TD>\r\n  </TR>\r\n    <TR>\r\n    <TD bgColor=#f5fafe>欢乐11抽取：</TD>\r\n    <TD colspan=\"3\" bgColor=#ffffff>";
		echo intval( $game11 );
		echo " ";
		echo $web_moneyname;
		echo "</TD>\r\n  </TR>\r\n    <TR>\r\n    <TD bgColor=#f5fafe>猜拳抽取：</TD>\r\n    <TD colspan=\"3\" bgColor=#ffffff>";
		echo intval( $gamedodge );
		echo " ";
		echo $web_moneyname;
		echo "</TD>\r\n  </TR>\r\n  <TR>\r\n    <TD bgColor=#f5fafe>今日充卡总";
		echo $web_moneyname;
		echo "数：</TD>\r\n    <TD colspan=\"3\" bgColor=#ffffff>";
		echo intval( $card );
		echo " ";
		echo $web_moneyname;
		echo "</TD>\r\n  </TR>\r\n  <TR>\r\n    <TD bgColor=#f5fafe>当前用户帐号总量：</TD>\r\n    <TD colspan=\"3\" bgColor=#ffffff>";
		echo intval( $userspoints );
		echo " ";
		echo $web_moneyname;
		echo "</TD>\r\n  </TR>\r\n</TBODY>\r\n</TABLE>\r\n";
}

include_once( dirname( __FILE__ )."/../inc/conn.php" );
include_once( dirname( __FILE__ )."/inc/function.php" );
login_check( "system" );
echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd\">\r\n<HTML xmlns=\"http://www.w3.org/1999/xhtml\">\r\n<HEAD>\r\n<TITLE>今日发放统计--雷风积分游戏系统</TITLE>\r\n<META http-equiv=Content-Type content=\"text/html; charset=gb2312\">\r\n<LINK href=\"images/css_body.css\" type=text/css rel=stylesheet>\r\n<META content=\"MSHTML 6.00.3790.4275\" name=GENERATOR>\r\n</HEAD>\r\n<BODY>\r\n";
if ( $_GET['action'] != "look" )
{
		echo "<DIV class=bodytitle>\r\n<DIV class=bodytitleleft></DIV>\r\n<DIV class=bodytitletxt>今日统计</DIV>\r\n<DIV class=bodytitletxt2><a href=\"?action=looklist\">历史数据查看</a></DIV>\r\n</DIV>\r\n";
}
switch ( $_GET['action'] )
{
case "looklist" :
		looklist( );
		break;
case "look" :
		look( );
		break;
default :
		main( );
}
echo "</BODY>\r\n</HTML>";
?>
