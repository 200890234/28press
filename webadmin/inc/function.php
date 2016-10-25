<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/

function showerr( $msg, $url )
{
		echo "<script>\n";
		echo "var pgo=0;\n";
		echo "function JumpUrl(){\n";
		echo "if(pgo==0){ location='".$url."'; pgo=1; }}\n";
		echo "document.write(\"<br/><div style='width:400px;margin:0px auto;padding-top:4px;height:24px;line-height: 24px;font-size:10pt;border:1px solid #cad9ea;background-color:#f5fafe;'>&nbsp;雷风积分游戏系统提示信息：</div>\");\n";
		echo "document.write(\"<div style='width:400px;margin:0px auto;height:100;font-size:10pt;text-align: center;border:1px solid #cad9ea;background-color:#ffffff'><br/><br/>\");\n";
		echo "document.write(\"".$msg."\");\n";
		echo "document.write(\"<br/><br/><a href='".$url."'>如果你的浏览器没反应，请点击这里...</a><br/><br/></div>\");\n";
		echo "setTimeout('JumpUrl()',5000);</script>\n";
		exit( );
}

function login_check( $groupname )
{
		global $db;
		global $web_dbtop;
		if ( empty( $_COOKIE['AdminName'] ) || empty( $_COOKIE['PassWord'] ) )
		{
				echo "<script>top.location.href='admin_login.php';</script>";
				exit( );
		}
		else
		{
				$query = $db->query( "Select groupbox From {$web_dbtop}admin where name='".str_check( $_COOKIE['AdminName'] )."' And password='".str_check( $_COOKIE['PassWord'] )."'" );
				if ( !( $rs = $db->fetch_array( $query ) ) )
				{
						echo "<script>top.location.href='admin_login.php';</script>";
						exit( );
				}
				else if ( !stristr( $rs['groupbox'].",", $groupname."," ) && $groupname != 1 )
				{
						echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd\">\r\n";
						echo "<HTML xmlns=\"http://www.w3.org/1999/xhtml\">\r\n";
						echo "<HEAD>\r\n";
						echo "<TITLE>雷风积分游戏系统</TITLE>\r\n";
						echo "<META http-equiv=Content-Type content=\"text/html; charset=gb2312\">\r\n";
						echo "<LINK href=\"images/css_body.css\" type=text/css rel=stylesheet>\r\n";
						echo "<META content=\"MSHTML 6.00.3790.4275\" name=GENERATOR>\r\n";
						echo "</HEAD>\r\n";
						echo "<BODY>\r\n";
						showerr( "对不起,您没有权限对该项目进行操作", "admin_index.php" );
						echo "</BODY></HTML>";
				}
		}
}

function usersip( )
{
		if ( getenv( "HTTP_CLIENT_IP" ) )
		{
				$ip = getenv( "HTTP_CLIENT_IP" );
		}
		else if ( getenv( "HTTP_X_FORWARDED_FOR" ) )
		{
				$ip = getenv( "HTTP_X_FORWARDED_FOR" );
		}
		else if ( getenv( "HTTP_X_FORWARDED" ) )
		{
				$ip = getenv( "HTTP_X_FORWARDED" );
		}
		else if ( getenv( "HTTP_FORWARDED_FOR" ) )
		{
				$ip = getenv( "HTTP_FORWARDED_FOR" );
		}
		else if ( getenv( "HTTP_FORWARDED" ) )
		{
				$ip = getenv( "HTTP_FORWARDED" );
		}
		else
		{
				$ip = $_SERVER['REMOTE_ADDR'];
		}
		return $ip;
}

function addlog( $content )
{
		global $db;
		global $web_dbtop;
		$AdminName = $_POST['userid'] ? $_POST['userid'] : $_COOKIE['AdminName'];
		$db->query( "INSERT INTO {$web_dbtop}log (logcontent,logtime,logname,logip) VALUES ('".$content."','".date( "Y-m-d H:i:s" )."','".$AdminName."','".usersip( )."')" );
}

function fsosavefile( $file, $content, $mode = "w" )
{
		$fp = fopen( $file, $mode );
		if ( !$fp )
		{
				return false;
		}
		fwrite( $fp, $content );
		fclose( $fp );
		return true;
}

function fsosaveder( $path )
{
		if ( !file_exists( $path ) )
		{
				fsosaveder( dirname( $path ) );
				mkdir( $path, 511 );
		}
}

function deldir( $dir )
{
		$dh = opendir( $dir );
		while ( $file = readdir( $dh ) )
		{
				if ( $file != "." && $file != ".." )
				{
						$fullpath = $dir."/".$file;
						if ( !is_dir( $fullpath ) )
						{
								unlink( $fullpath );
						}
						else
						{
								deldir( $fullpath );
						}
				}
		}
		closedir( $dh );
		if ( rmdir( $dir ) )
		{
				return true;
		}
		else
		{
				return false;
		}
}

function deletefile( $deldir )
{
		@unlink( $deldir );
		return true;
}

function showselect( $tables, $tablesname, $selectname, $selecttitle, $selectid )
{
		global $db;
		global $web_dbtop;
		echo "<select name=\"{$selectname}\" dataType=\"Require\" msg=\"{$selecttitle}\">";
		if ( $selectid == "" )
		{
				echo "<option value=\"\">{$selecttitle}</option>";
		}
		$query = $db->query( "Select * FROM {$web_dbtop}{$tables} Order by sort asc,id desc" );
		while ( $rs = $db->fetch_array( $query ) )
		{
				if ( $selectid )
				{
						if ( $rs_f['id'] == intval( $selectid ) )
						{
								echo "<option value=".$rs['id']." selected>".$rs[$tablesname]."</option>";
						}
						else
						{
								echo "<option value=".$rs['id'].">".$rs[$tablesname]."</option>";
						}
				}
				else
				{
						echo "<option value=".$rs['id'].">".$rs[$tablesname]."</option>";
				}
		}
		echo "</select>";
}

function showcontent( $tables, $tablesname, $id )
{
		global $db;
		global $web_dbtop;
		$query = $db->query( "Select {$tablesname} from {$web_dbtop}{$tables} where id={$id}" );
		if ( $rs = $db->fetch_array( $query ) )
		{
				return $rs[$tablesname];
		}
}

function showstars( $num )
{
		$starthreshold = 3;
		$alt = "alt=\"等级: ".$num."级\"";
		if ( empty( $starthreshold ) )
		{
				$i = 0;
				for ( ;	$i < $num;	++$i	)
				{
						echo "<img src=\"../images/score/1.gif\" ".$alt." />";
				}
		}
		else
		{
				$i = 6;
				for ( ;	0 < $i;	--$i	)
				{
						$numlevel = intval( $num / pow( $starthreshold, $i - 1 ) );
						$num %= pow( $starthreshold, $i - 1 );
						$j = 0;
						for ( ;	$j < $numlevel;	++$j	)
						{
								echo "<img src=\"../images/score/".$i.".gif\" ".$alt." />";
						}
				}
		}
}

function cardtypeselect( )
{
		global $db;
		global $web_dbtop;
		echo "<select name=\"cardtype\" dataType=\"Require\" msg=\"请选择充值卡类型\">";
		echo "<option value=\"\">请选择充值卡类型</option>";
		$query = $db->query( "Select * FROM {$web_dbtop}cardtype Order by id desc" );
		while ( $rs = $db->fetch_array( $query ) )
		{
				echo "<option value=".$rs['id'].">".$rs['cardname']."</option>";
		}
		echo "</select>";
}

function businessselect( )
{
		global $db;
		global $web_dbtop;
		echo "<select name=\"businessid\" dataType=\"Require\" msg=\"请选择所属商户\">";
		echo "<option value=\"\">选择商户</option>";
		$query = $db->query( "Select * FROM {$web_dbtop}business Order by id desc" );
		while ( $rs = $db->fetch_array( $query ) )
		{
				echo "<option value=".$rs['id'].">".$rs['name']."</option>";
		}
		echo "</select>";
}

function userslive( $experience )
{
		global $db;
		global $web_dbtop;
		$query = $db->query( "Select stars from {$web_dbtop}usergroups where creditshigher<={$experience} and creditslower>={$experience} Order by id desc" );
		if ( $rs = $db->fetch_array( $query ) )
		{
				return $rs['stars'];
		}
}

function userslog( $logtype, $log, $points, $experience, $usersid )
{
		global $db;
		global $web_dbtop;
		$db->query( "INSERT INTO {$web_dbtop}userslog (time,logtype,log,points,experience,usersid) VALUES ('".date( "Y-m-d H:i:s" )."',".intval( $logtype ).",'".str_check( $log )."',".intval( $points ).",".intval( $experience ).",".intval( $usersid ).")" );
}

function showid( $id )
{
		global $db;
		global $web_dbtop;
		$query = $db->query( "Select id from {$web_dbtop}users where email='".$id."'" );
		if ( $rs = $db->fetch_array( $query ) )
		{
				return $rs['id'];
		}
}

function addtypeid( $typeid, $selectname )
{
		global $db;
		global $web_dbtop;
		echo "<select name=".$selectname." id=".$selectname.">";
		if ( $typeid )
		{
				$query = $db->query( "Select id,name from {$web_dbtop}ctype where id=".$typeid );
				if ( $rs = $db->fetch_array( $query ) )
				{
						echo "<option value='".$rs['id']."'>".$rs['name']."</option>";
				}
		}
		else
		{
				echo "<option value=\"0\">做为一级分类</option>";
		}
		echo "</select>";
}

function showtype( $typeid, $id )
{
		global $db;
		global $web_dbtop;
		$query = $db->query( "Select * from {$web_dbtop}ctype where typeid=".$typeid." Order by sort asc,id desc" );
		while ( $rs = $db->fetch_array( $query ) )
		{
				if ( $rs['id'] == $id )
				{
						$content .= "<option value=\"".$rs['id']."\" selected>";
				}
				else
				{
						$content .= "<option value=\"".$rs['id']."\">";
				}
				if ( $rs['typeid'] != 0 )
				{
						$content .= "├--".$rs['name'];
				}
				else
				{
						$content .= $rs['name'];
				}
				$content .= "</option>\r\n";
				$content .= showtype( $rs['id'], $id );
		}
		unset( $db );
		return $content;
}

function selecturl( $id )
{
		global $db;
		global $web_dbtop;
		$query = $db->query( "Select * from {$web_dbtop}ctype where typeid=0 Order by sort asc,id desc" );
		while ( $rs = $db->fetch_array( $query ) )
		{
				echo "<OPTION value=\"admin_commodities.php?typeid=".$rs['id']."\" ".( $id == $rs['id'] ? "selected" : "" ).">".$rs['name']."</OPTION>";
				$query_f = $db->query( "Select * from {$web_dbtop}ctype where typeid=".$rs['id']." Order by sort asc,id desc" );
				while ( $rs_f = $db->fetch_array( $query_f ) )
				{
						echo "<OPTION value=\"admin_commodities.php?typeid=".$rs_f['id']."\" ".( $id == $rs_f['id'] ? "selected" : "" ).">├--".$rs_f['name']."</OPTION>";
				}
		}
}

function edittype( $id )
{
		global $db;
		global $web_dbtop;
		$query = $db->query( "Select * from {$web_dbtop}ctype where typeid=0 Order by sort asc,id desc" );
		if ( $id == 0 )
		{
				$content .= "<option value=\"0\" selected>一级分类";
		}
		else
		{
				$content .= "<option value=\"0\">一级分类";
		}
		while ( $rs = $db->fetch_array( $query ) )
		{
				if ( $rs['id'] == $id )
				{
						$content .= "<option value=\"".$rs['id']."\" selected>".$rs['name'];
				}
				else
				{
						$content .= "<option value=\"".$rs['id']."\">".$rs['name'];
				}
				$content .= "</option>\r\n";
		}
		unset( $db );
		return $content;
}

function getchildnewslist( $typeid )
{
		global $db;
		global $web_dbtop;
		$query = $db->query( "Select * from {$web_dbtop}ctype where typeid=".$typeid." Order by sort asc,id desc" );
		while ( $rs = $db->fetch_array( $query ) )
		{
				$content .= "<tr bgcolor=\"#FFFFFF\" onMouseOver=\"this.bgColor='#f5fafe'\" onMouseOut=\"this.bgColor='#FFFFFF'\">\r\n";
				$content .= "<td><input name=\"id[]\" type=\"checkbox\" id=\"id[]\" value=\"".$rs['id']."\" checked></td>\r\n";
				$content .= "<td>&nbsp;<img src=\"images/L.gif\"></img><INPUT id=\"name_".$rs['id']."\" size=30 name=\"name_".$rs['id']."\" value=\"".$rs['name']."\"></td>\r\n";
				$content .= "<td align=\"center\"><select name=\"typeid_".$rs['id']."\" id=\"typeid_".$rs['id']."\">".edittype( $rs['typeid'] )."</select></td>\r\n";
				$content .= "<td align=\"center\"><INPUT id=\"sort_".$rs['id']."\" size=5 name=\"sort_".$rs['id']."\" value=\"".$rs['sort']."\"></td>\r\n";
				$content .= "<td align=\"center\"><a href=\"admin_ctype.php?id=".$rs['id']."&action=del\">删除</a></td>\r\n";
				$content .= "</tr>\r\n";
		}
		return $content;
}

function createrandstring( $length, $type )
{
		$hash = "";
		$chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
		switch ( $type )
		{
		case 0 :
				$max = 9;
				break;
		case 1 :
				$max = 35;
				break;
		case 2 :
				$max = strlen( $chars ) - 1;
				break;
		default :
				$max = 9;
				break;
		}
		$i = 0;
		for ( ;	$i < $length;	++$i	)
		{
				$hash .= $chars[mt_rand( 0, $max )];
		}
		return $hash;
}

function dodgejg( $pk, $ww )
{
		if ( $pk - $ww == -1 || $pk - $ww == 2 )
		{
				return 1;
		}
		else if ( $pk - $ww == 1 || $pk - $ww == -2 )
		{
				return 2;
		}
		else
		{
				return 3;
		}
}
?>
