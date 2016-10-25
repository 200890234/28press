<?php
		include_once( "inc/conn.php" );
		include_once( "inc/function.php" );
		global $db;
		global $web_dbtop;
		$query = $db->query( "Select id,tzpoints from {$web_dbtop}game28 where kj=0 Order by id asc" );
		
		if ( $rs = $db->fetch_array( $query ) )//取出未开奖期号中id最小的一条记录
		{
		print_r($rs);
				$kjid = $rs['id'];//开奖期号（未开奖时）
				$kjzh = $rs['tzpoints'];//投注总数
				$kjtzpoints = $game28_go_samples == 0 ? $rs['tzpoints'] : $rs['tzpoints'] * ( 1000 - $game28_go_samples ) / 1000;
				echo $kjid."<br>";
				echo $kjzh."<br>";
				echo $kjtzpoints."<br>";
		}
		
		if($kjid){
			echo "ddd".$kjid."ttt";
		}
		
		
		$query = $db->query( "Select id from {$web_dbtop}game28 where kj=0 and id>".$kjid." Order by id asc" );
				if ( $rs = $db->fetch_array( $query ) )
				{
						$id = $rs['id'];//未开奖期号id第二小的 插入到lf_game28里面
						echo $id;
				}










