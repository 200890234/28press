<?php
		include_once( "inc/conn.php" );
		include_once( "inc/function.php" );
		global $db;
		global $web_dbtop;
		$query = $db->query( "Select id,tzpoints from {$web_dbtop}game28 where kj=0 Order by id asc" );
		
		if ( $rs = $db->fetch_array( $query ) )//ȡ��δ�����ں���id��С��һ����¼
		{
		print_r($rs);
				$kjid = $rs['id'];//�����ںţ�δ����ʱ��
				$kjzh = $rs['tzpoints'];//Ͷע����
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
						$id = $rs['id'];//δ�����ں�id�ڶ�С�� ���뵽lf_game28����
						echo $id;
				}










