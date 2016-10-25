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

/*��������*/
var arrProvince = new Array();
arrProvince[0] = '--';
arrProvince[11] = '����';
arrProvince[12] = '���';
arrProvince[13] = '�ӱ�';
arrProvince[14] = 'ɽ��';
arrProvince[15] = '���ɹ�';
arrProvince[21] = '����';
arrProvince[22] = '����';
arrProvince[23] = '������';
arrProvince[31] = '�Ϻ�';
arrProvince[32] = '����';
arrProvince[33] = '�㽭';
arrProvince[34] = '����';
arrProvince[35] = '����';
arrProvince[36] = '����';
arrProvince[37] = 'ɽ��';
arrProvince[41] = '����';
arrProvince[42] = '����';
arrProvince[43] = '����';
arrProvince[44] = '�㶫';
arrProvince[45] = '����';
arrProvince[46] = '����';
arrProvince[50] = '����';
arrProvince[51] = '�Ĵ�';
arrProvince[52] = '����';
arrProvince[53] = '����';
arrProvince[54] = '����';
arrProvince[61] = '����';
arrProvince[62] = '����';
arrProvince[63] = '�ຣ';
arrProvince[64] = '����';
arrProvince[65] = '�½�';
arrProvince[71] = '̨��';
arrProvince[81] = '���';
arrProvince[82] = '����';

	
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
arrCity[11][1101] = '����';
arrCity[11][1102] = '����';
arrCity[11][1103] = '����';
arrCity[11][1104] = '����';
arrCity[11][1105] = '����';
arrCity[11][1106] = '��̨';
arrCity[11][1107] = 'ʯ��ɽ';
arrCity[11][1108] = '����';
arrCity[11][1109] = '��ͷ��';
arrCity[11][1111] = '��ɽ';
arrCity[11][1112] = 'ͨ��';
arrCity[11][1113] = '˳��';
arrCity[11][1121] = '��ƽ';
arrCity[11][1124] = '����';
arrCity[11][1126] = 'ƽ��';
arrCity[11][1127] = '����';
arrCity[11][1128] = '����';
arrCity[11][1129] = '����';

arrCity[12][1200] = '--';
arrCity[12][1201] = '��ƽ';
arrCity[12][1202] = '�Ӷ�';
arrCity[12][1203] = '����';
arrCity[12][1204] = '�Ͽ�';
arrCity[12][1205] = '�ӱ�';
arrCity[12][1206] = '����';
arrCity[12][1207] = '����';
arrCity[12][1208] = '����';
arrCity[12][1209] = '���';
arrCity[12][1210] = '����';
arrCity[12][1211] = '����';
arrCity[12][1212] = '����';
arrCity[12][1213] = '����';
arrCity[12][1221] = '����';
arrCity[12][1222] = '����';
arrCity[12][1223] = '����';
arrCity[12][1224] = '����';
arrCity[12][1225] = '����';

arrCity[13][1300] = '--';
arrCity[13][1301] = 'ʯ��ׯ';
arrCity[13][1302] = '��ɽ';
arrCity[13][1303] = '�ػʵ�';
arrCity[13][1304] = '����';
arrCity[13][1305] = '��̨';
arrCity[13][1306] = '����';
arrCity[13][1307] = '�żҿ�';
arrCity[13][1308] = '�е�';
arrCity[13][1309] = '����';
arrCity[13][1310] = '�ȷ�';
arrCity[13][1311] = '��ˮ';

arrCity[14][1400] = '--';
arrCity[14][1401] = '̫ԭ';
arrCity[14][1402] = '��ͬ';
arrCity[14][1403] = '��Ȫ';
arrCity[14][1404] = '����';
arrCity[14][1405] = '����';
arrCity[14][1406] = '˷��';
arrCity[14][1407] = '����';
arrCity[14][1408] = '�˳�';
arrCity[14][1409] = '����';
arrCity[14][1410] = '�ٷ�';
arrCity[14][1411] = '����';

arrCity[15][1500] = '--';
arrCity[15][1501] = '���ͺ���';
arrCity[15][1502] = '��ͷ';
arrCity[15][1503] = '�ں�';
arrCity[15][1504] = '���';
arrCity[15][1505] = 'ͨ��';
arrCity[15][1506] = '������˹';
arrCity[15][1507] = '���ױ���';
arrCity[15][1508] = '�����׶�';
arrCity[15][1509] = '�����첼';
arrCity[15][1522] = '�˰�';
arrCity[15][1525] = '���ֹ���';
arrCity[15][1529] = '������';

arrCity[21][2100] = '--';
arrCity[21][2101] = '����';
arrCity[21][2102] = '����';
arrCity[21][2103] = '��ɽ';
arrCity[21][2104] = '��˳';
arrCity[21][2105] = '��Ϫ';
arrCity[21][2106] = '����';
arrCity[21][2107] = '����';
arrCity[21][2108] = 'Ӫ��';
arrCity[21][2109] = '����';
arrCity[21][2110] = '����';
arrCity[21][2111] = '�̽�';
arrCity[21][2112] = '����';
arrCity[21][2113] = '����';
arrCity[21][2114] = '��«��';

arrCity[22][2200] = '--';
arrCity[22][2201] = '����';
arrCity[22][2202] = '����';
arrCity[22][2203] = '��ƽ';
arrCity[22][2204] = '��Դ';
arrCity[22][2205] = 'ͨ��';
arrCity[22][2206] = '��ɽ';
arrCity[22][2207] = '��ԭ';
arrCity[22][2208] = '�׳�';
arrCity[22][2224] = '�ӱ�';

arrCity[23][2300] = '--';
arrCity[23][2301] = '������';
arrCity[23][2302] = '�������';
arrCity[23][2303] = '����';
arrCity[23][2304] = '�׸�';
arrCity[23][2305] = '˫Ѽɽ';
arrCity[23][2306] = '����';
arrCity[23][2307] = '����';
arrCity[23][2308] = '��ľ˹';
arrCity[23][2309] = '��̨��';
arrCity[23][2310] = 'ĵ����';
arrCity[23][2311] = '�ں�';
arrCity[23][2312] = '�绯';
arrCity[23][2327] = '���˰���';

arrCity[31][3100] = '--';
arrCity[31][3101] = '����';
arrCity[31][3102] = '����';
arrCity[31][3103] = '¬��';
arrCity[31][3104] = '���';
arrCity[31][3105] = '����';
arrCity[31][3106] = '����';
arrCity[31][3107] = '����';
arrCity[31][3108] = 'բ��';
arrCity[31][3109] = '���';
arrCity[31][3110] = '����';
arrCity[31][3112] = '����';
arrCity[31][3113] = '��ɽ';
arrCity[31][3114] = '�ζ�';
arrCity[31][3115] = '�ֶ�����';
arrCity[31][3116] = '��ɽ';
arrCity[31][3117] = '�ɽ�';
arrCity[31][3125] = '�ϻ�';
arrCity[31][3126] = '����';
arrCity[31][3129] = '����';
arrCity[31][3130] = '����';

arrCity[32][3200] = '--';
arrCity[32][3201] = '�Ͼ�';
arrCity[32][3202] = '����';
arrCity[32][3203] = '����';
arrCity[32][3204] = '����';
arrCity[32][3205] = '����';
arrCity[32][3206] = '��ͨ';
arrCity[32][3207] = '���Ƹ�';
arrCity[32][3208] = '����';
arrCity[32][3209] = '�γ�';
arrCity[32][3210] = '����';
arrCity[32][3211] = '��';
arrCity[32][3212] = '̩��';
arrCity[32][3213] = '��Ǩ';

arrCity[33][3300] = '--';
arrCity[33][3301] = '����';
arrCity[33][3302] = '����';
arrCity[33][3303] = '����';
arrCity[33][3304] = '����';
arrCity[33][3305] = '����';
arrCity[33][3306] = '����';
arrCity[33][3307] = '��';
arrCity[33][3308] = '����';
arrCity[33][3309] = '��ɽ';
arrCity[33][3310] = '̨��';
arrCity[33][3311] = '��ˮ';

arrCity[34][3400] = '--';
arrCity[34][3401] = '�Ϸ�';
arrCity[34][3402] = '�ߺ�';
arrCity[34][3403] = '����';
arrCity[34][3404] = '����';
arrCity[34][3405] = '��ɽ';
arrCity[34][3406] = '����';
arrCity[34][3407] = 'ͭ��';
arrCity[34][3408] = '����';
arrCity[34][3410] = '��ɽ';
arrCity[34][3411] = '����';
arrCity[34][3412] = '����';
arrCity[34][3413] = '����';
arrCity[34][3414] = '����';
arrCity[34][3415] = '����';
arrCity[34][3416] = '����';
arrCity[34][3417] = '����';
arrCity[34][3418] = '����';

arrCity[35][3500] = '--';
arrCity[35][3501] = '����';
arrCity[35][3502] = '����';
arrCity[35][3503] = '����';
arrCity[35][3504] = '����';
arrCity[35][3505] = 'Ȫ��';
arrCity[35][3506] = '����';
arrCity[35][3507] = '��ƽ';
arrCity[35][3508] = '����';
arrCity[35][3509] = '����';

arrCity[36][3600] = '--';
arrCity[36][3601] = '�ϲ�';
arrCity[36][3602] = '������';
arrCity[36][3603] = 'Ƽ��';
arrCity[36][3604] = '�Ž�';
arrCity[36][3605] = '����';
arrCity[36][3606] = 'ӥ̶';
arrCity[36][3607] = '����';
arrCity[36][3608] = '����';
arrCity[36][3609] = '�˴�';
arrCity[36][3610] = '����';
arrCity[36][3611] = '����';

arrCity[37][3700] = '--';
arrCity[37][3701] = '����';
arrCity[37][3702] = '�ൺ';
arrCity[37][3703] = '�Ͳ�';
arrCity[37][3704] = '��ׯ';
arrCity[37][3705] = '��Ӫ';
arrCity[37][3706] = '��̨';
arrCity[37][3707] = 'Ϋ��';
arrCity[37][3708] = '����';
arrCity[37][3709] = '̩��';
arrCity[37][3710] = '����';
arrCity[37][3711] = '����';
arrCity[37][3712] = '����';
arrCity[37][3713] = '����';
arrCity[37][3714] = '����';
arrCity[37][3715] = '�ĳ�';
arrCity[37][3716] = '����';
arrCity[37][3717] = '����';

arrCity[41][4100] = '--';
arrCity[41][4101] = '֣��';
arrCity[41][4102] = '����';
arrCity[41][4103] = '����';
arrCity[41][4104] = 'ƽ��ɽ';
arrCity[41][4105] = '����';
arrCity[41][4106] = '�ױ�';
arrCity[41][4107] = '����';
arrCity[41][4108] = '����';
arrCity[41][4109] = '���';
arrCity[41][4110] = '���';
arrCity[41][4111] = '���';
arrCity[41][4112] = '����Ͽ';
arrCity[41][4113] = '����';
arrCity[41][4114] = '����';
arrCity[41][4115] = '����';
arrCity[41][4116] = '�ܿ�';
arrCity[41][4117] = 'פ���';

arrCity[42][4200] = '--';
arrCity[42][4201] = '�人';
arrCity[42][4202] = '��ʯ';
arrCity[42][4203] = 'ʮ��';
arrCity[42][4205] = '�˲�';
arrCity[42][4206] = '�差';
arrCity[42][4207] = '����';
arrCity[42][4208] = '����';
arrCity[42][4209] = 'Т��';
arrCity[42][4210] = '����';
arrCity[42][4211] = '�Ƹ�';
arrCity[42][4212] = '����';
arrCity[42][4213] = '����';
arrCity[42][4228] = '��ʩ';

arrCity[43][4300] = '--';
arrCity[43][4301] = '��ɳ';
arrCity[43][4302] = '����';
arrCity[43][4303] = '��̶';
arrCity[43][4304] = '����';
arrCity[43][4305] = '����';
arrCity[43][4306] = '����';
arrCity[43][4307] = '����';
arrCity[43][4308] = '�żҽ�';
arrCity[43][4309] = '����';
arrCity[43][4310] = '����';
arrCity[43][4311] = '����';
arrCity[43][4312] = '����';
arrCity[43][4313] = '¦��';
arrCity[43][4331] = '����';

arrCity[44][4400] = '--';
arrCity[44][4401] = '����';
arrCity[44][4402] = '�ع�';
arrCity[44][4403] = '����';
arrCity[44][4404] = '�麣';
arrCity[44][4405] = '��ͷ';
arrCity[44][4406] = '��ɽ';
arrCity[44][4407] = '����';
arrCity[44][4408] = 'տ��';
arrCity[44][4409] = 'ï��';
arrCity[44][4412] = '����';
arrCity[44][4413] = '����';
arrCity[44][4414] = '÷��';
arrCity[44][4415] = '��β';
arrCity[44][4416] = '��Դ';
arrCity[44][4417] = '����';
arrCity[44][4418] = '��Զ';
arrCity[44][4419] = '��ݸ';
arrCity[44][4420] = '��ɽ';
arrCity[44][4451] = '����';
arrCity[44][4452] = '����';
arrCity[44][4453] = '�Ƹ�';

arrCity[45][4500] = '--';
arrCity[45][4501] = '����';
arrCity[45][4502] = '����';
arrCity[45][4503] = '����';
arrCity[45][4504] = '����';
arrCity[45][4505] = '����';
arrCity[45][4506] = '���Ǹ�';
arrCity[45][4507] = '����';
arrCity[45][4508] = '���';
arrCity[45][4509] = '����';
arrCity[45][4510] = '��ɫ';
arrCity[45][4511] = '����';
arrCity[45][4512] = '�ӳ�';
arrCity[45][4513] = '����';
arrCity[45][4514] = '����';

arrCity[46][4600] = '--';
arrCity[46][4601] = '����';
arrCity[46][4602] = '����';

arrCity[50][5000] = '--';
arrCity[50][5001] = '����';
arrCity[50][5002] = '����';
arrCity[50][5003] = '����';
arrCity[50][5004] = '��ɿ�';
arrCity[50][5005] = '����';
arrCity[50][5006] = 'ɳƺ��';
arrCity[50][5007] = '������';
arrCity[50][5008] = '�ϰ�';
arrCity[50][5009] = '����';
arrCity[50][5010] = '��ʢ';
arrCity[50][5011] = '˫��';
arrCity[50][5012] = '�山';
arrCity[50][5013] = '����';
arrCity[50][5021] = '����';
arrCity[50][5022] = '�뽭';
arrCity[50][5023] = '����';
arrCity[50][5024] = 'ͭ��';
arrCity[50][5025] = '����';
arrCity[50][5026] = '�ٲ�';
arrCity[50][5027] = '�ɽ';
arrCity[50][5028] = '��ƽ';
arrCity[50][5029] = '�ǿ�';
arrCity[50][5030] = '�ᶼ';
arrCity[50][5031] = '�潭';
arrCity[50][5032] = '��¡';
arrCity[50][5033] = '����';
arrCity[50][5034] = '����';
arrCity[50][5035] = '����';
arrCity[50][5036] = '���';
arrCity[50][5037] = '��ɽ';
arrCity[50][5038] = '��Ϫ';
arrCity[50][5039] = 'ǭ��';
arrCity[50][5040] = 'ʯ��';
arrCity[50][5041] = '��ɽ';
arrCity[50][5042] = '����';
arrCity[50][5043] = '��ˮ';
arrCity[50][5081] = '����';
arrCity[50][5082] = '�ϴ�';
arrCity[50][5083] = '����';
arrCity[50][5084] = '�ϴ�';

arrCity[51][5100] = '--';
arrCity[51][5101] = '�ɶ�';
arrCity[51][5103] = '�Թ�';
arrCity[51][5104] = '��֦��';
arrCity[51][5105] = '����';
arrCity[51][5106] = '����';
arrCity[51][5107] = '����';
arrCity[51][5108] = '��Ԫ';
arrCity[51][5109] = '����';
arrCity[51][5110] = '�ڽ�';
arrCity[51][5111] = '��ɽ';
arrCity[51][5113] = '�ϳ�';
arrCity[51][5114] = 'üɽ';
arrCity[51][5115] = '�˱�';
arrCity[51][5116] = '�㰲';
arrCity[51][5117] = '����';
arrCity[51][5118] = '�Ű�';
arrCity[51][5119] = '����';
arrCity[51][5120] = '����';
arrCity[51][5132] = '����';
arrCity[51][5133] = '����';
arrCity[51][5134] = '��ɽ';

arrCity[52][5200] = '--';
arrCity[52][5201] = '����';
arrCity[52][5202] = '����ˮ';
arrCity[52][5203] = '����';
arrCity[52][5204] = '��˳';
arrCity[52][5222] = 'ͭ��';
arrCity[52][5223] = 'ǭ����';
arrCity[52][5224] = '�Ͻ�';
arrCity[52][5226] = 'ǭ����';
arrCity[52][5227] = 'ǭ��';

arrCity[53][5300] = '--';
arrCity[53][5301] = '����';
arrCity[53][5303] = '����';
arrCity[53][5304] = '��Ϫ';
arrCity[53][5305] = '��ɽ';
arrCity[53][5306] = '��ͨ';
arrCity[53][5307] = '����';
arrCity[53][5308] = '˼é';
arrCity[53][5309] = '�ٲ�';
arrCity[53][5323] = '����';
arrCity[53][5325] = '���';
arrCity[53][5326] = '��ɽ';
arrCity[53][5328] = '��˫����';
arrCity[53][5329] = '����';
arrCity[53][5331] = '�º�';
arrCity[53][5333] = 'ŭ����';
arrCity[53][5334] = '����';

arrCity[54][5400] = '--';
arrCity[54][5401] = '����';
arrCity[54][5421] = '����';
arrCity[54][5422] = 'ɽ��';
arrCity[54][5423] = '�տ���';
arrCity[54][5424] = '����';
arrCity[54][5425] = '����';
arrCity[54][5426] = '��֥';

arrCity[61][6100] = '--';
arrCity[61][6101] = '����';
arrCity[61][6102] = 'ͭ��';
arrCity[61][6103] = '����';
arrCity[61][6104] = '����';
arrCity[61][6105] = 'μ��';
arrCity[61][6106] = '�Ӱ�';
arrCity[61][6107] = '����';
arrCity[61][6108] = '����';
arrCity[61][6109] = '����';
arrCity[61][6110] = '����';

arrCity[62][6200] = '--';
arrCity[62][6201] = '����';
arrCity[62][6202] = '������';
arrCity[62][6203] = '���';
arrCity[62][6204] = '����';
arrCity[62][6205] = '��ˮ';
arrCity[62][6206] = '����';
arrCity[62][6207] = '��Ҵ';
arrCity[62][6208] = 'ƽ��';
arrCity[62][6209] = '��Ȫ';
arrCity[62][6210] = '����';
arrCity[62][6211] = '����';
arrCity[62][6212] = '¤��';
arrCity[62][6229] = '����';
arrCity[62][6230] = '����';

arrCity[63][6300] = '--';
arrCity[63][6301] = '����';
arrCity[63][6321] = '����';
arrCity[63][6322] = '����';
arrCity[63][6323] = '����';
arrCity[63][6325] = '����';
arrCity[63][6326] = '����';
arrCity[63][6327] = '����';
arrCity[63][6328] = '����';

arrCity[64][6400] = '--';
arrCity[64][6401] = '����';
arrCity[64][6402] = 'ʯ��ɽ';
arrCity[64][6403] = '����';
arrCity[64][6404] = '��ԭ';
arrCity[64][6405] = '����';

arrCity[65][6500] = '--';
arrCity[65][6501] = '��³ľ��';
arrCity[65][6502] = '��������';
arrCity[65][6521] = '��³��';
arrCity[65][6522] = '����';
arrCity[65][6523] = '����';
arrCity[65][6527] = '��������';
arrCity[65][6528] = '��������';
arrCity[65][6529] = '������';
arrCity[65][6530] = '��������';
arrCity[65][6531] = '��ʲ';
arrCity[65][6532] = '����';
arrCity[65][6540] = '����';
arrCity[65][6542] = '����';
arrCity[65][6543] = '����̩';
arrCity[71][7100] = '--';
arrCity[81][8100] = '--';
arrCity[82][8200] = '--';