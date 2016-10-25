<?php
session_start();
include_once("inc/conn.php");
include_once("inc/function.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>find password-<?=$web_name;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<meta name="keywords" content="<?=$web_keywords;?>" />
<meta name="description" content="<?=$web_description;?>" />
<META http-equiv=X-UA-Compatible content=IE=EmulateIE7>
<link href="style/default.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.table_setpw th{color:white;font-size:14px;}
</style>
<script type="text/javascript" src="inc/reg.js"></script>
</head>
<?php include_once("top.php");?>
<DIV class="wrapper">
	<DIV class="page_content">
		<DIV class="webgame-activities-title">
			<H3>Foget password</H3>
		</DIV>
			<div class="main_users">
				 <div class="main_txzreg">
				 	<?
					if($_GET["act"]=="forget"){
						if(strtolower($_SESSION["yan"])!=strtolower($_POST["tbSafeCode"])){
							echo "<script language=javascript>alert('code incorrect');history.go(-1);</script>";
							exit;
						}
						
						$tbUserSecQues=str_check($_POST["tbUserSecQues"]);
						$tbUserSecAns=str_check($_POST["tbUserSecAns"]);
						if($_POST["r"]==1){
						$tbUserAccount=intval($_POST["tbUserAccount"]);
						$query_f=$db->query("Select * from {$web_dbtop}users where id=$tbUserAccount");
						}else{
						$tbUserAccount=str_check($_POST["tbUserAccount"]);
						$query_f=$db->query("Select * from {$web_dbtop}users where email='$tbUserAccount'");
						}
						if($rs_f=$db->fetch_array($query_f)){
							if($rs_f["secques"]==$tbUserSecQues and $rs_f["secans"]==$tbUserSecAns){
								$newpassword=random(6);
								$db->query("update {$web_dbtop}users set password='".md5($newpassword)."' where id=".$rs_f["id"]);
								echo "<div align=\"center\" style=\"margin-top:50px;font-size: 14px;color: #FF6600;\">Done<br>your new password is：$newpassword<br></div>";
							}else{
								echo "<div align=\"center\" style=\"margin-top:50px;font-size: 14px;color: #FF6600;\">incorrect answer</div>";
							}
						}else{
							echo "<div align=\"center\" style=\"margin-top:50px;font-size: 14px;color: #FF6600;\">username does not exist</div>";
						}
					}else{
					?>
					<FORM action="?act=forget" method="post" onsubmit="return Chkforpwd()">
					<table width="580" border="0" align="center" cellpadding="0" cellspacing="0" class="table_setpw">
						<tr>
							<th width="130">Account type：</th>
							<td width="500"><span style="color:white"><INPUT id=rID type=radio CHECKED value=1 name=r> ID <INPUT id=rMail type=radio value=0 name=r>E-mail</span></td>
						</tr>
						<tr>
							<th>Username：</th>
							<td><INPUT class="inpA" maxLength=50 name="tbUserAccount" id="tbUserAccount"> <span id="sUserAccount"></span></td>
						</tr>
						<tr>
							<th>Security answer：</th>
							<td>
							<select class="inpA" id="tbUserSecQues" name="tbUserSecQues" style="font-size:10px;">
                              <option value="" selected="selected">Choose your security question</option>
                              <option value="what is the name of your first school?">what is the name of your first school?</option>
                              <option value="what is the name of your favourite pet?">what is the name of your favourite pet?</option>
                              <option value="what is the name of your grandpa?">what is the name of your grandpa?</option>
                              <option value="what is your favourite sport?">what is your favourite sport?</option>
                              <option value="what is the name of your first company?">what is the name of your first company?</option>
                              <option value="what is the name of the hospital where your wewe born?">the name of the hospital where you were born?</option>
                            </select>
					<span id="sUserSecQues"></span></td>
						</tr>
						<tr>
							<th>Security answers：</th>
							<td><INPUT class="inpA" maxLength=50 name="tbUserSecAns" id="tbUserSecAns"> <span id="sUserSecAns"></span></td>
						</tr>
						<tr>
							<th>Code：</th>
							<td><input name="tbSafeCode" type="text" id="tbSafeCode" class="inp_yzm" />
							&nbsp; <img id="vdimgck" width="60" height="24" src="inc/code.php" alt="refresh" align="absmiddle" style="cursor:pointer" onclick="this.src=this.src+'?'" /></td>
						</tr>
						<tr>
							<th>&nbsp;</th>
							<td> <button class="btn--" id="btnSignCheck" type="submit" style="width:100px;height:35px;margin-top:14px;padding-top:0px;">Next</button>&nbsp;</td>
						</tr>
					</table>
					 </form>
					<?
					}
					?>
				 </div>
			</div>
		<div class="area960-b h5px"></div>
		<DIV class=cl></DIV>
	</div>
	<!--Flink End-->
	<div class="blank10"></div>
	<!--Footer Start-->
<?php include_once("footer.php");?>
</DIV>