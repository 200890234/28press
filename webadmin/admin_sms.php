<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/

function addsms( )
{
		global $db;
		global $web_dbtop;
		if ( $_POST['mType'] == 1 )
		{
				$query_f = $db->query( "Select id from ".$web_dbtop."users Order by id asc" );
				while ( $rs_f = $db->fetch_array( $query_f ) )
				{
						$db->query( "INSERT INTO ".$web_dbtop."msg (usersid,title,mag,mid,time) VALUES (0,'".$_POST['SmsSubject']."','".$_POST['SmsContent']."',".$rs_f['id'].",'".date( "Y-m-d H:i:s" )."')" );
				}
		}
		else if ( $_POST['mType'] == 2 )
		{
				if ( $_POST['rType'] == 1 )
				{
						$SmsReceiver = intval( $_POST['SmsReceiver'] );
				}
				else
				{
						$SmsReceiver = showid( $_POST['SmsReceiver'] );
				}
				$db->query( "INSERT INTO ".$web_dbtop."msg (usersid,title,mag,mid,time) VALUES (0,'".$_POST['SmsSubject']."','".$_POST['SmsContent']."',".$SmsReceiver.",'".date( "Y-m-d H:i:s" )."')" );
		}
		else if ( $_POST['mType'] == 3 )
		{
				$query_f = $db->query( "Select id from ".$web_dbtop."users where vip=1 Order by id asc" );
				while ( $rs_f = $db->fetch_array( $query_f ) )
				{
						$db->query( "INSERT INTO ".$web_dbtop."msg (usersid,title,mag,mid,time) VALUES (0,'".$_POST['SmsSubject']."','".$_POST['SmsContent']."',".$rs_f['id'].",'".date( "Y-m-d H:i:s" )."')" );
				}
		}
}

function del( )
{
		global $db;
		global $web_dbtop;
		$db->query( "delete from ".$web_dbtop."msg where time < date_add(curdate(),INTERVAL -1 month) and look=1" );
}

function add( )
{
		echo "<DIV class=bodytitle>\r\n<DIV class=bodytitleleft></DIV>\r\n<DIV class=bodytitletxt>短信发送</DIV>\r\n<DIV class=bodytitletxt2><a href=\"admin_sms.php?action=del\">删除一月前已看过短信</a></DIV>\r\n</DIV>\r\n<TABLE width=\"96%\" border=0 align=center cellpadding=\"4\" cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n<form action=\"?action=addSms\" method=\"post\" onSubmit=\"return Validator.Validate(this,3)\">\r\n  <TBODY>\r\n    <TR>\r\n      <TD vAlign=center width=\"20%\" bgColor=#f5fafe>发送方式：</TD>\r\n      <TD bgColor=#ffffff>有所用户<INPUT type=radio CHECKED value=1 name=mType onClick=\"ChangeCut(0);\">&nbsp;&nbsp; 用户名<INPUT type=radio value=2 name=mType onClick=\"ChangeCut(1);\">&nbsp;&nbsp; VIP用户 <INPUT type=radio value=3 name=mType onClick=\"ChangeCut(0);\"></TD>\r\n    </TR>\r\n    <TR id=\"smstype\" style=\"display:none\">\r\n      <TD bgColor=#f5fafe>收件人类型：</TD>\r\n      <TD bgColor=#ffffff>ID<INPUT type=radio CHECKED value=1 name=rType>&nbsp;&nbsp; E-mail<INPUT type=radio value=0 name=rType></TD>\r\n    </TR>\r\n    <TR id=\"smsusers\" style=\"display:none\">\r\n      <TD bgColor=#f5fafe>收信人：</TD>\r\n      <TD bgColor=#ffffff><INPUT name=SmsReceiver value=\"\" size=\"50\"></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>主题：</TD>\r\n      <TD bgColor=#ffffff><INPUT name=SmsSubject value=\"\" size=\"50\" ataType=\"Require\" msg=\"请填写短信主题\"></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>正文：</TD>\r\n      <TD bgColor=#ffffff><TEXTAREA name=SmsContent cols=\"50\" rows=\"7\" ataType=\"Require\" msg=\"请填写短信正文\"></TEXTAREA></TD>\r\n    </TR>\r\n    <TR align=\"center\" bgcolor=\"#f8fbfb\">\r\n      <TD colspan=\"2\"><INPUT class=inputbut type=submit value=发送 name=Submit></TD>\r\n    </TR>\r\n  </TBODY>\r\n  </form>\r\n</TABLE>\r\n<script language=\"javascript\" src=\"inc/movie.js\"></script>\r\n<script language=\"javascript\" src=\"inc/js.js\"></script>\r\n";
}

function sms( )
{
		echo "<TABLE width=\"98%\" border=0 align=center cellpadding=\"4\" cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n<form action=\"?action=addSms\" method=\"post\" onSubmit=\"return Validator.Validate(this,3)\">\r\n<input name=\"mType\" type=\"hidden\" value=\"2\">\r\n<input name=\"rType\" type=\"hidden\" value=\"1\">\r\n<input name=\"SmsReceiver\" type=\"hidden\" value=\"";
		echo $_GET['uid'];
		echo "\">\r\n  <TBODY>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>主题：</TD>\r\n      <TD bgColor=#ffffff><INPUT name=SmsSubject value=\"\" size=\"50\" ataType=\"Require\" msg=\"请填写短信主题\"></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>正文：</TD>\r\n      <TD bgColor=#ffffff><TEXTAREA name=SmsContent cols=\"50\" rows=\"7\" ataType=\"Require\" msg=\"请填写短信正文\"></TEXTAREA></TD>\r\n    </TR>\r\n    <TR align=\"center\" bgcolor=\"#f8fbfb\">\r\n      <TD colspan=\"2\"><INPUT class=inputbut type=submit value=发送 name=Submit></TD>\r\n    </TR>\r\n  </TBODY>\r\n  </form>\r\n</TABLE>\r\n<script language=\"javascript\" src=\"inc/js.js\"></script>\r\n";
}

include_once( dirname( __FILE__ )."/../inc/conn.php" );
include_once( dirname( __FILE__ )."/inc/function.php" );
if ( $_GET['action'] == "sms" )
{
		login_check( 1 );
}
else
{
		login_check( "sms" );
}
echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd\">\r\n<HTML xmlns=\"http://www.w3.org/1999/xhtml\">\r\n<HEAD>\r\n<TITLE>短信发送--雷风积分游戏系统</TITLE>\r\n<META http-equiv=Content-Type content=\"text/html; charset=gb2312\">\r\n<LINK href=\"images/css_body.css\" type=text/css rel=stylesheet>\r\n<META content=\"MSHTML 6.00.3790.4275\" name=GENERATOR>\r\n</HEAD>\r\n<BODY>\r\n";
switch ( $_GET['action'] )
{
case "addSms" :
		addsms( );
		addlog( "发送短信" );
		showerr( "发送短信成功", "admin_sms.php" );
		break;
case "del" :
		del( );
		addlog( "短信删除成功" );
		showerr( "短信删除成功", "admin_sms.php" );
		break;
case "sms" :
		sms( );
		break;
default :
		add( );
}
echo "</BODY>\r\n</HTML>\r\n";
?>
