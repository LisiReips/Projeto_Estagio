(function ($) {

  $.fn.menumaker = function (options) {

    var cssmenu = $(this), settings = $.extend({
      title: "Menu",
      format: "dropdown",
      sticky: false
    }, options);

    return this.each(function () {
      cssmenu.prepend('<div id="menu-button">' + settings.title + '</div>');
      $(this).find("#menu-button").on('click', function () {
	$(this).toggleClass('menu-opened');
	var mainmenu = $(this).next('ul');
	if (mainmenu.hasClass('open')) {
	  mainmenu.hide().removeClass('open');
	} else {
	  mainmenu.show().addClass('open');
	  if (settings.format === "dropdown") {
	    mainmenu.find('ul').show();
	  }
	}
      });

      cssmenu.find('li ul').parent().addClass('has-sub');

      multiTg = function () {
	cssmenu.find(".has-sub").prepend('<span class="submenu-button"></span>');
	cssmenu.find('.submenu-button').on('click', function () {
	  $(this).toggleClass('submenu-opened');
	  if ($(this).siblings('ul').hasClass('open')) {
	    $(this).siblings('ul').removeClass('open').hide();
	  } else {
	    $(this).siblings('ul').addClass('open').show();
	  }
	});
      };

      if (settings.format === 'multitoggle')
	multiTg();
      else
	cssmenu.addClass('dropdown');

      if (settings.sticky === true)
	cssmenu.css('position', 'fixed');

      resizeFix = function () {
	if ($(window).width() > 768) {
	  cssmenu.find('ul').show();
	}

	if ($(window).width() <= 768) {
	  cssmenu.find('ul').hide().removeClass('open');
	}
      };
      resizeFix();
      return $(window).on('resize', resizeFix);

    });
  };
})(jQuery);

(function ($) {
  $(document).ready(function () {
    $("#cssmenu").menumaker({
      title: "Menu",
      format: "multitoggle"
    });

    $('#cssmenu').prepend("<div id='menu-indicator'></div>");

    var foundActive = false, activeElement, indicatorPosition, indicator = $('#cssmenu #menu-indicator'), defaultPosition;

    $("#cssmenu > ul > li").each(function () {
      if ($(this).hasClass('active')) {
	activeElement = $(this);
	foundActive = true;
      }
    });

    if (foundActive === false) {
      activeElement = $("#cssmenu > ul > li").first();
    }

    defaultPosition = indicatorPosition = activeElement.position().left + activeElement.width() / 2 - 5;
    indicator.css("left", indicatorPosition);

    $("#cssmenu > ul > li").hover(function () {
      activeElement = $(this);
      indicatorPosition = activeElement.position().left + activeElement.width() / 2 - 5;
      indicator.css("left", indicatorPosition);
    },
	    function () {
	      indicator.css("left", defaultPosition);
	    });

  });
})(jQuery);

$(document).on("click", ".alink", function () {
  if ($(window).width() <= 768) {
    $('.submenu-button').removeClass("submenu-opened");
    $('.submenu-button').siblings('ul').removeClass('open').hide();
    $("#menu-button").trigger("click");
  }
});