window.onload = function () {

	var resultTAXI 	= document.getElementById( "resultTAXI" ).innerHTML ; 	// すべてのタクシー会社の割引金額
	var resultRENT 	= document.getElementById( "resultRENT" ).innerHTML ; 	// すべてのレンタカー会社の割引金額
	var nosTAXI 	= document.getElementById( "nosTAXI" ).innerHTML ; 		// すべてのタクシー会社の証明書枚数
	var nosRENT 	= document.getElementById( "nosRENT" ).innerHTML ; 		// すべてのレンタカー会社の証明書枚数

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

	var myChart0 = new Chart(document.getElementById("resGraph").getContext("2d")).Pie(data);
	var myChart1 = new Chart(document.getElementById("nosGraph").getContext("2d")).Pie(data1);

};