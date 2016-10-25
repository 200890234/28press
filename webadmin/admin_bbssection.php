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
		$db->query( "INSERT INTO ".$web_dbtop."bbs_section (name,moderators,pic,introduction,sort) VALUES ('".$_POST['name']."','".$_POST['moderators']."','".$_POST['pic']."','".$_POST['introduction']."',".$_POST['sort'].")" );
}

function sedit( )
{
		global $db;
		global $web_dbtop;
		$db->query( "update ".$web_dbtop."bbs_section set name='".$_POST['name']."',moderators='".$_POST['moderators']."',pic='".$_POST['pic']."',introduction='".$_POST['introduction']."',sort=".$_POST['sort']." where id=".$_POST['id'] );
}

function del( )
{
		global $db;
		global $web_dbtop;
		$db->query( "delete from ".$web_dbtop."bbs_section where id={$_GET['id']}" );
		$db->query( "delete from ".$web_dbtop."bbs_posts where section={$_GET['id']}" );
}

function main( )
{
		global $db;
		global $web_dbtop;
		echo "<TABLE width=\"96%\" border=0 align=center cellpadding=\"5\" cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n  <TBODY>\r\n    <TR bgColor=\"#f5fafe\">\r\n      <TD align=\"center\" bgcolor=\"#f5fafe\">论坛版块</TD>\r\n      <TD width=\"40%\" align=\"center\">版主</TD>\r\n      <TD width=\"15%\" align=\"center\">操作</TD>\r\n    </TR>\r\n\t";
		$intpage = 20;
		if ( isset( $_GET['page'] ) )
		{
				$rsnum = ( $_GET['page'] - 1 ) * $intpage;
		}
		else
		{
				$rsnum = 0;
		}
		$query = $db->query( "Select * from ".$web_dbtop."bbs_section Order by sort asc,id desc" );
		if ( $db->fetch_array( $query ) )
		{
				$intnum = $db->num_rows( $query );
		}
		$query = $db->query( "Select * from ".$web_dbtop."bbs_section Order by sort asc,id desc limit {$rsnum},{$intpage}" );
		while ( $rs = $db->fetch_array( $query ) )
		{
				$moderators = explode( ",", $rs['moderators'] );
				echo "    <TR bgcolor=\"#FFFFFF\">\r\n      <TD align=\"center\">";
				echo $rs['name'];
				echo "</TD>\r\n      <TD align=\"center\">";
				foreach ( $moderators as $usersbz )
				{
						echo showcontent( "users", "name", intval( $usersbz ) )."&nbsp;&nbsp;";
				}
				echo "\t  </TD>\r\n      <TD align=\"center\"><A href=\"admin_bbssection.php?action=edit&id=";
				echo $rs['id'];
				echo "\">修改</a> | <A href=\"admin_bbssection.php?action=del&id=";
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
		echo "<TABLE width=\"96%\" border=0 align=center cellpadding=\"4\" cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n<form action=\"?action=sadd\" method=\"post\" name=\"form\" onSubmit=\"return Validator.Validate(this,3)\">\r\n  <TBODY>\r\n    <TR>\r\n      <TD vAlign=center width=\"20%\" bgColor=#f5fafe>版块名称：</TD>\r\n      <TD bgColor=#ffffff><INPUT id=\"name\" size=50 value=\"\" name=\"name\" dataType=\"Require\" msg=\"请填写版块名称\"></TD>\r\n    </TR>\r\n    <TR>\r\n      <TD bgColor=#f5fafe>版块图标：</TD>\r\n      <TD bgColor=#ffffff><INPUT id=\"pic\" size=50 value=\"\" name=\"pic\"></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>版主：</TD>\r\n      <TD bgColor=#ffffff><INPUT id=\"moderators\" size=50 value=\"\" name=\"moderators\">\r\n填写用户编号 多版主使用,风格开 </TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>排序：</TD>\r\n      <TD bgColor=#ffffff><INPUT name=\"sort\" id=\"sort\" value=\"0\" size=50></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>介绍：</TD>\r\n      <TD bgColor=#ffffff><input name=\"introduction\" type=\"text\" style=\"height:60px;width:95%\" value=\"\"></TD>\r\n    </TR>\r\n    <TR align=\"center\" bgcolor=\"#f8fbfb\">\r\n      <TD colspan=\"2\"><INPUT class=inputbut type=submit value=添加 name=Submit></TD>\r\n    </TR>\r\n  </TBODY>\r\n  </form>\r\n</TABLE>\r\n<script language=\"javascript\" src=\"inc/js.js\"></script>\r\n";
}

function edit( )
{
		global $db;
		global $web_dbtop;
		$query = $db->query( "Select * from ".$web_dbtop."bbs_section where id={$_GET['id']}" );
		if ( $rs = $db->fetch_array( $query ) )
		{
				echo "<TABLE width=\"96%\" border=0 align=center cellpadding=\"4\" cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n  <form action=\"?action=sedit\" method=\"post\" onSubmit=\"return Validator.Validate(this,3)\">\r\n\t<input name=\"id\" type=\"hidden\" value=\"";
				echo $rs['id'];
				echo "\">\r\n    <TBODY>\r\n      <TR>\r\n        <TD vAlign=center width=\"20%\" bgColor=#f5fafe>版块名称：</TD>\r\n        <TD bgColor=#ffffff><INPUT id=\"name\" size=50 value=\"";
				echo $rs['name'];
				echo "\" name=\"name\" dataType=\"Require\" msg=\"请填写版块名称\"></TD>\r\n      </TR>\r\n      <TR>\r\n        <TD bgColor=#f5fafe>版块图标：</TD>\r\n        <TD bgColor=#ffffff><INPUT id=\"pic\" size=50 value=\"";
				echo $rs['pic'];
				echo "\" name=\"pic\"></TD>\r\n      </TR>\r\n      <TR>\r\n        <TD bgColor=#f5fafe>版主：</TD>\r\n        <TD bgColor=#ffffff><INPUT id=\"moderators\" size=50 value=\"";
				echo $rs['moderators'];
				echo "\" name=\"moderators\">\r\n        填写用户编号 多版主使用,风格开 </TD>\r\n      </TR>\r\n      <TR>\r\n        <TD bgColor=#f5fafe>排序：</TD>\r\n        <TD bgColor=#ffffff><INPUT id=\"sort\" size=50 value=\"";
				echo $rs['sort'];
				echo "\" name=\"sort\"></TD>\r\n      </TR>\r\n      <TR>\r\n        <TD bgColor=#f5fafe>介绍：</TD>\r\n        <TD bgColor=#ffffff><input name=\"introduction\" type=\"text\" style=\"height:60px;width:95%\" value=\"";
				echo $rs['introduction'];
				echo "\"></TD>\r\n      </TR>\r\n      <TR align=\"center\" bgcolor=\"#f8fbfb\">\r\n        <TD colspan=\"2\"><INPUT class=inputbut type=submit value=修改 name=Submit></TD>\r\n      </TR>\r\n    </TBODY>\r\n  </form>\r\n</TABLE>\r\n<script language=\"javascript\" src=\"inc/js.js\"></script>\r\n";
		}
}

include_once( dirname( __FILE__ )."/../inc/conn.php" );
include_once( dirname( __FILE__ )."/inc/function.php" );
login_check( "bbs" );
echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd\">\r\n<HTML xmlns=\"http://www.w3.org/1999/xhtml\">\r\n<HEAD>\r\n<TITLE>论坛版块管理--雷风积分游戏系统</TITLE>\r\n<META http-equiv=Content-Type content=\"text/html; charset=gb2312\">\r\n<LINK href=\"images/css_body.css\" type=text/css rel=stylesheet>\r\n<META content=\"MSHTML 6.00.3790.4275\" name=GENERATOR>\r\n</HEAD>\r\n<BODY>\r\n<DIV class=bodytitle>\r\n<DIV class=bodytitleleft></DIV>\r\n<DIV class=bodytitletxt>论坛版块管理</DIV>\r\n<DIV class=bodytitletxt2><a href=\"admin_bbssection.php?action=add\">添加论坛版块</a></DIV>\r\n</DIV>\r\n";
switch ( $_GET['action'] )
{
case "add" :
		add( );
		break;
case "sadd" :
		sadd( );
		addlog( "网站论坛版块添加成功" );
		showerr( "网站论坛版块添加成功", "admin_bbssection.php" );
		break;
case "edit" :
		edit( );
		break;
case "sedit" :
		sedit( );
		addlog( "网站论坛版块修改成功" );
		showerr( "网站论坛版块修改成功", "admin_bbssection.php" );
		break;
case "del" :
		del( );
		addlog( "网站论坛版块删除成功" );
		showerr( "网站论坛版块删除成功", "admin_bbssection.php" );
		break;
default :
		main( );
}
echo "</BODY></HTML>\r\n";
?>
