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
				$db->query( "update ".$web_dbtop."game_system set game16_go_samples={$_POST['game16_go_samples']},game16_go_time={$_POST['game16_go_time']},game16_tz_experience={$_POST['game16_tz_experience']},game16_jl_experience={$_POST['game16_jl_experience']},game16_jl_maxexperience={$_POST['game16_jl_maxexperience']},game16_jl_experience_vip={$_POST['game16_jl_experience_vip']},game16_jl_maxexperience_vip={$_POST['game16_jl_maxexperience_vip']} where id =1" );
}

function main( )
{
				global $db;
				global $web_dbtop;
				global $web_moneyname;
				$query = $db->query( "Select * from ".$web_dbtop."game_system where id=1" );
				if ( $rs = $db->fetch_array( $query ) )
				{
								echo "<DIV class=bodytitle>\r\n<DIV class=bodytitleleft></DIV>\r\n<DIV class=bodytitletxt>����16-��Ϸ����</DIV>\r\n</DIV>\r\n<TABLE width=\"96%\" border=0 align=center cellpadding=\"5\" cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n<form action=\"?action=edit\" method=\"post\" onSubmit=\"return Validator.Validate(this,3)\">\r\n  <TBODY>\r\n   <TR>\r\n      <TD width=\"20%\" bgColor=#f5fafe>��ȡͶעǧ�ֱȣ�</TD>\r\n      <TD bgColor=#ffffff><INPUT id=game16_go_samples size=30 name=game16_go_samples value=\"";
								echo $rs['game16_go_samples'];
								echo "\" dataType=\"Integer\" msg=\"����д��ȷ��ʽ\"> ��</TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD width=\"20%\" bgColor=#f5fafe>����Ͷעʱ�䣺</TD>\r\n      <TD bgColor=#ffffff><INPUT id=game16_go_time size=30 name=game16_go_time value=\"";
								echo $rs['game16_go_time'];
								echo "\" dataType=\"Integer\" msg=\"����д��ȷ��ʽ\"> ��</TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>��������Ͷע���ޣ�</TD>\r\n      <TD bgColor=#ffffff><INPUT id=game16_tz_experience size=30 name=game16_tz_experience value=\"";
								echo $rs['game16_tz_experience'];
								echo "\" dataType=\"Integer\" msg=\"����д��ȷ��ʽ\"> ";
								echo $web_moneyname;
								echo "</TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>�������飺</TD>\r\n      <TD bgColor=#ffffff><INPUT id=game16_jl_experience size=30 name=game16_jl_experience value=\"";
								echo $rs['game16_jl_experience'];
								echo "\" dataType=\"Integer\" msg=\"����д��ȷ��ʽ\"></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>�����������ޣ�</TD>\r\n      <TD bgColor=#ffffff><INPUT id=game16_jl_maxexperience size=30 name=game16_jl_maxexperience value=\"";
								echo $rs['game16_jl_maxexperience'];
								echo "\" dataType=\"Integer\" msg=\"����д��ȷ��ʽ\">         ÿ��/����</TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>VIP�������飺</TD>\r\n      <TD bgColor=#ffffff><INPUT id=game16_jl_experience_vip size=30 name=game16_jl_experience_vip value=\"";
								echo $rs['game16_jl_experience_vip'];
								echo "\" dataType=\"Integer\" msg=\"����д��ȷ��ʽ\"></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>VIP�����������ޣ�</TD>\r\n      <TD bgColor=#ffffff><INPUT id=game16_jl_maxexperience_vip size=30 name=game16_jl_maxexperience_vip value=\"";
								echo $rs['game16_jl_maxexperience_vip'];
								echo "\" dataType=\"Integer\" msg=\"����д��ȷ��ʽ\"> \r\n      ÿ��/����</TD>\r\n    </TR>\r\n    <TR align=\"center\" bgcolor=\"#f8fbfb\">\r\n      <TD colspan=\"2\"><INPUT class=inputbut type=submit value=�޸� name=Submit></TD>\r\n    </TR>\r\n  </TBODY>\r\n  </form>\r\n</TABLE>\r\n<script language=\"javascript\" src=\"inc/js.js\"></script>\r\n";
				}
}

include_once( dirname( __FILE__ )."/../inc/conn.php" );
include_once( dirname( __FILE__ )."/inc/function.php" );
login_check( "gamegl" );
echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd\">\r\n<HTML xmlns=\"http://www.w3.org/1999/xhtml\">\r\n<HEAD>\r\n<TITLE>��Ϸ����--�׷������Ϸϵͳ</TITLE>\r\n<META http-equiv=Content-Type content=\"text/html; charset=gb2312\">\r\n<LINK href=\"images/css_body.css\" type=text/css rel=stylesheet>\r\n<META content=\"MSHTML 6.00.3790.4275\" name=GENERATOR>\r\n</HEAD>\r\n<BODY>\r\n";
switch ( $_GET['action'] )
{
case "edit" :
				edit( );
				addlog( "�޸Ŀ���16-��Ϸ����" );
				showerr( "����16-��Ϸ�����޸ĳɹ�", "admin_game16_system.php" );
				break;
default :
				main( );
}
echo "</BODY>\r\n</HTML>\r\n";
?>