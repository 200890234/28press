<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/

function audit( )
{
		global $db;
		global $web_dbtop;
		global $web_authentication;
		global $web_moneyname;
		$db->query( "update ".$web_dbtop."users set authentication=1,points=points+{$web_authentication} where id={$_GET['id']}" );
		$db->query( "update ".$web_dbtop."game_log set sfyz_hd={$web_authentication} where uid={$_GET['id']}" );
		$db->query( "update ".$web_dbtop."webtj set authenticationnum=authenticationnum+1,authenticationpoints=authenticationpoints+{$web_authentication} where time='".date( "Y-m-d" )."'" );
		userslog( 3, "通过身份验证", $web_authentication, 0, $_GET['id'] );
		$db->query( "INSERT INTO ".$web_dbtop."msg (usersid,title,mag,mid,time) VALUES (0,'身份验证通知','您已经通过我们的身份验证，并且获得".$web_authentication.$web_moneyname."的奖励，谢谢您对我们的支持。',".$_GET['id'].",'".date( "Y-m-d H:i:s" )."')" );
}

function del( )
{
		global $db;
		global $web_dbtop;
		$query = $db->query( "Select cardpic from ".$web_dbtop."users where id=".$_GET['id'] );
		if ( $rs = $db->fetch_array( $query ) )
		{
				deletefile( "../".$rs['cardpic'] );
		}
		$db->query( "update ".$web_dbtop."users set rname='',card='',cardpic='',authentication=0 where id=".$_GET['id'] );
		$db->query( "INSERT INTO ".$web_dbtop."msg (usersid,title,mag,mid,time) VALUES (0,'身份验证通知','对不起您的身份验证信息有误，请核对后再次提交。',".$_GET['id'].",'".date( "Y-m-d H:i:s" )."')" );
}

function main( )
{
		global $db;
		global $web_dbtop;
		echo "<DIV class=bodytitle>\r\n<DIV class=bodytitleleft></DIV>\r\n<DIV class=bodytitletxt>身份验证</DIV>\r\n</DIV>\r\n<TABLE width=\"96%\" border=0 align=center cellpadding=0 cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n  <TBODY>\r\n    <TR>\r\n      <TD bgColor=#f5fafe><table width=\"96%\" border=\"0\" align=\"center\" cellpadding=\"3\" cellspacing=\"1\">\r\n          <tr>\r\n            <form action=\"admin_authentication.php\" method=\"get\">\r\n              <td width=\"10%\"><strong>搜索用户：</strong></td>\r\n              <td width=\"21%\"><input id=keyword size=20 name=keyword></td>\r\n              <td width=\"10%\" align=\"center\"><INPUT class=inputbut type=submit value=搜索 name=Submit></td>\r\n            </form>\r\n            <td width=\"10%\"></td>\r\n            <td width=\"35%\"></td>\r\n          </tr>\r\n      </table></TD>\r\n    </TR>\r\n  </TBODY>\r\n</TABLE>\r\n<TABLE width=\"96%\" border=0 align=center cellpadding=\"5\" cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n  <TBODY>\r\n    <TR bgColor=\"#f5fafe\">\r\n      <TD align=\"center\">用户ID</TD>\r\n      <TD align=\"center\">用户E-mail</TD>\r\n\t  <TD align=\"center\" width=\"15%\">登陆IP</TD>\r\n      <TD width=\"15%\" align=\"center\">真实姓名</TD>\r\n      <TD width=\"15%\" align=\"center\">身份证号码</TD>\r\n      <TD width=\"15%\" align=\"center\">操作</TD>\r\n    </TR>\r\n\t";
		$intpage = 20;
		if ( isset( $_GET['page'] ) )
		{
				$rsnum = ( $_GET['page'] - 1 ) * $intpage;
		}
		else
		{
				$rsnum = 0;
		}
		$sorting = $_REQUEST['sorting'] ? ( $sorting = $_REQUEST['sorting'] ) : "id";
		$sql = "Select * from ".$web_dbtop."users where rname!='' and card!='' and cardpic!='' and authentication!=1";
		if ( $_REQUEST['keyword'] )
		{
				$sql .= " and (name like '%".trim( $_REQUEST['keyword'] )."%' or email like '%".trim( $_REQUEST['keyword'] )."%')";
		}
		$sql .= " Order by ".$sorting." desc";
		$query = $db->query( $sql );
		if ( $db->fetch_array( $query ) )
		{
				$intnum = $db->num_rows( $query );
		}
		$query = $db->query( $sql.( " limit ".$rsnum.",{$intpage}" ) );
		while ( $rs = $db->fetch_array( $query ) )
		{
				echo "    <TR bgcolor=\"#FFFFFF\" onMouseOver=\"this.bgColor='#f5fafe'\" onMouseOut=\"this.bgColor='#FFFFFF'\">\r\n      <TD align=\"center\">";
				echo $rs['id'];
				echo " <a href=\"#\" onclick=\"AddWin('W_HD_";
				echo $rs['id'];
				echo "','用户 ";
				echo $rs['id'];
				echo " 数据核对','admin_usersdz.php?id=";
				echo $rs['id'];
				echo "',480,340,0);return false\"><img src=\"images/CreateFormMoreFormsGallery.gif\" width=\"16\" height=\"16\"></a></TD>\r\n      <TD align=\"center\">";
				echo $rs['email'];
				echo "</TD>\r\n\t  <TD align=\"center\">";
				echo $rs['loginip'];
				echo "</TD>\r\n      <TD align=\"center\">";
				echo $rs['rname'];
				echo "</TD>\r\n      <TD align=\"center\">";
				echo $rs['card'];
				echo "</TD>\r\n      <TD align=\"center\"><a href=\"#\" onclick=\"AddWin('W_SFYZ_";
				echo $rs['id'];
				echo "','用户 ";
				echo $rs['id'];
				echo " 身份验证审核','admin_authentication.php?action=look&id=";
				echo $rs['id'];
				echo "',550,350,0);return false\">审核</a> | <A href=\"admin_authentication.php?action=del&id=";
				echo $rs['id'];
				echo "\" onClick=\"return confirm('确定要删除吗?');\">删除</a></TD>\r\n    </TR>\r\n\t";
		}
		echo "    <TR bgcolor=\"#f8fbfb\">\r\n      <TD colspan=\"6\" align=\"center\">";
		include_once( dirname( __FILE__ )."/../inc/page_class.php" );
		$page = new page( array(
				"total" => $intnum,
				"perpage" => $intpage
		) );
		echo $page->show( 4, "page", "curr" );
		echo "</TD>\r\n    </TR>\r\n  </TBODY>\r\n</TABLE>\r\n<script language=\"javascript\" src=\"inc/QJ_Display.js\"></script>\r\n";
}

function look( )
{
		global $db;
		global $web_dbtop;
		global $web_dir;
		global $web_cardiddir;
		$query = $db->query( "Select * from ".$web_dbtop."users where id={$_GET['id']}" );
		if ( $rs = $db->fetch_array( $query ) )
		{
				echo "<TABLE width=\"98%\" border=0 align=center cellpadding=\"4\" cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n  <TBODY>\r\n    <TR>\r\n      <TD vAlign=center width=\"25%\" bgColor=#f5fafe>用户ID：</TD>\r\n      <TD bgColor=#ffffff>";
				echo $rs['id'];
				echo " <a href=\"#\" onclick=\"parent.AddWin('W_HD_";
				echo $rs['id'];
				echo "','用户 ";
				echo $rs['id'];
				echo " 数据核对','admin_usersdz.php?id=";
				echo $rs['id'];
				echo "',480,340,0);return false\"><img src=\"images/CreateFormMoreFormsGallery.gif\" width=\"16\" height=\"16\"></a></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>真实姓名：</TD>\r\n      <TD bgColor=#ffffff>";
				echo $rs['rname'];
				echo "</TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>身份证号码：</TD>\r\n      <TD bgColor=#ffffff>";
				echo $rs['card'];
				echo "</TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>身份证扫描图片：</TD>\r\n      <TD bgColor=#ffffff><img src=\"";
				echo $web_dir.$web_cardiddir.$rs['cardpic'];
				echo "\" width=\"320\" height=\"200\"></TD>\r\n    </TR>\r\n\t";
				if ( $rs['authentication'] != 1 )
				{
						echo "    <TR align=\"center\" bgcolor=\"#f8fbfb\">\r\n      <TD colspan=\"2\"><INPUT class=inputbut type=submit value=审核 name=Submit onClick=\"if(confirm('确定通过审核吗?')){location.href='admin_authentication.php?action=audit&id=";
						echo $rs['id'];
						echo "&url=";
						echo $_SERVER['HTTP_REFERER'];
						echo "';return true;}\"> <INPUT class=inputbut type=submit value=删除 name=Submit onClick=\"if(confirm('确定要删除吗?')){location.href='admin_authentication.php?action=del&id=";
						echo $rs['id'];
						echo "&url=";
						echo $_SERVER['HTTP_REFERER'];
						echo "';return true;}\"></TD>\r\n    </TR>\r\n\t";
				}
				echo "  </TBODY>\r\n</TABLE>\r\n";
		}
}

include_once( dirname( __FILE__ )."/../inc/conn.php" );
include_once( dirname( __FILE__ )."/inc/function.php" );
login_check( "users" );
echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd\">\r\n<HTML xmlns=\"http://www.w3.org/1999/xhtml\">\r\n<HEAD>\r\n<TITLE>身份验证--雷风积分游戏系统</TITLE>\r\n<META http-equiv=Content-Type content=\"text/html; charset=gb2312\">\r\n<LINK href=\"images/css_body.css\" type=text/css rel=stylesheet>\r\n<META content=\"MSHTML 6.00.3790.4275\" name=GENERATOR>\r\n</HEAD>\r\n<BODY>\r\n";
switch ( $_GET['action'] )
{
case "look" :
		look( );
		break;
case "audit" :
		audit( );
		addlog( "身份验证成功" );
		echo "<script language=javascript>alert(\"身份验证成功\");parent.location.href=\"".$_GET['url']."\";parent.AddClose(\"NewW_DG_".intval( $_GET['id'] )."\");</script>";
		break;
case "del" :
		del( );
		addlog( "删除身份验证成功" );
		if ( $_GET['url'] )
		{
				echo "<script language=javascript>alert(\"删除身份验证成功\");parent.location.href=\"".$_GET['url']."\";parent.AddClose(\"NewW_DG_".intval( $_GET['id'] )."\");</script>";
		}
		else
		{
				showerr( "删除身份验证成功", $_SERVER['HTTP_REFERER'] );
				break;
		}
default :
		main( );
}
echo "</BODY></HTML>\r\n";
?>
