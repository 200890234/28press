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
		$db->query( "INSERT INTO ".$web_dbtop."payset (paysetname,paysetdocument,pysetreceiver,paysetid,paysetpassword,paysetremarks) VALUES ('{$_POST['paysetname']}','{$_POST['paysetdocument']}','{$_POST['pysetreceiver']}','{$_POST['paysetid']}','{$_POST['paysetpassword']}','{$_POST['paysetremarks']}')" );
}

function sedit( )
{
		global $db;
		global $web_dbtop;
		$db->query( "update ".$web_dbtop."payset set paysetname='{$_POST['paysetname']}',paysetdocument='{$_POST['paysetdocument']}',pysetreceiver='{$_POST['pysetreceiver']}',paysetid='{$_POST['paysetid']}',paysetpassword='{$_POST['paysetpassword']}',paysetremarks='{$_POST['paysetremarks']}' where id={$_POST['id']}" );
}

function del( )
{
		global $db;
		global $web_dbtop;
		$db->query( "delete from ".$web_dbtop."payset where id={$_GET['id']}" );
}

function main( )
{
		global $db;
		global $web_dbtop;
		global $web_dir;
		echo "<TABLE width=\"96%\" border=0 align=center cellpadding=\"5\" cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n  <form name=\"form\" method=\"post\">\r\n    <TBODY>\r\n      <TR bgColor=\"#f5fafe\">\r\n        <TD align=\"center\">接口名称</TD>\r\n        <TD width=\"25%\" align=\"center\">支付接口文件</TD>\r\n        <TD width=\"25%\" align=\"center\">支付接收文件</TD>\r\n        <TD width=\"12%\" align=\"center\">商户号</TD>\r\n        <TD width=\"15%\" align=\"center\">操作</TD>\r\n      </TR>\r\n      ";
		$intpage = 20;
		if ( isset( $_GET['page'] ) )
		{
				$rsnum = ( $_GET['page'] - 1 ) * $intpage;
		}
		else
		{
				$rsnum = 0;
		}
		$sql = "Select * from ".$web_dbtop."payset Order by id asc";
		$query = $db->query( $sql );
		if ( $db->fetch_array( $query ) )
		{
				$intnum = $db->num_rows( $query );
		}
		$query = $db->query( $sql.( " limit ".$rsnum.",{$intpage}" ) );
		while ( $rs = $db->fetch_array( $query ) )
		{
				echo "      <TR bgcolor=\"#FFFFFF\" onMouseOver=\"this.bgColor='#f5fafe'\" onMouseOut=\"this.bgColor='#FFFFFF'\">\r\n        <TD align=\"center\">";
				echo $rs['paysetname'];
				echo "</TD>\r\n        <TD align=\"center\">";
				echo $rs['paysetdocument'];
				echo "</TD>\r\n        <TD align=\"center\">";
				echo $rs['pysetreceiver'];
				echo "</TD>\r\n        <TD align=\"center\">";
				echo $rs['paysetid'];
				echo "</TD>\r\n        <TD align=\"center\"><A href=\"admin_payset.php?action=edit&id=";
				echo $rs['id'];
				echo "\">修改</a> | <A href=\"admin_payset.php?action=del&id=";
				echo $rs['id'];
				echo "\" onClick=\"return confirm('确定要删除吗?');\">删除</a></TD>\r\n      </TR>\r\n      ";
		}
		echo "      <TR bgcolor=\"#f8fbfb\">\r\n        <TD colspan=\"5\" align=\"center\">";
		include_once( dirname( __FILE__ )."/../inc/page_class.php" );
		$page = new page( array(
				"total" => $intnum,
				"perpage" => $intpage
		) );
		echo $page->show( 4, "page", "curr" );
		echo "</TD>\r\n      </TR>\r\n    </TBODY>\r\n  </form>\r\n</TABLE>\r\n";
}

function add( )
{
		echo "<TABLE width=\"96%\" border=0 align=center cellpadding=\"4\" cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n  <form action=\"?action=sadd\" method=\"post\" onSubmit=\"return Validator.Validate(this,3)\">\r\n  <TBODY>\r\n    <TR>\r\n      <TD vAlign=center width=\"20%\" bgColor=#f5fafe>接口名称：</TD>\r\n      <TD bgColor=#ffffff><INPUT id=paysetname size=50 name=paysetname dataType=\"Require\" msg=\"请填写支付接口名称\"></TD>\r\n    </TR>\r\n    <TR>\r\n      <TD bgColor=#f5fafe>支付接口文件：</TD>\r\n      <TD bgColor=#ffffff><INPUT name=paysetdocument id=paysetdocument size=50 dataType=\"Require\" msg=\"请填写支付接口文件\"></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>支付接收文件：</TD>\r\n      <TD bgColor=#ffffff><INPUT name=pysetreceiver id=pysetreceiver size=50 dataType=\"Require\" msg=\"请填写支付接收文件\"></TD>\r\n\t</TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>商户号：</TD>\r\n      <TD bgColor=#ffffff><INPUT name=paysetid id=paysetid size=50 dataType=\"Require\" msg=\"请填写商户号\"></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>商户密钥：</TD>\r\n      <TD bgColor=#ffffff><INPUT name=paysetpassword id=paysetpassword size=50 dataType=\"Require\" msg=\"请填写商户密钥\"></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>备注：</TD>\r\n      <TD bgColor=#ffffff><textarea name=\"paysetremarks\" style=\"width:95%; height:100px\" id=\"paysetremarks\" datatype=\"Require\" msg=\"请填写支付接口名称\"></textarea></TD>\r\n    </TR>\r\n    <TR align=\"center\" bgcolor=\"#f8fbfb\">\r\n      <TD colspan=\"2\"><INPUT class=inputbut type=submit value=添加 name=Submit></TD>\r\n    </TR>\r\n  </TBODY>\r\n  </form>\r\n</TABLE>\r\n<script language=\"javascript\" src=\"inc/js.js\"></script>\r\n";
}

function edit( )
{
		global $db;
		global $web_dbtop;
		$query = $db->query( "Select * from ".$web_dbtop."payset where id={$_GET['id']}" );
		if ( $rs = $db->fetch_array( $query ) )
		{
				echo "<TABLE width=\"96%\" border=0 align=center cellpadding=\"4\" cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n  <form action=\"?action=sedit\" method=\"post\" onSubmit=\"return Validator.Validate(this,3)\">\r\n  <input name=\"id\" type=\"hidden\" value=\"";
				echo $rs['id'];
				echo "\">\r\n  <TBODY>\r\n    <TR>\r\n      <TD vAlign=center width=\"20%\" bgColor=#f5fafe>接口名称：</TD>\r\n      <TD bgColor=#ffffff><INPUT id=paysetname size=50 name=paysetname value=\"";
				echo $rs['paysetname'];
				echo "\" dataType=\"Require\" msg=\"请填写支付接口名称\"></TD>\r\n    </TR>\r\n    <TR>\r\n      <TD bgColor=#f5fafe>支付接口文件：</TD>\r\n      <TD bgColor=#ffffff><INPUT name=paysetdocument id=paysetdocument value=\"";
				echo $rs['paysetdocument'];
				echo "\" size=50 dataType=\"Require\" msg=\"请填写支付接口文件\"></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>支付接收文件：</TD>\r\n      <TD bgColor=#ffffff><INPUT name=pysetreceiver id=pysetreceiver value=\"";
				echo $rs['pysetreceiver'];
				echo "\" size=50 dataType=\"Require\" msg=\"请填写支付接收文件\"></TD>\r\n\t</TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>商户号：</TD>\r\n      <TD bgColor=#ffffff><INPUT name=paysetid id=paysetid value=\"";
				echo $rs['paysetid'];
				echo "\" size=50 dataType=\"Require\" msg=\"请填写商户号\"></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>商户密钥：</TD>\r\n      <TD bgColor=#ffffff><INPUT name=paysetpassword id=paysetpassword value=\"";
				echo $rs['paysetpassword'];
				echo "\" size=50 dataType=\"Require\" msg=\"请填写商户密钥\"></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>备注：</TD>\r\n      <TD bgColor=#ffffff><textarea name=\"paysetremarks\" style=\"width:95%; height:100px\" id=\"paysetremarks\"  datatype=\"Require\" msg=\"请填写支付接口名称\">";
				echo $rs['paysetremarks'];
				echo "</textarea></TD>\r\n    </TR>\r\n    <TR align=\"center\" bgcolor=\"#f8fbfb\">\r\n      <TD colspan=\"2\"><INPUT class=inputbut type=submit value=修改 name=Submit></TD>\r\n    </TR>\r\n  </TBODY>\r\n  </form>\r\n</TABLE>\r\n<script language=\"javascript\" src=\"inc/js.js\"></script>\r\n";
		}
}

include_once( dirname( __FILE__ )."/../inc/conn.php" );
include_once( dirname( __FILE__ )."/inc/function.php" );
login_check( "system" );
echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd\">\r\n<HTML xmlns=\"http://www.w3.org/1999/xhtml\">\r\n<HEAD>\r\n<TITLE>支付接口管理--雷风积分游戏系统</TITLE>\r\n<META http-equiv=Content-Type content=\"text/html; charset=gb2312\">\r\n<LINK href=\"images/css_body.css\" type=text/css rel=stylesheet>\r\n<META content=\"MSHTML 6.00.3790.4275\" name=GENERATOR>\r\n</HEAD>\r\n<BODY>\r\n<DIV class=bodytitle>\r\n<DIV class=bodytitleleft></DIV>\r\n<DIV class=bodytitletxt>支付接口管理</DIV>\r\n<DIV class=bodytitletxt2><a href=\"admin_payset.php?action=add\">添加支付接口</a></DIV>\r\n</DIV>\r\n";
switch ( $_GET['action'] )
{
case "add" :
		add( );
		break;
case "sadd" :
		sadd( );
		addlog( "网站支付接口添加成功" );
		showerr( "网站支付接口添加成功", "admin_payset.php" );
		break;
case "edit" :
		edit( );
		break;
case "sedit" :
		sedit( );
		addlog( "网站支付接口修改成功" );
		showerr( "网站支付接口修改成功", "admin_payset.php" );
		break;
case "del" :
		del( );
		addlog( "网站支付接口删除成功" );
		showerr( "网站支付接口删除成功", "admin_payset.php" );
		break;
default :
		main( );
}
echo "</BODY>\r\n</HTML>\r\n";
?>
