<?php
$parse_url=parse_url($_SERVER[HTTP_REFERER]);
$url_from=$parse_url[host]; //�����վ��Դ  
if($url_from == ""){//�����ԴΪ��˵����ֱ���ڵ�ַ��������ʵ�
//echo $url_from."oo"; 
//echo "access denied";  //
//echo "<script type=\"text/javascript\">alert(\"access denied\");window.close();</script>";
//echo " <META HTTP-EQUIV=  \"Refresh\" CONTENT=\"0;  URL=../fail.php\" >";
//exit;
}
?>
<html>
<head></head>
<body>


	<!--<h2 style="color:red;">���׳ɹ����뽫���ҳ���ͼ��ͬʱ �鿴-Դ���� ��Դ�����ͼ</h2>-->
	
	<!--
	<form method="GET" action="http://127.0.0.1:8080/28press/payment/libertyreserve/success.php">
		<input type="hidden" name="lr_paidto" value="U123456">
		<input type="hidden" name="lr_paidby" value="U789">
		amount:<input type="hidden" name="lr_amnt" value="<?php //echo $POST_["lr_amnt"];?>">
		<input type="hidden" name="lr_fee_amnt" value="0">
		<input type="hidden" name="lr_currency" value="LRUSD">
		<input type="hidden" name="lr_transfer" value="4456778335534">
		<input type="hidden" name="lr_store" value="28store">
		transaction time<input type="text" name="lr_timestamp" value="<?php //echo date("Y-m-d H:i:s");?>">
		baggage fields set by the Merchant 
		<input type="hidden" name="track_id" value="166337678784">
		<input type="hidden" name="order_id" value="O7993547">
	</form>-->
	<!--���ݹ����Ľ���ǣ�<?php //echo $POST_["lr_amnt"];?>; ��ֵ�ߵ�lr�˺��ǣ�<?php //echo $POST_["lr_acc"];?>-->
	
	
	<?php 
	//$usersid=$_POST["user_id"];
	//echo "���ݹ�����usersid������=".$usersid;//�����Ҫ���Բ����Ƿ���Ĵ������ˡ�
	?>
	
	

	<!--����һ�����Դ��������ǣ�<?php //echo $_POST["test_id"];?>(��ȷ��Ӧ����333333)-->
</body>
</html>



<!-- ��Ҫ��ȡ���û����ϼ�id�����ӽ���ͬʱ���Ͷ��� 

�û���ֵ�ɹ���Ӱ����˻���Ϸ�ҺͲ���˵����־  �ɲο�card.php������ʹ��ҳ�棩
userslog���п������һ����־���ͣ����߳�ֵ��������ÿ����Ա�˻���ֵ���йش���Ҳ���Բο�card.phpҳ��

�������һ��deposit����¼��ֵ�Ͷ��˻���Ϸ�ҵ�Ӱ��

����һ����Ӱ��ı���user  ��ֵ��Ҫ���������˻���Ϸ��

����deposit�����ֱ����userslog����

-->


<!-- ����ɹ���ȡ���˳�ֵ���ݣ����еĲ������� -->
<?php
include_once("../../../inc/conn.php");
include_once("../../../inc/function.php");

global $userid;
$userid=$_POST["user_id"];  //��Աid
//$userid=56902;  //��Աid
$amnt=$_POST["lr_amnt"];	//��ֵ���
//$amnt=50;	//��ֵ���
$pointsget=$amnt*10000;  //�����Ϸ��
$upperget=$pointsget*0.02;	//���߽���
$operation="��Ա��ֵ";	//����Ϊ��ֵ  deposit
$time=date("Y-m-d H:i:s");	//����ʱ��
$paidto=$_POST["lr_paidto"];//��վ���տ��˺�
$lr_paidby=$_POST["lr_paidby"];
function getUpperId($userid){//$userid�ں����ⲿ��ֵ����Ϊ����������ں����ھͿ���ʹ����
	global $web_dbtop;//��Ϊȫ�ֱ��� ���򱨴�
	$sql="select uid from {$web_dbtop}tjlog where xid=".$userid;
	$result=mysql_query($sql);
	while($rs=mysql_fetch_assoc($result)){
		//print_r($rs);
		return $rs["uid"];
	}
}

$upperid=getUpperId($userid);
if(!$upperid){
	$upperid=00000;
}
echo $upperid;  //�����ȡ���� �ϼ�id

$db->query("insert into {$web_dbtop}deposit(uid,amnt,pointsget,time,upperid,upperget,operation,paidby,paidto) values({$userid},'{$amnt}','{$pointsget}','{$time}','{$upperid}','{$upperget}','{$operation}','{$lr_paidby}','{$lr_paidto}')");   //ִ��sql��д��  д������¼�� 
$db->query( "update ".$web_dbtop."game_log set dj_hd=dj_hd+{$pointsget} where uid=".$userid );



$db->query("update {$web_dbtop}users set points=points+".$pointsget." where id=".$userid);
$db->query("update {$web_dbtop}users set points=points+".$upperget." where id=".$upperid);

//�������Ƿ�Ҫ����վ���� �����ߣ���������������������������������
$db->query("INSERT INTO {$web_dbtop}msg (usersid,title,mag,mid,time) VALUES (0,'you get bonus',' ".$userid."deposited $".$amnt.", you got ".$upperget." PRs',".intval($upperid).",'".date("Y-m-d H:i:s")."')");
		


//echo "<script type=\"text/javascript\">window.location.href=\"../success.html\";</script>";//�ض���1  ����js����Ч
echo "  <META HTTP-EQUIV=  \"Refresh\" CONTENT=\"0;  URL=../success.html\" >";  //�ض���2

//$GoTo="success.html";   // ��������Ŀ������ȡ�����ݿ��ʵ���˶�̬ת��    
//header(sprintf("Location: %s", $GoTo));   //�ض���3








?>
