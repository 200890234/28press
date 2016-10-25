<?php
include_once("inc/conn.php");
include_once("inc/function.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Luck16-game center-<?=$web_name;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<meta name="keywords" content="<?=$web_keywords;?>" />
<meta name="description" content="<?=$web_description;?>" />
<META http-equiv=X-UA-Compatible content=IE=EmulateIE7>
<link href="style/default.css" rel="stylesheet" type="text/css" />
</head>
<?php include_once("top.php");?>
<script language="javascript">
qiehuan(2);
document.getElementById("qh_con2").getElementsByTagName('li')[2].className="current";
</script>
<DIV class="wrapper">
	<DIV class="page_content">
		<DIV class="webgame-info-title">
		  <UL>
			<LI><A href="happy.php">Luck16 home</A></LI>
			<LI><A href="happyhelp.php">Luck16 help</A></LI>
			<LI><A href="happymylist.php">My pressing history</A></LI>
			<LI><A href="happymodel.php">Edit pressing mode</A></LI>
			<LI><A href="happyautoset.php">Automatic pressing</A></LI>
			<LI class="current"><A href="happydirection.php">Trend chart</A></LI>
		  </UL>
		</DIV>
		<DIV class="webgame-info">
			<DIV class="webgame-info-tabs">
			  <table width="100%" height="27" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="12"><img src="images/game2_03.jpg" width="12" height="27" /></td>
                  <td background="images/game2_04.jpg" class="font14">trend chart of luck28:</td>
                  <td width="13"><img src="images/game2_06.jpg" width="13" height="27" /></td>
                </tr>
              </table>
			  <?
		$intpage = 50;
		if (isset($_GET['page'])) {
			$rsnum = (intval($_GET['page']) -1)*$intpage;
		}
		else {
			$rsnum = 0;
		}
		if($_GET["s"] && $_GET["e"]){
			$sql="Select * from {$web_dbtop}game16 where kj=1 and id>=".intval($_GET["s"])." and id<=".intval($_GET["e"])." Order by id desc";
		}else{
			$sql="Select * from {$web_dbtop}game16 where kj=1 Order by id desc";
		}
		$query=$db->query($sql." limit $rsnum,$intpage");
		if($rs=$db->fetch_array($query)){
			$cxbh=$rs["id"];
		}
		$query=$db->query($sql);
		if($db->fetch_array($query)) 
		$intnum=$db->num_rows($query);
		if($_GET["s"] && $_GET["e"]){
			$sql_y="Select * from {$web_dbtop}game16 where kj=1 and id>=".intval($_GET["s"])." and id<=".intval($_GET["e"])." Order by id desc";
		}else{
			$sql_y="Select * from {$web_dbtop}game16 where kj=1 and id>=".($cxbh-49)." and id<=".$cxbh." Order by id desc";
		}
		$query=$db->query($sql_y);
		$he = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
		$ds = array(0,0);	//存放单双次数
		$zb = array(0,0);	//存放中边次数
		$dx = array(0,0);	//存放大小次数
		while($rs=$db->fetch_array($query)){
			$kghtj=explode("|",$rs["kgjg"]);
			$he[$kghtj[3]-3]++;
			//单双
			if(!($kghtj[3]&1))
				$ds[1]++;
			else
				$ds[0]++;
			
			//中边
			if($kghtj[3]>7 and $kghtj[3]<14 )
				$zb[0]++;
			else
				$zb[1]++;
		
			//大小
			if($kghtj[3]>10)
				$dx[0]++;
			else
				$dx[1]++;
		}
		$query=$db->query($sql." limit $rsnum,$intpage");
		?>
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="5" align="center"><table width="100%" border="0" cellpadding="0" cellspacing="1" align="center">
                      <tr>
                        <td align="left"><form action="?" method="get">
						<div style="color:white;">
                            Draw：
                                from <input type="text" name="s" value="<? if($_GET["s"]){echo $_GET["s"];}else{echo (($cxbh-49)>0?($cxbh-49):0);}?>" />
               to 
              <input type="text" name="e" value="<? if($_GET["e"]){echo $_GET["e"];}else{echo $cxbh;}?>" />
&nbsp;
              <input type="submit" value=" view " />
			  </div>
                        </form></td>
                      </tr>
                    </table>
                      <table width="100%" border="0" cellpadding="0" cellspacing="1" align="center" bgcolor="#9F4F18">
                        <tr>
                          <td height="28" colspan="2" align="center" background="images/happy16_40h.jpg" bgcolor="#FFFFFF">Occurrence</td>
                          <td align="center" background="images/happy16_40h.jpg" bgcolor="#FFFFFF"><?=$he[0]?></td>
                          <td align="center" background="images/happy16_40h.jpg" bgcolor="#FFFFFF"><?=$he[1]?></td>
                          <td align="center" background="images/happy16_40h.jpg" bgcolor="#FFFFFF"><?=$he[2]?></td>
                          <td align="center" background="images/happy16_40h.jpg" bgcolor="#FFFFFF"><?=$he[3]?></td>
                          <td align="center" background="images/happy16_40h.jpg" bgcolor="#FFFFFF"><?=$he[4]?></td>
                          <td align="center" background="images/happy16_40h.jpg" bgcolor="#FFFFFF"><?=$he[5]?></td>
                          <td align="center" background="images/happy16_40h.jpg" bgcolor="#FFFFFF"><?=$he[6]?></td>
                          <td align="center" background="images/happy16_40h.jpg" bgcolor="#FFFFFF"><?=$he[7]?></td>
                          <td align="center" background="images/happy16_40h.jpg" bgcolor="#FFFFFF"><?=$he[8]?></td>
                          <td align="center" background="images/happy16_40h.jpg" bgcolor="#FFFFFF"><?=$he[9]?></td>
                          <td align="center" background="images/happy16_40h.jpg" bgcolor="#FFFFFF"><?=$he[10]?></td>
                          <td align="center" background="images/happy16_40h.jpg" bgcolor="#FFFFFF"><?=$he[11]?></td>
                          <td align="center" background="images/happy16_40h.jpg" bgcolor="#FFFFFF"><?=$he[12]?></td>
                          <td align="center" background="images/happy16_40h.jpg" bgcolor="#FFFFFF"><?=$he[13]?></td>
                          <td align="center" background="images/happy16_40h.jpg" bgcolor="#FFFFFF"><?=$he[14]?></td>
                          <td align="center" background="images/happy16_40h.jpg" bgcolor="#FFFFFF"><?=$he[15]?></td>
                          <td align="center" background="images/happy16_40h.jpg" bgcolor="#FFFFFF"><?=$ds[0]?></td>
                          <td align="center" background="images/happy16_40h.jpg" bgcolor="#FFFFFF"><?=$ds[1]?></td>
                          <td align="center" background="images/happy16_40h.jpg" bgcolor="#FFFFFF"><?=$zb[0]?></td>
                          <td align="center" background="images/happy16_40h.jpg" bgcolor="#FFFFFF"><?=$zb[1]?></td>
                          <td align="center" background="images/happy16_40h.jpg" bgcolor="#FFFFFF"><?=$dx[0]?></td>
                          <td align="center" background="images/happy16_40h.jpg" bgcolor="#FFFFFF"><?=$dx[1]?></td>
                        </tr>
                        <tr>
                          <td width="100" height="28" align="center" background="images/happy16_40.jpg" bgcolor="#FFFFFF" class="font-white">Draw</td>
                          <td height="28" align="center" background="images/happy16_40.jpg" bgcolor="#FFFFFF" class="font-white">Time</td>
                          <td align="center" width="30" background="images/happy16_40.jpg" bgcolor="#FFFFFF" class="font-white">3</td>
                          <td align="center" width="30" background="images/happy16_40.jpg" bgcolor="#FFFFFF" class="font-white">4</td>
                          <td align="center" width="30" background="images/happy16_40.jpg" bgcolor="#FFFFFF" class="font-white">5</td>
                          <td align="center" width="30" background="images/happy16_40.jpg" bgcolor="#FFFFFF" class="font-white">6</td>
                          <td align="center" width="30" background="images/happy16_40.jpg" bgcolor="#FFFFFF" class="font-white">7</td>
                          <td align="center" width="30" background="images/happy16_40.jpg" bgcolor="#FFFFFF" class="font-white">8</td>
                          <td align="center" width="30" background="images/happy16_40.jpg" bgcolor="#FFFFFF" class="font-white">9</td>
                          <td align="center" width="30" background="images/happy16_40.jpg" bgcolor="#FFFFFF" class="font-white">10</td>
                          <td align="center" width="30" background="images/happy16_40.jpg" bgcolor="#FFFFFF" class="font-white">11</td>
                          <td align="center" width="30" background="images/happy16_40.jpg" bgcolor="#FFFFFF" class="font-white">12</td>
                          <td align="center" width="30" background="images/happy16_40.jpg" bgcolor="#FFFFFF" class="font-white">13</td>
                          <td align="center" width="30" background="images/happy16_40.jpg" bgcolor="#FFFFFF" class="font-white">14</td>
                          <td align="center" width="30" background="images/happy16_40.jpg" bgcolor="#FFFFFF" class="font-white">15</td>
                          <td align="center" width="30" background="images/happy16_40.jpg" bgcolor="#FFFFFF" class="font-white">16</td>
                          <td align="center" width="30" background="images/happy16_40.jpg" bgcolor="#FFFFFF" class="font-white">17</td>
                          <td align="center" width="30" background="images/happy16_40.jpg" bgcolor="#FFFFFF" class="font-white">18</td>
                          <td width="30" align="center" background="images/happy16_40.jpg" bgcolor="#FFFFFF" class="font-white">odd</td>
                          <td width="30" align="center" background="images/happy16_40.jpg" bgcolor="#FFFFFF" class="font-white">even</td>
                          <td width="30" align="center" background="images/happy16_40.jpg" bgcolor="#FFFFFF" class="font-white">middle</td>
                          <td width="30" align="center" background="images/happy16_40.jpg" bgcolor="#FFFFFF" class="font-white">edge</td>
                          <td width="30" align="center" background="images/happy16_40.jpg" bgcolor="#FFFFFF" class="font-white">big</td>
                          <td width="30" align="center" background="images/happy16_40.jpg" bgcolor="#FFFFFF" class="font-white">small</td>
                        </tr>
                        <?php
	while($rs=$db->fetch_array($query)){
		$kgh=explode("|",$rs["kgjg"]);
	?>
                        <tr>
                          <td height="32" align="center" bgcolor="#E6F7E0" title="<?=date("M d H:i",strtotime($rs["kgtime"]));?>"><?=$rs["id"];?></td>
                          <td align="center" bgcolor="#FFFFFF"><?=date("M d H:i",strtotime($rs["kgtime"]));?></td>
                          <td align="center" style="color:#FFFFFF;" bgcolor="<?=($kgh[3]==3?"#0000FF":"#E6F7E0")?>"><? if($kgh[3]==3) echo $kgh[3];?></td>
                          <td align="center" style="color:#FFFFFF;" bgcolor="<?=($kgh[3]==4?"#0000FF":"#E6F7E0")?>"><? if($kgh[3]==4) echo $kgh[3];?></td>
                          <td align="center" style="color:#FFFFFF;" bgcolor="<?=($kgh[3]==5?"#0000FF":"#E6F7E0")?>"><? if($kgh[3]==5) echo $kgh[3];?></td>
                          <td align="center" style="color:#FFFFFF;" bgcolor="<?=($kgh[3]==6?"#0000FF":"#E6F7E0")?>"><? if($kgh[3]==6) echo $kgh[3];?></td>
                          <td align="center" style="color:#FFFFFF;" bgcolor="<?=($kgh[3]==7?"#0000FF":"#E6F7E0")?>"><? if($kgh[3]==7) echo $kgh[3];?></td>
                          <td align="center" style="color:#FFFFFF;" bgcolor="<?=($kgh[3]==8?"#FF0000":"#FFFFFF")?>"><? if($kgh[3]==8) echo $kgh[3];?></td>
                          <td align="center" style="color:#FFFFFF;" bgcolor="<?=($kgh[3]==9?"#FF0000":"#FFFFFF")?>"><? if($kgh[3]==9) echo $kgh[3];?></td>
                          <td align="center" style="color:#FFFFFF;" bgcolor="<?=($kgh[3]==10?"#FF0000":"#FFFFFF")?>"><? if($kgh[3]==10) echo $kgh[3];?></td>
                          <td align="center" style="color:#FFFFFF;" bgcolor="<?=($kgh[3]==11?"#FF0000":"#FFFFFF")?>"><? if($kgh[3]==11) echo $kgh[3];?></td>
                          <td align="center" style="color:#FFFFFF;" bgcolor="<?=($kgh[3]==12?"#FF0000":"#FFFFFF")?>"><? if($kgh[3]==12) echo $kgh[3];?></td>
                          <td align="center" style="color:#FFFFFF;" bgcolor="<?=($kgh[3]==13?"#FF0000":"#FFFFFF")?>"><? if($kgh[3]==13) echo $kgh[3];?></td>
                          <td align="center" style="color:#FFFFFF;" bgcolor="<?=($kgh[3]==14?"#0000FF":"#E6F7E0")?>"><? if($kgh[3]==14) echo $kgh[3];?></td>
                          <td align="center" style="color:#FFFFFF;" bgcolor="<?=($kgh[3]==15?"#0000FF":"#E6F7E0")?>"><? if($kgh[3]==15) echo $kgh[3];?></td>
                          <td align="center" style="color:#FFFFFF;" bgcolor="<?=($kgh[3]==16?"#0000FF":"#E6F7E0")?>"><? if($kgh[3]==16) echo $kgh[3];?></td>
                          <td align="center" style="color:#FFFFFF;" bgcolor="<?=($kgh[3]==17?"#0000FF":"#E6F7E0")?>"><? if($kgh[3]==17) echo $kgh[3];?></td>
                          <td align="center" style="color:#FFFFFF;" bgcolor="<?=($kgh[3]==18?"#0000FF":"#E6F7E0")?>"><? if($kgh[3]==18) echo $kgh[3];?></td>
                          <td align="center" bgcolor="<?=($kgh[3]%2!=0?"#FF9900":"#FFFFFF")?>"><span class="wf">O</span></td>
                          <td align="center" bgcolor="<?=($kgh[3]%2==0?"#663399":"#FFFFFF")?>"><span class="wf">E</span></td>
                          <td align="center" bgcolor="<? if($kgh[3]>7 && $kgh[3]<14){echo"#FF0000";}else{echo"#FFFFFF";}?>"><span class="wf">M</span></td>
                          <td align="center" bgcolor="<? if($kgh[3]>7 && $kgh[3]<14){echo"#FFFFFF";}else{echo"#0000FF";}?>"><span class="wf">E</span></td>
                          <td align="center" bgcolor="<?=($kgh[3]>10?"#FF9900":"#FFFFFF")?>"><span class="wf">B</span></td>
                          <td align="center" bgcolor="<?=($kgh[3]<11?"#FF00FF":"#FFFFFF")?>" ><span class="wf">S</span></td>
                        </tr>
                        <?
	}
	?>
                      </table>
                      <br />
                      <?php
		  include_once("inc/page_class.php");
		  $page=new page(array('total'=>$intnum,'perpage'=>$intpage));
		  echo $page->show(5,"","");?></td>
                </tr>
              </table>
		  </DIV>
			<DIV class=cl></DIV>
		</DIV>
		<DIV class="area960-b h5px"></DIV>
	<!--Flink End-->
	<div class="blank10"></div>
	<!--Footer Start-->
<?php include_once("footer.php");?>
</DIV>