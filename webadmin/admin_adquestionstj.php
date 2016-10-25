<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/

function del( )
{
		global $db;
		global $web_dbtop;
		$db->query( "delete from ".$web_dbtop."adtj where STR_TO_DATE(time,'%Y-%m-%d')<='".date( "Y-" ).( date( "m" ) - 2 ).date( "-d" )."' and type=3" );
}

function main( )
{
		global $db;
		global $web_dbtop;
		global $web_moneyname;
		$intpage = 20;
		if ( isset( $_GET['page'] ) )
		{
				$rsnum = ( $_GET['page'] - 1 ) * $intpage;
		}
		else
		{
				$rsnum = 0;
		}
		$sql = "Select * from ".$web_dbtop."adtj where type=3";
		if ( $_GET['stopdate'] != "" && $_GET['enddate'] != "" )
		{
				$sql .= " and STR_TO_DATE(logtime,'%Y-%m-%d') between '".$_GET['stopdate']."' and '{$_GET['enddate']}'";
		}
		$sql .= " Order by id desc";
		$query = $db->query( $sql );
		if ( $db->fetch_array( $query ) )
		{
				$intnum = $db->num_rows( $query );
		}
		echo "<TABLE width=\"96%\" border=0 align=center cellpadding=\"5\" cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n  <TBODY>\r\n    <TR>\r\n      <TD vAlign=center bgColor=#f5fafe><table width=\"60%\" border=\"0\" align=\"center\" cellpadding=\"3\" cellspacing=\"1\">\r\n\t  \t<form action=\"admin_adquestionstj.php\" method=\"get\">\r\n          <tr>\r\n            <td width=\"12%\"><STRONG>按日期查询</STRONG>：</td>\r\n            <td width=\"36%\">从\r\n\t\t\t<input id=stopdate size=10 name=stopdate onfocus=setday(this) readOnly>\r\n            <IMG onclick=stopdate.focus() src=\"images/calendar.gif\" align=absmiddle>\r\n\t\t\t到\r\n\t\t\t<input id=enddate size=10 name=enddate onfocus=setday(this) readOnly>\r\n\t\t\t<IMG onclick=enddate.focus() src=\"images/calendar.gif\" align=absmiddle></td>\r\n            <td width=\"10%\" align=\"center\"><input class=inputbut type=submit value=搜索 name=Submit></td>\r\n            </tr>\r\n\t\t  </form>\r\n      </table></TD>\r\n    </TR>\r\n  </TBODY>\r\n</TABLE>\r\n<TABLE width=\"96%\" border=0 align=center cellpadding=\"5\" cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n  <TBODY>\r\n    <TR bgColor=\"#f5fafe\">\r\n      <TD width=\"5%\" align=\"center\">ID</TD>\r\n      <TD align=\"center\">日期</TD>\r\n      <TD width=\"20%\" align=\"center\">发放数量</TD>\r\n      <TD width=\"20%\" align=\"center\">";
		echo $web_moneyname;
		echo "合计</TD>\r\n    </TR>\r\n\t";
		$query = $db->query( $sql.( " limit ".$rsnum.",{$intpage}" ) );
		while ( $rs = $db->fetch_array( $query ) )
		{
				echo "    <TR bgcolor=\"#FFFFFF\">\r\n      <TD align=\"center\">";
				echo $rs['id'];
				echo "</TD>\r\n      <TD align=\"center\">";
				echo $rs['time'];
				echo "</TD>\r\n      <TD align=\"center\">";
				echo $rs['num'];
				echo "</TD>\r\n      <TD align=\"center\">";
				echo $rs['points'];
				echo "</TD>\r\n    </TR>\r\n\t";
		}
		echo "\t<TR align=\"center\" bgcolor=\"#f8fbfb\">\r\n      <TD colspan=\"4\">";
		include_once( dirname( __FILE__ )."/../inc/page_class.php" );
		$page = new page( array(
				"total" => $intnum,
				"perpage" => $intpage
		) );
		echo $page->show( 4, "page", "curr" );
		echo "</TD>\r\n    </TR>\r\n  </TBODY>\r\n  </form>\r\n</TABLE>\r\n<script language=\"JavaScript\" src=\"inc/calendar.js\"></script>\r\n";
}

include_once( dirname( __FILE__ )."/../inc/conn.php" );
include_once( dirname( __FILE__ )."/inc/function.php" );
login_check( "adtj" );
echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd\">\r\n<HTML xmlns=\"http://www.w3.org/1999/xhtml\">\r\n<HEAD>\r\n<TITLE>广告统计--雷风积分游戏系统</TITLE>\r\n<META http-equiv=Content-Type content=\"text/html; charset=gb2312\">\r\n<LINK href=\"images/css_body.css\" type=text/css rel=stylesheet>\r\n<META content=\"MSHTML 6.00.3790.4275\" name=GENERATOR>\r\n</HEAD>\r\n<BODY>\r\n<DIV class=bodytitle>\r\n<DIV class=bodytitleleft></DIV>\r\n<DIV class=bodytitletxt>广告统计</DIV>\r\n<DIV class=bodytitletxt2><a href=\"admin_adquestionstj.php?action=del\">删除两月前数据</a></DIV>\r\n</DIV>\r\n";
switch ( $_GET['action'] )
{
case "del" :
		del( );
		addlog( "广告统计删除成功" );
		showerr( "广告统计删除成功", "admin_adquestionstj.php" );
		break;
default :
		main( );
}
echo "</BODY></HTML>\r\n";
?>
