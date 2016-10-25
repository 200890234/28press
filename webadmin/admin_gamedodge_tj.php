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
login_check( "gametj" );
echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd\">\r\n<HTML xmlns=\"http://www.w3.org/1999/xhtml\">\r\n<HEAD>\r\n<TITLE>猜拳统计--雷风积分游戏系统</TITLE>\r\n<META http-equiv=Content-Type content=\"text/html; charset=gb2312\">\r\n<LINK href=\"images/css_body.css\" type=text/css rel=stylesheet>\r\n<META content=\"MSHTML 6.00.3790.4275\" name=GENERATOR>\r\n</HEAD>\r\n<BODY>\r\n<DIV class=bodytitle>\r\n<DIV class=bodytitleleft></DIV>\r\n<DIV class=bodytitletxt>猜拳统计</DIV>\r\n</DIV>\r\n<TABLE width=\"96%\" border=0 align=center cellpadding=\"5\" cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n  <TBODY>\r\n    <TR bgColor=\"#f5fafe\">\r\n      <TD width=\"15%\" align=\"center\">期号</TD>\r\n      <TD width=\"20%\" align=\"center\">摆擂时间</TD>\r\n      <TD width=\"15%\" align=\"center\">擂主</TD>\r\n      <TD width=\"15%\" align=\"center\">挑战者</TD>\r\n\t  <TD align=\"center\">投注</TD>\r\n      <TD width=\"12%\" align=\"center\">抽取";
echo $web_moneyname;
echo "数</TD>\r\n    </TR>\r\n    ";
$query = $db->query( "Select gamedodge_tz_cl from ".$web_dbtop."game_system where id=1" );
if ( $rs = $db->fetch_array( $query ) )
{
				$gamedodge_tz_cl = $rs['gamedodge_tz_cl'];
}
$intpage = 20;
if ( isset( $_GET['page'] ) )
{
				$rsnum = ( $_GET['page'] - 1 ) * $intpage;
}
else
{
				$rsnum = 0;
}
$query = $db->query( "Select * from ".$web_dbtop."gamedodge where zt=1 Order by id desc" );
if ( $db->fetch_array( $query ) )
{
				$intnum = $db->num_rows( $query );
}
$query = $db->query( "Select * from ".$web_dbtop."gamedodge where zt=1 Order by id desc limit {$rsnum},{$intpage}" );
while ( $rs = $db->fetch_array( $query ) )
{
				$dodgejg = dodgejg( $rs['dodge'], $rs['tzdodge'] );
				echo "    <TR bgcolor=\"#FFFFFF\">\r\n      <TD align=\"center\">";
				echo $rs['id'];
				echo "</TD>\r\n      <TD align=\"center\">";
				echo date( "Y-m-d H:i", strtotime( $rs['time'] ) );
				echo "</TD>\r\n      <TD align=\"center\" ";
				if ( $dodgejg == 1 )
				{
								echo "style=\"font-weight: bold;color: #FF0000;\"";
				}
				else if ( $dodgejg == 2 )
				{
								echo "style=\"color: #006600;\"";
				}
				echo ">";
				echo $rs['uid'];
				echo "</TD>\r\n\t  <TD align=\"center\" ";
				if ( $dodgejg == 2 )
				{
								echo "style=\"font-weight: bold;color: #FF0000;\"";
				}
				else if ( $dodgejg == 1 )
				{
								echo "style=\"color: #006600;\"";
				}
				echo ">";
				echo $rs['tzid'];
				echo "</TD>\r\n      <TD align=\"center\">";
				echo number_format( $rs['points'] );
				echo "</TD>\r\n      <TD align=\"center\">";
				echo $dodgejg != 3 ? number_format( $rs['points'] - intval( $rs['points'] * ( 100 - $gamedodge_tz_cl ) / 100 ) ) : 0;
				echo "</TD>\r\n    </TR>\r\n    ";
}
echo "    <TR align=\"center\" bgcolor=\"#f8fbfb\">\r\n      <TD colspan=\"6\">";
include_once( dirname( __FILE__ )."/../inc/page_class.php" );
( array(
				"total" => $intnum,
				"perpage" => $intpage
) );
$page = new page( );
echo $page->show( 4, "page", "curr" );
echo "</TD>\r\n    </TR>\r\n  </TBODY>\r\n</TABLE>\r\n";
?>
