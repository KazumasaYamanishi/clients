window.onload = function () {

	var resultTAXI 	= document.getElementById( "resultTAXI" ).innerHTML ; 	// すべてのタクシー会社の割引金額
	var resultRENT 	= document.getElementById( "resultRENT" ).innerHTML ; 	// すべてのレンタカー会社の割引金額
	var nosTAXI 	= document.getElementById( "nosTAXI" ).innerHTML ; 		// すべてのタクシー会社の証明書枚数
	var nosRENT 	= document.getElementById( "nosRENT" ).innerHTML ; 		// すべてのレンタカー会社の証明書枚数

	var areaKagoshima 	= document.getElementById( "areaKagoshima" ).innerHTML; // 鹿児島
	var areaAira 		= document.getElementById( "areaAira" ).innerHTML; 		// 姶良・伊佐
	var areaHokusatsu 	= document.getElementById( "areaHokusatsu" ).innerHTML;	// 北薩
	var areaNansatsu 	= document.getElementById( "areaNansatsu" ).innerHTML;	// 南薩
	var areaOsumi 		= document.getElementById( "areaOsumi" ).innerHTML;		// 大隅
	var areaTane 		= document.getElementById( "areaTane" ).innerHTML;		// 種子島
	var areaYaku 		= document.getElementById( "areaYaku" ).innerHTML;		// 屋久島
	var areaAmami 		= document.getElementById( "areaAmami" ).innerHTML; 	// 奄美群島
	var areaOther 		= document.getElementById( "areaOther" ).innerHTML;		// その他

	var data = [
		{
			value: resultTAXI,
			color:"#65ace4",
			highlight: "#FF5A5E",
			label: "タクシー会社の割引金額"
		},
		{
			value: resultRENT,
			color: "#a0c238",
			highlight: "#FF5A5E",
			label: "レンタカー会社の割引金額"
		}
	];

	var data1 = [
		{
			value: nosTAXI,
			color:"#65ace4",
			highlight: "#FF5A5E",
			label: "すべてのタクシー会社の証明書枚数"
		},
		{
			value: nosRENT,
			color: "#a0c238",
			highlight: "#FF5A5E",
			label: "すべてのレンタカー会社の証明書枚数"
		}
	];

		var data2 = [
		{
			value: areaKagoshima,
			color:"#0074bf",
			highlight: "#FF5A5E",
			label: "鹿児島エリア"
		},
		{
			value: areaAira,
			color:"#f2cf01",
			highlight: "#FF5A5E",
			label: "姶良・伊佐エリア"
		},
		{
			value: areaHokusatsu,
			color:"#9460a0",
			highlight: "#FF5A5E",
			label: "北薩エリア"
		},
		{
			value: areaNansatsu,
			color:"#d16b16",
			highlight: "#FF5A5E",
			label: "南薩エリア"
		},
		{
			value: areaOsumi,
			color:"#56a764",
			highlight: "#FF5A5E",
			label: "大隅エリア"
		},
		{
			value: areaTane,
			color:"#d06d8c",
			highlight: "#FF5A5E",
			label: "種子島エリア"
		},
		{
			value: areaYaku,
			color:"#de9610",
			highlight: "#FF5A5E",
			label: "屋久島エリア"
		},
		{
			value: areaAmami,
			color:"#009dc6",
			highlight: "#FF5A5E",
			label: "奄美群島エリア"
		},
		{
			value: areaOther,
			color:"#382284",
			highlight: "#FF5A5E",
			label: "その他エリア"
		}
	];

	var myChart0 = new Chart(document.getElementById("resGraph").getContext("2d")).Pie(data);
	var myChart1 = new Chart(document.getElementById("nosGraph").getContext("2d")).Pie(data1);
	var myChart2 = new Chart(document.getElementById("sightGraph").getContext("2d")).Pie(data2);

};