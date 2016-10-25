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
		$db->query( "INSERT INTO ".$web_dbtop."cardtype (cardname,cardpic,cardprice,cardtop,cardlen,cardtype,ueid,uevip,to_card,viplength,uapoints,uaexperience,udapoints,udaexperience,length,`show`,shopurl,content) VALUES ('{$_POST['cardname']}','{$_POST['cardpic']}',{$_POST['cardprice']},'{$_POST['cardtop']}',{$_POST['cardlen']},{$_POST['cardtype']},".intval( $_POST['ueid'] ).",".intval( $_POST['uevip'] ).",".intval( $_POST['to_card'] ).( ",".$_POST['viplength'].",{$_POST['uapoints']},{$_POST['uaexperience']},{$_POST['udapoints']},{$_POST['udaexperience']},{$_POST['length']}," ).intval( $_POST['show'] ).( ",'".$_POST['shopurl']."','{$_POST['content']}')" ) );
}

function sedit( )
{
		global $db;
		global $web_dbtop;
		$sql = "update ".$web_dbtop."cardtype set cardname='{$_POST['cardname']}',cardpic='{$_POST['cardpic']}',cardprice={$_POST['cardprice']},cardtop='{$_POST['cardtop']}',cardlen={$_POST['cardlen']},cardtype={$_POST['cardtype']},ueid=".intval( $_POST['ueid'] ).",uevip=".intval( $_POST['uevip'] ).   ",to_card=".intval( $_POST['to_card'] ).  ( ",viplength=".$_POST['viplength'].",uapoints={$_POST['uapoints']},uaexperience={$_POST['uaexperience']},udapoints={$_POST['udapoints']},udaexperience={$_POST['udaexperience']},length={$_POST['length']},`show`=" ).intval( $_POST['show'] ).( ",shopurl='".$_POST['shopurl']."',content='{$_POST['content']}' where id={$_POST['id']}" );
		$query = $db->query( $sql );
}

function del( )
{
		global $db;
		global $web_dbtop;
		$db->query( "delete from ".$web_dbtop."cardtype where id = {$_GET['id']}" );
		$db->query( "delete from ".$web_dbtop."card where cardtype = {$_GET['id']}" );
}

function main( )
{
		global $db;
		global $web_dbtop;
		global $web_moneyname;
		echo "<TABLE width=\"96%\" border=0 align=center cellpadding=\"5\" cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n  <TBODY>\r\n    <TR bgColor=\"#f5fafe\">\r\n      <TD align=\"center\">名称</TD>\r\n\t  <TD width=\"10%\" align=\"center\">充值卡价格</TD>\r\n\t  <TD width=\"5%\" align=\"center\">ID</TD>\r\n      <TD width=\"5%\" align=\"center\">VIP</TD>\r\n      <TD width=\"10%\" align=\"center\">增加";
		echo $web_moneyname;
		echo "</TD>\r\n      <TD width=\"8%\" align=\"center\">增加经验</TD>\r\n      <TD width=\"8%\" align=\"center\">每日";
		echo $web_moneyname;
		echo "</TD>\r\n      <TD width=\"8%\" align=\"center\">每日经验</TD>\r\n      <TD width=\"8%\" align=\"center\">领取时长</TD>\r\n      <TD width=\"12%\" align=\"center\">操作</TD>\r\n    </TR>\r\n\t";
		$query = $db->query( "Select * from ".$web_dbtop."cardtype Order by id desc" );
		while ( $rs = $db->fetch_array( $query ) )
		{
				echo "    <TR bgcolor=\"#FFFFFF\" onMouseOver=\"this.bgColor='#f5fafe'\" onMouseOut=\"this.bgColor='#FFFFFF'\">\r\n      <TD align=\"center\">";
				echo $rs['cardname'];
				echo "</TD>\r\n\t  <TD align=\"center\">";
				echo $rs['cardprice'];
				echo " 元</TD>\r\n      <TD align=\"center\">";
				echo $rs['ueid'] == 1 ? "<IMG src=\"images/icon_01.gif\">" : "<IMG src=\"images/icon_02.gif\">";
				echo "</TD>\r\n      <TD align=\"center\">";
				echo $rs['uevip'] == 1 ? "<IMG src=\"images/icon_01.gif\">" : "<IMG src=\"images/icon_02.gif\">";
				echo "</TD>\r\n      <TD align=\"center\">";
				echo number_format( $rs['uapoints'] );
				echo "<IMG height=10 alt=";
				echo $web_moneyname;
				echo " src=\"images/jd0.gif\" width=10></TD>\r\n      <TD align=\"center\">";
				echo $rs['uaexperience'];
				echo "</TD>\r\n      <TD align=\"center\">";
				echo number_format( $rs['udapoints'] );
				echo "<IMG height=10 alt=";
				echo $web_moneyname;
				echo " src=\"images/jd0.gif\" width=10></TD>\r\n      <TD align=\"center\">";
				echo $rs['udaexperience'];
				echo "</TD>\r\n      <TD align=\"center\">";
				echo $rs['length'];
				echo " 天</TD>\r\n      <TD align=\"center\"><A href=\"admin_cardtype.php?action=edit&id=";
				echo $rs['id'];
				echo "\">修改</a> | <A href=\"admin_cardtype.php?action=del&id=";
				echo $rs['id'];
				echo "\" onClick=\"return confirm('确定要删除吗?自动将自动删除该类型下的所有充值卡!');\">删除</a></TD>\r\n    </TR>\r\n\t";
		}
		echo "  </TBODY>\r\n</TABLE>\r\n";
}

function add( )
{
		global $web_carddir;
		echo "<TABLE width=\"96%\" border=0 align=center cellpadding=\"4\" cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n<form action=\"?action=sadd\" method=\"post\" onSubmit=\"return Validator.Validate(this,3)\">\r\n  <TBODY>\r\n  \t<TR>\r\n      <TD vAlign=center width=\"20%\" bgColor=#f5fafe>充值卡名称：</TD>\r\n      <TD bgColor=#ffffff><INPUT id=\"cardname\" size=50 name=\"cardname\" dataType=\"Require\" msg=\"充值卡名称不能为空\"></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD vAlign=center width=\"20%\" bgColor=#f5fafe>充值卡图片：</TD>\r\n      <TD bgColor=#ffffff><INPUT id=\"cardpic\" size=50 name=\"cardpic\"></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD vAlign=center width=\"20%\" bgColor=#f5fafe>上传图片：</TD>\r\n      <TD bgColor=#ffffff><iframe src=\"inc/upadpic.php?urldir=";
		echo $web_carddir;
		echo "&picname=cardpic\" width=\"600\" height=\"25\" frameborder=\"0\" scrolling=\"no\"></iframe></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>充值卡价格：</TD>\r\n      <TD bgColor=#ffffff><INPUT name=\"cardprice\" id=\"cardprice\" value=\"0\" size=20 dataType=\"Double\" msg=\"充值卡价格格式不正确\"> 元</TD>\r\n    </TR>\r\n    <TR>\r\n      <TD bgColor=#f5fafe>自定义卡头：</TD>\r\n      <TD bgColor=#ffffff><INPUT id=\"cardtop\" size=5 name=\"cardtop\" dataType=\"LimitB\" min=\"0\" max=\"3\" msg=\"0~3位英文或数字\"> <font color=\"#FF0000\">*</font>0~3位英文或数字,推荐2位</TD>\r\n    </TR>\r\n    <TR>\r\n      <TD bgColor=#f5fafe>随机位数：</TD>\r\n      <TD bgColor=#ffffff>\r\n        <select name=\"cardlen\" size=\"1\">\r\n          <option value=\"5\">5位</option>\r\n          <option value=\"6\">6位</option>\r\n          <option value=\"7\">7位</option>\r\n          <option value=\"8\" selected>8位</option>\r\n          <option value=\"9\">9位</option>\r\n          <option value=\"10\">10位</option>\r\n          <option value=\"11\">11位</option>\r\n          <option value=\"12\">12位</option>\r\n          <option value=\"13\">13位</option>\r\n          <option value=\"14\">14位</option>\r\n          <option value=\"15\">15位</option>\r\n\t\t  <option value=\"16\">16位</option>\r\n\t\t  <option value=\"17\">17位</option>\r\n\t\t  <option value=\"18\">18位</option>\r\n\t\t  <option value=\"19\">19位</option>\r\n\t\t  <option value=\"20\">20位</option>\r\n        </select></TD>\r\n    </TR>\r\n    <TR>\r\n      <TD bgColor=#f5fafe>随机数类型：</TD>\r\n      <TD bgColor=#ffffff>\r\n        <select name=\"cardtype\" size=\"1\">\r\n          <option value=\"0\">数字</option>\r\n          <option value=\"1\" selected>数字+大写字母</option>\r\n          <option value=\"2\">数字＋大写字母＋小写字母</option>\r\n        </select></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>修改ID：</TD>\r\n      <TD bgColor=#ffffff><input name=\"ueid\" type=\"checkbox\" value=\"1\">\r\n      也就是可以设置靓号</TD>\r\n\t</TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>升级VIP：</TD>\r\n      <TD bgColor=#ffffff><input name=\"uevip\" type=\"checkbox\" value=\"1\"></TD>\r\n\t</TR>\r\n\t<TR>\r\n     \r\n\t</TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>VIP时长：</TD>\r\n      <TD bgColor=#ffffff><input name=\"viplength\" id=\"viplength\" value=\"0\" size=\"20\" ataType=\"Integer\" msg=\"对不起,请填写数字格式\"> 天</TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>增加";
		echo $web_moneyname;
		echo "：</TD>\r\n      <TD bgColor=#ffffff><INPUT name=\"uapoints\" id=\"uapoints\" value=\"0\" size=20 dataType=\"Integer\" msg=\"对不起,请填写数字格式\"></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>增加经验：</TD>\r\n      <TD bgColor=#ffffff><INPUT name=\"uaexperience\" id=\"uaexperience\" value=\"0\" size=20 dataType=\"Integer\" msg=\"对不起,请填写数字格式\"></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>每日领取";
		echo $web_moneyname;
		echo "：</TD>\r\n      <TD bgColor=#ffffff><INPUT name=\"udapoints\" id=\"udapoints\" value=\"0\" size=20 dataType=\"Integer\" msg=\"对不起,请填写数字格式\"></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>每日领取经验：</TD>\r\n      <TD bgColor=#ffffff><INPUT name=\"udaexperience\" id=\"udaexperience\" value=\"0\" size=20 dataType=\"Integer\" msg=\"对不起,请填写数字格式\"></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>领取时长：</TD>\r\n      <TD bgColor=#ffffff><input name=\"length\" id=\"length\" value=\"0\" size=\"20\" ataType=\"Integer\" msg=\"对不起,请填写数字格式\"> 天</TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>道具中心显示：</TD>\r\n      <TD bgColor=#ffffff><input name=\"show\" type=\"checkbox\" value=\"1\"></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>购买地址：</TD>\r\n      <TD bgColor=#ffffff><INPUT id=\"shopurl\" size=50 name=\"shopurl\"> </TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>充值卡介绍：</TD>\r\n      <TD bgColor=#ffffff><textarea name=\"content\" style=\"display:none\"></textarea>\r\n  <iframe ID=\"Editor\" name=\"Editor\" src=\"editor/index.html?ID=content\" frameBorder=\"0\" marginHeight=\"0\" marginWidth=\"0\" scrolling=\"No\" style=\"height:320px;width:100%\"></iframe></TD>\r\n    </TR>\r\n    <TR align=\"center\" bgcolor=\"#f8fbfb\">\r\n      <TD colspan=\"2\"><INPUT class=inputbut type=submit value=添加 name=Submit></TD>\r\n    </TR>\r\n  </TBODY>\r\n  </form>\r\n</TABLE>\r\n";
}

function edit( )
{
		global $db;
		global $web_dbtop;
		global $web_carddir;
		$query = $db->query( "Select * from ".$web_dbtop."cardtype where id={$_GET['id']}" );
		if ( $rs = $db->fetch_array( $query ) )
		{
				echo "<TABLE width=\"96%\" border=0 align=center cellpadding=\"4\" cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n  <form action=\"?action=sedit\" method=\"post\" onSubmit=\"return Validator.Validate(this,3)\">\r\n  <input name=\"id\" type=\"hidden\" value=\"";
				echo $rs['id'];
				echo "\">\r\n    <TBODY>\r\n      <TR>\r\n        <TD vAlign=center width=\"20%\" bgColor=#f5fafe>充值卡名称：</TD>\r\n        <TD bgColor=#ffffff><INPUT id=\"cardname\" size=50 value=\"";
				echo $rs['cardname'];
				echo "\" name=\"cardname\" dataType=\"Require\" msg=\"充值卡名称不能为空\"></TD>\r\n      </TR>\r\n\t  <TR>\r\n      <TD vAlign=center width=\"20%\" bgColor=#f5fafe>充值卡图片：</TD>\r\n      <TD bgColor=#ffffff><INPUT id=\"cardpic\" size=50 name=\"cardpic\" value=\"";
				echo $rs['cardpic'];
				echo "\"></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD vAlign=center width=\"20%\" bgColor=#f5fafe>上传图片：</TD>\r\n      <TD bgColor=#ffffff><iframe src=\"inc/upadpic.php?urldir=";
				echo $web_carddir;
				echo "&picname=cardpic\" width=\"600\" height=\"25\" frameborder=\"0\" scrolling=\"no\"></iframe></TD>\r\n    </TR>\r\n      <TR>\r\n        <TD bgColor=#f5fafe>充值卡价格：</TD>\r\n        <TD bgColor=#ffffff><INPUT name=\"cardprice\" id=\"cardprice\" value=\"";
				echo $rs['cardprice'];
				echo "\" size=20 dataType=\"Double\" msg=\"充值卡价格格式不正确\">\r\n          元</TD>\r\n      </TR>\r\n      <TR>\r\n        <TD bgColor=#f5fafe>自定义卡头：</TD>\r\n        <TD bgColor=#ffffff><INPUT id=\"cardtop\" size=5 name=\"cardtop\" value=\"";
				echo $rs['cardtop'];
				echo "\" dataType=\"LimitB\" min=\"0\" max=\"3\" msg=\"0~3位英文或数字\"> <font color=\"#FF0000\">*</font>0~3位英文或数字,推荐2位</TD>\r\n      </TR>\r\n      <TR>\r\n        <TD bgColor=#f5fafe>随机位数：</TD>\r\n        <TD bgColor=#ffffff><select name=\"cardlen\" size=\"1\">\r\n            <option value=\"5\" ";
				if ( $rs['cardlen'] == 5 )
				{
						echo "selected";
				}
				echo ">5位</option>\r\n            <option value=\"6\" ";
				if ( $rs['cardlen'] == 6 )
				{
						echo "selected";
				}
				echo ">6位</option>\r\n            <option value=\"7\" ";
				if ( $rs['cardlen'] == 7 )
				{
						echo "selected";
				}
				echo ">7位</option>\r\n            <option value=\"8\" ";
				if ( $rs['cardlen'] == 8 )
				{
						echo "selected";
				}
				echo ">8位</option>\r\n            <option value=\"9\" ";
				if ( $rs['cardlen'] == 9 )
				{
						echo "selected";
				}
				echo ">9位</option>\r\n            <option value=\"10\" ";
				if ( $rs['cardlen'] == 10 )
				{
						echo "selected";
				}
				echo ">10位</option>\r\n            <option value=\"11\" ";
				if ( $rs['cardlen'] == 11 )
				{
						echo "selected";
				}
				echo ">11位</option>\r\n            <option value=\"12\" ";
				if ( $rs['cardlen'] == 12 )
				{
						echo "selected";
				}
				echo ">12位</option>\r\n            <option value=\"13\" ";
				if ( $rs['cardlen'] == 13 )
				{
						echo "selected";
				}
				echo ">13位</option>\r\n            <option value=\"14\" ";
				if ( $rs['cardlen'] == 14 )
				{
						echo "selected";
				}
				echo ">14位</option>\r\n            <option value=\"15\" ";
				if ( $rs['cardlen'] == 15 )
				{
						echo "selected";
				}
				echo ">15位</option>\r\n\t\t\t<option value=\"16\" ";
				if ( $rs['cardlen'] == 16 )
				{
						echo "selected";
				}
				echo ">16位</option>\r\n            <option value=\"17\" ";
				if ( $rs['cardlen'] == 17 )
				{
						echo "selected";
				}
				echo ">17位</option>\r\n            <option value=\"18\" ";
				if ( $rs['cardlen'] == 18 )
				{
						echo "selected";
				}
				echo ">18位</option>\r\n            <option value=\"19\" ";
				if ( $rs['cardlen'] == 19 )
				{
						echo "selected";
				}
				echo ">19位</option>\r\n            <option value=\"20\" ";
				if ( $rs['cardlen'] == 20 )
				{
						echo "selected";
				}
				echo ">20位</option>\r\n        </select></TD>\r\n      </TR>\r\n      <TR>\r\n        <TD bgColor=#f5fafe>随机数类型：</TD>\r\n        <TD bgColor=#ffffff><select name=\"cardtype\" size=\"1\">\r\n            <option value=\"0\" ";
				if ( $rs['cardtype'] == 0 )
				{
						echo "selected";
				}
				echo ">数字</option>\r\n            <option value=\"1\" ";
				if ( $rs['cardtype'] == 1 )
				{
						echo "selected";
				}
				echo ">数字+大写字母</option>\r\n            <option value=\"2\" ";
				if ( $rs['cardtype'] == 2 )
				{
						echo "selected";
				}
				echo ">数字＋大写字母＋小写字母</option>\r\n        </select></TD>\r\n      </TR>\r\n      <TR>\r\n        <TD bgColor=#f5fafe>修改ID：</TD>\r\n        <TD bgColor=#ffffff><input name=\"ueid\" type=\"checkbox\" value=\"1\" ";
				if ( $rs['ueid'] == 1 )
				{
						echo "checked";
				}
				echo "> 也就是可以设置靓号</TD>\r\n      </TR>\r\n      <TR>\r\n        <TD bgColor=#f5fafe>升级VIP：</TD>\r\n        <TD bgColor=#ffffff><input name=\"uevip\" type=\"checkbox\" value=\"1\" ";
				if ( $rs['uevip'] == 1 )
				{
						echo "checked";
				}
				echo "></TD>\r\n      </TR>\r\n\t  ";
				
				echo "<TR>\r\n        <TD bgColor=#f5fafe>VIP时长：</TD>\r\n        <TD bgColor=#ffffff><input name=\"viplength\" id=\"viplength\" value=\"";
				echo $rs['viplength'];
				echo "\" size=\"20\" ataType=\"Integer\" msg=\"对不起,请填写数字格式\"> 天</TD>\r\n      </TR>\r\n      <TR>\r\n        <TD bgColor=#f5fafe>增加";
				echo $web_moneyname;
				echo "：</TD>\r\n        <TD bgColor=#ffffff><INPUT name=\"uapoints\" id=\"uapoints\" value=\"";
				echo $rs['uapoints'];
				echo "\" size=20 dataType=\"Integer\" msg=\"对不起,请填写数字格式\"></TD>\r\n      </TR>\r\n      <TR>\r\n        <TD bgColor=#f5fafe>增加经验：</TD>\r\n        <TD bgColor=#ffffff><INPUT name=\"uaexperience\" id=\"uaexperience\" value=\"";
				echo $rs['uaexperience'];
				echo "\" size=20 dataType=\"Integer\" msg=\"对不起,请填写数字格式\"></TD>\r\n      </TR>\r\n      <TR>\r\n        <TD bgColor=#f5fafe>每日领取";
				echo $web_moneyname;
				echo "：</TD>\r\n        <TD bgColor=#ffffff><INPUT name=\"udapoints\" id=\"udapoints\" value=\"";
				echo $rs['udapoints'];
				echo "\" size=20 dataType=\"Integer\" msg=\"对不起,请填写数字格式\"></TD>\r\n      </TR>\r\n      <TR>\r\n        <TD bgColor=#f5fafe>每日领取经验：</TD>\r\n        <TD bgColor=#ffffff><INPUT name=\"udaexperience\" id=\"udaexperience\" value=\"";
				echo $rs['udaexperience'];
				echo "\" size=20 dataType=\"Integer\" msg=\"对不起,请填写数字格式\"></TD>\r\n      </TR>\r\n      <TR>\r\n        <TD bgColor=#f5fafe>领取时长：</TD>\r\n        <TD bgColor=#ffffff><input name=\"length\" id=\"length\" size=\"20\" value=\"";
				echo $rs['length'];
				echo "\" ataType=\"Integer\" msg=\"对不起,请填写数字格式\"> 天</TD>\r\n      </TR>\r\n\t  <TR>\r\n      <TD bgColor=#f5fafe>道具中心显示：</TD>\r\n      <TD bgColor=#ffffff><input name=\"show\" type=\"checkbox\" value=\"1\" ";
				if ( $rs['show'] == 1 )
				{
						echo "checked";
				}
				echo "></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>购买地址：</TD>\r\n      <TD bgColor=#ffffff><INPUT id=\"shopurl\" size=50 name=\"shopurl\" value=\"";
				echo $rs['shopurl'];
				echo "\"> </TD>\r\n    </TR>\r\n      <TR>\r\n        <TD bgColor=#f5fafe>充值卡介绍：</TD>\r\n        <TD bgColor=#ffffff><textarea name=\"content\" style=\"display:none\">";
				echo $rs['content'];
				echo "</textarea>\r\n            <iframe ID=\"Editor\" name=\"Editor\" src=\"editor/index.html?ID=content\" frameBorder=\"0\" marginHeight=\"0\" marginWidth=\"0\" scrolling=\"No\" style=\"height:320px;width:100%\"></iframe></TD>\r\n      </TR>\r\n      <TR align=\"center\" bgcolor=\"#f8fbfb\">\r\n        <TD colspan=\"2\"><INPUT class=inputbut type=submit value=修改 name=Submit></TD>\r\n      </TR>\r\n    </TBODY>\r\n  </form>\r\n</TABLE>\r\n<script language=\"javascript\" src=\"inc/js.js\"></script>\r\n";
		}
}

include_once( dirname( __FILE__ )."/../inc/conn.php" );
include_once( dirname( __FILE__ )."/inc/function.php" );
login_check( "card" );
echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd\">\r\n<HTML xmlns=\"http://www.w3.org/1999/xhtml\">\r\n<HEAD>\r\n<TITLE>充值卡设置管理--雷风积分游戏系统</TITLE>\r\n<META http-equiv=Content-Type content=\"text/html; charset=gb2312\">\r\n<LINK href=\"images/css_body.css\" type=text/css rel=stylesheet>\r\n<META content=\"MSHTML 6.00.3790.4275\" name=GENERATOR>\r\n</HEAD>\r\n<BODY>\r\n<DIV class=bodytitle>\r\n<DIV class=bodytitleleft></DIV>\r\n<DIV class=bodytitletxt>充值卡设置管理</DIV>\r\n<DIV class=bodytitletxt2><a href=\"admin_cardtype.php?action=add\">添加充值卡类型</a></DIV>\r\n</DIV>\r\n";
switch ( $_GET['action'] )
{
case "add" :
		add( );
		break;
case "sadd" :
		sadd( );
		addlog( "添加充值卡类型" );
		showerr( "充值卡类型添加成功", "admin_cardtype.php" );
		break;
case "edit" :
		edit( );
		break;
case "sedit" :
		sedit( );
		addlog( "修改充值卡类型成功" );
		showerr( "充值卡类型修改成功", "admin_cardtype.php" );
		break;
case "del" :
		del( );
		addlog( "删除充值卡类型成功" );
		showerr( "充值卡类型删除成功", "admin_cardtype.php" );
		break;
default :
		main( );
}
echo "</BODY></HTML>\r\n";
?>
