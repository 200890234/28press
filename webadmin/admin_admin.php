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
		$groupbox = implode( ",", $_POST['groupbox'] );
		$db->query( "INSERT INTO ".$web_dbtop."admin (name,password,groupbox) VALUES ('".$_POST['name']."','".md5( md5( $_POST['password'] ) )."','".$groupbox."')" );
}

function sedit( )
{
		global $db;
		global $web_dbtop;
		$groupbox = implode( ",", $_POST['groupbox'] );
		$sql = "update ".$web_dbtop."admin set name='".$_POST['name']."'";
		if ( $_POST['password'] )
		{
				if ( $_POST['password'] != $_POST['password2'] )
				{
						echo "<script language=javascript>alert('�Բ����������벻һ�£����������룡');history.go(-1);</script>";
						exit( );
				}
				$sql .= ",password='".md5( md5( $_POST['password'] ) )."'";
		}
		$db->query( $sql.",groupbox='".$groupbox.( "' where id=".$_POST['id'] ) );
}

function del( )
{
		global $db;
		global $web_dbtop;
		$db->query( "delete from ".$web_dbtop."admin where id={$_GET['id']}" );
}

function main( )
{
		global $db;
		global $web_dbtop;
		echo "<TABLE width=\"96%\" border=0 align=center cellpadding=\"5\" cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n  <TBODY>\r\n    <TR  bgColor=\"#f5fafe\">\r\n      <TD align=\"center\">�û���</TD>\r\n      <TD width=\"20%\" align=\"center\">��½ʱ��</TD>\r\n      <TD width=\"20%\" align=\"center\">��½IP</TD>\r\n      <TD width=\"15%\" align=\"center\">����</TD>\r\n    </TR>\r\n\t";
		$query = $db->query( "Select * from ".$web_dbtop."admin Order by id desc" );
		while ( $rs = $db->fetch_array( $query ) )
		{
				echo "    <TR bgcolor=\"#FFFFFF\">\r\n      <TD align=\"center\">";
				echo $rs['name'];
				echo "</TD>\r\n      <TD align=\"center\">";
				echo $rs['time'];
				echo "</TD>\r\n      <TD align=\"center\">";
				echo $rs['ip'];
				echo "</TD>\r\n      <TD align=\"center\"><A href=\"admin_admin.php?action=edit&id=";
				echo $rs['id'];
				echo "\">�޸�</a> | <A href=\"admin_admin.php?action=del&id=";
				echo $rs['id'];
				echo "\" onClick=\"return confirm('ȷ��Ҫɾ����?');\">ɾ��</a></TD>\r\n    </TR>\r\n\t";
		}
		echo "  </TBODY>\r\n</TABLE>\r\n";
}

function add( )
{
		echo "<TABLE width=\"96%\" border=0 align=center cellpadding=\"4\" cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n<form action=\"?action=sadd\" method=\"post\" name=\"form\" onSubmit=\"return Validator.Validate(this,3)\">\r\n  <TBODY>\r\n    <TR>\r\n      <TD vAlign=center width=\"20%\" bgColor=#f5fafe>�û�����</TD>\r\n      <TD bgColor=#ffffff><INPUT id=\"name\" size=50 value=\"\" name=\"name\" dataType=\"LimitB\" min=\"3\" max=\"20\" msg=\"�û��������ڴ���3,С��20���ֽ�\">\r\n        <input name=\"chkall\" type=\"checkbox\" id=\"chkall\" value=\"checkbox\" onClick=\"CheckAll(document.form.chkall.checked);\"/>\r\nѡ��ȫ��Ȩ��</TD>\r\n    </TR>\r\n    <TR>\r\n      <TD bgColor=#f5fafe>���룺</TD>\r\n      <TD bgColor=#ffffff><INPUT id=\"password\" size=50 value=\"\" name=\"password\" dataType=\"LimitB\" min=\"6\" max=\"20\" msg=\"�����������ڴ���6,С��20���ֽ�\"></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>�ظ����룺</TD>\r\n      <TD bgColor=#ffffff><INPUT id=\"password2\" size=50 value=\"\" name=\"password2\" dataType=\"Repeat\" to=\"password\" msg=\"������������벻һ��\"></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>ϵͳ����</TD>\r\n      <TD bgColor=#ffffff><input type=\"checkbox\" name=\"groupbox[]\" value=\"system\">\r\n        ϵͳ����</TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>��Ϸ����</TD>\r\n      <TD bgColor=#ffffff><input type=\"checkbox\" name=\"groupbox[]\" value=\"gamegl\">\r\n        ��Ϸ����\r\n          <input type=\"checkbox\" name=\"groupbox[]\" value=\"gametj\">\r\n��Ϸͳ��</TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>������</TD>\r\n      <TD bgColor=#ffffff><input type=\"checkbox\" name=\"groupbox[]\" value=\"adgl\">\r\n        ������\r\n          <input type=\"checkbox\" name=\"groupbox[]\" value=\"adff\">\r\n���𷢷�          \r\n<input type=\"checkbox\" name=\"groupbox[]\" value=\"adtj\">\r\n����ͳ��</TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>��Ʒ����</TD>\r\n      <TD bgColor=#ffffff><input type=\"checkbox\" name=\"groupbox[]\" value=\"jpgl\">\r\n��Ʒ����\r\n  <input type=\"checkbox\" name=\"groupbox[]\" value=\"djgl\">\r\n�ҽ�����</TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>�û�����</TD>\r\n      <TD bgColor=#ffffff><input type=\"checkbox\" name=\"groupbox[]\" value=\"users\">\r\n        �û�����\r\n          <input type=\"checkbox\" name=\"groupbox[]\" value=\"sms\"> \r\n          ����Ⱥ��\r\n          <input type=\"checkbox\" name=\"groupbox[]\" value=\"hdgl\">\r\n�����</TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>��̳����</TD>\r\n      <TD bgColor=#ffffff><input type=\"checkbox\" name=\"groupbox[]\" value=\"bbs\">\r\n      ��̳����</TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>�������</TD>\r\n      <TD bgColor=#ffffff><input type=\"checkbox\" name=\"groupbox[]\" value=\"business\">\r\n      �̻�����\r\n        <input type=\"checkbox\" name=\"groupbox[]\" value=\"card\"> \r\n        ��ֵ������\r\n        <input type=\"checkbox\" name=\"groupbox[]\" value=\"pay\">\r\n�������</TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>���ݿ����</TD>\r\n      <TD bgColor=#ffffff><input type=\"checkbox\" name=\"groupbox[]\" value=\"dbgl\">\r\n      ���ݿ����</TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>��ȫ����</TD>\r\n      <TD bgColor=#ffffff><input type=\"checkbox\" name=\"groupbox[]\" value=\"admingl\">\r\n      ��ȫ����</TD>\r\n    </TR>\r\n    <TR align=\"center\" bgcolor=\"#f8fbfb\">\r\n      <TD colspan=\"2\"><INPUT class=inputbut type=submit value=��� name=Submit></TD>\r\n    </TR>\r\n  </TBODY>\r\n  </form>\r\n</TABLE>\r\n<script language=\"javascript\" src=\"inc/js.js\"></script>\r\n<script language=\"javascript\" src=\"inc/movie.js\"></script>\r\n";
}

function edit( )
{
		global $db;
		global $web_dbtop;
		$query = $db->query( "Select * from ".$web_dbtop."admin where id={$_GET['id']}" );
		if ( $rs = $db->fetch_array( $query ) )
		{
				echo "<TABLE width=\"96%\" border=0 align=center cellpadding=\"4\" cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n<form action=\"?action=sedit\" method=\"post\" name=\"form\" onSubmit=\"return Validator.Validate(this,3)\">\r\n<input name=\"id\" type=\"hidden\" value=\"";
				echo $rs['id'];
				echo "\">\r\n  <TBODY>\r\n    <TR>\r\n      <TD vAlign=center width=\"20%\" bgColor=#f5fafe>�û�����</TD>\r\n      <TD bgColor=#ffffff><INPUT id=\"name\" size=50 value=\"";
				echo $rs['name'];
				echo "\" name=\"name\" dataType=\"LimitB\" min=\"3\" max=\"20\" msg=\"�û��������ڴ���3,С��20���ֽ�\"> <input name=\"chkall\" type=\"checkbox\" id=\"chkall\" value=\"checkbox\" onClick=\"CheckAll(document.form.chkall.checked);\"/>\r\n      ѡ��ȫ��Ȩ��</TD>\r\n    </TR>\r\n    <TR>\r\n      <TD bgColor=#f5fafe>���룺</TD>\r\n      <TD bgColor=#ffffff><INPUT id=\"password\" size=50 value=\"\" name=\"password\"></TD>\r\n    </TR>\r\n    <TR>\r\n      <TD bgColor=#f5fafe>�ظ����룺</TD>\r\n      <TD bgColor=#ffffff><INPUT id=\"password2\" size=50 value=\"\" name=\"password2\"></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>ϵͳ����</TD>\r\n      <TD bgColor=#ffffff><input name=\"groupbox[]\" type=\"checkbox\" value=\"system\" ";
				if ( stristr( $rs['groupbox'].",", "system," ) )
				{
						echo "checked";
				}
				echo " >\r\n    վ������</TD>\r\n\t  </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>��Ϸ����</TD>\r\n      <TD bgColor=#ffffff><input type=\"checkbox\" name=\"groupbox[]\" value=\"gamegl\" ";
				if ( stristr( $rs['groupbox'].",", "gamegl," ) )
				{
						echo "checked";
				}
				echo ">\r\n    ��Ϸ����\r\n      <input type=\"checkbox\" name=\"groupbox[]\" value=\"gametj\" ";
				if ( stristr( $rs['groupbox'].",", "gametj," ) )
				{
						echo "checked";
				}
				echo ">\r\n    ��Ϸͳ��</TD>\r\n\t  </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>������</TD>\r\n      <TD bgColor=#ffffff><input type=\"checkbox\" name=\"groupbox[]\" value=\"adgl\" ";
				if ( stristr( $rs['groupbox'].",", "adgl," ) )
				{
						echo "checked";
				}
				echo ">\r\n    ������\r\n      <input type=\"checkbox\" name=\"groupbox[]\" value=\"adff\" ";
				if ( stristr( $rs['groupbox'].",", "adff," ) )
				{
						echo "checked";
				}
				echo ">\r\n    ���𷢷�\r\n    <input type=\"checkbox\" name=\"groupbox[]\" value=\"adtj\" ";
				if ( stristr( $rs['groupbox'].",", "adtj," ) )
				{
						echo "checked";
				}
				echo ">\r\n    ����ͳ��</TD>\r\n\t  </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>��Ʒ����</TD>\r\n      <TD bgColor=#ffffff><input type=\"checkbox\" name=\"groupbox[]\" value=\"jpgl\" ";
				if ( stristr( $rs['groupbox'].",", "jpgl," ) )
				{
						echo "checked";
				}
				echo ">\r\n    ��Ʒ����\r\n      <input type=\"checkbox\" name=\"groupbox[]\" value=\"djgl\" ";
				if ( stristr( $rs['groupbox'].",", "djgl," ) )
				{
						echo "checked";
				}
				echo ">\r\n    �ҽ�����</TD>\r\n\t  </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>�û�����</TD>\r\n      <TD bgColor=#ffffff><input type=\"checkbox\" name=\"groupbox[]\" value=\"users\" ";
				if ( stristr( $rs['groupbox'].",", "users," ) )
				{
						echo "checked";
				}
				echo ">\r\n    �û�����\r\n      <input type=\"checkbox\" name=\"groupbox[]\" value=\"sms\" ";
				if ( stristr( $rs['groupbox'].",", "sms," ) )
				{
						echo "checked";
				}
				echo ">\r\n    ����Ⱥ��\r\n    <input type=\"checkbox\" name=\"groupbox[]\" value=\"hdgl\" ";
				if ( stristr( $rs['groupbox'].",", "hdgl," ) )
				{
						echo "checked";
				}
				echo ">\r\n    �����</TD>\r\n\t  </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>��̳����</TD>\r\n      <TD bgColor=#ffffff><input type=\"checkbox\" name=\"groupbox[]\" value=\"bbs\" ";
				if ( stristr( $rs['groupbox'].",", "bbs," ) )
				{
						echo "checked";
				}
				echo ">\r\n    ��̳����</TD>\r\n\t  </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>�������</TD>\r\n      <TD bgColor=#ffffff><input type=\"checkbox\" name=\"groupbox[]\" value=\"business\" ";
				if ( stristr( $rs['groupbox'].",", "business," ) )
				{
						echo "checked";
				}
				echo ">\r\n�̻�����\r\n<input type=\"checkbox\" name=\"groupbox[]\" value=\"card\" ";
				if ( stristr( $rs['groupbox'].",", "card," ) )
				{
						echo "checked";
				}
				echo ">\r\n��ֵ������\r\n<input type=\"checkbox\" name=\"groupbox[]\" value=\"pay\" ";
				if ( stristr( $rs['groupbox'].",", "pay," ) )
				{
						echo "checked";
				}
				echo ">\r\n�������</TD>\r\n\t  </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>���ݿ����</TD>\r\n      <TD bgColor=#ffffff><input type=\"checkbox\" name=\"groupbox[]\" value=\"dbgl\" ";
				if ( stristr( $rs['groupbox'].",", "dbgl," ) )
				{
						echo "checked";
				}
				echo ">\r\n    ���ݿ����</TD>\r\n\t  </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>��ȫ����</TD>\r\n      <TD bgColor=#ffffff><input type=\"checkbox\" name=\"groupbox[]\" value=\"admingl\" ";
				if ( stristr( $rs['groupbox'].",", "admingl," ) )
				{
						echo "checked";
				}
				echo ">\r\n    ��ȫ����</TD>\r\n\t  </TR>\r\n    <TR align=\"center\" bgcolor=\"#f8fbfb\">\r\n      <TD colspan=\"2\"><INPUT class=inputbut type=submit value=�޸� name=Submit></TD>\r\n    </TR>\r\n  </TBODY>\r\n  </form>\r\n</TABLE>\r\n<script language=\"javascript\" src=\"inc/js.js\"></script>\r\n<script language=\"javascript\" src=\"inc/movie.js\"></script>\r\n";
		}
}

include_once( dirname( __FILE__ )."/../inc/conn.php" );
include_once( dirname( __FILE__ )."/inc/function.php" );
login_check( "admingl" );
echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd\">\r\n<HTML xmlns=\"http://www.w3.org/1999/xhtml\">\r\n<HEAD>\r\n<TITLE>����Ա����--�׷������Ϸϵͳ</TITLE>\r\n<META http-equiv=Content-Type content=\"text/html; charset=gb2312\">\r\n<LINK href=\"images/css_body.css\" type=text/css rel=stylesheet>\r\n<META content=\"MSHTML 6.00.3790.4275\" name=GENERATOR>\r\n</HEAD>\r\n<BODY>\r\n<DIV class=bodytitle>\r\n<DIV class=bodytitleleft></DIV>\r\n<DIV class=bodytitletxt>����Ա����</DIV>\r\n<DIV class=bodytitletxt2><a href=\"admin_admin.php?action=add\">��ӹ���Ա</a></DIV>\r\n</DIV>\r\n";
switch ( $_GET['action'] )
{
case "add" :
		add( );
		break;
case "sadd" :
		sadd( );
		addlog( "����Ա��ӳɹ�" );
		showerr( "����Ա��ӳɹ�", "admin_admin.php" );
		break;
case "edit" :
		edit( );
		break;
case "sedit" :
		sedit( );
		addlog( "����Ա�޸ĳɹ�" );
		showerr( "����Ա�޸ĳɹ�", "admin_admin.php" );
		break;
case "del" :
		del( );
		addlog( "����Աɾ���ɹ�" );
		showerr( "����Աɾ���ɹ�", "admin_admin.php" );
		break;
default :
		main( );
}
echo "</BODY></HTML>\r\n";
?>
