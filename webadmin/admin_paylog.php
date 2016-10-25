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
		$db->query( "delete from ".$web_dbtop."paylogc where orderid='(select orderid from {$web_dbtop}paylog where id={$_GET['id']})'" );
		$db->query( "delete from ".$web_dbtop."paylog where id={$_GET['id']}" );
}

function main( )
{
		global $db;
		global $web_dbtop;
		echo "<TABLE width=\"96%\" border=0 align=center cellpadding=0 cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n  <TBODY>\r\n    <TR>\r\n      <TD bgColor=#f5fafe><table width=\"96%\" border=\"0\" align=\"center\" cellpadding=\"3\" cellspacing=\"1\">\r\n          <tr>\r\n            <form action=\"admin_paylog.php\" method=\"get\">\r\n              <td width=\"15%\"><strong>搜索订单号：</strong></td>\r\n              <td width=\"21%\"><input id=keyword size=20 name=keyword></td>\r\n              <td width=\"5%\" align=\"center\" ><INPUT class=inputbut type=submit value=搜索 name=Submit></td>\r\n\t\t    </form>\r\n\t\t\t  <form action=\"admin_paylog.php\" method=\"get\">\r\n              <td width=\"15%\" align=\"center\"><STRONG>日期查询</STRONG>：</td>\r\n              <td width=\"21%\" align=\"center\"><input id=stopdate size=15 name=stopdate onfocus=setday(this) readOnly>\r\n                  <IMG onclick=stopdate.focus() src=\"images/calendar.gif\" align=absBottom></td>\r\n              <td><INPUT class=inputbut type=submit value=搜索 name=Submit></td>\r\n            </form>\r\n          </tr>\r\n      </table></TD>\r\n    </TR>\r\n  </TBODY>\r\n</TABLE>\r\n<TABLE width=\"96%\" border=0 align=center cellpadding=\"5\" cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n  <TBODY>\r\n    <TR bgColor=\"#f5fafe\">\r\n      <TD width=\"20%\" align=\"center\">订单号</TD>\r\n\t  <TD align=\"center\">商户</TD>\r\n      <TD width=\"15%\" align=\"center\">价格</TD>\r\n\t  <TD width=\"18%\" align=\"center\">时间</TD>\r\n\t  <TD width=\"10%\" align=\"center\">转卡类型</TD>\r\n\t  <TD width=\"12%\" align=\"center\">操作</TD>\r\n    </TR>\r\n\t";
		$intpage = 20;
		if ( isset( $_GET['page'] ) )
		{
				$rsnum = ( $_GET['page'] - 1 ) * $intpage;
		}
		else
		{
				$rsnum = 0;
		}
		$sql = "Select * from ".$web_dbtop."paylog";
		$query = $db->query( $sql." Order by id desc" );
		if ( $db->fetch_array( $query ) )
		{
				$intnum = $db->num_rows( $query );
		}
		if ( isset( $_GET['keyword'] ) )
		{
				$sql .= " where orderid=".intval( $_GET['keyword'] )."";
		}
		if ( isset( $_GET['stopdate'] ) )
		{
				$sql .= " where STR_TO_DATE(time,'%Y-%m-%d')='".$_GET['stopdate']."'";
		}
		$query = $db->query( $sql.( " Order by id desc limit ".$rsnum.",{$intpage}" ) );
		while ( $rs = $db->fetch_array( $query ) )
		{
				echo "    <TR bgcolor=\"#FFFFFF\">\r\n      <TD align=\"center\">";
				echo $rs['orderid'];
				echo "</TD>\r\n\t  <TD align=\"center\">";
				echo showcontent( "business", "name", $rs['businessid'] );
				echo "</TD>\r\n      <TD align=\"center\">";
				echo $rs['price'];
				echo " 元</TD>\r\n\t  <TD align=\"center\">";
				echo $rs['time'];
				echo "</TD>\r\n\t  <TD align=\"center\">";
				echo $rs['type'] == 1 ? "自动" : "手动";
				echo "</TD>\r\n\t  <TD align=\"center\"><A href=\"admin_paylog.php?action=look&orderid=";
				echo $rs['orderid'];
				echo "\">详细</a> | <A href=\"admin_paylog.php?action=del&id=";
				echo $rs['id'];
				echo "\" onClick=\"return confirm('确定要删除吗?');\">删除</a></TD>\r\n    </TR>\r\n\t";
				$pricehj += $rs['price'];
		}
		echo "\t<TR align=\"center\" bgcolor=\"#FFFFFF\">\r\n      <TD colspan=\"6\">合计：";
		echo $pricehj;
		echo " 元</TD>\r\n    </TR>\r\n    <TR align=\"center\" bgcolor=\"#f8fbfb\">\r\n      <TD colspan=\"6\">";
		include_once( dirname( __FILE__ )."/../inc/page_class.php" );
		$page = new page( array(
				"total" => $intnum,
				"perpage" => $intpage
		) );
		echo $page->show( 4, "page", "curr" );
		echo "</TD>\r\n    </TR>\r\n  </TBODY>\r\n</TABLE>\r\n<script language=\"JavaScript\" src=\"inc/calendar.js\"></script>\r\n";
}

function look( )
{
		global $db;
		global $web_dbtop;
		echo "<TABLE width=\"96%\" border=0 align=center cellpadding=\"5\" cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n  <TBODY>\r\n    <TR bgColor=\"#f5fafe\">\r\n      <TD width=\"20%\" align=\"center\">订单号</TD>\r\n      <TD align=\"center\">充值卡类型</TD>\r\n      <TD width=\"20%\" align=\"center\">数量</TD>\r\n      <TD width=\"20%\" align=\"center\">价格</TD>\r\n    </TR>\r\n    ";
		$query = $db->query( "Select * from ".$web_dbtop."paylogc where orderid='".str_check( $_GET['orderid'] )."' Order by id asc" );
		while ( $rs = $db->fetch_array( $query ) )
		{
				echo "    <TR bgcolor=\"#FFFFFF\">\r\n      <TD align=\"center\">";
				echo $rs['orderid'];
				echo "</TD>\r\n      <TD align=\"center\">";
				echo $rs['cardname'];
				echo "</TD>\r\n      <TD align=\"center\">";
				echo $rs['cardnum'];
				echo "</TD>\r\n      <TD align=\"center\">";
				echo $rs['price'];
				echo " 元</TD>\r\n    </TR>\r\n    ";
		}
		echo "  </TBODY>\r\n</TABLE>\r\n";
}

include_once( dirname( __FILE__ )."/../inc/conn.php" );
include_once( dirname( __FILE__ )."/inc/function.php" );
login_check( "pay" );
echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd\">\r\n<HTML xmlns=\"http://www.w3.org/1999/xhtml\">\r\n<HEAD>\r\n<TITLE>支付订单--雷风积分游戏系统</TITLE>\r\n<META http-equiv=Content-Type content=\"text/html; charset=gb2312\">\r\n<LINK href=\"images/css_body.css\" type=text/css rel=stylesheet>\r\n<META content=\"MSHTML 6.00.3790.4275\" name=GENERATOR>\r\n</HEAD>\r\n<BODY>\r\n<DIV class=bodytitle>\r\n<DIV class=bodytitleleft></DIV>\r\n<DIV class=bodytitletxt>支付记录</DIV>\r\n</DIV>\r\n";
switch ( $_GET['action'] )
{
case "del" :
		del( );
		addlog( "支付订单删除成功" );
		showerr( "支付订单删除成功", "admin_paylog.php" );
		break;
case "look" :
		look( );
		break;
default :
		main( );
}
echo "</BODY>\r\n</HTML>\r\n";
?>
