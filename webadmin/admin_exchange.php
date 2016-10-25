<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/

function audit( )
{
		global $db;
		global $web_dbtop;
		$db->query( "update ".$web_dbtop."exchange set mode=1 where id={$_GET['id']}" );
		$query = $db->query( "Select * from ".$web_dbtop."exchange where id={$_GET['id']}" );
		if ( $rs = $db->fetch_array( $query ) )
		{
				$commoditiesid = $rs['commoditiesid'];
				$uid = $rs['uid'];
				$points = $rs['points'];
		}
		$db->query( "update ".$web_dbtop."webtj set exchangepoints=exchangepoints+{$points} where time='".date( "Y-m-d" )."'" );
		$db->query( "INSERT INTO ".$web_dbtop."msg (usersid,title,mag,mid,time) VALUES (0,'Withdrawal Alert','Your request for ".showcontent( "commodities", "name", $commoditiesid )." has been processed.',".$uid.",'".date( "Y-m-d H:i:s" )."')" );
}

function del( )
{
		global $db;
		global $web_dbtop;
		global $web_moneyname;
		$query = $db->query( "Select * From ".$web_dbtop."exchange where id={$_POST['id']}" );
		if ( ( $rs = $db->fetch_array( $query ) ) && $rs['mode'] != 1 )
		{
				$points = $rs['points'];
				$db->query( "update ".$web_dbtop."commodities set convertnum=convertnum-1 where id=".$rs['commoditiesid']."" );
				$db->query( "update ".$web_dbtop."users set points=points+{$points},djcs=djcs-1,djpoints=djpoints-{$points} where id=".$rs['uid']."" );
				$db->query( "update ".$web_dbtop."game_log set dj_doudou=dj_doudou-{$points} where uid=".$rs['uid'] );
				$db->query( "delete from ".$web_dbtop."exchange where id={$_POST['id']}" );
				if ( $_POST['delly'] == "other reason" )
				{
						$delly = $_POST['qtyy'];
				}
				else
				{
						$delly = $_POST['delly'];
				}
				$db->query( "INSERT INTO ".$web_dbtop."msg (usersid,title,mag,mid,time) VALUES (0,'Withdrawal Alert ','we are sorry but your request for ".showcontent( "commodities", "name", $rs['commoditiesid'] )." has been canceled due to ".$delly."all of the ".$web_moneyname." has been refunded to your account',".$rs['uid'].",'".date( "Y-m-d H:i:s" )."')" );
		}
}

function main( )
{
		global $db;
		global $web_dbtop;
		global $web_moneyname;
		echo "<DIV class=bodytitle>\r\n<DIV class=bodytitleleft></DIV>\r\n<DIV class=bodytitletxt>�һ�����</DIV>\r\n</DIV>\r\n<TABLE width=\"96%\" border=0 align=center cellpadding=0 cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n  <TBODY>\r\n    <TR>\r\n      <TD bgColor=#f5fafe><table width=\"96%\" border=\"0\" align=\"center\" cellpadding=\"3\" cellspacing=\"1\">\r\n          <tr>\r\n            <form action=\"admin_exchange.php?mode=";
		echo $_GET['mode'];
		echo "\" method=\"get\">\r\n              <td width=\"10%\"><strong>�����һ���</strong></td>\r\n              <td width=\"21%\"><input id=keyword size=20 name=keyword></td>\r\n              <td width=\"10%\" align=\"center\"><input name=\"mode\" type=\"hidden\" value=\"";
		echo $_GET['mode'];
		echo "\"><INPUT class=inputbut type=submit value=���� name=Submit></td>\r\n            </form>\r\n\t\t\t<form action=\"admin_exchange.php\" method=\"get\">\r\n            <td width=\"10%\"><STRONG>���ڲ�ѯ</STRONG>��</td>\r\n            <td width=\"21%\"><input id=stopdate size=15 name=stopdate onfocus=setday(this) readOnly>\r\n              <IMG onclick=stopdate.focus() src=\"images/calendar.gif\" align=absBottom></td>\r\n            <td><input name=\"mode\" type=\"hidden\" value=\"";
		echo $_GET['mode'];
		echo "\"><INPUT class=inputbut type=submit value=���� name=Submit></td>\r\n\t\t\t</form>\r\n          </tr>\r\n      </table></TD>\r\n    </TR>\r\n  </TBODY>\r\n</TABLE>\r\n<TABLE width=\"96%\" border=0 align=center cellpadding=\"5\" cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n  <TBODY>\r\n    <TR bgColor=\"#f5fafe\">\r\n      <TD align=\"center\">��Ʒ</TD>\r\n      <TD align=\"center\" width=\"25%\">�ҽ��ʺ�</TD>\r\n\t  <TD width=\"12%\" align=\"center\">";
		echo $web_moneyname;
		echo "</TD>\r\n      <TD width=\"8%\" align=\"center\">����</TD>\r\n\t  <TD width=\"12%\" align=\"center\">�ҽ�ʱ��</TD>\r\n\t  <TD width=\"6%\" align=\"center\">����</TD>\r\n    </TR>\r\n\t";
		$intpage = 20;
		if ( isset( $_GET['page'] ) )
		{
				$rsnum = ( $_GET['page'] - 1 ) * $intpage;
		}
		else
		{
				$rsnum = 0;
		}
		if ( $_GET['mode'] == 0 )
		{
				$sql = "Select * from ".$web_dbtop."exchange where (mode=0 or mode=2)";
		}
		else
		{
				$sql = "Select * from ".$web_dbtop."exchange where mode=1";
		}
		if ( $_GET['keyword'] )
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
				echo "    <TR bgcolor=\"#FFFFFF\" onMouseOver=\"this.bgColor='#f5fafe'\" onMouseOut=\"this.bgColor='#FFFFFF'\">\r\n      <TD align=\"center\"><A href=\"../prizes_content.php?id=";
				echo $rs['commoditiesid'];
				echo "\" target=\"_blank\">";
				echo showcontent( "commodities", "name", $rs['commoditiesid'] );
				echo "</A></TD>\r\n      <TD>";
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
				echo number_format( $rs['points'] );
				echo "</TD>\r\n      <TD align=\"center\">";
				echo $rs['num'];
				echo "</TD>\r\n\t  <TD align=\"center\">";
				echo date( "m-d H:i", strtotime( $rs['time'] ) );
				echo "</TD>\r\n      <TD align=\"center\">";
				if ( $rs['mode'] != 1 )
				{
						echo "<a href=\"#\" onclick=\"AddWin('W_DG_";
						echo $rs['id'];
						echo "','�û� ";
						echo $rs['uid'];
						echo " �ҽ�����','admin_exchange.php?action=look&id=";
						echo $rs['id'];
						echo "',450,410,0);return false\">����</a>";
				}
				else
				{
						echo "<a href=\"#\" onclick=\"AddWin('W_DG_";
						echo $rs['id'];
						echo "','�û� ";
						echo $rs['uid'];
						echo " �ҽ��鿴','admin_exchange.php?action=look&look=1&id=";
						echo $rs['id'];
						echo "',450,410,0);return false\">�鿴</a>";
				}
				echo "</TD>\r\n    </TR>\r\n\t";
		}
		echo "    <TR bgcolor=\"#f8fbfb\">\r\n      <TD colspan=\"6\" align=\"center\">";
		include_once( dirname( __FILE__ )."/../inc/page_class.php" );
		$page = new page( array(
				"total" => $intnum,
				"perpage" => $intpage
		) );
		echo $page->show( 4, "page", "curr" );
		echo "</TD>\r\n    </TR>\r\n  </TBODY>\r\n</TABLE>\r\n<script language=\"javascript\" src=\"inc/movie.js\"></script>\r\n<script language=\"javascript\" src=\"inc/QJ_Display.js\"></script>\r\n<script language=\"JavaScript\" src=\"inc/calendar.js\"></script>\r\n";
}

function look( )
{
		global $db;
		global $web_dbtop;
		global $web_moneyname;
		if ( $_GET['look'] != 1 )
		{
				$db->query( "update ".$web_dbtop."exchange set mode=2 where id={$_GET['id']}" );
		}
		$query = $db->query( "Select * from ".$web_dbtop."exchange where id={$_GET['id']}" );
		if ( $rs = $db->fetch_array( $query ) )
		{
				echo "<TABLE width=\"98%\" border=0 align=center cellpadding=\"4\" cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n  <TBODY>\r\n    <TR>\r\n      <TD vAlign=center width=\"30%\" bgColor=#f5fafe>��Ʒ��</TD>\r\n      <TD bgColor=#ffffff><A href=\"../prizes_content.php?id=";
				echo $rs['commoditiesid'];
				echo "\" target=\"_blank\">";
				echo showcontent( "commodities", "name", $rs['commoditiesid'] );
				echo "</A> <A href=\"";
				echo showcontent( "commodities", "link", $rs['commoditiesid'] );
				echo "\" target=\"_blank\"><img src=\"images/buy_16.gif\" alt=\"Ϊ�û�ȥ�����˽�Ʒ\"></a></TD>\r\n    </TR>\r\n    <TR>\r\n      <TD bgColor=#f5fafe>�ҽ��ʺţ�</TD>\r\n      <TD bgColor=#ffffff>";
				echo $rs['uid'];
				echo " <a href=\"#\" onclick=\"parent.AddWin('W_HD_";
				echo $rs['id'];
				echo "','�û� ";
				echo $rs['uid'];
				echo " ���ݺ˶�','admin_usersdz.php?id=";
				echo $rs['uid'];
				echo "',480,310,0);return false\"><img src=\"images/CreateFormMoreFormsGallery.gif\" width=\"16\" height=\"16\"></a></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>";
				echo $web_moneyname;
				echo "��</TD>\r\n      <TD bgColor=#ffffff>";
				echo number_format( $rs['points'] );
				echo "</TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>������</TD>\r\n      <TD bgColor=#ffffff>";
				echo $rs['num'];
				echo "</TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>��ϵQQ��</TD>\r\n      <TD bgColor=#ffffff>";
				echo $rs['qq'];
				echo "</TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>��ϵ�绰��</TD>\r\n      <TD bgColor=#ffffff>";
				echo $rs['tel'];
				echo "</TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>�ջ��ˣ�</TD>\r\n      <TD bgColor=#ffffff>";
				echo $rs['rname'];
				echo "</TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>lr�˻���</TD>\r\n      <TD bgColor=#ffffff>";
				echo $rs['lr_acc'];
				echo "</TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>���֤���룺</TD>\r\n      <TD bgColor=#ffffff>";
				echo $rs['card'];
				echo "</TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>�ջ���ַ��</TD>\r\n      <TD bgColor=#ffffff>";
				echo $rs['address'];
				echo "</TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>�ʱࣺ</TD>\r\n      <TD bgColor=#ffffff>";
				echo $rs['zip'];
				echo "</TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>�ҽ�ʱ�䣺</TD>\r\n      <TD bgColor=#ffffff>";
				echo $rs['time'];
				echo "</TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>��ע��</TD>\r\n      <TD bgColor=#ffffff>";
				echo $rs['remarks'];
				echo "</TD>\r\n    </TR>\r\n\t\r\n    <TR align=\"center\" bgcolor=\"#f8fbfb\">\r\n      <TD colspan=\"2\">";
				if ( $rs['mode'] == 1 )
				{
						echo "�ѷ���";
				}
				else
				{
						echo "<INPUT class=inputbut type=button value=���� name=Submit onClick=\"location.href='admin_exchange.php?action=audit&id=";
						echo $rs['id'];
						echo "&url=";
						echo $_SERVER['HTTP_REFERER'];
						echo "'\"> \r\n      <INPUT class=inputbut type=button value=ɾ�� name=Submit onClick=\"if(confirm('ȷ��Ҫɾ����?')){location.href='admin_exchange.php?action=delly&id=";
						echo $rs['id'];
						echo "&url=";
						echo $_SERVER['HTTP_REFERER'];
						echo "';return true;}\">\r\n      ";
				}
				echo "</TD>\r\n    </TR>\r\n  </TBODY>\r\n</TABLE>\r\n";
		}
}

function delly( )
{
		global $db;
		global $web_dbtop;
		$query = $db->query( "Select * from ".$web_dbtop."exchange where id={$_GET['id']}" );
		if ( $rs = $db->fetch_array( $query ) )
		{
				echo "<TABLE width=\"98%\" border=0 align=center cellpadding=\"4\" cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n <form action=\"?action=del&url=";
				echo $_GET['url'];
				echo "\" method=\"post\">\r\n <input name=\"id\" type=\"hidden\" value=\"";
				echo $rs['id'];
				echo "\">\r\n  <TBODY>\r\n    <TR>\r\n      <TD vAlign=center width=\"30%\" bgColor=#f5fafe>��Ʒ��</TD>\r\n      <TD bgColor=#ffffff>";
				echo showcontent( "commodities", "name", $rs['commoditiesid'] );
				echo "</TD>\r\n    </TR>\r\n    <TR>\r\n      <TD bgColor=#f5fafe>�ҽ��ʺ�</TD>\r\n      <TD bgColor=#ffffff>";
				echo $rs['uid'];
				echo "</TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>ɾ��ԭ��</TD>\r\n      <TD bgColor=#ffffff><select name=\"delly\" onchange=\"if(this.value=='����ԭ��'){document.getElementById('delqtyy').style.display='';}else{document.getElementById('delqtyy').style.display='none';}\">\r\n        <option value=\"�ҽ����ϲ�ȫ\">�ҽ����ϲ�ȫ</option>\r\n        <option value=\"��ʱû�иò�Ʒ\">��ʱû�иò�Ʒ</option>\r\n        <option value=\"����ԭ��\">����ԭ��</option>\r\n      </select></TD>\r\n    </TR>\r\n\t<TR id=\"delqtyy\" style=\"display:none\">\r\n      <TD bgColor=#f5fafe>����ԭ��</TD>\r\n      <TD bgColor=#ffffff><input name=\"qtyy\" type=\"text\" size=\"40\"></TD>\r\n    </TR>\r\n    <TR align=\"center\" bgcolor=\"#f8fbfb\">\r\n      <TD colspan=\"2\"><INPUT class=inputbut type=submit value=ɾ�� name=Submit></TD>\r\n    </TR>\r\n  </TBODY>\r\n  </form>\r\n</TABLE>\r\n";
		}
}

include_once( dirname( __FILE__ )."/../inc/conn.php" );
include_once( dirname( __FILE__ )."/inc/function.php" );
login_check( "djgl" );
echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd\">\r\n<HTML xmlns=\"http://www.w3.org/1999/xhtml\">\r\n<HEAD>\r\n<TITLE>�һ�����--�׷������Ϸϵͳ</TITLE>\r\n<META http-equiv=Content-Type content=\"text/html; charset=gb2312\">\r\n<LINK href=\"images/css_body.css\" type=text/css rel=stylesheet>\r\n<META content=\"MSHTML 6.00.3790.4275\" name=GENERATOR>\r\n</HEAD>\r\n<BODY>\r\n";
switch ( $_GET['action'] )
{
case "look" :
		look( );
		break;
case "delly" :
		delly( );
		break;
case "audit" :
		audit( );
		addlog( "�һ������ɹ�" );
		echo "<script language=javascript>alert(\"�һ������ɹ�\");parent.location.href=\"".$_GET['url']."\";parent.AddClose(\"NewW_DG_".intval( $_GET['id'] )."\");</script>";
		break;
case "del" :
		del( );
		addlog( "�һ�ɾ���ɹ�" );
		echo "<script language=javascript>alert(\"�һ�ɾ���ɹ�\");parent.location.href=\"".$_GET['url']."\";parent.AddClose(\"NewW_DG_".intval( $_POST['id'] )."\");</script>";
		break;
default :
		main( );
}
echo "</BODY></HTML>\r\n";
?>
