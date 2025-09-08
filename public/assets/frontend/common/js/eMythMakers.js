$(document).ready(function () {

  //ShowHide in Mobile
  $('.AMobileHide').click(function () { $(".MobileShowHide").slideToggle(); });

  // sticky-menu
  window.onscroll = function () {
	myFunction()
  };

  var header = document.getElementById("myHeader");
  var sticky = header.offsetTop;

  var header2 = document.getElementById("myHeader2");
  var sticky2 = header.offsetTop;


  function myFunction() {
	if (window.pageYOffset > sticky) {
	  header.classList.add("sticky");
	} else {
	  header.classList.remove("sticky");
	}
	if (window.pageYOffset > sticky2) {
	  header2.classList.add("sticky2");
	} else {
	  header2.classList.remove("sticky2");
	}
  }

  // Back to Top
  var btn = $('#buttonBT');
  $(window).scroll(function () {
	if ($(window).scrollTop() > 300) {
	  btn.addClass('show');
	} else {
	  btn.removeClass('show');
	}
  });
  btn.on('click', function (e) {
	e.preventDefault();
	$('html, body').animate({ scrollTop: 0 }, '300');
  });

  // more-navbar-js-here
  $(document).ready(function () {
	$('.navToggle').click(function () {
	  $('.menu').toggleClass('menuOn');
	  $('nav').toggleClass('navOn');
	  $('body, .most_last_news_details, .most_read_details').toggleClass('no-scrollbar');
	  // $('.nav-link').toggleClass('hide');
	})
  });

  // load
//   (function ($) {
// 	$(window).on("load", function () {
// 	  $(".content").mCustomScrollbar();
// 	});
//   })(jQuery);

  // Mobile navbar 
  $(document).ready(function () {
	function myMenuBtnChng() {
	  var element = document.getElementById("menu-button");
	  element.classList.toggle("fa-times");
	  element.classList.toggle("fa-bars");
	}
  });
  $(document).ready(function () {
	$(".menu-search").click(function (event) {
	  event.preventDefault();
	  $(".search_block").toggle("show hide");
	});
	$('a.close-search').click(function (e) {
	  e.preventDefault();
	  $(".search_block").toggle("show hide");
	});

	$('.menu-left').click(function (e) {
	  e.preventDefault();

	  $('body, .most_last_news_details, .most_read_details').toggleClass('no-scrollbar');
	});
  });
  $(document).ready(function () {
	// append plus symbol to every list item that has children
	$('#mobile-nav .parent').append('<i class="open-menu fas fa-plus "></i>');

	// fix non-scrolling overflow issue on mobile devices
	$('#mobile-nav > ul').wrap('<div class="overflow"></div>');
	$(window).on('load resize', function () {
	  var vph = $(window).height() - 57; // 57px - height of #mobile-nav
	  $('.overflow').css('max-height', vph);
	});

	// global variables
	var menu = $('.overflow > ul');
	var bg = $('html, body');

	function bgScrolling() {
	  if (menu.hasClass('open')) {
		bg.css({
		  'overflow-y': 'hidden',
		  'height': 'auto'
		});
	  } else {
		bg.css({
		  'overflow-y': 'visible',
		  'height': '100%'
		});
	  }
	}

	$('.menu-button').on('click', function (e) {
	  e.preventDefault();
	  // activate toggles
	  menu.slideToggle(250);
	  menu.toggleClass('open');
	  $(this).children().toggleClass('fa-reorder fa-remove');
	  bgScrolling();
	});

	// list item click events
	$('.open-menu').on('click', function (e) {
	  e.preventDefault();
	  $(this).prev('ul').slideToggle(250);
	  $(this).toggleClass('rotate');
	});
  });



 // profile-js-here    
    $(document).ready(function () {
        var $el = $(".user-btn");
        var $ee = $(".user-profile");

        $el.on('click', function (e) {
            e.stopPropagation();
            $ee.toggleClass('info');
        });
        $(document).on('click', function (e) {
            if (!$(e.target).closest($el).length && !$(e.target).closest($ee).length) {
                $ee.removeClass('info');
            }
        });
    });

});

  // sticky-menu
  // $(window).scroll(function () {
  //   if ($(window).scrollTop() > 20) {
  //	 $(".main-menu").addClass('sticky');
  //   } else {
  //	 $(".main-menu").removeClass('sticky');
  //   }
  // });

  //BackToTop
  $(document).ready(function () {
	$(window).scroll(function () {
	  if ($(this).scrollTop() > 50) {
		$('#back_to_top').fadeIn();
	  } else {
		$('#back_to_top').fadeOut();
	  }
	});
	// scroll body to 0px on click
	$('#back_to_top').click(function () {
	  $('#back-to-top').tooltip('hide');
	  $('body,html').animate({
		scrollTop: 0
	  }, 800);
	  return false;
	});

	$('#back_to_top').tooltip('show');

  });

// back-to
var btn = $('#button');

$(window).scroll(function () {
  if ($(window).scrollTop() > 300) {
	btn.addClass('show');
  } else {
	btn.removeClass('show');
  }
});

btn.on('click', function (e) {
  e.preventDefault();
  $('html, body').animate({ scrollTop: 0 }, '300');
});

  // file-upload-js
  function readURL(input) {
	if (input.files && input.files[0]) {
	  var reader = new FileReader();
	  reader.onload = function (e) {
		$('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
		$('#imagePreview').hide();
		$('#imagePreview').fadeIn(650);
	  }
	  reader.readAsDataURL(input.files[0]);
	}
  }
  $("#imageUpload").change(function () {
	readURL(this);
  });

// counter-js
// $(document).ready(function ($) {
//   //Check if an element was in a screen
//   function isScrolledIntoView(elem) {
// 	var docViewTop = $(window).scrollTop();
// 	var docViewBottom = docViewTop + $(window).height();
// 	var elemTop = $(elem).offset().top;
// 	var elemBottom = elemTop + $(elem).height();
// 	return ((elemBottom <= docViewBottom));
//   }
//   //Count up code
//   function countUp() {
// 	$('.counter').each(function () {
// 	  var $this = $(this), // <- Don't touch this variable. It's pure magic.
// 		countTo = $this.attr('data-count');
// 	  ended = $this.attr('ended');

// 	  if (ended != "true" && isScrolledIntoView($this)) {
// 		$({ countNum: $this.text() }).animate({
// 		  countNum: countTo
// 		},
// 		  {
// 			duration: 2500, //duration of counting
// 			easing: 'swing',
// 			step: function () {
// 			  $this.text(Math.floor(this.countNum));
// 			},
// 			complete: function () {
// 			  $this.text(this.countNum);
// 			}
// 		  });
// 		$this.attr('ended', 'true');
// 	  }
// 	});
//   }
//   //Start animation on page-load
//   if (isScrolledIntoView(".counter")) {
// 	countUp();
//   }
//   //Start animation on screen
//   $(document).scroll(function () {
// 	if (isScrolledIntoView(".counter")) {
// 	  countUp();
// 	}
//   });
// });



// hero-slider-js-here
$(document).ready(function () {
  $('.hero-slider').slick({
	dots: false,
	fade: false,
	arrows: true,
	infinite: true,
	speed: 1000,
	// lazyLoad: 'ondemand',
	prevArrow: '<span class="priv_arrow"><i class="fas fa-chevron-left"></i></span>',
	nextArrow: '<span class="next_arrow"><i class="fas fa-chevron-right"></i></span>',
	autoplay: false,
	slidesToShow: 1,
	slidesToScroll: 1,
	responsive: [
	  {
		breakpoint: 1023,
		settings: {
		  slidesToShow: 1,
		  slidesToScroll: 1,
		  infinite: true,
		  dots: true,
		}
	  },
	  {
		breakpoint: 992,
		settings: {
		  slidesToShow: 1,
		  slidesToScroll: 1
		}
	  },
	  {
		breakpoint: 768,
		settings: {
		  slidesToShow: 1,
		  slidesToScroll: 1
		}
	  },
	  {
		breakpoint: 600,
		settings: {
		  slidesToShow: 1,
		  slidesToScroll: 1
		}
	  },
	  {
		breakpoint: 480,
		settings: {
		  slidesToShow: 1,
		  slidesToScroll: 1
		}
	  }

	]

  })
});

// slider
$(document).ready(function () {
	$('.book-writer-slider').slick({
	  dots: false,
	  arrows: true,
	  infinite: true,
	  speed: 100,
	  fade: false,
	  cssEase: 'linear',
	  autoplay: false,
	  prevArrow: '<span class="priv_arrow"><i class="fas fa-chevron-left"></i></span>',
	  nextArrow: '<span class="next_arrow"><i class="fas fa-chevron-right"></i></span>',
	  slidesToShow: 7,
	  slidesToScroll: 1,
	  responsive: [
		{
		  breakpoint: 1023,
		  settings: {
			slidesToShow: 1,
			slidesToScroll: 1,
			infinite: false,
			dots: true,
		  }
		},
		{
		  breakpoint: 992,
		  settings: {
			slidesToShow: 3,
			slidesToScroll: 1
		  }
		},
		{
		  breakpoint: 768,
		  settings: {
			slidesToShow: 3,
			slidesToScroll: 1
		  }
		},
		{
		  breakpoint: 600,
		  settings: {
			slidesToShow: 2,
			slidesToScroll: 1
		  }
		},
		{
		  breakpoint: 480,
		  settings: {
			slidesToShow: 2,
			slidesToScroll: 1
		  }
		}
  
	  ]
  
	});
});

// client slider
$(document).ready(function () {
  $('.cateAll-slider').slick({
	dots: false,
	arrows: true,
	infinite: true,
	speed: 100,
	fade: false,
	cssEase: 'linear',
	autoplay: false,
	prevArrow: '<span class="priv_arrow"><i class="fas fa-chevron-left"></i></span>',
	nextArrow: '<span class="next_arrow"><i class="fas fa-chevron-right"></i></span>',
	slidesToShow: 4,
	slidesToScroll: 1,
	responsive: [
	  {
		breakpoint: 1023,
		settings: {
		  slidesToShow: 1,
		  slidesToScroll: 1,
		  infinite: false,
		  dots: true,
		}
	  },
	  {
		breakpoint: 992,
		settings: {
		  slidesToShow: 3,
		  slidesToScroll: 1
		}
	  },
	  {
		breakpoint: 768,
		settings: {
		  slidesToShow: 3,
		  slidesToScroll: 1
		}
	  },
	  {
		breakpoint: 600,
		settings: {
		  slidesToShow: 2,
		  slidesToScroll: 1
		}
	  },
	  {
		breakpoint: 480,
		settings: {
		  slidesToShow: 2,
		  slidesToScroll: 1
		}
	  }

	]

  });
});


function showSuccessMessage(message) {
	const html = `
	<div class="success-msg-front">
		<div class="alert alert-success alert-dismissible fade show" role="alert">
			<i class="fas fa-check-circle me-2"></i> ${message}
		</div>
	</div>`;

	const $container = $('#success-msg');
	$container.stop(true, true).hide().html(html).fadeIn().delay(4000).fadeOut();
}

$('.success-msg').fadeIn().delay(4000).fadeOut();



