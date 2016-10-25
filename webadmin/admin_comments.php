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
		$db->query( "update ".$web_dbtop."comments set commentsusers='".$_POST['commentsusers']."',commentscontent='".$_POST['commentscontent']."',commentstime='".date( "Y-m-d" ).( "' where id=".$_POST['id'] ) );
}

function del( )
{
		global $db;
		global $web_dbtop;
		if ( isset( $_POST['id'] ) )
		{
				$id = implode( ",", $_POST['id'] );
		}
		else
		{
				$id = $_GET['id'];
		}
		$db->query( "delete from ".$web_dbtop."comments where id in ({$id})" );
}

function main( )
{
		global $db;
		global $web_dbtop;
		echo "<TABLE width=\"96%\" border=0 align=center cellpadding=\"5\" cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n  <TBODY>\r\n    <TR bgColor=\"#f5fafe\">\r\n\t  <TD width=\"4%\" align=\"center\" >&nbsp;</TD>\r\n      <TD align=\"center\">评论内容</TD>\r\n\t  <TD width=\"20%\" align=\"center\">评论奖品</TD>\r\n\t  <TD width=\"12%\" align=\"center\">评论用户</TD>\r\n      <TD width=\"12%\" align=\"center\">评论时间</TD>\r\n      <TD width=\"10%\" align=\"center\">操作</TD>\r\n    </TR>\r\n\t<form name=\"form\" method=\"post\">\r\n\t";
		$intpage = 20;
		if ( isset( $_GET['page'] ) )
		{
				$rsnum = ( $_GET['page'] - 1 ) * $intpage;
		}
		else
		{
				$rsnum = 0;
		}
		$query = $db->query( "Select * from ".$web_dbtop."comments Order by id desc" );
		if ( $db->fetch_array( $query ) )
		{
				$intnum = $db->num_rows( $query );
		}
		$query = $db->query( "Select * from ".$web_dbtop."comments Order by id desc limit {$rsnum},{$intpage}" );
		while ( $rs = $db->fetch_array( $query ) )
		{
				echo "    <TR bgcolor=\"#FFFFFF\" onMouseOver=\"this.bgColor='#f5fafe'\" onMouseOut=\"this.bgColor='#FFFFFF'\">\r\n\t  <TD align=\"center\"><input name=\"id[]\" type=\"checkbox\" id=\"id[]\" value=\"";
				echo $rs['id'];
				echo "\"></TD>\r\n      <TD>";
				echo $rs['commentscontent'];
				echo "</TD>\r\n\t  <TD align=\"center\">";
				echo showcontent( "commodities", "name", $rs['commoditiesid'] );
				echo "</TD>\r\n\t  <TD align=\"center\">";
				echo $rs['commentsusers'];
				echo "</TD>\r\n      <TD align=\"center\">";
				echo $rs['commentstime'];
				echo "</TD>\r\n      <TD align=\"center\"><A href=\"admin_comments.php?action=edit&id=";
				echo $rs['id'];
				echo "\">修改</a> | <A href=\"admin_comments.php?action=del&id=";
				echo $rs['id'];
				echo "\" onClick=\"return confirm('确定要删除吗?');\">删除</a></TD>\r\n    </TR>\r\n\t";
		}
		echo "\t<TR bgcolor=\"#f8fbfb\">\r\n      <TD align=\"center\"><input name=\"chkall\" type=\"checkbox\" id=\"chkall\" value=\"checkbox\" onClick=\"CheckAll(document.form.chkall.checked);\"></TD>\r\n      <TD colspan=\"5\"><input type=\"button\" name=\"del\" value=\"批量删除\"  onClick=\"document.form.action='?action=del';{if(chkCheckBoxChs('id[]')==false){alert('请至少选择一个影片！');return;}};{if(confirm('确定删除您所选择的影片吗？')){this.document.form.submit();return true;}}\" class=inputbut></TD>\r\n    </TR>\r\n\t</form>\r\n    <TR align=\"center\" bgcolor=\"#f8fbfb\">\r\n      <TD colspan=\"6\">";
		include_once( dirname( __FILE__ )."/../inc/page_class.php" );
		$page = new page( array(
				"total" => $intnum,
				"perpage" => $intpage
		) );
		echo $page->show( 4, "page", "curr" );
		echo "</TD>\r\n    </TR>\r\n  </TBODY>\r\n</TABLE>\r\n<script language=\"javascript\" src=\"inc/movie.js\"></script>\r\n";
}

function edit( )
{
		global $db;
		global $web_dbtop;
		$query = $db->query( "Select * from ".$web_dbtop."comments where id={$_GET['id']}" );
		if ( $rs = $db->fetch_array( $query ) )
		{
				echo "<TABLE width=\"96%\" border=0 align=center cellpadding=\"4\" cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n<form action=\"?action=sedit\" method=\"post\" onSubmit=\"return Validator.Validate(this,3)\">\r\n<input name=\"id\" type=\"hidden\" value=\"";
				echo $rs['id'];
				echo "\">\r\n  <TBODY>\r\n   <TR>\r\n      <TD vAlign=center width=\"20%\" bgColor=#f5fafe>评论奖品：</TD>\r\n      <TD bgColor=#ffffff>";
				echo showcontent( "commodities", "name", $rs['commoditiesid'] );
				echo "</TD>\r\n    </TR>\r\n    <TR>\r\n      <TD vAlign=center width=\"20%\" bgColor=#f5fafe>评论用户：</TD>\r\n      <TD bgColor=#ffffff><INPUT id=\"commentsusers\" size=50 value=\"";
				echo $rs['commentsusers'];
				echo "\" name=\"commentsusers\" dataType=\"Require\" msg=\"请填写奖品评论用户\"></TD>\r\n    </TR>\r\n    <TR>\r\n      <TD bgColor=#f5fafe>评论内容：</TD>\r\n      <TD bgColor=#ffffff><textarea name=\"commentscontent\" style=\"height:320px;width:100%\">";
				echo $rs['commentscontent'];
				echo "</textarea></TD>\r\n    </TR>\r\n    <TR align=\"center\" bgcolor=\"#f8fbfb\">\r\n      <TD colspan=\"2\"><INPUT class=inputbut type=submit value=修改 name=Submit></TD>\r\n    </TR>\r\n  </TBODY>\r\n  </form>\r\n</TABLE>\r\n<script language=\"javascript\" src=\"inc/js.js\"></script>\r\n";
		}
}

include_once( dirname( __FILE__ )."/../inc/conn.php" );
include_once( dirname( __FILE__ )."/inc/function.php" );
login_check( "jpgl" );
echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd\">\r\n<HTML xmlns=\"http://www.w3.org/1999/xhtml\">\r\n<HEAD>\r\n<TITLE>奖品评论管理--雷风积分游戏系统</TITLE>\r\n<META http-equiv=Content-Type content=\"text/html; charset=gb2312\">\r\n<LINK href=\"images/css_body.css\" type=text/css rel=stylesheet>\r\n<META content=\"MSHTML 6.00.3790.4275\" name=GENERATOR>\r\n</HEAD>\r\n<BODY>\r\n<DIV class=bodytitle>\r\n<DIV class=bodytitleleft></DIV>\r\n<DIV class=bodytitletxt>奖品评论管理</DIV>\r\n</DIV>\r\n";
switch ( $_GET['action'] )
{
case "edit" :
		edit( );
		break;
case "sedit" :
		sedit( );
		addlog( "奖品评论修改成功" );
		showerr( "奖品评论修改成功", "admin_comments.php" );
		break;
case "del" :
		del( );
		addlog( "奖品评论删除成功" );
		showerr( "奖品评论删除成功", "admin_comments.php" );
		break;
default :
		main( );
}
echo "</BODY></HTML>\r\n";
?>
