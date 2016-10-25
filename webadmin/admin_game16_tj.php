<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/

function del( )
{
				global $db;
				global $web_dbtop;
				$id = implode( ",", $_POST['id'] );
				$query = $db->query( "Select * from ".$web_dbtop."game16_users_tz where NO in ({$id})" );
				while ( $rs = $db->fetch_array( $query ) )
				{
								$db->query( "update ".$web_dbtop."users set points=points-".$rs['hdpoints']."+".$rs['points']." where id=".$rs['uid'] );
								$db->query( "update ".$web_dbtop."game_log set game16_hd=game16_hd-".$rs['hdpoints']."+".$rs['points']." where uid=".$rs['uid'] );
				}
				$db->query( "delete from ".$web_dbtop."game16_users_tz where NO in ({$id})" );
				$db->query( "delete from ".$web_dbtop."game16 where id in ({$id})" );
}

function main( )
{
				global $db;
				global $web_dbtop;
				global $web_moneyname;
				echo "<TABLE width=\"96%\" border=0 align=center cellpadding=\"5\" cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n<form action=\"\" name=\"form\" method=\"post\">\r\n  <TBODY>\r\n    <TR bgColor=\"#f5fafe\">\r\n\t  <TD width=\"4%\" align=\"center\">&nbsp;</TD>\r\n      <TD width=\"10%\" align=\"center\">期号</TD>\r\n      <TD width=\"11%\" align=\"center\">开奖时间</TD>\r\n      <TD width=\"13%\" align=\"center\">开奖结果</TD>\r\n      <TD width=\"8%\" align=\"center\">中奖人数</TD>\r\n      <TD width=\"12%\" align=\"center\">投注总数</TD>\r\n\t  <TD width=\"12%\" align=\"center\">中奖总数</TD>\r\n      <TD width=\"10%\" align=\"center\">自动/手动</TD>\r\n      <TD width=\"10%\" align=\"center\">抽取";
				echo $web_moneyname;
				echo "数</TD>\r\n\t  <TD width=\"12%\" align=\"center\">操作</TD>\r\n    </TR>\r\n    ";
				$intpage = 20;
				if ( isset( $_GET['page'] ) )
				{
								$rsnum = ( $_GET['page'] - 1 ) * $intpage;
				}
				else
				{
								$rsnum = 0;
				}
				$query = $db->query( "Select * from ".$web_dbtop."game16 Order by id desc" );
				if ( $db->fetch_array( $query ) )
				{
								$intnum = $db->num_rows( $query );
				}
				$query = $db->query( "Select *,(select sum(hdpoints) from ".$web_dbtop."game16_users_tz where NO=a.id) as hdpoints from {$web_dbtop}game16 as a Order by id desc limit {$rsnum},{$intpage}" );
				while ( $rs = $db->fetch_array( $query ) )
				{
								$kgh = explode( "|", $rs['kgjg'] );
								echo "    <TR bgcolor=\"#FFFFFF\">\r\n\t  <TD align=\"center\"><input name=\"id[]\" type=\"checkbox\" id=\"id[]\" value=\"";
								echo $rs['id'];
								echo "\"></TD>\r\n      <TD align=\"center\">";
								echo $rs['id'];
								echo "</TD>\r\n      <TD align=\"center\">";
								echo date( "m-d H:i", strtotime( $rs['kgtime'] ) );
								echo "</TD>\r\n      <TD align=\"center\">";
								if ( $rs['kj'] == 1 )
								{
												echo $kgh[0]." + ".$kgh[1]." + ".$kgh[2]." = ".$kgh[3];
								}
								else
								{
												echo "未开奖";
								}
								echo "</TD>\r\n      <TD align=\"center\">";
								echo $rs['zjrnum'];
								echo "</TD>\r\n\t  <TD align=\"center\">";
								echo number_format( $rs['tzpoints'] );
								echo "</TD>\r\n      <TD align=\"center\">";
								echo number_format( $rs['hdpoints'] );
								echo "</TD>\r\n      <TD align=\"center\">";
								echo $rs['zdtz'];
								echo " / ";
								echo $rs['sdtz'];
								echo "</TD>\r\n      <TD align=\"center\">";
								echo $rs['kj'] == 1 ? number_format( $rs['tzpoints'] - $rs['hdpoints'] ) : 0;
								echo "</TD>\r\n\t  <TD align=\"center\"><a href=\"#\" onclick=\"AddWin('W_";
								echo $rs['id'];
								echo "','";
								echo $rs['id'];
								echo "期 投注详情','admin_game16_tj_c.php?action=tz&NO=";
								echo $rs['id'];
								echo "',480,300,0);return false\"><img src=\"images/DocumentMapReadingView.gif\" alt=\"查看投注\"></a>";
								if ( $rs['kj'] != 1 )
								{
												echo " <a href=\"#\" onclick=\"AddWin('W_S_";
												echo $rs['id'];
												echo "','";
												echo $rs['id'];
												echo "期 手动干预开奖','admin_game16_tj_c.php?action=sd&NO=";
												echo $rs['id'];
												echo "',300,180,0);return false\"><img src=\"images/AutoTextGallery.gif\" alt=\"手动干预开奖\"></a>";
								}
								echo "</TD>\r\n    </TR>\r\n    ";
				}
				echo "\t<TR bgcolor=\"#f8fbfb\">\r\n      <TD align=\"center\"><input name=\"chkall\" type=\"checkbox\" id=\"chkall\" value=\"checkbox\" onClick=\"CheckAll(document.form.chkall.checked);\"/></TD>\r\n      <TD colspan=\"10\"><input type=\"button\" name=\"del\" value=\"批量归档\"  onClick=\"document.form.action='?action=del';{if(chkCheckBoxChs('id[]')==false){alert('请至少选择一个记录！');return;}};{if(confirm('确定归档您所选择的记录吗？')){this.document.form.submit();return true;}}\" class=inputbut></TD>\r\n    </TR>\r\n    <TR align=\"center\" bgcolor=\"#f8fbfb\">\r\n      <TD colspan=\"10\">";
				include_once( dirname( __FILE__ )."/../inc/page_class.php" );
				$page = new page( array(
								"total" => $intnum,
								"perpage" => $intpage
				) );
				echo $page->show( 4, "page", "curr" );
				echo "</TD>\r\n    </TR>\r\n  </TBODY>\r\n  </form>\r\n</TABLE>\r\n<script language=\"javascript\" src=\"inc/movie.js\"></script>\r\n<script language=\"javascript\" src=\"inc/QJ_Display.js\"></script>\r\n";
}

set_time_limit( 0 );
include_once( dirname( __FILE__ )."/../inc/conn.php" );
include_once( dirname( __FILE__ )."/inc/function.php" );
login_check( "gametj" );
echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd\">\r\n<HTML xmlns=\"http://www.w3.org/1999/xhtml\">\r\n<HEAD>\r\n<TITLE>开心16统计--雷风积分游戏系统</TITLE>\r\n<META http-equiv=Content-Type content=\"text/html; charset=gb2312\">\r\n<LINK href=\"images/css_body.css\" type=text/css rel=stylesheet>\r\n<META content=\"MSHTML 6.00.3790.4275\" name=GENERATOR>\r\n</HEAD>\r\n<BODY>\r\n<DIV class=bodytitle>\r\n<DIV class=bodytitleleft></DIV>\r\n<DIV class=bodytitletxt>开心16统计</DIV>\r\n</DIV>\r\n";
switch ( $_GET['action'] )
{
case "del" :
				del( );
				addlog( "归档游戏数据成功" );
				showerr( "归档游戏数据成功", $_SERVER['HTTP_REFERER'] );
				break;
default :
				main( );
}
?>
