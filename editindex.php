<?php
include_once("inc/conn.php");
include_once("inc/function.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>��Ϊ��ҳ-<?=$web_name;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<meta name="keywords" content="<?=$web_keywords;?>" />
<meta name="description" content="<?=$web_description;?>" />
<META http-equiv=X-UA-Compatible content=IE=EmulateIE7>
<link href="style/default.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="inc/ajaxrequest.js"></script>
</head>
<?php include_once("top.php");?>
<script language="javascript">
qiehuan(1);
document.getElementById("qh_con1").getElementsByTagName('li')[0].className="current";
</script>
<DIV class="wrapper">
	<DIV class="page_content">
		<DIV class="webgame-info-title">
			<H3>��Ϊ��ҳ</H3>
		</DIV>
			<UL class="webgame-info">
			  <table width="90%" border="0" align="center" cellpadding="5" cellspacing="5">
                <tr>
                  <td width="27%" align="center"><table width="96%"  border="0" cellspacing="5" cellpadding="0">
                      <tr>
                        <td><a href="javascript:void(0)" onclick="this.style.behavior='url(#default#homepage)'; this.setHomePage('<?=$web_url?>');"><img src="images/home_05.jpg" width="167" height="45" /></a></td>
                      </tr>
                      <tr>
                        <td><a href="javascript:void(0)" onclick="Check()"><img src="images/home_08.jpg" width="167" height="45" /></a></td>
                      </tr>
                  </table></td>
                  <td width="73%" valign="top" class="font14 rf"><p style="margin:5px;">1���������Ϊ��ҳ��ť���ڵ��������е�ȷ����</p>
                      <p style="margin:5px;">2�������鰴ť��ϵͳ�ᵯ�����������������������ȷ����</p>
                      <p style="margin:5px;">3��������飬�ر�ҳ����50<?=$web_moneyname?>��</p>
                      <p style="margin:5px;">ע��:ÿ��IDֻ������һ��!</p></td>
                </tr>
              </table>
			  <script language="JavaScript"> 
				function Check(){
					var url = '<?=$web_url?>/';
					document.body.style.behavior="url(#default#homepage)";
					if(!document.body.isHomePage(url)){
						alert('�Բ�������������ҳ��');	
						return false;
					}
					
					var ajax=new AJAXRequest({
							url: "inc/ajaxindex.php",
							method: "GET",
							oncomplete: ProcCheckDefaultHome,
							charset: "GB2312"
						});
					ajax.get();
					
					}
				function ProcCheckDefaultHome(obj){
					if(obj.responseText != "null"){
						if(obj.responseText=="changed"){
							alert("�Բ��𣬽������Ѿ����ù���ҳ�ˣ�");
							return false;
						}
						if(obj.responseText=="false"){
							alert("�Բ��𣬷�����δ��Ӧ��");
							return false;
						}
						if(obj.responseText == "true"){
							alert("��ϲ���Ѿ��ɹ����50<?=$web_moneyname?>��");
							return true;
						}
					}
				}
				</script>
			</UL>
		<div class="area960-b h5px"></div>
		<div class="blank10"></div>
	</div>
	<!--Flink End-->
	<DIV class=cl></DIV>
	<div class="blank10"></div>
	<!--Footer Start-->
<?php include_once("footer.php");?>
</DIV>