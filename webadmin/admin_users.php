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
		global $web_headdir;
		$str = "card_".intval( $_COOKIE['usersid'] );
		if ( $_FILES['UserPhoto']['name'] != "" )
		{
				$tmp_file = $_FILES['UserPhoto']['tmp_name'];
				$file_types = explode( ".", $_FILES['UserPhoto']['name'] );
				$file_type = $file_types[count( $file_types ) - 1];
				if ( strtolower( $file_type ) != "jpg" & strtolower( $file_type ) != "gif" & strtolower( $file_type ) != "bmp" & strtolower( $file_type ) != "png" )
				{
						echo "<script language=javascript>alert('��ʽ����������ѡ��ͼƬ��');history.go(-1);</script>";
						exit( );
				}
				$file_name = $str.".".$file_type;
				if ( !copy( $tmp_file, "../".$web_headdir.$file_name ) )
				{
						echo "<script language=javascript>alert('�ϴ����������ԣ���');history.go(-1);</script>";
						exit( );
				}
		}
		if ( $_FILES['UserPhoto']['name'] != "" )
		{
				$UserPhoto = $web_headdir.$file_name;
		}
		else
		{
				$UserPhoto = $_POST['SysPhoto'];
		}
		if ( $_POST['UserInterested'] )
		{
				$UserInterested = implode( ",", $_POST['UserInterested'] );
		}
		$sql = "update ".$web_dbtop."users set id={$_POST['gid']},email='{$_POST['email']}',name='{$_POST['UserNick']}',";
		if ( $_POST['password'] )
		{
				$sql .= "password='".md5( $_POST['password'] )."',";
		}
		$sql .= "vip=".intval( $_POST['vip'] ).",vipdate='".$_POST['vipdate'].( "',points=".$_POST['points'].",back={$_POST['back']},experience={$_POST['experience']},maxexperience={$_POST['maxexperience']},secques='{$_POST['UserSecQues']}',secans='{$_POST['UserSecAns']}'\r\n\t,sex='{$_POST['UserGender']}',head='{$UserPhoto}',qq='{$_POST['UserQQ']}',birthday='{$_POST['BirthYear']}-{$_POST['BirthMonth']}-{$_POST['BirthDay']}'\r\n\t,tel='{$_POST['UserPhone']}',address='{$_POST['UserPro']}-{$_POST['UserCity']}-{$_POST['UserAddr']}',education='{$_POST['UserQualifications']}',job='{$_POST['UserJob']}',bent='{$UserInterested}',caption='{$_POST['UserDescription']}',tjid={$_POST['tjid']} where id={$_POST['id']}" );
		$query = $db->query( $sql );
}

function dellogin( )
{
		global $db;
		global $web_dbtop;
		$db->query( "delete from ".$web_dbtop."users where vip=0 and logintime < date_add(curdate(),INTERVAL -2 month)" );
}

function jd( )
{
		global $db;
		global $web_dbtop;
		$db->query( "update ".$web_dbtop."users set dj=0,djly=NULL where id={$_GET['id']}" );
}

function isbz( $isbz )
{
		global $db;
		global $web_dbtop;
		$db->query( "update ".$web_dbtop."users set isbz=".$isbz." where id={$_GET['id']}" );
}

function djcz( )
{
		global $db;
		global $web_dbtop;
		$db->query( "update ".$web_dbtop."users set dj=1,djly='".$_POST['djly'].( "' where id in (".$_POST['id'].")" ) );
		$db->query( "delete from ".$web_dbtop."game16_auto where uid in ({$_POST['id']})" );
		$db->query( "delete from ".$web_dbtop."game28_auto where uid in ({$_POST['id']})" );
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
		$query = $db->query( "Select id,head,cardpic from ".$web_dbtop."users where id in ({$id})" );
		while ( $rs = $db->fetch_array( $query ) )
		{
				if ( stristr( $rs['head'], "userspic/head/" ) )
				{
						deletefile( "../".$rs['head'] );
				}
				deletefile( "../".$rs['cardpic'] );
		}
		$db->query( "delete from ".$web_dbtop."users where id in ({$id})" );
		$db->query( "delete from ".$web_dbtop."adip where uid in ({$id})" );
		$db->query( "delete from ".$web_dbtop."adlogusers where uid in ({$id})" );
		$db->query( "delete from ".$web_dbtop."advice where usersid in ({$id})" );
		$db->query( "delete from ".$web_dbtop."backlog where usersid in ({$id})" );
		$db->query( "delete from ".$web_dbtop."bbs_posts where uid in ({$id})" );
		$db->query( "delete from ".$web_dbtop."bbs_reply where uid in ({$id})" );
		$db->query( "delete from ".$web_dbtop."business where uid in ({$id})" );
		$db->query( "delete from ".$web_dbtop."card where uid in ({$id})" );
		$db->query( "delete from ".$web_dbtop."exchange where uid in ({$id})" );
		$db->query( "delete from ".$web_dbtop."game_log where uid in ({$id})" );
		$db->query( "delete from ".$web_dbtop."game11_auto where uid in ({$id})" );
		$db->query( "delete from ".$web_dbtop."game11_auto_tz where uid in ({$id})" );
		$db->query( "delete from ".$web_dbtop."game11_users_tz where uid in ({$id})" );
		$db->query( "delete from ".$web_dbtop."game16_auto where uid in ({$id})" );
		$db->query( "delete from ".$web_dbtop."game16_auto_tz where uid in ({$id})" );
		$db->query( "delete from ".$web_dbtop."game16_users_tz where uid in ({$id})" );
		$db->query( "delete from ".$web_dbtop."game28_auto where uid in ({$id})" );
		$db->query( "delete from ".$web_dbtop."game28_auto_tz where uid in ({$id})" );
		$db->query( "delete from ".$web_dbtop."game28_users_tz where uid in ({$id})" );
		$db->query( "delete from ".$web_dbtop."gamebox_log where uid in ({$id})" );
		$db->query( "delete from ".$web_dbtop."gamedodge where uid in ({$id})" );
		$db->query( "delete from ".$web_dbtop."msg where usersid in ({$id})" );
		$db->query( "delete from ".$web_dbtop."userslog where usersid in ({$id})" );
		$db->query( "delete from ".$web_dbtop."webip where uid in ({$id})" );
		$db->query( "delete from ".$web_dbtop."tjlog where uid in ({$id})" );
}

function main( )
{
		global $db;
		global $web_dbtop;
		global $web_moneyname;
		echo "<TABLE width=\"96%\" border=0 align=center cellpadding=0 cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n  <TBODY>\r\n    <TR>\r\n      <TD bgColor=#f5fafe><table width=\"96%\" border=\"0\" align=\"center\" cellpadding=\"3\" cellspacing=\"1\">\r\n          <tr>\r\n            <form action=\"admin_users.php\" method=\"get\">\r\n              <td width=\"10%\"><strong>�����û���</strong></td>\r\n              <td width=\"21%\"><input id=keyword size=20 name=keyword></td>\r\n              <td width=\"10%\" align=\"center\"><INPUT class=inputbut type=submit value=���� name=Submit></td>\r\n            </form>\r\n            <td width=\"10%\"><STRONG>�鿴��ʽ</STRONG>��</td>\r\n            <td width=\"35%\"><A href=\"admin_users.php?sorting=vip\">VIP</a> | <A href=\"admin_users.php?sorting=time\">ע��ʱ��</A> | <A href=\"admin_users.php?sorting=points\">";
		echo $web_moneyname;
		echo "</A> | <A href=\"admin_users.php?sorting=loginip\">IP</a> | <A href=\"admin_users.php?sorting=djpoints\">�ҽ�</a> | <A href=\"admin_usersyc.php\">����쳣�ʻ�</a></td>\r\n          </tr>\r\n      </table></TD>\r\n    </TR>\r\n  </TBODY>\r\n</TABLE>\r\n<TABLE width=\"96%\" border=0 align=center cellpadding=\"5\" cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n<form name=\"form\" method=\"post\">\r\n  <TBODY>\r\n    <TR bgColor=\"#f5fafe\">\r\n      <TD width=\"4%\">&nbsp;</TD>\r\n\t  <TD align=\"center\">�û�ID</TD>\r\n      <TD width=\"17%\" align=\"center\">�û�E-mail</TD>\r\n      <TD width=\"10%\" align=\"center\">";
		echo $web_moneyname;
		echo "</TD>\r\n\t  <TD width=\"10%\" align=\"center\">����</TD>\r\n      <TD width=\"6%\" align=\"center\">�ҽ���</TD>\r\n      <TD width=\"13%\" align=\"center\">��½IP</TD>\r\n      <TD width=\"17%\" align=\"center\">����</TD>\r\n    </TR>\r\n\t";
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
		$sql = "Select * from ".$web_dbtop."users";
		if ( $_REQUEST['keyword'] )
		{
				$sql .= " where id=".intval( $_REQUEST['keyword'] )." or name like '%".trim( $_REQUEST['keyword'] )."%' or loginip like '%".trim( $_REQUEST['keyword'] )."%' or email like '%".trim( $_REQUEST['keyword'] )."%'";
		}
		if ( $sorting == "points" )
		{
				$sorting = "points+back";
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
				echo "\"></TD>\r\n      <TD>";
				echo $rs['id'];
				if ( $rs['vip'] == 1 )
				{
						echo "<img src=\"../images/vip.gif\" />";
				}
				echo " ";
				showstars( userslive( $rs['maxexperience'] ) );
				echo " ";
				echo $rs['authentication'] == 1 ? "<a href=\"#\" onclick=\"AddWin('W_SFYZ_".$rs['id']."','�û� ".$rs['id']." �����֤�鿴','admin_authentication.php?action=look&id=".$rs['id']."',550,320,0);return false\"><img src=\"images/CreateTableTemplatesGallery.gif\" width=\"16\" height=\"16\"></a>" : "";
				echo " <a href=\"#\" onclick=\"AddWin('W_HD_";
				echo $rs['id'];
				echo "','�û� ";
				echo $rs['id'];
				echo " ���ݺ˶�','admin_usersdz.php?id=";
				echo $rs['id'];
				echo "',480,340,0);return false\"><img src=\"images/CreateFormMoreFormsGallery.gif\" width=\"16\" height=\"16\"></a> <a href=\"#\" onclick=\"AddWin('W_SMS_";
				echo $rs['uid'];
				echo "','�û� ";
				echo $rs['uid'];
				echo " ����֪ͨ','admin_sms.php?action=sms&uid=";
				echo $rs['uid'];
				echo "',480,220,0);return false\"><img src=\"images/sms.gif\" width=\"16\" height=\"16\"></a></TD>\r\n\t  <TD align=\"center\">";
				echo $rs['email'];
				echo "</TD>\r\n      <TD align=\"center\">";
				echo number_format( $rs['points'] );
				echo "</TD>\r\n\t  <TD align=\"center\">";
				echo number_format( $rs['back'] );
				echo "</TD>\r\n      <TD align=\"center\">";
				echo $rs['djcs'];
				echo "</TD>\r\n      <TD align=\"center\">";
				echo $rs['loginip'];
				echo "</TD>\r\n      <TD align=\"center\"><A href=\"admin_users.php?action=edit&id=";
				echo $rs['id'];
				echo "\">�޸�</a> | ";
				if ( $rs['dj'] == 1 )
				{
						echo "<A href=\"admin_users.php?action=jd&id=";
						echo $rs['id'];
						echo "\" onClick=\"return confirm('ȷ��Ҫ�ⶳ��?');\">�ⶳ</a>";
				}
				else
				{
						echo "<A href=\"admin_users.php?action=dj&id=";
						echo $rs['id'];
						echo "\" onClick=\"return confirm('ȷ��Ҫ������?');\">����</a>";
				}
				
				if ( $rs['isbz'] == 1 )
				{
						echo " | <A href=\"admin_users.php?action=isbz&isbz=0&id=";
						echo $rs['id'];
						echo "\" onClick=\"return confirm('ȷ��Ҫȡ���ð�����?');\"><b>�ǰ���</b></a>";
				}
				else
				{
						echo " | <A href=\"admin_users.php?action=isbz&isbz=1&id=";
						echo $rs['id'];
						echo "\" onClick=\"return confirm('ȷ��Ҫ���øð�����?');\">�ǰ���</a>";
				}
				echo " | <A href=\"admin_users.php?action=del&id=";
				echo $rs['id'];
				echo "\">ɾ��</a></TD>\r\n    </TR>\r\n\t";
		}
		echo "    <TR bgcolor=\"#f8fbfb\">\r\n      <TD align=\"center\"><input name=\"chkall\" type=\"checkbox\" id=\"chkall\" value=\"checkbox\" onClick=\"CheckAll(document.form.chkall.checked);\"/></TD>\r\n      <TD colspan=\"7\"><input type=\"button\" name=\"del\" value=\"��������\"  onClick=\"document.form.action='?action=dj';{if(chkCheckBoxChs('id[]')==false){alert('������ѡ��һ���û���');return;}};{if(confirm('ȷ����������ѡ����û���')){this.document.form.submit();return true;}}\" class=inputbut> <input type=\"button\" name=\"del\" value=\"����ɾ��\"  onClick=\"document.form.action='?action=del';{if(chkCheckBoxChs('id[]')==false){alert('������ѡ��һ���û���');return;}};{if(confirm('ȷ��ɾ������ѡ����û���')){this.document.form.submit();return true;}}\" class=inputbut></TD>\r\n    </TR>\r\n    <TR bgcolor=\"#f8fbfb\">\r\n      <TD colspan=\"8\" align=\"center\">";
		include_once( dirname( __FILE__ )."/../inc/page_class.php" );
		$page = new page( array(
				"total" => $intnum,
				"perpage" => $intpage
		) );
		echo $page->show( 4, "page", "curr" );
		echo "</TD>\r\n    </TR>\r\n  </TBODY>\r\n  </form>\r\n</TABLE>\r\n<script language=\"javascript\" src=\"inc/movie.js\"></script>\r\n<script language=\"javascript\" src=\"inc/QJ_Display.js\"></script>\r\n";
}

function edit( )
{
		global $db;
		global $web_dbtop;
		global $web_moneyname;
		$query = $db->query( "Select * from ".$web_dbtop."users where id={$_GET['id']}" );
		if ( $rs = $db->fetch_array( $query ) )
		{
				$birthday = explode( "-", $rs['birthday'] );
				$address = explode( "-", $rs['address'] );
				echo "<script type=\"text/javascript\" src=\"../inc/area.js\"></script>\r\n<TABLE width=\"96%\" border=0 align=center cellpadding=\"4\" cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n<form action=\"?action=sedit&url=";
				echo urlencode( $_SERVER['HTTP_REFERER'] );
				echo "\" method=\"post\" enctype=\"multipart/form-data\" onSubmit=\"return Validator.Validate(this,3)\">\r\n<input name=\"id\" type=\"hidden\" value=\"";
				echo $rs['id'];
				echo "\">\r\n  <TBODY>\r\n    <TR>\r\n      <TD vAlign=center width=\"20%\" bgColor=#f5fafe>�û�ID��</TD>\r\n      <TD bgColor=#ffffff><INPUT id=\"gid\" size=50 value=\"";
				echo $rs['id'];
				echo "\" name=\"gid\" dataType=\"Integer\"  msg=\"�û�ID��ʽ����ȷ\"></TD>\r\n    </TR>\r\n    <TR>\r\n      <TD vAlign=center width=\"20%\" bgColor=#f5fafe>�û�E-mail��</TD>\r\n      <TD bgColor=#ffffff><INPUT id=\"email\" size=50 value=\"";
				echo $rs['email'];
				echo "\" name=\"email\" dataType=\"Email\"  msg=\"�û�E-mail��ʽ����ȷ\"></TD>\r\n    </TR>\r\n    <TR>\r\n      <TD bgColor=#f5fafe>���룺</TD>\r\n      <TD bgColor=#ffffff><INPUT id=\"password\" size=50 value=\"\" name=\"password\"></TD>\r\n    </TR>\r\n    <TR>\r\n      <TD bgColor=#f5fafe>ע��ʱ�䣺</TD>\r\n      <TD bgColor=#ffffff>";
				echo $rs['time'];
				echo "</TD>\r\n    </TR>\r\n    <TR>\r\n      <TD bgColor=#f5fafe>����½ʱ�䣺</TD>\r\n      <TD bgColor=#ffffff>";
				echo $rs['logintime'];
				echo "</TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>VIP�û���</TD>\r\n      <TD bgColor=#ffffff><input name=\"vip\" type=\"checkbox\" value=\"1\" ";
				if ( $rs['vip'] == 1 )
				{
						echo "checked";
				}
				echo "></TD>\r\n\t</TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>VIP����ʱ�䣺</TD>\r\n      <TD bgColor=#ffffff><input name=\"vipdate\" type=\"text\" size=\"12\" maxlength=\"10\"  onfocus=setday(this) readOnly value=\"";
				echo $rs['vipdate'];
				echo "\" /></TD>\r\n\t</TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>�û�";
				echo $web_moneyname;
				echo "��</TD>\r\n      <TD bgColor=#ffffff><input name=\"points\" id=\"points\" value=\"";
				echo $rs['points'];
				echo "\" size=\"25\" ataType=\"Integer\" msg=\"����ֻ�������ָ�ʽ\"></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>";
				echo $web_moneyname;
				echo "���У�</TD>\r\n      <TD bgColor=#ffffff><input name=\"back\" id=\"back\" value=\"";
				echo $rs['back'];
				echo "\" size=\"25\" ataType=\"Integer\" msg=\"";
				echo $web_moneyname;
				echo "����ֻ�������ָ�ʽ\"></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>�û����飺</TD>\r\n      <TD bgColor=#ffffff><input name=\"experience\" id=\"experience\" value=\"";
				echo $rs['experience'];
				echo "\" size=\"25\" ataType=\"Integer\" msg=\"����ֻ�������ָ�ʽ\"></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>�ۼƾ��飺</TD>\r\n      <TD bgColor=#ffffff><input name=\"maxexperience\" id=\"maxexperience\" value=\"";
				echo $rs['maxexperience'];
				echo "\" size=\"25\" ataType=\"Integer\" msg=\"�ۼƾ���ֻ�������ָ�ʽ\"></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>����ID��</TD>\r\n      <TD bgColor=#ffffff><input name=\"tjid\" id=\"tjid\" value=\"";
				echo $rs['tjid'];
				echo "\" size=\"25\" ataType=\"Integer\" msg=\"����IDֻ�������ָ�ʽ\"></TD>\r\n    </TR>\r\n    <TR>\r\n      <TD bgColor=#f5fafe>��ȫ���ʣ�</TD>\r\n      <TD bgColor=#ffffff><select id=\"UserSecQues\" name=\"UserSecQues\" ataType=\"Require\" msg=\"��ѡ��ȫ����\">\r\n        <option value=\"what is the name of your first school?\" ";
				if ( $rs['secques'] == "what is the name of your first school?" )
				{
						echo "selected=\"selected\"";
				}
				echo ">what is the name of your first school?</option>\r\n        <option value=\"what is the name of your favourite pet?\" ";
				if ( $rs['secques'] == "what is the name of your favourite pet?" )
				{
						echo "selected=\"selected\"";
				}
				echo ">what is the name of your favourite pet?</option>\r\n        <option value=\"what is the name of your grandpa?\" ";
				if ( $rs['secques'] == "what is the name of your grandpa?" )
				{
						echo "selected=\"selected\"";
				}
				echo ">what is the name of your grandpa?</option>\r\n        <option value=\"what is your favourite sport?\" ";
				if ( $rs['secques'] == "what is your favourite sport?" )
				{
						echo "selected=\"selected\"";
				}
				echo ">what is your favourite sport?</option>\r\n        <option value=\"what is the name of your first company?\" ";
				if ( $rs['secques'] == "what is the name of your first company?" )
				{
						echo "selected=\"selected\"";
				}
				echo ">what is the name of your first company?</option>\r\n        <option value=\"what is the name of the hospital where you were born?\" ";
				if ( $rs['secques'] == "what is the name of the hospital where you were born?" )
				{
						echo "selected=\"selected\"";
				}
				echo ">what is the name of the hospital where you were born?</option>\r\n      </select></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>��ȫ�𰸣�</TD>\r\n      <TD bgColor=#ffffff><input name=\"UserSecAns\" id=\"UserSecAns\" value=\"";
				echo $rs['secans'];
				echo "\" size=\"25\" ataType=\"Require\" msg=\"����д��ȫ��\"></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>�û��ǳƣ�</TD>\r\n      <TD bgColor=#ffffff><input name=\"UserNick\" id=\"UserNick\" value=\"";
				echo $rs['name'];
				echo "\" size=\"25\" ataType=\"Require\" msg=\"����д�û��ǳ�\"></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>�Ա�</TD>\r\n      <TD bgColor=#ffffff><input name=\"UserGender\" type=\"radio\" value=\"M\" checked=\"checked\"  ";
				if ( $rs['sex'] == "M" )
				{
						echo "checked";
				}
				echo "/>\r\n\t\t\t\t\t����\r\n\t\t\t\t\t<input name=\"UserGender\" type=\"radio\" value=\"F\" ";
				if ( $rs['sex'] == "F" )
				{
						echo "checked";
				}
				echo " />\r\n\t\t\t\t\tŮʿ</TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>�Զ���ͷ��</TD>\r\n      <TD bgColor=#ffffff><input type=\"file\" name=\"UserPhoto\" /><img id=\"imgPhoto\" width=\"150\" height=\"150\" src=\"../";
				echo $rs['head'];
				echo "\" onerror=\"this.src='../images/head/1_0.jpg'\" /></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>ϵͳͷ��</TD>\r\n      <TD bgColor=#ffffff><select name=\"SysPhoto\" onchange=\"document.getElementById('imgPhoto').src='../'+this.value;\">\r\n\t\t\t\t\t\t\t\t<option value=\"images/head/1_0.jpg\" ";
				if ( $rs['head'] == "images/head/1_0.jpg" )
				{
						echo "selected";
				}
				echo ">Ĭ����</option>\r\n\t\t\t\t\t\t\t\t<option value=\"images/head/1_1.jpg\" ";
				if ( $rs['head'] == "images/head/1_1.jpg" )
				{
						echo "selected";
				}
				echo ">��һ</option>\r\n\t\t\t\t\t\t\t\t<option value=\"images/head/1_2.jpg\" ";
				if ( $rs['head'] == "images/head/1_2.jpg" )
				{
						echo "selected";
				}
				echo ">�ж�</option>\r\n\t\t\t\t\t\t\t\t<option value=\"images/head/1_3.jpg\" ";
				if ( $rs['head'] == "images/head/1_3.jpg" )
				{
						echo "selected";
				}
				echo ">����</option>\r\n\t\t\t\t\t\t\t\t<option value=\"images/head/1_4.jpg\" ";
				if ( $rs['head'] == "images/head/1_4.jpg" )
				{
						echo "selected";
				}
				echo ">����</option>\r\n\t\t\t\t\t\t\t\t<option value=\"images/head/1_5.jpg\" ";
				if ( $rs['head'] == "images/head/1_5.jpg" )
				{
						echo "selected";
				}
				echo ">����</option>\r\n\t\t\t\t\t\t\t\t<option value=\"images/head/1_6.jpg\" ";
				if ( $rs['head'] == "images/head/1_6.jpg" )
				{
						echo "selected";
				}
				echo ">����</option>\r\n\t\t\t\t\t\t\t\t<option value=\"images/head/1_7.jpg\" ";
				if ( $rs['head'] == "images/head/1_7.jpg" )
				{
						echo "selected";
				}
				echo ">����</option>\r\n\t\t\t\t\t\t\t\t<option value=\"images/head/1_8.jpg\" ";
				if ( $rs['head'] == "images/head/1_8.jpg" )
				{
						echo "selected";
				}
				echo ">�а�</option>\r\n\t\t\t\t\t\t\t\t<option value=\"images/head/0_0.jpg\" ";
				if ( $rs['head'] == "images/head/0_0.jpg" )
				{
						echo "selected";
				}
				echo ">Ĭ��Ů</option>\r\n\t\t\t\t\t\t\t\t<option value=\"images/head/0_1.jpg\" ";
				if ( $rs['head'] == "images/head/0_1.jpg" )
				{
						echo "selected";
				}
				echo ">Ůһ</option>\r\n\t\t\t\t\t\t\t\t<option value=\"images/head/0_2.jpg\" ";
				if ( $rs['head'] == "images/head/0_2.jpg" )
				{
						echo "selected";
				}
				echo ">Ů��</option>\r\n\t\t\t\t\t\t\t\t<option value=\"images/head/0_3.jpg\" ";
				if ( $rs['head'] == "images/head/0_3.jpg" )
				{
						echo "selected";
				}
				echo ">Ů��</option>\r\n\t\t\t\t\t\t\t\t<option value=\"images/head/0_4.jpg\" ";
				if ( $rs['head'] == "images/head/0_4.jpg" )
				{
						echo "selected";
				}
				echo ">Ů��</option>\r\n\t\t\t\t\t\t\t\t<option value=\"images/head/0_5.jpg\" ";
				if ( $rs['head'] == "images/head/0_5.jpg" )
				{
						echo "selected";
				}
				echo ">Ů��</option>\r\n\t\t\t\t\t\t\t\t<option value=\"images/head/0_6.jpg\" ";
				if ( $rs['head'] == "images/head/0_6.jpg" )
				{
						echo "selected";
				}
				echo ">Ů��</option>\r\n\t\t\t\t\t\t\t\t<option value=\"images/head/0_7.jpg\" ";
				if ( $rs['head'] == "images/head/0_7.jpg" )
				{
						echo "selected";
				}
				echo ">Ů��</option>\r\n\t\t\t\t\t\t\t\t<option value=\"images/head/0_8.jpg\" ";
				if ( $rs['head'] == "images/head/0_8.jpg" )
				{
						echo "selected";
				}
				echo ">Ů��</option>\r\n\t\t\t\t\t\t\t\t</select></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>�û�QQ��</TD>\r\n      <TD bgColor=#ffffff><input name=\"UserQQ\" id=\"UserQQ\" value=\"";
				echo $rs['qq'];
				echo "\" size=\"25\"></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>�������ڣ�</TD>\r\n      <TD bgColor=#ffffff><select name=\"BirthYear\">\r\n<option label=\"1969\" value=\"1969\" ";
				if ( $birthday[0] == 1969 )
				{
						echo "selected";
				}
				echo ">1969</option>\r\n<option label=\"1970\" value=\"1970\" ";
				if ( $birthday[0] == 1970 )
				{
						echo "selected";
				}
				echo ">1970</option>\r\n<option label=\"1971\" value=\"1971\" ";
				if ( $birthday[0] == 1971 )
				{
						echo "selected";
				}
				echo ">1971</option>\r\n<option label=\"1972\" value=\"1972\" ";
				if ( $birthday[0] == 1972 )
				{
						echo "selected";
				}
				echo ">1972</option>\r\n<option label=\"1973\" value=\"1973\" ";
				if ( $birthday[0] == 1973 )
				{
						echo "selected";
				}
				echo ">1973</option>\r\n<option label=\"1974\" value=\"1974\" ";
				if ( $birthday[0] == 1974 )
				{
						echo "selected";
				}
				echo ">1974</option>\r\n<option label=\"1975\" value=\"1975\" ";
				if ( $birthday[0] == 1975 )
				{
						echo "selected";
				}
				echo ">1975</option>\r\n<option label=\"1976\" value=\"1976\" ";
				if ( $birthday[0] == 1976 )
				{
						echo "selected";
				}
				echo ">1976</option>\r\n<option label=\"1977\" value=\"1977\" ";
				if ( $birthday[0] == 1977 )
				{
						echo "selected";
				}
				echo ">1977</option>\r\n<option label=\"1978\" value=\"1978\" ";
				if ( $birthday[0] == 1978 )
				{
						echo "selected";
				}
				echo ">1978</option>\r\n<option label=\"1979\" value=\"1979\" ";
				if ( $birthday[0] == 1979 )
				{
						echo "selected";
				}
				echo ">1979</option>\r\n<option label=\"1980\" value=\"1980\" ";
				if ( $birthday[0] == 1980 )
				{
						echo "selected";
				}
				echo ">1980</option>\r\n<option label=\"1981\" value=\"1981\" ";
				if ( $birthday[0] == 1981 )
				{
						echo "selected";
				}
				echo ">1981</option>\r\n<option label=\"1982\" value=\"1982\" ";
				if ( $birthday[0] == 1982 )
				{
						echo "selected";
				}
				echo ">1982</option>\r\n<option label=\"1983\" value=\"1983\" ";
				if ( $birthday[0] == 1983 )
				{
						echo "selected";
				}
				echo ">1983</option>\r\n<option label=\"1984\" value=\"1984\" ";
				if ( $birthday[0] == 1984 )
				{
						echo "selected";
				}
				echo ">1984</option>\r\n<option label=\"1985\" value=\"1985\" ";
				if ( $birthday[0] == 1985 )
				{
						echo "selected";
				}
				echo ">1985</option>\r\n<option label=\"1986\" value=\"1986\" ";
				if ( $birthday[0] == 1986 )
				{
						echo "selected";
				}
				echo ">1986</option>\r\n<option label=\"1987\" value=\"1987\" ";
				if ( $birthday[0] == 1987 )
				{
						echo "selected";
				}
				echo ">1987</option>\r\n<option label=\"1988\" value=\"1988\" ";
				if ( $birthday[0] == 1988 )
				{
						echo "selected";
				}
				echo ">1988</option>\r\n<option label=\"1989\" value=\"1989\" ";
				if ( $birthday[0] == 1989 )
				{
						echo "selected";
				}
				echo ">1989</option>\r\n<option label=\"1990\" value=\"1990\" ";
				if ( $birthday[0] == 1990 )
				{
						echo "selected";
				}
				echo ">1990</option>\r\n<option label=\"1991\" value=\"1991\" ";
				if ( $birthday[0] == 1991 )
				{
						echo "selected";
				}
				echo ">1991</option>\r\n<option label=\"1992\" value=\"1992\" ";
				if ( $birthday[0] == 1992 )
				{
						echo "selected";
				}
				echo ">1992</option>\r\n<option label=\"1993\" value=\"1993\" ";
				if ( $birthday[0] == 1993 )
				{
						echo "selected";
				}
				echo ">1993</option>\r\n<option label=\"1994\" value=\"1994\" ";
				if ( $birthday[0] == 1994 )
				{
						echo "selected";
				}
				echo ">1994</option>\r\n<option label=\"1995\" value=\"1995\" ";
				if ( $birthday[0] == 1995 )
				{
						echo "selected";
				}
				echo ">1995</option>\r\n<option label=\"1996\" value=\"1996\" ";
				if ( $birthday[0] == 1996 )
				{
						echo "selected";
				}
				echo ">1996</option>\r\n<option label=\"1997\" value=\"1997\" ";
				if ( $birthday[0] == 1997 )
				{
						echo "selected";
				}
				echo ">1997</option>\r\n<option label=\"1998\" value=\"1998\" ";
				if ( $birthday[0] == 1998 )
				{
						echo "selected";
				}
				echo ">1998</option>\r\n<option label=\"1999\" value=\"1999\" ";
				if ( $birthday[0] == 1999 )
				{
						echo "selected";
				}
				echo ">1999</option>\r\n<option label=\"2000\" value=\"2000\" ";
				if ( $birthday[0] == 2000 )
				{
						echo "selected";
				}
				echo ">2000</option>\r\n<option label=\"2001\" value=\"2001\" ";
				if ( $birthday[0] == 2001 )
				{
						echo "selected";
				}
				echo ">2001</option>\r\n<option label=\"2002\" value=\"2002\" ";
				if ( $birthday[0] == 2002 )
				{
						echo "selected";
				}
				echo ">2002</option>\r\n<option label=\"2003\" value=\"2003\" ";
				if ( $birthday[0] == 2003 )
				{
						echo "selected";
				}
				echo ">2003</option>\r\n<option label=\"2004\" value=\"2004\" ";
				if ( $birthday[0] == 2004 )
				{
						echo "selected";
				}
				echo ">2004</option>\r\n<option label=\"2005\" value=\"2005\" ";
				if ( $birthday[0] == 2005 )
				{
						echo "selected";
				}
				echo ">2005</option>\r\n<option label=\"2006\" value=\"2006\" ";
				if ( $birthday[0] == 2006 )
				{
						echo "selected";
				}
				echo ">2006</option>\r\n<option label=\"2007\" value=\"2007\" ";
				if ( $birthday[0] == 2007 )
				{
						echo "selected";
				}
				echo ">2007</option>\r\n<option label=\"2008\" value=\"2008\" ";
				if ( $birthday[0] == 2008 )
				{
						echo "selected";
				}
				echo ">2008</option>\r\n<option label=\"2009\" value=\"2009\" ";
				if ( $birthday[0] == 2009 )
				{
						echo "selected";
				}
				echo ">2009</option>\r\n</select>\r\n<select name=\"BirthMonth\">\r\n<option label=\"01\" value=\"01\" ";
				if ( $birthday[1] == 1 )
				{
						echo "selected";
				}
				echo ">01</option>\r\n<option label=\"02\" value=\"02\" ";
				if ( $birthday[1] == 2 )
				{
						echo "selected";
				}
				echo ">02</option>\r\n<option label=\"03\" value=\"03\" ";
				if ( $birthday[1] == 3 )
				{
						echo "selected";
				}
				echo ">03</option>\r\n<option label=\"04\" value=\"04\" ";
				if ( $birthday[1] == 4 )
				{
						echo "selected";
				}
				echo ">04</option>\r\n<option label=\"05\" value=\"05\" ";
				if ( $birthday[1] == 5 )
				{
						echo "selected";
				}
				echo ">05</option>\r\n<option label=\"06\" value=\"06\" ";
				if ( $birthday[1] == 6 )
				{
						echo "selected";
				}
				echo ">06</option>\r\n<option label=\"07\" value=\"07\" ";
				if ( $birthday[1] == 7 )
				{
						echo "selected";
				}
				echo ">07</option>\r\n<option label=\"08\" value=\"08\" ";
				if ( $birthday[1] == 8 )
				{
						echo "selected";
				}
				echo ">08</option>\r\n<option label=\"09\" value=\"09\" ";
				if ( $birthday[1] == 9 )
				{
						echo "selected";
				}
				echo ">09</option>\r\n<option label=\"10\" value=\"10\" ";
				if ( $birthday[1] == 10 )
				{
						echo "selected";
				}
				echo ">10</option>\r\n<option label=\"11\" value=\"11\" ";
				if ( $birthday[1] == 11 )
				{
						echo "selected";
				}
				echo ">11</option>\r\n<option label=\"12\" value=\"12\" ";
				if ( $birthday[1] == 12 )
				{
						echo "selected";
				}
				echo ">12</option>\r\n</select>\r\n<select name=\"BirthDay\">\r\n<option label=\"01\" value=\"1\" ";
				if ( $birthday[2] == 1 )
				{
						echo "selected";
				}
				echo ">01</option>\r\n<option label=\"02\" value=\"2\" ";
				if ( $birthday[2] == 2 )
				{
						echo "selected";
				}
				echo ">02</option>\r\n<option label=\"03\" value=\"3\" ";
				if ( $birthday[2] == 3 )
				{
						echo "selected";
				}
				echo ">03</option>\r\n<option label=\"04\" value=\"4\" ";
				if ( $birthday[2] == 4 )
				{
						echo "selected";
				}
				echo ">04</option>\r\n<option label=\"05\" value=\"5\" ";
				if ( $birthday[2] == 5 )
				{
						echo "selected";
				}
				echo ">05</option>\r\n<option label=\"06\" value=\"6\" ";
				if ( $birthday[2] == 6 )
				{
						echo "selected";
				}
				echo ">06</option>\r\n<option label=\"07\" value=\"7\" ";
				if ( $birthday[2] == 7 )
				{
						echo "selected";
				}
				echo ">07</option>\r\n<option label=\"08\" value=\"8\" ";
				if ( $birthday[2] == 8 )
				{
						echo "selected";
				}
				echo ">08</option>\r\n<option label=\"09\" value=\"9\" ";
				if ( $birthday[2] == 9 )
				{
						echo "selected";
				}
				echo ">09</option>\r\n<option label=\"10\" value=\"10\" ";
				if ( $birthday[2] == 10 )
				{
						echo "selected";
				}
				echo ">10</option>\r\n<option label=\"11\" value=\"11\" ";
				if ( $birthday[2] == 11 )
				{
						echo "selected";
				}
				echo ">11</option>\r\n<option label=\"12\" value=\"12\" ";
				if ( $birthday[2] == 12 )
				{
						echo "selected";
				}
				echo ">12</option>\r\n<option label=\"13\" value=\"13\" ";
				if ( $birthday[2] == 13 )
				{
						echo "selected";
				}
				echo ">13</option>\r\n<option label=\"14\" value=\"14\" ";
				if ( $birthday[2] == 14 )
				{
						echo "selected";
				}
				echo ">14</option>\r\n<option label=\"15\" value=\"15\" ";
				if ( $birthday[2] == 15 )
				{
						echo "selected";
				}
				echo ">15</option>\r\n<option label=\"16\" value=\"16\" ";
				if ( $birthday[2] == 16 )
				{
						echo "selected";
				}
				echo ">16</option>\r\n<option label=\"17\" value=\"17\" ";
				if ( $birthday[2] == 17 )
				{
						echo "selected";
				}
				echo ">17</option>\r\n<option label=\"18\" value=\"18\" ";
				if ( $birthday[2] == 18 )
				{
						echo "selected";
				}
				echo ">18</option>\r\n<option label=\"19\" value=\"19\" ";
				if ( $birthday[2] == 19 )
				{
						echo "selected";
				}
				echo ">19</option>\r\n<option label=\"20\" value=\"20\" ";
				if ( $birthday[2] == 20 )
				{
						echo "selected";
				}
				echo ">20</option>\r\n<option label=\"21\" value=\"21\" ";
				if ( $birthday[2] == 21 )
				{
						echo "selected";
				}
				echo ">21</option>\r\n<option label=\"22\" value=\"22\" ";
				if ( $birthday[2] == 22 )
				{
						echo "selected";
				}
				echo ">22</option>\r\n<option label=\"23\" value=\"23\" ";
				if ( $birthday[2] == 23 )
				{
						echo "selected";
				}
				echo ">23</option>\r\n<option label=\"24\" value=\"24\" ";
				if ( $birthday[2] == 24 )
				{
						echo "selected";
				}
				echo ">24</option>\r\n<option label=\"25\" value=\"25\" ";
				if ( $birthday[2] == 25 )
				{
						echo "selected";
				}
				echo ">25</option>\r\n<option label=\"26\" value=\"26\" ";
				if ( $birthday[2] == 26 )
				{
						echo "selected";
				}
				echo ">26</option>\r\n<option label=\"27\" value=\"27\" ";
				if ( $birthday[2] == 27 )
				{
						echo "selected";
				}
				echo ">27</option>\r\n<option label=\"28\" value=\"28\" ";
				if ( $birthday[2] == 28 )
				{
						echo "selected";
				}
				echo ">28</option>\r\n<option label=\"29\" value=\"29\" ";
				if ( $birthday[2] == 29 )
				{
						echo "selected";
				}
				echo ">29</option>\r\n<option label=\"30\" value=\"30\" ";
				if ( $birthday[2] == 30 )
				{
						echo "selected";
				}
				echo ">30</option>\r\n<option label=\"31\" value=\"31\" ";
				if ( $birthday[2] == 31 )
				{
						echo "selected";
				}
				echo ">31</option>\r\n</select></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>�ֻ����룺</TD>\r\n      <TD bgColor=#ffffff><input name=\"UserPhone\" id=\"UserPhone\" value=\"";
				echo $rs['tel'];
				echo "\" size=\"25\"></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>��ϵ��ַ��</TD>\r\n      <TD bgColor=#ffffff><select name=\"UserPro\" id=\"UserPro\" onchange=\"chgPro('UserPro','UserCity');\">\r\n                    </select>\r\n                ʡ\r\n                <select name=\"UserCity\" id=\"UserCity\">\r\n                </select>\r\n                ��<script type=\"text/javascript\">initAddr(\"UserPro\",\"UserCity\",\"";
				echo $address[0];
				echo "\",\"";
				echo $address[1];
				echo "\");</script>\r\n                    <input name=\"UserAddr\"  type=\"text\" value=\"";
				echo $address[2];
				echo "\" size=\"30\" /></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>ѧ����</TD>\r\n      <TD bgColor=#ffffff><select name=\"UserQualifications\" id=\"UserQualifications\">\r\n\t  <option label=\"��ѡ��\" value=\"0\" selected=\"selected\">��ѡ��</option>\r\n<option label=\"����\" value=\"����\" ";
				if ( $rs['education'] == "����" )
				{
						echo "selected";
				}
				echo ">����</option>\r\n<option label=\"����\" value=\"����\" ";
				if ( $rs['education'] == "����" )
				{
						echo "selected";
				}
				echo ">����</option>\r\n<option label=\"��ר\" value=\"��ר\" ";
				if ( $rs['education'] == "��ר" )
				{
						echo "selected";
				}
				echo ">��ר</option>\r\n<option label=\"����\" value=\"����\" ";
				if ( $rs['education'] == "����" )
				{
						echo "selected";
				}
				echo ">����</option>\r\n<option label=\"˶ʿ\" value=\"˶ʿ\" ";
				if ( $rs['education'] == "˶ʿ" )
				{
						echo "selected";
				}
				echo ">˶ʿ</option>\r\n<option label=\"��ʿ\" value=\"��ʿ\" ";
				if ( $rs['education'] == "��ʿ" )
				{
						echo "selected";
				}
				echo ">��ʿ</option>\r\n<option label=\"����\" value=\"����\" ";
				if ( $rs['education'] == "����" )
				{
						echo "selected";
				}
				echo ">����</option>\r\n                    </select></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>ְҵ��</TD>\r\n      <TD bgColor=#ffffff><select name=\"UserJob\" id=\"UserJob\">\r\n                      <option label=\"��ѡ��\" value=\"0\">��ѡ��</option>\r\n<option label=\"��Ӫ/����\" value=\"��Ӫ/����\" ";
				if ( $rs['job'] == "��Ӫ/����" )
				{
						echo "selected";
				}
				echo ">��Ӫ/����</option>\r\n<option label=\"�����/������\" value=\"�����/������\" ";
				if ( $rs['job'] == "�����/������" )
				{
						echo "selected";
				}
				echo ">�����/������</option>\r\n<option label=\"����/����/��ְ\" value=\"����/����/��ְ\" ";
				if ( $rs['job'] == "����/����/��ְ" )
				{
						echo "selected";
				}
				echo ">����/����/��ְ</option>\r\n<option label=\"����/�г�/���/��չ\" value=\"����/�г�/���/��չ\" ";
				if ( $rs['job'] == "����/�г�/���/��չ" )
				{
						echo "selected";
				}
				echo ">����/�г�/���/��չ</option>\r\n<option label=\"ó��/����/�ͻ�����\" value=\"ó��/����/�ͻ�����\" ";
				if ( $rs['job'] == "ó��/����/�ͻ�����" )
				{
						echo "selected";
				}
				echo ">ó��/����/�ͻ�����</option>\r\n<option label=\"����/�ִ�\" value=\"����/�ִ�\" ";
				if ( $rs['job'] == "����/�ִ�" )
				{
						echo "selected";
				}
				echo ">����/�ִ�</option>\r\n<option label=\"�ƻ�/���/ͳ��/����\" value=\"�ƻ�/���/ͳ��/����\" ";
				if ( $rs['job'] == "�ƻ�/���/ͳ��/����" )
				{
						echo "selected";
				}
				echo ">�ƻ�/���/ͳ��/����</option>\r\n<option label=\"��е���̼���\" value=\"��е���̼���\" ";
				if ( $rs['job'] == "��е���̼���" )
				{
						echo "selected";
				}
				echo ">��е���̼���</option>\r\n<option label=\"����/���ز����̼���\" value=\"����/���ز����̼���\" ";
				if ( $rs['job'] == "����/���ز����̼���" )
				{
						echo "selected";
				}
				echo ">����/���ز����̼���</option>\r\n<option label=\"����/��ҩ/����/���﹤��\" value=\"����/��ҩ/����/���﹤��\" ";
				if ( $rs['job'] == "����/��ҩ/����/���﹤��" )
				{
						echo "selected";
				}
				echo ">����/��ҩ/����/���﹤��</option>\r\n<option label=\"����/ͨѶ/����/��������\" value=\"����/ͨѶ/����/��������\" ";
				if ( $rs['job'] == "����/ͨѶ/����/��������" )
				{
						echo "selected";
				}
				echo ">����/ͨѶ/����/��������</option>\r\n<option label=\"��֯/��װ/ʳƷ���̼���\" value=\"��֯/��װ/ʳƷ���̼���\" ";
				if ( $rs['job'] == "��֯/��װ/ʳƷ���̼���" )
				{
						echo "selected";
				}
				echo ">��֯/��װ/ʳƷ���̼���</option>\r\n<option label=\"ֽ/ӡˢ/�Ҿ߼ҵ�����\" value=\"ֽ/ӡˢ/�Ҿ߼ҵ�����\" ";
				if ( $rs['job'] == "ֽ/ӡˢ/�Ҿ߼ҵ�����" )
				{
						echo "selected";
				}
				echo ">ֽ/ӡˢ/�Ҿ߼ҵ�����</option>\r\n<option label=\"�������̼���\" value=\"�������̼���\" ";
				if ( $rs['job'] == "�������̼���" )
				{
						echo "selected";
				}
				echo ">�������̼���</option>\r\n<option label=\"����/����/����/����/��ý\" value=\"����/����/����/����/��ý\" ";
				if ( $rs['job'] == "����/����/����/����/��ý" )
				{
						echo "selected";
				}
				echo ">����/����/����/����/��ý</option>\r\n<option label=\"ҽ��/����/����/����\" value=\"ҽ��/����/����/����\" ";
				if ( $rs['job'] == "ҽ��/����/����/����" )
				{
						echo "selected";
				}
				echo ">ҽ��/����/����/����</option>\r\n<option label=\"����/����/��ѯ����\" value=\"����/����/��ѯ����\" ";
				if ( $rs['job'] == "����/����/��ѯ����" )
				{
						echo "selected";
				}
				echo ">����/����/��ѯ����</option>\r\n<option label=\"����/�Ƶ�/����/�̳�/���ַ���\" value=\"����/�Ƶ�/����/�̳�/���ַ���\" ";
				if ( $rs['job'] == "����/�Ƶ�/����/�̳�/���ַ���" )
				{
						echo "selected";
				}
				echo ">����/�Ƶ�/����/�̳�/���ַ���</option>\r\n<option label=\"ũ������\" value=\"ũ������\" ";
				if ( $rs['job'] == "ũ������" )
				{
						echo "selected";
				}
				echo ">ũ������</option>\r\n<option label=\"�滮/���/԰���̻�\" value=\"�滮/���/԰���̻�\" ";
				if ( $rs['job'] == "�滮/���/԰���̻�" )
				{
						echo "selected";
				}
				echo ">�滮/���/԰���̻�</option>\r\n<option label=\"����\" value=\"����\" ";
				if ( $rs['job'] == "����" )
				{
						echo "selected";
				}
				echo ">����</option>\r\n<option label=\"����\" value=\"����\" ";
				if ( $rs['job'] == "����" )
				{
						echo "selected";
				}
				echo ">����</option>\r\n\t\t\t\t\t\t\t\t\t\t\t</select></TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>��Ȥ���ã�</TD>\r\n      <TD bgColor=#ffffff>\r\n        <table width='100%' cellspacing='0' cellpadding='0'>\r\n          <tr>\r\n            <td><label>\r\n              <input name=\"UserInterested[]\" type=\"checkbox\" value=\"ͼ��/��־\" ";
				if ( stristr( $rs['bent'], "ͼ��/��־" ) )
				{
						echo "checked";
				}
				echo "/>\r\n              ͼ��/��־</label>\r\n            </td>\r\n            <td><label>\r\n              <input type=\"checkbox\" name=\"UserInterested[]\" value=\"����/Ӱ��\" ";
				if ( stristr( $rs['bent'], "����/Ӱ��" ) )
				{
						echo "checked";
				}
				echo "/>\r\n              ����/Ӱ��</label>\r\n            </td>\r\n            <td><label>\r\n              <input type=\"checkbox\" name=\"UserInterested[]\" value=\"����/�����˶�\" ";
				if ( stristr( $rs['bent'], "����/�����˶�" ) )
				{
						echo "checked";
				}
				echo "/>\r\n              ����/�����˶�</label>\r\n            </td>\r\n            <td><label>\r\n              <input type=\"checkbox\" name=\"UserInterested[]\" value=\"����/����\" ";
				if ( stristr( $rs['bent'], "����/����" ) )
				{
						echo "checked";
				}
				echo "/>\r\n      ����/����</label>\r\n            </td>\r\n          </tr>\r\n          <tr>\r\n            <td><label>\r\n              <input type=\"checkbox\" name=\"UserInterested[]\" value=\"��ʳ/�ư�\" ";
				if ( stristr( $rs['bent'], "��ʳ/�ư�" ) )
				{
						echo "checked";
				}
				echo "/>\r\n              ��ʳ/�ư�</label>\r\n            </td>\r\n            <td><label>\r\n              <input type=\"checkbox\" name=\"UserInterested[]\" value=\"����Ӳ��\" ";
				if ( stristr( $rs['bent'], "����Ӳ��" ) )
				{
						echo "checked";
				}
				echo "/>\r\n              ����Ӳ��</label>\r\n            </td>\r\n            <td><label>\r\n              <input type=\"checkbox\" name=\"UserInterested[]\" value=\"�������\" ";
				if ( stristr( $rs['bent'], "�������" ) )
				{
						echo "checked";
				}
				echo "/>\r\n              �������</label>\r\n            </td>\r\n            <td><label>\r\n              <input type=\"checkbox\" name=\"UserInterested[]\" value=\"������Ϸ/������Ϸ\" ";
				if ( stristr( $rs['bent'], "������Ϸ/������Ϸ" ) )
				{
						echo "checked";
				}
				echo "/>\r\n              ������Ϸ/������Ϸ</label>\r\n            </td>\r\n          </tr>\r\n          <tr>\r\n            <td><label>\r\n              <input type=\"checkbox\" name=\"UserInterested[]\" value=\"���Ϲ���\" ";
				if ( stristr( $rs['bent'], "���Ϲ���" ) )
				{
						echo "checked";
				}
				echo "/>\r\n              ���Ϲ���</label>\r\n            </td>\r\n            <td><label>\r\n              <input type=\"checkbox\" name=\"UserInterested[]\" value=\"�ֻ�/���˵��Ӳ�Ʒ\" ";
				if ( stristr( $rs['bent'], "�ֻ�/���˵��Ӳ�Ʒ" ) )
				{
						echo "checked";
				}
				echo "/>\r\n              �ֻ�/���˵��Ӳ�Ʒ</label>\r\n            </td>\r\n            <td><label>\r\n              <input type=\"checkbox\" name=\"UserInterested[]\" value=\"���/��Ӱ����\" ";
				if ( stristr( $rs['bent'], "���/��Ӱ����" ) )
				{
						echo "checked";
				}
				echo "/>\r\n              ���/��Ӱ����</label>\r\n            </td>\r\n            <td><label>\r\n              <input type=\"checkbox\" name=\"UserInterested[]\" value=\"�ҵ�/Ӱ������\" ";
				if ( stristr( $rs['bent'], "�ҵ�/Ӱ������" ) )
				{
						echo "checked";
				}
				echo "/>\r\n              �ҵ�/Ӱ������</label>\r\n            </td>\r\n          </tr>\r\n          <tr>\r\n            <td><label>\r\n              <input type=\"checkbox\" name=\"UserInterested[]\" value=\"����/��ͨ����\" ";
				if ( stristr( $rs['bent'], "����/��ͨ����" ) )
				{
						echo "checked";
				}
				echo "/>\r\n              ����/��ͨ����</label>\r\n            </td>\r\n            <td><label>\r\n              <input type=\"checkbox\" name=\"UserInterested[]\" value=\"����/����\" ";
				if ( stristr( $rs['bent'], "����/����" ) )
				{
						echo "checked";
				}
				echo "/>\r\n              ����/����</label>\r\n            </td>\r\n            <td><label>\r\n              <input type=\"checkbox\" name=\"UserInterested[]\" value=\"ʱ��Ʒ/�ݳ�Ʒ\" ";
				if ( stristr( $rs['bent'], "ʱ��Ʒ/�ݳ�Ʒ" ) )
				{
						echo "checked";
				}
				echo "/>\r\n              ʱ��Ʒ/�ݳ�Ʒ</label>\r\n            </td>\r\n            <td><label>\r\n              <input type=\"checkbox\" name=\"UserInterested[]\" value=\"����/�ػݹ�����Ϣ\" ";
				if ( stristr( $rs['bent'], "����/�ػݹ�����Ϣ" ) )
				{
						echo "checked";
				}
				echo "/>\r\n              ����/�ػݹ�����Ϣ</label>\r\n            </td>\r\n          </tr>\r\n          <tr>\r\n            <td><label>\r\n              <input type=\"checkbox\" name=\"UserInterested[]\" value=\"��Ʒ/�ʻ�����\" ";
				if ( stristr( $rs['bent'], "��Ʒ/�ʻ�����" ) )
				{
						echo "checked";
				}
				echo "/>\r\n              ��Ʒ/�ʻ�����</label>\r\n            </td>\r\n            <td><label>\r\n              <input type=\"checkbox\" name=\"UserInterested[]\" value=\"��ѧ����/��Ů����\" ";
				if ( stristr( $rs['bent'], "��ѧ����/��Ů����" ) )
				{
						echo "checked";
				}
				echo "/>\r\n              ��ѧ����/��Ů����</label>\r\n            </td>\r\n            <td><label>\r\n              <input type=\"checkbox\" name=\"UserInterested[]\" value=\"����/����\" ";
				if ( stristr( $rs['bent'], "����/����" ) )
				{
						echo "checked";
				}
				echo "/>\r\n              ����/����</label>\r\n            </td>\r\n            <td><label>\r\n              <input type=\"checkbox\" name=\"UserInterested[]\" value=\"����/���\" ";
				if ( stristr( $rs['bent'], "����/���" ) )
				{
						echo "checked";
				}
				echo "/>\r\n              ����/���</label>\r\n            </td>\r\n          </tr>\r\n          <tr>\r\n            <td><label>\r\n              <input type=\"checkbox\" name=\"UserInterested[]\" value=\"����/��ѵ\" ";
				if ( stristr( $rs['bent'], "����/��ѵ" ) )
				{
						echo "checked";
				}
				echo "/>\r\n              ����/��ѵ</label>\r\n            </td>\r\n            <td><label>\r\n              <input type=\"checkbox\" name=\"UserInterested[]\" value=\"��ѧ/����\" ";
				if ( stristr( $rs['bent'], "��ѧ/����" ) )
				{
						echo "checked";
				}
				echo "/>\r\n              ��ѧ/����</label>\r\n            </td>\r\n            <td><label>\r\n              <input type=\"checkbox\" name=\"UserInterested[]\" value=\"��Ƹ/��ͷ\" ";
				if ( stristr( $rs['bent'], "��Ƹ/��ͷ" ) )
				{
						echo "checked";
				}
				echo "/>\r\n              ��Ƹ/��ͷ</label>\r\n            </td>\r\n            <td><label>\r\n              <input type=\"checkbox\" name=\"UserInterested[]\" value=\"����/Լ��\" ";
				if ( stristr( $rs['bent'], "����/Լ��" ) )
				{
						echo "checked";
				}
				echo "/>\r\n              ����/Լ��</label>\r\n            </td>\r\n          </tr>\r\n          <tr>\r\n            <td><label>\r\n              <input type=\"checkbox\" name=\"UserInterested[]\" value=\"Ͷ��/���\" ";
				if ( stristr( $rs['bent'], "Ͷ��/���" ) )
				{
						echo "checked";
				}
				echo "/>\r\n              Ͷ��/���</label>\r\n            </td>\r\n            <td><label>\r\n              <input type=\"checkbox\" name=\"UserInterested[]\" value=\"����/����\" ";
				if ( stristr( $rs['bent'], "����/����" ) )
				{
						echo "checked";
				}
				echo "/>\r\n              ����/����</label>\r\n            </td>\r\n            <td><label>\r\n              <input type=\"checkbox\" name=\"UserInterested[]\" value=\"��Ʊ/����\" ";
				if ( stristr( $rs['bent'], "��Ʊ/����" ) )
				{
						echo "checked";
				}
				echo "/>\r\n              ��Ʊ/����</label>\r\n            </td>\r\n            <td><label>\r\n              <input type=\"checkbox\" name=\"UserInterested[]\" value=\"����/��ҵ����\" ";
				if ( stristr( $rs['bent'], "����/��ҵ����" ) )
				{
						echo "checked";
				}
				echo "/>\r\n              ����/��ҵ����</label>\r\n            </td>\r\n          </tr>\r\n        </table>\r\n      </TD>\r\n    </TR>\r\n\t<TR>\r\n      <TD bgColor=#f5fafe>����˵����</TD>\r\n      <TD bgColor=#ffffff>\r\n        <textarea name=\"UserDescription\" id=\"UserDescription\" cols=\"40\" rows=\"5\">";
				echo $rs['caption'];
				echo "</textarea></TD>\r\n    </TR>\r\n    <TR align=\"center\" bgcolor=\"#f8fbfb\">\r\n      <TD colspan=\"2\"><INPUT class=inputbut type=submit value=�޸� name=Submit></TD>\r\n    </TR>\r\n  </TBODY>\r\n  </form>\r\n</TABLE>\r\n<script language=\"javascript\" src=\"inc/js.js\"></script>\r\n<script language=\"JavaScript\" src=\"inc/calendar.js\"></script>\r\n\r\n";
		}
}

function dj( )
{
		if ( isset( $_POST['id'] ) )
		{
				$id = implode( ",", $_POST['id'] );
		}
		else
		{
				$id = $_GET['id'];
		}
		echo "<TABLE width=\"96%\" border=0 align=center cellpadding=\"4\" cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n<form action=\"?action=djcz&url=";
		echo urlencode( $_SERVER['HTTP_REFERER'] );
		echo "\" method=\"post\">\r\n<input name=\"id\" type=\"hidden\" value=\"";
		echo $id;
		echo "\">\r\n  <TBODY>\r\n    <TR>\r\n      <TD vAlign=center width=\"20%\" bgColor=#f5fafe>�������ɣ�</TD>\r\n      <TD bgColor=#ffffff><textarea name=\"djly\" id=\"djly\" cols=\"40\" rows=\"5\"></textarea></TD>\r\n    </TR>\r\n\t<TR align=\"center\" bgcolor=\"#f8fbfb\">\r\n      <TD colspan=\"2\"><INPUT class=inputbut type=submit value=�ύ name=Submit></TD>\r\n    </TR>\r\n  </TBODY>\r\n</form>\r\n</TABLE>\r\n";
}

set_time_limit( 0 );
include_once( dirname( __FILE__ )."/../inc/conn.php" );
include_once( dirname( __FILE__ )."/inc/function.php" );
login_check( "users" );
echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd\">\r\n<HTML xmlns=\"http://www.w3.org/1999/xhtml\">\r\n<HEAD>\r\n<TITLE>�û�����--�׷������Ϸϵͳ</TITLE>\r\n<META http-equiv=Content-Type content=\"text/html; charset=gb2312\">\r\n<LINK href=\"images/css_body.css\" type=text/css rel=stylesheet>\r\n<META content=\"MSHTML 6.00.3790.4275\" name=GENERATOR>\r\n</HEAD>\r\n<BODY>\r\n<DIV class=bodytitle>\r\n<DIV class=bodytitleleft></DIV>\r\n<DIV class=bodytitletxt>�û�����</DIV>\r\n<DIV class=bodytitletxt2><a href=\"admin_users.php?action=dellogin\">ɾ��������δ��½�û�</a></DIV>\r\n</DIV>\r\n";
switch ( $_GET['action'] )
{
case "edit" :
		edit( );
		break;
case "sedit" :
		sedit( );
		addlog( "�û��޸ĳɹ�" );
		showerr( "�û��޸ĳɹ�", urldecode( $_GET['url'] ) );
		break;
case "del" :
		del( );
		addlog( "�û�ɾ���ɹ�" );
		showerr( "�û�ɾ���ɹ�", $_SERVER['HTTP_REFERER'] );
		break;
case "dj" :
		dj( );
		break;
case "isbz" :
		isbz( $_GET['isbz'] );
		main( );
		break;
case "djcz" :
		djcz( );
		addlog( "�û�����ɹ�" );
		showerr( "�û�����ɹ�", urldecode( $_GET['url'] ) );
		break;
case "jd" :
		jd( );
		addlog( "�û��ⶳ�ɹ�" );
		showerr( "�û��ⶳ�ɹ�", $_SERVER['HTTP_REFERER'] );
		break;
case "dellogin" :
		dellogin( );
		addlog( "ɾ��������δ��½�û��ɹ�" );
		showerr( "ɾ��������δ��½�û��ɹ�", "admin_users.php" );
		break;
case "look" :
		look( );
		break;
default :
		main( );
}
echo "</BODY></HTML>\r\n";
?>
