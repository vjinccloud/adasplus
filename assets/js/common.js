// 返回頂部
function backToTop() {
  $("html, body").animate({ scrollTop: 0 }, "slow");
}

// 展開/收起選單
function menuTurn(_type){
  if(_type == 'open'){
    $('.menu_open').css("display",'none')
    $('.menu_close').css("display",'block')
    $('#header_mobile_menu').removeClass('fadeOutDown')
    $('#header_mobile_menu').addClass('fadeInDown')
    $('#header_mobile_menu').css("display",'block')
    document.documentElement.style.overflowY = 'hidden'
  }
  if(_type == 'close'){
    $('.menu_open').css("display",'block')
    $('.menu_close').css("display",'none')
    $('#header_mobile_menu').removeClass('fadeInDown')
    $('#header_mobile_menu').addClass('fadeOutDown')
    setTimeout(() => {
      $('#header_mobile_menu').css("display",'none')
    }, 500);
    document.documentElement.style.overflowY = 'scroll'
  }
}



$(window).resize((e) => {
  if ( e.currentTarget.innerWidth > 1000) {
    this.menuTurn('close')
  }
})

$(window).scroll((e) => {
  // 返回頂部按鈕顯示判斷
  if ($(document).scrollTop() > 500) {
    $('.top_btn').css("display",'flex')
  }else{
    $('.top_btn').css("display",'none')
  }
})