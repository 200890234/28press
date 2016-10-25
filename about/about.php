<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/

include_once( "../inc/conn.php" );
include_once( "../inc/function.php" );
echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd\">\r\n<HTML xmlns=\"http://www.w3.org/1999/xhtml\">\r\n<HEAD>\r\n<TITLE>玩游戏赚Q币，赢大奖-";
echo $web_name;
echo "</TITLE>\r\n<META http-equiv=Content-Type content=\"text/html; charset=gb2312\">\r\n<META http-equiv=X-UA-Compatible content=IE=EmulateIE7>\r\n<META content=\"";
echo $web_keywords;
echo "\" name=keywords>\r\n<META content=\"";
echo $web_description;
echo "\" name=description>\r\n<META http-equiv=X-UA-Compatible content=IE=EmulateIE7>\r\n<LINK href=\"style/aboutus.css\" type=text/css rel=stylesheet>\r\n<BODY>\r\n<DIV id=layout>\r\n\t<DIV class=header>\r\n\t\t<DIV class=\"logo\"><a href=\"";
echo $web_url;
echo "\" title=\"";
echo $web_name;
echo "\" target=\"_self\"><img src=\"";
echo $web_dir;
echo $web_logo;
echo "\" alt=\"";
echo $web_name;
echo "\" border=\"0\" /></a></DIV>\r\n\t\t<DIV class=menu>\r\n\t";
$query = $db->query( "Select * from {$web_dbtop}about Order by sort asc,id desc" );
while ( $rs = $db->fetch_array( $query ) )
{
		echo "<A href=\"about.php?id=".$rs['id']."\">".$rs['title']."</A>";
}
$query = $db->query( "Select * from {$web_dbtop}about where id=".intval( $_GET['id'] )." Order by sort asc,id desc" );
if ( $rs = $db->fetch_array( $query ) )
{
		$title = $rs['title'];
		$content = $rs['content'];
}
echo "\t\t</DIV>\r\n\t</DIV>\r\n\t<DIV class=content>\r\n\t\t<H2>";
echo $title;
echo "</H2>\r\n\t\t<DIV class=main>\r\n\t\t\t";
echo $content;
echo "\t\t</DIV>\r\n\t</DIV>\r\n\t<DIV class=footer>Copyright &copy; 2008-2009 <A href=\"";
echo $web_url;
echo "\" target=_blank>";
echo $web_name;
echo "</A> 保留所有权利</DIV>\r\n</DIV>\r\n</BODY>\r\n</HTML>\r\n";
?>
