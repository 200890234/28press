<?php
include_once("inc/conn.php");
include_once("inc/function.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>�ҽ�����-<?=$web_name;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<meta name="keywords" content="<?=$web_keywords;?>" />
<meta name="description" content="<?=$web_description;?>" />
<META http-equiv=X-UA-Compatible content=IE=EmulateIE7>
<link href="style/default.css" rel="stylesheet" type="text/css" />
</head>
<?php include_once("top.php");?>
<script language="javascript">
qiehuan(4);
document.getElementById("qh_con4").getElementsByTagName('li')[0].className="current";
</script>
<DIV class="wrapper">
	<DIV class="page_content">
		<!--������� Start-->
		<DIV class="news-search">
			<FORM action="prizes_list.php" method="get">
			<strong>��Ʒ������</strong>
			<SELECT name="id">
			<? showselect('');?>
			</SELECT>
			<strong>�۸�</strong>
			<SELECT name=p>
			  <OPTION label=��ѡ��۸� value=0 selected>��ѡ��۸�</OPTION>
			  <OPTION label=1000--10000<?=$web_moneyname?> value=1>1000--10000<?=$web_moneyname?></OPTION>
			  <OPTION label=10000--30000<?=$web_moneyname?> value=2>10000--30000<?=$web_moneyname?></OPTION>
			  <OPTION label=30000--80000<?=$web_moneyname?> value=3>30000--80000<?=$web_moneyname?></OPTION>
			  <OPTION label=80000--150000<?=$web_moneyname?> value=4>80000--150000<?=$web_moneyname?></OPTION>
			  <OPTION label=150000--300000<?=$web_moneyname?> value=5>150000--300000<?=$web_moneyname?></OPTION>
			  <OPTION label=300000--1000000<?=$web_moneyname?> value=6>300000--1000000<?=$web_moneyname?></OPTION>
			  <OPTION label=1000000--2000000<?=$web_moneyname?> value=7>1000000--2000000<?=$web_moneyname?></OPTION>
			  <OPTION label=2000000���� value=8>2000000����</OPTION>
		  	</SELECT>
			<button type="submit" class="search-submit" title="����"></button>
			</FORM>
			<span class="pop-keyword"><strong>����������</strong>
			<?
			$query=$db->query("Select * from {$web_dbtop}commodities where tj=1 Order by id desc limit 7");
			while($rs=$db->fetch_array($query)){
			?>
			<a href='prizes_content.php?id=<?=$rs["id"]?>' target="_blank" title="<?=$rs["name"]?>" ><?=$rs["name"]?></a>&nbsp;
			<?
			}
			?>
			</span>
			<DIV class=cl></DIV>
		</DIV>
		<div class="area690 fl">
			<div class="webgame-title1"><h3>��Ʒ��Ϣ</h3></div>
			<div class="area690-info">
				<UL class="prizes-list">
					<?
					$intpage = 20;
					if (isset($_GET['page'])) {
						$rsnum = (intval($_GET['page']) -1)*$intpage;
					}else{
						$rsnum = 0;
					}
					$sql="Select * from {$web_dbtop}commodities";
					if($_GET["id"]){
						if(typesid(intval($_GET["id"]))){
							$sql.=" where typeid in (".typesid(intval($_GET["id"])).")";
						}else{
							$sql.=" where typeid=".intval($_GET["id"])."";
						}
					}
					if($_GET["id"] && $_GET["p"])
						$sql.=" and";
					else if(!$_GET["id"] && $_GET["p"])
						$sql.=" where";
					if($_GET["p"]==1){
						$sql.=" points>=1000 and points<=10000";
					}else if($_GET["p"]==2){
						$sql.=" points>=10000 and points<=30000";
					}else if($_GET["p"]==3){
						$sql.=" points>=30000 and points<=80000";
					}else if($_GET["p"]==4){
						$sql.=" points>=80000 and points<=150000";
					}else if($_GET["p"]==5){
						$sql.=" points>=150000 and points<=300000";
					}else if($_GET["p"]==6){
						$sql.="  points>=300000 and points<=1000000";
					}else if($_GET["p"]==7){
						$sql.=" points>=1000000 and points<=2000000";
					}else if($_GET["p"]==8){
						$sql.=" points>2000000";
					}
					$sql.=" Order by id desc";
					$query=$db->query($sql);
					if($db->fetch_array($query)) 
						$intnum=$db->num_rows($query);
					$query=$db->query($sql." limit $rsnum,$intpage");
					while($rs=$db->fetch_array($query)){
				  	?>
					<LI><A title="<?=$rs["name"]?>" href="prizes_content.php?id=<?=$rs["id"]?>"><IMG alt="<?=$rs["name"]?>" src="<?=$web_dir.$web_picdir.$rs["pic"]?>"><SPAN style="COLOR: #ff0000"><?=$rs["name"]?></SPAN></A><SPAN><?=number_format($rs["points"])?></SPAN></LI>
					<?
					}
					?>
				</UL>
				<div class="blank10"></div>
				<DIV class=pages>
					<DIV class=pagelistbox><?php
								  include_once("inc/page_class.php");
								  $page=new page(array('total'=>$intnum,'perpage'=>$intpage));
								  echo $page->show(6,"","");?></DIV>
				</DIV>
			</div>
			<div class="area690-b h5px"></div>
			<DIV class=cl></DIV>
		</div>
		<!--������� End-->
  		<!--�����ұ� Start-->
    	<div class="area260 fr">
			<DIV class="webgame-title2">
				 <H3>��Ŀ����</H3>
			</DIV>
			 <UL class="area260-info list">
				<?
				$query=$db->query("Select * from {$web_dbtop}ctype where typeid=0 Order by sort asc,id desc");
				while($rs=$db->fetch_array($query)){
				?>
				<LI>
					<h3><?=$rs["name"];?></h3>
					<?
						$query_f=$db->query("Select * from {$web_dbtop}ctype where typeid=".$rs["id"]." Order by sort asc,id desc");
						while($rs_f=$db->fetch_array($query_f)){
							echo"<A href=\"prizes_list.php?id=".$rs_f["id"]."\">".$rs_f["name"]."</A>\r\n";
						}
						?>
				</LI>
				<?
				}
				?>
			 </UL>
			 <DIV class="area260-b h5px"></DIV>
			 <DIV class=blank10></DIV>
		</div>
	</DIV>
	<!--Flink End-->
	<div class="blank10"></div>
	<!--Footer Start-->
<?php include_once("footer.php");?>
</DIV>