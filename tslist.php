<?php
header("content-type:text/html;charset=utf-8");
error_reporting(0);
$client = new SoapClient("http://interface.tourzj.gov.cn/complaint/service.asmx?wsdl");
$parameters=array('GUID'=>"C8585F92-636E-4CE2-A338-02150B5E70D5",'BeginDate'=>"2010-01-01",'EndDate'=>"2014-01-01");
$p = $client->ComplaintGet($parameters);
function objtoarr($obj){
	$ret = array();
	foreach($obj as $key =>$value){
		if(gettype($value) == 'array' || gettype($value) == 'object'){
			$ret[$key] = objtoarr($value);
		}
		else{
			$ret[$key] = htmlspecialchars($value);
		}
	}
	return $ret;
}
$array = get_object_vars($p);
$arrp=objtoarr($array);
$arrpxml=$arrp['ComplaintGetResult']['any'];

$str0 = htmlspecialchars_decode($arrpxml);
$str=htmlspecialchars_decode(str_replace(":", "-", $str0));//:转换掉
$pattern="/<Table.*?<\/Table>/";
preg_match_all($pattern, $str, $matches);



function getrs($reg,$str){
	preg_match($reg, $str, $arr);
	$rs=$arr[1];
	return $rs;
}
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
			<div class="lytsIndexMainListRightCon">
				<h5>旅游服务投诉</h5>
				<div class="lytsIndexMainListRightConSearch">
					<ul>
						<li>
							<select>
								<option>受理编号</option>
								<option>电话号码</option>
								<option>投诉人</option>
							</select>
						</li>
						<li>
							<input type="text" class="lytsIndexMainListRightConSearch_txt" />
						</li>
						<li>
							<input type="submit" value="查询" class="lytsIndexMainListRightConSearch_btn" />
						</li>
					</ul>
				</div>
				<div class="lytsIndexMainListRightConList">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
					  <tr>
						<td width="20" height="30" align="left" valign="middle" bgcolor="#bbbbbb"></td>
						<td width="115" height="30" align="center" valign="middle" bgcolor="#bbbbbb">投诉人</td>
						<td width="75" height="30" align="center" valign="middle" bgcolor="#bbbbbb">投诉天数</td>
						<td width="280" height="30" align="center" valign="middle" bgcolor="#bbbbbb">被投诉单位</td>
						<td width="80" height="30" align="center" valign="middle" bgcolor="#bbbbbb">投诉时间</td>
						<td height="30" align="center" valign="middle" bgcolor="#bbbbbb">处理状态</td>
					  </tr>
					  <tr>
					  	<td colspan="6">
					  		<table width="100%" border="0" cellspacing="0" cellpadding="0" id="tb">
					  <?php
					  for($i=0;$i<count($matches[0]);$i++){
							$con=$matches[0][$i];
							$date="/<ComplaintDate>(.*)<\/ComplaintDate>/";
							$name="/<CompLainterName>(.*)<\/CompLainterName>/";
							$gender="/<Gender>(.*)<\/Gender>/";
							$tel="/<Tel>(.*)<\/Tel>/";
							$mobile="/<Mobile>(.*)<\/Mobile>/";
							$companyname="/<CompanyName>(.*)<\/CompanyName>/";
							$happendprovince="/<happendProvince>(.*)<\/happendProvince>/";
							$happendcity="/<happendcity>(.*)<\/happendcity>/";
							$happendtime="/<happendTime>(.*)<\/happendTime>/";
							$companytype="/<CompanyType>(.*)<\/CompanyType>/";
							$guidename="/<GuideName>(.*)<\/GuideName>/";
							$eventType="/<EventType>(.*)<\/EventType>/";
							$content="/<Content>(.*)<\/Content>/";
							//受理情况相关???
							$dealresult="/<DealResult>(.*)<\/DealResult>/";
							$memo="/<Memo>(.*)<\/Memo>/";
							
							$date=getrs($date, $con);
							$name=getrs($name, $con);
							$gender=getrs($gender, $con);
							$tel=getrs($tel, $con);
							$mobile=getrs($mobile, $con);
							$companyname=getrs($companyname, $con);
							$happendprovince=getrs($happendprovince, $con);
							$happendcity=getrs($happendcity, $con);
							$happendtime=getrs($happendtime, $con);
							$companytype=getrs($companytype, $con);
							$guidename=getrs($guidename, $con);
							$eventType=getrs($eventType, $con);
							$content=getrs($content, $con);
							$dealresult=getrs($dealresult, $con);
							$memo=getrs($memo, $con);
							//echo $tel."ss".$i."<br>";
							$html='<tr>
									<td width="20" align="left" valign="middle"></td>
									<td width="115" align="left" valign="middle"><a href="tscontent.php?name='.$name.'&companyname='.$companyname.'&date='.$date.'&dealresult='.$dealresult.'&memo='.$memo.'" target="_blank">'.$name.'</a></td>
									<td width="75" align="center" valign="middle">1</td>
									<td width="280" align="left" valign="middle">'.$companyname.'</td>
									<td width="80" align="center" valign="middle">'.$date.'</td>
									<td width="72" align="center" valign="middle"></td>
								  </tr>';
							echo $html;	  
							}
					  ?>
								</table>
							</td>
						</tr>
						
						<script language="javascript">
						var obj,j;
						var page=0;
						var nowPage=0;//当前页
						var listNum=6;//每页显示<ul>数
						var PagesLen;//总页数
						var PageNum=4;//分页链接接数(5个)
						onload=function(){
						obj=document.getElementById("tb").getElementsByTagName("tr");
						j=obj.length
						PagesLen=Math.ceil(j/listNum);
						upPage(0)
						}
						function upPage(p){
						nowPage=p
						//内容变换
						for (var i=0;i<j;i++){
						obj[i].style.display="none"
						}
						for (var i=p*listNum;i<(p+1)*listNum;i++){
						if(obj[i])obj[i].style.display="block"
						}
						//分页链接变换
						strS='<a href="###" onclick="upPage(0)">首页</a>  '
						var PageNum_2=PageNum%2==0?Math.ceil(PageNum/2)+1:Math.ceil(PageNum/2)
						var PageNum_3=PageNum%2==0?Math.ceil(PageNum/2):Math.ceil(PageNum/2)+1
						var strC="",startPage,endPage;
						if (PageNum>=PagesLen) {startPage=0;endPage=PagesLen-1}
						else if (nowPage<PageNum_2){startPage=0;endPage=PagesLen-1>PageNum?PageNum:PagesLen-1}//首页
						else {startPage=nowPage+PageNum_3>=PagesLen?PagesLen-PageNum-1: nowPage-PageNum_2+1;var t=startPage+PageNum;endPage=t>PagesLen?PagesLen-1:t}
						for (var i=startPage;i<=endPage;i++){
						 if (i==nowPage)strC+='<a href="###" style="color:red;font-weight:700;" onclick="upPage('+i+')">'+(i+1)+'</a> '
						 else strC+='<a href="###" onclick="upPage('+i+')">'+(i+1)+'</a> '
						}
						strE=' <a href="###" onclick="upPage('+(PagesLen-1)+')">尾页</a>  '
						strE2=nowPage+1+"/"+PagesLen+"页"+"  共"+j+"条"
						document.getElementById("changpage").innerHTML=strS+strC+strE+strE2
						}
						</script>

					  <!--<tr>
						<td width="20" align="left" valign="middle" bgcolor="#efefef"></td>
						<td width="115" align="left" valign="middle" bgcolor="#efefef"><a href="#" target="_blank">张雪</a></td>
						<td width="75" align="center" valign="middle" bgcolor="#efefef">2</td>
						<td width="280" align="left" valign="middle" bgcolor="#efefef">咨询投诉信息</td>
						<td width="80" align="center" valign="middle" bgcolor="#efefef">2013-05-17</td>
						<td align="center" valign="middle" bgcolor="#efefef">并案</td>
					  </tr>
					  <tr>
						<td width="20" align="left" valign="middle"></td>
						<td width="115" align="left" valign="middle"><a href="#" target="_blank">徐宁</a></td>
						<td width="75" align="center" valign="middle">3</td>
						<td width="280" align="left" valign="middle">温州海外旅游公司</td>
						<td width="80" align="center" valign="middle">2013-05-17</td>
						<td align="center" valign="middle">结案</td>
					  </tr>
					  <tr>
						<td width="20" align="left" valign="middle" bgcolor="#efefef"></td>
						<td width="115" align="left" valign="middle" bgcolor="#efefef"><a href="#" target="_blank">陶方</a></td>
						<td width="75" align="center" valign="middle" bgcolor="#efefef">5</td>
						<td width="280" align="left" valign="middle" bgcolor="#efefef">温州银海宾</td>
						<td width="80" align="center" valign="middle" bgcolor="#efefef">2013-05-17</td>
						<td align="center" valign="middle" bgcolor="#efefef">结案</td>
					  </tr>
					  <tr>
						<td width="20" align="left" valign="middle"></td>
						<td width="115" align="left" valign="middle"><a href="#" target="_blank">金荣</a></td>
						<td width="75" align="center" valign="middle">0</td>
						<td width="280" align="left" valign="middle">乐清市仙溪漂流</td>
						<td width="80" align="center" valign="middle">2013-05-17</td>
						<td align="center" valign="middle">并案</td>
					  </tr>
					  <tr>
						<td width="20" align="left" valign="middle" bgcolor="#efefef"></td>
						<td width="115" align="left" valign="middle" bgcolor="#efefef"><a href="#" target="_blank">陶方</a></td>
						<td width="75" align="center" valign="middle" bgcolor="#efefef">5</td>
						<td width="280" align="left" valign="middle" bgcolor="#efefef">温州银海宾</td>
						<td width="80" align="center" valign="middle" bgcolor="#efefef">2013-05-17</td>
						<td align="center" valign="middle" bgcolor="#efefef">结案</td>
					  </tr>
					  -->
					  <tr>
						<td height="30" colspan="6" align="center" valign="middle" bgcolor="#bbbbbb">
							<div class="lytsIndexMainListRightConListPage">
								<!-- <a href="#">上一页</a>
								<a href="#">1</a>
								<a href="#">2</a>
								<a href="#">3</a>
								<a href="#">4</a>
								<a href="#">5</a>
								<a href="#">下一页</a> -->
								<div id="changpage"></div>
							</div>
						</td>
					  </tr>
				  </table>
				</div>
			</div>
		</div>
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
