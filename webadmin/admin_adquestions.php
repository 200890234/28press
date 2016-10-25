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
		$db->query( "INSERT INTO ".$web_dbtop."adquestions (title,points,dailynum,adpic,questionsnum,time) VALUES ('".$_POST['title']."',".$_POST['points'].",".$_POST['dailynum'].",'".$_POST['adpic']."',".$_POST['questionsnum'].",'".date( "Y-m-d H:i:s" )."')" );
		$id = $db->insert_id( );
		$i = 1;
		for ( ;	$i <= $_POST['questionsnum'];	++$i	)
		{
				$db->query( "INSERT INTO ".$web_dbtop."adquestions_issue (adtm,adda1,adzq1,adda2,adzq2,adda3,adzq3,adda4,adzq4,addaurl,adid,adorder) VALUES ('".$_POST["adtm".$i]."','".$_POST["adda1".$i]."',".intval( $_POST["adzq1".$i] ).",'".$_POST["adda2".$i]."',".intval( $_POST["adzq2".$i] ).",'".$_POST["adda3".$i]."',".intval( $_POST["adzq3".$i] ).",'".$_POST["adda4".$i]."',".intval( $_POST["adzq4".$i] ).",'".$_POST["addaurl".$i]."',".$id.",".$i.")" );
		}
}

function sedit( )
{
		global $db;
		global $web_dbtop;
		$db->query( "update ".$web_dbtop."adquestions set title='".$_POST['title']."',points=".$_POST['points'].",dailynum=".$_POST['dailynum'].",adpic='".$_POST['adpic']."',questionsnum=".$_POST['questionsnum']." where id=".$_POST['id'] );
		$db->query( "delete from ".$web_dbtop."adquestions_issue where adid=".$_POST['id'] );
		$i = 1;
		for ( ;	$i <= $_POST['questionsnum'];	++$i	)
		{
				$db->query( "INSERT INTO ".$web_dbtop."adquestions_issue (adtm,adda1,adzq1,adda2,adzq2,adda3,adzq3,adda4,adzq4,addaurl,adid,adorder) VALUES ('".$_POST["adtm".$i]."','".$_POST["adda1".$i]."',".intval( $_POST["adzq1".$i] ).",'".$_POST["adda2".$i]."',".intval( $_POST["adzq2".$i] ).",'".$_POST["adda3".$i]."',".intval( $_POST["adzq3".$i] ).",'".$_POST["adda4".$i]."',".intval( $_POST["adzq4".$i] ).",'".$_POST["addaurl".$i]."',".$_POST['id'].",".$i.")" );
		}
}

function del( )
{
		global $db;
		global $web_dbtop;
		global $web_adpicdir;
		$query = $db->query( "Select adpic from ".$web_dbtop."adquestions where id={$_GET['id']}" );
		if ( $rs = $db->fetch_array( $query ) )
		{
				deletefile( "../".$web_adpicdir.$rs['adpic'] );
		}
		$db->query( "delete from ".$web_dbtop."adquestions where id={$_GET['id']}" );
		$db->query( "delete from ".$web_dbtop."adquestions_issue where id={$_GET['id']}" );
		$db->query( "delete from ".$web_dbtop."adip where type=1 and adid={$_GET['id']}" );
}

function main( )
{
		global $db;
		global $web_dbtop;
		echo "<TABLE width=\"96%\" border=0 align=center cellpadding=\"5\" cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n  <TBODY>\r\n    <TR bgColor=\"#f5fafe\">\r\n      <TD align=\"center\" bgcolor=\"#f5fafe\">问卷广告标题</TD>\r\n      <TD width=\"20%\" align=\"center\">发布时间</TD>\r\n      <TD width=\"15%\" align=\"center\">操作</TD>\r\n    </TR>\r\n\t";
		$intpage = 20;
		if ( isset( $_GET['page'] ) )
		{
				$rsnum = ( $_GET['page'] - 1 ) * $intpage;
		}
		else
		{
				$rsnum = 0;
		}
		$query = $db->query( "Select * from ".$web_dbtop."adquestions Order by id desc" );
		if ( $db->fetch_array( $query ) )
		{
				$intnum = $db->num_rows( $query );
		}
		$query = $db->query( "Select * from ".$web_dbtop."adquestions Order by id desc limit {$rsnum},{$intpage}" );
		while ( $rs = $db->fetch_array( $query ) )
		{
				echo "    <TR bgcolor=\"#FFFFFF\">\r\n      <TD>";
				echo $rs['title'];
				echo "</TD>\r\n      <TD align=\"center\">";
				echo $rs['time'];
				echo "</TD>\r\n      <TD align=\"center\"><A href=\"admin_adquestions.php?action=edit&id=";
				echo $rs['id'];
				echo "\">修改</a> | <A href=\"admin_adquestions.php?action=del&id=";
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
		echo "<TABLE width=\"96%\" border=0 align=center cellpadding=\"4\" cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n<form action=\"?action=sadd\" method=\"post\" name=\"form\" onSubmit=\"return Validator.Validate(this,3)\">\r\n  <TBODY>\r\n    <TR>\r\n      <TD vAlign=center width=\"20%\" bgColor=#f5fafe>问卷广告标题：</TD>\r\n      <TD bgColor=#ffffff><INPUT id=\"title\" size=50 value=\"\" name=\"title\" dataType=\"Require\" msg=\"请填写问卷广告标题\"></TD>\r\n    </TR>\r\n    <TR>\r\n      <TD bgColor=#f5fafe>问卷广告奖励：</TD>\r\n      <TD bgColor=#ffffff><INPUT id=\"points\" size=50 value=\"\" name=\"points\" dataType=\"Integer\" msg=\"问卷广告奖励格式不正确\"> ";
		echo $web_moneyname;
		echo "</TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>每日答题次数：</TD>\r\n      <TD bgColor=#ffffff><INPUT id=\"dailynum\" size=50 value=\"\" name=\"dailynum\" dataType=\"Integer\" msg=\"每日答题次数式不正确\"> \r\n        次</TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>问卷广告图片：</TD>\r\n      <TD bgColor=#ffffff><INPUT id=\"adpic\" size=50 value=\"\" name=\"adpic\" dataType=\"Require\" msg=\"请填写问卷广告图片\"></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>图片上传：</TD>\r\n      <TD bgColor=#ffffff><iframe src=\"inc/upadpic.php?urldir=";
		echo $web_adpicdir;
		echo "&picname=adpic\" width=\"600\" height=\"25\" frameborder=\"0\" scrolling=\"no\"></iframe></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>设定问题：</TD>\r\n      <TD bgColor=#ffffff><input name=\"questionsnum\" id=\"questionsnum\" type=\"text\" value=\"1\" size=\"20\">\r\n          <input name=\"addquestions\" type=\"button\" class=\"inputbut\" onClick='setid(\"questionsnum\",\"addid\")' value=\"设定\"></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD colspan=\"2\" bgColor=#ffffff id=\"addid\">&nbsp;\t  </TD>\r\n    </TR>\r\n    <TR align=\"center\" bgcolor=\"#f8fbfb\">\r\n      <TD colspan=\"2\"><INPUT class=inputbut type=submit value=添加 name=Submit></TD>\r\n    </TR>\r\n  </TBODY>\r\n  </form>\r\n</TABLE>\r\n<script language=\"javascript\" src=\"inc/js.js\"></script>\r\n";
}

function edit( )
{
		global $db;
		global $web_dbtop;
		global $web_adpicdir;
		global $web_moneyname;
		$query = $db->query( "Select * from ".$web_dbtop."adquestions where id={$_GET['id']}" );
		if ( $rs = $db->fetch_array( $query ) )
		{
				echo "<TABLE width=\"96%\" border=0 align=center cellpadding=\"4\" cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n<form action=\"?action=sedit\" method=\"post\" onSubmit=\"return Validator.Validate(this,3)\">\r\n<input name=\"id\" type=\"hidden\" value=\"";
				echo $rs['id'];
				echo "\">\r\n  <TBODY>\r\n    <TR>\r\n      <TD vAlign=center width=\"20%\" bgColor=#f5fafe>问卷广告标题：</TD>\r\n      <TD bgColor=#ffffff><INPUT id=\"title\" size=50 value=\"";
				echo $rs['title'];
				echo "\" name=\"title\" dataType=\"Require\" msg=\"请填写问卷广告标题\"></TD>\r\n    </TR>\r\n    <TR>\r\n      <TD bgColor=#f5fafe>问卷广告奖励：</TD>\r\n      <TD bgColor=#ffffff><INPUT id=\"points\" size=50 value=\"";
				echo $rs['points'];
				echo "\" name=\"points\" dataType=\"Integer\" msg=\"问卷广告奖励格式不正确\"> ";
				echo $web_moneyname;
				echo "</TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>每日答题次数：</TD>\r\n      <TD bgColor=#ffffff><INPUT id=\"dailynum\" size=50 value=\"";
				echo $rs['dailynum'];
				echo "\" name=\"dailynum\" dataType=\"Integer\" msg=\"每日答题次数式不正确\"> \r\n        次</TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>问卷广告图片：</TD>\r\n      <TD bgColor=#ffffff><INPUT id=\"adpic\" size=50 value=\"";
				echo $rs['adpic'];
				echo "\" name=\"adpic\" dataType=\"Require\" msg=\"请填写问卷广告图片\"></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>图片上传：</TD>\r\n      <TD bgColor=#ffffff><iframe src=\"inc/upadpic.php?urldir=";
				echo $web_adpicdir;
				echo "&picname=adpic\" width=\"600\" height=\"25\" frameborder=\"0\" scrolling=\"no\"></iframe></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>设定问题：</TD>\r\n      <TD bgColor=#ffffff><input name=\"questionsnum\" id=\"questionsnum\" type=\"text\" value=\"";
				echo $rs['questionsnum'];
				echo "\" size=\"20\">\r\n          <input name=\"addquestions\" type=\"button\" class=\"inputbut\" onClick='setid(\"questionsnum\",\"addid\")' value=\"设定\"></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD colspan=\"2\" bgColor=#ffffff id=\"addid\">&nbsp;\t  </TD>\r\n    </TR>\r\n    <TR align=\"center\" bgcolor=\"#f8fbfb\">\r\n      <TD colspan=\"2\"><INPUT class=inputbut type=submit value=修改 name=Submit></TD>\r\n    </TR>\r\n  </TBODY>\r\n  </form>\r\n</TABLE>\r\n<script language=\"javascript\" src=\"inc/js.js\"></script>\r\n";
		}
}

include_once( dirname( __FILE__ )."/../inc/conn.php" );
include_once( dirname( __FILE__ )."/inc/function.php" );
login_check( "adgl" );
echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd\">\r\n<HTML xmlns=\"http://www.w3.org/1999/xhtml\">\r\n<HEAD>\r\n<TITLE>问卷广告管理--雷风积分游戏系统</TITLE>\r\n<META http-equiv=Content-Type content=\"text/html; charset=gb2312\">\r\n<LINK href=\"images/css_body.css\" type=text/css rel=stylesheet>\r\n<META content=\"MSHTML 6.00.3790.4275\" name=GENERATOR>\r\n</HEAD>\r\n<BODY>\r\n<DIV class=bodytitle>\r\n<DIV class=bodytitleleft></DIV>\r\n<DIV class=bodytitletxt>问卷广告管理</DIV>\r\n<DIV class=bodytitletxt2><a href=\"admin_adquestions.php?action=add\">添加问卷广告</a></DIV>\r\n</DIV>\r\n";
switch ( $_GET['action'] )
{
case "add" :
		add( );
		break;
case "sadd" :
		sadd( );
		addlog( "网站问卷广告添加成功" );
		showerr( "网站问卷广告添加成功", "admin_adquestions.php" );
		break;
case "edit" :
		edit( );
		break;
case "sedit" :
		sedit( );
		addlog( "网站问卷广告修改成功" );
		showerr( "网站问卷广告修改成功", "admin_adquestions.php" );
		break;
case "del" :
		del( );
		addlog( "网站问卷广告删除成功" );
		showerr( "网站问卷广告删除成功", "admin_adquestions.php" );
		break;
default :
		main( );
}
echo "<script language=\"javascript\">\r\n";
if ( $_GET['action'] == "edit" )
{
		echo "setid(\"questionsnum\",\"addid\");\r\n";
}
echo "function setid(Volume,addid){\r\n\tstr='';\r\n\tif(!document.getElementById(Volume).value)\r\n\t\tdocument.getElementById(Volume).value=1;\r\n\tfor(i=1;i<=document.getElementById(Volume).value;i++){\r\n\t\tstr+='<table width=\"96%\" align=\"center\" cellpadding=\"4\" cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">';\r\n\t  \tstr+='<tr align=\"center\" bgcolor=\"#f5fafe\">';\r\n        str+='<td colspan=\"2\">问题'+i+'</td>';\r\n        str+='</tr>';\r\n        str+='<tr bgcolor=\"#FFFFFF\">';\r\n        str+='<td width=\"15%\">问答题目：</td>';\r\n        str+='<td><INPUT id=\"adtm'+i+'\" size=50 value=\"\" name=\"adtm'+i+'\"></td>';\r\n        str+='</tr>';\r\n        str+='<tr bgcolor=\"#FFFFFF\">';\r\n        str+='<td>答案：</td>';\r\n        str+='<td><INPUT id=\"adda1'+i+'\" size=50 value=\"\" name=\"adda1'+i+'\"> <input type=\"checkbox\" name=\"adzq1'+i+'\" id=\"adzq1'+i+'\" value=\"1\"> 正确答案</td>';\r\n        str+='</tr>';\r\n        str+='<tr bgcolor=\"#FFFFFF\">';\r\n        str+='<td>答案：</td>';\r\n        str+='<td><INPUT id=\"adda2'+i+'\" size=50 value=\"\" name=\"adda2'+i+'\"> <input type=\"checkbox\" name=\"adzq2'+i+'\" id=\"adzq2'+i+'\" value=\"1\"> 正确答案</td>';\r\n        str+='</tr>';\r\n        str+='<tr bgcolor=\"#FFFFFF\">';\r\n        str+='<td>答案：</td>';\r\n        str+='<td><INPUT id=\"adda3'+i+'\" size=50 value=\"\" name=\"adda3'+i+'\"> <input type=\"checkbox\" name=\"adzq3'+i+'\" id=\"adzq3'+i+'\" value=\"1\"> 正确答案</td>';\r\n        str+='</tr>';\r\n        str+='<tr bgcolor=\"#FFFFFF\">';\r\n        str+='<td>答案：</td>';\r\n        str+='<td><INPUT id=\"adda4'+i+'\" size=50 value=\"\" name=\"adda4'+i+'\"> <input type=\"checkbox\" name=\"adzq4'+i+'\" id=\"adzq4'+i+'\" value=\"1\"> 正确答案</td>';\r\n        str+='</tr>';\r\n\t\tstr+='<tr bgcolor=\"#FFFFFF\">';\r\n        str+='<td>寻找答案网址：</td>';\r\n        str+='<td><INPUT id=\"addaurl'+i+'\" size=50 value=\"\" name=\"addaurl'+i+'\">';\r\n        str+='</td>';\r\n\t\tstr+='</tr>';\r\n      \tstr+='</table>';\r\n\t}\r\n\tdocument.getElementById(addid).innerHTML=str;\r\n\t";
if ( $_GET['action'] == "edit" )
{
		$query = $db->query( "Select * from ".$web_dbtop."adquestions where id={$_GET['id']}" );
		if ( $rs = $db->fetch_array( $query ) )
		{
				$query_f = $db->query( "Select * from ".$web_dbtop."adquestions_issue where adid=".$rs['id']." Order by adorder asc" );
				$i = 1;
				while ( $rs_f = $db->fetch_array( $query_f ) )
				{
						echo "document.getElementById(\"adtm".$i."\").value='".$rs_f['adtm']."';\r\n";
						echo "document.getElementById(\"adda1".$i."\").value='".$rs_f['adda1']."';\r\n";
						echo "document.getElementById(\"adzq1".$i."\").checked=".( $rs_f['adzq1'] == 1 ? "true" : "false" ).";\r\n";
						echo "document.getElementById(\"adda2".$i."\").value='".$rs_f['adda2']."';\r\n";
						echo "document.getElementById(\"adzq2".$i."\").checked=".( $rs_f['adzq2'] == 1 ? "true" : "false" ).";\r\n";
						echo "document.getElementById(\"adda3".$i."\").value='".$rs_f['adda3']."';\r\n";
						echo "document.getElementById(\"adzq3".$i."\").checked=".( $rs_f['adzq3'] == 1 ? "true" : "false" ).";\r\n";
						echo "document.getElementById(\"adda4".$i."\").value='".$rs_f['adda4']."';\r\n";
						echo "document.getElementById(\"adzq4".$i."\").checked=".( $rs_f['adzq4'] == 1 ? "true" : "false" ).";\r\n";
						echo "document.getElementById(\"addaurl".$i."\").value='".$rs_f['addaurl']."';\r\n";
						++$i;
				}
		}
}
echo "}\r\n</script>\r\n</BODY></HTML>\r\n";
?>
