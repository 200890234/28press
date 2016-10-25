function initAddr(proID,cityID,proValue,cityValue){
	var objPro=document.getElementById(proID);
	var objCity=document.getElementById(cityID);
	for(i=0,j=0;i<arrProvince.length;i++){
		if(arrProvince[i]){
			var option = document.createElement("option");
			option.text = arrProvince[i];
			option.value = i;
			objPro.options.add(option);
			if(i == proValue){
				objPro.selectedIndex = j;
			}
			j++;
		}
	}
	objCity.options.length=0;
	if(proValue){
		for(i=0,j=0;i<arrCity[proValue].length;i++){
			if(arrCity[proValue][i]){
				var option = document.createElement("option");
				option.text = arrCity[proValue][i];
				option.value = i;
				objCity.options.add(option);
				if(i == cityValue){
					objCity.selectedIndex = j;
				}
				j++;
			}
		}
	}
	else{
		var option = document.createElement("option");
		option.text = arrCity[0][0];
		option.value = 0;
		objCity.options.add(option);
	}
}

function fillAddr(proID,cityID){
	var objPro=document.getElementById(proID);
	for(i=0;i<arrProvince.length;i++){
		if(arrProvince[i]){
			var option = document.createElement("option");
			option.text = arrProvince[i];
			option.value = i;
			objPro.options.add(option);
		}
	}
	var objCity=document.getElementById(cityID);
	var option = document.createElement("option");
	option.text = arrCity[0][0];
	option.value = 0;
	objCity.options.add(option);
}

function chgPro(proID,cityID){
	var objPro=document.getElementById(proID);
	var objCity=document.getElementById(cityID);
	objCity.options.length=0;
	for(i=0;i<arrCity[objPro.value].length;i++){
		if(arrCity[objPro.value][i]){
			var option = document.createElement("option");
			option.text = arrCity[objPro.value][i];
			option.value = i;
			objCity.options.add(option);
		}
	}
}

/*地区数组*/
var arrProvince = new Array();
arrProvince[0] = '--';
arrProvince[11] = '北京';
arrProvince[12] = '天津';
arrProvince[13] = '河北';
arrProvince[14] = '山西';
arrProvince[15] = '内蒙古';
arrProvince[21] = '辽宁';
arrProvince[22] = '吉林';
arrProvince[23] = '黑龙江';
arrProvince[31] = '上海';
arrProvince[32] = '江苏';
arrProvince[33] = '浙江';
arrProvince[34] = '安徽';
arrProvince[35] = '福建';
arrProvince[36] = '江西';
arrProvince[37] = '山东';
arrProvince[41] = '河南';
arrProvince[42] = '湖北';
arrProvince[43] = '湖南';
arrProvince[44] = '广东';
arrProvince[45] = '广西';
arrProvince[46] = '海南';
arrProvince[50] = '重庆';
arrProvince[51] = '四川';
arrProvince[52] = '贵州';
arrProvince[53] = '云南';
arrProvince[54] = '西藏';
arrProvince[61] = '陕西';
arrProvince[62] = '甘肃';
arrProvince[63] = '青海';
arrProvince[64] = '宁夏';
arrProvince[65] = '新疆';
arrProvince[71] = '台湾';
arrProvince[81] = '香港';
arrProvince[82] = '澳门';

	
var arrCity = new Array();
arrCity[0] = new Array();
arrCity[11] = new Array();
arrCity[12] = new Array();
arrCity[13] = new Array();
arrCity[14] = new Array();
arrCity[15] = new Array();
arrCity[21] = new Array();
arrCity[22] = new Array();
arrCity[23] = new Array();
arrCity[31] = new Array();
arrCity[32] = new Array();
arrCity[33] = new Array();
arrCity[34] = new Array();
arrCity[35] = new Array();
arrCity[36] = new Array();
arrCity[37] = new Array();
arrCity[41] = new Array();
arrCity[42] = new Array();
arrCity[43] = new Array();
arrCity[44] = new Array();
arrCity[45] = new Array();
arrCity[46] = new Array();
arrCity[50] = new Array();
arrCity[51] = new Array();
arrCity[52] = new Array();
arrCity[53] = new Array();
arrCity[54] = new Array();
arrCity[61] = new Array();
arrCity[62] = new Array();
arrCity[63] = new Array();
arrCity[64] = new Array();
arrCity[65] = new Array();
arrCity[71] = new Array();
arrCity[81] = new Array();
arrCity[82] = new Array();

arrCity[0][0] = '--';
arrCity[11][1100] = '--';
arrCity[11][1101] = '东城';
arrCity[11][1102] = '西城';
arrCity[11][1103] = '崇文';
arrCity[11][1104] = '宣武';
arrCity[11][1105] = '朝阳';
arrCity[11][1106] = '丰台';
arrCity[11][1107] = '石景山';
arrCity[11][1108] = '海淀';
arrCity[11][1109] = '门头沟';
arrCity[11][1111] = '房山';
arrCity[11][1112] = '通州';
arrCity[11][1113] = '顺义';
arrCity[11][1121] = '昌平';
arrCity[11][1124] = '大兴';
arrCity[11][1126] = '平谷';
arrCity[11][1127] = '怀柔';
arrCity[11][1128] = '密云';
arrCity[11][1129] = '延庆';

arrCity[12][1200] = '--';
arrCity[12][1201] = '和平';
arrCity[12][1202] = '河东';
arrCity[12][1203] = '河西';
arrCity[12][1204] = '南开';
arrCity[12][1205] = '河北';
arrCity[12][1206] = '红桥';
arrCity[12][1207] = '塘沽';
arrCity[12][1208] = '汉沽';
arrCity[12][1209] = '大港';
arrCity[12][1210] = '东丽';
arrCity[12][1211] = '西青';
arrCity[12][1212] = '津南';
arrCity[12][1213] = '北辰';
arrCity[12][1221] = '宁河';
arrCity[12][1222] = '武清';
arrCity[12][1223] = '静海';
arrCity[12][1224] = '宝坻';
arrCity[12][1225] = '蓟县';

arrCity[13][1300] = '--';
arrCity[13][1301] = '石家庄';
arrCity[13][1302] = '唐山';
arrCity[13][1303] = '秦皇岛';
arrCity[13][1304] = '邯郸';
arrCity[13][1305] = '邢台';
arrCity[13][1306] = '保定';
arrCity[13][1307] = '张家口';
arrCity[13][1308] = '承德';
arrCity[13][1309] = '沧州';
arrCity[13][1310] = '廊坊';
arrCity[13][1311] = '衡水';

arrCity[14][1400] = '--';
arrCity[14][1401] = '太原';
arrCity[14][1402] = '大同';
arrCity[14][1403] = '阳泉';
arrCity[14][1404] = '长治';
arrCity[14][1405] = '晋城';
arrCity[14][1406] = '朔州';
arrCity[14][1407] = '晋中';
arrCity[14][1408] = '运城';
arrCity[14][1409] = '忻州';
arrCity[14][1410] = '临汾';
arrCity[14][1411] = '吕梁';

arrCity[15][1500] = '--';
arrCity[15][1501] = '呼和浩特';
arrCity[15][1502] = '包头';
arrCity[15][1503] = '乌海';
arrCity[15][1504] = '赤峰';
arrCity[15][1505] = '通辽';
arrCity[15][1506] = '鄂尔多斯';
arrCity[15][1507] = '呼伦贝尔';
arrCity[15][1508] = '巴彦淖尔';
arrCity[15][1509] = '乌兰察布';
arrCity[15][1522] = '兴安';
arrCity[15][1525] = '锡林郭勒';
arrCity[15][1529] = '阿拉善';

arrCity[21][2100] = '--';
arrCity[21][2101] = '沈阳';
arrCity[21][2102] = '大连';
arrCity[21][2103] = '鞍山';
arrCity[21][2104] = '抚顺';
arrCity[21][2105] = '本溪';
arrCity[21][2106] = '丹东';
arrCity[21][2107] = '锦州';
arrCity[21][2108] = '营口';
arrCity[21][2109] = '阜新';
arrCity[21][2110] = '辽阳';
arrCity[21][2111] = '盘锦';
arrCity[21][2112] = '铁岭';
arrCity[21][2113] = '朝阳';
arrCity[21][2114] = '葫芦岛';

arrCity[22][2200] = '--';
arrCity[22][2201] = '长春';
arrCity[22][2202] = '吉林';
arrCity[22][2203] = '四平';
arrCity[22][2204] = '辽源';
arrCity[22][2205] = '通化';
arrCity[22][2206] = '白山';
arrCity[22][2207] = '松原';
arrCity[22][2208] = '白城';
arrCity[22][2224] = '延边';

arrCity[23][2300] = '--';
arrCity[23][2301] = '哈尔滨';
arrCity[23][2302] = '齐齐哈尔';
arrCity[23][2303] = '鸡西';
arrCity[23][2304] = '鹤岗';
arrCity[23][2305] = '双鸭山';
arrCity[23][2306] = '大庆';
arrCity[23][2307] = '伊春';
arrCity[23][2308] = '佳木斯';
arrCity[23][2309] = '七台河';
arrCity[23][2310] = '牡丹江';
arrCity[23][2311] = '黑河';
arrCity[23][2312] = '绥化';
arrCity[23][2327] = '大兴安岭';

arrCity[31][3100] = '--';
arrCity[31][3101] = '黄浦';
arrCity[31][3102] = '南区';
arrCity[31][3103] = '卢湾';
arrCity[31][3104] = '徐汇';
arrCity[31][3105] = '长宁';
arrCity[31][3106] = '静安';
arrCity[31][3107] = '普陀';
arrCity[31][3108] = '闸北';
arrCity[31][3109] = '虹口';
arrCity[31][3110] = '杨浦';
arrCity[31][3112] = '闵行';
arrCity[31][3113] = '宝山';
arrCity[31][3114] = '嘉定';
arrCity[31][3115] = '浦东新区';
arrCity[31][3116] = '金山';
arrCity[31][3117] = '松江';
arrCity[31][3125] = '南汇';
arrCity[31][3126] = '奉贤';
arrCity[31][3129] = '青浦';
arrCity[31][3130] = '崇明';

arrCity[32][3200] = '--';
arrCity[32][3201] = '南京';
arrCity[32][3202] = '无锡';
arrCity[32][3203] = '徐州';
arrCity[32][3204] = '常州';
arrCity[32][3205] = '苏州';
arrCity[32][3206] = '南通';
arrCity[32][3207] = '连云港';
arrCity[32][3208] = '淮安';
arrCity[32][3209] = '盐城';
arrCity[32][3210] = '扬州';
arrCity[32][3211] = '镇江';
arrCity[32][3212] = '泰州';
arrCity[32][3213] = '宿迁';

arrCity[33][3300] = '--';
arrCity[33][3301] = '杭州';
arrCity[33][3302] = '宁波';
arrCity[33][3303] = '温州';
arrCity[33][3304] = '嘉兴';
arrCity[33][3305] = '湖州';
arrCity[33][3306] = '绍兴';
arrCity[33][3307] = '金华';
arrCity[33][3308] = '衢州';
arrCity[33][3309] = '舟山';
arrCity[33][3310] = '台州';
arrCity[33][3311] = '丽水';

arrCity[34][3400] = '--';
arrCity[34][3401] = '合肥';
arrCity[34][3402] = '芜湖';
arrCity[34][3403] = '蚌埠';
arrCity[34][3404] = '淮南';
arrCity[34][3405] = '马鞍山';
arrCity[34][3406] = '淮北';
arrCity[34][3407] = '铜陵';
arrCity[34][3408] = '安庆';
arrCity[34][3410] = '黄山';
arrCity[34][3411] = '滁州';
arrCity[34][3412] = '阜阳';
arrCity[34][3413] = '宿州';
arrCity[34][3414] = '巢湖';
arrCity[34][3415] = '六安';
arrCity[34][3416] = '亳州';
arrCity[34][3417] = '池州';
arrCity[34][3418] = '宣城';

arrCity[35][3500] = '--';
arrCity[35][3501] = '福州';
arrCity[35][3502] = '厦门';
arrCity[35][3503] = '莆田';
arrCity[35][3504] = '三明';
arrCity[35][3505] = '泉州';
arrCity[35][3506] = '漳州';
arrCity[35][3507] = '南平';
arrCity[35][3508] = '龙岩';
arrCity[35][3509] = '宁德';

arrCity[36][3600] = '--';
arrCity[36][3601] = '南昌';
arrCity[36][3602] = '景德镇';
arrCity[36][3603] = '萍乡';
arrCity[36][3604] = '九江';
arrCity[36][3605] = '新余';
arrCity[36][3606] = '鹰潭';
arrCity[36][3607] = '赣州';
arrCity[36][3608] = '吉安';
arrCity[36][3609] = '宜春';
arrCity[36][3610] = '抚州';
arrCity[36][3611] = '上饶';

arrCity[37][3700] = '--';
arrCity[37][3701] = '济南';
arrCity[37][3702] = '青岛';
arrCity[37][3703] = '淄博';
arrCity[37][3704] = '枣庄';
arrCity[37][3705] = '东营';
arrCity[37][3706] = '烟台';
arrCity[37][3707] = '潍坊';
arrCity[37][3708] = '济宁';
arrCity[37][3709] = '泰安';
arrCity[37][3710] = '威海';
arrCity[37][3711] = '日照';
arrCity[37][3712] = '莱芜';
arrCity[37][3713] = '临沂';
arrCity[37][3714] = '德州';
arrCity[37][3715] = '聊城';
arrCity[37][3716] = '滨州';
arrCity[37][3717] = '荷泽';

arrCity[41][4100] = '--';
arrCity[41][4101] = '郑州';
arrCity[41][4102] = '开封';
arrCity[41][4103] = '洛阳';
arrCity[41][4104] = '平顶山';
arrCity[41][4105] = '安阳';
arrCity[41][4106] = '鹤壁';
arrCity[41][4107] = '新乡';
arrCity[41][4108] = '焦作';
arrCity[41][4109] = '濮阳';
arrCity[41][4110] = '许昌';
arrCity[41][4111] = '漯河';
arrCity[41][4112] = '三门峡';
arrCity[41][4113] = '南阳';
arrCity[41][4114] = '商丘';
arrCity[41][4115] = '信阳';
arrCity[41][4116] = '周口';
arrCity[41][4117] = '驻马店';

arrCity[42][4200] = '--';
arrCity[42][4201] = '武汉';
arrCity[42][4202] = '黄石';
arrCity[42][4203] = '十堰';
arrCity[42][4205] = '宜昌';
arrCity[42][4206] = '襄樊';
arrCity[42][4207] = '鄂州';
arrCity[42][4208] = '荆门';
arrCity[42][4209] = '孝感';
arrCity[42][4210] = '荆州';
arrCity[42][4211] = '黄冈';
arrCity[42][4212] = '咸宁';
arrCity[42][4213] = '随州';
arrCity[42][4228] = '恩施';

arrCity[43][4300] = '--';
arrCity[43][4301] = '长沙';
arrCity[43][4302] = '株洲';
arrCity[43][4303] = '湘潭';
arrCity[43][4304] = '衡阳';
arrCity[43][4305] = '邵阳';
arrCity[43][4306] = '岳阳';
arrCity[43][4307] = '常德';
arrCity[43][4308] = '张家界';
arrCity[43][4309] = '益阳';
arrCity[43][4310] = '郴州';
arrCity[43][4311] = '永州';
arrCity[43][4312] = '怀化';
arrCity[43][4313] = '娄底';
arrCity[43][4331] = '湘西';

arrCity[44][4400] = '--';
arrCity[44][4401] = '广州';
arrCity[44][4402] = '韶关';
arrCity[44][4403] = '深圳';
arrCity[44][4404] = '珠海';
arrCity[44][4405] = '汕头';
arrCity[44][4406] = '佛山';
arrCity[44][4407] = '江门';
arrCity[44][4408] = '湛江';
arrCity[44][4409] = '茂名';
arrCity[44][4412] = '肇庆';
arrCity[44][4413] = '惠州';
arrCity[44][4414] = '梅州';
arrCity[44][4415] = '汕尾';
arrCity[44][4416] = '河源';
arrCity[44][4417] = '阳江';
arrCity[44][4418] = '清远';
arrCity[44][4419] = '东莞';
arrCity[44][4420] = '中山';
arrCity[44][4451] = '潮州';
arrCity[44][4452] = '揭阳';
arrCity[44][4453] = '云浮';

arrCity[45][4500] = '--';
arrCity[45][4501] = '南宁';
arrCity[45][4502] = '柳州';
arrCity[45][4503] = '桂林';
arrCity[45][4504] = '梧州';
arrCity[45][4505] = '北海';
arrCity[45][4506] = '防城港';
arrCity[45][4507] = '钦州';
arrCity[45][4508] = '贵港';
arrCity[45][4509] = '玉林';
arrCity[45][4510] = '百色';
arrCity[45][4511] = '贺州';
arrCity[45][4512] = '河池';
arrCity[45][4513] = '来宾';
arrCity[45][4514] = '崇左';

arrCity[46][4600] = '--';
arrCity[46][4601] = '海口';
arrCity[46][4602] = '三亚';

arrCity[50][5000] = '--';
arrCity[50][5001] = '万州';
arrCity[50][5002] = '涪陵';
arrCity[50][5003] = '渝中';
arrCity[50][5004] = '大渡口';
arrCity[50][5005] = '江北';
arrCity[50][5006] = '沙坪坝';
arrCity[50][5007] = '九龙坡';
arrCity[50][5008] = '南岸';
arrCity[50][5009] = '北碚';
arrCity[50][5010] = '万盛';
arrCity[50][5011] = '双桥';
arrCity[50][5012] = '渝北';
arrCity[50][5013] = '巴南';
arrCity[50][5021] = '长寿';
arrCity[50][5022] = '綦江';
arrCity[50][5023] = '潼南';
arrCity[50][5024] = '铜梁';
arrCity[50][5025] = '大足';
arrCity[50][5026] = '荣昌';
arrCity[50][5027] = '璧山';
arrCity[50][5028] = '梁平';
arrCity[50][5029] = '城口';
arrCity[50][5030] = '丰都';
arrCity[50][5031] = '垫江';
arrCity[50][5032] = '武隆';
arrCity[50][5033] = '忠县';
arrCity[50][5034] = '开县';
arrCity[50][5035] = '云阳';
arrCity[50][5036] = '奉节';
arrCity[50][5037] = '巫山';
arrCity[50][5038] = '巫溪';
arrCity[50][5039] = '黔江';
arrCity[50][5040] = '石柱';
arrCity[50][5041] = '秀山';
arrCity[50][5042] = '酉阳';
arrCity[50][5043] = '彭水';
arrCity[50][5081] = '江津';
arrCity[50][5082] = '合川';
arrCity[50][5083] = '永川';
arrCity[50][5084] = '南川';

arrCity[51][5100] = '--';
arrCity[51][5101] = '成都';
arrCity[51][5103] = '自贡';
arrCity[51][5104] = '攀枝花';
arrCity[51][5105] = '泸州';
arrCity[51][5106] = '德阳';
arrCity[51][5107] = '绵阳';
arrCity[51][5108] = '广元';
arrCity[51][5109] = '遂宁';
arrCity[51][5110] = '内江';
arrCity[51][5111] = '乐山';
arrCity[51][5113] = '南充';
arrCity[51][5114] = '眉山';
arrCity[51][5115] = '宜宾';
arrCity[51][5116] = '广安';
arrCity[51][5117] = '达州';
arrCity[51][5118] = '雅安';
arrCity[51][5119] = '巴中';
arrCity[51][5120] = '资阳';
arrCity[51][5132] = '阿坝';
arrCity[51][5133] = '甘孜';
arrCity[51][5134] = '凉山';

arrCity[52][5200] = '--';
arrCity[52][5201] = '贵阳';
arrCity[52][5202] = '六盘水';
arrCity[52][5203] = '遵义';
arrCity[52][5204] = '安顺';
arrCity[52][5222] = '铜仁';
arrCity[52][5223] = '黔西南';
arrCity[52][5224] = '毕节';
arrCity[52][5226] = '黔东南';
arrCity[52][5227] = '黔南';

arrCity[53][5300] = '--';
arrCity[53][5301] = '昆明';
arrCity[53][5303] = '曲靖';
arrCity[53][5304] = '玉溪';
arrCity[53][5305] = '保山';
arrCity[53][5306] = '昭通';
arrCity[53][5307] = '丽江';
arrCity[53][5308] = '思茅';
arrCity[53][5309] = '临沧';
arrCity[53][5323] = '楚雄';
arrCity[53][5325] = '红河';
arrCity[53][5326] = '文山';
arrCity[53][5328] = '西双版纳';
arrCity[53][5329] = '大理';
arrCity[53][5331] = '德宏';
arrCity[53][5333] = '怒江傈';
arrCity[53][5334] = '迪庆';

arrCity[54][5400] = '--';
arrCity[54][5401] = '拉萨';
arrCity[54][5421] = '昌都';
arrCity[54][5422] = '山南';
arrCity[54][5423] = '日喀则';
arrCity[54][5424] = '那曲';
arrCity[54][5425] = '阿里';
arrCity[54][5426] = '林芝';

arrCity[61][6100] = '--';
arrCity[61][6101] = '西安';
arrCity[61][6102] = '铜川';
arrCity[61][6103] = '宝鸡';
arrCity[61][6104] = '咸阳';
arrCity[61][6105] = '渭南';
arrCity[61][6106] = '延安';
arrCity[61][6107] = '汉中';
arrCity[61][6108] = '榆林';
arrCity[61][6109] = '安康';
arrCity[61][6110] = '商洛';

arrCity[62][6200] = '--';
arrCity[62][6201] = '兰州';
arrCity[62][6202] = '嘉峪关';
arrCity[62][6203] = '金昌';
arrCity[62][6204] = '白银';
arrCity[62][6205] = '天水';
arrCity[62][6206] = '武威';
arrCity[62][6207] = '张掖';
arrCity[62][6208] = '平凉';
arrCity[62][6209] = '酒泉';
arrCity[62][6210] = '庆阳';
arrCity[62][6211] = '定西';
arrCity[62][6212] = '陇南';
arrCity[62][6229] = '临夏';
arrCity[62][6230] = '甘南';

arrCity[63][6300] = '--';
arrCity[63][6301] = '西宁';
arrCity[63][6321] = '海东';
arrCity[63][6322] = '海北';
arrCity[63][6323] = '黄南';
arrCity[63][6325] = '海南';
arrCity[63][6326] = '果洛';
arrCity[63][6327] = '玉树';
arrCity[63][6328] = '海西';

arrCity[64][6400] = '--';
arrCity[64][6401] = '银川';
arrCity[64][6402] = '石嘴山';
arrCity[64][6403] = '吴忠';
arrCity[64][6404] = '固原';
arrCity[64][6405] = '中卫';

arrCity[65][6500] = '--';
arrCity[65][6501] = '乌鲁木齐';
arrCity[65][6502] = '克拉玛依';
arrCity[65][6521] = '吐鲁番';
arrCity[65][6522] = '哈密';
arrCity[65][6523] = '昌吉';
arrCity[65][6527] = '博尔塔拉';
arrCity[65][6528] = '巴音郭楞';
arrCity[65][6529] = '阿克苏';
arrCity[65][6530] = '克孜勒苏';
arrCity[65][6531] = '喀什';
arrCity[65][6532] = '和田';
arrCity[65][6540] = '伊犁';
arrCity[65][6542] = '塔城';
arrCity[65][6543] = '阿勒泰';
arrCity[71][7100] = '--';
arrCity[81][8100] = '--';
arrCity[82][8200] = '--';