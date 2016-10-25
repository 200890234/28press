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
		$db->query( "INSERT INTO ".$web_dbtop."link (webname,weburl,webcontent,sort) VALUES ('".$_POST['webname']."','".$_POST['weburl']."','".$_POST['webcontent'].( "',".$_POST['sort'].")" ) );
}

function sedit( )
{
		global $db;
		global $web_dbtop;
		$db->query( "update ".$web_dbtop."link set webname='".$_POST['webname']."',weburl='".$_POST['weburl']."',webcontent='".$_POST['webcontent'].( "',sort=".$_POST['sort']." where id={$_POST['id']}" ) );
}

function linksort( )
{
		global $db;
		global $web_dbtop;
		$i = 0;
		for ( ;	$i < count( $_POST['id'] );	++$i	)
		{
				$id = $_POST['id'][$i];
				$db->query( "update ".$web_dbtop."link set sort=".$_POST["sort_".$id].( " where id=".$id ) );
		}
}

function del( )
{
		global $db;
		global $web_dbtop;
		$db->query( "delete from ".$web_dbtop."link where id={$_GET['id']}" );
}

function main( )
{
		global $db;
		global $web_dbtop;
		echo "<TABLE width=\"96%\" border=0 align=center cellpadding=\"5\" cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n  <TBODY>\r\n    <TR bgColor=\"#f5fafe\">\r\n      <TD width=\"4%\" align=\"center\" >&nbsp;</TD>\r\n      <TD align=\"center\">网站名称</TD>\r\n      <TD align=\"center\">网站地址</TD>\r\n      <TD width=\"20%\" align=\"center\">网站LOGO</TD>\r\n      <TD width=\"8%\" align=\"center\">排序</TD>\r\n      <TD width=\"15%\" align=\"center\">操作</TD>\r\n    </TR>\r\n  <form action=\"?action=sort\" method=\"post\" name=\"form\">\r\n\t";
		$intpage = 20;
		if ( isset( $_GET['page'] ) )
		{
				$rsnum = ( $_GET['page'] - 1 ) * $intpage;
		}
		else
		{
				$rsnum = 0;
		}
		$query = $db->query( "Select * from ".$web_dbtop."link Order by id desc" );
		if ( $db->fetch_array( $query ) )
		{
				$intnum = $db->num_rows( $query );
		}
		$query = $db->query( "Select * from ".$web_dbtop."link Order by sort asc,id desc limit {$rsnum},{$intpage}" );
		while ( $rs = $db->fetch_array( $query ) )
		{
				echo "    <TR bgcolor=\"#FFFFFF\">\r\n      <TD align=\"center\"><input name=\"id[]\" type=\"checkbox\" id=\"id[]\" value=\"";
				echo $rs['id'];
				echo "\" checked></TD>\r\n      <TD align=\"center\">";
				echo $rs['webname'];
				echo "</TD>\r\n      <TD align=\"center\">";
				echo $rs['weburl'];
				echo "</TD>\r\n      <TD align=\"center\">";
				if ( $rs['linktype'] == 0 )
				{
						echo "文字链接";
				}
				else
				{
						echo "<img src=\"".$rs['weblogo']."\" width=\"88\" height=\"31\">";
				}
				echo "</TD>\r\n      <TD align=\"center\"><INPUT id=sort_";
				echo $rs['id'];
				echo " size=5 name=sort_";
				echo $rs['id'];
				echo " value=\"";
				echo $rs['sort'];
				echo "\"></TD>\r\n      <TD align=\"center\"><A href=\"admin_link.php?action=edit&id=";
				echo $rs['id'];
				echo "\">修改</a> | <A href=\"admin_link.php?action=del&id=";
				echo $rs['id'];
				echo "\" onClick=\"return confirm('确定要删除吗?');\">删除</a></TD>\r\n    </TR>\r\n\t";
		}
		echo "\t<TR bgcolor=\"#FFFFFF\">\r\n      <TD colspan=\"6\" align=\"center\"><INPUT class=inputbut type=submit value=批量修改选中链接排序 name=Submit></TD>\r\n    </TR>\r\n  </form>\r\n    <TR align=\"center\" bgcolor=\"#f8fbfb\">\r\n      <TD colspan=\"6\">";
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
		echo "<TABLE width=\"96%\" border=0 align=center cellpadding=\"4\" cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n <form action=\"?action=sadd\" method=\"post\" onfunctionmit=\"return Validator.Validate(this,3)\">\r\n  <TBODY>\r\n    <TR>\r\n      <TD vAlign=center width=\"20%\" bgColor=#f5fafe>网站名称：</TD>\r\n      <TD bgColor=#ffffff><INPUT id=webname size=50 name=webname dataType=\"Require\" msg=\"请填写网站名称\"></TD>\r\n    </TR>\r\n    <TR>\r\n      <TD bgColor=#f5fafe>网站地址：</TD>\r\n      <TD bgColor=#ffffff><INPUT id=weburl size=50 name=weburl dataType=\"Require\" msg=\"请填写网站地址\"></TD>\r\n    </TR>\r\n    <TR>\r\n      <TD bgColor=#f5fafe>排序：</TD>\r\n      <TD bgColor=#ffffff><INPUT name=sort id=sort value=\"0\" size=50 dataType=\"Integer\" msg=\"排序只能为数字\"></TD>\r\n    </TR>\r\n    <TR>\r\n      <TD bgColor=#f5fafe>网站介绍：</TD>\r\n      <TD bgColor=#ffffff><textarea name=\"webcontent\" cols=\"50\" rows=\"4\" id=\"webcontent\"></textarea></TD>\r\n    </TR>\r\n    <TR align=\"center\" bgcolor=\"#f8fbfb\">\r\n      <TD colspan=\"2\"><INPUT class=inputbut type=submit value=添加 name=submit></TD>\r\n    </TR>\r\n  </TBODY>\r\n  </form>\r\n</TABLE>\r\n<script language=\"javascript\" src=\"inc/js.js\"></script>\r\n<script language=\"javascript\">\r\nfunction SelectType(value,name)\r\n{\r\n\tif (value == 0)\r\n\t{\r\n\t\tdocument.getElementById(name).style.display=\"none\";\r\n\t\t}\r\n\telse\r\n\t{\r\n\t\tdocument.getElementById(name).style.display=\"block\";\r\n\t\t}\r\n}\r\n</script>\r\n";
}

function edit( )
{
		global $db;
		global $web_dbtop;
		$query = $db->query( "Select * from ".$web_dbtop."link where id={$_GET['id']}" );
		if ( $rs = $db->fetch_array( $query ) )
		{
				echo "<TABLE width=\"96%\" border=0 align=center cellpadding=\"4\" cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n  <form action=\"?action=sedit\" method=\"post\" onfunctionmit=\"return Validator.Validate(this,3)\">\r\n  <input name=\"id\" type=\"hidden\" value=\"";
				echo $rs['id'];
				echo "\">\r\n    <TBODY>\r\n      <TR>\r\n        <TD vAlign=center width=\"20%\" bgColor=#f5fafe>网站名称：</TD>\r\n        <TD bgColor=#ffffff><INPUT id=webname size=50 name=webname value=\"";
				echo $rs['webname'];
				echo "\" dataType=\"Require\" msg=\"请填写网站名称\"></TD>\r\n      </TR>\r\n      <TR>\r\n        <TD bgColor=#f5fafe>网站地址：</TD>\r\n        <TD bgColor=#ffffff><INPUT id=weburl size=50 name=weburl value=\"";
				echo $rs['weburl'];
				echo "\" dadataType=\"Url\" msg=\"请填写正确的地址带有http://头\"></TD>\r\n      </TR>\r\n      <TR>\r\n        <TD bgColor=#f5fafe>排序：</TD>\r\n        <TD bgColor=#ffffff><INPUT name=sort id=sort value=\"";
				echo $rs['sort'];
				echo "\" size=50 dataType=\"Integer\" msg=\"排序只能为数字\"></TD>\r\n      </TR>\r\n      <TR>\r\n        <TD bgColor=#f5fafe>网站介绍：</TD>\r\n        <TD bgColor=#ffffff><textarea name=\"webcontent\" cols=\"50\" rows=\"4\" id=\"webcontent\">";
				echo $rs['webcontent'];
				echo "</textarea></TD>\r\n      </TR>\r\n      <TR align=\"center\" bgcolor=\"#f8fbfb\">\r\n        <TD colspan=\"2\"><INPUT class=inputbut type=submit value=修改 name=submit>\r\n&nbsp;</TD>\r\n      </TR>\r\n    </TBODY>\r\n  </form>\r\n</TABLE>\r\n<script language=\"javascript\" src=\"inc/js.js\"></script>\r\n<script language=\"javascript\">\r\nSelectType(";
				echo $rs['linktype'];
				echo ",'logo');\r\nfunction SelectType(value,name)\r\n{\r\n\tif (value == 0)\r\n\t{\r\n\t\tdocument.getElementById(name).style.display=\"none\";\r\n\t\t}\r\n\telse\r\n\t{\r\n\t\tdocument.getElementById(name).style.display=\"block\";\r\n\t\t}\r\n}\r\n</script>\r\n";
		}
}

include_once( dirname( __FILE__ )."/../inc/conn.php" );
include_once( dirname( __FILE__ )."/inc/function.php" );
login_check( "system" );
echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd\">\r\n<HTML xmlns=\"http://www.w3.org/1999/xhtml\">\r\n<HEAD>\r\n<TITLE>友情链接管理--雷风积分游戏系统</TITLE>\r\n<META http-equiv=Content-Type content=\"text/html; charset=gb2312\">\r\n<LINK href=\"images/css_body.css\" type=text/css rel=stylesheet>\r\n<META content=\"MSHTML 6.00.3790.4275\" name=GENERATOR>\r\n</HEAD>\r\n<BODY>\r\n<DIV class=bodytitle>\r\n<DIV class=bodytitleleft></DIV>\r\n<DIV class=bodytitletxt>友情链接管理</DIV>\r\n<DIV class=bodytitletxt2><a href=\"admin_link.php?action=add\">添加友情链接</a></DIV>\r\n</DIV>\r\n";
switch ( $_GET['action'] )
{
case "add" :
		add( );
		break;
case "sadd" :
		sadd( );
		addlog( "友情链接添加成功" );
		showerr( "友情链接添加成功", "admin_link.php" );
		break;
case "edit" :
		edit( );
		break;
case "sedit" :
		sedit( );
		addlog( "友情链接修改成功" );
		showerr( "友情链接修改成功", "admin_link.php" );
		break;
case "sort" :
		linksort( );
		addlog( "友情链接排序修改成功" );
		showerr( "友情链接排序修改成功", "admin_link.php" );
case "del" :
		del( );
		addlog( "友情链接删除成功" );
		showerr( "友情链接删除成功", "admin_link.php" );
		break;
default :
		main( );
}
echo "</BODY></HTML>\r\n";
?>
