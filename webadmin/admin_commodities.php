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
		$db->query( "INSERT INTO ".$web_dbtop."commodities (typeid,name,price,link,pic,points,discount,hot,tj,shoptype,content) VALUES ({$_POST['typeid']},'{$_POST['name']}',{$_POST['price']},'{$_POST['link']}','{$_POST['pic']}',{$_POST['points']},".intval( $_POST['discount'] ).",".intval( $_POST['hot'] ).",".intval( $_POST['tj'] ).(",".$_POST['shoptype'].",'{$_POST['content']}')" ) );
}

function sedit( )
{
		global $db;
		global $web_dbtop;
		$sql = "update ".$web_dbtop."commodities set typeid={$_POST['typeid']},name='{$_POST['name']}',price={$_POST['price']},link='{$_POST['link']}',pic='{$_POST['pic']}',points={$_POST['points']},discount=".intval( $_POST['discount'] ).",autocard=".intval( $_POST['autocard'] ).( ",cardtype=".$_POST['cardtype'].",shoptype={$_POST['shoptype']},hot=" ).intval( $_POST['hot'] ).",tj=".intval( $_POST['tj'] ).( ",content='".$_POST['content']."' where id={$_POST['id']}" );
		$query = $db->query( $sql );
}

function del( )
{
		global $db;
		global $web_dbtop;
		global $web_picdir;
		if ( isset( $_POST['id'] ) )
		{
				$id = implode( ",", $_POST['id'] );
		}
		else
		{
				$id = $_GET['id'];
		}
		$query = $db->query( "Select pic from ".$web_dbtop."commodities where id in ({$id})" );
		while ( $rs = $db->fetch_array( $query ) )
		{
				deletefile( "../".$web_picdir.$rs['pic'] );
		}
		$db->query( "delete from ".$web_dbtop."commodities where id in ({$id})" );
}

function main( )
{
		global $db;
		global $web_dbtop;
		global $web_moneyname;
		echo "<TABLE width=\"96%\" border=0 align=center cellpadding=0 cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n  <TBODY>\r\n    <TR>\r\n      <TD bgColor=#f5fafe><table width=\"96%\" border=\"0\" align=\"center\" cellpadding=\"3\" cellspacing=\"1\">\r\n          <tr>\r\n            <form action=\"admin_commodities.php\" method=\"get\">\r\n              <td width=\"12%\"><strong>������Ʒ��</strong></td>\r\n              <td width=\"21%\"><input id=keyword size=20 name=keyword></td>\r\n              <td width=\"5%\" align=\"center\"><INPUT class=inputbut type=submit value=���� name=Submit></td>\r\n\t\t    </form>\r\n              <td width=\"12%\" align=\"center\"><STRONG>�����ѯ</STRONG>��</td>\r\n              <td width=\"15%\" align=\"center\">\r\n\t\t\t  <select onchange=\"javascript:window.location.href=this.options[this.selectedIndex].value\">\r\n    \t\t  <option value=\"admin_commodities.php\">ȫ����Ʒ</option>\r\n\t\t\t  ";
		selecturl( $_GET['typeid'] );
		echo "\t\t\t  </select>\r\n\t\t\t  </td>\r\n            <td width=\"12%\"><STRONG>�鿴��ʽ</STRONG>��</td>\r\n            <td><A href=\"admin_commodities.php?sorting=id\">ID</A> | <A href=\"admin_commodities.php?sorting=points\">";
		echo $web_moneyname;
		echo "</A> | <A href=\"admin_commodities.php?sorting=convertnum\">�һ�����</A></td>\r\n          </tr>\r\n      </table></TD>\r\n    </TR>\r\n  </TBODY>\r\n</TABLE>\r\n<TABLE width=\"96%\" border=0 align=center cellpadding=\"5\" cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n<form action=\"\" name=\"form\" method=\"post\">\r\n  <TBODY>\r\n    <TR bgColor=\"#f5fafe\">\r\n      <TD width=\"4%\">&nbsp;</TD>\r\n      <TD align=\"center\">����</TD>\r\n\t  <TD width=\"15%\" align=\"center\">����</TD>\r\n      <TD width=\"15%\" align=\"center\">��Ʒ�۸�</TD>\r\n      <TD width=\"15%\" align=\"center\">";
		echo $web_moneyname;
		echo "</TD>\r\n      <TD width=\"8%\" align=\"center\">�һ�����</TD>\r\n      <TD width=\"15%\" align=\"center\">����</TD>\r\n    </TR>\r\n\t";
		$intpage = 20;
		if ( isset( $_GET['page'] ) )
		{
				$rsnum = ( $_GET['page'] - 1 ) * $intpage;
		}
		else
		{
				$rsnum = 0;
		}
		$sorting = $_REQUEST['sorting'] ? ( $sorting = $_REQUEST['sorting'] ) : "id";
		$sql = "Select * from ".$web_dbtop."commodities";
		if ( $_REQUEST['keyword'] )
		{
				$sql .= " where name like '%".trim( $_REQUEST['keyword'] )."%'";
		}
		if ( $_GET['typeid'] )
		{
				$sql .= " where typeid = ".$_GET['typeid']."";
		}
		$sql .= " Order by ".$sorting." desc";
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
				echo $rs['name'];
				if ( $rs['discount'] == 1 )
				{
						echo "<IMG src=\"images/z.gif\">";
				}
				echo "</TD>\r\n\t  <TD align=\"center\">";
				echo showcontent( "ctype", "name", $rs['typeid'] );
				echo "</TD>\r\n      <TD align=\"center\">";
				echo $rs['price'];
				echo " Ԫ</TD>\r\n      <TD align=\"center\">";
				echo number_format( $rs['points'] );
				echo "<IMG height=10 alt=";
				echo $web_moneyname;
				echo " src=\"images/jd0.gif\" width=10></TD>\r\n      <TD align=\"center\">";
				echo $rs['convertnum'];
				echo "</TD>\r\n      <TD align=\"center\"><A href=\"admin_commodities.php?action=edit&id=";
				echo $rs['id'];
				echo "\">�޸�</a> | <A href=\"admin_commodities.php?action=del&id=";
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
		global $db;
		global $web_dbtop;
		global $web_picdir;
		echo "<TABLE width=\"96%\" border=0 align=center cellpadding=\"4\" cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n<form action=\"?action=sadd\" method=\"post\" onSubmit=\"return Validator.Validate(this,3)\">\r\n  <TBODY>\r\n    <TR>\r\n      <TD vAlign=center width=\"20%\" bgColor=#f5fafe>��Ʒ���ࣺ</TD>\r\n      <TD bgColor=#ffffff><select name=\"typeid\" id=\"typeid\">";
		echo showtype( 0, "" );
		echo "</select></TD>\r\n    </TR>\r\n    <TR>\r\n      <TD vAlign=center width=\"20%\" bgColor=#f5fafe>��Ʒ���ƣ�</TD>\r\n      <TD bgColor=#ffffff><INPUT id=\"name\" size=50 name=\"name\" dataType=\"Require\" msg=\"��Ʒ���Ʋ���Ϊ��\"></TD>\r\n    </TR>\r\n    <TR>\r\n      <TD bgColor=#f5fafe>��Ʒ�۸�</TD>\r\n      <TD bgColor=#ffffff><INPUT id=\"price\" size=50 name=\"price\" dataType=\"Double\" msg=\"�۸�ֻ�������ָ�ʽ\"></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>��Ʒ���ӣ�</TD>\r\n      <TD bgColor=#ffffff><INPUT id=\"link\" size=50 name=\"link\"> ��¼��Ʒ���Ա������ĵ����ӷ��㷢��</TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>�Զ�������</TD>\r\n      <TD bgColor=#ffffff><input name=\"autocard\" type=\"checkbox\" value=\"1\"></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>��Ӧ�����ͣ�</TD>\r\n      <TD bgColor=#ffffff><select name=\"cardtype\">\r\n\t\t\t  ";
		$query = $db->query( "Select * from ".$web_dbtop."cardtype Order by id desc" );
		while ( $rs = $db->fetch_array( $query ) )
		{
				echo "<option value=\"".$rs['id']."\">".$rs['cardname']."</option>";
		}
		echo "\t\t\t  </select></TD>\r\n\t</TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>���۽�Ʒ��</TD>\r\n      <TD bgColor=#ffffff><input name=\"discount\" type=\"checkbox\" value=\"1\"></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>�������ͣ�</TD>\r\n      <TD bgColor=#ffffff><select name=\"shoptype\">\r\n        <option value=\"0\">���⿨</option>\r\n        <option value=\"1\">ʵ��</option>\r\n      </select></TD>\r\n\t</TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>��ƷͼƬ��</TD>\r\n      <TD bgColor=#ffffff><INPUT id=\"pic\" size=50 name=\"pic\" dataType=\"Require\" msg=\"ͼƬ����Ϊ��\"></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>ͼƬ�ϴ���</TD>\r\n      <TD bgColor=#ffffff><iframe src=\"inc/upadpic.php?urldir=";
		echo $web_picdir;
		echo "&picname=pic\" width=\"600\" height=\"25\" frameborder=\"0\" scrolling=\"no\"></iframe></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>�һ�";
		echo $web_moneyname;
		echo "��</TD>\r\n      <TD bgColor=#ffffff><input name=\"points\" id=\"points\" size=\"50\" ataType=\"Integer\" msg=\"";
		echo $web_moneyname;
		//echo "ֻ�������ָ�ʽ\"></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>��Ʒ���ԣ�</TD>\r\n      <TD bgColor=#ffffff><input name=\"tj\" type=\"checkbox\" value=\"1\">\r\n      �����Ƽ�\r\n        <input name=\"hot\" type=\"checkbox\" value=\"1\">\r\n        ������Ʒ</TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>��Ʒ���ܣ�</TD>\r\n      <TD bgColor=#ffffff><textarea name=\"content\" style=\"display:none\"></textarea>\r\n  <iframe ID=\"Editor\" name=\"Editor\" src=\"editor/index.html?ID=content\" frameBorder=\"0\" marginHeight=\"0\" marginWidth=\"0\" scrolling=\"No\" style=\"height:320px;width:100%\"></iframe></TD>\r\n    </TR>\r\n    <TR align=\"center\" bgcolor=\"#f8fbfb\">\r\n      <TD colspan=\"2\"><INPUT class=inputbut type=submit value=��� name=Submit></TD>\r\n    </TR>\r\n  </TBODY>\r\n  </form>\r\n</TABLE>\r\n";
		echo "ֻ�������ָ�ʽ\"></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>��Ʒ���ԣ�</TD>\r\n      <TD bgColor=#ffffff><input name=\"tj\" type=\"checkbox\" value=\"1\">\r\n      �����Ƽ�\r\n        <input name=\"hot\" type=\"checkbox\" value=\"1\">\r\n        ������Ʒ</TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>��Ʒ���ܣ�</TD>\r\n      <TD bgColor=#ffffff><textarea name=\"content\" style=\"display:none\"></textarea>\r\n <script type=\"text/javascript\">CKEDITOR.replace('content');</script></TD>\r\n    </TR>\r\n    <TR align=\"center\" bgcolor=\"#f8fbfb\">\r\n      <TD colspan=\"2\"><INPUT class=inputbut type=submit value=��� name=Submit></TD>\r\n    </TR>\r\n  </TBODY>\r\n  </form>\r\n</TABLE>\r\n";
}

function edit( )
{
		global $db;
		global $web_dbtop;
		global $web_picdir;
		global $web_moneyname;
		$query = $db->query( "Select * from ".$web_dbtop."commodities where id={$_GET['id']}" );
		if ( $rs = $db->fetch_array( $query ) )
		{
				echo "<TABLE width=\"96%\" border=0 align=center cellpadding=\"4\" cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n<form action=\"?action=sedit\" method=\"post\" onSubmit=\"return Validator.Validate(this,3)\">\r\n<input name=\"id\" type=\"hidden\" value=\"";
				echo $rs['id'];
				echo "\">\r\n  <TBODY>\r\n   <TR>\r\n      <TD vAlign=center width=\"20%\" bgColor=#f5fafe>��Ʒ���ࣺ</TD>\r\n      <TD bgColor=#ffffff><select name=\"typeid\" id=\"typeid\">";
				echo showtype( 0, $rs['typeid'] );
				echo "</select></TD>\r\n    </TR>\r\n    <TR>\r\n      <TD bgColor=#f5fafe>��Ʒ���ƣ�</TD>\r\n      <TD bgColor=#ffffff><INPUT id=\"name\" size=50 value=\"";
				echo $rs['name'];
				echo "\" name=\"name\" dataType=\"Require\" msg=\"��Ʒ���Ʋ���Ϊ��\"></TD>\r\n    </TR>\r\n    <TR>\r\n      <TD bgColor=#f5fafe>��Ʒ�۸�</TD>\r\n      <TD bgColor=#ffffff><INPUT id=\"price\" size=50 value=\"";
				echo $rs['price'];
				echo "\" name=\"price\" dataType=\"Double\" msg=\"�۸�ֻ�������ָ�ʽ\"></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>��Ʒ���ӣ�</TD>\r\n      <TD bgColor=#ffffff><INPUT id=\"link\" size=50 name=\"link\" value=\"";
				echo $rs['link'];
				echo "\"> ��¼��Ʒ���Ա������ĵ����ӷ��㷢��</TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>�Զ�������</TD>\r\n      <TD bgColor=#ffffff><input name=\"autocard\" type=\"checkbox\" value=\"1\" ";
				if ( $rs['autocard'] == 1 )
				{
						echo "checked";
				}
				echo "></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>��Ӧ�����ͣ�</TD>\r\n      <TD bgColor=#ffffff><select name=\"cardtype\">\r\n\t\t\t  ";
				$query = $db->query( "Select * from ".$web_dbtop."cardtype Order by id desc" );
				while ( $rs_f = $db->fetch_array( $query ) )
				{
						echo "<option value=\"".$rs_f['id']."\" ".( $rs_f['id'] == $rs['cardtype'] ? "selected" : "" ).">".$rs_f['cardname']."</option>";
				}
				echo "\t\t\t  </select></TD>\r\n\t</TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>���۽�Ʒ��</TD>\r\n      <TD bgColor=#ffffff><input name=\"discount\" type=\"checkbox\" value=\"1\" ";
				if ( $rs['discount'] == 1 )
				{
						echo "checked";
				}
				echo "></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>�������ͣ�</TD>\r\n      <TD bgColor=#ffffff><select name=\"shoptype\">\r\n        <option value=\"0\" ";
				if ( $rs['shoptype'] == 0 )
				{
						echo "selected";
				}
				echo ">���⿨</option>\r\n        <option value=\"1\" ";
				if ( $rs['shoptype'] == 1 )
				{
						echo "selected";
				}
				echo ">ʵ��</option>\r\n      </select></TD>\r\n\t</TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>��ƷͼƬ��</TD>\r\n      <TD bgColor=#ffffff><INPUT id=\"pic\" size=50 value=\"";
				echo $rs['pic'];
				echo "\" name=\"pic\" dataType=\"Require\" msg=\"ͼƬ����Ϊ��\"></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>ͼƬ�ϴ���</TD>\r\n      <TD bgColor=#ffffff><iframe src=\"inc/upadpic.php?urldir=";
				echo $web_picdir;
				echo "&picname=pic\" width=\"600\" height=\"25\" frameborder=\"0\" scrolling=\"no\"></iframe></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>�һ�";
				echo $web_moneyname;
				echo "��</TD>\r\n      <TD bgColor=#ffffff><input name=\"points\" id=\"points\" value=\"";
				echo $rs['points'];
				echo "\" size=\"50\" ataType=\"Integer\" msg=\"";
				echo $web_moneyname;
				echo "ֻ�������ָ�ʽ\"></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>��Ʒ���ԣ�</TD>\r\n      <TD bgColor=#ffffff><input name=\"tj\" type=\"checkbox\" value=\"1\" ";
				if ( $rs['tj'] == 1 )
				{
						echo "checked";
				}
				echo ">\r\n      �����Ƽ�\r\n        <input name=\"hot\" type=\"checkbox\" value=\"1\" ";
				if ( $rs['hot'] == 1 )
				{
						echo "checked";
				}
				echo ">\r\n        ������Ʒ</TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>��Ʒ���ܣ�</TD>\r\n      <TD bgColor=#ffffff><textarea name=\"content\" style=\"display:none\">";
				echo $rs['content'];
				//echo "</textarea>\r\n  <iframe ID=\"Editor\" name=\"Editor\" src=\"editor/index.html?ID=content\" frameBorder=\"0\" marginHeight=\"0\" marginWidth=\"0\" scrolling=\"No\" style=\"height:320px;width:100%\"></iframe></TD>\r\n    </TR>\r\n    <TR align=\"center\" bgcolor=\"#f8fbfb\">\r\n      <TD colspan=\"2\"><INPUT class=inputbut type=submit value=�޸� name=Submit>\r\n      &nbsp;</TD>\r\n    </TR>\r\n  </TBODY>\r\n  </form>\r\n</TABLE>\r\n<script language=\"javascript\" src=\"inc/js.js\"></script>\r\n";
				echo "</textarea>\r\n <script type=\"text/javascript\">CKEDITOR.replace('content');</script></TD>\r\n    </TR>\r\n    <TR align=\"center\" bgcolor=\"#f8fbfb\">\r\n      <TD colspan=\"2\"><INPUT class=inputbut type=submit value=�޸� name=Submit>\r\n      &nbsp;</TD>\r\n    </TR>\r\n  </TBODY>\r\n  </form>\r\n</TABLE>\r\n<script language=\"javascript\" src=\"inc/js.js\"></script>\r\n";
		}
}

include_once( dirname( __FILE__ )."/../inc/conn.php" );
include_once( dirname( __FILE__ )."/inc/function.php" );
login_check( "djgl" );
echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd\">\r\n<HTML xmlns=\"http://www.w3.org/1999/xhtml\">\r\n<HEAD>\r\n<TITLE>��Ʒ����--�׷������Ϸϵͳ</TITLE>\r\n<META http-equiv=Content-Type content=\"text/html; charset=gb2312\">\r\n<LINK href=\"images/css_body.css\" type=text/css rel=stylesheet>\r\n<META content=\"MSHTML 6.00.3790.4275\" name=GENERATOR>\r\n<script type=\"text/javascript\" src=\"../ckeditor/ckeditor.js\"></script>\r\n</HEAD>\r\n<BODY>\r\n<DIV class=bodytitle>\r\n<DIV class=bodytitleleft></DIV>\r\n<DIV class=bodytitletxt>��Ʒ����</DIV>\r\n<DIV class=bodytitletxt2><a href=\"admin_commodities.php?action=add\">��ӽ�Ʒ</a></DIV>\r\n</DIV>\r\n";
switch ( $_GET['action'] )
{
case "add" :
		add( );
		break;
case "sadd" :
		sadd( );
		addlog( "��ӽ�Ʒ" );
		showerr( "��Ʒ��ӳɹ�", "admin_commodities.php" );
		break;
case "edit" :
		edit( );
		break;
case "sedit" :
		sedit( );
		addlog( "��Ʒ�޸ĳɹ�" );
		showerr( "��Ʒ�޸ĳɹ�", "admin_commodities.php" );
		break;
case "del" :
		del( );
		addlog( "��Ʒɾ���ɹ�" );
		showerr( "��Ʒɾ���ɹ�", "admin_commodities.php" );
		break;
default :
		main( );
}
echo "</BODY></HTML>\r\n";
?>
