<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/

function edit( )
{
				global $db;
				global $web_dbtop;
				$db->query( "update ".$web_dbtop."game_system set game28_go_samples={$_POST['game28_go_samples']},game28_go_time={$_POST['game28_go_time']},game28_tz_experience={$_POST['game28_tz_experience']},game28_jl_experience={$_POST['game28_jl_experience']},game28_jl_maxexperience={$_POST['game28_jl_maxexperience']},game28_jl_experience_vip={$_POST['game28_jl_experience_vip']},game28_jl_maxexperience_vip={$_POST['game28_jl_maxexperience_vip']} where id =1" );
}

function main( )
{
				global $db;
				global $web_dbtop;
				global $web_moneyname;
				$query = $db->query( "Select * from ".$web_dbtop."game_system where id=1" );
				if ( $rs = $db->fetch_array( $query ) )
				{
								echo "<DIV class=bodytitle>\r\n<DIV class=bodytitleleft></DIV>\r\n<DIV class=bodytitletxt>幸运28-游戏设置</DIV>\r\n</DIV>\r\n<TABLE width=\"96%\" border=0 align=center cellpadding=\"5\" cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n<form action=\"?action=edit\" method=\"post\" onSubmit=\"return Validator.Validate(this,3)\">\r\n  <TBODY>\r\n   <TR>\r\n      <TD width=\"20%\" bgColor=#f5fafe>抽取投注千分比：</TD>\r\n      <TD bgColor=#ffffff><INPUT id=game28_go_samples size=30 name=game28_go_samples value=\"";
								echo $rs['game28_go_samples'];
								echo "\" dataType=\"Integer\" msg=\"请填写正确格式\"> ‰</TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD width=\"20%\" bgColor=#f5fafe>不可投注时间：</TD>\r\n      <TD bgColor=#ffffff><INPUT id=game28_go_time size=30 name=game28_go_time value=\"";
								echo $rs['game28_go_time'];
								echo "\" dataType=\"Integer\" msg=\"请填写正确格式\"> 秒</TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>奖励经验投注下限：</TD>\r\n      <TD bgColor=#ffffff><INPUT id=game28_tz_experience size=30 name=game28_tz_experience value=\"";
								echo $rs['game28_tz_experience'];
								echo "\" dataType=\"Integer\" msg=\"请填写正确格式\"> ";
								echo $web_moneyname;
								echo "</TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>奖励经验：</TD>\r\n      <TD bgColor=#ffffff><INPUT id=game28_jl_experience size=30 name=game28_jl_experience value=\"";
								echo $rs['game28_jl_experience'];
								echo "\" dataType=\"Integer\" msg=\"请填写正确格式\"></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>奖励经验上限：</TD>\r\n      <TD bgColor=#ffffff><INPUT id=game28_jl_maxexperience size=30 name=game28_jl_maxexperience value=\"";
								echo $rs['game28_jl_maxexperience'];
								echo "\" dataType=\"Integer\" msg=\"请填写正确格式\">         每天/经验</TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>VIP奖励经验：</TD>\r\n      <TD bgColor=#ffffff><INPUT id=game28_jl_experience_vip size=30 name=game28_jl_experience_vip value=\"";
								echo $rs['game28_jl_experience_vip'];
								echo "\" dataType=\"Integer\" msg=\"请填写正确格式\"></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>VIP奖励经验上限：</TD>\r\n      <TD bgColor=#ffffff><INPUT id=game28_jl_maxexperience_vip size=30 name=game28_jl_maxexperience_vip value=\"";
								echo $rs['game28_jl_maxexperience_vip'];
								echo "\" dataType=\"Integer\" msg=\"请填写正确格式\"> \r\n      每天/经验</TD>\r\n    </TR>\r\n    <TR align=\"center\" bgcolor=\"#f8fbfb\">\r\n      <TD colspan=\"2\"><INPUT class=inputbut type=submit value=修改 name=Submit></TD>\r\n    </TR>\r\n  </TBODY>\r\n  </form>\r\n</TABLE>\r\n<script language=\"javascript\" src=\"inc/js.js\"></script>\r\n";
				}
}

include_once( dirname( __FILE__ )."/../inc/conn.php" );
include_once( dirname( __FILE__ )."/inc/function.php" );
login_check( "gamegl" );
echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd\">\r\n<HTML xmlns=\"http://www.w3.org/1999/xhtml\">\r\n<HEAD>\r\n<TITLE>游戏设置--雷风积分游戏系统</TITLE>\r\n<META http-equiv=Content-Type content=\"text/html; charset=gb2312\">\r\n<LINK href=\"images/css_body.css\" type=text/css rel=stylesheet>\r\n<META content=\"MSHTML 6.00.3790.4275\" name=GENERATOR>\r\n</HEAD>\r\n<BODY>\r\n";
switch ( $_GET['action'] )
{
case "edit" :
				edit( );
				addlog( "修改幸运28-游戏设置" );
				showerr( "幸运28-游戏设置修改成功", "admin_game28_system.php" );
				break;
default :
				main( );
}
echo "</BODY>\r\n</HTML>\r\n";
?>
