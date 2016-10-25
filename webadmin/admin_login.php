<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/

include_once( dirname( __FILE__ )."/../inc/conn.php" );
include_once( dirname( __FILE__ )."/inc/function.php" );
switch ( $_GET['Action'] )
{
case "logout" :
		addlog( "退出登陆" );
		setcookie( "AdminName" );
		setcookie( "PassWord" );
		echo "<script>top.location.href='admin_login.php';</script>";
		exit( );
default :
		if ( isset( $_POST['userid'], $_POST['password'] ) )
		{
				$query = $db->query( "Select * FROM ".$web_dbtop."admin where name='".str_check( $_POST['userid'] )."' and password='".md5( md5( $_POST['password'] ) )."'" );
				if ( $rs = $db->fetch_array( $query ) )
				{
						setcookie( "AdminName", $rs['name'] );
						setcookie( "PassWord", $rs['password'] );
						$db->query( "UPDATE ".$web_dbtop."admin SET `time`='".date( "Y-m-d H:i:s" )."',`ip`='".usersip( )."' where `name`='".str_check( $_POST['userid'] )."'" );
						addlog( "登陆成功" );
						echo "<script>top.location.href='index.php';</script>";
						exit( );
				}
				echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n<html xmlns=\"http://www.w3.org/1999/xhtml\">\n<head></head><body>";
				showerr( "管理员名称或是密码不正确", "admin_login.php" );
		}
		echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\r\n<html xmlns=\"http://www.w3.org/1999/xhtml\">\r\n<head>\r\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=gb2312\" />\r\n<title>雷风积分游戏管理系统</title>\r\n<style type=\"text/css\">\r\n<!--\r\n*{\r\n\tpadding:0px;\r\n\tmargin:0px;\r\n\tfont-family:Verdana, Arial, Helvetica, sans-serif;\r\n}\r\nbody {\r\n\tmargin: 0px;\r\n\tfont-size:12px;\r\n\tcolor: #888;\r\n}\r\ninput{\r\n\tvertical-align:middle;\r\n}\r\nimg{\r\n\tborder:none;\r\n\tvertical-align:middle;\r\n}\r\na{\r\n\tcolor:#2366A8;\r\n\ttext-decoration: none;\r\n}\r\na:hover{\r\n\tcolor:#2366A8;\r\n\ttext-decoration:underline;\r\n}\r\n.main{\r\n\twidth:640px;\r\n\tbackground:#FFF;\r\n\tpadding-bottom:10px;\r\n\tmargin-top: 120px;\r\n\tmargin-right: auto;\r\n\tmargin-bottom: 0px;\r\n\tmargin-left: auto;\r\n}\r\n\r\n.main .title{\r\n\twidth:600px;\r\n\theight:80px;\r\n\ttext-indent:326px;\r\n\tletter-spacing:2px;\r\n\tbackground-image: url(images/login_toptitle.jpg);\r\n\tbackground-repeat: no-repeat;\r\n\tbackground-position: center center;\r\n\tmargin-top: 0px;\r\n\tmargin-right: auto;\r\n\tmargin-bottom: 0px;\r\n\tmargin-left: auto;\r\n}\r\n\r\n.main .login{\r\n\twidth:630px;\r\n\toverflow:hidden;\r\n\tbackground-image: url(images/login_input_hr.gif);\r\n\tbackground-repeat: no-repeat;\r\n\tbackground-position: center top;\r\n\tmargin-top: 10px;\r\n\tmargin-right: auto;\r\n\tmargin-bottom: 0px;\r\n\tmargin-left: auto;\r\n\tpadding-top: 20px;\r\n}\r\n.main .login .inputbox{\r\n\theight: 50px;\r\n\tpadding-left: 40px;\r\n}\r\n.main .login .inputbox dl{\r\n\theight:28px;\r\n\tfloat: left;\r\n}\r\n.main .login .inputbox dl dt{\r\n\tfloat:left;\r\n\theight:25px;\r\n\tline-height:25px;\r\n\ttext-align:right;\r\n\tpadding-right: 3px;\r\n\tpadding-left: 3px;\r\n}\r\n.main .login .inputbox dl dd{\r\n\tfloat:left;\r\n\tpadding-right: 3px;\r\n\tpadding-left: 3px;\r\n\tline-height: 25px;\r\n\theight: 25px;\r\n}\r\n.main .login .inputbox dl dd input{\r\n\tfont-size:12px;\r\n\tborder:1px solid #dcdcdc;\r\n\tbackground:url(images/login_input_bg.gif) left top no-repeat;\r\n\theight: 18px;\r\n\tline-height: 18px;\r\n\tpadding-right: 2px;\r\n\tpadding-left: 2px;\r\n}\r\n.main   .login   .inputbox   dl   .input  {\r\n\twidth:64px;\r\n\theight:24px;\r\n\tborder:none;\r\n\tcursor:pointer;\r\n\tbackground-color: #fff;\r\n\tbackground-image: url(images/login_submit.gif);\r\n\tbackground-repeat: no-repeat;\r\n}\r\n\r\n\r\n.main .login .butbox{\r\n}\r\n.main .login .butbox dl{\r\n}\r\n.main .login .butbox dl dt{\r\n\theight:30px;\r\n}\r\n.main .login .butbox dl dd{\r\n\theight:21px;\r\n\tline-height:21px;\r\n\ttext-align: center;\r\n}\r\n\r\n\r\n\r\n.main .msg{\r\n\tline-height:18px;\r\n\tborder:1px solid #DCDCDC;\r\n\tcolor:#888;\r\n\tbackground-color: #FFFFFF;\r\n\twidth: 155px;\r\n\tmargin-top: 3px;\r\n\tpadding-left: 2px;\r\n}\r\n\r\n.copyright{\r\n\twidth:640px;\r\n\ttext-align:center;\r\n\tfont-size:12px;\r\n\tcolor:#555;\r\n\tfont-family: Arial;\r\n\tmargin-top: 10px;\r\n\tmargin-right: auto;\r\n\tmargin-bottom: 10px;\r\n\tmargin-left: auto;\r\n}\r\n.copyright a{\r\n\tcolor:#2366a8;\r\n\ttext-decoration:none;\r\n}\r\n.copyright a:hover{\r\n\ttext-decoration: underline;\r\n}\r\n-->\r\n</style>\r\n</head>\r\n<body>\r\n\t<div class=\"main\">\r\n    <div class=\"title\">\r\n\t\t\t&nbsp;\r\n\t  </div>\r\n\t\t<div class=\"login\">\r\n\t\t<form action=\"admin_login.php\" method=\"post\" onSubmit=\"return loginok(this)\">\r\n            <div class=\"inputbox\">\r\n\t\t\t\t<dl>\r\n\t\t\t\t  <dd>用户名：</dd>\r\n\t\t\t\t\t<dd><input type=\"text\" name=\"userid\" id=\"userid\" size=\"25\" onfocus=\"this.style.borderColor='#fc9938'\" onblur=\"this.style.borderColor='#dcdcdc'\" />\r\n\t\t\t\t\t</dd>\r\n\t\t\t\t\t<dd>密码：</dd>\r\n\t\t\t\t\t<dd><input type=\"password\" name=\"password\" size=\"25\" onfocus=\"this.style.borderColor='#fc9938'\" onblur=\"this.style.borderColor='#dcdcdc'\" />\r\n\t\t\t\t\t</dd>\r\n\t\t                  <dd>&nbsp;<input name=\"submit\" type=\"submit\" value=\"\" class=\"input\" />\r\n                  </dd>\r\n              </dl>\r\n          </div>\r\n            <div style=\"clear:both\"></div>\r\n\t\t</form>\r\n\t\t</div>\r\n\t</div>\r\n\t\r\n\t<div class=\"copyright\">\r\n\t\tPowered by <a href=\"http://www.leifengcms.cn\">雷风</a> Copyright &copy;2004-2008 \r\n\t</div>\r\n<script type=\"text/javascript\" language=\"javascript\">\r\n<!--\r\nfunction loginok(form)\r\n{\r\n\tif (form.userid.value==\"\")\r\n  {\r\n\talert(\"用户名不能为空！\");\r\n\tform.userid.focus();\r\n\treturn (false);\r\n  }\r\nif (form.password.value==\"\")\r\n  {\r\n\talert(\"密码不能为空！\");\r\n\tform.password.focus();\r\n\treturn (false);\r\n  }\r\nreturn (true);\r\n}\r\n-->\r\n</script>\r\n</body>\r\n</html>\r\n";
}
?>
