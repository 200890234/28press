<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/

function backupdata( )
{
		global $db;
		global $action;
		global $sizelimit;
		global $startrow;
		$fileid = isset( $_GET['fileid'] ) ? $_GET['fileid'] : 1;
		$tables = $_REQUEST['tables'];
		$sizelimit = $_REQUEST['sizelimit'];
		$random = $_GET['random'];
		if ( $fileid == 1 && $tables )
		{
				if ( !isset( $tables ) && !is_array( $tables ) )
				{
						message( "��ѡ��Ҫ���ݵ����ݱ�!", "admin_dbback.php?action=Backup" );
				}
				$random = mt_rand( 1000, 9999 );
				cache_write( "bakup_tables.php", $tables );
		}
		else if ( !( $tables = cache_read( "bakup_tables.php" ) ) )
		{
				message( "��ѡ��Ҫ���ݵ����ݱ�!", "admin_dbback.php?action=Backup" );
		}
		$sqldump = "";
		$tableid = isset( $_GET['tableid'] ) ? $_GET['tableid'] - 1 : 0;
		$startfrom = isset( $_GET['startfrom'] ) ? intval( $_GET['startfrom'] ) : 0;
		$tablenumber = count( $tables );
		$i = $tableid;
		for ( ;	$i < $tablenumber && strlen( $sqldump ) < $sizelimit * 1000;	++$i	)
		{
				$sqldump .= sql_dumptable( $tables[$i], $startfrom, strlen( $sqldump ) );
				$startfrom = 0;
		}
		if ( trim( $sqldump ) )
		{
				$sqldump = "#lfcms Created\n# --------------------------------------------------------\n\n\n".$sqldump;
				$tableid = $i;
				$filename = "lfcms_".date( "Ymd" )."_".$random."_".$fileid.".sql";
				++$fileid;
				$bakfile = "../dbback/".$filename;
				if ( !is_writable( "../dbback/" ) )
				{
						message( "�����޷����ݵ�������!���� ./data Ŀ¼�Ƿ��д��", $forward );
				}
				fsosavefile( $bakfile, $sqldump );
				message( "�����ļ� ".$filename." д��ɹ�!", "?action=".$action."&sizelimit=".$sizelimit."&tableid=".$tableid."&fileid=".$fileid."&startfrom=".$startrow."&random=".$random."&dosubmit=1" );
				exit( );
		}
		cache_delete( "bakup_tables.php" );
		addlog( "�������ݿ�" );
		message( "���ݿⱸ�����!", "admin_dbback.php?action=Backup", "5000" );
		exit( );
}

function restoredata( )
{
		$fileid = $_GET['fileid'] ? $_GET['fileid'] : 1;
		$filename = $_GET['pre'].$fileid.".sql";
		$filepath = "../dbback/".$filename;
		if ( file_exists( $filepath ) )
		{
				$sql = file_get_contents( $filepath );
				sql_execute( $sql );
				++$fileid;
				message( "�����ļ� ".$filename." ����ɹ�!", "?action=RestoreData&pre=".$_GET['pre']."&fileid=".$fileid );
		}
		else
		{
				addlog( "�ָ����ݿ�" );
				message( "���ݿ�ָ��ɹ�!", "admin_dbback.php?action=Restore", "5000" );
		}
}

function delbackup( )
{
		if ( is_array( $_REQUEST['filenames'] ) )
		{
				foreach ( $GLOBALS['_REQUEST']['filenames'] as $filename )
				{
						if ( fileext( $filename ) == "sql" )
						{
								@unlink( "../dbback/".$filename );
						}
				}
		}
		else if ( fileext( $_REQUEST['filenames'] ) == "sql" )
		{
				@unlink( "../dbback/".$_REQUEST['filenames'] );
		}
		addlog( "ɾ���������ݿ�" );
		message( "ɾ���������ݿ�ɹ�", "admin_dbback.php?action=Restore", "5000" );
}

function compactdata( )
{
		global $db;
		$tables = is_array( $_POST['tables'] ) ? implode( ",", $_POST['tables'] ) : $_POST['tables'];
		if ( $tables && in_array( $_POST['operation'], array( "repair", "optimize" ) ) )
		{
				$db->query( $_POST['operation']." TABLE {$tables}" );
		}
		addlog( $_POST['operation'] == "repair" ? "�Ż����ݿ�" : "�޸����ݿ�" );
		message( "���ݱ�����ɹ�!", "admin_dbback.php?action=Compact", "5000" );
}

function sql_dumptable( $table, $startfrom = 0, $currsize = 0 )
{
		global $db;
		global $sizelimit;
		global $startrow;
		if ( !isset( $tabledump ) )
		{
				$tabledump = "";
		}
		$offset = 100;
		if ( !$startfrom )
		{
				$tabledump = "DROP TABLE IF EXISTS ".$table.";\n";
				$query = $db->query( "SHOW CREATE TABLE ".$table );
				$create = $db->fetch_row( $query );
				$tabledump .= $create[1].";\n\n";
		}
		$tabledumped = 0;
		$numrows = $offset;
		while ( $currsize + strlen( $tabledump ) < $sizelimit * 1000 && $numrows == $offset )
		{
				$tabledumped = 1;
				$query_f = $db->query( "Select * FROM ".$table." LIMIT {$startfrom}, {$offset}" );
				$numfields = $db->num_fields( $query_f );
				$numrows = $db->num_rows( $query_f );
				while ( $row = $db->fetch_row( $query_f ) )
				{
						$comma = "";
						$tabledump .= "INSERT INTO ".$table." VALUES(";
						$i = 0;
						for ( ;	$i < $numfields;	++$i	)
						{
								$tabledump .= $comma."'".mysql_escape_string( $row[$i] )."'";
								$comma = ",";
						}
						$tabledump .= ");\n";
				}
				$startfrom += $offset;
		}
		$startrow = $startfrom;
		$tabledump .= "\n";
		return $tabledump;
}

function sqlexeup( )
{
		$sql = stripslashes( $_POST['sql'] );
		if ( trim( $sql ) != "" )
		{
				sql_execute( $sql );
		}
		addlog( "ִ��SQL���" );
		message( "����SQL����Ѿ��ɹ�������!", "?action=sqlexe", "5000" );
}

function sql_execute( $sql )
{
		global $db;
		$sqls = sql_split( $sql );
		if ( is_array( $sqls ) )
		{
				foreach ( $sqls as $sql )
				{
						if ( trim( $sql ) != "" )
						{
								$db->query( $sql );
						}
				}
		}
		else
		{
				$db->query( $sqls );
		}
		return true;
}

function sql_split( $sql )
{
		global $db;
		if ( "4.1" < $db->version( ) )
		{
				$sql = preg_replace( "/TYPE=(InnoDB|MyISAM)( DEFAULT CHARSET=[^; ]+)?/", "TYPE=\\1 DEFAULT CHARSET=GBK", $sql );
		}
		$sql = str_replace( "\r", "\n", $sql );
		$ret = array( );
		$num = 0;
		$queriesarray = explode( ";\n", trim( $sql ) );
		unset( $sql );
		foreach ( $queriesarray as $query )
		{
				$ret[$num] = "";
				$queries = explode( "\n", trim( $query ) );
				$queries = array_filter( $queries );
				foreach ( $queries as $query )
				{
						$str1 = substr( $query, 0, 1 );
						if ( !( $str1 != "#" ) && !( $str1 != "-" ) )
						{
								$ret[$num] .= $query;
						}
				}
				++$num;
		}
		return $ret;
}

function cache_write( $file, $string, $type = "array" )
{
		if ( is_array( $string ) )
		{
				$type = strtolower( $type );
				if ( $type == "array" )
				{
						$string = "<?php\n return ".var_export( $string, TRUE ).";\n?>";
				}
				else if ( $type == "constant" )
				{
						$data = "";
						foreach ( $string as $key => $value )
						{
								$data .= "define('".strtoupper( $key )."','".addslashes( $value )."');\n";
						}
						$string = "<?php\n".$data."\n?>";
				}
		}
		fsosavefile( "../dbback/".$file, $string );
}

function cache_read( $file, $mode = "i" )
{
		$cachefile = "../dbback/".$file;
		if ( !file_exists( $cachefile ) )
		{
				return array( );
		}
		if ( $mode == "i" )
		{
				return include( $cachefile );
		}
		return file_get_contents( $cachefile );
}

function cache_delete( $file )
{
		return unlink( "../dbback/".$file );
}

function fileext( $filename )
{
		return trim( substr( strrchr( $filename, "." ), 1 ) );
}

function message( $msg, $url, $ms = 1250 )
{
		echo "<script>\nvar pgo=0;\nfunction JumpUrl(){\n";
		echo "if(pgo==0){ location='".$url."'; pgo=1; }}\n";
		echo "document.write(\"<br/><div style='width:400px;margin:0px auto;padding-top:4px;height:24px;line-height: 24px;font-size:10pt;border:1px solid #cad9ea;background-color:#f5fafe;'>&nbsp;�׷������Ϸϵͳ��ʾ��Ϣ��</div>\");\ndocument.write(\"<div style='width:400px;margin:0px auto;height:100;font-size:10pt;text-align: center;border:1px solid #cad9ea;background-color:#ffffff'><br/><br/>\");\n";
		echo "document.write(\"".$msg."\");\n";
		echo "document.write(\"<br/><br/><a href='".$url."'>�����������û��Ӧ����������...</a><br/><br/></div>\");\n";
		echo "setTimeout('JumpUrl()',".$ms.");</script>\n";
		exit( );
}

function backup( )
{
		global $db;
		global $web_database;
		$size = $bktables = $bkresults = $results = array( );
		$k = 0;
		$totalsize = 0;
		$query = $db->query( "SHOW TABLES FROM ".$web_database );
		echo "<TABLE width=\"96%\" border=0 align=center cellpadding=\"5\" cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n<form method=\"post\" name=\"form\">\r\n  <TBODY>\r\n    <TR bgColor=#f5fafe>\r\n      <TD width=\"4%\" align=\"center\">&nbsp;</TD>\r\n      <TD align=\"center\">���ݱ�</TD>\r\n      <TD width=\"10%\" align=\"center\">��¼����</TD>\r\n    </TR>\r\n\t";
		while ( $r = $db->fetch_row( $query ) )
		{
				$query_f = $db->query( "Select * FROM ".$r['0'] );
				echo "    <TR bgcolor=\"#FFFFFF\">\r\n      <TD align=\"center\"><input type=\"checkbox\" name=\"tables[]\" value=\"";
				echo $r[0];
				echo "\" checked></TD>\r\n      <TD>";
				echo $r[0];
				echo "</TD>\r\n      <TD align=\"center\">";
				echo $db->num_rows( $query_f );
				echo "</TD>\r\n    </TR>\r\n\t";
		}
		echo "    <TR bgcolor=\"#FFFFFF\">\r\n      <TD align=\"center\"><input name=\"chkall\" type=\"checkbox\" id=\"chkall\" value=\"checkbox\" onClick=\"CheckAll(document.form.chkall.checked);\"/></TD>\r\n      <TD colspan=\"2\">ÿ���־��ļ���С��\r\n        <INPUT size=5 value=2048 name=sizelimit>\r\nK \r\n<input name=\"action\" type=\"hidden\" value=\"\"><input type=\"button\" name=\"del\" value=\"��ʼ����\"  onClick=\"document.form.action.value='BackupData';{if(chkCheckBoxChs('tables[]')==false){alert('������ѡ��һ�����ݱ�');return;}this.document.form.submit();return true;}\" class=inputbut></TD>\r\n      </TR>\r\n  </TBODY>\r\n  </form>\r\n</TABLE>\r\n<script language=\"javascript\" src=\"inc/movie.js\"></script>\r\n";
}

function restore( )
{
		$sqlfiles = glob( "../dbback/*.sql" );
		if ( is_array( $sqlfiles ) )
		{
				$prepre = "";
				$info = $infos = array( );
				foreach ( $sqlfiles as $id => $sqlfile )
				{
						preg_match( "/([a-z0-9_]+_[0-9]{8}_[0-9a-z]{4}_)([0-9]+)\\.sql/i", basename( $sqlfile ), $num );
						$info['filename'] = basename( $sqlfile );
						$info['filesize'] = round( filesize( $sqlfile ) / 1048576, 2 );
						$info['maketime'] = date( "Y-m-d H:i:s", filemtime( $sqlfile ) );
						$info['pre'] = $num[1];
						$info['number'] = $num[2];
						if ( !$id )
						{
								$prebgcolor = "#E4EDF9";
						}
						if ( $info['pre'] == $prepre )
						{
								$info['bgcolor'] = $prebgcolor;
						}
						else
						{
								$info['bgcolor'] = $prebgcolor == "#E4EDF9" ? "#FFFFFF" : "#E4EDF9";
						}
						$prebgcolor = $info['bgcolor'];
						$prepre = $info['pre'];
						$infos[] = $info;
				}
		}
		echo "<TABLE width=\"96%\" border=0 align=center cellpadding=\"5\" cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n<form method=\"post\" name=\"form\">\r\n  <TBODY>\r\n    <TR bgColor=#f5fafe>\r\n      <TD width=\"4%\" align=\"center\">&nbsp;</TD>\r\n\t  <TD align=\"center\">�ļ���</TD>\r\n\t  <TD align=\"center\">�ļ���С</TD>\r\n\t  <TD align=\"center\">����ʱ��</TD>\r\n\t  <TD align=\"center\">���</TD>\r\n      <TD width=\"10%\" align=\"center\">��¼����</TD>\r\n    </TR>\r\n\t";
		if ( is_array( $infos ) )
		{
				foreach ( $infos as $info )
				{
						echo "  <tr bgcolor=\"";
						echo $info['bgcolor'];
						echo "\"  align=\"center\">\r\n    <td><input type=\"checkbox\" name=\"filenames[]\" value=\"";
						echo $info['filename'];
						echo "\"></td>\r\n    <td>";
						echo $info['filename'];
						echo "</td>\r\n    <td>";
						echo $info['filesize'];
						echo " M</td>\r\n\t<td>";
						echo $info['maketime'];
						echo "</td>\r\n    <td>";
						echo $info['number'];
						echo "</td>\r\n    <td>\r\n\t<a href=\"?action=RestoreData&pre=";
						echo $info['pre'];
						echo "\">����</a> | \r\n\t<a href=\"?action=delback&filenames=";
						echo $info['filename'];
						echo "\">ɾ��</a>\r\n\t</td>\r\n</tr>\r\n";
				}
		}
		echo "\r\n    <TR align=\"center\" bgcolor=\"#FFFFFF\">\r\n      <TD colspan=\"6\"><font color=\"#ff0000\">����ɫ��ͬ���ļ�Ϊͬһ�α��ݵ��ļ�,����ʱֻ��Ҫ�㵼������һ���ļ�,������Զ�����ʣ���ļ�</font></TD>\r\n      </TR>\r\n    <TR bgcolor=\"#FFFFFF\">\r\n      <TD align=\"center\"><input name=\"chkall\" type=\"checkbox\" id=\"chkall\" value=\"checkbox\" onClick=\"CheckAll(document.form.chkall.checked);\"/></TD>\r\n      <TD colspan=\"5\"><input name=\"action\" type=\"hidden\" value=\"\"><input type=\"button\" name=\"delback\" value=\"ɾ������\"  onClick=\"document.form.action.value='delback';{if(chkCheckBoxChs('filenames[]')==false){alert('������ѡ��һ�����ݱ��ݣ�');return;}this.document.form.submit();return true;}\" class=inputbut></TD>\r\n      </TR>\r\n  </TBODY>\r\n  </form>\r\n</TABLE>\r\n<script language=\"javascript\" src=\"inc/movie.js\"></script>\r\n";
}

function compactd( )
{
		echo "<TABLE width=\"96%\" border=0 align=center cellpadding=\"5\" cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n<form method=\"post\" name=\"form\">\r\n  <TBODY>\r\n    <TR bgColor=#f5fafe>\r\n      <TD width=\"4%\" align=\"center\">&nbsp;</TD>\r\n      <TD align=\"center\">���ݱ�</TD>\r\n    </TR>\r\n\t";
		global $db;
		global $web_database;
		$query = $db->query( "SHOW TABLES FROM ".$web_database );
		while ( $r = $db->fetch_row( $query ) )
		{
				echo "    <TR bgcolor=\"#FFFFFF\">\r\n      <TD align=\"center\"><input type=\"checkbox\" name=\"tables[]\" value=\"";
				echo $r[0];
				echo "\" checked></TD>\r\n      <TD>";
				echo $r[0];
				echo "</TD>\r\n    </TR>\r\n\t\t";
		}
		echo "    <TR bgcolor=\"#FFFFFF\">\r\n      <TD align=\"center\"><input name=\"chkall\" type=\"checkbox\" id=\"chkall\" value=\"checkbox\" onClick=\"CheckAll(document.form.chkall.checked);\"/></TD>\r\n      <TD><input name=\"action\" type=\"hidden\" value=\"\">\r\n\t  <INPUT type=radio value=repair name=operation>�޸���\r\n\t  <INPUT name=operation type=radio value=optimize checked>\r\n\t  �Ż���\r\n\t  <input type=\"button\" name=\"CompactData\" value=\"�ύ\"  onClick=\"document.form.action.value='CompactData';{if(chkCheckBoxChs('tables[]')==false){alert('������ѡ��һ�����ݱ�');return;}this.document.form.submit();return true;}\" class=inputbut></TD>\r\n    </TR>\r\n  </TBODY>\r\n  </form>\r\n</TABLE>\r\n<script language=\"javascript\" src=\"inc/movie.js\"></script>\r\n";
}

function sqlexe( )
{
		echo "<TABLE width=\"96%\" border=0 align=center cellpadding=\"5\" cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n<form action=\"?action=sqlexeup\" method=\"post\" name=\"form\" onSubmit=\"return Validator.Validate(this,3)\">\r\n  <TBODY>\r\n    <TR bgColor=#f5fafe>\r\n      <TD align=\"center\">ִ��SQL</TD>\r\n      </TR>\r\n    <TR bgcolor=\"#FFFFFF\">\r\n      <TD align=\"center\"><TEXTAREA name=sql rows=16 style=\"width:100%;\" dataType=\"Require\" msg=\"����дsql���\"></TEXTAREA></TD>\r\n      </TR>\r\n    <TR bgcolor=\"#FFFFFF\">\r\n      <TD align=\"center\"><input type=\"submit\" name=\"sqlexe\" value=\"�ύ\" class=inputbut></TD>\r\n      </TR>\r\n  </TBODY>\r\n  </form>\r\n</TABLE>\r\n<script language=\"javascript\" src=\"inc/js.js\"></script>\r\n";
}

set_time_limit( 0 );
include_once( dirname( __FILE__ )."/../inc/conn.php" );
include_once( dirname( __FILE__ )."/inc/function.php" );
login_check( "admingl" );
echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd\">\r\n<HTML xmlns=\"http://www.w3.org/1999/xhtml\">\r\n<HEAD>\r\n<TITLE>���ݿ����--�׷������Ϸϵͳ</TITLE>\r\n<META http-equiv=Content-Type content=\"text/html; charset=gb2312\">\r\n<LINK href=\"images/css_body.css\" type=text/css rel=stylesheet>\r\n<META content=\"MSHTML 6.00.3790.4275\" name=GENERATOR>\r\n</HEAD>\r\n<BODY>\r\n<DIV class=bodytitle>\r\n<DIV class=bodytitleleft></DIV>\r\n<DIV class=bodytitletxt>���ݿ����</DIV>\r\n<DIV class=bodytitletxt2><a href=\"?action=Restore\">��ԭ���ݿ�</a> | <a href=\"?action=Backup\">�������ݿ�</a> | <a href=\"?action=Compact\">�Ż�/�޸����ݿ�</a></DIV>\r\n</DIV>\r\n";
$action = $_REQUEST['action'];
switch ( $action )
{
case "Backup" :
		backup( );
		break;
case "BackupData" :
		backupdata( );
		break;
case "Compact" :
		compactd( );
		break;
case "CompactData" :
		compactdata( );
		break;
case "Restore" :
		restore( );
		break;
case "RestoreData" :
		restoredata( );
		break;
case "delback" :
		delbackup( );
		break;
case "sqlexe" :
		sqlexe( );
		break;
case "sqlexeup" :
		sqlexeup( );
		break;
default :
		showerr( "�������", "admin_dbback.asp?action=Backup" );
}
echo "</BODY>\r\n</HTML>\r\n";
?>
