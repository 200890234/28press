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
		if ( intval( $_POST['game16'] ) == 1 )
		{
				$db->query( "delete from ".$web_dbtop."game16 where STR_TO_DATE(kgtime,'%Y-%m-%d')<='".date( "Y-m-" ).( date( "d" ) - intval( $_POST['deltime'] ) )."'" );
				$db->query( "delete from ".$web_dbtop."game16_users_tz where STR_TO_DATE(time,'%Y-%m-%d')<='".date( "Y-m-" ).( date( "d" ) - intval( $_POST['deltime'] ) )."'" );
		}
		if ( intval( $_POST['game11'] ) == 1 )
		{
				$db->query( "delete from ".$web_dbtop."game11 where STR_TO_DATE(kgtime,'%Y-%m-%d')<='".date( "Y-m-" ).( date( "d" ) - intval( $_POST['deltime'] ) )."'" );
				$db->query( "delete from ".$web_dbtop."game11_users_tz where STR_TO_DATE(time,'%Y-%m-%d')<='".date( "Y-m-" ).( date( "d" ) - intval( $_POST['deltime'] ) )."'" );
		}
				
		if ( intval( $_POST['game28'] ) == 1 )
		{
				$db->query( "delete from ".$web_dbtop."game28 where STR_TO_DATE(kgtime,'%Y-%m-%d')<='".date( "Y-m-" ).( date( "d" ) - intval( $_POST['deltime'] ) )."'" );
				$db->query( "delete from ".$web_dbtop."game28_users_tz where STR_TO_DATE(time,'%Y-%m-%d')<='".date( "Y-m-" ).( date( "d" ) - intval( $_POST['deltime'] ) )."'" );
		}
		if ( intval( $_POST['gamedodge'] ) == 1 )
		{
				$db->query( "delete from ".$web_dbtop."gamedodge where STR_TO_DATE(time,'%Y-%m-%d')<='".date( "Y-m-" ).( date( "d" ) - intval( $_POST['deltime'] ) )."'" );
		}
		if ( intval( $_POST['gamebox'] ) == 1 )
		{
				$db->query( "delete from ".$web_dbtop."gamebox_log where STR_TO_DATE(time,'%Y-%m-%d')<='".date( "Y-m-" ).( date( "d" ) - intval( $_POST['deltime'] ) )."'" );
		}
		if ( intval( $_POST['ad'] ) == 1 )
		{
				$db->query( "delete from ".$web_dbtop."adtj where STR_TO_DATE(time,'%Y-%m-%d')<='".date( "Y-m-" ).( date( "d" ) - intval( $_POST['deltime'] ) )."'" );
				$db->query( "delete from ".$web_dbtop."adlogusers where STR_TO_DATE(fatime,'%Y-%m-%d')<='".date( "Y-m-" ).( date( "d" ) - intval( $_POST['deltime'] ) )."'" );
		}
		if ( intval( $_POST['users'] ) == 1 )
		{
				$db->query( "delete from ".$web_dbtop."backlog where STR_TO_DATE(time,'%Y-%m-%d')<='".date( "Y-m-" ).( date( "d" ) - intval( $_POST['deltime'] ) )."'" );
				$db->query( "delete from ".$web_dbtop."userslog where STR_TO_DATE(time,'%Y-%m-%d')<='".date( "Y-m-" ).( date( "d" ) - intval( $_POST['deltime'] ) )."'" );
				$db->query( "delete from ".$web_dbtop."msg where STR_TO_DATE(time,'%Y-%m-%d')<='".date( "Y-m-" ).( date( "d" ) - intval( $_POST['deltime'] ) )."'" );
				$db->query( "delete from ".$web_dbtop."tjlog where STR_TO_DATE(time,'%Y-%m-%d')<='".date( "Y-m-" ).( date( "d" ) - intval( $_POST['deltime'] ) )."'" );
		}
		if ( intval( $_POST['card'] ) == 1 )
		{
				$db->query( "delete from ".$web_dbtop."card where state=1 and STR_TO_DATE(utime,'%Y-%m-%d')<='".date( "Y-m-" ).( date( "d" ) - intval( $_POST['deltime'] ) )."'" );
		}
}

function main( )
{
		global $db;
		global $web_dbtop;
		echo "<TABLE width=\"96%\" border=0 align=center cellpadding=\"4\" cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n  <form action=\"?action=del\" method=\"post\">\r\n    <TBODY>\r\n      <TR>\r\n        <TD vAlign=center width=\"20%\" bgColor=#f5fafe>ʱ�����ã�</TD>\r\n        <TD bgColor=#ffffff><select name=\"deltime\">\r\n          <option value=\"7\">���һ��ǰ����</option>\r\n          <option value=\"30\">���һ��ǰ����</option>\r\n        </select></TD>\r\n      </TR>\r\n\t  <TR>\r\n        <TD vAlign=center width=\"20%\" bgColor=#f5fafe>����ѡ��</TD>\r\n        <TD bgColor=#ffffff><input name=\"game16\" type=\"checkbox\" id=\"game16\" value=\"1\"> \r\n          ����16����\r\n     <input name=\"game11\" type=\"checkbox\" id=\"game11\" value=\"1\"> \r\n          ����11����\r\n        <input name=\"game28\" type=\"checkbox\" id=\"game28\" value=\"1\"> \r\n        ����28����\r\n        <input name=\"gamedodge\" type=\"checkbox\" id=\"gamedodge\" value=\"1\"> \r\n        ��ȭ����\r\n        <input type=\"checkbox\" name=\"gamebox\" value=\"1\"> \r\n        ��������\r\n        <input type=\"checkbox\" name=\"ad\" value=\"1\"> \r\n        �������\r\n        <input type=\"checkbox\" name=\"users\" value=\"1\"> \r\n        �û�����\r\n        <input type=\"checkbox\" name=\"card\" value=\"1\"> \r\n        �俨����\r\n\t\t</TD>\r\n\t  </TR>\r\n      <TR align=\"center\" bgcolor=\"#f8fbfb\">\r\n        <TD colspan=\"2\"><INPUT class=inputbut type=submit value=��� name=Submit></TD>\r\n      </TR>\r\n    </TBODY>\r\n  </form>\r\n</TABLE>\r\n";
}

set_time_limit( 0 );
include_once( dirname( __FILE__ )."/../inc/conn.php" );
include_once( dirname( __FILE__ )."/inc/function.php" );
login_check( "system" );
echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd\">\r\n<HTML xmlns=\"http://www.w3.org/1999/xhtml\">\r\n<HEAD>\r\n<TITLE>�����ʷ����--�׷������Ϸϵͳ</TITLE>\r\n<META http-equiv=Content-Type content=\"text/html; charset=gb2312\">\r\n<LINK href=\"images/css_body.css\" type=text/css rel=stylesheet>\r\n<META content=\"MSHTML 6.00.3790.4275\" name=GENERATOR>\r\n</HEAD>\r\n<BODY>\r\n<DIV class=bodytitle>\r\n<DIV class=bodytitleleft></DIV>\r\n<DIV class=bodytitletxt>�����ʷ����</DIV>\r\n</DIV>\r\n";
switch ( $_GET['action'] )
{
case "del" :
		del( );
		addlog( "�����ʷ�ɹ�" );
		showerr( "�����ʷ�ɹ�", "admin_delete.php" );
		break;
default :
		main( );
}
?>
