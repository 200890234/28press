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
		global $web_datahost;
		global $web_datauser;
		global $web_datapassword;
		global $web_database;
		global $web_pconnect;
		global $web_pconnect;
		global $web_dbcharset;
		global $web_dbtop;
		$content = "<?php\r\n";
		$content .= "\$web_datahost=\"".$web_datahost."\";\r\n";
		$content .= "\$web_database=\"".$web_database."\";\r\n";
		$content .= "\$web_datauser=\"".$web_datauser."\";\r\n";
		$content .= "\$web_datapassword=\"".$web_datapassword."\";\r\n";
		$content .= "\$web_pconnect=\"".$web_pconnect."\";\r\n";
		$content .= "\$web_dbcharset=\"".$web_dbcharset."\";\r\n";
		$content .= "\$web_dbtop=\"".$web_dbtop."\";\r\n";
		$content .= "\$web_name=\"".str_replace( "\"", "", str_replace( "'", "", $_POST['web_name'] ) )."\";\r\n";
		$content .= "\$web_url=\"".str_replace( "\"", "", str_replace( "'", "", $_POST['web_url'] ) )."\";\r\n";
		$content .= "\$web_logo=\"".str_replace( "\"", "", str_replace( "'", "", $_POST['web_logo'] ) )."\";\r\n";
		$content .= "\$web_keywords=\"".str_replace( "\"", "", str_replace( "'", "", $_POST['web_keywords'] ) )."\";\r\n";
		$content .= "\$web_description=\"".str_replace( "\"", "", str_replace( "'", "", $_POST['web_description'] ) )."\";\r\n";
		$content .= "\$web_beian=\"".str_replace( "\"", "", str_replace( "'", "", $_POST['web_beian'] ) )."\";\r\n";
		$content .= "\$web_statistics=\"".str_replace( "\"", "", str_replace( "'", "", $_POST['web_statistics'] ) )."\";\r\n";
		$content .= "\$web_commentskey=\"".str_replace( "\"", "", str_replace( "'", "", $_POST['web_commentskey'] ) )."\";\r\n";
		$content .= "\$web_dir=\"".str_replace( "\"", "", str_replace( "'", "", $_POST['web_dir'] ) )."\";\r\n";
		$content .= "\$web_picdir=\"".str_replace( "\"", "", str_replace( "'", "", $_POST['web_picdir'] ) )."\";\r\n";
		$content .= "\$web_adpicdir=\"".str_replace( "\"", "", str_replace( "'", "", $_POST['web_adpicdir'] ) )."\";\r\n";
		$content .= "\$web_activitiesdir=\"".str_replace( "\"", "", str_replace( "'", "", $_POST['web_activitiesdir'] ) )."\";\r\n";
		$content .= "\$web_businessdir=\"".str_replace( "\"", "", str_replace( "'", "", $_POST['web_businessdir'] ) )."\";\r\n";
		$content .= "\$web_carddir=\"".str_replace( "\"", "", str_replace( "'", "", $_POST['web_carddir'] ) )."\";\r\n";
		$content .= "\$web_slidedir=\"".str_replace( "\"", "", str_replace( "'", "", $_POST['web_slidedir'] ) )."\";\r\n";
		$content .= "\$web_headdir=\"".str_replace( "\"", "", str_replace( "'", "", $_POST['web_headdir'] ) )."\";\r\n";
		$content .= "\$web_cardiddir=\"".str_replace( "\"", "", str_replace( "'", "", $_POST['web_cardiddir'] ) )."\";\r\n";
		$content .= "\$web_moneyname=\"".str_replace( "\"", "", str_replace( "'", "", $_POST['web_moneyname'] ) )."\";\r\n";
		$content .= "\$web_moneypic=\"".str_replace( "\"", "", str_replace( "'", "", $_POST['web_moneypic'] ) )."\";\r\n";
		$content .= "\$web_ck_card=\"".intval( $_POST['web_ck_card'] )."\";\r\n";
		$content .= "\$prizes_points=\"".str_replace( "\"", "", str_replace( "'", "", $_POST['prizes_points'] ) )."\";\r\n";
		$content .= "\$reg_points=\"".str_replace( "\"", "", str_replace( "'", "", $_POST['reg_points'] ) )."\";\r\n";
		$content .= "\$web_authentication=\"".str_replace( "\"", "", str_replace( "'", "", $_POST['web_authentication'] ) )."\";\r\n";
		$content .= "\$web_linknum=\"".str_replace( "\"", "", str_replace( "'", "", $_POST['web_linknum'] ) )."\";\r\n";
		$content .= "\$web_linkpoints=\"".str_replace( "\"", "", str_replace( "'", "", $_POST['web_linkpoints'] ) )."\";\r\n";
		$content .= "\$web_loginperience=\"".str_replace( "\"", "", str_replace( "'", "", $_POST['web_loginperience'] ) )."\";\r\n";
		$content .= "\$web_exchanged_num=\"".str_replace( "\"", "", str_replace( "'", "", $_POST['web_exchanged_num'] ) )."\";\r\n";
		$content .= "\$web_exchanged_num_vip=\"".str_replace( "\"", "", str_replace( "'", "", $_POST['web_exchanged_num_vip'] ) )."\";\r\n";
		$content .= "?>";
		fsosavefile( "../inc/config.php", stripcslashes( $content ) );
}

function main( )
{
		global $web_name;
		global $web_url;
		global $web_logo;
		global $web_keywords;
		global $web_description;
		global $web_beian;
		global $web_statistics;
		global $web_commentskey;
		global $web_dir;
		global $web_picdir;
		global $web_adpicdir;
		global $web_activitiesdir;
		global $web_businessdir;
		global $web_carddir;
		global $web_slidedir;
		global $web_headdir;
		global $web_cardiddir;
		global $web_moneyname;
		global $web_moneypic;
		global $web_ck_card;
		global $prizes_points;
		global $reg_points;
		global $web_authentication;
		global $web_linknum;
		global $web_linkpoints;
		global $web_loginperience;
		global $web_exchanged_num;
		global $web_exchanged_num_vip;
		echo "<DIV class=bodytitle>\r\n<DIV class=bodytitleleft></DIV>\r\n<DIV class=bodytitletxt>վ������</DIV>\r\n</DIV>\r\n<TABLE width=\"96%\" border=0 align=center cellpadding=\"5\" cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n<form action=\"?action=edit\" method=\"post\" onSubmit=\"return Validator.Validate(this,3)\">\r\n  <TBODY>\r\n\t<TR align=\"center\" bgcolor=\"#f8fbfb\">\r\n      <TD colspan=\"2\">վ������</TD>\r\n    </TR>\r\n    <TR>\r\n      <TD vAlign=center width=\"20%\" bgColor=#f5fafe>վ�����ƣ�</TD>\r\n      <TD bgColor=#ffffff><INPUT id=web_name size=30 name=web_name value=\"";
		echo $web_name;
		echo "\" dataType=\"Require\" msg=\"����дվ������\"></TD>\r\n    </TR>\r\n    <TR>\r\n      <TD bgColor=#f5fafe>վ��������</TD>\r\n      <TD bgColor=#ffffff><INPUT id=web_url size=30 name=web_url value=\"";
		echo $web_url;
		echo "\" dataType=\"Require\" msg=\"����дվ������\"></TD>\r\n    </TR>\r\n    <TR>\r\n      <TD bgColor=#f5fafe>վ��LOGO��</TD>\r\n      <TD bgColor=#ffffff><INPUT id=web_logo size=30 name=web_logo value=\"";
		echo $web_logo;
		echo "\" dataType=\"Require\" msg=\"����дվ��LOGO\"></TD>\r\n    </TR>\r\n    <TR>\r\n      <TD bgColor=#f5fafe>վ��ؼ��֣�</TD>\r\n      <TD bgColor=#ffffff><input name=\"web_keywords\" type=\"text\" id=\"web_keywords\" value=\"";
		echo $web_keywords;
		echo "\" size=\"50\"></TD>\r\n    </TR>\r\n    <TR>\r\n      <TD bgColor=#f5fafe>վ����ܣ�</TD>\r\n      <TD bgColor=#ffffff><input name=\"web_description\" type=\"text\" id=\"web_description\" value=\"";
		echo $web_description;
		echo "\" size=\"50\"></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>�����ţ�</TD>\r\n      <TD bgColor=#ffffff><input name=\"web_beian\" type=\"text\" id=\"web_beian\" value=\"";
		echo $web_beian;
		echo "\" size=\"50\"></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>ͳ�ƴ��룺</TD>\r\n      <TD bgColor=#ffffff><input name=\"web_statistics\" type=\"text\" id=\"web_statistics\" value=\"";
		echo $web_statistics;
		echo "\" size=\"50\"></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>�������ã�</TD>\r\n      <TD bgColor=#ffffff><input name=\"web_commentskey\" type=\"text\" id=\"web_commentskey\" value=\"";
		echo $web_commentskey;
		echo "\" size=\"50\">\r\n\t  ��ʹ��<font color=\"#FF0000\">|</font>���������˹ؼ��ָ���</TD>\r\n    </TR>\r\n    <TR>\r\n      <TD bgColor=#f5fafe>վ�㰲װĿ¼��</TD>\r\n      <TD bgColor=#ffffff><INPUT id=web_dir size=30 name=web_dir value=\"";
		echo $web_dir;
		echo "\" dataType=\"Require\" msg=\"����дվ�㰲װĿ¼\"></TD>\r\n    </TR>\r\n    <TR>\r\n      <TD bgColor=#f5fafe>��ƷͼƬĿ¼��</TD>\r\n      <TD bgColor=#ffffff><INPUT id=web_picdir size=30 name=web_picdir value=\"";
		echo $web_picdir;
		echo "\" dataType=\"Require\" msg=\"����д��ƷͼƬĿ¼\"> �޸ĺ��뽨����ӦĿ¼</TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>���ͼƬĿ¼��</TD>\r\n      <TD bgColor=#ffffff><INPUT id=web_adpicdir size=30 name=web_adpicdir value=\"";
		echo $web_adpicdir;
		echo "\" dataType=\"Require\" msg=\"����д��ƷͼƬĿ¼\"> �޸ĺ��뽨����ӦĿ¼</TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>�ͼƬĿ¼��</TD>\r\n      <TD bgColor=#ffffff><INPUT id=web_activitiesdir size=30 name=web_activitiesdir value=\"";
		echo $web_activitiesdir;
		echo "\" dataType=\"Require\" msg=\"����д��ƷͼƬĿ¼\"> �޸ĺ��뽨����ӦĿ¼</TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>�̻�ͼƬĿ¼��</TD>\r\n      <TD bgColor=#ffffff><INPUT id=web_businessdir size=30 name=web_businessdir value=\"";
		echo $web_businessdir;
		echo "\" dataType=\"Require\" msg=\"����д��ƷͼƬĿ¼\"> �޸ĺ��뽨����ӦĿ¼</TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>��ֵ��ͼƬĿ¼��</TD>\r\n      <TD bgColor=#ffffff><INPUT id=web_carddir size=30 name=web_carddir value=\"";
		echo $web_carddir;
		echo "\" dataType=\"Require\" msg=\"����д��ƷͼƬĿ¼\"> �޸ĺ��뽨����ӦĿ¼</TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>�õ�ͼƬĿ¼��</TD>\r\n      <TD bgColor=#ffffff><INPUT id=web_slidedir size=30 name=web_slidedir value=\"";
		echo $web_slidedir;
		echo "\" dataType=\"Require\" msg=\"����д��ƷͼƬĿ¼\"> �޸ĺ��뽨����ӦĿ¼</TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>�û�ͷ��ͼƬĿ¼��</TD>\r\n      <TD bgColor=#ffffff><INPUT id=web_headdir size=30 name=web_headdir value=\"";
		echo $web_headdir;
		echo "\" dataType=\"Require\" msg=\"����д��ƷͼƬĿ¼\"> �޸ĺ��뽨����ӦĿ¼</TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>�û��ϴ�֤��Ŀ¼��</TD>\r\n      <TD bgColor=#ffffff><INPUT id=web_cardiddir size=30 name=web_cardiddir value=\"";
		echo $web_cardiddir;
		echo "\" dataType=\"Require\" msg=\"����д��ƷͼƬĿ¼\"> �޸ĺ��뽨����ӦĿ¼</TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>�������ƣ�</TD>\r\n      <TD bgColor=#ffffff><INPUT id=web_moneyname size=30 name=web_moneyname value=\"";
		echo $web_moneyname;
		echo "\" dataType=\"Require\" msg=\"����д��������\"></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>����ͼƬ��</TD>\r\n      <TD bgColor=#ffffff><INPUT id=web_moneypic size=30 name=web_moneypic value=\"";
		echo $web_moneypic;
		echo "\" dataType=\"Require\" msg=\"����д����ͼƬ\"></TD>\r\n    </TR>\r\n\t<TR align=\"center\" bgcolor=\"#f8fbfb\">\r\n      <TD colspan=\"2\">�����������</TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>�ҽ������֤��⣺</TD>\r\n      <TD bgColor=#ffffff><input name=\"web_ck_card\" type=\"checkbox\" value=\"1\" ";
		if ( $web_ck_card == 1 )
		{
				echo "checked";
		}
		echo "></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>�ҽ�";
		echo $web_moneyname;
		echo "���ޣ�</TD>\r\n      <TD bgColor=#ffffff><INPUT id=prizes_points size=30 name=prizes_points value=\"";
		echo $prizes_points;
		echo "\" dataType=\"Integer\" msg=\"����д��ȷ��ʽ\"> ";
		echo $web_moneyname;
		echo "</TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>ע����";
		echo $web_moneyname;
		echo "��</TD>\r\n      <TD bgColor=#ffffff><INPUT id=reg_points size=30 name=reg_points value=\"";
		echo $reg_points;
		echo "\" dataType=\"Integer\" msg=\"����д��ȷ��ʽ\"> ";
		echo $web_moneyname;
		echo "</TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>�����֤����";
		echo $web_moneyname;
		echo "��</TD>\r\n      <TD bgColor=#ffffff><INPUT id=web_authentication size=30 name=web_authentication value=\"";
		echo $web_authentication;
		echo "\" dataType=\"Integer\" msg=\"����д��ȷ��ʽ\"> ";
		echo $web_moneyname;
		echo "</TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>�ƹ�������������</TD>\r\n      <TD bgColor=#ffffff><INPUT id=web_linknum size=30 name=web_linknum value=\"";
		echo $web_linknum;
		echo "\" dataType=\"Integer\" msg=\"����д��ȷ��ʽ\"> ÿ��/��</TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>�ƹ㽱����</TD>\r\n      <TD bgColor=#ffffff><INPUT id=web_linkpoints size=30 name=web_linkpoints value=\"";
		echo $web_linkpoints;
		echo "\" dataType=\"Integer\" msg=\"����д��ȷ��ʽ\"> ";
		echo $web_moneyname;
		echo "</TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>��½�������飺</TD>\r\n      <TD bgColor=#ffffff><INPUT id=web_loginperience size=30 name=web_loginperience value=\"";
		echo $web_loginperience;
		echo "\" dataType=\"Integer\" msg=\"����д��ȷ��ʽ\"></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>ÿ�նһ�������</TD>\r\n      <TD bgColor=#ffffff><INPUT id=web_loginperience size=30 name=web_exchanged_num value=\"";
		echo $web_exchanged_num;
		echo "\" dataType=\"Integer\" msg=\"����д��ȷ��ʽ\"> ÿ��/��</TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>VIPÿ�նһ�������</TD>\r\n      <TD bgColor=#ffffff><INPUT id=web_exchanged_num_vip size=30 name=web_exchanged_num_vip value=\"";
		echo $web_exchanged_num_vip;
		echo "\" dataType=\"Integer\" msg=\"����д��ȷ��ʽ\"> ÿ��/��</TD>\r\n    </TR>\r\n    <TR align=\"center\" bgcolor=\"#f8fbfb\">\r\n      <TD colspan=\"2\"><INPUT class=inputbut type=submit value=�޸� name=Submit></TD>\r\n    </TR>\r\n  </TBODY>\r\n  </form>\r\n</TABLE>\r\n<script language=\"javascript\" src=\"inc/js.js\"></script>\r\n";
}

include_once( dirname( __FILE__ )."/../inc/conn.php" );
include_once( dirname( __FILE__ )."/inc/function.php" );
login_check( "system" );
echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd\">\r\n<HTML xmlns=\"http://www.w3.org/1999/xhtml\">\r\n<HEAD>\r\n<TITLE>վ������--�׷������Ϸϵͳ</TITLE>\r\n<META http-equiv=Content-Type content=\"text/html; charset=gb2312\">\r\n<LINK href=\"images/css_body.css\" type=text/css rel=stylesheet>\r\n<META content=\"MSHTML 6.00.3790.4275\" name=GENERATOR>\r\n</HEAD>\r\n<BODY>\r\n";
switch ( $_GET['action'] )
{
case "edit" :
		edit( );
		addlog( "�޸���վ����" );
		showerr( "��վ�����޸ĳɹ�", "admin_system.php" );
		break;
default :
		main( );
}
echo "</BODY>\r\n</HTML>\r\n";
?>
