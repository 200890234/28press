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
		$db->query( "INSERT INTO ".$web_dbtop."ctype (name,typeid,sort) VALUES ('{$_POST['name']}',{$_POST['typeid']},{$_POST['sort']})" );
}

function sedit( )
{
		global $db;
		global $web_dbtop;
		$i = 0;
		for ( ;	$i < count( $_POST['id'] );	++$i	)
		{
				$id = $_POST['id'][$i];
				if ( $_POST["typeid_".$id] == $id )
				{
						echo "<script language=javascript>alert('�Բ�����Ϊ�Լ�������Ŀ��');history.go(-1);</script>";
						exit( );
				}
				$db->query( "update ".$web_dbtop."ctype set name='".$_POST["name_".$id]."',typeid=".$_POST["typeid_".$id].",sort=".$_POST["sort_".$id].( " where id=".$id ) );
		}
}

function del( )
{
		global $db;
		global $web_dbtop;
		$db->query( "delete from ".$web_dbtop."ctype where id =".$_GET['id']."" );
}

function main( )
{
		global $db;
		global $web_dbtop;
		echo "<TABLE width=\"96%\" border=0 align=center cellpadding=\"5\" cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n  <TBODY>\r\n    <TR bgColor=\"#f5fafe\">\r\n\t  <TD width=\"4%\" align=\"center\" >&nbsp;</TD>\r\n      <TD align=\"center\">��������</TD>\r\n\t  <TD width=\"20%\" align=\"center\">��������</TD>\r\n      <TD width=\"15%\" align=\"center\">����</TD>\r\n      <TD width=\"15%\" align=\"center\">����</TD>\r\n    </TR>\r\n\t<form action=\"?action=sedit\" method=\"post\" name=\"form\">\r\n\t";
		$query = $db->query( "Select * from ".$web_dbtop."ctype where typeid=0 Order by sort asc,id desc" );
		while ( $rs = $db->fetch_array( $query ) )
		{
				echo "    <TR bgcolor=\"#FFFFFF\" onMouseOver=\"this.bgColor='#f5fafe'\" onMouseOut=\"this.bgColor='#FFFFFF'\">\r\n\t  <TD><input name=\"id[]\" type=\"checkbox\" id=\"id[]\" value=\"";
				echo $rs['id'];
				echo "\" checked></TD>\r\n      <TD><INPUT id=\"name_";
				echo $rs['id'];
				echo "\" size=30 name=\"name_";
				echo $rs['id'];
				echo "\" value=\"";
				echo $rs['name'];
				echo "\"></TD>\r\n\t  <TD align=\"center\"><select name=\"typeid_";
				echo $rs['id'];
				echo "\" id=\"typeid_";
				echo $rs['id'];
				echo "\">";
				echo edittype( $rs['typeid'] );
				echo "</select></TD>\r\n      <TD align=\"center\"><INPUT id=\"sort_";
				echo $rs['id'];
				echo "\" size=5 name=\"sort_";
				echo $rs['id'];
				echo "\" value=\"";
				echo $rs['sort'];
				echo "\"></TD>\r\n      <TD align=\"center\"><A href=\"admin_ctype.php?action=add&id=";
				echo $rs['id'];
				echo "\">�������</a> | <A href=\"admin_ctype.php?action=del&id=";
				echo $rs['id'];
				echo "\" onClick=\"return confirm('ȷ��Ҫɾ����?');\">ɾ��</a></TD>\r\n    </TR>\r\n\t";
				echo getchildnewslist( $rs['id'] );
		}
		echo "    <TR bgcolor=\"#f8fbfb\">\r\n      <TD colspan=\"5\" align=\"center\"><INPUT class=inputbut type=submit value=�����޸�ѡ���� name=Submit></TD>\r\n    </TR>\r\n\t</form>\r\n  </TBODY>\r\n</TABLE>\r\n<script language=\"javascript\" src=\"inc/movie.js\"></script>\r\n";
}

function add( )
{
		echo "<TABLE width=\"96%\" border=0 align=center cellpadding=\"4\" cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n<form action=\"?action=sadd\" method=\"post\" onSubmit=\"return Validator.Validate(this,3)\">\r\n  <TBODY>\r\n    <TR>\r\n      <TD vAlign=center width=\"20%\" bgColor=#f5fafe>�������ࣺ</TD>\r\n      <TD bgColor=#ffffff>";
		addtypeid( $_GET['id'], "typeid" );
		echo "</TD>\r\n    </TR>\r\n    <TR>\r\n      <TD bgColor=#f5fafe>�������ƣ�</TD>\r\n      <TD bgColor=#ffffff><INPUT id=\"name\" size=50 name=\"name\" dataType=\"Require\" msg=\"����д��������\"></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>��������</TD>\r\n      <TD bgColor=#ffffff><INPUT name=\"sort\" id=\"sort\" value=\"0\" size=50 dataType=\"Integer\" msg=\"��������ֻ�������ָ�ʽ\"></TD>\r\n    </TR>\r\n    <TR align=\"center\" bgcolor=\"#f8fbfb\">\r\n      <TD colspan=\"2\"><INPUT class=inputbut type=submit value=��� name=Submit></TD>\r\n    </TR>\r\n  </TBODY>\r\n  </form>\r\n</TABLE>\r\n";
}

include_once( dirname( __FILE__ )."/../inc/conn.php" );
include_once( dirname( __FILE__ )."/inc/function.php" );
login_check( "jpgl" );
echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd\">\r\n<HTML xmlns=\"http://www.w3.org/1999/xhtml\">\r\n<HEAD>\r\n<TITLE>��Ʒ�������--�׷������Ϸϵͳ</TITLE>\r\n<META http-equiv=Content-Type content=\"text/html; charset=gb2312\">\r\n<LINK href=\"images/css_body.css\" type=text/css rel=stylesheet>\r\n<META content=\"MSHTML 6.00.3790.4275\" name=GENERATOR>\r\n</HEAD>\r\n<BODY>\r\n<DIV class=bodytitle>\r\n<DIV class=bodytitleleft></DIV>\r\n<DIV class=bodytitletxt>��Ʒ�������</DIV>\r\n<DIV class=bodytitletxt2><a href=\"admin_ctype.php?action=add\">��ӽ�Ʒ����</a></DIV>\r\n</DIV>\r\n";
switch ( $_GET['action'] )
{
case "add" :
		add( );
		break;
case "sadd" :
		sadd( );
		addlog( "��ӽ�Ʒ����" );
		showerr( "��Ʒ������ӳɹ�", "admin_ctype.php" );
		break;
case "sedit" :
		sedit( );
		addlog( "��Ʒ�����޸ĳɹ�" );
		showerr( "��Ʒ�����޸ĳɹ�", "admin_ctype.php" );
		break;
case "del" :
		del( );
		addlog( "��Ʒ����ɾ���ɹ�" );
		showerr( "��Ʒ����ɾ���ɹ�", "admin_ctype.php" );
		break;
default :
		main( );
}
echo "</BODY></HTML>\r\n";
?>
