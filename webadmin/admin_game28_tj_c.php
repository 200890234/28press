<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/

function sdadd( )
{
				global $db;
				global $web_dbtop;
				if ( $_POST['id'] )
				{
								$db->query( "update ".$web_dbtop."game_kg set NO=".intval( $_POST['NO'] ).",type=28,num1=".intval( $_POST['num1'] ).",num2=".intval( $_POST['num2'] ).",num3=".intval( $_POST['num3'] ).( " where id=".$_POST['id'] ) );
				}
				else
				{
								$db->query( "INSERT INTO ".$web_dbtop."game_kg (NO,type,num1,num2,num3) VALUES (".intval( $_POST['NO'] ).",28,".intval( $_POST['num1'] ).",".intval( $_POST['num2'] ).",".intval( $_POST['num3'] ).")" );
				}
}

function tz( )
{
				global $db;
				global $web_dbtop;
				global $web_moneyname;
				echo "<TABLE width=\"98%\" border=0 align=center cellpadding=0 cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n  <TBODY>\r\n    <TR>\r\n      <TD bgColor=#f5fafe><table width=\"96%\" border=\"0\" align=\"center\" cellpadding=\"3\" cellspacing=\"1\">\r\n          <tr>\r\n            <form action=\"admin_game28_tj_c.php\" method=\"get\">\r\n              <td width=\"30%\"><strong>搜索用户：</strong></td>\r\n              <td width=\"35%\"><input name=\"action\" type=\"hidden\" value=\"";
				echo $_GET['action'];
				echo "\"><input name=\"NO\" type=\"hidden\" value=\"";
				echo $_GET['NO'];
				echo "\"><input id=\"uid\" size=20 name=\"uid\"></td>\r\n              <td align=\"center\"><INPUT class=inputbut type=submit value=搜索 name=Submit></td>\r\n            </form>\r\n          </tr>\r\n      </table></TD>\r\n    </TR>\r\n  </TBODY>\r\n</TABLE>\r\n<TABLE width=\"98%\" border=0 align=center cellpadding=\"5\" cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n  <TBODY>\r\n    <TR bgColor=\"#f5fafe\">\r\n      <TD width=\"30%\" align=\"center\">用户ID</TD>\r\n      <TD width=\"25%\" align=\"center\">投注";
				echo $web_moneyname;
				echo "</TD>\r\n      <TD width=\"25%\" align=\"center\">获得";
				echo $web_moneyname;
				echo "</TD>\r\n      <TD width=\"20%\" align=\"center\">操作</TD>\r\n    </TR>\r\n    ";
				$query = $db->query( "Select kj from ".$web_dbtop."game28 where id=".intval( $_GET['NO'] ) );
				if ( $rs = $db->fetch_array( $query ) )
				{
								$kj = $rs['kj'];
				}
				$intpage = 20;
				if ( isset( $_GET['page'] ) )
				{
								$rsnum = ( $_GET['page'] - 1 ) * $intpage;
				}
				else
				{
								$rsnum = 0;
				}
				if ( $kj == 1 )
				{
								$sql = "Select uid from ".$web_dbtop."game28_users_tz where NO=".intval( $_GET['NO'] );
				}
				else
				{
								$sql = "Select distinct uid from ".$web_dbtop."game28_kg_users_tz where NO=".intval( $_GET['NO'] );
				}
				if ( isset( $_GET['uid'] ) )
				{
								$sql .= " and uid=".intval( $_GET['uid'] );
				}
				$query = $db->query( $sql." Order by id desc" );
				if ( $db->fetch_array( $query ) )
				{
								$intnum = $db->num_rows( $query );
				}
				$query = $db->query( $sql.( " Order by id desc limit ".$rsnum.",{$intpage}" ) );
				while ( $rs = $db->fetch_array( $query ) )
				{
								if ( $kj == 1 )
								{
												$query_f = $db->query( "Select points as tzpoints,hdpoints from ".$web_dbtop."game28_users_tz where NO=".intval( $_GET['NO'] )." and uid=".$rs['uid'] );
								}
								else
								{
												$query_f = $db->query( "Select sum(tzpoints)as tzpoints,sum(hdpoints)as hdpoints from ".$web_dbtop."game28_kg_users_tz where NO=".intval( $_GET['NO'] )." and uid=".$rs['uid'] );
								}
								if ( $rs_f = $db->fetch_array( $query_f ) )
								{
												$tzpoints = $rs_f['tzpoints'];
												$hdpoints = $rs_f['hdpoints'];
								}
								echo "    <TR bgcolor=\"#FFFFFF\">\r\n      <TD align=\"center\">";
								echo $rs['uid'];
								echo "</TD>\r\n      <TD align=\"center\">";
								echo $tzpoints;
								echo "</TD>\r\n      <TD align=\"center\">";
								echo $hdpoints;
								echo "</TD>\r\n      <TD align=\"center\"><a href=\"#\" onclick=\"parent.AddWin('W_";
								echo $_GET['NO'];
								echo "_";
								echo $rs['uid'];
								echo "','";
								echo $_GET['NO'];
								echo "期用户";
								echo $rs['uid'];
								echo "投注详情','admin_game28_tj_c.php?action=utz&NO=";
								echo $_GET['NO'];
								echo "&uid=";
								echo $rs['uid'];
								echo "',480,350,0);return false\">投注详情</a></TD>\r\n    </TR>\r\n    ";
				}
				echo "    <TR align=\"center\" bgcolor=\"#f8fbfb\">\r\n      <TD colspan=\"4\">";
				include_once( dirname( __FILE__ )."/../inc/page_class.php" );
				$page = new page( array(
								"total" => $intnum,
								"perpage" => $intpage
				) );
				echo $page->show( 4, "page", "curr" );
				echo "</TD>\r\n    </TR>\r\n  </TBODY>\r\n</TABLE>\r\n";
}

function utz( )
{
				global $db;
				global $web_dbtop;
				global $web_moneyname;
				echo "<TABLE width=\"98%\" border=0 align=center cellpadding=\"5\" cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n  <TBODY>\r\n    <TR bgColor=\"#f5fafe\">\r\n      <TD width=\"20%\" align=\"center\">投注号码</TD>\r\n      <TD width=\"25%\" align=\"center\">投注";
				echo $web_moneyname;
				echo "</TD>\r\n      <TD width=\"25%\" align=\"center\">赔率</TD>\r\n      <TD align=\"center\">获得";
				echo $web_moneyname;
				echo "</TD>\r\n    </TR>\r\n        ";
				$query = $db->query( "Select zjpl,kj from ".$web_dbtop."game28 where id=".intval( $_GET['NO'] ) );
				if ( $rs = $db->fetch_array( $query ) )
				{
								$zjpl = $rs['zjpl'];
								$kj = $rs['kj'];
				}
				$zjplsz = explode( "|", $zjpl );
				if ( $kj == 1 )
				{
								$query = $db->query( "Select tznum,tzpoints,zjpoints from ".$web_dbtop."game28_users_tz where NO=".intval( $_GET['NO'] )." and uid=".intval( $_GET['uid'] )." Order by id desc" );
								if ( $rs = $db->fetch_array( $query ) )
								{
												$tznum_array = explode( "|", $rs['tznum'] );
												$tzpoints_array = explode( "|", $rs['tzpoints'] );
												$zjpoints_array = explode( "|", $rs['zjpoints'] );
												$i = 0;
												for (;$i < count( $tznum_array );++$i)
																{
																				echo "\t\t\t<TR bgcolor=\"#FFFFFF\">\r\n\t\t\t  <TD align=\"center\">";
																				echo $tznum_array[$i];
																				echo "</TD>\r\n\t\t\t  <TD align=\"center\">";
																				echo $tzpoints_array[$i];
																				echo "</TD>\r\n\t\t\t  <TD align=\"center\">";
																				echo $zjplsz[$tznum_array[$i]];
																				echo "</TD>\r\n\t\t\t  <TD align=\"center\">";
																				echo $zjpoints_array[$i];
																				echo "</TD>\r\n\t\t\t</TR>\r\n\t\t\t";
																				break;
																
												} while ( 1 );
								}
				}
				else
				{
								$query = $db->query( "Select tznum,tzpoints,hdpoints from ".$web_dbtop."game28_kg_users_tz where NO=".intval( $_GET['NO'] )." and uid=".intval( $_GET['uid'] )." Order by id desc" );
								while ( $rs = $db->fetch_array( $query ) )
								{
												echo "    <TR bgcolor=\"#FFFFFF\">\r\n      <TD align=\"center\">";
												echo $rs['tznum'];
												echo "</TD>\r\n      <TD align=\"center\">";
												echo $rs['tzpoints'];
												echo "</TD>\r\n      <TD align=\"center\">";
												echo $zjplsz[$rs['tznum']];
												echo "</TD>\r\n\t  <TD align=\"center\">";
												echo $rs['hdpoints'];
												echo "</TD>\r\n    </TR>\r\n    ";
								}
				}
				echo "  </TBODY>\r\n</TABLE>\r\n";
}

function sd( )
{
				global $db;
				global $web_dbtop;
				$query = $db->query( "Select * from ".$web_dbtop."game_kg where type=28 and NO=".intval( $_GET['NO'] ) );
				if ( $rs = $db->fetch_array( $query ) )
				{
								$id = $rs['id'];
								$num1 = $rs['num1'];
								$num2 = $rs['num2'];
								$num3 = $rs['num3'];
				}
				echo "<TABLE width=\"98%\" border=0 align=center cellpadding=\"4\" cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n  <form action=\"?action=sdadd\" method=\"post\" onSubmit=\"return Validator.Validate(this,3)\">\r\n    <input name=\"id\" type=\"hidden\" value=\"";
				echo $id;
				echo "\">\r\n\t<input name=\"NO\" type=\"hidden\" value=\"";
				echo intval( $_GET['NO'] );
				echo "\">\r\n    <TBODY>\r\n      <TR>\r\n        <TD vAlign=center width=\"40%\" bgColor=#f5fafe>开奖号1：</TD>\r\n        <TD bgColor=#ffffff><INPUT id=\"num1\" size=20 value=\"";
				echo $num1;
				echo "\" name=\"num1\" dataType=\"Range\" min=\"-1\" max=\"10\" msg=\"请在0-9之间\"></TD>\r\n      </TR>\r\n      <TR>\r\n        <TD vAlign=center bgColor=#f5fafe>开奖号2：</TD>\r\n        <TD bgColor=#ffffff><INPUT id=\"num2\" size=20 value=\"";
				echo $num2;
				echo "\" name=\"num2\" dataType=\"Range\" min=\"-1\" max=\"10\" msg=\"请在0-9之间\"></TD>\r\n      </TR>\r\n      <TR>\r\n        <TD bgColor=#f5fafe>开奖号3：</TD>\r\n        <TD bgColor=#ffffff><INPUT id=\"num3\" size=20 value=\"";
				echo $num3;
				echo "\" name=\"num3\" dataType=\"Range\" min=\"-1\" max=\"10\" msg=\"请在0-9之间\"></TD>\r\n      </TR>\r\n      <TR align=\"center\" bgcolor=\"#f8fbfb\">\r\n        <TD colspan=\"2\"><INPUT class=inputbut type=submit value=提交 name=Submit></TD>\r\n      </TR>\r\n    </TBODY>\r\n  </form>\r\n</TABLE>\r\n<script language=\"javascript\" src=\"inc/js.js\"></script>\r\n";
}

include_once( dirname( __FILE__ )."/../inc/conn.php" );
include_once( dirname( __FILE__ )."/inc/function.php" );
login_check( "gametj" );
echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd\">\r\n<HTML xmlns=\"http://www.w3.org/1999/xhtml\">\r\n<HEAD>\r\n<TITLE>幸运28统计--雷风积分游戏系统</TITLE>\r\n<META http-equiv=Content-Type content=\"text/html; charset=gb2312\">\r\n<LINK href=\"images/css_body.css\" type=\"text/css\" rel=\"stylesheet\">\r\n</HEAD>\r\n<BODY>\r\n";
switch ( $_GET['action'] )
{
case "utz" :
				utz( );
				break;
case "tz" :
				tz( );
				break;
case "sd" :
				sd( );
				break;
case "sdadd" :
				sdadd( );
				addlog( "手动干预幸运28第".intval( $_POST['NO'] )."期 开奖结果" );
				echo "<script language=javascript>alert(\"手动干预幸运28第".intval( $_POST['NO'] )."期 开奖结果\");parent.AddClose(\"NewW_S_".intval( $_POST['NO'] )."\");</script>";
}
?>
