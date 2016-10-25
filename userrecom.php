<?php
include_once("inc/conn.php");
include_once("inc/function.php");
if ( $_COOKIE["usersid"]=="" )
{
$usersid="";
}
else
{
$usersid=$_COOKIE["usersid"];
}
//login_check();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Invite friends-<?=$web_name;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<meta name="keywords" content="<?=$web_keywords;?>" />
<meta name="description" content="<?=$web_description;?>" />
<META http-equiv=X-UA-Compatible content=IE=EmulateIE7>
<link href="style/default.css" rel="stylesheet" type="text/css" />
</head>
<?php include_once("top.php");?>
<script language="javascript">
qiehuan(3);
document.getElementById("qh_con3").getElementsByTagName('li')[4].className="current";
</script>
<DIV class="wrapper">
	<DIV class="page_content">
		<DIV class="webgame-activities-title">
			<H3>Earn <?php echo $web_moneyname;?> by inviting </H3>
		</DIV>
	  <div class="main_users">
				<TABLE cellSpacing=5 cellPadding=3 width="95%" align=center border=0>
                  <TBODY>
                    <TR>
                      <TD class=font14 style="font-size:15px;">
					  Why not invite your friends to join you in playing your favorite 28press lottery games?
					  Just tell your friends how you can’t stop playing 28press games & you’ll both benefit! 
					  <br>Invite a friend is quite easy, just copy the the link below and send to your friends via email, Instant communication tool... etc.
					  <br><br><span style="color:#C8F139;">Your referral link is :</span> <span style="color:#ECECEC;font-size:18px;"><?=$web_url.$web_dir;?>recom.php?userID=<?=$usersid?><br><font style="color:#FF6108;font-size:15px;">(Please note: Make sure you have already logged in, or this link does not work for you)</font></span>
					  <br><br>Here is the benifits:
					  </TD>
                    </TR>
                  </TBODY>
			  </TABLE>
				<TABLE class=font-hg cellSpacing=2 cellPadding=0 width="90%" align=center border=0>
                  <TBODY>
				   <TR>
                      <TD>1. Your account will instantly get <?php echo $web_linkpoints." ".$web_moneyname;?> bonus for each successful invitation. (limited-time offer)</TD>  
                    </TR>
					 <TR>
                      <TD>2. Every time your friends make a deposit, you'll get 2% bonus of the amount. (valid forever)</TD>
                    </TR>
                    <TR>
                      <TD><br><span style="font-size:14px;">Invite A Friend Terms And Conditions </span></TD>
                    </TR>
                    <TR>
                      <TD>1．New "friends" must be registered from their own computers, and cannot be registered from your computer. </TD>
                    </TR><TR>
                      <TD>2．To be eligible for the bonus, make sure that your “friends” use the referral link on your behalf. This is the only way they can be linked to you. </TD>
                    </TR>			
                    <TR>
                      <TD>3．As soon as these terms and conditions are met in full, your account will be credited with the bonus automatically followed by an email notification</TD>
                    </TR>
                    <TR>
                      <TD>4．A “friend” will receive an instant <?php echo $reg_points."".$web_moneyname;?>  bonus automatically as soon as his registration.</TD>
                    </TR>
					<TR>
                      <TD>5．Players are permitted to have a single 28press account only. Therefore, the “Referrer” and the “friend” may not hold any other accounts at 28press under other names or aliases. </TD>
                    </TR>
					<TR>
                      <TD>6．Players who abuse the above rules, or attempt to engage in any deceiving and/or fraudulent activity – including registering multiple accounts, will be banned from 28press immediately, and their accounts will be closed indefinitely.  </TD>
                    </TR>
                      <TD>7．Players and their friends must login their accounts with separate computers, or they will be suspected to be multiple accounts. </TD>
                    </TR>
                      <TD>8．This promotion is available all the time .  </TD><!--The management reserves the right to change or cancel this promotion at any time without any prior notice.-->
                    </TR>
					
                  </TBODY>
			  </TABLE>
				<!--<TABLE cellSpacing=0 cellPadding=0 width="90%" align=center border=0>
                  <TBODY>
                    <TR>
                      <TD><TABLE cellSpacing=3 cellPadding=3 width="95%" align=center border=0>
                          <TBODY>
                            <TR>
                              <TD width="4%"><IMG height=13 src="images/hytj1_06.jpg" width=14></TD>
                              <TD class=font-hg width="45%">推荐好友多,奖品多！快把下面地址发给你的好友吧！<BR>
                                  <?//=$web_url.$web_dir;?>recom.php?userID=<?//=$usersid?></TD>Referrer Link
                              <TD width="51%"><A onClick="copy('<?//=$web_url.$web_dir;?>recom.php?userID=<?//=$usersid?>','成功复制到剪贴板！')" href="javascript:void(0)"><IMG height=25 src="images/hytj1_10.jpg" width=183 border=0></A></TD>
                            </TR>
                          </TBODY>
                      </TABLE></TD>
                    </TR>
                  </TBODY>			  
				 </TABLE>
				 -->
		</div>
		<div class="area960-b h5px"></div>
		<DIV class=cl></DIV>
	</div>
	<!--Flink End-->
	<div class="blank10"></div>
	<!--Footer Start-->
<?php include_once("footer.php");?>
<script type="text/javascript">
function copy(value,msg){
	var clipBoardContent=''; 	
	clipBoardContent += value;
	window.clipboardData.setData("Text",clipBoardContent);
	alert(msg);
}

function $(obj){
	return typeof(obj) == "string" ? document.getElementById(obj) : obj;
}
</script>
</DIV>