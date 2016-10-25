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
		if ( isset( $_POST['id'] ) )
		{
				$id = implode( ",", $_POST['id'] );
		}
		else
		{
				$id = $_GET['id'];
		}
		$db->query( "delete from ".$web_dbtop."msg where id in ({$id})" );
}

function main( )
{
		global $db;
		global $web_dbtop;
		echo "<TABLE width=\"96%\" border=0 align=center cellpadding=0 cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n  <TBODY>\r\n    <TR>\r\n      <TD bgColor=#f5fafe><table width=\"96%\" border=\"0\" align=\"center\" cellpadding=\"3\" cellspacing=\"1\">\r\n          <tr>\r\n            <form action=\"admin_smslog.php\" method=\"get\">\r\n              <td width=\"15%\"><strong>搜索发送id：</strong></td>\r\n              <td width=\"21%\"><input id=keyword size=20 name=keyword></td>\r\n              <td width=\"5%\" align=\"center\" ><INPUT class=inputbut type=submit value=搜索 name=Submit></td>\r\n\t\t    </form>\r\n\t\t\t  <form action=\"admin_smslog.php\" method=\"get\">\r\n              <td width=\"15%\" align=\"center\"><STRONG>日期查询</STRONG>：</td>\r\n              <td width=\"21%\" align=\"center\"><input id=stopdate size=15 name=stopdate onfocus=setday(this) readOnly>\r\n                  <IMG onclick=stopdate.focus() src=\"images/calendar.gif\" align=absBottom></td>\r\n              <td><INPUT class=inputbut type=submit value=搜索 name=Submit></td>\r\n            </form>\r\n          </tr>\r\n      </table></TD>\r\n    </TR>\r\n  </TBODY>\r\n</TABLE>\r\n<TABLE width=\"96%\" border=0 align=center cellpadding=\"5\" cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n  <form name=\"form\" method=\"post\">\r\n  <TBODY>\r\n    <TR bgColor=\"#f5fafe\">\r\n\t  <TD width=\"4%\" align=\"center\"></TD>\r\n      <TD width=\"20%\" align=\"center\">收信人</TD>\r\n\t  <TD align=\"center\">主题</TD>\r\n\t  <TD width=\"15%\" align=\"center\">状态</TD>\r\n\t  <TD width=\"20%\" align=\"center\">时间</TD>\r\n\t  <TD width=\"10%\" align=\"center\">操作</TD>\r\n    </TR>\r\n\t";
		$intpage = 20;
		if ( isset( $_GET['page'] ) )
		{
				$rsnum = ( $_GET['page'] - 1 ) * $intpage;
		}
		else
		{
				$rsnum = 0;
		}
		$sql = "Select * from ".$web_dbtop."msg where usersid=0";
		$query = $db->query( $sql." Order by id desc" );
		if ( $db->fetch_array( $query ) )
		{
				$intnum = $db->num_rows( $query );
		}
		if ( isset( $_GET['keyword'] ) )
		{
				$sql .= " and mid=".intval( $_GET['keyword'] )."";
		}
		if ( isset( $_GET['stopdate'] ) )
		{
				$sql .= " and STR_TO_DATE(time,'%Y-%m-%d')='".$_GET['stopdate']."'";
		}
		$query = $db->query( $sql.( " Order by id desc limit ".$rsnum.",{$intpage}" ) );
		while ( $rs = $db->fetch_array( $query ) )
		{
				echo "    <TR bgcolor=\"#FFFFFF\">\r\n\t  <TD align=\"center\"><input type=\"checkbox\" name=\"id[]\" value=\"";
				echo $rs['id'];
				echo "\"></TD>\r\n      <TD align=\"center\">";
				echo $rs['mid'];
				echo "</TD>\r\n\t  <TD align=\"center\">";
				echo $rs['title'];
				echo "</TD>\r\n\t  <TD align=\"center\">";
				echo $rs['look'] == 1 ? "以查看" : "未查看";
				echo "</TD>\r\n\t  <TD align=\"center\">";
				echo $rs['time'];
				echo "</TD>\r\n\t  <TD align=\"center\"><A href=\"admin_smslog.php?action=del&id=";
				echo $rs['id'];
				echo "\" onClick=\"return confirm('确定要删除吗?');\">删除</a></TD>\r\n    </TR>\r\n\t";
		}
		echo "\t<TR bgcolor=\"#f8fbfb\">\r\n      <TD align=\"center\"><input name=\"chkall\" type=\"checkbox\" id=\"chkall\" value=\"checkbox\" onClick=\"CheckAll(document.form.chkall.checked);\"/></TD>\r\n      <TD colspan=\"7\"><input type=\"button\" name=\"del\" value=\"批量删除\"  onClick=\"document.form.action='?action=del';{if(chkCheckBoxChs('id[]')==false){alert('请至少选择一个记录！');return;}};{if(confirm('确定删除您所选择的记录吗？')){this.document.form.submit();return true;}}\" class=inputbut></TD>\r\n    </TR>\r\n    <TR align=\"center\" bgcolor=\"#f8fbfb\">\r\n      <TD colspan=\"6\">";
		include_once( dirname( __FILE__ )."/../inc/page_class.php" );
		$page = new page( array(
				"total" => $intnum,
				"perpage" => $intpage
		) );
		echo $page->show( 4, "page", "curr" );
		echo "</TD>\r\n    </TR>\r\n  </TBODY>\r\n  </form>\r\n</TABLE>\r\n<script language=\"javascript\" src=\"inc/movie.js\"></script>\r\n<script language=\"JavaScript\" src=\"inc/calendar.js\"></script>\r\n";
}

include_once( dirname( __FILE__ )."/../inc/conn.php" );
include_once( dirname( __FILE__ )."/inc/function.php" );
login_check( "sms" );
echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd\">\r\n<HTML xmlns=\"http://www.w3.org/1999/xhtml\">\r\n<HEAD>\r\n<TITLE>短信记录--雷风积分游戏系统</TITLE>\r\n<META http-equiv=Content-Type content=\"text/html; charset=gb2312\">\r\n<LINK href=\"images/css_body.css\" type=text/css rel=stylesheet>\r\n<META content=\"MSHTML 6.00.3790.4275\" name=GENERATOR>\r\n</HEAD>\r\n<BODY>\r\n<DIV class=bodytitle>\r\n<DIV class=bodytitleleft></DIV>\r\n<DIV class=bodytitletxt>短信记录</DIV>\r\n</DIV>\r\n";
switch ( $_GET['action'] )
{
case "del" :
		del( );
		addlog( "短信删除成功" );
		showerr( "短信删除成功", "admin_smslog.php" );
		break;
default :
		main( );
}
echo "</BODY>\r\n</HTML>\r\n";
?>
