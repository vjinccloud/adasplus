/**
 * @version 18.0528.01
 * @author Jerry Su
 * 
 * 更新項目
 * 		未知			新增 fillField() 將資料填入表格欄位中
 * 		2013-11-23	新增substitute(str, obj)函數(正則式方式插入字串, 類似srpintf())
 * 		2015-12-26	更名為class-comm.js
 * 								移除topmenu控制項
 * 								增加classDate類別, 並新增日曆初使化
 * 		2015-12-27	增加classComm類別, 並新增sprintf(), 
 * 								增加classDate.date()
 * 								增加classDate的變數today(現在日期及時間)
 * 		2016-10-29	新增fmoney函式，數字千分位的處理
 * 		2017-01-26	增加img類別, 新增「上傳圖片預覽」功能
 * 		2017-10-15	增加text類別，新增加「文字變大寫」(toUpperCase)到該類別中
 * 		2017-10-17	修正圖片類別中上傳圖片時的圖片預覽參數, 第二參數可使用物件(object)或原CSS classname
 * 		2017-12-20	新增外部連結到錨點時，因圖片而造成定位錯誤問題 (延遲錨點滾動)
 * 		2018-05-28	修正classImg.preview()中, 抓取preview圖檔位置方式, 由children()改為find()
 */
$().ready(function(){

});

/**
 * 常用類別
 */
var classComm = function () {
	
}

classComm.prototype = {
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
		 * 	var str = '<a href="{url}" title="{title}">{text}</a>';
		 * 	substitute(str, obj);
		 * 
		 * @param str
		 * @param obj
		 * @returns
		 */
		substitute: function (str, obj)  {
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
		},
		/**
		 * discuss at: http://phpjs.org/functions/sprintf/
		 * original by: Ash Searle (http://hexmen.com/blog/)
		 * improved by: Michael White (http://getsprink.com)
		 * improved by: Jack
		 * improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
		 * improved by: Dj
		 * improved by: Allidylls
		 * input by: Paulo Freitas
		 * input by: Brett Zamir (http://brett-zamir.me)
		 * example 1: sprintf("%01.2f", 123.1);
		 * returns 1: 123.10
		 * example 2: sprintf("[%10s]", 'monkey');
		 * returns 2: '[    monkey]'
		 * example 3: sprintf("[%'#10s]", 'monkey');
		 * returns 3: '[####monkey]'
		 * example 4: sprintf("%d", 123456789012345);
		 * returns 4: '123456789012345'
		 * example 5: sprintf('%-03s', 'E');
		 * returns 5: 'E00'
		 */
		sprintf: function () {
			var regex = /%%|%(\d+\$)?([-+\'#0 ]*)(\*\d+\$|\*|\d+)?(\.(\*\d+\$|\*|\d+))?([scboxXuideEfFgG])/g;
			var a = arguments;
			var i = 0;
			var format = a[i++];

			// pad()
			var pad = function(str, len, chr, leftJustify) {
				if (!chr) {
					chr = ' ';
				}
				var padding = (str.length >= len) ? '' : new Array( 1 + len - str.length >>> 0).join(chr);
				return leftJustify ? str + padding : padding + str;
			};

			// justify()
			var justify = function(value, prefix, leftJustify, minWidth, zeroPad, customPadChar) {
				var diff = minWidth - value.length;
				if (diff > 0) {
					if (leftJustify || !zeroPad) {
						value = pad(value, minWidth, customPadChar, leftJustify);
					} else {
						value = value.slice(0, prefix.length) + pad('', diff, '0', true) + value.slice(prefix.length);
					}
				}
				return value;
			};

			// formatBaseX()
			var formatBaseX = function(value, base, prefix, leftJustify, minWidth, precision, zeroPad) {
				// Note: casts negative numbers to positive ones
				var number = value >>> 0;
				prefix = prefix && number && {
					'2' : '0b',
					'8' : '0',
					'16' : '0x'
				}[base] || '';
				value = prefix + pad(number.toString(base), precision || 0, '0', false);
				return justify(value, prefix, leftJustify, minWidth, zeroPad);
			};

			// formatString()
			var formatString = function(value, leftJustify, minWidth, precision, zeroPad, customPadChar) {
				if (precision != null) {
					value = value.slice(0, precision);
				}
				return justify(value, '', leftJustify, minWidth, zeroPad, customPadChar);
			};

			// doFormat()
			var doFormat = function(substring, valueIndex, flags, minWidth, _, precision, type) {
				var number, prefix, method, textTransform, value;

				if (substring === '%%') {
					return '%';
				}

				// parse flags
				var leftJustify = false;
				var positivePrefix = '';
				var zeroPad = false;
				var prefixBaseX = false;
				var customPadChar = ' ';
				var flagsl = flags.length;
				for (var j = 0; flags && j < flagsl; j++) {
					switch (flags.charAt(j)) {
						case ' ':
							positivePrefix = ' ';
							break;
						case '+':
							positivePrefix = '+';
							break;
						case '-':
							leftJustify = true;
							break;
						case "'":
							customPadChar = flags.charAt(j + 1);
							break;
						case '0':
							zeroPad = true;
							customPadChar = '0';
							break;
						case '#':
							prefixBaseX = true;
							break;
					}
				}

				// parameters may be null, undefined, empty-string or real valued
				// we want to ignore null, undefined and empty-string values
				if (!minWidth) {
					minWidth = 0;
				} else if (minWidth === '*') {
					minWidth = +a[i++];
				} else if (minWidth.charAt(0) == '*') {
					minWidth = +a[minWidth.slice(1, -1)];
				} else {
					minWidth = +minWidth;
				}

				// Note: undocumented perl feature:
				if (minWidth < 0) {
					minWidth = -minWidth;
					leftJustify = true;
				}

				if (!isFinite(minWidth)) {
					throw new Error('sprintf: (minimum-)width must be finite');
				}

				if (!precision) {
					precision = 'fFeE'.indexOf(type) > -1 ? 6 : (type === 'd') ? 0
							: undefined;
				} else if (precision === '*') {
					precision = +a[i++];
				} else if (precision.charAt(0) == '*') {
					precision = +a[precision.slice(1, -1)];
				} else {
					precision = +precision;
				}

				// grab value using valueIndex if required?
				value = valueIndex ? a[valueIndex.slice(0, -1)] : a[i++];

				switch (type) {
					case 's':
						return formatString(String(value), leftJustify, minWidth, precision, zeroPad, customPadChar);
					case 'c':
						return formatString(String.fromCharCode(+value), leftJustify, minWidth, precision, zeroPad);
					case 'b':
						return formatBaseX(value, 2, prefixBaseX, leftJustify, minWidth, precision, zeroPad);
					case 'o':
						return formatBaseX(value, 8, prefixBaseX, leftJustify, minWidth, precision, zeroPad);
					case 'x':
						return formatBaseX(value, 16, prefixBaseX, leftJustify, minWidth, precision, zeroPad);
					case 'X':
						return formatBaseX(value, 16, prefixBaseX, leftJustify, minWidth, precision, zeroPad).toUpperCase();
					case 'u':
						return formatBaseX(value, 10, prefixBaseX, leftJustify, minWidth, precision, zeroPad);
					case 'i':
					case 'd':
						number = +value || 0;
						number = Math.round(number - number % 1); // Plain Math.round
						// doesn't just truncate
						prefix = number < 0 ? '-' : positivePrefix;
						value = prefix + pad(String(Math.abs(number)), precision, '0', false);
						return justify(value, prefix, leftJustify, minWidth, zeroPad);
					case 'e':
					case 'E':
					case 'f': // Should handle locales (as per setlocale)
					case 'F':
					case 'g':
					case 'G':
						number = +value;
						prefix = number < 0 ? '-' : positivePrefix;
						method = [ 'toExponential', 'toFixed', 'toPrecision' ]['efg'
								.indexOf(type.toLowerCase())];
						textTransform = [ 'toString', 'toUpperCase' ]['eEfFgG'.indexOf(type) % 2];
						value = prefix + Math.abs(number)[method](precision);
						return justify(value, prefix, leftJustify, minWidth, zeroPad)[textTransform]
								();
					default:
						return substring;
				}
			};

			return format.replace(regex, doFormat);
		},
		/**
		 * 處理因圖片或其它元件加載網頁時所造成的錨點定位異常的問題
		 */
		moveToHash: function() {
			var urlHash = window.location.hash;
			if(urlHash) {
				//window.location.hash = '';
				window.location.hash = urlHash;
			}
		}
}

/**
 * 時間類別
 */
var classDatetime = function () {
	this.oToday = new Date();
	
	oComm = new classComm();
	todays = {
			y : this.oToday.getFullYear(),
			m: this.oToday.getMonth()+1,
			d: this.oToday.getDate(),
			h: this.oToday.getHours(),
			i: this.oToday.getMinutes(),
			s: this.oToday.getSeconds()
	}

	this.today = oComm.sprintf("%04d-%02d-%02d", todays.y, todays.m, todays.d);
	this.nowTime = oComm.sprintf("%04d-%02d-%02d %02d:%02d:%02d", todays.y, todays.m, todays.d, todays.h, todays.i, todays.s);
}

classDatetime.prototype = {
		/**
		 * 日曆初使化, 請引入 /js/My97DatePicker/WdatePicker.js
		 * inputObjStr	對像物件
		 * startDate		設定日期
		 */
		initCalendar : function (inputObjStr, startDate, dateFmt) {
			var inputObjStr = inputObjStr || "form input.inputDate";
			var startDate = startDate || '%yyyy-%MM-%dd %HH:%mm:%ss';
			var dateFmt = dateFmt || 'yyyy-MM-dd HH:mm:ss';
			
			$(inputObjStr).on('click', null, function () {
				WdatePicker({
					isShowWeek: true,				// 顯示月曆週期(false)
					//readOnly: true,				// 限制輸入框只能用點選的方式(false)
					//highLineWeekDay: true,		// 區隔平日、假日(true)
					//isShowClear: false,			// 顯示清空按鈕(true)
					//position: {left:100,top:50},	// 調整顯示位置
					//minDate: '2006-09-10',		// 日期範圍：最小日期(日期格式必須與realDateFmt 和realTimeFmt 一致)
					//maxDate: '2008-12-20',		// 日期範圍：最大日期(日期格式必須與realDateFmt 和realTimeFmt 一致)
					startDate: startDate,		// 預設選取日期(可使用動態參數：%y-%M-01 00:00:00)
					//alwaysUseStartDate: true,		// 無論日期框的值為何, 皆以startDate為預選日期
					dateFmt: dateFmt,		// 日期格式
					//vel:'d244_2',					// 將實際可進資料庫的值填到d244_2元素內
					//eCont: 'div1',				// 直接顯示於元素內(使用ID, 例<div id="div1"></div>)
					//disabledDays: [0, 6],			// 禁用該星期(週日, 週六)
					//disabledDates: ['^.*-.*-1.*'],	// 禁用該日期(以正則表達式匹配用法)
					//opposite: false,				// 默認為false, 為true時,無效天和無效日期變​​成有效天和有效日期
					//lang: 'zh-tw',				// 多國語言(zh-tw：繁體中文, en：英文, zh-cn：簡體中文)
					/*
					日期格式表 格式 說明 
					y 將年份表示爲最多兩位數字。如果年份多于兩位數，則結果中僅顯示兩位低位數。 
					yy  同上，如果小于兩位數，前面補零。 
					yyy 將年份表示爲三位數字。如果少于三位數，前面補零。 
					yyyy 將年份表示爲四位數字。如果少于四位數，前面補零。 
					M 將月份表示爲從 1 至 12 的數字 
					MM 同上，如果小于兩位數，前面補零。 
					MMM 返回月份的縮寫 一月 至 十二月 (英文狀態下 Jan to Dec) 。 
					MMMM 返回月份的全稱 一月 至 十二月 (英文狀態下 January to December) 。 
					d 將月中日期表示爲從 1 至 31 的數字。 
					dd 同上，如果小于兩位數，前面補零。 
					H  將小時表示爲從 0 至 23 的數字。 
					HH 同上，如果小于兩位數，前面補零。 
					m 將分鍾表示爲從 0 至 59 的數字。 
					mm 同上，如果小于兩位數，前面補零。 
					s 將秒表示爲從 0 至 59 的數字。 
					ss 同上，如果小于兩位數，前面補零。 
					w 返回星期對應的數字 0 (星期天) - 6 (星期六) 。 
					D 返回星期的縮寫 一 至 六 (英文狀態下 Sun to Sat) 。 
					DD 返回星期的全稱 星期一 至 星期六 (英文狀態下 Sunday to Saturday) 。 
					W 返回周對應的數字 (1 - 53) 。 
					WW 同上，如果小于兩位數，前面補零 (01 - 53) 。
					 */
					onpicked: function () {			// 返回日期時自定義事件
						
					},
				});
			});		
		},
		/**
		 * discuss at: http://phpjs.org/functions/date/
		 * original by: Carlos R. L. Rodrigues (http://www.jsfromhell.com)
		 * original by: gettimeofday
		 * parts by: Peter-Paul Koch (http://www.quirksmode.org/js/beat.html)
		 * improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
		 * improved by: MeEtc (http://yass.meetcweb.com)
		 * improved by: Brad Touesnard
		 * improved by: Tim Wiel
		 * improved by: Bryan Elliott
		 * improved by: David Randall
		 * improved by: Theriault
		 * improved by: Brett Zamir (http://brett-zamir.me)
		 * improved by: Thomas Beaucourt (http://www.webapp.fr)
		 * improved by: JT
		 * improved by: Rafał Kukawski (http://blog.kukawski.pl)
		 * input by: Brett Zamir (http://brett-zamir.me)
		 * input by: majak
		 * input by: Alex
		 * input by: Martin
		 * input by: Alex Wilson
		 * input by: Haravikk
		 * bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
		 * bugfixed by: majak
		 * bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
		 * bugfixed by: Brett Zamir (http://brett-zamir.me)
		 * bugfixed by: omid (http://phpjs.org/functions/380:380#comment_137122)
		 * bugfixed by: Chris (http://www.devotis.nl/)
		 * note: Uses global: php_js to store the default timezone
		 * note: Although the function potentially allows timezone info (see notes), it currently does not set
		 * note: per a timezone specified by date_default_timezone_set(). Implementers might use
		 * note: this.php_js.currentTimezoneOffset and this.php_js.currentTimezoneDST set by that function
		 * note: in order to adjust the dates in this function (or our other date functions!) accordingly
		 * example 1: date('H:m:s \\m \\i\\s \\m\\o\\n\\t\\h', 1062402400);
		 * returns 1: '09:09:40 m is month'
		 * example 2: date('F j, Y, g:i a', 1062462400);
		 * returns 2: 'September 2, 2003, 2:26 am'
		 * example 3: date('Y W o', 1062462400);
		 * returns 3: '2003 36 2003'
		 * example 4: x = date('Y m d', (new Date()).getTime()/1000);
		 * example 4: (x+'').length == 10 // 2009 01 09
		 * returns 4: true
		 * example 5: date('W', 1104534000);
		 * returns 5: '53'
		 * example 6: date('B t', 1104534000);
		 * returns 6: '999 31'
		 * example 7: date('W U', 1293750000.82); // 2010-12-31
		 * returns 7: '52 1293750000'
		 * example 8: date('W', 1293836400); // 2011-01-01
		 * returns 8: '52'
		 * example 9: date('W Y-m-d', 1293974054); // 2011-01-02
		 * returns 9: '52 2011-01-02'
		 * @param format
		 * @param timestamp
		 * @returns
		 */
		date: function (format, timestamp) {
			  var that = this;
			  var jsdate, f;
			  // Keep this here (works, but for code commented-out below for file size reasons)
			  // var tal= [];
			  var txt_words = [
			    'Sun', 'Mon', 'Tues', 'Wednes', 'Thurs', 'Fri', 'Satur',
			    'January', 'February', 'March', 'April', 'May', 'June',
			    'July', 'August', 'September', 'October', 'November', 'December'
			  ];
			  // trailing backslash -> (dropped)
			  // a backslash followed by any character (including backslash) -> the character
			  // empty string -> empty string
			  var formatChr = /\\?(.?)/gi;
			  var formatChrCb = function(t, s) {
			    return f[t] ? f[t]() : s;
			  };
			  var _pad = function(n, c) {
			    n = String(n);
			    while (n.length < c) {
			      n = '0' + n;
			    }
			    return n;
			  };
			  f = {
			    // Day
			    d: function() { // Day of month w/leading 0; 01..31
			      return _pad(f.j(), 2);
			    },
			    D: function() { // Shorthand day name; Mon...Sun
			      return f.l()
			        .slice(0, 3);
			    },
			    j: function() { // Day of month; 1..31
			      return jsdate.getDate();
			    },
			    l: function() { // Full day name; Monday...Sunday
			      return txt_words[f.w()] + 'day';
			    },
			    N: function() { // ISO-8601 day of week; 1[Mon]..7[Sun]
			      return f.w() || 7;
			    },
			    S: function() { // Ordinal suffix for day of month; st, nd, rd, th
			      var j = f.j();
			      var i = j % 10;
			      if (i <= 3 && parseInt((j % 100) / 10, 10) == 1) {
			        i = 0;
			      }
			      return ['st', 'nd', 'rd'][i - 1] || 'th';
			    },
			    w: function() { // Day of week; 0[Sun]..6[Sat]
			      return jsdate.getDay();
			    },
			    z: function() { // Day of year; 0..365
			      var a = new Date(f.Y(), f.n() - 1, f.j());
			      var b = new Date(f.Y(), 0, 1);
			      return Math.round((a - b) / 864e5);
			    },

			    // Week
			    W: function() { // ISO-8601 week number
			      var a = new Date(f.Y(), f.n() - 1, f.j() - f.N() + 3);
			      var b = new Date(a.getFullYear(), 0, 4);
			      return _pad(1 + Math.round((a - b) / 864e5 / 7), 2);
			    },

			    // Month
			    F: function() { // Full month name; January...December
			      return txt_words[6 + f.n()];
			    },
			    m: function() { // Month w/leading 0; 01...12
			      return _pad(f.n(), 2);
			    },
			    M: function() { // Shorthand month name; Jan...Dec
			      return f.F()
			        .slice(0, 3);
			    },
			    n: function() { // Month; 1...12
			      return jsdate.getMonth() + 1;
			    },
			    t: function() { // Days in month; 28...31
			      return (new Date(f.Y(), f.n(), 0))
			        .getDate();
			    },

			    // Year
			    L: function() { // Is leap year?; 0 or 1
			      var j = f.Y();
			      return j % 4 === 0 & j % 100 !== 0 | j % 400 === 0;
			    },
			    o: function() { // ISO-8601 year
			      var n = f.n();
			      var W = f.W();
			      var Y = f.Y();
			      return Y + (n === 12 && W < 9 ? 1 : n === 1 && W > 9 ? -1 : 0);
			    },
			    Y: function() { // Full year; e.g. 1980...2010
			      return jsdate.getFullYear();
			    },
			    y: function() { // Last two digits of year; 00...99
			      return f.Y()
			        .toString()
			        .slice(-2);
			    },

			    // Time
			    a: function() { // am or pm
			      return jsdate.getHours() > 11 ? 'pm' : 'am';
			    },
			    A: function() { // AM or PM
			      return f.a()
			        .toUpperCase();
			    },
			    B: function() { // Swatch Internet time; 000..999
			      var H = jsdate.getUTCHours() * 36e2;
			      // Hours
			      var i = jsdate.getUTCMinutes() * 60;
			      // Minutes
			      var s = jsdate.getUTCSeconds(); // Seconds
			      return _pad(Math.floor((H + i + s + 36e2) / 86.4) % 1e3, 3);
			    },
			    g: function() { // 12-Hours; 1..12
			      return f.G() % 12 || 12;
			    },
			    G: function() { // 24-Hours; 0..23
			      return jsdate.getHours();
			    },
			    h: function() { // 12-Hours w/leading 0; 01..12
			      return _pad(f.g(), 2);
			    },
			    H: function() { // 24-Hours w/leading 0; 00..23
			      return _pad(f.G(), 2);
			    },
			    i: function() { // Minutes w/leading 0; 00..59
			      return _pad(jsdate.getMinutes(), 2);
			    },
			    s: function() { // Seconds w/leading 0; 00..59
			      return _pad(jsdate.getSeconds(), 2);
			    },
			    u: function() { // Microseconds; 000000-999000
			      return _pad(jsdate.getMilliseconds() * 1000, 6);
			    },

			    // Timezone
			    e: function() { // Timezone identifier; e.g. Atlantic/Azores, ...
			      // The following works, but requires inclusion of the very large
			      // timezone_abbreviations_list() function.
			      /*              return that.date_default_timezone_get();
			       */
			      throw 'Not supported (see source code of date() for timezone on how to add support)';
			    },
			    I: function() { // DST observed?; 0 or 1
			      // Compares Jan 1 minus Jan 1 UTC to Jul 1 minus Jul 1 UTC.
			      // If they are not equal, then DST is observed.
			      var a = new Date(f.Y(), 0);
			      // Jan 1
			      var c = Date.UTC(f.Y(), 0);
			      // Jan 1 UTC
			      var b = new Date(f.Y(), 6);
			      // Jul 1
			      var d = Date.UTC(f.Y(), 6); // Jul 1 UTC
			      return ((a - c) !== (b - d)) ? 1 : 0;
			    },
			    O: function() { // Difference to GMT in hour format; e.g. +0200
			      var tzo = jsdate.getTimezoneOffset();
			      var a = Math.abs(tzo);
			      return (tzo > 0 ? '-' : '+') + _pad(Math.floor(a / 60) * 100 + a % 60, 4);
			    },
			    P: function() { // Difference to GMT w/colon; e.g. +02:00
			      var O = f.O();
			      return (O.substr(0, 3) + ':' + O.substr(3, 2));
			    },
			    T: function() { // Timezone abbreviation; e.g. EST, MDT, ...
			      // The following works, but requires inclusion of the very
			      // large timezone_abbreviations_list() function.
			      /*              var abbr, i, os, _default;
			      if (!tal.length) {
			        tal = that.timezone_abbreviations_list();
			      }
			      if (that.php_js && that.php_js.default_timezone) {
			        _default = that.php_js.default_timezone;
			        for (abbr in tal) {
			          for (i = 0; i < tal[abbr].length; i++) {
			            if (tal[abbr][i].timezone_id === _default) {
			              return abbr.toUpperCase();
			            }
			          }
			        }
			      }
			      for (abbr in tal) {
			        for (i = 0; i < tal[abbr].length; i++) {
			          os = -jsdate.getTimezoneOffset() * 60;
			          if (tal[abbr][i].offset === os) {
			            return abbr.toUpperCase();
			          }
			        }
			      }
			      */
			      return 'UTC';
			    },
			    Z: function() { // Timezone offset in seconds (-43200...50400)
			      return -jsdate.getTimezoneOffset() * 60;
			    },

			    // Full Date/Time
			    c: function() { // ISO-8601 date.
			      return 'Y-m-d\\TH:i:sP'.replace(formatChr, formatChrCb);
			    },
			    r: function() { // RFC 2822
			      return 'D, d M Y H:i:s O'.replace(formatChr, formatChrCb);
			    },
			    U: function() { // Seconds since UNIX epoch
			      return jsdate / 1000 | 0;
			    }
			  };
			  this.date = function(format, timestamp) {
			    that = this;
			    jsdate = (timestamp === undefined ? new Date() : // Not provided
			      (timestamp instanceof Date) ? new Date(timestamp) : // JS Date()
			      new Date(timestamp * 1000) // UNIX timestamp (auto-convert to int)
			    );
			    return format.replace(formatChr, formatChrCb);
			  };
			  return this.date(format, timestamp);
			}
}

/**
 * 取得Cookie值
 * @param c_name
 * @returns
 */
function getCookie(c_name) {
	if (document.cookie.length > 0) {
		c_start = document.cookie.indexOf(c_name + "=")
		if (c_start != -1) {
			c_start = c_start + c_name.length + 1
			c_end = document.cookie.indexOf(";", c_start)
			if (c_end == -1)
				c_end = document.cookie.length
			return unescape(document.cookie.substring(c_start, c_end))
		}
	}
	return ""
}

/**
 * 將編輯的資料填回表格欄位中
 * @param formName	表格名稱
 * @param info		資料(JSON)
 */
function fillField(formName, info) {
	var formObj = $("#displayPad form[name="+formName+"]");
	$("#displayPad form[name="+formName+"] input").each(function (fieldIndex, fieldValue) {
		if (typeof($(fieldValue).attr('name')) == 'undefined') {
			return true;
		} else {
			var elmName = $(fieldValue).attr('name').replace(/\[]/g,'');
			if (typeof(info[elmName]) == 'undefined' || info[elmName] == null)
				return true;
			if (info[elmName].length <= 0)
				return true;
		}
		
		switch ($(fieldValue).attr('type')) {
			case 'text':
			case 'hidden':
				if ($(fieldValue).attr('name').search(/\[]/g) > 1) {
					var s=$(fieldValue).attr('name').replace(/\[]/g,'');
					
					$(fieldValue).each(function (i, v) {
						$(v).val(info[s]);
					});
				} else {
					$(fieldValue).val(info[$(fieldValue).attr('name')]);
				}
				break;
				
//			case 'textarea':
//				$(fieldValue).html(info[$(fieldValue).attr('name')]);
//				break;
				
			case 'radio':
			case 'checkbox':
				if ($(fieldValue).attr('name').search(/\[]/g) > 1) {
					$(fiveldValue).each(function (i, v) {
						var s=$(fieldValue).attr('name').replace(/\[]/g,'');
						if ((info[s]) && ($.inArray(v.value, info[s]) != -1)) {
							$(v).attr('checked', 'checked');
						}
					});
				} else {
					$(fieldValue).each(function () {
                		if ($(this).val() == info[$(fieldValue).attr('name')]) {
							$(this).attr('checked', 'checked');
						}
              		});
				}
				break;
				
			case 'file':
				$(fieldValue).prev().attr('href', info['filePath']+'/'+info[$(fieldValue).attr('name')]);
				break;
		}
	});
	
	fieldName = '';
	$("#displayPad form[name="+formName+"] select").each(function (fieldIndex, fieldValue) {
		if (typeof($(fieldValue).attr('name')) == 'undefined') {
			return true;
		} else {
			elmName = $(fieldValue).attr('name').replace(/\[]/g,'');
			if (typeof(info[elmName]) == 'undefined' || info[elmName] == null)
				return true;
			if (info[elmName].length <= 0)
				return true;
		}
		
		if (fieldName == $(fieldValue).attr('name')) {
			j++;
		} else {
			j=0;
		}
		
		if ($(fieldValue).attr('name').search(/\[]/g) > 1) {
			$($(fieldValue)).find("option[value="+info[$(fieldValue).attr('name')][j]+"]").attr('selected', 'selected');
			fieldName = $(fieldValue).attr('name');
		} else {
			$(fieldValue).find("option[value="+info[$(fieldValue).attr('name')]+"]").attr('selected', 'selected');
		}
		
	});
	
	$("#displayPad form[name='"+formName+"'] textarea").each(function (fieldIndex, fieldValue) {
		// $(fieldValue).html(info[$(fieldValue).attr('name')]);
		// 配合ckeditor的方式, 改用val()的方式寫入資料, 以讓ckeditor可以抓取正確的值(可含HTML碼)
		$(fieldValue).val(info[$(fieldValue).attr('name')]);
	});
}

/**
 * 日曆初始化設定
 * @param inputClass	日期欄位名稱
 * @param dayFormat		日期格式
 */
//function initCalendar(inputLoaction, dayFormat) {
//	inputLoaction = inputLoaction || "#displayPad input.inputDate";
//	dayFormat = dayFormat || "%Y-%m-%d";
//	$(inputLoaction).each(function () {
//		inputName = $(this).attr("name");
//		$(this).after('<img name="'+inputName+'_buttion" id="'+inputName+'_buttion" class="calendarButton" src="/images/calendar.png" style="cursor:pointer; margin-left:4px; vertical-align:middle;" />');
//		$(this).attr("id", inputName).css('width', '80px');
//		Calendar.setup({
//			inputField  : inputName,			// ID of the input field (要存日期的欄位ID名稱)
//			ifFormat    : dayFormat,			// the date format (日期格式)
//			button      : inputName+"_buttion"	// ID of the button (觸發的按鈕)
//		});
//		
//	});
//}

/**
 * 區塊展開及收合
 */
function expansion(el) {
	el = el || "img.expansion";
	$(el).bind("click", function (){
		var objDisplay = $(this).parent().next("div").css("display");
		if (objDisplay == "none") {
			$(this).parent().next("div").css("display", "");
			$(this).attr("src", "/images/icons/001_28.png");
		} else {
			$(this).parent().next("div").css("display", "none");
			$(this).attr("src", "/images/icons/001_26.png");
		}
	});
}

/**
 * 取得今日日期
 * @returns
 */
function getToday() {
	var oDate = new Date(); 
	var str = '{year}-{month}-{day}';
	var obj = {
			year: oDate.getFullYear(),
			month: oDate.getMonth()+1,
			day: oDate.getDate()
	};
	
	return substitute(str, obj)
}

/**
 * 數字千分位處理
 * 應用的輸入框可考慮使用onblur的方法觸發
 * @param s	數值
 * @param n	小數位數
 * @returns {String}
 */
function fmoney(s, n) {
	var Dev = "";
	
	n = n > 0 && n <= 20 ? n : 2;
	s = parseFloat((s + "").replace(/[^\d\.-]/g, "")).toFixed(n) + "";
	if (eval(s*1)<0) {
		s = s.replace(/^-/, '');
		Dev = "-" ;
	}

	var l = s.split(".")[0].split("").reverse(), r = s.split(".")[1];
	t = "";
	for (i = 0; i < l.length; i++) {
		t += l[i] + ((i + 1) % 3 == 0 && (i + 1) != l.length ? "," : "");
	}
	return Dev + t.split("").reverse().join("") + "." + r;
}


/**
 * 圖片類別
 */
var classImg = function () {
	
}
classImg.prototype = {
		format_float: function (num, pos) {
			var size = Math.pow(10, pos);
			return Math.round(num * size) / size;
		},
		/**
		 * 上傳圖片預覽
		 * @param inputObj			上傳按鈕
		 * @param previewPlace	預覽圖置放點
		 * @example 
		 * 		oImg = new classImg();
		 * 		$.on("change", ".upl", function () {
		 * 			oImg.preview(this, '.preview');
		 * 		});
		 */
		preview: function (inputObject, previewPlace) {
			_this  = this; 
			
			if (inputObject.files && inputObject.files[0]) {
				var reader = new FileReader();

				reader.onload = function (e) {
					if (typeof(previewPlace) == 'object') {
						$(previewPlace).attr('src', e.target.result);
					} else {
						//$(inputObject).next(previewPlace).attr('src', e.target.result);
						//$(inputObject).parent().children(previewPlace).attr('src', e.target.result);
						$(inputObject).parent().find(previewPlace).attr('src', e.target.result);
					}
					
					var KB = _this.format_float(e.total / 1024, 2);
					$('.size').text("檔案大小：" + KB + " KB");
				}

				reader.readAsDataURL(inputObject.files[0]);
			}
		}
}

var classText = function () {
	
}
classText.prototype = {
		toUpperCase: function (text) {
			return text.toUpperCase();
		}
}