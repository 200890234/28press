var oksubmit=false;
function ChkRepeatNick(m){
	ajaxurl("inc/ajaxproc.php?user="+m);
}

function ajaxurl(Urlx){
var ajax=new AJAXRequest({
		url: Urlx,
		method: "GET",
		oncomplete: ProcChecNick,
		charset: "GB2312"
	});
ajax.get();
}

function ProcChecNick(obj){
	if(obj.responseText){
		if(obj.responseText == "true"){
			$("sUserMail").innerHTML = 'email address exists';
			$("sUserMail").className = "rf";
			Ofocu('tbUserMail');
			oksubmit=false;
		}else{
			$("sUserMail").innerHTML = '';
			$("sUserMail").className = "font-green01";
			oksubmit=true;
		}
	}
}

function ChkReg(){
	var userMail= $("tbUserMail").value;
	var userNick = $("tbUserNick").value;
	var userPwd = $("tbUserPwd").value;
	var rePwd = $("tbRePwd").value;
	var userLr = $("tbUserLr").value;
	var userSecQues = $("tbUserSecQues").value;
	var userSecAns = $("tbUserSecAns").value;
	//var safeCode = $("tbSafeCode").value;
	if(oksubmit==false){return false;}
	if(chkMail(userMail)==false){
		$("sUserMail").innerHTML = 'please enter a valid email address';
		$("sUserMail").className = "rf";
		Ofocu('tbUserMail');
		return false;
	}
	if(ChkString(userNick,1,20)==false){
		$("sUserNick").innerHTML = 'please enter a valid nickname';
		$("sUserNick").className = "rf";
		Ofocu('tbUserNick');
		return false;
	}
	else{
		$("sUserNick").innerHTML = "&nbsp;";
		$("sUserNick").className = "";
	}
	if(userPwd.length < 5){
		$("sUserPwd").innerHTML = 'invalid password format';
		$("sUserPwd").className = "rf";
		Ofocu('tbUserPwd');
		return false;
	}
	else{
		$("sUserPwd").innerHTML = "&nbsp;";
		$("sUserPwd").className = "";
	}
	if(userPwd != rePwd){
		$("sRePwd").innerHTML = "password doesn't match";
		$("sRePwd").className = "rf";
		Ofocu('tbRePwd');
		return false;
	}
	else{
		$("sRePwd").innerHTML = "&nbsp;";
		$("sRePwd").className = "";
	}
	if(userLr==""){
		$("sUserLr").innerHTML = "please input your lr account";
		$("sUserLr").className = "rf";
		Ofocu('tbUserLr');
		return false;
	}
	else{
		$("sUserLr").innerHTML = "&nbsp;";
		$("sUserLr").className = "";
	}
	if(userSecQues==""){
		$("sUserSecQues").innerHTML = 'please select a security question';
		$("sUserSecQues").className = "rf";
		Ofocu('tbUserSecQues');
		return false;
	}
	else{
		$("sUserSecQues").innerHTML = "&nbsp;";
		$("sUserSecQues").className = "";
	}
	if(ChkString(userSecAns,1,20) || userSecAns==""){
		$("sUserSecAns").innerHTML = 'invalid answer';
		$("sUserSecAns").className = "rf";
		Ofocu('tbUserSecAns');
		return false;
	}
	else{
		$("sUserSecAns").innerHTML = "&nbsp;";
		$("sUserSecAns").className = "";
	}
	if(ChkSafeCode(safeCode)==false){
		//$("sSafeCode").innerHTML = '对不起，您输入的验证码格式错误！';
		//$("sSafeCode").className = "rf";
		//Ofocu('tbSafeCode');
		//return false;
	}
	else{
		//$("sSafeCode").innerHTML = "&nbsp;";
		//$("sSafeCode").className = "";
	}
	$("Submit2").disabled=true;
}

function Chkforpwd(){
	var userAccount= $("tbUserAccount").value;
	var userSecQues = $("tbUserSecQues").value;
	var userSecAns = $("tbUserSecAns").value;
	//var safeCode = $("tbSafeCode").value;

	if(ChkString(userAccount,1,20)==false || userAccount==""){
		$("sUserAccount").innerHTML = 'invalid account format';
		$("sUserAccount").className = "rf";
		Ofocu('tbUserAccount');
		return false;
	}
	else{
		$("sUserAccount").innerHTML = "&nbsp;";
		$("sUserAccount").className = "";
	}
	
	if(userSecQues==""){
		$("sUserSecQues").innerHTML = 'please select a security question';
		$("sUserSecQues").className = "rf";
		Ofocu('tbUserSecQues');
		return false;
	}
	else{
		$("sUserSecQues").innerHTML = "&nbsp;";
		$("sUserSecQues").className = "";
	}
	if(ChkString(userSecAns,1,20) || userSecAns==""){
		$("sUserSecAns").innerHTML = 'security answer is incorrect';
		$("sUserSecAns").className = "rf";
		Ofocu('tbUserSecAns');
		return false;
	}
	else{
		$("sUserSecAns").innerHTML = "&nbsp;";
		$("sUserSecAns").className = "";
	}
	if(ChkSafeCode(safeCode)==false){
		//$("sSafeCode").innerHTML = '对不起，您输入的验证码格式错误！';
		//$("sSafeCode").className = "rf";
		//Ofocu('tbSafeCode');
		//return false;
	}
	else{
		//$("sSafeCode").innerHTML = "&nbsp;";
		//$("sSafeCode").className = "";
	}
	$("Submit2").disabled=true;
}

function $(obj){
	return typeof(obj) == "string" ? document.getElementById(obj) : obj;
}

function showCode(){
	$('regSafeCode').src='inc/code.php';
}

function Ofocu(obj){
	window.tmpObj = $(obj);
	window.setTimeout("window.tmpObj.focus()",100);
}

function ChkString(str,minLength,maxLength,pattern){
	pattern = typeof(pattern) == 'undefined' ? '^[^`%&()=;:/\'"]*$' : pattern;
	pattern = new RegExp(pattern);
	if(pattern.test(str)==false){
		return false;
	}
}

function ChkSafeCode(code){
	if((/[A-Za-z1-9]{4}/.test(code)) == false || code.length!=4){
		return false;
	}
}

function chkMail(mail,minLength,maxLength,pattern){
	pattern = typeof(pattern) == 'undefined' ? '^\\\w+((-\\\w+)|(\\\.\\\w+))*\\\@[A-Za-z0-9]+((\\\.|-)[A-Za-z0-9]+)*\\\.[A-Za-z0-9]+$' : pattern;
	pattern = new RegExp(pattern);
	if(pattern.test(mail)==false){
		return false;
	}
}

function checkedAll(id){
	var id = document.getElementsByName(id+"[]");
	for(i=0;i<id.length;i++){
		if(id[i].checked == true){
			id[i].checked = false;
		}
		else{
			id[i].checked = true;
		}
	}
}