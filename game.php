<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/

session_start( );
include_once( "inc/conn.php" );
include_once( "inc/function.php" );
echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd\">\r\n<HTML xmlns=\"http://www.w3.org/1999/xhtml\">\r\n<head>\r\n<title>";
echo $web_name;
echo "</title>\r\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=gb2312\" />\r\n<meta name=\"keywords\" content=\"";
echo $web_keywords;
echo "\" />\r\n<meta name=\"description\" content=\"";
echo $web_description;
echo "\" />\r\n<META http-equiv=X-UA-Compatible content=IE=EmulateIE7>\r\n<link href=\"style/default.css\" rel=\"stylesheet\" type=\"text/css\" />\r\n<style type=\"text/css\" >li{font-size:14px;}</style>\r\n</head>\r\n";
include_once( "top.php" );
echo "<script language=\"javascript\">\r\nqiehuan(2);\r\n</script>\r\n
<DIV class=\"wrapper\">\r\n\t
<DIV class=\"page_content\">\r\n\t\t
	<!--主体左边 Start-->\r\n\t\t\t
	<DIV class=\"area300 fl\">\r\n\t\t\t\t
	<DIV class=\"area300-t h5px\"></DIV>\r\n\t\t\t\t
		<DIV class=\"area300-info\">\r\n\t\t\t\t\t
		<UL class=\"game-list\">\r\n\t\t\t\t\t\t
		<LI class=\"photo\"><a href=\"luck.php\"><img src=\"images/game28.jpg\" border=\"0\" /></a></LI>\r\n\t\t\t\t\t\t
		<LI>Twenty-eight numbers(0-27) to bet, sum up by three integers between 0 and 9, it's simple but full of fun. <a href=\"luckhelp.php\">&nbsp;&nbsp;&nbsp; =>Luck28 help </a></LI>\r\n\t\t\t\t\t
		</UL>\r\n\t\t\t\t
		</DIV>\r\n\t\t\t\t
	<DIV class=\"area300-b h5px\"></DIV>\r\n\t\t\t
	</DIV>\r\n\t\t\t
	<DIV class=\"area300 fl\" style=\"margin-left:30px\">\r\n\t\t\t\t
		<DIV class=\"area300-t h5px\"></DIV>\r\n\t\t\t\t<DIV class=\"area300-info\">\r\n\t\t\t\t\t
		<UL class=\"game-list\">\r\n\t\t\t\t\t\t
		<LI class=\"photo\"><a href=\"happy.php\"><img src=\"images/game16.jpg\" border=\"0\" /></a></LI>\r\n\t\t\t\t\t\t
		<LI>Sixteen numbers(3-18) to bet, sum up by three integers between 1 and 6, it's simple but full of fun. <a href=\"happyhelp.php\">&nbsp;&nbsp;&nbsp; =>Luck16 help</LI>\r\n\t\t\t\t\t
		</UL>\r\n\t\t\t\t
		</DIV>\r\n\t\t\t\t
	<DIV class=\"area300-b h5px\"></DIV>\r\n\t\t\t</DIV>\r\n\t\t\t
	<DIV class=\"area300 fr\" style=\"margin-left:30px\">\r\n\t\t\t\t
		<DIV class=\"area300-t h5px\"></DIV>\r\n\t\t\t\t
		<DIV class=\"area300-info\">\r\n\t\t\t\t\t
		<UL class=\"game-list\">\r\n\t\t\t\t\t\t<LI class=\"photo\"><a href=\"joyous.php\" onclick=\"return false\"><img src=\"images/game11.jpg\" border=\"0\" /></a></LI>\r\n\t\t\t\t\t\t
		<LI>Coming soon . . .</LI>\r\n\t\t\t\t\t
		</UL>\r\n\t\t\t\t
		</DIV>\r\n\t\t\t\t";
//echo "<DIV class=\"area30-b h5px\"></DIV>\r\n\t\t\t
	//</DIV>\r\n\t\t\t<div class=\"blank10\"></div>\r\n\t\t\t
	//<DIV class=\"area300 fl\">\r\n\t\t\t\t<DIV class=\"area300-t h5px\"></DIV>\r\n\t\t\t\t
	//<DIV class=\"area300-info\">\r\n\t\t\t\t\t";
//echo "<UL class=\"game-list\">\r\n\t\t\t\t\t\t
		//<LI class=\"photo\"><a href=\"dodge.php\"><img src=\"images/gamedodge.jpg\" border=\"0\" /></a></LI>\r\n\t\t\t\t\t\t
		//<LI>猜拳是一种简单有趣的户动竞猜游戏，自摆擂台，为擂主其他用户可以进行挑战，胜利者可获得擂主摆擂所投注的";
//echo $web_moneyname;
//echo "反之就将自己输掉相应的";
//echo $web_moneyname;
//echo "！</LI>\r\n\t\t\t\t\t
	//</UL>\r\n\t\t\t\t";
/*echo "</DIV>\r\n\t\t\t\t
	<DIV class=\"area300-b h5px\"></DIV>\r\n\t\t\t
	</DIV>\r\n\t\t\t";
echo "<DIV class=\"area300 fl\" style=\"margin-left:30px\">\r\n\t\t\t\t
	<DIV class=\"area300-t h5px\"></DIV>\r\n\t\t\t\t
	<DIV class=\"area300-info\">\r\n\t\t\t\t\t
		<UL class=\"game-list\">\r\n\t\t\t\t\t\t
		<LI class=\"photo\"><a href=\"box.php\"><img src=\"images/gamebox.jpg\" border=\"0\" /></a></LI>\r\n\t\t\t\t\t\t
		<LI>玩其他游戏、或使用广告体验卡都可以获得经验值，每10,50,100点经验值开一次宝箱(青铜,白银,黄金)，宝箱等级越高获得奖励也越高，百分百中奖！</LI>\r\n\t\t\t\t\t
		</UL>\r\n\t\t\t\t
	</DIV>\r\n\t\t\t\t
	<DIV class=\"area300-b h5px\"></DIV>\r\n\t\t\t
	</DIV>\r\n\t\t";*/
echo "<!--主体左边 End-->\r\n\t
</DIV>\r\n\t
</DIV>\r\n\t
<div class=\"blank10\"></div>\r\n\t
<!--Footer Start-->\r\n";
include_once( "footer.php" );
echo "</DIV>";
?>
