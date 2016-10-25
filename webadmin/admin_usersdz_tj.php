<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/

function xx( )
{
		global $db;
		global $web_dbtop;
		global $web_moneyname;
		echo "<TABLE width=\"96%\" border=0 align=center cellpadding=\"5\" cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n  <TBODY>\r\n    <TR bgColor=\"#f5fafe\">\r\n      <TD align=\"center\">下线ID</TD>\r\n      <TD width=\"20%\" align=\"center\">推荐类型</TD>\r\n      <TD width=\"20%\" align=\"center\">注册时间</TD>\r\n      <TD width=\"20%\" align=\"center\">影响提成时间</TD>\r\n\t  <TD width=\"20%\" align=\"center\">获得";
		echo $web_moneyname;
		echo "总数</TD>\r\n    </TR>\r\n    ";
		$intpage = 20;
		if ( isset( $_GET['page'] ) )
		{
				$rsnum = ( $_GET['page'] - 1 ) * $intpage;
		}
		else
		{
				$rsnum = 0;
		}
		$query = $db->query( "Select * from ".$web_dbtop."tjlog where uid=".$_GET['uid']." Order by id desc" );
		if ( $db->fetch_array( $query ) )
		{
				$intnum = $db->num_rows( $query );
		}
		$query = $db->query( "Select * from ".$web_dbtop."tjlog where uid=".$_GET['uid'].( " Order by id desc limit ".$rsnum.",{$intpage}" ) );
		while ( $rs = $db->fetch_array( $query ) )
		{
				echo "    <TR bgcolor=\"#FFFFFF\">\r\n      <TD align=\"center\">";
				echo $rs['xid'];
				echo " <a href=\"#\" onclick=\"parent.AddWin('W_HD_";
				echo $rs['id'];
				echo "','用户 ";
				echo $rs['id'];
				echo " 数据核对','admin_usersdz.php?id=";
				echo $rs['id'];
				echo "',480,340,0);return false\"><img src=\"images/CreateFormMoreFormsGallery.gif\" width=\"16\" height=\"16\"></a></TD>\r\n      <TD align=\"center\">";
				echo $rs['type'];
				echo "</TD>\r\n      <TD align=\"center\">";
				echo $rs['regtime'];
				echo "</TD>\r\n\t  <TD align=\"center\">";
				echo $rs['time'];
				echo "</TD>\r\n      <TD align=\"center\">";
				echo number_format( $rs['points'] );
				echo "</TD>\r\n    </TR>\r\n    ";
		}
		echo "    <TR align=\"center\" bgcolor=\"#f8fbfb\">\r\n      <TD colspan=\"5\">";
		include_once( dirname( __FILE__ )."/../inc/page_class.php" );
		$page = new page( array(
				"total" => $intnum,
				"perpage" => $intpage
		) );
		echo $page->show( 4, "page", "curr" );
		echo "</TD>\r\n    </TR>\r\n  </TBODY>\r\n</TABLE>\r\n";
}

function ad( )
{
		global $db;
		global $web_dbtop;
		global $web_moneyname;
		echo "<TABLE width=\"96%\" border=0 align=center cellpadding=\"5\" cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n  <TBODY>\r\n    <TR bgColor=\"#f5fafe\">\r\n      <TD align=\"center\">名称</TD>\r\n      <TD width=\"30%\" align=\"center\">时间</TD>\r\n\t  <TD width=\"20%\" align=\"center\">获得";
		echo $web_moneyname;
		echo "总数</TD>\r\n    </TR>\r\n    ";
		$intpage = 20;
		if ( isset( $_GET['page'] ) )
		{
				$rsnum = ( $_GET['page'] - 1 ) * $intpage;
		}
		else
		{
				$rsnum = 0;
		}
		$query = $db->query( "Select * from ".$web_dbtop."userslog where usersid=".$_GET['uid']." and logtype=".$_GET['type']." Order by id desc" );
		if ( $db->fetch_array( $query ) )
		{
				$intnum = $db->num_rows( $query );
		}
		$query = $db->query( "Select * from ".$web_dbtop."userslog where usersid=".$_GET['uid']." and logtype=".$_GET['type'].( " Order by id desc limit ".$rsnum.",{$intpage}" ) );
		while ( $rs = $db->fetch_array( $query ) )
		{
				echo "    <TR bgcolor=\"#FFFFFF\">\r\n      <TD align=\"center\">";
				echo $rs['log'];
				echo "</TD>\r\n\t  <TD align=\"center\">";
				echo $rs['time'];
				echo "</TD>\r\n      <TD align=\"center\">";
				echo number_format( $rs['points'] );
				echo "</TD>\r\n    </TR>\r\n    ";
		}
		echo "    <TR align=\"center\" bgcolor=\"#f8fbfb\">\r\n      <TD colspan=\"5\">";
		include_once( dirname( __FILE__ )."/../inc/page_class.php" );
		$page = new page( array(
				"total" => $intnum,
				"perpage" => $intpage
		) );
		echo $page->show( 4, "page", "curr" );
		echo "</TD>\r\n    </TR>\r\n  </TBODY>\r\n</TABLE>\r\n";
}

function dj( )
{
		global $db;
		global $web_dbtop;
		global $web_moneyname;
		echo "<TABLE width=\"96%\" border=0 align=center cellpadding=\"5\" cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n  <TBODY>\r\n    <TR bgColor=\"#f5fafe\">\r\n      <TD align=\"center\">奖品</TD>\r\n\t  <TD width=\"20%\" align=\"center\">";
		echo $web_moneyname;
		echo "</TD>\r\n      <TD width=\"10%\" align=\"center\">数量</TD>\r\n\t  <TD width=\"30%\" align=\"center\">兑奖时间</TD>\r\n    </TR>\r\n\t";
		$intpage = 20;
		if ( isset( $_GET['page'] ) )
		{
				$rsnum = ( $_GET['page'] - 1 ) * $intpage;
		}
		else
		{
				$rsnum = 0;
		}
		$sql .= "Select * from ".$web_dbtop."exchange where uid=".$_GET['uid']." Order by id desc";
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
				echo "</A></TD>\r\n\t  <TD align=\"center\">";
				echo number_format( $rs['points'] );
				echo "</TD>\r\n      <TD align=\"center\">";
				echo $rs['num'];
				echo "</TD>\r\n\t  <TD align=\"center\">";
				echo $rs['time'];
				echo "</TD>\r\n    </TR>\r\n\t";
		}
		echo "    <TR bgcolor=\"#f8fbfb\">\r\n      <TD colspan=\"4\" align=\"center\">";
		include_once( dirname( __FILE__ )."/../inc/page_class.php" );
		$page = new page( array(
				"total" => $intnum,
				"perpage" => $intpage
		) );
		echo $page->show( 4, "page", "curr" );
		echo "</TD>\r\n    </TR>\r\n  </TBODY>\r\n</TABLE>\r\n";
}

function dodge( )
{
		global $db;
		global $web_dbtop;
		global $web_moneyname;
		echo "<TABLE width=\"96%\" border=0 align=center cellpadding=\"5\" cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n  <TBODY>\r\n    <TR bgColor=\"#f5fafe\">\r\n      <TD align=\"center\">状态</TD>\r\n\t  <TD width=\"20%\" align=\"center\">";
		echo $web_moneyname;
		echo "</TD>\r\n\t  <TD width=\"30%\" align=\"center\">时间</TD>\r\n    </TR>\r\n\t";
		$query = $db->query( "Select * from ".$web_dbtop."game_system where id=1" );
		if ( $rs = $db->fetch_array( $query ) )
		{
				$gamedodge_tz_cl = $rs['gamedodge_tz_cl'];
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
		$sql .= "Select * from ".$web_dbtop."gamedodge where uid=".$_GET['uid']." or tzid=".$_GET['uid']." Order by id desc";
		$query = $db->query( $sql );
		if ( $db->fetch_array( $query ) )
		{
				$intnum = $db->num_rows( $query );
		}
		$query = $db->query( $sql.( " limit ".$rsnum.",{$intpage}" ) );
		while ( $rs = $db->fetch_array( $query ) )
		{
				echo "    <TR bgcolor=\"#FFFFFF\" onMouseOver=\"this.bgColor='#f5fafe'\" onMouseOut=\"this.bgColor='#FFFFFF'\">\r\n      <TD align=\"center\">";
				echo $rs['uid'] == $_GET['uid'] ? "摆擂" : "挑战";
				echo "</TD>\r\n\t  <TD align=\"center\">";
				echo number_format( $rs['points'] * ( 100 - $gamedodge_tz_cl ) / 100 );
				echo "</TD>\r\n\t  <TD align=\"center\">";
				echo date( "m-d H:i", strtotime( $rs['time'] ) );
				echo "</TD>\r\n    </TR>\r\n\t";
		}
		echo "    <TR bgcolor=\"#f8fbfb\">\r\n      <TD colspan=\"3\" align=\"center\">";
		include_once( dirname( __FILE__ )."/../inc/page_class.php" );
		$page = new page( array(
				"total" => $intnum,
				"perpage" => $intpage
		) );
		echo $page->show( 4, "page", "curr" );
		echo "</TD>\r\n    </TR>\r\n  </TBODY>\r\n</TABLE>\r\n";
}

function box( )
{
		global $db;
		global $web_dbtop;
		global $web_moneyname;
		echo "<TABLE width=\"96%\" border=0 align=center cellpadding=\"5\" cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n  <TBODY>\r\n    <TR bgColor=\"#f5fafe\">\r\n      <TD align=\"center\">宝箱类型</TD>\r\n\t  <TD width=\"20%\" align=\"center\">";
		echo $web_moneyname;
		echo "</TD>\r\n\t  <TD width=\"30%\" align=\"center\">时间</TD>\r\n    </TR>\r\n\t";
		$boxtype = array( "1" => "黄金宝箱", "2" => "白银宝箱", "3" => "青铜宝箱" );
		$intpage = 20;
		if ( isset( $_GET['page'] ) )
		{
				$rsnum = ( $_GET['page'] - 1 ) * $intpage;
		}
		else
		{
				$rsnum = 0;
		}
		$sql .= "Select * from ".$web_dbtop."gamebox_log where uid=".$_GET['uid']." Order by id desc";
		$query = $db->query( $sql );
		if ( $db->fetch_array( $query ) )
		{
				$intnum = $db->num_rows( $query );
		}
		$query = $db->query( $sql.( " limit ".$rsnum.",{$intpage}" ) );
		while ( $rs = $db->fetch_array( $query ) )
		{
				echo "    <TR bgcolor=\"#FFFFFF\" onMouseOver=\"this.bgColor='#f5fafe'\" onMouseOut=\"this.bgColor='#FFFFFF'\">\r\n      <TD align=\"center\">";
				echo $boxtype[$rs['boxtype']];
				echo "</TD>\r\n\t  <TD align=\"center\">";
				echo $rs['hjpp'];
				echo "</TD>\r\n\t  <TD align=\"center\">";
				echo date( "m-d H:i", strtotime( $rs['time'] ) );
				echo "</TD>\r\n    </TR>\r\n\t";
		}
		echo "    <TR bgcolor=\"#f8fbfb\">\r\n      <TD colspan=\"3\" align=\"center\">";
		include_once( dirname( __FILE__ )."/../inc/page_class.php" );
		$page = new page( array(
				"total" => $intnum,
				"perpage" => $intpage
		) );
		echo $page->show( 4, "page", "curr" );
		echo "</TD>\r\n    </TR>\r\n  </TBODY>\r\n</TABLE>\r\n";
}

function game16( )
{
		global $db;
		global $web_dbtop;
		global $web_moneyname;
		echo "<TABLE width=\"96%\" border=0 align=center cellpadding=\"5\" cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n  <TBODY>\r\n    <TR bgColor=\"#f5fafe\">\r\n      <TD width=\"20%\" align=\"center\">期号</TD>\r\n\t  <TD width=\"20%\" align=\"center\">时间</TD>\r\n\t  <TD align=\"center\">投注";
		echo $web_moneyname;
		echo "</TD>\r\n\t  <TD align=\"center\">中奖";
		echo $web_moneyname;
		echo "</TD>\r\n\t  <TD width=\"6%\" align=\"center\"></TD>\r\n    </TR>\r\n\t";
		$intpage = 20;
		if ( isset( $_GET['page'] ) )
		{
				$rsnum = ( $_GET['page'] - 1 ) * $intpage;
		}
		else
		{
				$rsnum = 0;
		}
		$sql = "Select ".$web_dbtop."game16.id,{$web_dbtop}game16.kgtime,{$web_dbtop}game16.kj,{$web_dbtop}game16_users_tz.hdpoints,{$web_dbtop}game16_users_tz.points from {$web_dbtop}game16,{$web_dbtop}game16_users_tz where {$web_dbtop}game16.id={$web_dbtop}game16_users_tz.NO and {$web_dbtop}game16_users_tz.uid=".$_GET['uid'].( " Order by ".$web_dbtop."game16.id desc" );
		$query = $db->query( $sql );
		if ( $db->fetch_array( $query ) )
		{
				$intnum = $db->num_rows( $query );
		}
		$query = $db->query( $sql.( " limit ".$rsnum.",{$intpage}" ) );
		while ( $rs = $db->fetch_array( $query ) )
		{
				echo "    <TR bgcolor=\"#FFFFFF\" onMouseOver=\"this.bgColor='#f5fafe'\" onMouseOut=\"this.bgColor='#FFFFFF'\">\r\n      <TD align=\"center\">";
				echo $rs['id'];
				echo "</TD>\r\n\t  <TD align=\"center\">";
				echo date( "m-d H:i", strtotime( $rs['kgtime'] ) );
				echo "</TD>\r\n\t  <TD align=\"center\">";
				echo $rs['points'];
				echo "</TD>\r\n\t  <TD align=\"center\">";
				echo $rs['kj'] == 1 ? $rs['hdpoints'] : "未开奖";
				echo "</TD>\r\n\t  <TD align=\"center\"><a href=\"#\" onclick=\"parent.AddWin('W_";
				echo $_GET['NO'];
				echo "_";
				echo $rs['uid'];
				echo "','";
				echo $_GET['NO'];
				echo "期用户";
				echo $rs['uid'];
				echo "投注详情','admin_game16_tj_c.php?action=utz&NO=";
				echo $rs['id'];
				echo "&uid=";
				echo $_GET['uid'];
				echo "',480,350,0);return false\"><img src=\"images/DocumentMapReadingView.gif\"></a></TD>\r\n    </TR>\r\n\t";
		}
		echo "    <TR bgcolor=\"#f8fbfb\">\r\n      <TD colspan=\"5\" align=\"center\">";
		include_once( dirname( __FILE__ )."/../inc/page_class.php" );
		$page = new page( array(
				"total" => $intnum,
				"perpage" => $intpage
		) );
		echo $page->show( 4, "page", "curr" );
		echo "</TD>\r\n    </TR>\r\n  </TBODY>\r\n</TABLE>\r\n";
}

function game28( )
{
		global $db;
		global $web_dbtop;
		global $web_moneyname;
		echo "<TABLE width=\"96%\" border=0 align=center cellpadding=\"5\" cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n  <TBODY>\r\n    <TR bgColor=\"#f5fafe\">\r\n      <TD width=\"20%\" align=\"center\">期号</TD>\r\n\t  <TD width=\"20%\" align=\"center\">时间</TD>\r\n\t  <TD align=\"center\">投注";
		echo $web_moneyname;
		echo "</TD>\r\n\t  <TD align=\"center\">中奖";
		echo $web_moneyname;
		echo "</TD>\r\n\t  <TD width=\"6%\" align=\"center\"></TD>\r\n    </TR>\r\n\t";
		$intpage = 20;
		if ( isset( $_GET['page'] ) )
		{
				$rsnum = ( $_GET['page'] - 1 ) * $intpage;
		}
		else
		{
				$rsnum = 0;
		}
		$sql = "Select ".$web_dbtop."game28.id,{$web_dbtop}game28.kgtime,{$web_dbtop}game28.kj,{$web_dbtop}game28_users_tz.hdpoints,{$web_dbtop}game28_users_tz.points from {$web_dbtop}game28,{$web_dbtop}game28_users_tz where {$web_dbtop}game28.id={$web_dbtop}game28_users_tz.NO and {$web_dbtop}game28_users_tz.uid=".$_GET['uid'].( " Order by ".$web_dbtop."game28.id desc" );
		$query = $db->query( $sql );
		if ( $db->fetch_array( $query ) )
		{
				$intnum = $db->num_rows( $query );
		}
		$query = $db->query( $sql.( " limit ".$rsnum.",{$intpage}" ) );
		while ( $rs = $db->fetch_array( $query ) )
		{
				echo "    <TR bgcolor=\"#FFFFFF\" onMouseOver=\"this.bgColor='#f5fafe'\" onMouseOut=\"this.bgColor='#FFFFFF'\">\r\n      <TD align=\"center\">";
				echo $rs['id'];
				echo "</TD>\r\n\t  <TD align=\"center\">";
				echo date( "m-d H:i", strtotime( $rs['kgtime'] ) );
				echo "</TD>\r\n\t  <TD align=\"center\">";
				echo $rs['points'];
				echo "</TD>\r\n\t  <TD align=\"center\">";
				echo $rs['kj'] == 1 ? $rs['hdpoints'] : "未开奖";
				echo "</TD>\r\n\t  <TD align=\"center\"><a href=\"#\" onclick=\"parent.AddWin('W_";
				echo $_GET['NO'];
				echo "_";
				echo $rs['uid'];
				echo "','";
				echo $_GET['NO'];
				echo "期用户";
				echo $rs['uid'];
				echo "投注详情','admin_game28_tj_c.php?action=utz&NO=";
				echo $rs['id'];
				echo "&uid=";
				echo $_GET['uid'];
				echo "',480,350,0);return false\"><img src=\"images/DocumentMapReadingView.gif\"></a></TD>\r\n    </TR>\r\n\t";
		}
		echo "    <TR bgcolor=\"#f8fbfb\">\r\n      <TD colspan=\"5\" align=\"center\">";
		include_once( dirname( __FILE__ )."/../inc/page_class.php" );
		$page = new page( array(
				"total" => $intnum,
				"perpage" => $intpage
		) );
		echo $page->show( 4, "page", "curr" );
		echo "</TD>\r\n    </TR>\r\n  </TBODY>\r\n</TABLE>\r\n";
}

function game11( )
{
		global $db;
		global $web_dbtop;
		global $web_moneyname;
		echo "<TABLE width=\"96%\" border=0 align=center cellpadding=\"5\" cellSpacing=1 class=tbtitle style=\"BACKGROUND: #cad9ea;\">\r\n  <TBODY>\r\n    <TR bgColor=\"#f5fafe\">\r\n      <TD width=\"20%\" align=\"center\">期号</TD>\r\n\t  <TD width=\"20%\" align=\"center\">时间</TD>\r\n\t  <TD align=\"center\">投注";
		echo $web_moneyname;
		echo "</TD>\r\n\t  <TD align=\"center\">中奖";
		echo $web_moneyname;
		echo "</TD>\r\n\t  <TD width=\"6%\" align=\"center\"></TD>\r\n    </TR>\r\n\t";
		$intpage = 20;
		if ( isset( $_GET['page'] ) )
		{
				$rsnum = ( $_GET['page'] - 1 ) * $intpage;
		}
		else
		{
				$rsnum = 0;
		}
		$sql = "Select ".$web_dbtop."game11.id,{$web_dbtop}game11.kgtime,{$web_dbtop}game11.kj,{$web_dbtop}game11_users_tz.hdpoints,{$web_dbtop}game11_users_tz.points from {$web_dbtop}game11,{$web_dbtop}game11_users_tz where {$web_dbtop}game11.id={$web_dbtop}game11_users_tz.NO and {$web_dbtop}game11_users_tz.uid=".$_GET['uid'].( " Order by ".$web_dbtop."game11.id desc" );
		$query = $db->query( $sql );
		if ( $db->fetch_array( $query ) )
		{
				$intnum = $db->num_rows( $query );
		}
		$query = $db->query( $sql.( " limit ".$rsnum.",{$intpage}" ) );
		while ( $rs = $db->fetch_array( $query ) )
		{
				echo "    <TR bgcolor=\"#FFFFFF\" onMouseOver=\"this.bgColor='#f5fafe'\" onMouseOut=\"this.bgColor='#FFFFFF'\">\r\n      <TD align=\"center\">";
				echo $rs['id'];
				echo "</TD>\r\n\t  <TD align=\"center\">";
				echo date( "m-d H:i", strtotime( $rs['kgtime'] ) );
				echo "</TD>\r\n\t  <TD align=\"center\">";
				echo $rs['points'];
				echo "</TD>\r\n\t  <TD align=\"center\">";
				echo $rs['kj'] == 1 ? $rs['hdpoints'] : "未开奖";
				echo "</TD>\r\n\t  <TD align=\"center\"><a href=\"#\" onclick=\"parent.AddWin('W_";
				echo $_GET['NO'];
				echo "_";
				echo $rs['uid'];
				echo "','";
				echo $_GET['NO'];
				echo "期用户";
				echo $rs['uid'];
				echo "投注详情','admin_game11_tj_c.php?action=utz&NO=";
				echo $rs['id'];
				echo "&uid=";
				echo $_GET['uid'];
				echo "',480,350,0);return false\"><img src=\"images/DocumentMapReadingView.gif\"></a></TD>\r\n    </TR>\r\n\t";
		}
		echo "    <TR bgcolor=\"#f8fbfb\">\r\n      <TD colspan=\"5\" align=\"center\">";
		include_once( dirname( __FILE__ )."/../inc/page_class.php" );
		$page = new page( array(
				"total" => $intnum,
				"perpage" => $intpage
		) );
		echo $page->show( 4, "page", "curr" );
		echo "</TD>\r\n    </TR>\r\n  </TBODY>\r\n</TABLE>\r\n";
}

include_once( dirname( __FILE__ )."/../inc/conn.php" );
include_once( dirname( __FILE__ )."/inc/function.php" );
login_check( 1 );
echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd\">\r\n<HTML xmlns=\"http://www.w3.org/1999/xhtml\">\r\n<HEAD>\r\n<TITLE>用户管理--雷风积分游戏系统</TITLE>\r\n<META http-equiv=Content-Type content=\"text/html; charset=gb2312\">\r\n<LINK href=\"images/css_body.css\" type=text/css rel=stylesheet>\r\n<META content=\"MSHTML 6.00.3790.4275\" name=GENERATOR>\r\n</HEAD>\r\n<BODY>\r\n";
switch ( $_GET['action'] )
{
case "ad" :
		ad( );
		break;
case "xx" :
		xx( );
		break;
case "dj" :
		dj( );
		break;
case "dodge" :
		dodge( );
		break;
case "box" :
		box( );
		break;
case "game16" :
		game16( );
		break;
case "game28" :
		game28( );
		break;
case "game11" :
		game11( );
}
?>
