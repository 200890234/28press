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
		$query = $db->query( "Select id from ".$web_dbtop."users where id={$_POST['uid']}" );
		if ( !( $rs = $db->fetch_array( $query ) ) )
		{
				echo "<script language=javascript>alert('�Բ���û�и��û�,��������ȷ���û�ID��');history.go(-1);</script>";
				exit( );
		}
		$db->query( "INSERT INTO ".$web_dbtop."business (name,qq,tel,uid,discount,pic,url,content,time,tj,auto) VALUES ('".$_POST['name']."','".$_POST['qq']."','".$_POST['tel']."',".$_POST['uid'].",".$_POST['discount'].",'".$_POST['pic']."','".$_POST['url']."','".$_POST['content']."','".date( "Y-m-d" )."',".intval( $_POST['tj'] ).",".intval( $_POST['auto'] ).")" );
}

function sedit( )
{
		global $db;
		global $web_dbtop;
		$query = $db->query( "Select id from ".$web_dbtop."users where id={$_POST['uid']}" );
		if ( !( $rs = $db->fetch_array( $query ) ) )
		{
				echo "<script language=javascript>alert('�Բ���û�и��û�,��������ȷ���û�ID��');history.go(-1);</script>";
				exit( );
		}
		$db->query( "update ".$web_dbtop."business set name='".$_POST['name']."',qq='".$_POST['qq']."',tel='".$_POST['tel']."',uid=".$_POST['uid'].",discount='".$_POST['discount']."',url='".$_POST['url']."',pic='".$_POST['pic']."',content='".$_POST['content']."',time='".date( "Y-m-d" )."',tj=".intval( $_POST['tj'] ).",auto=".intval( $_POST['auto'] ).( " where id=".$_POST['id'] ) );
}

function del( )
{
		global $db;
		global $web_dbtop;
		$db->query( "delete from ".$web_dbtop."business where id={$_GET['id']}" );
}

function main( )
{
		global $db;
		global $web_dbtop;
		echo "<TABLE width=\"96%\" border=0 align=center cellpadding=\"5\" cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n  <TBODY>\r\n    <TR bgColor=\"#f5fafe\">\r\n      <TD align=\"center\">�̻�����</TD>\r\n\t  <TD width=\"10%\" align=\"center\">�����ۿ�</TD>\r\n      <TD width=\"12%\" align=\"center\">��ϵQQ</TD>\r\n\t  <TD width=\"12%\" align=\"center\">��ϵ�绰</TD>\r\n\t  <TD width=\"15%\" align=\"center\">���û�ID</TD>\r\n\t  <TD width=\"10%\" align=\"center\">�����ܼ�</TD>\r\n      <TD width=\"18%\" align=\"center\">����</TD>\r\n    </TR>\r\n\t";
		$intpage = 20;
		if ( isset( $_GET['page'] ) )
		{
				$rsnum = ( $_GET['page'] - 1 ) * $intpage;
		}
		else
		{
				$rsnum = 0;
		}
		$query = $db->query( "Select * from ".$web_dbtop."business Order by id desc" );
		if ( $db->fetch_array( $query ) )
		{
				$intnum = $db->num_rows( $query );
		}
		$query = $db->query( "Select * from ".$web_dbtop."business Order by id desc limit {$rsnum},{$intpage}" );
		while ( $rs = $db->fetch_array( $query ) )
		{
				echo "    <TR bgcolor=\"#FFFFFF\">\r\n      <TD>";
				echo $rs['name'];
				echo "</TD>\r\n\t  <TD align=\"center\">";
				echo $rs['discount'];
				echo " ��</TD>\r\n      <TD align=\"center\">";
				echo $rs['qq'];
				echo "</TD>\r\n\t  <TD align=\"center\">";
				echo $rs['tel'];
				echo "</TD>\r\n\t  <TD align=\"center\">";
				echo $rs['uid'];
				echo "</TD>\r\n\t  <TD align=\"center\">";
				echo $rs['sales'];
				echo " Ԫ </TD>\r\n      <TD align=\"center\"><A href=\"admin_business.php?action=edit&id=";
				echo $rs['id'];
				echo "\">�޸�</a> | <A href=\"admin_business.php?action=del&id=";
				echo $rs['id'];
				echo "\" onClick=\"return confirm('ȷ��Ҫɾ����?');\">ɾ��</a> | <a href=\"#\" onclick=\"AddWin('W_SHKC_";
				echo $rs['id'];
				echo "','�̻� ";
				echo $rs['name'];
				echo " ���鿴','admin_business.php?action=look&id=";
				echo $rs['id'];
				echo "',400,250,0);return false\">���</a></TD>\r\n    </TR>\r\n\t";
		}
		echo "    <TR align=\"center\" bgcolor=\"#f8fbfb\">\r\n      <TD colspan=\"7\">";
		include_once( dirname( __FILE__ )."/../inc/page_class.php" );
		$page = new page( array(
				"total" => $intnum,
				"perpage" => $intpage
		) );
		echo $page->show( 4, "page", "curr" );
		echo "</TD>\r\n    </TR>\r\n  </TBODY>\r\n</TABLE>\r\n<script language=\"javascript\" src=\"inc/QJ_Display.js\"></script>\r\n";
}

function add( )
{
		global $web_businessdir;
		echo "<TABLE width=\"96%\" border=0 align=center cellpadding=\"4\" cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n<form action=\"?action=sadd\" method=\"post\" onSubmit=\"return Validator.Validate(this,3)\">\r\n  <TBODY>\r\n    <TR>\r\n      <TD vAlign=center width=\"20%\" bgColor=#f5fafe>�̻����ƣ�</TD>\r\n      <TD bgColor=#ffffff><INPUT id=\"name\" size=50 value=\"\" name=\"name\" dataType=\"Require\" msg=\"����д�̻�����\"></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD vAlign=center width=\"20%\" bgColor=#f5fafe>��ϵQQ��</TD>\r\n      <TD bgColor=#ffffff><INPUT id=\"qq\" size=50 value=\"\" name=\"qq\" dataType=\"Require\" msg=\"����д��ϵQQ\"></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD vAlign=center width=\"20%\" bgColor=#f5fafe>��ϵ�绰��</TD>\r\n      <TD bgColor=#ffffff><INPUT id=\"tel\" size=50 value=\"\" name=\"tel\" dataType=\"Require\" msg=\"����д��ϵ�绰\"></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD vAlign=center width=\"20%\" bgColor=#f5fafe>�̻�ͼƬ��</TD>\r\n      <TD bgColor=#ffffff><INPUT id=\"pic\" size=50 value=\"\" name=\"pic\" dataType=\"Require\" msg=\"����д�̻�ͼƬ\"></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>ͼƬ�ϴ���</TD>\r\n      <TD bgColor=#ffffff><iframe src=\"inc/upadpic.php?urldir=";
		echo $web_businessdir;
		echo "&picname=pic\" width=\"600\" height=\"25\" frameborder=\"0\" scrolling=\"no\"></iframe></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD vAlign=center width=\"20%\" bgColor=#f5fafe>�����ַ��</TD>\r\n      <TD bgColor=#ffffff><INPUT id=\"url\" size=50 value=\"\" name=\"url\" dataType=\"Require\" msg=\"����д��ϵ�绰\"></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD vAlign=center width=\"20%\" bgColor=#f5fafe>���û�ID��</TD>\r\n      <TD bgColor=#ffffff><INPUT id=\"uid\" size=20 value=\"\" name=\"uid\" dataType=\"Integer\" msg=\"���û�ID ��ʽ����ȷ\"> \r\n      �̻�����Ҫ���û���ʹ�õģ���Ҫʹ���û����������½�ģ�</TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD vAlign=center width=\"20%\" bgColor=#f5fafe>�����ۿۣ�</TD>\r\n      <TD bgColor=#ffffff><INPUT id=\"discount\" size=20 value=\"0\" name=\"discount\" dataType=\"Double\" msg=\"�����ۿ۸�ʽ����ȷ\"> \r\n      0�������ۿ�</TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD vAlign=center width=\"20%\" bgColor=#f5fafe>�Ƽ��̻���</TD>\r\n      <TD bgColor=#ffffff><input name=\"tj\" type=\"checkbox\" value=\"1\"></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD vAlign=center width=\"20%\" bgColor=#f5fafe>�Զ�������</TD>\r\n      <TD bgColor=#ffffff><input name=\"auto\" type=\"checkbox\" value=\"1\"></TD>\r\n    </TR>\r\n    <TR>\r\n      <TD bgColor=#f5fafe>�̻���ע��</TD>\r\n      <TD bgColor=#ffffff><textarea name=\"content\" style=\"display:none\"></textarea>\r\n  <iframe ID=\"Editor\" name=\"Editor\" src=\"editor/index.html?ID=content\" frameBorder=\"0\" marginHeight=\"0\" marginWidth=\"0\" scrolling=\"No\" style=\"height:320px;width:100%\"></iframe></TD>\r\n    </TR>\r\n    <TR align=\"center\" bgcolor=\"#f8fbfb\">\r\n      <TD colspan=\"2\"><INPUT class=inputbut type=submit value=��� name=Submit>\r\n      &nbsp;</TD>\r\n    </TR>\r\n  </TBODY>\r\n  </form>\r\n</TABLE>\r\n<script language=\"javascript\" src=\"inc/js.js\"></script>\r\n";
}

function edit( )
{
		global $db;
		global $web_dbtop;
		global $web_businessdir;
		$query = $db->query( "Select * from ".$web_dbtop."business where id={$_GET['id']}" );
		if ( $rs = $db->fetch_array( $query ) )
		{
				echo "<TABLE width=\"96%\" border=0 align=center cellpadding=\"4\" cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n  <form action=\"?action=sedit\" method=\"post\" onSubmit=\"return Validator.Validate(this,3)\">\r\n\t<input name=\"id\" type=\"hidden\" value=\"";
				echo $rs['id'];
				echo "\">\r\n    <TBODY>\r\n      <TR>\r\n        <TD vAlign=center width=\"20%\" bgColor=#f5fafe>�̻����ƣ�</TD>\r\n        <TD bgColor=#ffffff><INPUT id=\"name\" size=50 value=\"";
				echo $rs['name'];
				echo "\" name=\"name\" dataType=\"Require\" msg=\"����д�̻�����\"></TD>\r\n      </TR>\r\n      <TR>\r\n        <TD vAlign=center width=\"20%\" bgColor=#f5fafe>��ϵQQ��</TD>\r\n        <TD bgColor=#ffffff><INPUT id=\"qq\" size=50 value=\"";
				echo $rs['qq'];
				echo "\" name=\"qq\" dataType=\"Require\" msg=\"����д��ϵQQ\"></TD>\r\n      </TR>\r\n      <TR>\r\n        <TD vAlign=center width=\"20%\" bgColor=#f5fafe>��ϵ�绰��</TD>\r\n        <TD bgColor=#ffffff><INPUT id=\"tel\" size=50 value=\"";
				echo $rs['tel'];
				echo "\" name=\"tel\" dataType=\"Require\" msg=\"����д��ϵ�绰\"></TD>\r\n      </TR>\r\n\t  <TR>\r\n      <TD vAlign=center width=\"20%\" bgColor=#f5fafe>�̻�ͼƬ��</TD>\r\n      <TD bgColor=#ffffff><INPUT id=\"pic\" size=50 value=\"";
				echo $rs['pic'];
				echo "\" name=\"pic\" dataType=\"Require\" msg=\"����д�̻�ͼƬ\"></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>ͼƬ�ϴ���</TD>\r\n      <TD bgColor=#ffffff><iframe src=\"inc/upadpic.php?urldir=";
				echo $web_businessdir;
				echo "&picname=pic\" width=\"600\" height=\"25\" frameborder=\"0\" scrolling=\"no\"></iframe></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD vAlign=center width=\"20%\" bgColor=#f5fafe>�����ַ��</TD>\r\n      <TD bgColor=#ffffff><INPUT id=\"url\" size=50 value=\"";
				echo $rs['url'];
				echo "\" name=\"url\" dataType=\"Require\" msg=\"����д��ϵ�绰\"></TD>\r\n    </TR>\r\n      <TR>\r\n        <TD vAlign=center width=\"20%\" bgColor=#f5fafe>���û�ID��</TD>\r\n        <TD bgColor=#ffffff><INPUT id=\"uid\" size=20 value=\"";
				echo $rs['uid'];
				echo "\" name=\"uid\" dataType=\"Integer\" msg=\"���û�ID ��ʽ����ȷ\">\r\n          �̻�����Ҫ���û���ʹ�õģ���Ҫʹ���û����������½�ģ�</TD>\r\n      </TR>\r\n      <TR>\r\n        <TD vAlign=center width=\"20%\" bgColor=#f5fafe>�����ۿۣ�</TD>\r\n        <TD bgColor=#ffffff><INPUT id=\"discount\" size=20 value=\"";
				echo $rs['discount'];
				echo "\" name=\"discount\" dataType=\"Double\" msg=\"�����ۿ۸�ʽ����ȷ\"></TD>\r\n      </TR>\r\n\t  <TR>\r\n      <TD vAlign=center width=\"20%\" bgColor=#f5fafe>�Ƽ��̻���</TD>\r\n      <TD bgColor=#ffffff><input name=\"tj\" type=\"checkbox\" value=\"1\" ";
				if ( $rs['tj'] == 1 )
				{
						echo "checked";
				}
				echo "></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD vAlign=center width=\"20%\" bgColor=#f5fafe>�Զ�������</TD>\r\n      <TD bgColor=#ffffff><input name=\"auto\" type=\"checkbox\" value=\"1\" ";
				if ( $rs['auto'] == 1 )
				{
						echo "checked";
				}
				echo "></TD>\r\n    </TR>\r\n      <TR>\r\n        <TD bgColor=#f5fafe>�̻���ע��</TD>\r\n        <TD bgColor=#ffffff><textarea name=\"content\" style=\"display:none\">";
				echo $rs['content'];
				echo "</textarea>\r\n            <iframe ID=\"Editor\" name=\"Editor\" src=\"editor/index.html?ID=content\" frameBorder=\"0\" marginHeight=\"0\" marginWidth=\"0\" scrolling=\"No\" style=\"height:320px;width:100%\"></iframe></TD>\r\n      </TR>\r\n      <TR align=\"center\" bgcolor=\"#f8fbfb\">\r\n        <TD colspan=\"2\"><INPUT class=inputbut type=submit value=�޸� name=Submit></TD>\r\n      </TR>\r\n    </TBODY>\r\n  </form>\r\n</TABLE>\r\n<script language=\"javascript\" src=\"inc/js.js\"></script>\r\n";
		}
}

function look( )
{
		global $db;
		global $web_dbtop;
		$query = $db->query( "Select * FROM ".$web_dbtop."card where businessid={$_GET['id']} and state=0 Order by id desc" );
		if ( $db->fetch_array( $query ) )
		{
				$intnum = $db->num_rows( $query );
		}
		echo "<TABLE width=\"96%\" border=0 align=center cellpadding=\"4\" cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n    <TBODY>\r\n      <TR>\r\n        <TD vAlign=center width=\"40%\" bgColor=#f5fafe>�ʻ��ܿ���Ϊ��</TD>\r\n        <TD bgColor=#ffffff>";
		echo $intnum;
		echo " ��</TD>\r\n      </TR>\r\n\t  \t";
		$query = $db->query( "Select * FROM ".$web_dbtop."cardtype Order by id desc" );
		while ( $rs = $db->fetch_array( $query ) )
		{
				$query_f = $db->query( "Select * FROM ".$web_dbtop."card where cardtype=".$rs['id'].( " and businessid=".$_GET['id']." and state=0 Order by id desc" ) );
				if ( $rs_f = $db->fetch_array( $query_f ) )
				{
						$cardnum = $db->num_rows( $query_f );
				}
				else
				{
						$cardnum = 0;
				}
				echo "\t\t<TR>\r\n        <TD vAlign=center width=\"20%\" bgColor=#f5fafe>";
				echo $rs['cardname'];
				echo "</TD>\r\n        <TD bgColor=#ffffff>";
				echo $cardnum;
				echo " ��</TD>\r\n      \t</TR>\r\n\t\t";
		}
		echo "    </TBODY>\r\n</TABLE>\r\n";
}

include_once( dirname( __FILE__ )."/../inc/conn.php" );
include_once( dirname( __FILE__ )."/inc/function.php" );
login_check( "business" );
echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd\">\r\n<HTML xmlns=\"http://www.w3.org/1999/xhtml\">\r\n<HEAD>\r\n<TITLE>�̻�����--�׷������Ϸϵͳ</TITLE>\r\n<META http-equiv=Content-Type content=\"text/html; charset=gb2312\">\r\n<LINK href=\"images/css_body.css\" type=text/css rel=stylesheet>\r\n<META content=\"MSHTML 6.00.3790.4275\" name=GENERATOR>\r\n</HEAD>\r\n<BODY>\r\n";
if ( $_GET['action'] != "look" )
{
		echo "<DIV class=bodytitle>\r\n<DIV class=bodytitleleft></DIV>\r\n<DIV class=bodytitletxt>�̻�����</DIV>\r\n<DIV class=bodytitletxt2><a href=\"admin_business.php?action=add\">����̻�</a></DIV>\r\n</DIV>\r\n";
}
switch ( $_GET['action'] )
{
case "add" :
		add( );
		break;
case "sadd" :
		sadd( );
		addlog( "��վ�̻���ӳɹ�" );
		showerr( "��վ�̻���ӳɹ�", "admin_business.php" );
		break;
case "edit" :
		edit( );
		break;
case "look" :
		look( );
		break;
case "sedit" :
		sedit( );
		addlog( "��վ�̻��޸ĳɹ�" );
		showerr( "��վ�̻��޸ĳɹ�", "admin_business.php" );
		break;
case "del" :
		del( );
		addlog( "��վ�̻�ɾ���ɹ�" );
		showerr( "��վ�̻�ɾ���ɹ�", "admin_business.php" );
		break;
default :
		main( );
}
echo "</BODY>\r\n</HTML>\r\n";
?>
