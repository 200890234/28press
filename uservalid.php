<?php
include_once("inc/conn.php");
include_once("inc/function.php");
login_check();
if($_GET["act"]=="card"){
	ck_secans(str_check($_POST["tbUserSecAns"]));
	if(empty($_POST["tbUserName"])){
		echo "<script language=javascript>alert('����д��ʵ������');history.go(-1);</script>";
		exit;
	}
	if(empty($_POST["tbUserCardID"])){
		echo "<script language=javascript>alert('����д���֤���룡');history.go(-1);</script>";
		exit;
	}
	$query=$db->query("Select card from {$web_dbtop}users where card='".str_check($_POST["tbUserCardID"])."'");
	if($rs=$db->fetch_array($query)){
		echo "<script language=javascript>alert('�Բ��𣬸����֤�����Ѿ�����֤��');history.go(-1);</script>";
		exit;
	}
	$str = "card_".intval($_COOKIE["usersid"]);
	if($_FILES['tbCardImage']['name']!='')
	{
			$tmp_file=$_FILES['tbCardImage']['tmp_name'];
			$file_types=explode(".",$_FILES['tbCardImage']['name']);
			$file_type=$file_types[count($file_types)-1];
			if(strtolower($file_type)!="jpg"&strtolower($file_type)!="gif"&strtolower($file_type)!="bmp"&strtolower($file_type)!="png"){
				  echo "<script language=javascript>alert('��ʽ����������ѡ��ͼƬ��');history.go(-1);</script>";
				  exit;
			}
			$file_name=$str.".".$file_type;
			if(!copy($tmp_file,$web_cardiddir.$file_name)){
				echo "<script language=javascript>alert('�ϴ����������ԣ���');history.go(-1);</script>";
				exit;
			}else{
				$vip=showcontent("users","vip",intval($_COOKIE["usersid"]));
				if($vip==1){
					$db->query("update {$web_dbtop}users set rname='".str_check($_POST["tbUserName"])."',card='".str_check($_POST["tbUserCardID"])."',cardpic='".$file_name."',authentication=1,points=points+$web_authentication where id=".intval($_COOKIE["usersid"])." and password='".str_check($_COOKIE["password"])."'");
					$db->query("update {$web_dbtop}game_log set sfyz_hd=$web_authentication where uid=".intval($_COOKIE["usersid"]));
					echo "<script language=javascript>alert('�����֤�����ύ�ɹ���VIP�û��Զ�ͨ����ˣ�');location.href='uservalid.php';</script>";
					exit;
				}else{
					$db->query("update {$web_dbtop}users set rname='".str_check($_POST["tbUserName"])."',card='".str_check($_POST["tbUserCardID"])."',cardpic='".$file_name."',authentication=2 where id=".intval($_COOKIE["usersid"])." and password='".str_check($_COOKIE["password"])."'");
					echo "<script language=javascript>alert('�����֤�����ύ�ɹ����ȴ�������ˣ�');location.href='uservalid.php';</script>";
					exit;
				}
			}
	}else{
		echo "<script language=javascript>alert('��ѡ����Ҫ�ϴ����ļ���');history.go(-1);</script>";
		exit;
	}
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>�û�����-<?=$web_name;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<meta name="keywords" content="<?=$web_keywords;?>" />
<meta name="description" content="<?=$web_description;?>" />
<META http-equiv=X-UA-Compatible content=IE=EmulateIE7>
<link href="style/default.css" rel="stylesheet" type="text/css" />
</head>
<?php include_once("top.php");?>
<script language="javascript">
qiehuan(7);
document.getElementById("qh_con7").getElementsByTagName('li')[12].className="current";
</script>
<DIV class="wrapper">
	<DIV class="page_content">
  		<!--�����ұ� Start-->
    	<div class="area260 fl">
			<DIV class="news-title">
				<span><a href="news_lest.php">����&raquo;</a></span>
				 <H3>վ�ڹ���</H3>
			</DIV>
			<ul class="area260-info news-list">
				<?
				$query=$db->query("Select * from {$web_dbtop}news Order by top desc,id desc limit 10");
				while($rs=$db->fetch_array($query)){
				?>
				<LI><A title="<?=$rs["title"]?>" href="news_content.php?id=<?=$rs["id"]?>"><?=$rs["title"]?></A></LI>
				<?
				}
				?>
			</ul>
			 <DIV class="area260-b h5px"></DIV>
			 <DIV class=blank10></DIV>
			 <DIV class="news-title">
				<span><a href="help_lest.php">����&raquo;</a></span>
				 <H3>�û�����</H3>
			</DIV>
			<ul class="area260-info news-list">
				<?
				$query=$db->query("Select * from {$web_dbtop}help Order by top desc,id desc limit 10");
				while($rs=$db->fetch_array($query)){
				?>
				<LI><A title="<?=$rs["title"]?>" href="help_content.php?id=<?=$rs["id"]?>"><?=$rs["title"]?></A></LI>
				<?
				}
				?>
			</ul>
			 <DIV class="area260-b h5px"></DIV>
			 <DIV class=blank10></DIV>
		</div>
		<!--������� Start-->
		<div class="area690 fr">
			<DIV class="users-title">
				 <H3>�����֤</H3>
			</DIV>
        	<div class="users-content">
        		<?
				$query=$db->query("Select secques,authentication From {$web_dbtop}users where id=".intval($_COOKIE["usersid"])." and password='".str_check($_COOKIE["password"])."'");
				if($rs=$db->fetch_array($query)){
				$secques=$rs["secques"];
				$authentication=$rs["authentication"];
					if($authentication!=1){?>
					<form action="?act=card" method="post" enctype="multipart/form-data">
					<ul class="bgk">
					<li class="k21"><span style="padding-left:90px">��ʵ������</span></li>
					<li class="k22"><span style="padding-left:5px"><input name="tbUserName" id="tbUserName" type="text" value="" size="25" maxlength="20" /></span></li>
					<li class="k21"><span style="padding-left:55px">�������֤���룺</span></li>
					<li class="k22"><span style="padding-left:5px"><input name="tbUserCardID" id="tbUserCardID" type="text" value="" size="25" maxlength="18" /></span></li>
					<li class="k21150"><span style="padding-left:90px">ͼ��Ԥ����</span></li>
					<li class="k22150" style="padding-top:5px"><span style="padding-left:5px"><img id="imgCard" src="images/nocard.gif" width="150" height="150" /></span></li>
					<li class="k2180"><span style="padding-left:43px">�������֤ɨ�����</span></li>
					<li class="k2280"><span style="padding:5px 0 0 5px"><input name="tbCardImage" id="tbCardImage" type="file" value="" size="25" /><br />
					<span class="fontred">(*���ã������֤�û���һ���ύ�����֤��������ע����ͬʱ<?=$web_name;?>���6��������û�е�½�����ʻ�����ע����
					���ϴ���ʵ���֤ԭ��������֤�����ܴ���2M���Ա�<?=$web_name;?>������Ա��֤����Ҫ�ϴ�����ͼƬ��Ӱ����֤Ч�ʡ�) </span></span></li>
					<li class="k21"><span style="padding-left:43px">�������뱣�����⣺</span></li>
					<li class="k22"><span style="padding-left:5px"><?=$secques;?></span></li>
					<li class="k21"><span style="padding-left:43px">���뱣������𰸣�</span></li>
					<li class="k22"><span style="padding-left:5px"><input name="tbUserSecAns" id="tbUserSecAns" type="text" value="" size="25" maxlength="20" /></span></li>
					<li class="tj"><input id="btnSubmit" type="image" src="images/an_ljtj_03.gif"  border="0" /></li>
					</ul>
					</form>
					<script language="javascript" type="text/javascript">
					function $(obj){
						return document.getElementById(obj);
					}
					window.onload = function(){
						$("tbCardImage").onchange = function(){
							this.select();
							$("imgCard").src = "file:///"+document.selection.createRange().text;
						}
					}
					</script>
					<?
					}else if($authentication==2){
						echo "<span class=\"fontred\">��������У�</span>";
					}else{
						echo "<span class=\"fontred\">���Ѿ�ͨ�������֤��</span>";
					}
				}
				?>
			</div>
			<div class="area690-b h5px"></div>
        	<div class="blank10"></div>
		</div>
		<!--������� End-->
	</DIV>
	<!--Flink End-->
	<div class="blank10"></div>
	<!--Footer Start-->
<?php include_once("footer.php");?>
</DIV>