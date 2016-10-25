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
		$query = $db->query( "Select id from ".$web_dbtop."webip where STR_TO_DATE(time,'%Y-%m-%d')='".date( "Y-m-d" )."'" );
		if ( $rs = $db->fetch_array( $query ) )
		{
				$num = $db->num_rows( $query );
		}
		if ( $num < $web_linknum )
		{
				$usersip = usersip( );
				$query_f = $db->query( "Select id from ".$web_dbtop."webip where ip='{$usersip}'" );
				if ( !( $rs_f = $db->fetch_array( $query_f ) ) )
				{
						$query = $db->query( "Select id from ".$web_dbtop."users where id=".intval( $_GET['userID'] )."" );
						if ( $rs = $db->fetch_array( $query ) )
						{
								$db->query( "insert into ".$web_dbtop."webip (uid,ip,time) values (".intval( $_GET['userID'] ).( ",'".$usersip."','" ).date( "Y-m-d H:i:s" )."')" );
								$db->query( "update ".$web_dbtop."users set points=points+{$web_linkpoints} where id =".$rs['id'] );
								$db->query( "update ".$web_dbtop."game_log set xx_hd=xx_hd+{$web_linkpoints} where uid=".$rs['id'] );
								$db->query( "insert into ".$web_dbtop."tjlog (uid,type,regtime,points,time) values (".$rs['id'].",'µã»÷ÍÆ¼ö','".date( "Y-m-d", strtotime( $rs['time'] ) )."',".$web_linkpoints.",'".date( "Y-m-d" )."')" );
								$db->query( "delete from ".$web_dbtop."webip where STR_TO_DATE(time,'%Y-%m-%d')<'".date( "Y-m-d" )."'" );
								$db->query( "update ".$web_dbtop."webtj set tgpoints=tgpoints+{$web_linkpoints} where time='".date( "Y-m-d" )."'" );
						}
				}
		}
}
//echo "<script>location.href='".$web_dir."game.php';</script>";
?>
