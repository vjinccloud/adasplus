/**
 * substitute函數的實現思路其實很簡單：使用String的replace函數，在replace函數中用
 * 正則匹配除模板中的要替換的標籤（“{key}”），並進行替換：
 * 
 * 範例：
 * 	var obj = {
 * 		url : "http://www.plannabc.net/" ,
 * 		title : "落草為根——專注前端技術&關注用戶體驗" ,
 * 		text : "懌飛's Blog"
 * 	};
 * 	var link = '<a href="{url}" title="{title}">{text}</a>';
 * 	substitute(link, obj);
 * 
 * @param str
 * @param obj
 * @returns
 */
function substitute(str, obj)  {
    if  (!( Object.prototype.toString.call(str) ===  '[object String]' ))  {
        return  '';
    }

    // {}, new Object(), new Class()
    // Object.prototype.toString.call(node=document.getElementById("xx")) : ie678 == '[object Object]', other =='[object HTMLElement]'
    // 'isPrototypeOf' in node : ie678 === false , other === true
    if (!( Object.prototype.toString.call(obj) ===  '[object Object]'  &&  'isPrototypeOf'  in obj ))  {
        return str;
    }

    // https://developer.mozilla.org/en/JavaScript/Reference/Global_Objects/String/replace
    return str.replace (/\{([^{}]+)\}/g ,  function(match , key) {
        var value = obj [ key ];
        return (value !== undefined) ?  '' + value : '';
    });
}

/**
 * 取得該月的最後一天
 * @param year	年
 * @param month	月
 * @returns
 */
function getLastDay(year, month) { 
	var new_year = year;		// 年份 
	var new_month = month++;	// 下個月月份 
	if(month>12) { 
		new_month -= 12;		// 跨年, 月份歸零 
		new_year++;				// 跨年, 年份增加 
	}
	
	var new_date = new Date(new_year, new_month, 1);				// 取得下個月的第一天 
	return (new Date(new_date.getTime()-1000*60*60*24)).getDate();	// 取得該月的最後一天 
}

function initCalendar(inputObjStr, startDate) {
	inputObjStr = inputObjStr || "form input.inputDate";
	startDate = startDate || '%yyyy-%MM-%dd';
	$(inputObjStr).bind('click', function () {
		WdatePicker({
			isShowWeek: true,				// 顯示月曆週期(false)
			//readOnly: true,				// 限制輸入框只能用點選的方式(false)
			//highLineWeekDay: true,		// 區隔平日、假日(true)
			//isShowClear: false,			// 顯示清空按鈕(true)
			//position: {left:100,top:50},	// 調整顯示位置
			//minDate: '2006-09-10',		// 日期範圍：最小日期(日期格式必須與realDateFmt 和realTimeFmt 一致)
			//maxDate: '2008-12-20',		// 日期範圍：最大日期(日期格式必須與realDateFmt 和realTimeFmt 一致)
			startDate: '%yyyy-%MM-%dd',		// 預設選取日期(可使用動態參數：%y-%M-01 00:00:00)
			//alwaysUseStartDate: true,		// 無論日期框的值為何, 皆以startDate為預選日期
			//dateFmt:'yyyy年M月d日',		// 日期格式
			//vel:'d244_2',					// 將實際可進資料庫的值填到d244_2元素內
			//eCont: 'div1',				// 直接顯示於元素內(使用ID, 例<div id="div1"></div>)
			//disabledDays: [0, 6],			// 禁用該星期(週日, 週六)
			//disabledDates: ['^.*-.*-1.*'],	// 禁用該日期(以正則表達式匹配用法)
			//opposite: false,				// 默認為false, 為true時,無效天和無效日期變​​成有效天和有效日期
			//lang: 'zh-tw',				// 多國語言(zh-tw：繁體中文, en：英文, zh-cn：簡體中文)
			onpicked: function () {			// 返回日期時自定義事件
			},
		});
	});	
}