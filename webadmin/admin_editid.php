<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/

function sedit( )
{
		global $db;
		global $web_dbtop;
		$db->query( "alter table ".$web_dbtop."users auto_increment =".$_POST['ksid'] );
		$db->query( "update ".$web_dbtop."editid set ksid=".$_POST['ksid'].",content='".$_POST['content'].( "' where id=".$_POST['id'] ) );
}

function edit( )
{
		global $db;
		global $web_dbtop;
		$query = $db->query( "Select * from ".$web_dbtop."editid where id=1" );
		if ( $rs = $db->fetch_array( $query ) )
		{
				echo "<TABLE width=\"96%\" border=0 align=center cellpadding=\"4\" cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n<form action=\"?action=sedit\" method=\"post\" onSubmit=\"return Validator.Validate(this,3)\">\r\n<input name=\"id\" type=\"hidden\" value=\"";
				echo $rs['id'];
				echo "\">\r\n  <TBODY>\r\n  <TR>\r\n      <TD bgColor=#f5fafe>起始ID设置：</TD>\r\n      <TD bgColor=#ffffff><INPUT name=\"ksid\" id=\"ksid\" value=\"";
				echo $rs['ksid'];
				echo "\" size=50 dataType=\"Integer\" msg=\"起始ID格式不正确\"></TD>\r\n    </TR>\r\n    <TR>\r\n      <TD bgColor=#f5fafe>保留ID设置：</TD>\r\n      <TD bgColor=#ffffff><textarea name=\"content\" style=\"height:320px;width:680px\">";
				echo $rs['content'];
				echo "</textarea></TD>\r\n    </TR>\r\n    <TR align=\"center\" bgcolor=\"#f8fbfb\">\r\n      <TD colspan=\"2\"><INPUT class=inputbut type=submit value=修改 name=Submit></TD>\r\n    </TR>\r\n  </TBODY>\r\n  </form>\r\n</TABLE>\r\n<script language=\"javascript\" src=\"inc/js.js\"></script>\r\n";
		}
}

include_once( dirname( __FILE__ )."/../inc/conn.php" );
include_once( dirname( __FILE__ )."/inc/function.php" );
login_check( "system" );
echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd\">\r\n<HTML xmlns=\"http://www.w3.org/1999/xhtml\">\r\n<HEAD>\r\n<TITLE>保留ID设置--雷风积分游戏系统</TITLE>\r\n<META http-equiv=Content-Type content=\"text/html; charset=gb2312\">\r\n<LINK href=\"images/css_body.css\" type=text/css rel=stylesheet>\r\n<META content=\"MSHTML 6.00.3790.4275\" name=GENERATOR>\r\n</HEAD>\r\n<BODY>\r\n<DIV class=bodytitle>\r\n<DIV class=bodytitleleft></DIV>\r\n<DIV class=bodytitletxt>保留ID设置</DIV>\r\n</DIV>\r\n";
switch ( $_GET['action'] )
{
case "sedit" :
		sedit( );
		addlog( "保留ID设置修改成功" );
		showerr( "保留ID设置修改成功", "admin_editid.php" );
		break;
default :
		edit( );
}
echo "</BODY></HTML>\r\n";
?>
