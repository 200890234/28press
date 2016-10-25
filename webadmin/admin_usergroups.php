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
		$db->query( "INSERT INTO ".$web_dbtop."usergroups (name,creditshigher,creditslower,stars,kinddiscount,virtualdiscount,vipkinddiscount,vipvirtualdiscount) VALUES ('".$_POST['name'].( "',".$_POST['creditshigher'].",{$_POST['creditslower']},{$_POST['stars']},{$_POST['kinddiscount']},{$_POST['virtualdiscount']},{$_POST['vipkinddiscount']},{$_POST['vipvirtualdiscount']})" ) );
}

function sedit( )
{
		global $db;
		global $web_dbtop;
		$i = 0;
		for ( ;	$i < count( $_POST['id'] );	++$i	)
		{
				$id = $_POST['id'][$i];
				$db->query( "update ".$web_dbtop."usergroups set name='".$_POST["name_".$id]."',creditshigher=".$_POST["creditshigher_".$id].",creditslower=".$_POST["creditslower_".$id].",stars=".$_POST["stars_".$id].( " where id=".$id ) );
		}
}

function detailsedit( )
{
		global $db;
		global $web_dbtop;
		$db->query( "update ".$web_dbtop."usergroups set name='".$_POST['name']."',creditshigher=".$_POST['creditshigher'].",creditslower=".$_POST['creditslower'].",stars=".$_POST['stars'].",kinddiscount=".$_POST['kinddiscount'].",virtualdiscount=".$_POST['virtualdiscount'].",vipkinddiscount=".$_POST['vipkinddiscount'].",vipvirtualdiscount=".$_POST['vipvirtualdiscount'].( " where id=".$_POST['id'] ) );
}

function del( )
{
		global $db;
		global $web_dbtop;
		$db->query( "delete from ".$web_dbtop."usergroups where id={$_GET['id']}" );
}

function main( )
{
		global $db;
		global $web_dbtop;
		global $web_dir;
		echo "<TABLE width=\"96%\" border=0 align=center cellpadding=\"5\" cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n  <TBODY>\r\n    <TR bgColor=#f5fafe>\r\n      <TD width=\"4%\" align=\"center\" >&nbsp;</TD>\r\n      <TD align=\"center\">组头衔</TD>\r\n      <TD width=\"30%\" align=\"center\">经验介于</TD>\r\n\t  <TD width=\"10%\" align=\"center\">星星数</TD>\r\n      <TD width=\"10%\" align=\"center\">操作</TD>\r\n    </TR>\r\n\t<form action=\"?action=sedit\" method=\"post\" name=\"form\">\r\n\t";
		$query = $db->query( "Select * from ".$web_dbtop."usergroups Order by stars asc,id desc" );
		while ( $rs = $db->fetch_array( $query ) )
		{
				echo "    <TR bgcolor=\"#FFFFFF\">\r\n      <TD align=\"center\"><input name=\"id[]\" type=\"checkbox\" id=\"id[]\" value=\"";
				echo $rs['id'];
				echo "\" checked></TD>\r\n      <TD align=\"center\"><INPUT id=\"name_";
				echo $rs['id'];
				echo "\" size=30 name=\"name_";
				echo $rs['id'];
				echo "\" value=\"";
				echo $rs['name'];
				echo "\"></TD>\r\n      <TD align=\"center\"><INPUT id=\"creditshigher_";
				echo $rs['id'];
				echo "\" size=10 name=\"creditshigher_";
				echo $rs['id'];
				echo "\" value=\"";
				echo $rs['creditshigher'];
				echo "\"> ~  <INPUT id=\"creditslower_";
				echo $rs['id'];
				echo "\" size=10 name=\"creditslower_";
				echo $rs['id'];
				echo "\" value=\"";
				echo $rs['creditslower'];
				echo "\"></TD>\r\n\t  <TD align=\"center\"><INPUT id=\"stars_";
				echo $rs['id'];
				echo "\" size=5 name=\"stars_";
				echo $rs['id'];
				echo "\" value=\"";
				echo $rs['stars'];
				echo "\"></TD>\r\n      <TD align=\"center\"><A href=\"admin_usergroups.php?action=details&id=";
				echo $rs['id'];
				echo "\">详细</a> | <A href=\"admin_usergroups.php?action=del&id=";
				echo $rs['id'];
				echo "\">删除</a></TD>\r\n\t</TR>\r\n\t";
		}
		echo "    <TR bgcolor=\"#FFFFFF\">\r\n      <TD colspan=\"5\" align=\"center\"><INPUT class=inputbut type=submit value=批量修改选中用户组 name=Submit></TD>\r\n    </TR>\r\n\t</form>\r\n  </TBODY>\r\n</TABLE>\r\n";
}

function add( )
{
		global $web_moneynam;
		echo "<TABLE width=\"96%\" border=0 align=center cellpadding=\"4\" cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n  <form action=\"?action=sadd\" method=\"post\" onSubmit=\"return Validator.Validate(this,3)\">\r\n  <TBODY>\r\n    <TR>\r\n      <TD vAlign=center width=\"20%\" bgColor=#f5fafe>组头衔：</TD>\r\n      <TD bgColor=#ffffff><INPUT id=name size=50 name=name dataType=\"Require\" msg=\"请填写用户组名称\"></TD>\r\n    </TR>\r\n    <TR>\r\n      <TD bgColor=#f5fafe>经验介于：</TD>\r\n      <TD bgColor=#ffffff><INPUT name=creditshigher id=creditshigher value=\"0\" size=10 dataType=\"Integer\" msg=\"排序只能为数字\">\r\n        ~ \r\n        <INPUT name=creditslower id=creditslower value=\"0\" size=10 dataType=\"Integer\" msg=\"排序只能为数字\"></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>星星数：</TD>\r\n      <TD bgColor=#ffffff><INPUT name=stars id=stars value=\"0\" size=25 dataType=\"Integer\" msg=\"排序只能为数字\"></TD>\r\n\t</TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>普通用户实物折扣：</TD>\r\n      <TD bgColor=#ffffff><INPUT name=kinddiscount id=kinddiscount value=\"0\" size=25 dataType=\"Require\" msg=\"请填写用户组名称\">\r\n      折 <font color=\"#FF0000\">0为无折扣</font></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>VIP用户实物折扣：</TD>\r\n      <TD bgColor=#ffffff><INPUT name=vipkinddiscount id=vipkinddiscount value=\"0\" size=25 dataType=\"Require\" msg=\"请填写用户组名称\">\r\n        折 <font color=\"#FF0000\">0为无折扣</font></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>普通用户虚拟卡减";
		echo $web_moneyname;
		echo "量：</TD>\r\n      <TD bgColor=#ffffff>减\r\n        <INPUT name=virtualdiscount id=virtualdiscount value=\"0\" size=25 dataType=\"Require\" msg=\"请填写用户组名称\">\r\n        ";
		echo $web_moneyname;
		echo "</TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>VIP用户虚拟卡减";
		echo $web_moneyname;
		echo "量：</TD>\r\n      <TD bgColor=#ffffff>减\r\n        <INPUT name=vipvirtualdiscount id=vipvirtualdiscount value=\"0\" size=25 dataType=\"Require\" msg=\"请填写用户组名称\">\r\n";
		echo $web_moneyname;
		echo "</TD>\r\n    </TR>\r\n    <TR align=\"center\" bgcolor=\"#f8fbfb\">\r\n      <TD colspan=\"2\"><INPUT class=inputbut type=submit value=添加 name=Submit>\r\n      &nbsp;</TD>\r\n    </TR>\r\n  </TBODY>\r\n  </form>\r\n</TABLE>\r\n<script language=\"javascript\" src=\"inc/js.js\"></script>\r\n";
}

function details( )
{
		global $db;
		global $web_dbtop;
		global $web_moneyname;
		$query = $db->query( "Select * from ".$web_dbtop."usergroups where id={$_GET['id']}" );
		if ( $rs = $db->fetch_array( $query ) )
		{
				echo "<TABLE width=\"96%\" border=0 align=center cellpadding=\"4\" cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n  <form action=\"?action=detailsedit\" method=\"post\" onSubmit=\"return Validator.Validate(this,3)\">\r\n  <input name=\"id\" type=\"hidden\" value=\"";
				echo $rs['id'];
				echo "\">\r\n  <TBODY>\r\n    <TR>\r\n      <TD vAlign=center width=\"20%\" bgColor=#f5fafe>组头衔：</TD>\r\n      <TD bgColor=#ffffff><INPUT name=name id=name value=\"";
				echo $rs['name'];
				echo "\" size=50 dataType=\"Require\" msg=\"请填写用户组名称\"></TD>\r\n    </TR>\r\n    <TR>\r\n      <TD bgColor=#f5fafe>经验介于：</TD>\r\n      <TD bgColor=#ffffff><INPUT name=creditshigher id=creditshigher value=\"";
				echo $rs['creditshigher'];
				echo "\" size=10 dataType=\"Integer\" msg=\"排序只能为数字\">\r\n        ~ \r\n        <INPUT name=creditslower id=creditslower value=\"";
				echo $rs['creditslower'];
				echo "\" size=10 dataType=\"Integer\" msg=\"排序只能为数字\"></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>星星数：</TD>\r\n      <TD bgColor=#ffffff><INPUT name=stars id=stars value=\"";
				echo $rs['stars'];
				echo "\" size=25 dataType=\"Integer\" msg=\"排序只能为数字\"></TD>\r\n\t</TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>普通用户实物折扣：</TD>\r\n      <TD bgColor=#ffffff><INPUT name=kinddiscount id=kinddiscount value=\"";
				echo $rs['kinddiscount'];
				echo "\" size=25 dataType=\"Require\" msg=\"请填写用户组名称\">\r\n      折 <font color=\"#FF0000\">0为无折扣</font></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>VIP用户实物折扣：</TD>\r\n      <TD bgColor=#ffffff><INPUT name=vipkinddiscount id=vipkinddiscount value=\"";
				echo $rs['vipkinddiscount'];
				echo "\" size=25 dataType=\"Require\" msg=\"请填写用户组名称\">\r\n        折 <font color=\"#FF0000\">0为无折扣</font></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>普通用户虚拟卡减";
				echo $web_moneyname;
				echo "量：</TD>\r\n      <TD bgColor=#ffffff>减\r\n        <INPUT name=virtualdiscount id=virtualdiscount value=\"";
				echo $rs['virtualdiscount'];
				echo "\" size=25 dataType=\"Require\" msg=\"请填写用户组名称\">\r\n        ";
				echo $web_moneyname;
				echo "</TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>VIP用户虚拟卡减";
				echo $web_moneyname;
				echo "量：</TD>\r\n      <TD bgColor=#ffffff>减\r\n        <INPUT name=vipvirtualdiscount id=vipvirtualdiscount value=\"";
				echo $rs['vipvirtualdiscount'];
				echo "\" size=25 dataType=\"Require\" msg=\"请填写用户组名称\">\r\n";
				echo $web_moneyname;
				echo "</TD>\r\n    </TR>\r\n    <TR align=\"center\" bgcolor=\"#f8fbfb\">\r\n      <TD colspan=\"2\"><INPUT class=inputbut type=submit value=修改 name=Submit></TD>\r\n    </TR>\r\n  </TBODY>\r\n  </form>\r\n</TABLE>\r\n<script language=\"javascript\" src=\"inc/js.js\"></script>\r\n";
		}
}

include_once( dirname( __FILE__ )."/../inc/conn.php" );
include_once( dirname( __FILE__ )."/inc/function.php" );
login_check( "users" );
echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd\">\r\n<HTML xmlns=\"http://www.w3.org/1999/xhtml\">\r\n<HEAD>\r\n<TITLE>用户组管理--雷风积分游戏系统</TITLE>\r\n<META http-equiv=Content-Type content=\"text/html; charset=gb2312\">\r\n<LINK href=\"images/css_body.css\" type=text/css rel=stylesheet>\r\n<META content=\"MSHTML 6.00.3790.4275\" name=GENERATOR>\r\n</HEAD>\r\n<BODY>\r\n<DIV class=bodytitle>\r\n<DIV class=bodytitleleft></DIV>\r\n<DIV class=bodytitletxt>用户组管理</DIV>\r\n<DIV class=bodytitletxt2><a href=\"admin_usergroups.php?action=add\">添加用户组</a></DIV>\r\n</DIV>\r\n";
switch ( $_GET['action'] )
{
case "add" :
		add( );
		break;
case "sadd" :
		sadd( );
		addlog( "网站用户组添加成功" );
		showerr( "网站用户组添加成功", "admin_usergroups.php" );
		break;
case "sedit" :
		sedit( );
		addlog( "网站用户组修改成功" );
		showerr( "网站用户组修改成功", "admin_usergroups.php" );
		break;
case "details" :
		details( );
		break;
case "detailsedit" :
		detailsedit( );
		addlog( "网站用户组修改成功" );
		showerr( "网站用户组修改成功", "admin_usergroups.php" );
		break;
case "del" :
		del( );
		addlog( "网站用户组删除成功" );
		showerr( "网站用户组删除成功", "admin_usergroups.php" );
		break;
default :
		main( );
}
echo "</BODY>\r\n</HTML>\r\n";
?>
