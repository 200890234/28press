<?php
include_once("inc/conn.php");
include_once("inc/function.php");
login_check();

if($_GET["act"]=="modify"){
	$str = "card_".intval($_COOKIE["usersid"]);
	if($_FILES['tbUserPhoto']['name']!=''){
			$tmp_file=$_FILES['tbUserPhoto']['tmp_name'];
			$file_types=explode(".",$_FILES['tbUserPhoto']['name']);
			$file_type=$file_types[count($file_types)-1];
			if(strtolower($file_type)!="jpg"&strtolower($file_type)!="gif"&strtolower($file_type)!="bmp"&strtolower($file_type)!="png"){
				  echo "<script language=javascript>alert('you can only upload jpg,gif and bmp image file');history.go(-1);</script>";
				  exit;
			}
			$file_name=$str.".".$file_type;
			if(!copy($tmp_file,$web_headdir.$file_name)){
				echo "<script language=javascript>alert('error,please try again！');history.go(-1);</script>";
				exit;
			}
	}
	if($_FILES['tbUserPhoto']['name']!=''){
		$UserPhoto=$web_headdir.$file_name;
	}else{
		$UserPhoto=$_POST["tbSysPhoto"];
	}
	if($_POST["tbUserInterested"]){
		$tbUserInterested=implode(",",str_check($_POST["tbUserInterested"]));
	}
	$db->query("update {$web_dbtop}users set name='".str_check($_POST["tbUserNick"])."',sex='".str_check($_POST["tbUserGender"])."',lr_acc='".str_check($_POST["tbUserLr"])."',head='".$UserPhoto."',qq='".str_check($_POST["tbUserQQ"])."',birthday='".intval($_POST["tbBirthYear"])."-".intval($_POST["tbBirthMonth"])."-".intval($_POST["tbBirthDay"])."'
	,tel='".str_check($_POST["tbUserPhone"])."',address='".str_check($_POST["tbUserPro"])."-".str_check($_POST["tbUserCity"])."-".str_check($_POST["tbUserAddr"])."',education='".str_check($_POST["tbUserQualifications"])."',job='".str_check($_POST["tbUserJob"])."',bent='".$tbUserInterested."',caption='".str_check($_POST['tbUserDescription'])."' where id=".intval($_COOKIE["usersid"])." and password='".str_check($_COOKIE["password"])."'");
	echo "<script language=javascript>alert('uopdate success');location.href='userinfo.php';</script>";
	exit;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Member-<?=$web_name;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<meta name="keywords" content="<?=$web_keywords;?>" />
<meta name="description" content="<?=$web_description;?>" />
<META http-equiv=X-UA-Compatible content=IE=EmulateIE7>
<link href="style/default.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="inc/area.js"></script>
</head>
<?php include_once("top.php");?>
<script language="javascript">
qiehuan(7);
document.getElementById("qh_con7").getElementsByTagName('li')[8].className="current";
</script>
<DIV class="wrapper">
	<DIV class="page_content">
  		<!--主体右边 Start-->
    	<div class="area260 fl" style="float:left;">
			<DIV class="news-title">
				<span><a href="news_lest.php">More&raquo;</a></span>
				 <H3 style="color:white;font-size:15px;">Latest News</H3>
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
				<span><a href="help_lest.php">More&raquo;</a></span>
				 <H3 style="color:white;font-size:15px;">Users Guide</H3>
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
		<!--主体左边 Start-->
		<div class="area690 fr">
			<DIV class="users-title">
				 <H3>Edit Profile</H3>
			</DIV>
        	<div class="users-content">
				<?
				$query=$db->query("Select * From {$web_dbtop}users where id=".intval($_COOKIE["usersid"])." and password='".str_check($_COOKIE["password"])."'");
				if($rs=$db->fetch_array($query)){
				$sex=$rs["sex"];
				$head=$rs["head"];
				$qq=$rs["qq"];
				$lr_acc=$rs["lr_acc"];
				$birthday=explode("-",$rs["birthday"]);
				$authentication=$rs["authentication"];
				$tel=$rs["tel"];
				$address=explode("-",$rs["address"]);
				$education=$rs["education"];
				$job=$rs["job"];
				$bent=$rs["bent"];
				$caption=$rs["caption"];
				}
				?>
        		<form action="?act=modify" method="post" enctype="multipart/form-data">
				<ul class="bgk">
				<li class="b21" style="text-align:right"><span>Nickname：</span></li>
				<li class="b22"><span style="padding-left:5px"><input  name="tbUserNick" type="text" id="tbUserNick" value="<?=$rs["name"]?>" size="25" /></span></li>
				<li class="b21" style="text-align:right"><span>Gender：</span></li>
				<li class="b22"><span style="padding-left:5px"><input name="tbUserGender" type="radio" value="M" checked="checked"  <? if($sex=="M") echo"checked";?>/>
									Male
									<input name="tbUserGender" type="radio" value="F" <? if($sex=="F") echo"checked";?> />
								  Female			  </span></li>
				<li class="bh1" style="text-align:right"><span>Photo：</span></li>
				<li class="bh2"><span style="padding-left:5px">
					  <input type="file" name="tbUserPhoto" onpropertychange="$('imgPhoto').src=this.value+'?'+Math.random();" /><img id="imgPhoto" width="150" height="150" src="<?=$head;?>" onerror="this.src='images/head/1_0.jpg'" />
								  <br />
								  <span class="fontred">（.JPG，.GIF，.BMP only，no more than 2M）</span></span></li>
				<!--<li class="b21"><span style="padding-left:55px">系统头像：</span></li>
				<li class="b22"><span style="padding-left:5px"><select name="tbSysPhoto" onchange="document.getElementById('imgPhoto').src=this.value;">
												<option value="images/head/1_0.jpg" <? if($head=="images/head/1_0.jpg") echo"selected";?>>默认男</option>
												<option value="images/head/1_1.jpg" <? if($head=="images/head/1_1.jpg") echo"selected";?>>男一</option>
												<option value="images/head/1_2.jpg" <? if($head=="images/head/1_2.jpg") echo"selected";?>>男二</option>
												<option value="images/head/1_3.jpg" <? if($head=="images/head/1_3.jpg") echo"selected";?>>男三</option>
												<option value="images/head/1_4.jpg" <? if($head=="images/head/1_4.jpg") echo"selected";?>>男四</option>
												<option value="images/head/1_5.jpg" <? if($head=="images/head/1_5.jpg") echo"selected";?>>男五</option>
												<option value="images/head/1_6.jpg" <? if($head=="images/head/1_6.jpg") echo"selected";?>>男六</option>
												<option value="images/head/1_7.jpg" <? if($head=="images/head/1_7.jpg") echo"selected";?>>男七</option>
												<option value="images/head/1_8.jpg" <? if($head=="images/head/1_8.jpg") echo"selected";?>>男八</option>
												<option value="images/head/0_0.jpg" <? if($head=="images/head/0_0.jpg") echo"selected";?>>默认女</option>
												<option value="images/head/0_1.jpg" <? if($head=="images/head/0_1.jpg") echo"selected";?>>女一</option>
												<option value="images/head/0_2.jpg" <? if($head=="images/head/0_2.jpg") echo"selected";?>>女二</option>
												<option value="images/head/0_3.jpg" <? if($head=="images/head/0_3.jpg") echo"selected";?>>女三</option>
												<option value="images/head/0_4.jpg" <? if($head=="images/head/0_4.jpg") echo"selected";?>>女四</option>
												<option value="images/head/0_5.jpg" <? if($head=="images/head/0_5.jpg") echo"selected";?>>女五</option>
												<option value="images/head/0_6.jpg" <? if($head=="images/head/0_6.jpg") echo"selected";?>>女六</option>
												<option value="images/head/0_7.jpg" <? if($head=="images/head/0_7.jpg") echo"selected";?>>女七</option>
												<option value="images/head/0_8.jpg" <? if($head=="images/head/0_8.jpg") echo"selected";?>>女八</option>
												</select></span>
				
				</li>--》
				<!--<li class="b21"><span style="padding-left:58px">用户QQ：</span></li>
				<li class="b22"><span style="padding-left:5px"><input name="tbUserQQ" id="tbUserQQ" type="text" maxlength="15" value="<?php //echo $qq;?>" size="25" /></span></li>-->
				<li class="b21" style="text-align:right"><span>LR account：</span></li>
				<li class="b22"><span style="padding-left:5px"><input name="tbUserLr" id="tbUserLr" type="text" maxlength="15" value="<?php echo $lr_acc;?>" size="25" /></span></li>
				<li class="b21" style="text-align:right"><span>Birthdate：</span></li>
				<li class="b22"><span style="padding-left:5px">
				<select name="tbBirthDay">
					<option label="01" value="1" <? if($birthday[2]==1) echo"selected";?>>01</option>
					<option label="02" value="2" <? if($birthday[2]==2) echo"selected";?>>02</option>
					<option label="03" value="3" <? if($birthday[2]==3) echo"selected";?>>03</option>
					<option label="04" value="4" <? if($birthday[2]==4) echo"selected";?>>04</option>
					<option label="05" value="5" <? if($birthday[2]==5) echo"selected";?>>05</option>
					<option label="06" value="6" <? if($birthday[2]==6) echo"selected";?>>06</option>
					<option label="07" value="7" <? if($birthday[2]==7) echo"selected";?>>07</option>
					<option label="08" value="8" <? if($birthday[2]==8) echo"selected";?>>08</option>
					<option label="09" value="9" <? if($birthday[2]==9) echo"selected";?>>09</option>
					<option label="10" value="10" <? if($birthday[2]==10) echo"selected";?>>10</option>
					<option label="11" value="11" <? if($birthday[2]==11) echo"selected";?>>11</option>
					<option label="12" value="12" <? if($birthday[2]==12) echo"selected";?>>12</option>
					<option label="13" value="13" <? if($birthday[2]==13) echo"selected";?>>13</option>
					<option label="14" value="14" <? if($birthday[2]==14) echo"selected";?>>14</option>
					<option label="15" value="15" <? if($birthday[2]==15) echo"selected";?>>15</option>
					<option label="16" value="16" <? if($birthday[2]==16) echo"selected";?>>16</option>
					<option label="17" value="17" <? if($birthday[2]==17) echo"selected";?>>17</option>
					<option label="18" value="18" <? if($birthday[2]==18) echo"selected";?>>18</option>
					<option label="19" value="19" <? if($birthday[2]==19) echo"selected";?>>19</option>
					<option label="20" value="20" <? if($birthday[2]==20) echo"selected";?>>20</option>
					<option label="21" value="21" <? if($birthday[2]==21) echo"selected";?>>21</option>
					<option label="22" value="22" <? if($birthday[2]==22) echo"selected";?>>22</option>
					<option label="23" value="23" <? if($birthday[2]==23) echo"selected";?>>23</option>
					<option label="24" value="24" <? if($birthday[2]==24) echo"selected";?>>24</option>
					<option label="25" value="25" <? if($birthday[2]==25) echo"selected";?>>25</option>
					<option label="26" value="26" <? if($birthday[2]==26) echo"selected";?>>26</option>
					<option label="27" value="27" <? if($birthday[2]==27) echo"selected";?>>27</option>
					<option label="28" value="28" <? if($birthday[2]==28) echo"selected";?>>28</option>
					<option label="29" value="29" <? if($birthday[2]==29) echo"selected";?>>29</option>
					<option label="30" value="30" <? if($birthday[2]==30) echo"selected";?>>30</option>
					<option label="31" value="31" <? if($birthday[2]==31) echo"selected";?>>31</option>
				</select>
				<select name="tbBirthMonth">
					<option label="01" value="01" <? if($birthday[1]==1) echo"selected";?>>01</option>
					<option label="02" value="02" <? if($birthday[1]==2) echo"selected";?>>02</option>
					<option label="03" value="03" <? if($birthday[1]==3) echo"selected";?>>03</option>
					<option label="04" value="04" <? if($birthday[1]==4) echo"selected";?>>04</option>
					<option label="05" value="05" <? if($birthday[1]==5) echo"selected";?>>05</option>
					<option label="06" value="06" <? if($birthday[1]==6) echo"selected";?>>06</option>
					<option label="07" value="07" <? if($birthday[1]==7) echo"selected";?>>07</option>
					<option label="08" value="08" <? if($birthday[1]==8) echo"selected";?>>08</option>
					<option label="09" value="09" <? if($birthday[1]==9) echo"selected";?>>09</option>
					<option label="10" value="10" <? if($birthday[1]==10) echo"selected";?>>10</option>
					<option label="11" value="11" <? if($birthday[1]==11) echo"selected";?>>11</option>
					<option label="12" value="12" <? if($birthday[1]==12) echo"selected";?>>12</option>
				</select>
				
				<select name="tbBirthYear">
					<option label="1969" value="1969" <? if($birthday[0]==1969) echo"selected";?>>1969</option>
					<option label="1970" value="1970" <? if($birthday[0]==1970) echo"selected";?>>1970</option>
					<option label="1971" value="1971" <? if($birthday[0]==1971) echo"selected";?>>1971</option>
					<option label="1972" value="1972" <? if($birthday[0]==1972) echo"selected";?>>1972</option>
					<option label="1973" value="1973" <? if($birthday[0]==1973) echo"selected";?>>1973</option>
					<option label="1974" value="1974" <? if($birthday[0]==1974) echo"selected";?>>1974</option>
					<option label="1975" value="1975" <? if($birthday[0]==1975) echo"selected";?>>1975</option>
					<option label="1976" value="1976" <? if($birthday[0]==1976) echo"selected";?>>1976</option>
					<option label="1977" value="1977" <? if($birthday[0]==1977) echo"selected";?>>1977</option>
					<option label="1978" value="1978" <? if($birthday[0]==1978) echo"selected";?>>1978</option>
					<option label="1979" value="1979" <? if($birthday[0]==1979) echo"selected";?>>1979</option>
					<option label="1980" value="1980" <? if($birthday[0]==1980) echo"selected";?>>1980</option>
					<option label="1981" value="1981" <? if($birthday[0]==1981) echo"selected";?>>1981</option>
					<option label="1982" value="1982" <? if($birthday[0]==1982) echo"selected";?>>1982</option>
					<option label="1983" value="1983" <? if($birthday[0]==1983) echo"selected";?>>1983</option>
					<option label="1984" value="1984" <? if($birthday[0]==1984) echo"selected";?>>1984</option>
					<option label="1985" value="1985" <? if($birthday[0]==1985) echo"selected";?>>1985</option>
					<option label="1986" value="1986" <? if($birthday[0]==1986) echo"selected";?>>1986</option>
					<option label="1987" value="1987" <? if($birthday[0]==1987) echo"selected";?>>1987</option>
					<option label="1988" value="1988" <? if($birthday[0]==1988) echo"selected";?>>1988</option>
					<option label="1989" value="1989" <? if($birthday[0]==1989) echo"selected";?>>1989</option>
					<option label="1990" value="1990" <? if($birthday[0]==1990) echo"selected";?>>1990</option>
					<option label="1991" value="1991" <? if($birthday[0]==1991) echo"selected";?>>1991</option>
					<option label="1992" value="1992" <? if($birthday[0]==1992) echo"selected";?>>1992</option>
					<option label="1993" value="1993" <? if($birthday[0]==1993) echo"selected";?>>1993</option>
					<option label="1994" value="1994" <? if($birthday[0]==1994) echo"selected";?>>1994</option>
					<option label="1995" value="1995" <? if($birthday[0]==1995) echo"selected";?>>1995</option>
					<option label="1996" value="1996" <? if($birthday[0]==1996) echo"selected";?>>1996</option>
					<option label="1997" value="1997" <? if($birthday[0]==1997) echo"selected";?>>1997</option>
					<option label="1998" value="1998" <? if($birthday[0]==1998) echo"selected";?>>1998</option>
					<option label="1999" value="1999" <? if($birthday[0]==1999) echo"selected";?>>1999</option>
					<option label="2000" value="2000" <? if($birthday[0]==2000) echo"selected";?>>2000</option>
					<option label="2001" value="2001" <? if($birthday[0]==2001) echo"selected";?>>2001</option>
					<option label="2002" value="2002" <? if($birthday[0]==2002) echo"selected";?>>2002</option>
					<option label="2003" value="2003" <? if($birthday[0]==2003) echo"selected";?>>2003</option>
					<option label="2004" value="2004" <? if($birthday[0]==2004) echo"selected";?>>2004</option>
					<option label="2005" value="2005" <? if($birthday[0]==2005) echo"selected";?>>2005</option>
					<option label="2006" value="2006" <? if($birthday[0]==2006) echo"selected";?>>2006</option>
					<option label="2007" value="2007" <? if($birthday[0]==2007) echo"selected";?>>2007</option>
					<option label="2008" value="2008" <? if($birthday[0]==2008) echo"selected";?>>2008</option>
					<option label="2009" value="2009" <? if($birthday[0]==2009) echo"selected";?>>2009</option>
				</select>
				
				</span></li>
				<li class="b21" style="text-align:right"><span>Mobile：</span></li>
				<li class="b22"><span style="padding-left:5px"><input name="tbUserPhone" id="tbUserPhone" maxlength="15" type="text" value="<?=$tel;?>" size="25" /></span></li>
				<li class="bd21" style="text-align:right"><span>Introduction：</span></li>
				<li class="bd22"><span style="padding-left:5px"><textarea name="tbUserDescription" id="tbUserDescription" cols="40" rows="5" class="table1_text300"><?=$caption;?></textarea></span></li>
				<li class="tj"><input id="btnSubmit" type="image" src="images/an_ljtj_03.gif"  border="0" /></li>
				</ul>
				</form>
			</div>
			<div class="area690-b h5px"></div>
        	<div class="blank10"></div>
		</div>
		<!--主体左边 End-->
	</DIV>
	<!--Flink End-->
	<div class="blank10"></div>
	<!--Footer Start-->
<?php include_once("footer.php");?>
</DIV>