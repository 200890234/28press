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
		$query = $db->query( "Select cardname,cardtop,cardlen,cardtype,to_card,cardprice from ".$web_dbtop."cardtype where id={$_POST['cardtype']}" );
		if ( $rs = $db->fetch_array( $query ) )
		{
				$cardname = $rs['cardname'];
				$cardtop = $rs['cardtop'];
				$cardlen = $rs['cardlen'];
				$cardtype = $rs['cardtype'];
				$cardprice = $rs['cardprice'];
				$to_card =$rs['to_card'];
		}
		$i = 0;
		for ( ;	$i < $_POST['num'];	++$i	)
		{
				$db->query( "INSERT INTO ".$web_dbtop."card (cardtype,to_card,cardid,cardpaw,time,businessid) VALUES ({$_POST['cardtype']},".$to_card.",'".$cardtop.createrandstring( $cardlen, $cardtype )."','".createrandstring( $cardlen, $cardtype )."','".date( "Y-m-d H:i:s" ).( "',".$_POST['businessid'].")" ) );
		}
		$amount = $cardprice * showcontent( "business", "discount", $_POST['businessid'] ) / 10 * $i;
		$db->query( "update ".$web_dbtop."business set sales=sales+{$amount} where id={$_POST['businessid']}" );
		$v_orderid = "0-".date( "YmdHis", time( ) );
		$db->query( "insert into ".$web_dbtop."paylog (orderid,price,businessid,time) values('{$v_orderid}',{$amount},{$_POST['businessid']},'".date( "Y-m-d H:i:s" )."')" );
		$db->query( "insert into ".$web_dbtop."paylogc (cardname,cardnum,price,orderid) VALUES ('{$cardname}',{$i},{$amount},'{$v_orderid}')" );
}

function sedit( )
{
		global $db;
		global $web_dbtop;
		$id = implode( ",", $_POST['id'] );
		$db->query( "update ".$web_dbtop."card set businessid={$_POST['businessid']} where id in ({$id})" );
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
		$db->query( "delete from ".$web_dbtop."card where id in ({$id})" );
}

function main( )
{
		global $db;
		global $web_dbtop;
		echo "<TABLE width=\"96%\" border=0 align=center cellpadding=0 cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n  <TBODY>\r\n    <TR>\r\n      <TD bgColor=#f5fafe><table width=\"96%\" border=\"0\" align=\"center\" cellpadding=\"3\" cellspacing=\"1\">\r\n          <tr>\r\n            <form action=\"admin_card.php\" method=\"get\">\r\n              <td width=\"12%\"><strong>������ֵ����</strong></td>\r\n              <td width=\"21%\"><input id=keyword size=20 name=keyword></td>\r\n              <td width=\"5%\" align=\"center\"><INPUT class=inputbut type=submit value=���� name=Submit></td>\r\n\t\t    </form>\r\n              <td width=\"12%\" align=\"center\"><STRONG>�����ѯ</STRONG>��</td>\r\n              <td width=\"15%\" align=\"center\">\r\n\t\t\t  <select onchange=\"javascript:window.location.href=this.options[this.selectedIndex].value\">\r\n    \t\t  <option value=\"admin_card.php\">ȫ����</option>\r\n\t\t\t  ";
		$query = $db->query( "Select * from ".$web_dbtop."cardtype Order by id desc" );
		while ( $rs = $db->fetch_array( $query ) )
		{
				echo "<option value=\"admin_card.php?type=".$rs['id']."&state=".$_GET['state']."\"".( $_GET['type'] == $rs['id'] ? "selected" : "" ).">".$rs['cardname']."</option>";
		}
		echo "\t\t\t  </select>\r\n\t\t\t  </td>\r\n              <td width=\"12%\" align=\"center\"><strong>״̬��ѯ��</strong></td>\r\n              <td width=\"20%\" align=\"center\"><a href=\"?state=1\">�ѳ�ֵ</a> | <a href=\"?state=0\">δ��ֵ</a> | <a href=\"?state=2\">���۳�</a></td>\r\n          </tr>\r\n      </table></TD>\r\n    </TR>\r\n  </TBODY>\r\n</TABLE>\r\n<TABLE width=\"96%\" border=0 align=center cellpadding=\"5\" cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n<form action=\"\" name=\"form\" method=\"post\">\r\n  <TBODY>\r\n    <TR bgColor=\"#f5fafe\">\r\n      <TD width=\"4%\">&nbsp;</TD>\r\n      <TD align=\"center\">����</TD>\r\n\t  <TD align=\"center\">����</TD>\r\n      <TD width=\"15%\" align=\"center\">��ֵ������</TD>\r\n      <TD width=\"15%\" align=\"center\">�����̻�</TD>\r\n      <TD width=\"10%\" align=\"center\">״̬</TD>\r\n      <TD width=\"8%\" align=\"center\">����</TD>\r\n    </TR>\r\n\t";
		$intpage = 20;
		if ( isset( $_GET['page'] ) )
		{
				$rsnum = ( $_GET['page'] - 1 ) * $intpage;
		}
		else
		{
				$rsnum = 0;
		}
		if ( !$_GET['state'] )
		{
				$GLOBALS['_GET']['state'] = 0;
		}
		$sql = "Select * from ".$web_dbtop."card where state=".$_GET['state'];
		if ( $_GET['type'] )
		{
				$sql .= " and cardtype=".$_GET['type']."";
		}
		if ( $_GET['keyword'] )
		{
				$sql = "Select * from ".$web_dbtop."card where cardid='".$_GET['keyword']."'";
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
				echo "    <TR bgcolor=\"#FFFFFF\" onMouseOver=\"this.bgColor='#f5fafe'\" onMouseOut=\"this.bgColor='#FFFFFF'\">\r\n      <TD align=\"center\"><input name=\"id[]\" type=\"checkbox\" id=\"id[]\" value=\"";
				echo $rs['id'];
				echo "\"></TD>\r\n      <TD align=\"center\">";
				echo $rs['cardid'];
				echo "</TD>\r\n\t  <TD align=\"center\">";
				echo $rs['cardpaw'];
				echo "</TD>\r\n      <TD align=\"center\">";
				echo showcontent( "cardtype", "cardname", $rs['cardtype'] );
				echo "</TD>\r\n      <TD align=\"center\">";
				echo $rs['businessid'] ? showcontent( "business", "name", $rs['businessid'] ) : "�ҽ��Զ�����";
				echo "</TD>\r\n      <TD align=\"center\">";
				if ( $rs['state'] == 0 )
				{
						echo "δ��ֵ";
				}
				else if ( $rs['state'] == 2 )
				{
						echo "���۳�".$rs['uid'];
				}
				else
				{
						echo $rs['uid']."��ֵ";
				}
				echo "</TD>\r\n      <TD align=\"center\"><A href=\"admin_card.php?action=del&id=";
				echo $rs['id'];
				echo "\" onClick=\"return confirm('ȷ��Ҫɾ����?');\">ɾ��</a></TD>\r\n    </TR>\r\n\t";
		}
		echo "    <TR bgcolor=\"#f8fbfb\">\r\n      <TD align=\"center\"><input name=\"chkall\" type=\"checkbox\" id=\"chkall\" value=\"checkbox\" onClick=\"CheckAll(document.form.chkall.checked);\"/></TD>\r\n      <TD colspan=\"6\"><input type=\"button\" name=\"del\" value=\"����ɾ��\"  onClick=\"document.form.action='?action=del';{if(chkCheckBoxChs('id[]')==false){alert('������ѡ��һ����¼��');return;}};{if(confirm('ȷ��ɾ������ѡ��ļ�¼��')){this.document.form.submit();return true;}}\" class=inputbut></TD>\r\n    </TR>\r\n    <TR bgcolor=\"#f8fbfb\">\r\n      <TD colspan=\"7\" align=\"center\">";
		include_once( dirname( __FILE__ )."/../inc/page_class.php" );
		$page = new page( array(
				"total" => $intnum,
				"perpage" => $intpage
		) );
		echo $page->show( 4, "page", "curr" );
		echo "</TD>\r\n    </TR>\r\n  </TBODY>\r\n </form>\r\n</TABLE>\r\n<script language=\"javascript\" src=\"inc/movie.js\"></script>\r\n";
}

function add( )
{
		echo "<TABLE width=\"96%\" border=0 align=center cellpadding=\"4\" cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n<form action=\"?action=sadd\" method=\"post\" onSubmit=\"return Validator.Validate(this,3)\">\r\n  <TBODY>\r\n    <TR>\r\n      <TD vAlign=center width=\"20%\" bgColor=#f5fafe>��ֵ�����ͣ�</TD>\r\n      <TD bgColor=#ffffff>";
		cardtypeselect( );
		echo "</TD>\r\n    </TR>\r\n    <TR>\r\n      <TD bgColor=#f5fafe>��ֵ��������</TD>\r\n      <TD bgColor=#ffffff><INPUT id=\"num\" size=20 name=\"num\" dataType=\"Integer\" msg=\"�Բ����ʽ����ȷ\"></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>��ֵ�������̻���</TD>\r\n      <TD bgColor=#ffffff>";
		businessselect( );
		echo "</TD>\r\n    </TR>\r\n    <TR align=\"center\" bgcolor=\"#f8fbfb\">\r\n      <TD colspan=\"2\"><INPUT class=inputbut type=submit value=���� name=Submit></TD>\r\n    </TR>\r\n  </TBODY>\r\n  </form>\r\n</TABLE>\r\n<script language=\"javascript\" src=\"inc/js.js\"></script>\r\n";
}

function edit( )
{
		echo "<TABLE width=\"96%\" border=0 align=center cellpadding=\"4\" cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n<form action=\"?action=sedit\" method=\"post\" onSubmit=\"return Validator.Validate(this,3)\">\r\n<input name=\"id\" type=\"hidden\" value=\"";
		echo $rs['id'];
		echo "\">\r\n  <TBODY>\r\n   <TR>\r\n      <TD vAlign=center width=\"20%\" bgColor=#f5fafe>��ֵ�������̻���</TD>\r\n      <TD bgColor=#ffffff><select name=\"typeid\" id=\"typeid\"></select></TD>\r\n    </TR>\r\n    <TR align=\"center\" bgcolor=\"#f8fbfb\">\r\n      <TD colspan=\"2\"><INPUT class=inputbut type=submit value=���� name=Submit>\r\n      &nbsp;</TD>\r\n    </TR>\r\n  </TBODY>\r\n  </form>\r\n</TABLE>\r\n<script language=\"javascript\" src=\"inc/js.js\"></script>\r\n";
}

include_once( dirname( __FILE__ )."/../inc/conn.php" );
include_once( dirname( __FILE__ )."/inc/function.php" );
login_check( "card" );
echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd\">\r\n<HTML xmlns=\"http://www.w3.org/1999/xhtml\">\r\n<HEAD>\r\n<TITLE>��ֵ������--�׷������Ϸϵͳ</TITLE>\r\n<META http-equiv=Content-Type content=\"text/html; charset=gb2312\">\r\n<LINK href=\"images/css_body.css\" type=text/css rel=stylesheet>\r\n<META content=\"MSHTML 6.00.3790.4275\" name=GENERATOR>\r\n</HEAD>\r\n<BODY>\r\n<DIV class=bodytitle>\r\n<DIV class=bodytitleleft></DIV>\r\n<DIV class=bodytitletxt>��ֵ������</DIV>\r\n<DIV class=bodytitletxt2><a href=\"admin_card.php?action=add\">���ɳ�ֵ��</a></DIV>\r\n</DIV>\r\n";
switch ( $_GET['action'] )
{
case "add" :
		add( );
		break;
case "sadd" :
		sadd( );
		addlog( "���ɳ�ֵ��" );
		showerr( "��ֵ�����ɳɹ�", "admin_card.php" );
		break;
case "edit" :
		edit( );
		break;
case "sedit" :
		sedit( );
		addlog( "��ֵ���޸ĳɹ�" );
		showerr( "��ֵ���޸ĳɹ�", "admin_card.php" );
		break;
case "del" :
		del( );
		addlog( "��ֵ��ɾ���ɹ�" );
		showerr( "��ֵ��ɾ���ɹ�", $_SERVER['HTTP_REFERER'] );
		break;
default :
		main( );
}
echo "</BODY></HTML>\r\n";
?>
