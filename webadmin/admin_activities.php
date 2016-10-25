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
		$db->query( "INSERT INTO ".$web_dbtop."activities (name,pic,time,dx,zt,url) VALUES ('".$_POST['name']."','".$_POST['pic']."','".$_POST['time']."','".$_POST['dx']."',".$_POST['zt'].",'".$_POST['url']."')" );
}

function sedit( )
{
		global $db;
		global $web_dbtop;
		$db->query( "update ".$web_dbtop."activities set name='".$_POST['name']."',pic='".$_POST['pic']."',time='".$_POST['time']."',dx='".$_POST['dx']."',zt=".$_POST['zt'].",url='".$_POST['url'].( "' where id=".$_POST['id'] ) );
}

function del( )
{
		global $db;
		global $web_dbtop;
		$db->query( "delete from ".$web_dbtop."activities where id={$_GET['id']}" );
}

function main( )
{
		global $db;
		global $web_dbtop;
		echo "<TABLE width=\"96%\" border=0 align=center cellpadding=\"5\" cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n  <TBODY>\r\n    <TR  bgColor=\"#f5fafe\">\r\n\t  <TD align=\"center\">活动名称</TD>\r\n      <TD width=\"20%\" align=\"center\">活动时间</TD>\r\n      <TD width=\"20%\" align=\"center\">参加对象</TD>\r\n      <TD width=\"12%\" align=\"center\">状态</TD>\r\n      <TD width=\"15%\" align=\"center\">操作</TD>\r\n    </TR>\r\n\t";
		$intpage = 20;
		if ( isset( $_GET['page'] ) )
		{
				$rsnum = ( $_GET['page'] - 1 ) * $intpage;
		}
		else
		{
				$rsnum = 0;
		}
		$query = $db->query( "Select * from ".$web_dbtop."activities Order by id desc" );
		if ( $db->fetch_array( $query ) )
		{
				$intnum = $db->num_rows( $query );
		}
		$query = $db->query( "Select * from ".$web_dbtop."activities Order by id desc limit {$rsnum},{$intpage}" );
		while ( $rs = $db->fetch_array( $query ) )
		{
				echo "    <TR bgcolor=\"#FFFFFF\">\r\n\t  <TD align=\"center\">";
				echo $rs['name'];
				echo "</TD>\r\n      <TD align=\"center\">";
				echo $rs['time'];
				echo "</TD>\r\n      <TD align=\"center\">";
				echo $rs['dx'];
				echo "</TD>\r\n      <TD align=\"center\">";
				echo $rs['zt'] == 1 ? "已结束" : "进行中";
				echo "</TD>\r\n      <TD align=\"center\"><A href=\"admin_activities.php?action=edit&id=";
				echo $rs['id'];
				echo "\">修改</a> | <A href=\"admin_activities.php?action=del&id=";
				echo $rs['id'];
				echo "\" onClick=\"return confirm('确定要删除吗?');\">删除</a></TD>\r\n    </TR>\r\n\t";
		}
		echo "\t<TR align=\"center\" bgcolor=\"#f8fbfb\">\r\n      <TD colspan=\"5\">";
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
		global $web_activitiesdir;
		echo "<TABLE width=\"96%\" border=0 align=center cellpadding=\"4\" cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n<form action=\"?action=sadd\" method=\"post\" onSubmit=\"return Validator.Validate(this,3)\">\r\n  <TBODY>\r\n  \t<TR>\r\n      <TD vAlign=center width=\"20%\" bgColor=#f5fafe>活动名称：</TD>\r\n      <TD bgColor=#ffffff><INPUT id=\"name\" size=50 value=\"\" name=\"name\" dataType=\"Require\" msg=\"请输入活动名称\"></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD vAlign=center width=\"20%\" bgColor=#f5fafe>活动图片：</TD>\r\n      <TD bgColor=#ffffff><INPUT id=\"pic\" size=50 value=\"\" name=\"pic\" dataType=\"Require\" msg=\"请输入活动图片\"></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>图片上传：</TD>\r\n      <TD bgColor=#ffffff><iframe src=\"inc/upadpic.php?urldir=";
		echo $web_activitiesdir;
		echo "&picname=pic\" width=\"600\" height=\"25\" frameborder=\"0\" scrolling=\"no\"></iframe></TD>\r\n    </TR>\r\n    <TR>\r\n      <TD vAlign=center width=\"20%\" bgColor=#f5fafe>活动时间：</TD>\r\n      <TD bgColor=#ffffff><INPUT id=\"time\" size=50 value=\"\" name=\"time\" dataType=\"Require\" msg=\"请输入活动时间\"></TD>\r\n    </TR>\r\n    <TR>\r\n      <TD bgColor=#f5fafe>参加对象：</TD>\r\n      <TD bgColor=#ffffff><INPUT id=\"dx\" size=50 value=\"\" name=\"dx\" dataType=\"Require\" msg=\"请输入参加对象\"></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>状态：</TD>\r\n      <TD bgColor=#ffffff><select name=\"zt\">\r\n        <option value=\"0\">进行中</option>\r\n        <option value=\"1\">已结束</option>\r\n      </select></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>活动页面URL：</TD>\r\n      <TD bgColor=#ffffff><INPUT id=\"url\" size=50 value=\"\" name=\"url\" dataType=\"Require\" msg=\"请输入活动页面URL\"></TD>\r\n    </TR>\r\n    <TR align=\"center\" bgcolor=\"#f8fbfb\">\r\n      <TD colspan=\"2\"><INPUT class=inputbut type=submit value=添加 name=Submit>\r\n      &nbsp;</TD>\r\n    </TR>\r\n  </TBODY>\r\n  </form>\r\n</TABLE>\r\n<script language=\"javascript\" src=\"inc/js.js\"></script>\r\n";
}

function edit( )
{
		global $db;
		global $web_dbtop;
		global $web_activitiesdir;
		$query = $db->query( "Select * from ".$web_dbtop."activities where id={$_GET['id']}" );
		if ( $rs = $db->fetch_array( $query ) )
		{
				echo "<TABLE width=\"96%\" border=0 align=center cellpadding=\"4\" cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n  <form action=\"?action=sedit\" method=\"post\" onSubmit=\"return Validator.Validate(this,3)\">\r\n  <input name=\"id\" type=\"hidden\" value=\"";
				echo $rs['id'];
				echo "\">\r\n    <TBODY>\r\n\t<TR>\r\n      <TD vAlign=center width=\"20%\" bgColor=#f5fafe>活动名称：</TD>\r\n      <TD bgColor=#ffffff><INPUT id=\"name\" size=50 value=\"";
				echo $rs['name'];
				echo "\" name=\"name\" dataType=\"Require\" msg=\"请输入活动名称\"></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD vAlign=center width=\"20%\" bgColor=#f5fafe>活动图片：</TD>\r\n      <TD bgColor=#ffffff><INPUT id=\"pic\" size=50 value=\"";
				echo $rs['pic'];
				echo "\" name=\"pic\" dataType=\"Require\" msg=\"请输入活动图片\"></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>图片上传：</TD>\r\n      <TD bgColor=#ffffff><iframe src=\"inc/upadpic.php?urldir=";
				echo $web_activitiesdir;
				echo "&picname=pic\" width=\"600\" height=\"25\" frameborder=\"0\" scrolling=\"no\"></iframe></TD>\r\n    </TR>\r\n      <TR>\r\n        <TD vAlign=center width=\"20%\" bgColor=#f5fafe>活动时间：</TD>\r\n        <TD bgColor=#ffffff><INPUT id=\"time\" size=50 value=\"";
				echo $rs['time'];
				echo "\" name=\"time\" dataType=\"Require\" msg=\"请输入活动时间\"></TD>\r\n      </TR>\r\n      <TR>\r\n        <TD bgColor=#f5fafe>参加对象：</TD>\r\n        <TD bgColor=#ffffff><INPUT id=\"dx\" size=50 value=\"";
				echo $rs['dx'];
				echo "\" name=\"dx\" dataType=\"Require\" msg=\"请输入参加对象\"></TD>\r\n      </TR>\r\n      <TR>\r\n        <TD bgColor=#f5fafe>状态：</TD>\r\n        <TD bgColor=#ffffff><select name=\"zt\">\r\n            <option value=\"0\" ";
				if ( $rs['zt'] == 0 )
				{
						echo "selected";
				}
				echo ">进行中</option>\r\n            <option value=\"1\" ";
				if ( $rs['zt'] == 1 )
				{
						echo "selected";
				}
				echo ">已结束</option>\r\n        </select></TD>\r\n      </TR>\r\n      <TR>\r\n        <TD bgColor=#f5fafe>活动页面URL：</TD>\r\n        <TD bgColor=#ffffff><INPUT id=\"url\" size=50 value=\"";
				echo $rs['url'];
				echo "\" name=\"url\" dataType=\"Require\" msg=\"请输入活动页面URL\"></TD>\r\n      </TR>\r\n      <TR align=\"center\" bgcolor=\"#f8fbfb\">\r\n        <TD colspan=\"2\"><INPUT class=inputbut type=submit value=修改 name=Submit></TD>\r\n      </TR>\r\n    </TBODY>\r\n  </form>\r\n</TABLE>\r\n<script language=\"javascript\" src=\"inc/js.js\"></script>\r\n";
		}
}

include_once( dirname( __FILE__ )."/../inc/conn.php" );
include_once( dirname( __FILE__ )."/inc/function.php" );
login_check( "hdgl" );
echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd\">\r\n<HTML xmlns=\"http://www.w3.org/1999/xhtml\">\r\n<HEAD>\r\n<TITLE>活动管理--雷风积分游戏系统</TITLE>\r\n<META http-equiv=Content-Type content=\"text/html; charset=gb2312\">\r\n<LINK href=\"images/css_body.css\" type=text/css rel=stylesheet>\r\n<META content=\"MSHTML 6.00.3790.4275\" name=GENERATOR>\r\n</HEAD>\r\n<BODY>\r\n<DIV class=bodytitle>\r\n<DIV class=bodytitleleft></DIV>\r\n<DIV class=bodytitletxt>活动管理</DIV>\r\n<DIV class=bodytitletxt2><a href=\"admin_activities.php?action=add\">添加活动</a></DIV>\r\n</DIV>\r\n";
switch ( $_GET['action'] )
{
case "add" :
		add( );
		break;
case "sadd" :
		sadd( );
		addlog( "活动添加成功" );
		showerr( "活动添加成功", "admin_activities.php" );
		break;
case "edit" :
		edit( );
		break;
case "sedit" :
		sedit( );
		addlog( "活动修改成功" );
		showerr( "活动修改成功", "admin_activities.php" );
		break;
case "del" :
		del( );
		addlog( "活动删除成功" );
		showerr( "活动删除成功", "admin_activities.php" );
		break;
default :
		main( );
}
echo "</BODY></HTML>\r\n";
?>
