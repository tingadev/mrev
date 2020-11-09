var isDevice = false;
if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
  isDevice = true;
}
// khong the phong to cua so
function openPopUp(url, windowName, w, h, scrollbar) {
  var winl = (screen.width - w) / 2;
  var wint = (screen.height - h) / 2;
  winprops = 'height=' + h + ',width=' + w + ',top=' + wint + ',left=' + winl + ',scrollbars=' + scrollbar;
  win = window.open(url, windowName, winprops);
  if (parseInt(navigator.appVersion) >= 4) {
    win.window.focus();
  }
}

// co the phong to cua so
function NewWindow(mypage, myname, w, h, scroll, pos) {
  if (pos == "random") {
    LeftPosition = (screen.width) ? Math.floor(Math.random() * (screen.width - w)) : 100;
    TopPosition = (screen.height) ? Math.floor(Math.random() * ((screen.height - h) - 75)) : 100;
  }
  if (pos == "center") {
    LeftPosition = (screen.width) ? (screen.width - w) / 2 : 100;
    TopPosition = (screen.height) ? (screen.height - h) / 2 : 100;
  }
  else if ((pos != "center" && pos != "random") || pos == null) {
    LeftPosition = 0;
    TopPosition = 20
  }
  settings = 'width=' + w + ',height=' + h + ',top=' + TopPosition + ',left=' + LeftPosition + ',scrollbars=' + scroll + ',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=yes';
  win = window.open(mypage, myname, settings);
}

// is_num
function is_num(event, f) {
  if (event.srcElement) {
    kc = event.keyCode;
  } else {
    kc = event.which;
  }
  if ((kc < 47 || kc > 57) && kc != 8 && kc != 0) return false;
  return true;
}

/** advertise
 ******************************************************************/
window.rwt = function (obj, type, id) {
  try {
    if (obj === window) {
      obj = window.event.srcElement;
      while (obj) {
        if (obj.href) break;
        obj = obj.parentNode
      }
    }
    obj.href = ROOT + '?' + cmd + '=mod:advertise|type:' + type + '|lid:' + id;
    obj.onmousedown = ""
  } catch (o) {
  }
  return true;
};

(function (jQuery) {
  jQuery.fn.clickoutside = function (callback) {
    var outside = 1,
      self = $(this);
    self.cb = callback;
    this.click(function () {
      outside = 0
    });
    $(document).click(function (event) {
      if (event.button == 0) {
        outside && self.cb();
        outside = 1
      }
    });
    return $(this)
  }
})(jQuery);

(function ($) {
  $.fn.hoverDelay = function (f, g) {
    var cfg = {
      sensitivity: 7,
      delayOver: 150,
      delayOut: 0
    };
    cfg = $.extend(cfg, g ? {over: f, out: g} : f);
    var cX, cY, pX, pY;

    var track = function (ev) {
      cX = ev.pageX;
      cY = ev.pageY;
    };

    var compare = function (ev, ob) {
      ob.hoverDelay_t = clearTimeout(ob.hoverDelay_t);

      if (( Math.abs(pX - cX) + Math.abs(pY - cY) ) < cfg.sensitivity) {
        $(ob).unbind("mousemove", track);

        ob.hoverDelay_s = 1;
        return cfg.over.apply(ob, [ev]);
      } else {

        pX = cX;
        pY = cY;

        ob.hoverDelay_t = setTimeout(function () {
          compare(ev, ob);
        }, cfg.delayOver);
      }
    };

    var delay = function (ev, ob) {
      ob.hoverDelay_t = clearTimeout(ob.hoverDelay_t);
      ob.hoverDelay_s = 0;
      return cfg.out.apply(ob, [ev]);
    };

    var handleHover = function (e) {
      var ev = jQuery.extend({}, e);
      var ob = this;

      if (ob.hoverDelay_t) {
        ob.hoverDelay_t = clearTimeout(ob.hoverDelay_t);
      }

      // if e.type == "mouseenter"
      if (e.type == "mouseenter") {
        pX = ev.pageX;
        pY = ev.pageY;
        $(ob).bind("mousemove", track);
        if (ob.hoverDelay_s != 1) {
          ob.hoverDelay_t = setTimeout(function () {
            compare(ev, ob);
          }, cfg.delayOver);
        }

        // else e.type == "mouseleave"
      } else {
        // unbind expensive mousemove event
        $(ob).unbind("mousemove", track);
        if (ob.hoverDelay_s == 1) {
          ob.hoverDelay_t = setTimeout(function () {
            delay(ev, ob);
          }, cfg.delayOut);
        }
      }
    };
    return this.bind('mouseenter', handleHover).bind('mouseleave', handleHover);
  };
})(jQuery);


/***********************************************
 vnTRUST Core
 by ThaiSon
 ***********************************************/
var vnTRUST = {};
vnTRUST.is_ff  = function(){ return (/Firefox/).test(navigator.userAgent) };
vnTRUST.is_ie  = function() { return (/MSIE/).test(navigator.userAgent) };
vnTRUST.is_ie6 = function() { return (/MSIE 6/).test(navigator.userAgent) };
vnTRUST.is_ie7 = function() { return (/MSIE 7/).test(navigator.userAgent) };
vnTRUST.is_ie8 = function() { return (/MSIE 8/).test(navigator.userAgent) };
vnTRUST.is_chrome = function(){ return (/Chrome/).test(navigator.userAgent) };
vnTRUST.is_opera = function() { return (/Opera/).test(navigator.userAgent) };
vnTRUST.is_safari = function(){ return (/Safari/).test(navigator.userAgent) };

vnTRUST.util_trim = function(str) {return (/string/).test(typeof str) ? str.replace(/^\s+|\s+$/g, "") : ""};
vnTRUST.util_random = function(a, b) { return Math.floor(Math.random() * (b - a + 1)) + a };
vnTRUST.get_ele = function(id) { return document.getElementById(id) };
vnTRUST.get_uuid = function() { return (new Date().getTime() + Math.random().toString().substring(2))};

vnTRUST.is_phone = function (num) {
  return (/^(01([0-9]{2})|09[0-9])(\d{7})$/i).test(num);
};

vnTRUST.is_email = function (str) {
  return (/^[a-z-_0-9\.]+@[a-z-_=>0-9\.]+\.[a-z]{2,3}$/i).test(vnTRUST.util_trim(str))
};

vnTRUST.numberFormat = function (number, decimals, dec_point, thousands_sep) {
  var n = number, prec = decimals;
  n = !isFinite(+n) ? 0 : +n;
  prec = !isFinite(+prec) ? 0 : Math.abs(prec);
  var sep = (typeof thousands_sep == "undefined") ? '.' : thousands_sep;
  var dec = (typeof dec_point == "undefined") ? ',' : dec_point;
  var s = (prec > 0) ? n.toFixed(prec) : Math.round(n).toFixed(prec); //fix for IE parseFloat(0.55).toFixed(0) = 0;
  var abs = Math.abs(n).toFixed(prec);
  var _, i;
  if (abs >= 1000) {
    _ = abs.split(/\D/);
    i = _[0].length % 3 || 3;
    _[0] = s.slice(0, i + (n < 0)) +
      _[0].slice(i).replace(/(\d{3})/g, sep + '$1');
    s = _.join(dec);
  } else {
    s = s.replace(',', dec);
  }
  return s;
};

vnTRUST.mixMoney = function (myfield) {
  var thousands_sep = ',';
  myfield.value = vnTRUST.numberFormat(parseInt(myfield.value.replace(/,/gi, '')), 0, '', thousands_sep);
};

vnTRUST.format_number = function (num) {
  num = num.toString().replace(/\$|\,/g, '');
  if (isNaN(num))
    num = "0";
  sign = (num == (num = Math.abs(num)));
  num = Math.round(num * 100 + 0.50000000001);
  num = Math.round(num / 100).toString();
  for (var i = 0; i < Math.floor((num.length - (1 + i)) / 3); i++)
    num = num.substring(0, num.length - (4 * i + 3)) + ',' + num.substring(num.length - (4 * i + 3));
  return (((sign) ? '' : '-') + num);
};

vnTRUST.numberOnly = function (myfield, e) {
  var key, keychar;
  if (window.event) {
    key = window.event.keyCode
  }
  else if (e) {
    key = e.which
  }
  else {
    return true
  }
  keychar = String.fromCharCode(key);
  if ((key == null) || (key == 0) || (key == 8) || (key == 9) || (key == 13) || (key == 27)) {
    return true
  }
  else if (("0123456789").indexOf(keychar) > -1) {
    return true
  }
  return false;
};

vnTRUST.base64_encode = function (data) {

  var b64 = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
  var o1, o2, o3, h1, h2, h3, h4, bits, i = 0,
    ac = 0,
    enc = "",
    tmp_arr = [];

  if (!data) {
    return data;
  }

  do { // pack three octets into four hexets
    o1 = data.charCodeAt(i++);
    o2 = data.charCodeAt(i++);
    o3 = data.charCodeAt(i++);

    bits = o1 << 16 | o2 << 8 | o3;

    h1 = bits >> 18 & 0x3f;
    h2 = bits >> 12 & 0x3f;
    h3 = bits >> 6 & 0x3f;
    h4 = bits & 0x3f;

    // use hexets to index into b64, and append result to encoded string
    tmp_arr[ac++] = b64.charAt(h1) + b64.charAt(h2) + b64.charAt(h3) + b64.charAt(h4);
  } while (i < data.length);

  enc = tmp_arr.join('');

  var r = data.length % 3;

  return (r ? enc.slice(0, r - 3) : enc) + '==='.slice(r || 3);

};

vnTRUST.base64_decode = function (data) {

  var b64 = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
  var o1, o2, o3, h1, h2, h3, h4, bits, i = 0,
    ac = 0,
    dec = "",
    tmp_arr = [];

  if (!data) {
    return data;
  }

  data += '';

  do { // unpack four hexets into three octets using index points in b64
    h1 = b64.indexOf(data.charAt(i++));
    h2 = b64.indexOf(data.charAt(i++));
    h3 = b64.indexOf(data.charAt(i++));
    h4 = b64.indexOf(data.charAt(i++));

    bits = h1 << 18 | h2 << 12 | h3 << 6 | h4;

    o1 = bits >> 16 & 0xff;
    o2 = bits >> 8 & 0xff;
    o3 = bits & 0xff;

    if (h3 == 64) {
      tmp_arr[ac++] = String.fromCharCode(o1);
    } else if (h4 == 64) {
      tmp_arr[ac++] = String.fromCharCode(o1, o2);
    } else {
      tmp_arr[ac++] = String.fromCharCode(o1, o2, o3);
    }
  } while (i < data.length);

  dec = tmp_arr.join('');

  return dec;
}

vnTRUST.selectAllText = function (obj) {
  obj.focus();
  obj.select();
};

vnTRUST.auto_scroll = function (anchor) {
  var target = jQuery(anchor);
  target = target.length && target || jQuery('[name=' + anchor.slice(1) + ']');
  if (target.length) {
    var targetOffset = target.offset().top;
    jQuery('html,body').animate({scrollTop: targetOffset}, 1000);
    return false;
  }
  return true;
};

vnTRUST.moveScrollTo = function (ob) {
  if (ob.length) {
    var targetOffset = ob.offset().top;
    jQuery('html,body').animate({scrollTop: targetOffset}, 1000);
    return false;
  }
};

vnTRUST.goTopStart = function () {
  jQuery('body').append('<a href="javascript:void(0)" onclick="jQuery(\'html,body\').animate({scrollTop: 0},1000);" class="go_top" style="display:none"></a>');
  jQuery(window).scroll(function () {
    var top = $(window).scrollTop();
    if (top > 0) {
      jQuery('.go_top').show();
    } else {
      jQuery('.go_top').hide()
    }
  });
};

/** vntTabs
 **************************************************************** **/
vnTRUST.vntTabs = function (obj) {

  $('#' + obj + ' .tab-content').hide();
  $('#' + obj + ' .tab-content:first').show();
  $('#' + obj + ' .tab-nav li a:first').addClass('active');
  $('#' + obj + ' .tab-nav li a').click(function () {
    var $string = $(this).attr("class");
    if ($string != "" && String($string) != "undefined") {
      if ($string.match(/active/gi) != "") {
        //console.log($string.match(/active/gi));
        return false;
      }
    }
    var id_content = $(this).attr("href");
    $('#' + obj + ' .tab-content').hide();
    $(id_content).show();


    $('#' + obj + ' .tab-nav li a').removeClass('active');
    $(this).addClass('active');
    return false;
  });
};


/** ZoomImage
 ******************************************************************/
vnTRUST.ZoomImage = function () {


  $(document).ready(function () {
    var data_count = 0;
    $(".vnt_gallery_zoom img").each(function (e) {
      if (!$(this).parents().hasClass("ck_zoom_list_img")) {
        if ($(this).data("ck-zoom") != 'no') {
          $(this).wrap("<span class='zoom_wrap_img'></span>");
          $(this).attr("data_count", data_count);
          data_count += 1;
        }
      }
    });
    $(".ck_zoom_list_img").each(function () {
      var count = 0;
      $(this).find("img").each(function (e) {
        $(this).attr("data_count", count);
        count += 1;
      });
    });
    $(".vnt_gallery_zoom img").click(function (e) {
      if ($(this).parents().hasClass("zoom_wrap_img")) {
        $('body').append("<div id='vnt_zoom_screen'></div>");
        $('#vnt_zoom_screen').append("<div id='vnt_zoom_slider'></div>");
        $(".vnt_gallery_zoom .zoom_wrap_img img").each(function (e) {
          var data_src = $(this).attr('src');
          var data_desc = $(this).parent().find(".ck_desc_img").html();
          if (!data_desc) {
            data_desc = $(this).attr('alt');
          }
          var data_content = '<div class="item" style="background-image: url(' + data_src + ')"><img src="' + data_src + '" />';
          if (data_desc) {
            data_content += '<div class="i-content">' + data_desc + '</div>';
          }
          data_content += '</div>';
          $('#vnt_zoom_slider').append(data_content);
        });
      } else if ($(this).parents().hasClass("ck_zoom_list_img")) {
        $('body').append("<div id='vnt_zoom_screen'></div>");
        $('#vnt_zoom_screen').append("<div id='vnt_zoom_slider'></div>");

        $(this).parents(".ck_zoom_list_img").find("a").click(function (event) {
          event.preventDefault();
        });

        $(this).parents(".ck_zoom_list_img").find(".ck_zoom_item").each(function (e) {
          var data_src = $(this).data('img');
          if (!data_src) {
            data_src = $(this).find("img").attr('src');
          }
          var data_desc = $(this).find(".ck_desc_img").html();
          if (!data_desc) {
            data_desc = $(this).find("img").attr('alt');
          }
          var data_content = '<div class="item" style="background-image: url(' + data_src + ')"><img src="' + data_src + '" />';
          if (data_desc) {
            data_content += '<div class="i-content">' + data_desc + '</div>';
          }
          data_content += '</div>';
          $('#vnt_zoom_slider').append(data_content);
        });
      } else {
        return false;
      }

      var vnt_zoom_title = $("#vnt_zoom_title").html();
      if (!vnt_zoom_title) {
        vnt_zoom_title = 'Slide hình';
      }
      $('#vnt_zoom_screen').append("<div id='vnt_zoom_tool'></div>");
      var data_tool = "<div class='tool_title'>" + vnt_zoom_title + "</div>";
      data_tool += "<div class='tool_close'>Thoát</div>";
      data_tool += "<div class='tool_auto_play fa-play'>Tự động trình chiếu</div>";
      data_tool += "<div class='clear'></div>";
      $('#vnt_zoom_tool').append(data_tool);

      $('#vnt_zoom_slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: true,
        dots: false,
        autoplay: false,
        fade: true,
        autoplaySpeed: 2500,
        speed: 800
      });
      $("#vnt_zoom_tool .tool_auto_play").click(function (e) {
        if (!$(this).hasClass("pause")) {
          $(this).addClass("pause").removeClass("fa-play").addClass("fa-pause");
          $('#vnt_zoom_slider').slick('slickPlay');
        } else {
          $(this).removeClass("pause").addClass("fa-play").removeClass("fa-pause");
          $('#vnt_zoom_slider').slick('slickPause');
        }
      });
      $("#vnt_zoom_tool .tool_close,#vnt_zoom_tool .tool_title").click(function (e) {
        $("#vnt_zoom_screen").removeClass("active");
        $("#vnt_zoom_tool .tool_auto_play").removeClass("pause").addClass("fa-play").removeClass("fa-pause");
        $('#vnt_zoom_slider').slick('slickPause');
        $("#vnt_zoom_screen").remove();
      });

      var i_data_count = $(this).attr("data_count");
      $('#vnt_zoom_slider').slick('slickGoTo', i_data_count);
      $("#vnt_zoom_screen").addClass("active");
    });
  });


};

/** load_Statistics
 ******************************************************************/
vnTRUST.load_Statistics = function () {
  $.ajax({
    async: true,
    dataType: 'json',
    url: ROOT + "load_ajax.php?do=statistics",
    type: 'POST',
    success: function (data) {
      $("#stats_online").html(data.online);
      $("#stats_totals").html(data.totals);
      $("#stats_member").html(data.mem_online);
    }
  });

};

/** LoadAjax
 ******************************************************************/
vnTRUST.LoadAjax = function (doAct, mydata, ext_display) {
  $.ajax({
    async: true,
    url: ROOT + 'load_ajax.php?do=' + doAct,
    type: 'POST',
    data: mydata,
    success: function (data) {
      $("#" + ext_display).html(data)
    }
  });
};

/** show_popupBanner
 ******************************************************************/
vnTRUST.show_popupBanner = function (times) {
  var mydata = "lang=vn";
  $.ajax({
    async: true,
    dataType: 'json',
    url: ROOT + 'load_ajax.php?do=popupBanner',
    type: 'POST',
    data: mydata,
    success: function (data) {
      if (data.show == 1) {
        setTimeout(function () {

          $.fancybox({
            'padding': 0,
            'transitionIn': 'elastic',
            'transitionOut': 'elastic',
            'overlayShow': false,
            'content': data.html,
            'width': data.popup_w,
            'height': data.popup_h,
            'wrapCSS': 'classic-popup',
            'onComplete': function () {

              $.fancybox.resize();
              $.fancybox.center();
            }
          });

        }, times);


      }
    }
  });

};

 

/** registerMaillist
 ******************************************************************/
vnTRUST.registerMaillist = function ()
{
  var name = $("#fname").val();
  var femail = $("#femail").val();
  var ok_send = 1;

  if(name =='') {
    jAlert('Vui lòng nhập Họ tên',js_lang['error']);
    ok_send=0;
  }

  if(!vnTRUST.is_email(femail)) {
    jAlert('Email không hợp lệ',js_lang['error']);
    ok_send=0;
  }

  if (ok_send){
    var mydata =  "email="+femail+ "&name="+name  ;
    $.ajax({
      async: true,
      dataType: 'json',
      url: ROOT+'load_ajax.php?do=regMaillist',
      type: 'POST',
      data: mydata ,
      success: function (data) {
        jAlert(data.mess,js_lang['announce'],function(){  } );
      }
    }) ;
  }
  return false ;

};



/*--------------- doLogout ----------------*/
vnTRUST.popupLogin = function (ref)
{
  $.fancybox({
    'padding'		: 0,
    'autoSize': false,
    'href'			: ROOT+"thanh-vien/popup.html/?do=login&ref="+ref,
    'transitionIn'	: 'elastic',
    'transitionOut'	: 'elastic',
    'overlayShow'    :    false,
    'type'				: 'iframe',
    'width' : 750,
    'height' : 300
  });
};

/*--------------- doLogout ----------------*/
vnTRUST.doLogout = function()
{


  $.alerts.overlayColor = "#000000" ;
  $.alerts.overlayOpacity = "0.8" ;
  if(lang=="vn"){
    mess = 'Bạn có muốn thoát khỏi hệ thống không ?'
  }else{
    mess = 'Do you want to logout account ?';
  }
  jConfirm(mess, 'Confirm', function(r) {
    if (r){
      $.ajax({
        dataType: 'json',
        url: ROOT+'load_ajax.php?do=ajax_logout',
        type: 'POST',
        success: function (data) {
          location.reload(true);
        }
      }) ;
    }
  });


  return false;
};


/** registerMaillist
 ******************************************************************/
vnTRUST.registerMaillist = function ()
{
  var name = $("#fname").val();
  var femail = $("#femail").val();
  var ok_send = 1;

  if(name =='') {
    jAlert('Vui lÃ²ng nháº­p Há» tÃªn',js_lang['error']);
    ok_send=0;
  }

  if(!vnTRUST.is_email(femail)) {
    jAlert('Email khÃ´ng há»£p lá»‡',js_lang['error']);
    ok_send=0;
  }

  if (ok_send){
    var mydata =  "email="+femail+ "&name="+name  ;
    $.ajax({
      async: true,
      dataType: 'json',
      url: ROOT+'load_ajax.php?do=regMaillist',
      type: 'POST',
      data: mydata ,
      success: function (data) {
        jAlert(data.mess,js_lang['announce'],function(){  } );
      }
    }) ;
  }
  return false ;

};