<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/

function sms( )
{
		global $db;
		global $web_dbtop;
		$db->query( "INSERT INTO ".$web_dbtop."msg (usersid,title,mag,mid,time) VALUES (1,'".$_POST['tbSmsSubject']."','".$_POST['tbSmsContent']."',".$_POST['tbSmsReceiver'].",'".date( "Y-m-d H:i:s" )."')" );
}

function del( )
{
		global $db;
		global $web_dbtop;
		$db->query( "delete from ".$web_dbtop."advice where id={$_GET['id']}" );
}

function main( )
{
		global $db;
		global $web_dbtop;
		echo "<TABLE width=\"96%\" border=0 align=center cellpadding=\"5\" cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n  <TBODY>\r\n    <TR bgColor=\"#f5fafe\">\r\n      <TD width=\"20%\" align=\"center\">�����û�</TD>\r\n      <TD align=\"center\">�������</TD>\r\n      <TD width=\"20%\" align=\"center\">����ʱ��</TD>\r\n      <TD width=\"18%\" align=\"center\">����</TD>\r\n    </TR>\r\n\t";
		$intpage = 20;
		if ( isset( $_GET['page'] ) )
		{
				$rsnum = ( $_GET['page'] - 1 ) * $intpage;
		}
		else
		{
				$rsnum = 0;
		}
		$query = $db->query( "Select * from ".$web_dbtop."advice Order by id desc" );
		if ( $db->fetch_array( $query ) )
		{
				$intnum = $db->num_rows( $query );
		}
		$query = $db->query( "Select * from ".$web_dbtop."advice Order by id desc limit {$rsnum},{$intpage}" );
		while ( $rs = $db->fetch_array( $query ) )
		{
				echo "    <TR bgcolor=\"#FFFFFF\">\r\n      <TD align=\"center\">";
				echo $rs['usersid'];
				echo "</TD>\r\n      <TD><a href=\"admin_advise.php?action=look&id=";
				echo $rs['id'];
				echo "\">";
				echo $rs['title'];
				echo "</a></TD>\r\n      <TD align=\"center\">";
				echo $rs['time'];
				echo "</TD>\r\n      <TD align=\"center\"><A href=\"admin_advise.php?action=look&id=";
				echo $rs['id'];
				echo "\">�鿴</a> | <A href=\"admin_advise.php?action=reply&id=";
				echo $rs['id'];
				echo "\">�ظ�</a> | <A href=\"admin_advise.php?action=del&id=";
				echo $rs['id'];
				echo "\" onClick=\"return confirm('ȷ��Ҫɾ����?');\">ɾ��</a></TD>\r\n    </TR>\r\n\t";
		}
		echo "    <TR align=\"center\" bgcolor=\"#f8fbfb\">\r\n      <TD colspan=\"4\">";
		include_once( dirname( __FILE__ )."/../inc/page_class.php" );
		$page = new page( array(
				"total" => $intnum,
				"perpage" => $intpage
		) );
		echo $page->show( 4, "page", "curr" );
		echo "</TD>\r\n    </TR>\r\n  </TBODY>\r\n</TABLE>\r\n";
}

function look( )
{
		global $db;
		global $web_dbtop;
		$query = $db->query( "Select * from ".$web_dbtop."advice where id={$_GET['id']}" );
		if ( $rs = $db->fetch_array( $query ) )
		{
				echo "<TABLE width=\"96%\" border=0 align=center cellpadding=\"4\" cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n  <TBODY>\r\n    <TR>\r\n      <TD vAlign=center width=\"20%\" bgColor=#f5fafe>�����û���</TD>\r\n      <TD bgColor=#ffffff>";
				echo $rs['usersid'];
				echo "</TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD vAlign=center bgColor=#f5fafe>����ʱ�䣺</TD>\r\n      <TD bgColor=#ffffff>";
				echo $rs['time'];
				echo "</TD>\r\n    </TR>\r\n    <TR>\r\n      <TD vAlign=center bgColor=#f5fafe>������⣺</TD>\r\n      <TD bgColor=#ffffff>";
				echo $rs['title'];
				echo " ";
				echo $rs['time'];
				echo "</TD>\r\n    </TR>\r\n    <TR>\r\n      <TD bgColor=#f5fafe>�������ݣ�</TD>\r\n      <TD bgColor=#ffffff>";
				echo $rs['content'];
				echo "</TD>\r\n    </TR>\r\n    <TR align=\"center\" bgcolor=\"#f8fbfb\">\r\n      <TD colspan=\"2\"><INPUT class=inputbut type=submit value=�ظ� name=Submit onClick=\"location.href='admin_advise.php?action=reply&id=";
				echo $rs['id'];
				echo "'\"> <INPUT class=inputbut type=submit value=ɾ�� name=Submit onClick=\"if(confirm('ȷ��Ҫɾ����?')){location.href='admin_advise.php?action=del&id=";
				echo $rs['id'];
				echo "';return true;}\"></TD>\r\n    </TR>\r\n  </TBODY>\r\n</TABLE>\r\n";
		}
}

function reply( )
{
		global $db;
		global $web_dbtop;
		$query = $db->query( "Select * from ".$web_dbtop."advice where id={$_GET['id']}" );
		if ( $rs = $db->fetch_array( $query ) )
		{
				echo "<TABLE width=\"96%\" border=0 align=center cellpadding=\"4\" cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n<form action=\"?action=sms\" method=\"post\" onSubmit=\"return Validator.Validate(this,3)\">\r\n<input name=\"tbSmsReceiver\" type=\"hidden\" value=\"";
				echo $rs['usersid'];
				echo "\">\r\n  <TBODY>\r\n    <TR>\r\n      <TD vAlign=center width=\"20%\" bgColor=#f5fafe>���⣺</TD>\r\n      <TD bgColor=#ffffff><INPUT id=\"tbSmsSubject\" size=50 value=\"����ظ� ";
				echo $rs['title'];
				echo " ����\" name=\"tbSmsSubject\" dataType=\"Require\" msg=\"����д��������\">        </TD>\r\n    </TR>\r\n    <TR>\r\n      <TD bgColor=#f5fafe>���ģ�</TD>\r\n      <TD bgColor=#ffffff><textarea name=\"tbSmsContent\" style=\"display:none\"></textarea>\r\n  <iframe ID=\"Editor\" name=\"Editor\" src=\"editor/index.html?ID=tbSmsContent\" frameBorder=\"0\" marginHeight=\"0\" marginWidth=\"0\" scrolling=\"No\" style=\"height:320px;width:100%\"></iframe></TD>\r\n    </TR>\r\n    <TR align=\"center\" bgcolor=\"#f8fbfb\">\r\n      <TD colspan=\"2\"><INPUT class=inputbut type=submit value=���� name=Submit></TD>\r\n    </TR>\r\n  </TBODY>\r\n  </form>\r\n</TABLE>\r\n<script language=\"javascript\" src=\"inc/js.js\"></script>\r\n";
		}
}

include_once( dirname( __FILE__ )."/../inc/conn.php" );
include_once( dirname( __FILE__ )."/inc/function.php" );
login_check( "users" );
echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd\">\r\n<HTML xmlns=\"http://www.w3.org/1999/xhtml\">\r\n<HEAD>\r\n<TITLE>�������--�׷������Ϸϵͳ</TITLE>\r\n<META http-equiv=Content-Type content=\"text/html; charset=gb2312\">\r\n<LINK href=\"images/css_body.css\" type=text/css rel=stylesheet>\r\n<META content=\"MSHTML 6.00.3790.4275\" name=GENERATOR>\r\n</HEAD>\r\n<BODY>\r\n<DIV class=bodytitle>\r\n<DIV class=bodytitleleft></DIV>\r\n<DIV class=bodytitletxt>�������</DIV>\r\n</DIV>\r\n";
switch ( $_GET['action'] )
{
case "look" :
		look( );
		break;
case "reply" :
		reply( );
		break;
case "sms" :
		sms( );
		addlog( "�û�������Żظ��ɹ�" );
		showerr( "�û�������Żظ��ɹ�", "admin_advise.php" );
		break;
case "del" :
		del( );
		addlog( "�û�����ɾ���ɹ�" );
		showerr( "�û�����ɾ���ɹ�", "admin_advise.php" );
		break;
default :
		main( );
}
echo "</BODY></HTML>\r\n";
?>
