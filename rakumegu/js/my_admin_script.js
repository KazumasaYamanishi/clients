window.onload = function () {

	var allResultsYet 		= document.getElementById( "allResultsYet" ).innerHTML ; 		// 総未催行
	var firstResultsYet 	= document.getElementById( "firstResultsYet" ).innerHTML ; 		// 第一期未催行
	var secondResultsYet 	= document.getElementById( "secondResultsYet" ).innerHTML ; 		// 第二期未催行
	var firstResults 		= document.getElementById( "firstResults" ).innerHTML ; 		// 第一期補助金額　※催行済
	var secondResults 		= document.getElementById( "secondResults" ).innerHTML ; 		// 第二期補助金額　※催行済

	allResultsYet 		= allResultsYet - 0;
	firstResultsYet 	= firstResultsYet - 0;
	secondResultsYet 	= secondResultsYet - 0;
	firstResults 		= firstResults - 0;
	secondResults 		= secondResults - 0;

	var data = [
		{
			value: firstResults,
			color:"#004679",
			highlight: "#FF5A5E",
			label: "補助額（第一期）"
		},
		{
			value: secondResults,
			color: "#499475",
			highlight: "#FF5A5E",
			label: "補助額（第二期）"
		},
		{
			value: allResultsYet,
			color: "#bac1c7",
			highlight: "#FF5A5E",
			label: "補助金残高"
		}
	];

	var data1 = [
		{
			value: firstResults,
			color:"#004679",
			highlight: "#FF5A5E",
			label: "補助額（第一期）"
		},
		{
			value: firstResultsYet,
			color: "#bac1c7",
			highlight: "#FF5A5E",
			label: "補助金残高"
		}
	];

	var data2 = [
		{
			value: secondResults,
			color: "#499475",
			highlight: "#FF5A5E",
			label: "補助額（第二期）"
		},
		{
			value: secondResultsYet,
			color: "#bac1c7",
			highlight: "#FF5A5E",
			label: "補助金残高"
		}
	];

	var myChart0 = new Chart(document.getElementById("budget").getContext("2d")).Pie(data);
	var myChart1 = new Chart(document.getElementById("budgetFirst").getContext("2d")).Pie(data1);
	var myChart2 = new Chart(document.getElementById("budgetSecond").getContext("2d")).Pie(data2);





	var month07 	= document.getElementById( "month07" ).innerHTML ; 		// 総補助金額
	var month08 	= document.getElementById( "month08" ).innerHTML ; 	// 第一期補助金額　※催行済
	var month09 	= document.getElementById( "month09" ).innerHTML ; 	// 第二期補助金額　※催行済
	var month10 	= document.getElementById( "month10" ).innerHTML ; 	// 第二期補助金額　※催行済
	var month11 	= document.getElementById( "month11" ).innerHTML ; 	// 第二期補助金額　※催行済
	var month12 	= document.getElementById( "month12" ).innerHTML ; 	// 第二期補助金額　※催行済

	month07 = month07 - 0;
	month08 = month08 - 0;
	month09 = month09 - 0;
	month10 = month10 - 0;
	month11 = month11 - 0;
	month12 = month12 - 0;

	var data = {
		labels: [ "7月", "8月", "9月", "10月", "11月", "12月" ], // X軸
		datasets: [
			{
				label				: "月別",						// 項目名
				fillColor			: "#bac1c7",					// 塗りつぶす色
				strokeColor			: "#bac1c7",					// 枠線の色
				highlightFill		: "#FF5A5E",					// マウスオーバー時塗りつぶす色
				highlightStroke		: "#FF5A5E",					// マウスオーバー時枠線の色
				data				: [ month07, month08, month09, month10, month11, month12 ]	// 値
			}
		]
	};

	var myChart = new Chart(document.getElementById("budget-month").getContext("2d")).Bar(data);



};