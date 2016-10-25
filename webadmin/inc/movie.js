function CheckAll(v)
	{
		var i;
		for (i=0;i<document.form.elements.length;i++)
		{
			var e = document.form.elements[i];
		        e.checked = v;
		}
}

function chkCheckBoxChs(objNam){
var obj = document.getElementsByName(objNam);
var objLen= obj.length;
var objYN;
var i;
objYN=false;
	for (i = 0;i< objLen;i++){
		if (obj [i].checked==true) {
			objYN= true;
		break;
		}
	}
return objYN;
}

function ChangeCut(Flag)
{
	switch (Flag)
	{
		case 0 :
			document.getElementById("smstype").style.display='none';
			document.getElementById("smsusers").style.display='none';
			break;
		default :
			document.getElementById("smstype").style.display='';
			document.getElementById("smsusers").style.display='';
			break;
	}
}

function setdayjs(id)
{ 
	var iWidth = document.documentElement.scrollWidth; 
	var iHeight = document.documentElement.scrollHeight; 
	var bgObj = document.createElement("div");
	bgObj.style.cssText = "position:absolute;left:0px;top:0px;width:"+iWidth+"px;height:"+Math.max(document.body.clientHeight, iHeight)+"px;filter:Alpha(Opacity=50);opacity:0.3;background-color:#ffffff;z-index:101;";
	bgObj.id="bgObj";
	document.body.appendChild(bgObj); 
	
	var divObj = document.createElement("div");
	divObj.style.cssText ="position: absolute;left:0px;top:0px;z-index:102;width:215px; height:20px;border:1px solid #ffbe8c;background: #fff1e7;padding:3px 0px 3px 4px;";
	divObj.id="divObj";
	document.getElementById(id).appendChild(divObj);
	
	var obj = document.getElementById(id);
	var th = obj;
	var ttop = obj.offsetTop;
    var tleft = obj.offsetLeft; 
    while (obj = obj.offsetParent){ttop+=obj.offsetTop; tleft+=obj.offsetLeft;}
    divObj.style.top = (ttop-1)+"px";
    divObj.style.left = (tleft-1)+"px"; 
	divObj.innerHTML="成交<input name=\"cjjg\" type=\"text\"  size=\"10\">元 <input name=\"cjid\" type=\"hidden\" value=\""+id+"\"><input type=\"button\" value=\"确定\" onclick=\"document.form.action='?action=edit';document.form.submit();\" class=inputbut> <input type=\"button\" value=\"取消\" onclick=\"closew("+id+");\" class=inputbut>";
	
}

function closew(id){
	document.body.removeChild(document.getElementById("bgObj"));
	document.getElementById(id).removeChild(document.getElementById("divObj"));
}