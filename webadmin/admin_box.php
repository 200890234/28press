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
		$db->query( "update ".$web_dbtop."gamebox set box_1_1_j={$_POST['box_1_1_j']},box_1_2_j={$_POST['box_1_2_j']},box_1_3_j={$_POST['box_1_3_j']},box_1_4_j={$_POST['box_1_4_j']},box_1_5_j={$_POST['box_1_5_j']},box_1_6_j={$_POST['box_1_6_j']},box_1_7_j={$_POST['box_1_7_j']},box_1_8_j={$_POST['box_1_8_j']},box_2_1_j={$_POST['box_2_1_j']},box_2_2_j={$_POST['box_2_2_j']},box_2_3_j={$_POST['box_2_3_j']},box_2_4_j={$_POST['box_2_4_j']},box_2_5_j={$_POST['box_2_5_j']},box_2_6_j={$_POST['box_2_6_j']},box_2_7_j={$_POST['box_2_7_j']},box_2_8_j={$_POST['box_2_8_j']},box_3_1_j={$_POST['box_3_1_j']},box_3_2_j={$_POST['box_3_2_j']},box_3_3_j={$_POST['box_3_3_j']},box_3_4_j={$_POST['box_3_4_j']},box_3_5_j={$_POST['box_3_5_j']},box_3_6_j={$_POST['box_3_6_j']},box_3_7_j={$_POST['box_3_7_j']},box_3_8_j={$_POST['box_3_8_j']} where id={$_POST['id']}" );
}

function edit( )
{
		global $db;
		global $web_dbtop;
		$query = $db->query( "Select * from ".$web_dbtop."gamebox where id=1" );
		if ( $rs = $db->fetch_array( $query ) )
		{
				echo "<TABLE width=\"96%\" border=0 align=center cellpadding=\"4\" cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n  <form action=\"?action=sedit\" method=\"post\" onSubmit=\"return Validator.Validate(this,3)\">\r\n  <input name=\"id\" type=\"hidden\" value=\"";
				echo $rs['id'];
				echo "\">\r\n  <TBODY>\r\n    <TR>\r\n      <TD vAlign=center width=\"20%\" bgColor=#f5fafe>�ƽ���һ�Ƚ���</TD>\r\n      <TD bgColor=#ffffff><INPUT id=\"box_1_1_j\" size=50 name=\"box_1_1_j\" value=\"";
				echo $rs['box_1_1_j'];
				echo "\" dataType=\"Integer\" msg=\"�Բ����ʽ����ȷ\"> ";
				echo $web_moneyname;
				echo "</TD>\r\n    </TR>\r\n    <TR>\r\n      <TD bgColor=#f5fafe>�ƽ�����Ƚ���</TD>\r\n      <TD bgColor=#ffffff><INPUT id=\"box_1_2_j\" size=50 name=\"box_1_2_j\" value=\"";
				echo $rs['box_1_2_j'];
				echo "\" dataType=\"Integer\" msg=\"�Բ����ʽ����ȷ\"> ";
				echo $web_moneyname;
				echo "</TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>�ƽ������Ƚ���</TD>\r\n      <TD bgColor=#ffffff><INPUT id=\"box_1_3_j\" size=50 name=\"box_1_3_j\" value=\"";
				echo $rs['box_1_3_j'];
				echo "\" dataType=\"Integer\" msg=\"�Բ����ʽ����ȷ\"> ";
				echo $web_moneyname;
				echo "</TD>\r\n\t</TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>�ƽ����ĵȽ���</TD>\r\n      <TD bgColor=#ffffff><INPUT id=\"box_1_4_j\" size=50 name=\"box_1_4_j\" value=\"";
				echo $rs['box_1_4_j'];
				echo "\" dataType=\"Integer\" msg=\"�Բ����ʽ����ȷ\"> ";
				echo $web_moneyname;
				echo "</TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>�ƽ�����Ƚ���</TD>\r\n      <TD bgColor=#ffffff><INPUT id=\"box_1_5_j\" size=50 name=\"box_1_5_j\" value=\"";
				echo $rs['box_1_5_j'];
				echo "\" dataType=\"Integer\" msg=\"�Բ����ʽ����ȷ\"> ";
				echo $web_moneyname;
				echo "</TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>�ƽ������Ƚ���</TD>\r\n      <TD bgColor=#ffffff><INPUT id=\"box_1_6_j\" size=50 name=\"box_1_6_j\" value=\"";
				echo $rs['box_1_6_j'];
				echo "\" dataType=\"Integer\" msg=\"�Բ����ʽ����ȷ\"> ";
				echo $web_moneyname;
				echo "</TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>�ƽ����ߵȽ���</TD>\r\n      <TD bgColor=#ffffff><INPUT id=\"box_1_7_j\" size=50 name=\"box_1_7_j\" value=\"";
				echo $rs['box_1_7_j'];
				echo "\" dataType=\"Integer\" msg=\"�Բ����ʽ����ȷ\"> ";
				echo $web_moneyname;
				echo "</TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>�ƽ���˵Ƚ���</TD>\r\n      <TD bgColor=#ffffff><INPUT id=\"box_1_8_j\" size=50 name=\"box_1_8_j\" value=\"";
				echo $rs['box_1_8_j'];
				echo "\" dataType=\"Integer\" msg=\"�Բ����ʽ����ȷ\"> ";
				echo $web_moneyname;
				echo "</TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>��������һ�Ƚ���</TD>\r\n      <TD bgColor=#ffffff><INPUT id=\"box_2_1_j\" size=50 name=\"box_2_1_j\" value=\"";
				echo $rs['box_2_1_j'];
				echo "\" dataType=\"Integer\" msg=\"�Բ����ʽ����ȷ\"> ";
				echo $web_moneyname;
				echo "</TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>����������Ƚ���</TD>\r\n      <TD bgColor=#ffffff><INPUT id=\"box_2_2_j\" size=50 name=\"box_2_2_j\" value=\"";
				echo $rs['box_2_2_j'];
				echo "\" dataType=\"Integer\" msg=\"�Բ����ʽ����ȷ\"> ";
				echo $web_moneyname;
				echo "</TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>�����������Ƚ���</TD>\r\n      <TD bgColor=#ffffff><INPUT id=\"box_2_3_j\" size=50 name=\"box_2_3_j\" value=\"";
				echo $rs['box_2_3_j'];
				echo "\" dataType=\"Integer\" msg=\"�Բ����ʽ����ȷ\"> ";
				echo $web_moneyname;
				echo "</TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>���������ĵȽ���</TD>\r\n      <TD bgColor=#ffffff><INPUT id=\"box_2_4_j\" size=50 name=\"box_2_4_j\" value=\"";
				echo $rs['box_2_4_j'];
				echo "\" dataType=\"Integer\" msg=\"�Բ����ʽ����ȷ\"> ";
				echo $web_moneyname;
				echo "</TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>����������Ƚ���</TD>\r\n      <TD bgColor=#ffffff><INPUT id=\"box_2_5_j\" size=50 name=\"box_2_5_j\" value=\"";
				echo $rs['box_2_5_j'];
				echo "\" dataType=\"Integer\" msg=\"�Բ����ʽ����ȷ\"> ";
				echo $web_moneyname;
				echo "</TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>�����������Ƚ���</TD>\r\n      <TD bgColor=#ffffff><INPUT id=\"box_2_6_j\" size=50 name=\"box_2_6_j\" value=\"";
				echo $rs['box_2_6_j'];
				echo "\" dataType=\"Integer\" msg=\"�Բ����ʽ����ȷ\"> ";
				echo $web_moneyname;
				echo "</TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>���������ߵȽ���</TD>\r\n      <TD bgColor=#ffffff><INPUT id=\"box_2_7_j\" size=50 name=\"box_2_7_j\" value=\"";
				echo $rs['box_2_7_j'];
				echo "\" dataType=\"Integer\" msg=\"�Բ����ʽ����ȷ\"> ";
				echo $web_moneyname;
				echo "</TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>��������˵Ƚ���</TD>\r\n      <TD bgColor=#ffffff><INPUT id=\"box_2_8_j\" size=50 name=\"box_2_8_j\" value=\"";
				echo $rs['box_2_8_j'];
				echo "\" dataType=\"Integer\" msg=\"�Բ����ʽ����ȷ\"> ";
				echo $web_moneyname;
				echo "</TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>��ͭ����һ�Ƚ���</TD>\r\n      <TD bgColor=#ffffff><INPUT id=\"box_3_1_j\" size=50 name=\"box_3_1_j\" value=\"";
				echo $rs['box_3_1_j'];
				echo "\" dataType=\"Integer\" msg=\"�Բ����ʽ����ȷ\"> ";
				echo $web_moneyname;
				echo "</TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>��ͭ������Ƚ���</TD>\r\n      <TD bgColor=#ffffff><INPUT id=\"box_3_2_j\" size=50 name=\"box_3_2_j\" value=\"";
				echo $rs['box_3_2_j'];
				echo "\" dataType=\"Integer\" msg=\"�Բ����ʽ����ȷ\"> ";
				echo $web_moneyname;
				echo "</TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>��ͭ�������Ƚ���</TD>\r\n      <TD bgColor=#ffffff><INPUT id=\"box_3_3_j\" size=50 name=\"box_3_3_j\" value=\"";
				echo $rs['box_3_3_j'];
				echo "\" dataType=\"Integer\" msg=\"�Բ����ʽ����ȷ\"> ";
				echo $web_moneyname;
				echo "</TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>��ͭ�����ĵȽ���</TD>\r\n      <TD bgColor=#ffffff><INPUT id=\"box_3_4_j\" size=50 name=\"box_3_4_j\" value=\"";
				echo $rs['box_3_4_j'];
				echo "\" dataType=\"Integer\" msg=\"�Բ����ʽ����ȷ\"> ";
				echo $web_moneyname;
				echo "</TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>��ͭ������Ƚ���</TD>\r\n      <TD bgColor=#ffffff><INPUT id=\"box_3_5_j\" size=50 name=\"box_3_5_j\" value=\"";
				echo $rs['box_3_5_j'];
				echo "\" dataType=\"Integer\" msg=\"�Բ����ʽ����ȷ\"> ";
				echo $web_moneyname;
				echo "</TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>��ͭ�������Ƚ���</TD>\r\n      <TD bgColor=#ffffff><INPUT id=\"box_3_6_j\" size=50 name=\"box_3_6_j\" value=\"";
				echo $rs['box_3_6_j'];
				echo "\" dataType=\"Integer\" msg=\"�Բ����ʽ����ȷ\"> ";
				echo $web_moneyname;
				echo "</TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>��ͭ�����ߵȽ���</TD>\r\n      <TD bgColor=#ffffff><INPUT id=\"box_3_7_j\" size=50 name=\"box_3_7_j\" value=\"";
				echo $rs['box_3_7_j'];
				echo "\" dataType=\"Integer\" msg=\"�Բ����ʽ����ȷ\"> ";
				echo $web_moneyname;
				echo "</TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>��ͭ����˵Ƚ���</TD>\r\n      <TD bgColor=#ffffff><INPUT id=\"box_3_8_j\" size=50 name=\"box_3_8_j\" value=\"";
				echo $rs['box_3_8_j'];
				echo "\" dataType=\"Integer\" msg=\"�Բ����ʽ����ȷ\"> ";
				echo $web_moneyname;
				echo "</TD>\r\n    </TR>\r\n    <TR align=\"center\" bgcolor=\"#f8fbfb\">\r\n      <TD colspan=\"2\"><INPUT class=inputbut type=submit value=�޸� name=Submit></TD>\r\n    </TR>\r\n  </TBODY>\r\n  </form>\r\n</TABLE>\r\n<script language=\"javascript\" src=\"inc/js.js\"></script>\r\n";
		}
}

include_once( dirname( __FILE__ )."/../inc/conn.php" );
include_once( dirname( __FILE__ )."/inc/function.php" );
login_check( "gamegl" );
echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd\">\r\n<HTML xmlns=\"http://www.w3.org/1999/xhtml\">\r\n<HEAD>\r\n<TITLE>��������Ϸ����--�׷������Ϸϵͳ</TITLE>\r\n<META http-equiv=Content-Type content=\"text/html; charset=gb2312\">\r\n<LINK href=\"images/css_body.css\" type=text/css rel=stylesheet>\r\n<META content=\"MSHTML 6.00.3790.4275\" name=GENERATOR>\r\n</HEAD>\r\n<BODY>\r\n<DIV class=bodytitle>\r\n<DIV class=bodytitleleft></DIV>\r\n<DIV class=bodytitletxt>��������Ϸ����</DIV>\r\n</DIV>\r\n";
switch ( $_GET['action'] )
{
case "sedit" :
		sedit( );
		addlog( "��������Ϸ�����޸ĳɹ�" );
		showerr( "��������Ϸ�����޸ĳɹ�", "admin_box.php" );
		break;
default :
		edit( );
}
echo "</BODY>\r\n</HTML>\r\n";
?>
