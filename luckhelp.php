<?php
include_once("inc/conn.php");
include_once("inc/function.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>luck28-game area-<?=$web_name;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<meta name="keywords" content="<?=$web_keywords;?>" />
<meta name="description" content="<?=$web_description;?>" />
<META http-equiv=X-UA-Compatible content=IE=EmulateIE7>
<link href="style/default.css" rel="stylesheet" type="text/css" />
<style type="text/css">
table{color:#C8F139;font-size:16px;}
.font14{color:#666666;font-size:18px;font-weight:bold;}
.webgame-info-tabs p{color:#C8F139;margin:10px;font-size:16px;}
</style>
</head>
<?php include_once("top.php");?>
<script language="javascript">
qiehuan(2);
document.getElementById("qh_con2").getElementsByTagName('li')[0].className="current";
</script>
<DIV class="wrapper">
	<DIV class="page_content">
		<DIV class="webgame-info-title">
		  <UL>
			<LI><A href="luck.php">Luck28 home</A></LI>
			<LI class="current"><A href="luckhelp.php">Luck28 guide</A></LI>
			<LI><A href="luckmylist.php">My press history</A></LI>
			<LI><A href="luckmodel.php">Edit press pattern</A></LI>
			<LI><A href="luckautoset.php">Autopress</A></LI>
			<LI><A href="luckdirection.php">Trend chart</A></LI>
		  </UL>
		</DIV>
		<DIV class="webgame-info">
			<DIV class="webgame-info-tabs">
			<TABLE height=27 cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
			<TBODY>
			  <TR>
				<TD width=12><IMG height=27 src="images/game2_03.jpg" width=12></TD>
				<TD class=font14 background="images/game2_04.jpg">Rules of luck28:</TD>
				<TD width=13><IMG height=27 src="images/game2_06.jpg" width=13></TD>
			  </TR>
			</TBODY>
			</TABLE>
			<p> Luck28 is a wonderful lottery game which draws every 10 minutes. The winning number is the sum of 3 digits, each of which is randomly generated between 0 and 9. Numbers may be repeated. The winning number ranges from 0 to 27; a total of 28 possible sums. The digits of the number 000 sum up to 0, and those of 999 sum up to 27, the rest lie in between.Well over 50% of 3-digit numbers have a sum between 10 and 17; it is therefore not surprising to see these winning numbers drawn every now and then. 
			for each draw, 98% of the total pressed PRs($1=10000PRs) is allocated as prize money.
			</p>
			<p>The following table is a list of all the 28 possible sums and the corresponding distinct 3-digit numbers.</p>
			<table border="1" cellpadding="3" cellspacing="0" align="center" style="font-size:13px;width:935px;margin:auto;">
			<tr><th>Sum(winning number)</th><th>How many have this sum</th><th>List of distinct boxes having this sum</th><th>Standard odds of winning with the sum</th><th>Probability of the sum to be drawn</th>
			</tr>
			<tr><td><b>0</b></td><td>1</td><td>000</td><td>1:1000</td><td>0.1%</td>
			</tr>
			<tr><td><b>1</b></td><td>3</td><td>001</td><td>1:333.33</td><td>0.3%</td>
			</tr>
			<tr><td><b>2</b></td><td>6</td><td>002,011</td><td>1:166.67</td><td>0.6%</td>
			</tr>
			<tr><td><b>3</b></td><td>10</td><td>003,012,111</td><td>1:100</td><td>1.0%</td>
			</tr>
			<tr><td><b>4</b></td><td>15</td><td>004,013,022,112</td><td>1:66.66</td><td>1.5%</td>
			</tr>
			<tr><td><b>5</b></td><td>21</td><td>005,014,023,113,122</td><td>1:47.61</td><td>2.1%</td>
			</tr>
			<tr><td><b>6</b></td><td>28</td><td>006,015,024,033,114,123,222</td><td>1:35.71</td><td>2.8%</td>
			</tr>
			<tr><td><b>7</b></td><td>36</td><td>007,016,025,034,115,124,133,223</td><td>1:27.77</td><td>3.6%</td>
			</tr>
			<tr><td><b>8</b></td><td>45</td><td>008,017,026,035,044,116,125,134,224,233</td><td>1:22.22</td><td>4.5%</td>
			</tr>
			<tr><td><b>9</b></td><td>55</td><td>009,018,027,036,045,117,126,135,144,225,234,333</td><td>1:18.18</td><td>5.5%</td>
			</tr>
			<tr><td><b>10</b></td><td>63</td><td>019,028,037,046,055,118,127,136,145,226,235,244,334</td><td>1:15.87</td><td>6.3%</td>
			</tr>
			<tr><td><b>11</b></td><td>69</td><td> 029,038,047,056,119,128,137,146,155,227,236,245,335,344</td><td>1:14.49</td><td>6.9%</td>
			</tr>
			<tr><td><b>12</b></td><td>73</td><td>039,048,057,066,129,138,147,156,228,237,246,255,336,345,444</td><td>1:13.69</td><td>7.3%</td>
			</tr>
			<tr><td><b>13</b></td><td>75</td><td>049,058,067,139,148,157,166,229,238,247,256,337,346,355,445</td><td>1:13.33</td><td>7.5%</td>
			</tr>
			<tr><td><b>14</b></td><td>75</td><td>059,068,077,149,158,167,239,248,257,266,338,347,356,446,455</td><td>1:13.33</td><td>7.5%</td>
			</tr>
			<tr><td><b>15</b></td><td>73</td><td>069,078,159,168,177,249,258,267,339,348,357,366,447,456,555</td><td>1:13.69</td><td>7.3%</td>
			</tr>
			<tr><td><b>16</b></td><td>69</td><td>079,088,169,178,259,268,277,349,358,367,448,457,466,556</td><td>1:14.49</td><td>6.9%</td>
			</tr>
			<tr><td><b>17</b></td><td>63</td><td>089,179,188,269,278,359,368,377,449,458,467,557,566</td><td>1:15.87</td><td>6.3%</td>
			</tr>
			<tr><td><b>18</b></td><td>55</td><td>099,189,279,288,369,378,459,468,477,558,567,666</td><td>1:18.18</td><td>5.5%</td>
			</tr>
			<tr><td><b>19</b></td><td>45</td><td>199,289,379,388,469,478,559,568,577,667</td><td>1:22.22</td><td>4.5%</td>
			</tr>
			<tr><td><b>20</b></td><td>36</td><td>299,389,479,488,569,578,668,677</td><td>1:27.77</td><td>3.6%</td>
			</tr>
			<tr><td><b>21</b></td><td>28</td><td>399,489,579,588,669,678,777</td><td>1:35.71</td><td>2.8%</td>
			</tr>
			<tr><td><b>22</b></td><td>21</td><td>499,589,679,688,778</td><td>1:47.61</td><td>2.1%</td>
			</tr>
			<tr><td><b>23</b></td><td>15</td><td>599,689,779,788</td><td>1:66.66</td><td>1.5%</td>
			</tr>
			<tr><td><b>24</b></td><td>10</td><td>699,789,888</td><td>1:100</td><td>1.0%</td>
			</tr>
			<tr><td><b>25</b></td><td>6</td><td>799,889</td><td>1:166.67</td><td>0.6%</td>
			</tr>
			<tr><td><b>26</b></td><td>3</td><td>899</td><td>1:333.33</td><td>0.3%</td>
			</tr>
			<tr><td><b>27</b></td><td>1</td><td>999</td><td>1:1000</td><td>0.1%</td>
			</tr>
			</table> 

			<p>The second column is the total numbers that have this sum while the third column lists only the distinct boxes. For instance, there are 3 numbers that have sum of 1 and they are 001, 010, and 100. Since all three are simply different arrangements of the number 001, we have listed only 001 in the third column. </p>
			<p>The last two columns are indicative of how much is paid for a winning sum and what is the likelihood of a sum being drawn, respectively. The column 'Standard odds of winning with the sum' actually tells you how much is paid if that sum wins. With no commissions involved, you should be paid exactly the same as the odds. That is, a sum of 0 should bring you $1000 for each dollar you spend, $333 for a sum of 1, and so on. However odds may always change depends on how much is wagered on this sum.
			</p>
			<p>The last column, 'Probability of the sum to be drawn', is just that - it allows you to choose which sum to play. Obviously, sums of 13 and 14 are the most probable sums.</p>
			
			
			<TABLE height=27 cellSpacing=0 cellPadding=0 width="100%" align=center border=0 style="margin-top:20px;">
				<TBODY>
				  <TR>
					<TD width=12><IMG height=27 src="images/game2_03.jpg" width=12></TD>
					<TD class=font14 background=images/game2_04.jpg>How to press:(in 28press.com we use "press" instead of "wager")</TD>
					<TD width=13><IMG height=27 src="images/game2_06.jpg" width=13></TD>
				  </TR>
				</TBODY>    
			</TABLE>
			
			<br>
			<!--视频演示开始-->  
			<!--使用站内视频-->
			<!--<OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0" WIDTH="960" HEIGHT="755" id="video-by-instant-demo">
			<PARAM NAME=movie VALUE=".swf?build=1">
			<PARAM NAME=quality VALUE=best>
			<PARAM NAME=bgcolor VALUE=#000000>
			<PARAM NAME=scale VALUE="exactfit">
			<EMBED src=".swf?build=1" quality=best bgcolor=#000000 scale="exactfit" WIDTH="960" HEIGHT="755"
			NAME="video-by-instant-demo" ALIGN="" TYPE="application/x-shockwave-flash"
			PLUGINSPAGE="http://www.macromedia.com/go/getflashplayer"></EMBED>
			</OBJECT>-->
			
			<!--使用megaswf.com/swfcabin.com 上的视频 
			http://megaswf.com/file/2558919.swf  用这个显示不了 太垃圾 收费
			http://www.swfcabin.com/swf-files/1361499696.swf
			-->
			<p align="center">
				<a href="http://www.swfcabin.com/swf-files/1361499696.swf" target="_blank">Open in new window </a>
				or 
				<a href="http://sdrv.ms/WwlA0C" target="_blank">Download this video</a>
			</p>
			<OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0" WIDTH="960" HEIGHT="755">
			<PARAM NAME=movie VALUE="http://www.swfcabin.com/swf-files/1361499696.swf">
			<PARAM NAME=quality VALUE=best>
			<PARAM NAME=allowfullscreen VALUE=true>
			<PARAM NAME=bgcolor VALUE=#000000>
			<PARAM NAME=scale VALUE="exactfit">
			<EMBED src="http://www.swfcabin.com/swf-files/1361499696.swf" quality=best bgcolor=#000000 scale="exactfit" WIDTH="960" HEIGHT="755" ALIGN="" TYPE="application/x-shockwave-flash"
			PLUGINSPAGE="http://www.macromedia.com/go/getflashplayer"></EMBED>
			</OBJECT>
			<!--使用youtube视频-->
			
			
			<!--视频演示结束 使用站内视频-->
			<!--
			<p>
				Step 1: Go to luck28 home page and click "press".
				<br />
				<img src="images/helppic/clicktopress.gif" width="930"><br/>
			</p>
			<p>
				Step 2: In press page, choose any number(by click the checkbox) you want to press for this draw and decide how much you want to spend on each number. You can change the amount by clicking buttons on the right.
				<img src="images/helppic/dopress.gif" alt="" /><br/>
				You could multiply your amount by 0.5, 2, 5, or more times by click the button in the "quick press" section<br>
				<img src="images/helppic/multiply.gif" alt="" /><br/>
			</p>
			<p>
				Step 3: Click "press" button to submit. <br />
				<img src="images/helppic/finishpress.gif"><br/>
			</p>
			
			<TABLE height=27 cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
			<TBODY>
			  <TR>
				<TD width=12><IMG height=27 src="images/game2_03.jpg" width=12></TD>
				<TD class=font14 background="images/game2_04.jpg">Luck28 patterns:</TD>
				<TD width=13><IMG height=27 src="images/game2_06.jpg" width=13></TD>
			  </TR>
			</TBODY>
			</TABLE>
			<p>
			For a fun and different way of playing Luck28, try Luck28 Pattern Play and play with patterns instead of numbers.
			You can choose preset patterns like all, big, or even, or you can make your own pattern by selecting any numbers  you want and specify how much you want to spend on each number.
			Now let's take a look at some preset patterns:<br>
			Go to <a href="luckmodel.php" style="color:red;">Edit press pattern</a> page.
			<img src="images/helppic/presetpatterns.gif"><br/>
			all: all numbers(0-27) is selected (this pattern is recommended for newbies).<br/>
			odd: 1/3/5/7/9/11/13/15/17/19/21/23/25/27 is selected.<br/>
			even: 0/2/4/6/8/10/12/14/16/18/20/22/24/26 is selected.<br/>
			big: 14-27 is selected.<br/>
			small:0-13 is selected.<br/>
			middle: 10-17 is selected.<br/>
			edge: 0-9 & 18-27 is selected.<br/>
			
			Next, we'll talk about how to make your own patterns. Here is an example of it.Let's say we want to make a patterns where 6-21 is selected.<br/>
			Step 1: Go to edit press pattern page.
			<img src="images/helppic/editpattern.gif"><br/>
			In the select pattern section, select a pattern name in the droplist and rename it. Here i'll rename it to "6-21".
			Step 2: Select  numbers and decide how much you want to spend.
			Since 6-21 is part of 0-27, we can make it from "all" pattern.Click "all" in the standard patterns section.
			<img src="images/helppic/editamount.gif"><br/>
			You will see all numbers is selected in the number list section.But we don't need 0-5 and 22-27, just uncheck them.
			You can also multiply your amount by click buttons in the pattern detail section. <br/></br>
			Step 3: Submit your selection by clicking the save button.  
			</p>
			
			<TABLE height=27 cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
			<TBODY>
			  <TR>
				<TD width=12><IMG height=27 src="images/game2_03.jpg" width=12></TD>
				<TD class=font14 background="images/game2_04.jpg">Luck28 Autopress:</TD>
				<TD width=13><IMG height=27 src="images/game2_06.jpg" width=13></TD>
			  </TR>
			</TBODY>
			</TABLE>
			<p>
			Luck28 Autopress makes it possible to play luck28 game automatically without opening your computer.To use autopress, you need to make your own patterns first.just go to edit press pattern page.<br/>
			Now we are in Autopress setting page.
			<img src="images/helppic/autopress.gif"><br/>
			First, you need to select which pattern to use. Then decide how many consecutive draws you want to play by entering the start draw# and the end draw#. The maximum and minimum balance of your account allows you to teminate autopress automatically when your balance is greater or less than that value.If you have many patterns,you can choose which pattern to use after you win or lose in the last draw.(if you gained more PRs than you pressed, then we say: you win).
			Click SUBMIT button to finish autopress setting and your autopress will start. 
			After autopress is running You can teminate it manually by click the TERMINATE button.
			</p>
			-->
			</DIV>
			<DIV class=cl></DIV>
		</DIV>
		<DIV class="area960-b h5px"></DIV>
	<!--Flink End-->
	<div class="blank10"></div>
	<!--Footer Start-->
<?php include_once("footer.php");?>
</DIV>