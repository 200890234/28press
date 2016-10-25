<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/

include_once( "inc/conn.php" );
include_once( "inc/function.php" );
if ( isset( $_GET['userID'] ) )
{
		$usersip = usersip( );
		$query_f = $db->query( "Select id from ".$web_dbtop."regip where ip='{$usersip}'" );
		if ( !( $rs_f = $db->fetch_array( $query_f ) ) )
		{
				$db->query( "insert into ".$web_dbtop."regip (ip,time) values ('{$usersip}','".date( "Y-m-d H:i:s" )."')" );
				$db->query( "delete from ".$web_dbtop."regip where STR_TO_DATE(time,'%Y-%m-%d')<'".date( "Y-m-d" )."'" );
				setcookie( "reguid", $_GET['userID'] );
				echo "<script>location.href='".$web_dir."reg.php';</script>";
		}
		else
		{
				echo "<script>location.href='".$web_dir."index.php';</script>";
		}
}
?>
