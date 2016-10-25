<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/

function upinput( )
{
		echo "<S";
		echo "CRIPT language=javascript>\r\nfunction check() \r\n{\r\n\tvar strFileName=document.form.strPhoto.value;\r\n\tif (strFileName==\"\")\r\n\t{\r\n    \talert(\"请选择要上传的文件\");\r\n\t\tdocument.form.strPhoto.focus();\r\n    \treturn false;\r\n  \t}\r\n\treturn true;\r\n}\r\n</SCRIPT>\r\n<form action=\"upadpic.php?action=up&urldir=";
		echo $_GET['urldir'];
		echo "&picname=";
		echo $_GET['picname'];
		echo "\" enctype=\"multipart/form-data\" name=\"form\" method=\"post\" onsubmit=\"if (!check()) return false;\">\r\n<input name=\"strPhoto\" type=\"file\" id=\"strPhoto\" size=\"40\">\r\n<input type=\"submit\" name=\"Submit\" value=\"上 传\" class=inputbut />\r\n</form>\r\n</BODY>\r\n";
}

function upmovie( )
{
		$savePath = dirname( __FILE__ )."/../../".$_GET['urldir'];
		$str = date( "YmdHis" );
		if ( $_FILES['strPhoto']['name'] != "" )
		{
				$tmp_file = $_FILES['strPhoto']['tmp_name'];
				$file_types = explode( ".", $_FILES['strPhoto']['name'] );
				$file_type = $file_types[count( $file_types ) - 1];
				if ( strtolower( $file_type ) != "jpg" & strtolower( $file_type ) != "gif" & strtolower( $file_type ) != "bmp" & strtolower( $file_type ) != "png" )
				{
						echo "<span style=\"color:red;line-height: 25px;\">格式错误请重新上传<a href=# onclick=history.go(-1);>[返回]</a></span>";
						exit( );
				}
				$file_name = $str.".".$file_type;
				if ( !copy( $tmp_file, $savePath.$file_name ) )
				{
						echo "<span style=\"color:red;line-height: 25px;\">上传错误请重试！！<a href=# onclick=history.go(-1);>[返回]</a></span>";
				}
				else
				{
						echo "<span style=\"olor:red;line-height: 25px;\">上传成功</span><script>parent.document.getElementById(\"".$_GET['picname']."\").value=\"".$file_name."\"</script>";
				}
		}
		else
		{
				echo "<span style=\"color:red;line-height: 25px;\">请选择需要上传的文件<a href=# onclick=history.go(-1);>[返回]</a></span>";
		}
}

header( "Content-Type:text/html;charset=GB2312" );
include_once( dirname( __FILE__ )."/../../inc/conn.php" );
include_once( dirname( __FILE__ )."/function.php" );
login_check( "jpgl" );
echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd\">\r\n<HTML xmlns=\"http://www.w3.org/1999/xhtml\">\r\n<HEAD>\r\n<TITLE>图片上传</TITLE>\r\n<META http-equiv=Content-Type content=\"text/html; charset=gb2312\">\r\n<META content=\"MSHTML 6.00.3790.4275\" name=GENERATOR>\r\n";
echo "<s";
echo "tyle type=\"text/css\">\r\n<!--\r\ninput{border-width:1px;border:1px solid #bdbcbd;padding:3px 0 3px 5px;}\r\n.inputbut{padding-left:3px;padding-right:2px;border:1px solid #bdbcbd;background:#FFF url(../images/inputbut_bg.gif) left center repeat-x;font-size:12px;height:24px;}\r\n-->\r\n</style>\r\n</HEAD>\r\n<BODY leftmargin=0 topmargin=0 style=\"font-size:12px\">\r\n";
switch ( $_GET['action'] )
{
case "up" :
		upmovie( );
		break;
default :
		upinput( );
		break;
}
?>
