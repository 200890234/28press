<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/

echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd\">\r\n<HTML xmlns=\"http://www.w3.org/1999/xhtml\">\r\n<HEAD>\r\n";
include_once( dirname( __FILE__ )."/../inc/config.php" );
echo "<TITLE>左侧导航--雷风积分游戏系统</TITLE>\r\n<LINK href=\"images/css_menu.css\" type=text/css rel=stylesheet>\r\n<META http-equiv=Content-Type content=\"text/html; charset=gb2312\">\r\n<SCRIPT language=javascript>\r\nfunction getObject(objectId) {\r\n if(document.getElementById && document.getElementById(objectId)) {\r\n // W3C DOM\r\n return document.getElementById(objectId);\r\n }\r\n else if (document.all && document.all(objectId)) {\r\n // MSIE 4 DOM\r\n return document.all(objectId);\r\n }\r\n else if (document.layers && document.layers[objectId]) {\r\n // NN 4 DOM.. note: this won't find nested layers\r\n return document.layers[objectId];\r\n }\r\n else {\r\n return false;\r\n }\r\n}\r\n\r\nfunction showHide(objname){\r\n    var obj = getObject(objname);\r\n    if(obj.style.display == \"none\"){\r\n\t\tobj.style.display = \"block\";\r\n\t}else{\r\n\t\tobj.style.display = \"none\";\r\n\t}\r\n}\r\n</SCRIPT>\r\n</HEAD>\r\n<BODY>\r\n<DIV class=menu>\r\n<DL>\r\n  <DT><A onclick=\"showHide('items1');\" href=\"#\" target=_self>用户管理</A></DT>\r\n  <DD id=items1 style=\"DISPLAY: block\">\r\n  <UL>\r\n  \t<LI><A href=\"admin_reg.php\" target=right>注册协议</A></LI>\r\n\t<LI><A href=\"admin_usergroups.php\" target=right>用户组管理</A></LI>\r\n    <LI><A href=\"admin_users.php\" target=right>用户管理</A></LI>\r\n\t<LI><A href=\"admin_authentication.php\" target=right>身份验证</A></LI>\r\n\t<LI><A href=\"admin_advise.php\" target=right>用户建议</A></LI>\r\n   </UL>\r\n   </DD>\r\n</DL>\r\n</DIV>\r\n<DIV class=menu>\r\n<DL>\r\n  <DT><A onclick=\"showHide('items2');\" href=\"#\" target=_self>短信发送</A></DT>\r\n  <DD id=items2 style=\"DISPLAY: block\">\r\n  <UL>\r\n  \t<LI><A href=\"admin_sms.php\" target=right>短信发送</A></LI>\r\n\t<LI><A href=\"admin_smslog.php\" target=right>发送记录</A></LI>\r\n   </UL>\r\n   </DD>\r\n</DL>\r\n</DIV>\r\n<DIV class=menu>\r\n<DL>\r\n  <DT><A onclick=\"showHide('items3');\" href=\"#\" target=_self>活动管理</A></DT>\r\n  <DD id=items3 style=\"DISPLAY: block\">\r\n  <UL>\r\n  \t<LI><A href=\"admin_activities.php\" target=right>活动管理</A></LI>\r\n   </UL>\r\n   </DD>\r\n</DL>\r\n</DIV>\r\n</BODY></HTML>";
?>
