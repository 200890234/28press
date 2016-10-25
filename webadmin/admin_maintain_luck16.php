<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/
global $db;
global $web_dbtop;
include_once( dirname( __FILE__ )."/../inc/conn.php" );
include_once( dirname( __FILE__ )."/inc/function.php" );
login_check( "jpgl" );
$action=$_GET["action"];
if($action=="docancel"){
	$ids=join(",",$_POST["id"]);//所有需要取消期号的id 数组
	$sql="update ".$web_dbtop."game16 set iscancel='yes' where id in (".$ids.")";
	$db->query($sql);
	echo "<script type=\"text/javascript\">alert(\"取消成功\");</script>";
}
$sql="Select * from ".$web_dbtop."game16 where kj=0 Order by id desc limit 5";
$query = $db->query( $sql );
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
	<TITLE>附加功能--雷风积分游戏系统</TITLE>
	<META http-equiv=Content-Type content="text/html; charset=gb2312">
	<LINK href="images/css_body.css" type=text/css rel=stylesheet>
	<META content="MSHTML 6.00.3790.4275" name=GENERATOR>
	<style type="text/css">
	td{text-align:center;}
	</style>
</HEAD>
<BODY>
	<DIV class=bodytitle>
		<DIV class=bodytitleleft></DIV>
		<DIV class=bodytitletxt>幸运16维护</DIV>
		
	</DIV>
	<form method="post" action="?action=docancel">
	<TABLE width="96%" border=0 align=center cellpadding="5" cellSpacing=1 class=tbtitle style="BACKGROUND: #cad9ea;">
		<TBODY>
			<TR bgColor="#f5fafe">
				<TD>期号id</TD>
				<TD>开奖时间</TD>
				<TD>是否开奖</TD>
				<TD>投注总数</TD>
				<TD>是否取消</TD>
			</TR>
			<?php while ( $rs = $db->fetch_array( $query ) ){?>
			<TR bgColor="#f5fafe">
				<TD><?php echo $rs["id"];?><input type="hidden" name="id[]" value="<?php echo $rs["id"]?>"></TD>
				<TD><?php echo $rs["kgtime"];?></TD>
				<TD><?php echo $rs["kj"];?></TD> 
				<TD><?php echo $rs["tzpoints"];?></TD> 
				<TD><?php echo $rs["iscancel"];?></TD> 
			</TR>	
			<?php }?>
			<TR bgcolor="#f8fbfb">    
				<TD colspan="9" align="center">
				<input type="hidden" value=""><!--把期号传过去-->
				<input type="submit" value="取消这几期的开奖">
				</TD>
			</TR>
		</TBODY>
	</TABLE>
	</form>
	<script language="javascript" src="inc/movie.js">
</BODY>
</HTML>

