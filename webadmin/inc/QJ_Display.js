function $(obj){return document.getElementById(obj)}
function S(Divid,Ty){$(Divid).scrollTop=Ty}

//判断浏览器类型
function IsIe(){
var sVer=navigator.userAgent;
if(sVer.indexOf("MSIE")==-1){return false}else{return true}
}

document.onselectstart=function(e){return false}

//移动窗口
var MoveObj=null,MoveType,MoveX,MoveY,MoveW,MoveH;
function Move(event,Obj,MoveT){
if($(MoveObj))return;
var evt=event?event:(window.event?window.event:null);
if(IsIe()){
	var YY=event.clientY;
	var XX=event.clientX;
	}else{
	var YY=evt.clientY;
	var XX=evt.clientX;
	}
MoveObj=Obj;MoveType=MoveT;
if(MoveT==0){MoveX=parseInt($(MoveObj).style.left)-XX;MoveY=parseInt($(MoveObj).style.top)-YY}
else if(MoveT==1){
	MoveX=XX;MoveY=YY
	MoveW=$(MoveObj).clientWidth;
	MoveH=$(MoveObj).clientHeight;
	$("QJ_None").style.display="";
	$("QJ_None").style.top=$(MoveObj).style.top;
	$("QJ_None").style.left=$(MoveObj).style.left;
	$("QJ_None").style.width=$(MoveObj).style.width;
	$("QJ_None").style.height=$(MoveObj).style.height;
	}
}
document.onmousemove=function(e){
if(!$(MoveObj))return;
if(IsIe()){
	var YY=event.clientY;
	var XX=event.clientX;
	}else{
	var YY=e.clientY;
	var XX=e.clientX;
	}
if(MoveType==0){
	var _xx=MoveX+XX;var _yy=MoveY+YY;
	var Mx=document.documentElement.clientWidth-$(MoveObj).clientWidth;
	var My=document.documentElement.clientHeight-$(MoveObj).clientHeight;
	if(_xx>Mx)_xx=Mx;
	if(_yy>My)_yy=My;
	if(_xx<0)_xx=0;
	if(_yy<0) _yy=0;
	$(MoveObj).style.left=_xx+"px";
	$(MoveObj).style.top=_yy+"px";
	}
else if(MoveType==1){
	var W=XX-MoveX+MoveW;
	var H=YY-MoveY+MoveH;
	if(W<110)W=110;
	if(H<40)H=40;
	$("QJ_None").style.width=W+"px";
	$("QJ_None").style.height=H+"px";
	}
}

//鼠标弹起事件
document.onmouseup=function(e){
if($(MoveObj)&&$("QJ_None").style.display!="none"){
	$(MoveObj).style.width=$("QJ_None").style.width;
	$(MoveObj).style.height=$("QJ_None").style.height;
	$(MoveObj+"_Con").style.width=($("QJ_None").clientWidth-14)+"px";
	$(MoveObj+"_Con").style.height=($("QJ_None").clientHeight-36)+"px";
	}
MoveObj=null;
$("QJ_None").style.display="none";
}

//创建新窗口
var AddTopZindex=1,AddTopOn=null;
function AddWin(Aid,Atitle,Aurl,Aw,Ah,Abut){
var Cid="New"+Aid;
if($(Cid)){
	if($(Cid).style.display=="none"){AddSee(Cid,"")}else{AddTop(Cid)}
	return;
	}
var Acon="";
Acon="<IFRAME style='width:100%;height:100%' src='"+Aurl+"' frameBorder=0></IFRAME>";
var oDiv=document.createElement("div");
oDiv.id=Cid;
oDiv.className="WinCss";
oDiv.style.zIndex=AddTopZindex;
oDiv.style.width=(Aw+14)+"px";
oDiv.style.height=(Ah+36)+"px";
var X=(document.documentElement.clientWidth-Aw-14)/2;
if(X<0)X=0;
oDiv.style.left=X+"px";
oDiv.style.top=((document.documentElement.clientHeight-Ah-64)/2+14)+"px";
var CloseBut="<div id='"+Cid+"C3' style='width:15px;margin-left:5px' onmouseover=\"S(this.id,15)\" onmouseout=\"S(this.id,0)\" onmousedown=\"S(this.id,15)\" onclick=\"S(this.id,15);AddClose('"+Cid+"')\"><img src='images/b.gif' style='margin-left:-44px'></div>";
if(Abut==0){
var DblClick="ondblclick=\"AddBig('"+Cid+"',"+Aw+","+Ah+")\""
CloseBut+="<div id='"+Cid+"C2' style='width:15px;margin-left:5px' onmouseover=\"S(this.id,15)\" onmouseout=\"S(this.id,0)\" onmousedown=\"S(this.id,15)\" onclick=\"S(this.id,15);AddBig('"+Cid+"',"+Aw+","+Ah+")\"><img src='images/b.gif' style='margin-left:-22px'></div>";
}else{
DblClick=" "
}
CloseBut+="<div id='"+Cid+"C1' style='width:15px' onmouseover=\"S(this.id,15)\" onmouseout=\"S(this.id,0)\" onmousedown=\"S(this.id,15)\" onclick=\"S(this.id,15);$('"+Cid+"').style.display='none'\"><img src='images/b.gif'></div>";
var Html="<table class='WinTab' cellpadding='0' cellspacing='0'>"+
	 "<tr><td class='Win1'></td><td class='Win2'>&nbsp;"+Atitle+"</td><td class='Win3'></td></tr>"+
	 "<tr><td class='Win4'></td><td class='Win5'><div id='"+Cid+"_Con' class='WinCon' style='width:"+Aw+"px;height:"+Ah+"px'>"+Acon+"</div></td><td class='Win6'></td></tr>"+
	 "<tr><td class='Win7'></td><td class='Win8'>&nbsp;</td><td class='Win9'></td></tr></table><div class='WinClose'>"+CloseBut+"</div><div id='"+Cid+"_Move' class='WinMove'"+DblClick+" onmousedown=\"AddTop('"+Cid+"');Move(event,'"+Cid+"',0)\"></div><div class='WinIframe'><iframe style='width:100%;height:100%' src='about:blank' frameBorder=0 scrolling=no></iframe></div>";
if(Abut==0)Html+="<div class='WinResize' onmousedown=\"Move(event,'"+Cid+"',1)\"></div>";
oDiv.innerHTML=Html;
document.body.appendChild(oDiv);
AddTopOn=Cid;
AddSee(Cid,Aurl);
}
var AddTimer;
function AddSee(Cid,Aurl){
if(!$(Cid))return;
if($(Cid).style.display=="none"){
	$(Cid).style.top=((document.documentElement.clientHeight-$(Cid).clientHeight-30)/2+10)+"px";
	$(Cid).style.display="";
	AddTop(Cid);
	}
var Y=(document.documentElement.clientHeight-$(Cid).clientHeight-30)/2;
if(Y<0)Y=0;
var T=parseInt($(Cid).style.top);
if(T>Y){
	var N;
	if(T-Y>120){N=120}else if(T-Y>60){N=60}else if(T-Y>30){N=20}else if(T-Y>20){N=10}else{N=1}
	$(Cid).style.top=(T-N)+"px";
	AddTimer=window.setTimeout("AddSee('"+Cid+"','"+Aurl+"')",20)
	}
}
//关闭
function AddClose(Cid){
document.body.removeChild($(Cid));
}
//最大化
function AddBig(Cid,Aw,Ah){
if($(Cid).style.display=="none"){$(Cid).style.display=""}
var S=$(Cid+"C2").scrollLeft;
var W=document.documentElement.clientWidth;
var H=document.documentElement.clientHeight;
if(S==0){
	$(Cid+"C2").scrollLeft=94;
	$(Cid).style.left="0px";
	$(Cid).style.top="0px";
	$(Cid).style.width=W+"px";
	$(Cid).style.height=H+"px";
	$(Cid+"_Con").style.width=(W-14)+"px";
	$(Cid+"_Con").style.height=(H-36)+"px";
	}else{
	$(Cid+"C2").scrollLeft=0;
	$(Cid).style.width=(Aw+14)+"px";
	$(Cid).style.height=(Ah+36)+"px";
	$(Cid+"_Con").style.width=Aw+"px";
	$(Cid+"_Con").style.height=Ah+"px";
	var X=(document.documentElement.clientWidth-Aw-14)/2;if(X<0)X=0;
	var Y=(document.documentElement.clientHeight-Ah-36)/2;if(Y<0)Y=0;
	$(Cid).style.left=X+"px";
	$(Cid).style.top=Y+"px";
	}
}
//窗口置顶
function AddTop(Cid){
if(Cid==AddTopOn)return;
AddTopZindex++
$(Cid).style.zIndex=AddTopZindex;
AddTopOn=Cid;
}

function G(GText){
if(GText!=""){
	GText=GText.replace(/\|/g,"'");
	GText=GText.replace(/\$/g,"\"");
	var obj=eval(GText);
	}
}
//按键事件
document.onkeydown=function(e){
var e=window.event?window.event:e;
var srcEle=e.srcElement?e.srcElement:e.target;
}

var fileref=document.createElement("link");
fileref.setAttribute("rel", "stylesheet");
fileref.setAttribute("type", "text/css");
fileref.setAttribute("href", "images/window.css");
document.getElementsByTagName("head")[0].appendChild(fileref);

document.write("<div id=\"QJ_None\" style=\"display:none\"></div>");