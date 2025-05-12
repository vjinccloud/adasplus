CKEDITOR.editorConfig = function( config ) {
	// 中文支援
	config.language = 'zh';
	// 改變顏色 我很少會改，灰灰的還滿好看的
	// config.uiColor = '#AADC6E';

	// 把不常用的工具拿掉
	config.toolbar= [
		['Source','-','Cut','Copy','Paste','PasteText','PasteFromWord','-'],
		['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat','Maximize','ShowBlocks'],
		['Link','Unlink','Anchor'],
		['Table','HorizontalRule','SpecialChar','Format'],
		'/',
		['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
		['NumberedList','BulletedList','-','Outdent','Indent'],
		['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
		['TextColor','BGColor'],
		['FontSize', 'Styles','Font']
	];

	// 基本款也改一下
	config.toolbar_Basic = [
	    [ 'Source', '-', 'Bold', 'Italic','Underline','Strike','TextColor', '-', 'Link','Unlink','RemoveFormat' ]
	];
	
	
	// 避免 CKEditor 自作主張轉換你的原始碼
	config.allowedContent=true;
	//config.protectedSource.push( /<h3>[\s\S]*<\/h3>/g );  
	
	// 載入前台的 CSS 樣式檔
	//config.contentsCss = ['/css/style.css', '/css/mobile.css', '/css/bootstrap.min.css', '/css/sidebar.css'];
	//config.contentsCss = ['/css/style.css', '/css/ext-css.css'];
	//config.contentsCss = ['/css/main.css'];
	config.contentsCss = [];
	//config.contentsCss = ['/css/main.css', '/js/yd-plugin/yd-plugin-theme.css'];
	
	// 設定編輯器寬高設定
	// config.width=900;
	config.height=400;
 
	// 設定不能resize TEXTAREA
	resize_enabled = false;

	// 設定 TOOLBAR 一開始是打開的狀態
	config.toolbarStartupExpanded = false;
	
	// 調整字型大小
	// Gooogle Chorme 瀏覽器有「最小字型大小」的限制，預設值為 12，這設定的意思是小於 1~11px 的字型，都會顯示成12px。在 CKEditor 中預設提供的字型大小設定中，很不巧前 5 個幾乎是無用的設定，建議另外再設定過。另外中文有一些地雷 font-size，也應該避免。
	config.fontSize_sizes = '10pt/10pt;13/13px;16/16px;18/18px;20/20px;22/22px;24/24px;36/36px;48/48px;'; 
	
	// 調整字型
	config.font_names = 'Arial;Arial Black;Comic Sans MS;Courier New;Tahoma;Times New Roman;Verdana;新細明體;細明體;標楷體;微軟正黑體';
	
	// 修改調色盤
	 config.colorButton_colors = '000,800000,8B4513,2F4F4F,008080,000080,4B0082,696969,B22222,A52A2A,DAA520,006400,40E0D0,0000CD,800080,808080,F00,FF8C00,FFD700,008000,0FF,00F,EE82EE,A9A9A9,FFA07A,FFA500,FFFF00,00FF00,AFEEEE,ADD8E6,DDA0DD,D3D3D3,FFF0F5,FAEBD7,FFFFE0,F0FFF0,F0FFFF,F0F8FF,E6E6FA,FFF,FF9900,FF6600,FF3300,FF33CC,194ACF,199FCF,006F05,3F3F3F';
	
	// 讓貼上的東西保有雜七雜八的樣式與惡意程式碼。
	// config.pasteFilter = null;
	
	// YouTube插件
	//config.extraPlugins = 'youtube';
	config.extraPlugins = ['colorbutton','font'];
	
	// 不喜歡 使用 <P> 標籤作為一個段落的存在
	// 預設的 斷行 ENTER 是 P 標籤
	// SHIFT+ENTER 是 <br /> 標籤
	// 如果需要將預設的模式修改過來，只要在 editorConfig 內加入下列原始碼
	config.enterMode = CKEDITOR.ENTER_BR;
	config.shiftEnterMode = CKEDITOR.ENTER_P;
	// config.autoParagraph = false;
	};