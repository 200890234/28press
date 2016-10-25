<?php
session_start();
include_once("inc/conn.php");
include_once("inc/function.php");
if($_GET["act"]=="reg"){
	if(!$_POST["agreement"]){
		//echo "<script language=javascript>alert('sorry,you have to accept the terms');location.href='index.php';</script>";
		//exit;
	}
	if($_COOKIE["reg"]==1){
		echo "<script language=javascript>alert('you can only register one account');location.href='index.php';</script>";
		exit;
	}
	if(!$_POST["tbUserMail"] || !$_POST["tbUserNick"] || !$_POST["tbUserPwd"] || !$_POST["tbUserLr"] || !$_POST["tbUserSecQues"] || !$_POST["tbUserSecAns"]){
		echo "<script language=javascript>alert('sorry, please fill all the required fields');location.href='reg.php';</script>";
		exit;
	}	
	//if(strtolower($_SESSION["yan"])!=strtolower($_POST["tbSafeCode"])){
		//echo "<script language=javascript>alert('invalid code');history.go(-1);</script>";
		//exit;
	//}
	else{
		$tbUserMail=str_check($_POST["tbUserMail"]);
		$tbUserNick=str_check($_POST["tbUserNick"]);
		$tbUserPwd=md5($_POST["tbUserPwd"]);
		$tbUserGender=str_check($_POST["tbUserGender"]);
		$tbUserLr=str_check($_POST["tbUserLr"]);
		$tbUserSecQues=str_check($_POST["tbUserSecQues"]);
		$tbUserSecAns=str_check($_POST["tbUserSecAns"]);
		$query=$db->query("insert into {$web_dbtop}users (email,name,password,sex,lr_acc,secques,secans,points,time,tjid,regip) values 
		('$tbUserMail','$tbUserNick','$tbUserPwd','$tbUserGender','$tbUserLr','$tbUserSecQues','$tbUserSecAns',$reg_points,'".date("Y-m-d H:i:s")."',".intval($_COOKIE["reguid"]).",'".usersip()."')");
		$id=$db->insert_id();//获取插入的新用户id的值(因为id是自动增长的)   在下面用户获取下线xid
		$db->query("insert into {$web_dbtop}game_log (uid,reg_hd) values ($id,$reg_points)");
		//这里添加给tjid上线 增加奖励   部分代码由recomlink.php而来
		$db->query( "update ".$web_dbtop."users set points=points+{$web_linkpoints} where id =".intval($_COOKIE["reguid"]) );//给上级增加注册推荐奖励  推荐奖金
		$db->query( "update ".$web_dbtop."game_log set xx_hd=xx_hd+{$web_linkpoints} where uid=".intval($_COOKIE["reguid"]) );//下线注册给上线的奖励 更新到game_log表中
		$db->query( "insert into ".$web_dbtop."tjlog (uid,xid,type,regtime,points,time) values (".intval($_COOKIE["reguid"]).",".$id.",'invite friend','".date( "Y-m-d")."',".$web_linkpoints.",'".date( "Y-m-d" )."')" );//xid不知道如何获取   写入推广日志
		//$db->query( "delete from ".$web_dbtop."webip where STR_TO_DATE(time,'%Y-%m-%d')<'".date( "Y-m-d" )."'" ); //不知道有没有用
		//$db->query( "update ".$web_dbtop."webtj set tgpoints=tgpoints+{$web_linkpoints} where time='".date( "Y-m-d" )."'" );  //也不知道什么用
		//接下来是否要发站内信通知上线？？？？？？？？？？？
		$db->query("INSERT INTO {$web_dbtop}msg (usersid,title,mag,mid,time) VALUES (0,'invite friends','".$id." accepted your invitation ,you got {$web_linkpoints} {$web_moneyname}',".intval($_COOKIE["reguid"]).",'".date("Y-m-d H:i:s")."')");
		
		
		
		//添加结束
		
		
		setcookie("reg",1,time()+8640);
		setcookie("usersid",$id);
		setcookie("password",$tbUserPwd);
		setcookie("reguid");
		echo "<script>alert('create account success');location.href='index.php';</script>";
		exit;
	}
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Register-<?=$web_name;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<meta name="keywords" content="<?=$web_keywords;?>" />
<meta name="description" content="<?=$web_description;?>" />
<META http-equiv=X-UA-Compatible content=IE=EmulateIE7>
<link href="style/default.css" rel="stylesheet" type="text/css" />
<style type="text/css">
#javas{font-size:15px;padding:3px 10px;margin-left:250px;margin-top:10px;font-weight:900;text-align:center;position:absolute;color:red;}

</style>
<script type="text/javascript" src="inc/ajaxrequest.js"></script>
<script type="text/javascript" src="inc/reg.js"></script>

</head>
<?php include_once("top.php");?>
<DIV class="wrapper">
	<DIV class="page_content">
		<DIV class="webgame-activities-title">
			<H3>User register</H3>
		</DIV>
		<script type="text/javascript"><!--判断js是否被禁用-->
		//function hidejavas(){
			//var j=document.getElementById("javas").css.display="none";
			//var j=document.getElementById("javas").css.display();
			
			//alert(j);
		//}	
		//hidejavas();
		</script>
		<div class="main_users">
			<div id="javas">
			   Make sure your browser supports javascript. 
			</div>
			<div class="main_txzreg">
				<p class="tit_reg" style="color:white;font-size:16px;font-weight:bold;"><img src="images/icon_tit01.gif" />&nbsp;&nbsp;Welcome to <?=$web_name;?> <em></em></p>
				 <form onsubmit="return ChkReg()" action="?act=reg" method="post">
					<table width="750" border="0" cellspacing="0" cellpadding="0" class="table_reg">             
						<tr>
						<th width="150">Email：</th>
							<td width="300"><input name="tbUserMail" class="inpA" id="tbUserMail" onblur="ChkRepeatNick(this.value);"/></td>
							<td width="300"><span id="sUserMail"> * your email address</span></td>
						</tr>
						<tr>
						<th>Password：</th>
							<td width="300"><input class="inpA" id="tbUserPwd" type="password" maxlength="16" size="25" value="" name="tbUserPwd" /></td>
							<td width="300"><span id="sUserPwd"> * 6～16 characters</span></td>
						</tr>
						<tr>
							<th>Repeat password：</th>
							<td><input class="inpA" id="tbRePwd" type="password" size="25" value="" name="tbRePwd" /></td>
							<td><span id="sRePwd"> * repeat your password</span></td>
						</tr>
						<tr>
						<th>Nickname：</th>
							<td width="300"><input name="tbUserNick" class="inpA" id="tbUserNick"/></td>
							<td width="300"><span id="sUserNick"> * your nickname</span></td>
						</tr>
						<tr>
							<th>Gender：</th>
							<td><INPUT type=radio CHECKED value=M name=tbUserGender> Male <INPUT type=radio value=F name=tbUserGender> Female</td>
							<td><span id="sUserGender"> * select your gender</span></td>
						</tr>
						<tr>
						<th>LR account：</th>
							<td width="300"><input name="tbUserLr" class="inpA" id="tbUserLr"/></td>
							<td width="300"><span id="sUserLr"></span><span class="rf"> * very important <a href="https://www.libertyreserve.com/en/registration">Get a LR account</a></span></td>
						</tr>
						<tr>
							<th>Security question：</th>
							<td><select class="inpA" id="tbUserSecQues" name="tbUserSecQues" style="font-size:10px;">
                              <option value="" selected="selected">Choose your security question</option>
                              <option value="what is the name of your first school?">what is the name of your first school?</option>
                              <option value="what is the name of your favourite pet?">what is the name of your favourite pet?</option>
                              <option value="what is the name of your grandpa?">what is the name of your grandpa?</option>
                              <option value="what is your favourite sport?">what is your favourite sport?</option>
                              <option value="what is the name of your first company?">what is the name of your first company?</option>
                              <option value="what is the name of the hospital where your wewe born?">what is the name of the hospital where you were born?</option>
                            </select></td>
							<td><span id="sUserSecQues"><span class="rf"> * Very important</span></span></td>
						</tr>
						<tr>
							<th>Security answer：</th>
							<td><input class="inpA" id="tbUserSecAns" size="25" name="tbUserSecAns" /></td>
							<td><span id="sUserSecAns"><span class="rf"> * Very important</span></span></td>
						</tr>
						<!--<tr>
							<th>Code：</th>
							<td><input name="tbSafeCode" type="text" id="tbSafeCode" style='text-transform:uppercase;' class="inp_yzm"/>&nbsp; <img id="regSafeCode" onclick="$('regSafeCode').src='inc/code.php';" src="inc/code.php" alt="refresh" style="cursor:pointer"  width="60" height="26" /> <a href="javascript:showCode();"></a></td>
							<td></td>
						</tr>
						-->
						<tr>
							<td colspan="3" align="center"><div align="center">
							&nbsp;
						      <!--<INPUT type=checkbox CHECKED value=checkbox name=agreement>
						      我已认真阅读并同意接受 《<A href="zc.php" target=_blank><span class="rf"><?//=$web_name;?> 会员服务条款</span></A>》</div></td>-->
						</tr>
						<tr>
							<th>&nbsp;</th>
							<td class="btn_reg"><input name="" type="submit" class="buttonreg" value=""></td>
							
							<!--
								原来的代码：<td class="btn_reg"><input name="" type="submit" class="buttonreg" value=""></td>
								<td class="btn_reg"><input name="" type="button" onclick="javascript:this.form.submit()" class="buttonreg" value=""></td>
								那你就不要用<input type="submit">和<button></button>.
								改用<input type="button" onclick="javascript:this.form.submit()">
								这样禁用了JS,也就不能再提交表单了.要么用户启用JS,要么选择离开.
								
								
								这个有点问题--会导致onsubmit时候js check失败
							-->
						</tr>
					</table>
				</form>
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