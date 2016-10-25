<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/

include_once( dirname( __FILE__ )."/../inc/conn.php" );
include_once( dirname( __FILE__ )."/inc/function.php" );
login_check( 1 );
$pass = "<font color=green><strong>√</strong></font>";
$error = "<font color=red><strong>×</strong></font>";
echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd\">\r\n<HTML xmlns=\"http://www.w3.org/1999/xhtml\">\r\n<HEAD>\r\n<TITLE>系统基本信息--雷风积分游戏系统</TITLE>\r\n<META http-equiv=Content-Type content=\"text/html; charset=gb2312\">\r\n<LINK href=\"images/css_body.css\" type=text/css rel=stylesheet>\r\n<META content=\"MSHTML 6.00.3790.4275\" name=GENERATOR>\r\n</HEAD>\r\n<BODY>\r\n<DIV class=bodytitle>\r\n<DIV class=bodytitleleft></DIV>\r\n<DIV class=bodytitletxt>系统基本信息</DIV></DIV>\r\n<TABLE width=\"96%\" border=0 align=center cellpadding=\"5\" cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n  <TBODY>\r\n  <TR>\r\n    <TD vAlign=center width=\"20%\" bgColor=#f5fafe>服务器域名/IP：</TD>\r\n    <TD bgColor=#ffffff>";
echo $_SERVER['SERVER_NAME'];
echo " | ";
echo empty( $_SERVER['REMOTE_ADDR'] ) ? $_SERVER['REMOTE_HOST'] : $_SERVER['REMOTE_ADDR'];
echo "</TD>\r\n  </TR>\r\n  <TR>\r\n    <TD bgColor=#f5fafe>请求的端口：</TD>\r\n    <TD bgColor=#ffffff>";
echo $_SERVER['SERVER_PORT'];
echo "</TD>\r\n  </TR>\r\n  <TR>\r\n    <TD bgColor=#f5fafe>脚本解释引擎：</TD>\r\n    <TD bgColor=#ffffff>";
echo $_SERVER['SERVER_SOFTWARE'];
echo "</TD>\r\n  </TR>\r\n  <TR>\r\n    <TD bgColor=#f5fafe>服务器操作系统：</TD>\r\n    <TD bgColor=#ffffff>";
echo PHP_OS;
echo "</TD>\r\n  </TR>\r\n  <TR>\r\n    <TD bgColor=#f5fafe>站点物理路径：</TD>\r\n    <TD bgColor=#ffffff>";
echo dirname( __FILE__ );
echo "</TD>\r\n  </TR>\r\n  <TR>\r\n    <TD bgColor=#f5fafe>MySQL数据库支持：</TD>\r\n    <TD bgColor=#ffffff>";
echo function_exists( mysql_close ) ? $pass : $error;
echo "</TD>\r\n  </TR>\r\n  <TR>\r\n    <TD bgColor=#f5fafe>允许上传文件最大值：</TD>\r\n    <TD bgColor=#ffffff>";
echo get_cfg_var( "file_uploads" ) ? get_cfg_var( "upload_max_filesize" ) : $error;
echo "</TD>\r\n  </TR>\r\n  <TR>\r\n    <TD bgColor=#f5fafe>XML解析：</TD>\r\n    <TD bgColor=#ffffff>";
echo function_exists( xml_set_object ) ? $pass : $error;
echo "</TD>\r\n  </TR>\r\n  <TR>\r\n    <TD bgColor=#f5fafe>file_get_contents支持：</TD>\r\n    <TD bgColor=#ffffff>";
echo function_exists( file_get_contents ) ? $pass : $error;
echo "</TD>\r\n  </TR>\r\n</TBODY>\r\n</TABLE>\r\n<DIV class=bodytitle>\r\n<DIV class=bodytitleleft></DIV>\r\n<DIV class=bodytitletxt>关于我们</DIV></DIV>\r\n<TABLE class=tbtitle style=\"BACKGROUND: #cad9ea\" cellSpacing=1 cellPadding=5 width=\"96%\" align=center border=0>\r\n  <TBODY>\r\n  <TR>\r\n    <TD vAlign=center width=\"20%\" bgColor=#f5fafe>技术论坛：</TD>\r\n    <TD bgColor=#ffffff><A href=\"http://bbs.leifengcms.cn\" target=_blank>http://bbs.leifengcms.cn</a></TD>\r\n  </TR>\r\n  <TR>\r\n    <TD bgColor=#f5fafe>软件版本信息：</TD>\r\n    <TD bgColor=#ffffff>";
echo $web_version;
echo "</TD>\r\n  </TR>\r\n  <TR align=\"center\" bgcolor=\"#f5fafe\">\r\n    <TD colspan=\"2\">Copyright &copy; 2007-2009 All rights reserved.<A href=\"http://www.leifengcms.cn\" target=_blank>雷风积分游戏系统</A></TD>\r\n    </TR>\r\n</TBODY>\r\n</TABLE>\r\n</BODY></HTML>\r\n";
?>
