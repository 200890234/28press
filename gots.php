<?php 
$client = new SoapClient("http://interface.tourzj.gov.cn/complaint/service.asmx?wsdl");
$parameters=array(
		'GUID'=>"C8585F92-636E-4CE2-A338-02150B5E70D5",
		'Inputer'=>$_POST["Inputer"],
		'Sex'=>$_POST["Sex"],
		'DocumentType'=>$_POST["DocumentType"],
		'DocumentSN'=>$_POST["DocumentSN"],
		'Phone'=>$_POST["Phone"],
		'Mobile'=>$_POST["Mobile"],
		'Emil'=>$_POST["Emil"],
		'PostCode'=>$_POST["PostCode"],
		'Address'=>$_POST["Address"],
		'CName'=>$_POST["CName"],
		'CType'=>$_POST["CType"],
		'Province'=>$_POST["Province"],
		'City'=>$_POST["City"],
		'Time'=>$_POST["Time"],
		'PNub'=>$_POST["PNub"],
		'EType'=>$_POST["EType"],
		'GuideName'=>$_POST["GuideName"],
		'TravelWay'=>$_POST["TravelWay"],
		'TravelType'=>$_POST["TravelWay"],
		'Country'=>$_POST["Country"],
		'Content'=>$_POST["Content"]
		);
$p = $client->ComplaintInput($parameters);
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>温州 旅游质监</title>
<link href="http://info.wzta.gov.cn/templets/lyzj/css/public.css" rel="stylesheet" type="text/css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js" type="text/javascript"></script> 
<script src="http://info.wzta.gov.cn/templets/lyzj/js/yet.js" type="text/javascript"></script> 
<script src="http://info.wzta.gov.cn/templets/lyzj/js/MSClass.js" type="text/javascript"></script> 
<style type="text/css">
#newsList{overflow:hidden;}
#newslistul li a{font-size:12px;font-family: "微软雅黑";}
.sep{height:20px;clear:both;}
</style>
</head>

<body>
	<div class="headLayout">
		<div class="c_mt">
			<div class="Fleft">欢迎光临，温州旅游质监网</div>
			<div class="Fright">
				<ul>
					<li><a href="http://info.wzta.gov.cn/" target="_blank">资讯网</a></li>
					<li>|</li>
					<li><a href="http://zww.wzta.gov.cn/" target="_blank">政务网</a></li>
					<li>|</li>
					<li><a href="#" target="_blank">网站地图</a></li>
					<li>|</li>
					<li><a href="#" target="_blank">联系我们</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="topLayout">
	<form name="newsseach" id="newsseach" action="http://info.wzta.gov.cn/plus/searchZj.php">
		<div class="topMain">
			<ul>
				<li><input type="text" value="输入你要查找的内容" class="topMainTxt" onblur="if(this.value=='') this.value='请输入您要查找的内容'" onclick="this.value=''"  name="keyword" id="keyword" /></li>
				<input type="hidden" value="240" name="typeid">
				<li><input type="submit" value="" class="topMainBtn" /></li>
			</ul>
		</div>
	</form>
	</div>
	<div class="navLayout">
		<div class="c_mt">
			<ul>
				<li><a href="http://info.wzta.gov.cn/plus/list.php?tid=240">首页</a></li>
				<li><a href="http://info.wzta.gov.cn/plus/list.php?tid=241">质监动态</a></li>
				<li><a href="http://info.wzta.gov.cn/plus/list.php?tid=242">机构概况</a></li>
				<li><a href="http://info.wzta.gov.cn/plus/list.php?tid=243">公示公告</a></li>
				<li><a href="http://info.wzta.gov.cn/plus/list.php?tid=244" id="navCur">投诉指南</a></li>
				<li><a href="http://info.wzta.gov.cn/plus/list.php?tid=245">投诉季报</a></li>
				<li><a href="http://info.wzta.gov.cn/plus/list.php?tid=246">法规案例</a></li>
				<li><a href="http://info.wzta.gov.cn/plus/list.php?tid=247">推荐企业</a></li>
			</ul>
		</div>
	</div>
	<div class="clear"></div>
	<div class="c_mt_2">
		<div class="mainLayout">
			<div class="listMainRightTable">
				<form name="frm" action="?" method="post" onsubmit="return check()">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				  <tr>
					<td height="33" colspan="4" align="center" valign="middle"><span class="STYLE2">* 希望您在填写表单之前，通过本网了解有关投诉的法律</span></td>
				  </tr>
				  <tr>
					<td width="105" height="38" align="right" valign="middle">* 姓名：</td>
					<td height="38" colspan="3" align="left" valign="middle"><input name="Inputer" type="text" class="listMainRightTable_txt_1" /></td>
				  </tr>
				  <tr>
					<td width="105" height="38" align="right" valign="middle">* 性别：</td>
					<td width="209" height="38" align="left" valign="middle">
						<select name="sex">
							<option value="男">男</option>
							<option value="女">女</option>
						</select>
					</td>
					<td width="105" height="38" align="right" valign="middle">年龄：</td>
					<td width="209" height="38" align="left" valign="middle">
						<input name="Age" type="text" class="listMainRightTable_txt_1" />					</td>
				  </tr>
				  <tr>
					<td width="105" height="38" align="right" valign="middle">* 证件类型：</td>
					<td width="209" height="38" align="left" valign="middle">
						<select name="DocumentType">
							<option value="身份证">身份证</option>
							<option value="学生证">学生证</option>
						</select>
					</td>
					<td width="105" height="38" align="right" valign="middle">* 证件号码：</td>
					<td width="209" height="38" align="left" valign="middle">
						<input name="DocumetSN" type="text" class="listMainRightTable_txt_1" />				</td>
				  </tr>
				  <tr>
					<td width="105" height="38" align="right" valign="middle">手机号码：</td>
					<td width="209" height="38" align="left" valign="middle"><input name="Mobile" type="text" class="listMainRightTable_txt_1" /></td>
					<td width="105" height="38" align="right" valign="middle">联系电话：</td>
					<td width="209" height="38" align="left" valign="middle">
						<input type="text" name="Phone" class="listMainRightTable_txt_1" />					</td>
				  </tr>
				  <tr>
					<td width="105" height="38" align="right" valign="middle">Email：</td>
					<td width="209" height="38" align="left" valign="middle">
						<input type="text" name="Emil"  class="listMainRightTable_txt_1" />					</td>
					<td width="105" height="38" align="right" valign="middle">邮编：</td>
					<td width="209" height="38" align="left" valign="middle">
						<input type="text" name="PostCode" class="listMainRightTable_txt_1" />					</td>
				  </tr>
				  <tr>
					<td width="105" height="38" align="right" valign="middle">联系地址：</td>
					<td height="38" colspan="3" align="left" valign="middle">
						<input type="text" name="Address" class="listMainRightTable_txt_2" />					</td>
				  </tr>
				  <tr>
					<td width="105" height="38" align="right" valign="middle">* 被投诉单位：</td>
					<td height="38" colspan="3" align="left" valign="middle">
						<input type="text" name="CName" class="listMainRightTable_txt_2" />				</td>
				  </tr>
				  <tr>
					<td width="105" height="38" align="right" valign="middle">* 单位类型：</td>
					<td height="38" colspan="3" align="left" valign="middle">
						<select name="CType">
							<option value="旅行社">旅行社</option>
							<option value="学校">学校</option>
						</select>					</td>
				  </tr>
				  <tr>
					<td width="105" height="38" align="right" valign="middle">* 事件发生地：</td>
					<td height="38" colspan="3" align="left" valign="middle">
						<select name="Province">
							<option value="浙江省">浙江省</option>
							<option value="云南省">云南省</option>
						</select>
						省
						<select name="City">
							<option value="温州市">温州市</option>
							<option value="杭州市">杭州市</option>
						</select>
						市					</td>
				  </tr>
				  <tr>
					<td width="105" height="38" align="right" valign="middle">发生时间：</td>
					<td width="209" height="38" align="left" valign="middle">
						<input type="text" name="time" class="listMainRightTable_txt_1" />					</td>
					<td width="105" height="38" align="right" valign="middle">投诉人数：</td>
					<td width="209" height="38" align="left" valign="middle">
						<input type="text" name="PNub" class="listMainRightTable_txt_1" />					</td>
				  </tr>
				  <tr>
					<td width="105" height="38" align="right" valign="middle">问题类型：</td>
					<td width="209" height="38" align="left" valign="middle">
						<select name="EType">
							<option value="降低等级标准">降低等级标准</option>
							<option value="标准">标准</option>
						</select>					</td>
					<td width="105" height="38" align="right" valign="middle">导游姓名：</td>
					<td width="209" height="38" align="left" valign="middle">
						<input type="text" name="GuideName" class="listMainRightTable_txt_1" />					</td>
				  </tr>
				  <tr>
					<td width="105" height="38" align="right" valign="middle">旅游方式：</td>
					<td width="209" height="38" align="left" valign="middle">
						<select name="TravelWay">
							<option value="团体">团体</option>
							<option value="个人">个人</option>
						</select>					</td>
					<td width="105" height="38" align="right" valign="middle">旅游类型：</td>
					<td width="209" height="38" align="left" valign="middle">
						<select name="TravelType">
							<option value="国内旅游">国内旅游</option>
							<option value="入境旅游">入境旅游</option>
							<option value="出境旅游">出境旅游</option>
						</select>
					</td>
				  </tr>
				  <tr>
					<td width="105" height="38" align="right" valign="middle">国别：</td>
					<td height="38" colspan="3" align="left" valign="middle">
						<input type="text" name="Country" class="listMainRightTable_txt_1" />					</td>
				  </tr>
				  <tr>
					<td width="105" height="120" align="right" valign="top">* 投诉事由：</td>
					<td height="120" colspan="3" align="left" valign="top"><textarea name="Content"></textarea></td>
				  </tr>
				  <!--<tr>
					<td width="105" height="38" align="right" valign="middle">验证码：</td>
					<td height="38" colspan="3" align="left" valign="middle">
						<img src="images/listMainRightTable_pic.jpg" width="46" height="19" />
						<input type="text" class="listMainRightTable_txt_3" />					</td>
				  </tr>-->
				  <tr>
					<td width="105" height="65" align="right" valign="middle">&nbsp;</td>
					<td height="65" colspan="3" align="left" valign="middle">
						<input type="submit" value="提交" class="listMainRightTable_btn_1" />
						<input type="reset" value="重置" class="listMainRightTable_btn_1" />					</td>
				  </tr>
			  </table>
			  </form>
			</div>
		</div>
		<script type="text/javascript">
			function check(){
				if(frm.Inputer.value==""||frm.Sex.value==""||frm.DocumentType.value==""||frm.DocumetSN.value==""||frm.CName.value==""||frm.CType.value==""||frm.Province.value==""||frm.City.value==""||frm.Content.value==""){
					alert("请检查所有必填信息");
					return false;
				}
			}
		</script>
		<div class="clear"></div>
		<div class="clear"></div>
		<div class="mainFriend">
			<div class="mainFriendLeft"></div>
			<div class="mainFriendContent">
				<div class="mainFriendConCaption"></div>
				<div class="mainFriendConList">
					<ul>
						<li><a href="#">温州旅游网</a></li>
						<li>|</li>
						<li><a href="#">浙江旅游网</a></li>
						<li>|</li>
						<li><a href="#">浙江旅游质监网</a></li>
						<li>|</li>
						<li><a href="#">杭州旅游质检网</a></li>
						<li>|</li>
						<li><a href="#">湖州旅游质监网</a></li>
						<li>|</li>
						<li><a href="#">宁波旅游质监网</a></li>
						<li>|</li>
					</ul>
				</div>
				<div class="mainFriendConMore">
					<a href="#" title="更多 >>"></a>
				</div>
			</div>
			<div class="mainFriendRight"></div>
		</div>
	</div>
	<div class="clear"></div>
	<div class="footerLayout">
		<div class="footerLink">
			<a href="#">资讯网</a>
			<span>|</span>
			<a href="#">政务网</a>
			<span>|</span>
			<a href="#">网站地图</a>
			<span>|</span>
			<a href="#">联系我们</a>
		</div>
		<div class="footerCopyRight">
			版权所有：浙江省温州市旅游局 开发管理：温州市旅游信息中心 浙ICP备07032001号
		</div>
	</div>
</body>
</html>
