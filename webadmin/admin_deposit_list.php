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
$intpage = 20;
		if ( isset( $_GET['page'] ) )
		{
				$rsnum = ( $_GET['page'] - 1 ) * $intpage;
		}
		else
		{
				$rsnum = 0;
		}
$sql="Select * from ".$web_dbtop."deposit Order by id desc";
$query = $db->query( $sql );
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
	<TITLE>���ӹ���--�׷������Ϸϵͳ</TITLE>
	<META http-equiv=Content-Type content="text/html; charset=gb2312">
	<LINK href="images/css_body.css" type=text/css rel=stylesheet>
	<META content="MSHTML 6.00.3790.4275" name=GENERATOR>
	<style type="text/css">
	td{text-align:center;}
	input{padding-right:3px;}
	</style>
</HEAD>
<BODY>
	<DIV class=bodytitle>
		<DIV class=bodytitleleft></DIV>
		<DIV class=bodytitletxt>��ֵ��¼����</DIV>
		<DIV class=bodytitletxt2><a href="">�ֶ���ֵ</a></DIV>
	</DIV>
	<!--������ֶ���ֵ�����ݿ��г�ֵ���͸�Ϊ�ֶ���ֵ-->
	<form method="post" action="admin_deposit_search.php">
	<div style="width:96%;margin:auto;margin-top:10px;">
		�������û�id&nbsp;&nbsp;
		<input type="text" name="keyword">
		<input type="submit" value="����">
	</div>
	</form>
	<TABLE width="96%" border=0 align=center cellpadding="5" cellSpacing=1 class=tbtitle style="BACKGROUND: #cad9ea;">
		<TBODY>
			<TR bgColor="#f5fafe">
				<TD>id</TD>
				<TD>��Աid</TD>
				<TD>��ֵ���</TD> 
				<TD>���PRs</TD>  
				<TD>����ʱ��</TD>  
				<TD>�ϼ�id</TD>  
				<TD>�ϼ�����PRs</TD>  
				<TD>��ֵ��LR�˺�</TD>  
				<TD>����</TD>
			</TR>
			<?php while ( $rs = $db->fetch_array( $query ) ){
				$intnum = $db->num_rows( $query );
			}
			$query = $db->query( $sql.( " limit ".$rsnum.",{$intpage}" ) );
			while ( $rs = $db->fetch_array( $query ) ){
			?>
			<tr bgcolor="#FFFFFF">
				<td><?php echo $rs["id"];?></td>
				<td><?php echo $rs["uid"];?></td>
				<td><?php echo $rs["amnt"];?></td>
				<td><?php echo $rs["pointsget"];?></td>
				<td><?php echo $rs["time"];?></td>
				<td><?php echo $rs["upperid"];?></td>
				<td><?php echo $rs["operation"];?></td>
				<td><?php echo $rs["paidby"];?></td>
				<td><?php echo "����";?></td>
			</tr>
			<?php }?>
			<TR bgcolor="#f8fbfb">    
				<TD colspan="9" align="center">
				<?php 
					include_once( dirname( __FILE__ )."/../inc/page_class.php" );
					$page = new page( array(
							"total" => $intnum,
							"perpage" => $intpage
					) );
					echo $page->show( 4, "page", "curr" );
				?>
				</TD>
			</TR>
		</TBODY>
	</TABLE>
	<script language="javascript" src="inc/movie.js">
</BODY>
</HTML>

