/****
JS for homepage slider
****/

function is_touch_device() {
  return 'ontouchstart' in window        // works on most browsers
      || 'onmsgesturechange' in window;  // works on IE10 with some false positives
}

jQuery(document).ready(function($) {
  if(is_touch_device()) {
    $('.main-navigation ul ul').hide();
  }
  var currentIndex = 0,
		prevIndex = 0,
    items = $('#hero-list li'),
    pagers = $('#hero-pager a'),
    itemAmt = items.length;
    currentItem = items.eq(currentIndex);

  function cycleItems() {
    var item = $('#hero-list li').eq(currentIndex);
    var pager = item.find('#hero-pager a').eq(currentIndex);
    items.removeClass('current-hero');
    pagers.removeClass('current-pager');

    item.addClass('current-hero');
    pager.addClass('current-pager');
  }
  
  if(items.length > 0) {
    cycleItems();
    detectswipe('hero-list');
  }
	$('#hero-list li').eq(0).addClass('current-hero');
  pagers = $('.current-hero').find('#hero-pager a');
  var pager_order = [];
    pagers.each(function(){
      var pager_id = $(this).attr('node-id');
      pager_order.push(pager_id);
    });

  $('#hero-pager a').each(function(){
    $(this).click(function(el){
      var match_id = $(this).attr('node-id');
			prevIndex = currentIndex;
      currentIndex = pager_order.indexOf(match_id);
      cycleItems();
      return false;
    });
  });

  $('.next').click(function(e) {
    e.preventDefault();
    prevIndex = currentIndex;
    currentIndex++;
    if (currentIndex > itemAmt - 1) {
        currentIndex = 0;
    }
    cycleItems();
  });

  $('.prev').click(function(e) {
    e.preventDefault();
    prevIndex = currentIndex;
    currentIndex--;
    if (currentIndex < 0) {
        currentIndex = itemAmt - 1;
    }
    cycleItems();
  });

function detectswipe(el) {
  swipe_det = new Object();
  swipe_det.sX = 0;
  swipe_det.sY = 0;
  swipe_det.eX = 0;
  swipe_det.eY = 0;
  var min_x = 20;  //min x swipe for horizontal swipe
  var max_x = 40;  //max x difference for vertical swipe
  var min_y = 40;  //min y swipe for vertical swipe
  var max_y = 50;  //max y difference for horizontal swipe
  var direc = "";
  ele = document.getElementById(el);
  ele.addEventListener('touchstart',function(e) {
    var t = e.touches[0];
    swipe_det.sX = t.screenX;
    swipe_det.sY = t.screenY;
  },false);
  ele.addEventListener('touchmove',function(e) {
    var t = e.touches[0];
    swipe_det.eX = t.screenX;
    swipe_det.eY = t.screenY;
  },false);
  ele.addEventListener('touchend',function(e) {
    //horizontal detection
    if ((((swipe_det.eX - min_x > swipe_det.sX) || (swipe_det.eX + min_x < swipe_det.sX)) && ((swipe_det.eY < swipe_det.sY + max_y) && (swipe_det.sY > swipe_det.eY - max_y)))) {
      e.preventDefault();
      if(swipe_det.eX > swipe_det.sX) {
        $('.current-hero .prev').click();
      }
      else {
        $('.current-hero .next').click();
      }
    }

    direc = "";
    //empty object so it doesn't keep track of last threshold.
    swipe_det = {};
  },false);
}

$('.comments-link-gray a').click(function() {
  $('#comments').toggleClass('comments-toggle');
});
if(window.location.href.indexOf("#comments") >= 0 || window.location.href.indexOf("#respond") >= 0 ) {
  $('#comments').toggleClass('comments-toggle');
}

});
