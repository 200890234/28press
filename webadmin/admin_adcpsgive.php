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
		$query = $db->query( "Select * from ".$web_dbtop."adlogusers where id=".$_POST['cjid'] );
		if ( $rs = $db->fetch_array( $query ) )
		{
				$points = intval( $_POST['cjjg'] ) * $rs['adpoints'];
				$db->query( "update ".$web_dbtop."users set points=points+".$points." where id=".$rs['uid'] );
				$db->query( "update ".$web_dbtop."game_log set jj_hd=jj_hd+{$points} where uid=".$rs['uid'] );
				$query_f = $db->query( "Select tjid,time from ".$web_dbtop."users where id=".$rs['uid'] );
				if ( $rs_f = $db->fetch_array( $query_f ) )
				{
						$uid = $rs_f['tjid'];
						$regtime = $rs_f['time'];
				}
				if ( $uid )
				{
						$sxpoints = round( $points * 11 / 100 );
						$db->query( "update ".$web_dbtop."users set points=points+{$sxpoints} where id =".$uid );
						$db->query( "update ".$web_dbtop."game_log set xx_hd=xx_hd+{$sxpoints} where uid=".$uid );
						$db->query( "insert into ".$web_dbtop."tjlog (uid,xid,type,regtime,points,time) values (".$uid.",".$rs['uid'].",'ע���Ƽ�','".date( "Y-m-d", strtotime( $regtime ) )."',".$sxpoints.",'".date( "Y-m-d" )."')" );
				}
				userslog( 1, "�������� ".$rs['adtitle'], $points, 0, $rs['uid'] );
		}
		$query = $db->query( "Select * from ".$web_dbtop."adtj where STR_TO_DATE(time,'%Y-%m-%d')='".date( "Y-m-d" )."' and type=2" );
		if ( $rs = $db->fetch_array( $query ) )
		{
				$db->query( "update ".$web_dbtop."adtj set num=num+1,points=points+{$points} where id=".$rs['id'] );
		}
		else
		{
				$db->query( "insert into ".$web_dbtop."adtj (time,num,points,type) values ('".date( "Y-m-d" )."',1,".$points.",2)" );
		}
		$db->query( "update ".$web_dbtop."adlogusers set zt=1,fatime='".date( "Y-m-d:H:i:s" )."' where id=".$_POST['cjid'] );
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
		$db->query( "delete from ".$web_dbtop."adlogusers where id in ({$id})" );
}

function main( )
{
		global $db;
		global $web_dbtop;
		global $web_moneyname;
		echo "<TABLE width=\"96%\" border=0 align=center cellpadding=0 cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n  <TBODY>\r\n    <TR>\r\n      <TD bgColor=#f5fafe><table width=\"96%\" border=\"0\" align=\"center\" cellpadding=\"3\" cellspacing=\"1\">\r\n          <tr>\r\n            <form action=\"admin_adcpsgive.php\" method=\"get\">\r\n              <td width=\"15%\" class=\"bline\"><strong>�����û�id��</strong></td>\r\n              <td width=\"21%\" class=\"bline\"><input id=keyword size=20 name=keyword></td>\r\n              <td width=\"5%\" align=\"center\" class=\"bline\"><INPUT class=inputbut type=submit value=���� name=Submit></td>\r\n\t\t\t</form>\r\n\t\t\t<form action=\"admin_adcpsgive.php\" method=\"get\">\r\n            <td width=\"15%\" align=\"center\" class=\"bline\"><STRONG>���ڲ�ѯ</STRONG>��</td>\r\n            <td width=\"21%\" align=\"center\" class=\"bline\"><input id=stopdate size=15 name=stopdate onfocus=setday(this) readOnly> \r\n            <IMG onclick=stopdate.focus() src=\"images/calendar.gif\" align=absBottom></td>\r\n            <td colspan=\"2\" class=\"bline\"><INPUT class=inputbut type=submit value=���� name=Submit></td>\r\n          </form>\r\n\t\t  </tr>\r\n          <tr>\r\n            <td><STRONG>�鿴��ʽ</STRONG>��</td>\r\n            <td colspan=\"6\"><A href=\"admin_adcpsgive.php?zt=1\">�Է���</A> | <A href=\"admin_adcpsgive.php?zt=0\">δ����</A></td>\r\n          </tr>\r\n      </table></TD>\r\n    </TR>\r\n  </TBODY>\r\n</TABLE>\r\n<TABLE width=\"96%\" border=0 align=center cellpadding=\"5\" cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n  <TBODY>\r\n    <TR bgColor=\"#f5fafe\">\r\n\t  <TD width=\"4%\" align=\"center\" >&nbsp;</TD>\r\n      <TD align=\"center\">�������</TD>\r\n\t  <TD width=\"25%\" align=\"center\">�û�</TD>\r\n\t  <TD width=\"15%\" align=\"center\">�û�IP</TD>\r\n\t  <TD width=\"10%\" align=\"center\">����";
		echo $web_moneyname;
		echo "</TD>\r\n      <TD width=\"12%\" align=\"center\">����ʱ��</TD>\r\n      <TD width=\"10%\" align=\"center\">����</TD>\r\n    </TR>\r\n  <form name=\"form\" method=\"post\">\r\n\t";
		$intpage = 20;
		if ( isset( $_GET['page'] ) )
		{
				$rsnum = ( $_GET['page'] - 1 ) * $intpage;
		}
		else
		{
				$rsnum = 0;
		}
		$sql = "Select * from ".$web_dbtop."adlogusers where type=2";
		if ( isset( $_GET['zt'] ) )
		{
				$sql .= " and zt=".intval( $_GET['zt'] )."";
		}
		if ( isset( $_GET['keyword'] ) )
		{
				$sql .= " and uid=".intval( $_GET['keyword'] )."";
		}
		if ( isset( $_GET['stopdate'] ) )
		{
				$sql .= " and STR_TO_DATE(time,'%Y-%m-%d')='".$_GET['stopdate']."'";
		}
		$sql .= " Order by id desc";
		$query = $db->query( $sql );
		if ( $db->fetch_array( $query ) )
		{
				$intnum = $db->num_rows( $query );
		}
		$query = $db->query( $sql.( " limit ".$rsnum.",{$intpage}" ) );
		while ( $rs = $db->fetch_array( $query ) )
		{
				echo "    <TR bgcolor=\"#FFFFFF\" onMouseOver=\"this.bgColor='#f5fafe'\" onMouseOut=\"this.bgColor='#FFFFFF'\">\r\n\t  <TD align=\"center\"><input name=\"id[]\" type=\"checkbox\" id=\"id[]\" value=\"";
				echo $rs['id'];
				echo "\"></TD>\r\n      <TD>";
				echo $rs['adtitle'];
				echo "</TD>\r\n\t  <TD>";
				echo $rs['uid'];
				if ( showcontent( "users", "vip", $rs['uid'] ) == 1 )
				{
						echo "<img src=\"../images/vip.gif\" />";
				}
				echo " <a href=\"#\" onclick=\"AddWin('W_SFYZ_";
				echo $rs['uid'];
				echo "','�û� ";
				echo $rs['uid'];
				echo " �����֤�鿴','admin_authentication.php?action=look&id=";
				echo $rs['uid'];
				echo "',550,320,0);return false\"><img src=\"images/CreateTableTemplatesGallery.gif\" width=\"16\" height=\"16\"></a> <a href=\"#\" onclick=\"AddWin('W_HD_";
				echo $rs['id'];
				echo "','�û� ";
				echo $rs['uid'];
				echo " ���ݺ˶�','admin_usersdz.php?id=";
				echo $rs['uid'];
				echo "',480,340,0);return false\"><img src=\"images/CreateFormMoreFormsGallery.gif\" width=\"16\" height=\"16\"></a> <a href=\"#\" onclick=\"AddWin('W_SMS_";
				echo $rs['uid'];
				echo "','�û� ";
				echo $rs['uid'];
				echo " ����֪ͨ','admin_sms.php?action=sms&uid=";
				echo $rs['uid'];
				echo "',480,220,0);return false\"><img src=\"images/sms.gif\" width=\"16\" height=\"16\"></a></TD>\r\n\t  <TD align=\"center\">";
				echo $rs['uip'];
				echo "</TD>\r\n\t  <TD align=\"center\">";
				echo number_format( $rs['adpoints'] );
				echo "<img src=\"images/jd0.gif\" width=\"10\" height=\"10\">/Ԫ</TD>\r\n      <TD align=\"center\" id=\"";
				echo $rs['id'];
				echo "\">";
				echo date( "m-d H:i", strtotime( $rs['time'] ) );
				echo "</TD>\r\n      <TD align=\"center\">";
				if ( $rs['zt'] != 1 )
				{
						echo "<A href=\"#\" onClick=\"setdayjs('";
						echo $rs['id'];
						echo "')\";>����</a> | ";
				}
				echo "<A href=\"admin_adcpsgive.php?action=del&id=";
				echo $rs['id'];
				echo "\" onClick=\"return confirm('ȷ��Ҫɾ����?');\">ɾ��</a></TD>\r\n    </TR>\r\n\t";
		}
		echo "\t<TR bgcolor=\"#f8fbfb\">\r\n      <TD align=\"center\"><input name=\"chkall\" type=\"checkbox\" id=\"chkall\" value=\"checkbox\" onClick=\"CheckAll(document.form.chkall.checked);\"></TD>\r\n      <TD colspan=\"6\"><input type=\"button\" name=\"del\" value=\"����ɾ��\"  onClick=\"document.form.action='?action=del';{if(chkCheckBoxChs('id[]')==false){alert('������ѡ��һ����¼��');return;}};{if(confirm('ȷ��ɾ������ѡ��ļ�¼��')){this.document.form.submit();return true;}}\" class=inputbut>\r\n      </TD>\r\n\t</TR>\r\n  </form>\r\n    <TR align=\"center\" bgcolor=\"#f8fbfb\">\r\n      <TD colspan=\"7\">";
		include_once( dirname( __FILE__ )."/../inc/page_class.php" );
		$page = new page( array(
				"total" => $intnum,
				"perpage" => $intpage
		) );
		echo $page->show( 4, "page", "curr" );
		echo "</TD>\r\n    </TR>\r\n  </TBODY>\r\n</TABLE>\r\n<script language=\"JavaScript\" src=\"inc/calendar.js\"></script>\r\n<script language=\"javascript\" src=\"inc/movie.js\"></script>\r\n<script language=\"javascript\" src=\"inc/QJ_Display.js\"></script>\r\n";
}

include_once( dirname( __FILE__ )."/../inc/conn.php" );
include_once( dirname( __FILE__ )."/inc/function.php" );
login_check( "adff" );
echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd\">\r\n<HTML xmlns=\"http://www.w3.org/1999/xhtml\">\r\n<HEAD>\r\n<TITLE>���𷢷Ź���--�׷������Ϸϵͳ</TITLE>\r\n<META http-equiv=Content-Type content=\"text/html; charset=gb2312\">\r\n<LINK href=\"images/css_body.css\" type=text/css rel=stylesheet>\r\n<META content=\"MSHTML 6.00.3790.4275\" name=GENERATOR>\r\n</HEAD>\r\n<BODY>\r\n<DIV class=bodytitle>\r\n<DIV class=bodytitleleft></DIV>\r\n<DIV class=bodytitletxt>���𷢷Ź���</DIV>\r\n</DIV>\r\n";
switch ( $_GET['action'] )
{
case "edit" :
		sedit( );
		addlog( "���𷢷ųɹ�" );
		showerr( "���𷢷ųɹ�", "admin_adcpsgive.php" );
		break;
case "del" :
		del( );
		addlog( "���Ž���ɾ���ɹ�" );
		showerr( "���Ž���ɾ���ɹ�", "admin_adcpsgive.php" );
		break;
default :
		main( );
}
echo "</BODY></HTML>\r\n";
?>
