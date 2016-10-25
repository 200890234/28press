<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/

function sadd( )
{
		global $db;
		global $web_dbtop;
		$db->query( "INSERT INTO ".$web_dbtop."adsp (title,type,points,dailynum,adpic,adurl,time) VALUES ('".$_POST['title']."',2,".$_POST['points'].",".$_POST['dailynum'].",'".$_POST['adpic']."','".$_POST['adurl']."','".date( "Y-m-d H:i:s" )."')" );
}

function sedit( )
{
		global $db;
		global $web_dbtop;
		$db->query( "update ".$web_dbtop."adsp set title='".$_POST['title']."',points=".$_POST['points'].",dailynum=".$_POST['dailynum'].",adpic='".$_POST['adpic']."',adurl='".$_POST['adurl']."' where id=".$_POST['id'] );
}

function del( )
{
		global $db;
		global $web_dbtop;
		global $web_adpicdir;
		$query = $db->query( "Select adpic from ".$web_dbtop."adsp where type=2 and id={$_GET['id']}" );
		if ( $rs = $db->fetch_array( $query ) )
		{
				deletefile( "../".$web_adpicdir.$rs['adpic'] );
		}
		$db->query( "delete from ".$web_dbtop."adsp where type=2 and id={$_GET['id']}" );
		$db->query( "delete from ".$web_dbtop."adip where type=2 and adid={$_GET['id']}" );
}

function main( )
{
		global $db;
		global $web_dbtop;
		echo "<TABLE width=\"96%\" border=0 align=center cellpadding=\"5\" cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n  <TBODY>\r\n    <TR bgColor=\"#f5fafe\">\r\n      <TD align=\"center\" bgcolor=\"#f5fafe\">消费体验广告标题</TD>\r\n      <TD width=\"20%\" align=\"center\">发布时间</TD>\r\n      <TD width=\"15%\" align=\"center\">操作</TD>\r\n    </TR>\r\n\t";
		$intpage = 20;
		if ( isset( $_GET['page'] ) )
		{
				$rsnum = ( $_GET['page'] - 1 ) * $intpage;
		}
		else
		{
				$rsnum = 0;
		}
		$query = $db->query( "Select * from ".$web_dbtop."adsp where type=2 Order by id desc" );
		if ( $db->fetch_array( $query ) )
		{
				$intnum = $db->num_rows( $query );
		}
		$query = $db->query( "Select * from ".$web_dbtop."adsp where type=2 Order by id desc limit {$rsnum},{$intpage}" );
		while ( $rs = $db->fetch_array( $query ) )
		{
				echo "    <TR bgcolor=\"#FFFFFF\">\r\n      <TD>";
				echo $rs['title'];
				echo "</TD>\r\n      <TD align=\"center\">";
				echo $rs['time'];
				echo "</TD>\r\n      <TD align=\"center\"><A href=\"admin_adcps.php?action=edit&id=";
				echo $rs['id'];
				echo "\">修改</a> | <A href=\"admin_adcps.php?action=del&id=";
				echo $rs['id'];
				echo "\" onClick=\"return confirm('确定要删除吗?');\">删除</a></TD>\r\n    </TR>\r\n\t";
		}
		echo "    <TR align=\"center\" bgcolor=\"#f8fbfb\">\r\n      <TD colspan=\"3\">";
		include_once( dirname( __FILE__ )."/../inc/page_class.php" );
		$page = new page( array(
				"total" => $intnum,
				"perpage" => $intpage
		) );
		echo $page->show( 4, "page", "curr" );
		echo "</TD>\r\n    </TR>\r\n  </TBODY>\r\n</TABLE>\r\n";
}

function add( )
{
		global $web_adpicdir;
		global $web_moneyname;
		echo "<TABLE width=\"96%\" border=0 align=center cellpadding=\"4\" cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n<form action=\"?action=sadd\" method=\"post\" name=\"form\" onSubmit=\"return Validator.Validate(this,3)\">\r\n  <TBODY>\r\n    <TR>\r\n      <TD vAlign=center width=\"20%\" bgColor=#f5fafe>消费体验广告标题：</TD>\r\n      <TD bgColor=#ffffff><INPUT id=\"title\" size=50 value=\"\" name=\"title\" dataType=\"Require\" msg=\"请填写消费体验广告标题\"></TD>\r\n    </TR>\r\n    <TR>\r\n      <TD bgColor=#f5fafe>消费体验广告奖励：</TD>\r\n      <TD bgColor=#ffffff><INPUT id=\"points\" size=50 value=\"\" name=\"points\" dataType=\"Integer\" msg=\"消费体验广告奖励格式不正确\"> ";
		echo $web_moneyname;
		echo "</TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>每日注册次数：</TD>\r\n      <TD bgColor=#ffffff><INPUT id=\"dailynum\" size=50 value=\"\" name=\"dailynum\" dataType=\"Integer\" msg=\"每日答题次数式不正确\"> \r\n        次</TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>消费体验广告图片：</TD>\r\n      <TD bgColor=#ffffff><INPUT id=\"adpic\" size=50 value=\"\" name=\"adpic\" dataType=\"Require\" msg=\"请填写消费体验广告图片\"></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>图片上传：</TD>\r\n      <TD bgColor=#ffffff><iframe src=\"inc/upadpic.php?urldir=";
		echo $web_adpicdir;
		echo "&picname=adpic\" width=\"600\" height=\"25\" frameborder=\"0\" scrolling=\"no\"></iframe></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>消费体验广告地址：</TD>\r\n      <TD bgColor=#ffffff><INPUT id=\"adurl\" size=50 value=\"\" name=\"adurl\" dataType=\"Require\" msg=\"请填写消费体验广告地址\"></TD>\r\n    </TR>\r\n    <TR align=\"center\" bgcolor=\"#f8fbfb\">\r\n      <TD colspan=\"2\"><INPUT class=inputbut type=submit value=添加 name=Submit></TD>\r\n    </TR>\r\n  </TBODY>\r\n  </form>\r\n</TABLE>\r\n<script language=\"javascript\" src=\"inc/js.js\"></script>\r\n";
}

function edit( )
{
		global $db;
		global $web_dbtop;
		global $web_adpicdir;
		global $web_moneyname;
		$query = $db->query( "Select * from ".$web_dbtop."adsp where type=2 and id={$_GET['id']}" );
		if ( $rs = $db->fetch_array( $query ) )
		{
				echo "<TABLE width=\"96%\" border=0 align=center cellpadding=\"4\" cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n<form action=\"?action=sedit\" method=\"post\" onSubmit=\"return Validator.Validate(this,3)\">\r\n<input name=\"id\" type=\"hidden\" value=\"";
				echo $rs['id'];
				echo "\">\r\n  <TBODY>\r\n    <TR>\r\n      <TD vAlign=center width=\"20%\" bgColor=#f5fafe>消费体验广告标题：</TD>\r\n      <TD bgColor=#ffffff><INPUT id=\"title\" size=50 value=\"";
				echo $rs['title'];
				echo "\" name=\"title\" dataType=\"Require\" msg=\"请填写消费体验广告标题\"></TD>\r\n    </TR>\r\n    <TR>\r\n      <TD bgColor=#f5fafe>消费体验广告奖励：</TD>\r\n      <TD bgColor=#ffffff><INPUT id=\"points\" size=50 value=\"";
				echo $rs['points'];
				echo "\" name=\"points\" dataType=\"Integer\" msg=\"消费体验广告奖励格式不正确\"> ";
				echo $web_moneyname;
				echo "</TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>每日注册次数：</TD>\r\n      <TD bgColor=#ffffff><INPUT id=\"dailynum\" size=50 value=\"";
				echo $rs['dailynum'];
				echo "\" name=\"dailynum\" dataType=\"Integer\" msg=\"每日答题次数式不正确\"> \r\n        次</TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>消费体验广告图片：</TD>\r\n      <TD bgColor=#ffffff><INPUT id=\"adpic\" size=50 value=\"";
				echo $rs['adpic'];
				echo "\" name=\"adpic\" dataType=\"Require\" msg=\"请填写消费体验广告图片\"></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>图片上传：</TD>\r\n      <TD bgColor=#ffffff><iframe src=\"inc/upadpic.php?urldir=";
				echo $web_adpicdir;
				echo "&picname=adpic\" width=\"600\" height=\"25\" frameborder=\"0\" scrolling=\"no\"></iframe></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>消费体验广告地址：</TD>\r\n      <TD bgColor=#ffffff><INPUT id=\"adurl\" size=50 value=\"";
				echo $rs['adurl'];
				echo "\" name=\"adurl\" dataType=\"Require\" msg=\"请填写消费体验广告地址\"></TD>\r\n    </TR>\r\n    <TR align=\"center\" bgcolor=\"#f8fbfb\">\r\n      <TD colspan=\"2\"><INPUT class=inputbut type=submit value=修改 name=Submit></TD>\r\n    </TR>\r\n  </TBODY>\r\n  </form>\r\n</TABLE>\r\n<script language=\"javascript\" src=\"inc/js.js\"></script>\r\n";
		}
}

include_once( dirname( __FILE__ )."/../inc/conn.php" );
include_once( dirname( __FILE__ )."/inc/function.php" );
login_check( "adgl" );
echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd\">\r\n<HTML xmlns=\"http://www.w3.org/1999/xhtml\">\r\n<HEAD>\r\n<TITLE>消费体验广告管理--雷风积分游戏系统</TITLE>\r\n<META http-equiv=Content-Type content=\"text/html; charset=gb2312\">\r\n<LINK href=\"images/css_body.css\" type=text/css rel=stylesheet>\r\n<META content=\"MSHTML 6.00.3790.4275\" name=GENERATOR>\r\n</HEAD>\r\n<BODY>\r\n<DIV class=bodytitle>\r\n<DIV class=bodytitleleft></DIV>\r\n<DIV class=bodytitletxt>消费体验广告管理</DIV>\r\n<DIV class=bodytitletxt2><a href=\"admin_adcps.php?action=add\">添加消费体验广告</a></DIV>\r\n</DIV>\r\n";
switch ( $_GET['action'] )
{
case "add" :
		add( );
		break;
case "sadd" :
		sadd( );
		addlog( "网站消费体验广告添加成功" );
		showerr( "网站消费体验广告添加成功", "admin_adcps.php" );
		break;
case "edit" :
		edit( );
		break;
case "sedit" :
		sedit( );
		addlog( "网站消费体验广告修改成功" );
		showerr( "网站消费体验广告修改成功", "admin_adcps.php" );
		break;
case "del" :
		del( );
		addlog( "网站消费体验广告删除成功" );
		showerr( "网站消费体验广告删除成功", "admin_adcps.php" );
		break;
default :
		main( );
}
echo "</BODY></HTML>\r\n";
?>
