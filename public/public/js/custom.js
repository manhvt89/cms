(function ($) {

	"use strict";
	
	// mobile menu
	 $('.main-menu').meanmenu({
		meanScreenWidth: 991
	});

	// StickyHeader
	function stickyHeader() {
		var strickyScrollPos = $('#strickymenu').next().offset().top;
		if ($('#strickymenu').length) {
			if ($(window).scrollTop() > strickyScrollPos) {
				$('#strickymenu').addClass('sticky');
				$('body').addClass('sticky');
			} else if ($(window).scrollTop() <= strickyScrollPos) {
				$('#strickymenu').removeClass('sticky');
				$('body').removeClass('sticky');
			}
		};
	}
	$(window).on('scroll', function () {
		stickyHeader();
	});
	
	//Search
	$('.input-search').hide();
	$('.search-button').on('click', function () {
		$('.input-search').fadeToggle();
	});

	// Main Slider - Homepage
	if ($('.slide-carousel.slider-one').length) {
		$('.slide-carousel.slider-one').owlCarousel({
			items: 1,
			loop: true,
			autoplay: true,
			autoplayTimeout: 5000,
			smartSpeed: 800,
			dots: true,
			nav: true,
			navText: [
				"<i class='fa fa-angle-left'></i>",
				"<i class='fa fa-angle-right'></i>"
			]
		});
		
	}

	if ($('.testimonial-carousel').length) {
        $('.testimonial-carousel').owlCarousel({
            loop: true,
            margin: 30,
            nav: false,
            dots: true,
            autoplay: true,
            autoplayTimeout: 5000,
            smartSpeed: 800,
            responsive: {
                0: {
                    items: 1
                },
                768: {
                    items: 2
                },
                992: {
                    items: 3
                }
            }
        });
    }

	if ($('.blog-carousel').length) {
		$('.blog-carousel').owlCarousel({
			loop: true,
			margin: 30,
			nav: true,
			dots: false,
			autoplay: true,
			autoplayTimeout: 5000,
			smartSpeed: 800,
			navText: [
				"<i class='fa fa-angle-left'></i>",
				"<i class='fa fa-angle-right'></i>"
			],
			responsive: {
				0: {
					items: 1
				},
				576: {
					items: 1
				},
				768: {
					items: 2
				},
				992: {
					items: 3
				}
			}
		});
	
		// Hàm để điều chỉnh chiều cao các slide
		function setEqualHeight() {
			var maxHeight = 0;
			var bmaxHeight = 0;
			
			// Reset chiều cao trước
			$('.owl-carousel .blog-item').css('height', 'auto');
			$('.owl-carousel .blog-item blog-text').css('height', 'auto');

			$('.owl-carousel .blog-item').each(function () {
				
				var thisHeight = $(this).outerHeight();
				if (thisHeight > maxHeight) {
					maxHeight = thisHeight;
				}
				
			});

			$('.owl-carousel .blog-item').height(maxHeight);

			$('.owl-carousel .blog-item  .blog-text').each(function () {
				var bthisHeight = $(this).outerHeight();
				if (bthisHeight > bmaxHeight) {
					bmaxHeight = bthisHeight;
				}
				
			});

			$('.owl-carousel .blog-item  .blog-text').height(bmaxHeight);

		}
	
		// Gọi hàm khi carousel được khởi tạo và khi cửa sổ thay đổi kích thước
		$('.blog-carousel').on('initialized.owl.carousel resized.owl.carousel', function () {
			setEqualHeight();
		});
	
		// Gọi lại khi nội dung thay đổi hoặc hình ảnh được tải
		$(window).on('load resize', function () {
			setEqualHeight();
		});
	}

	if ($('.brand-carousel').length) {
        $('.brand-carousel').owlCarousel({
            loop: true,
            margin: 30,
            nav: false,
            dots: false,
            autoplay: true,
            autoplayTimeout: 3000,
            smartSpeed: 600,
            responsive: {
                0: {
                    items: 2
                },
                576: {
                    items: 3
                },
                768: {
                    items: 4
                },
                992: {
                    items: 5
                },
                1200: {
                    items: 6
                }
            }
        });
    }
	

	if ($('.team-carousel').length) {
		$('.team-carousel').owlCarousel({
			loop: true,
			margin: 30,
			nav: true,
			dots: true,
			autoplay: true,
			autoplayTimeout: 5000,
			smartSpeed: 800,
			navText: [
				"<i class='fa fa-angle-left'></i>",
				"<i class='fa fa-angle-right'></i>"
			],
			responsive: {
				0: {
					items: 1
				},
				576: {
					items: 2
				},
				992: {
					items: 3
				},
				1200: {
					items: 4
				}
			}
		});
	}
	


	$('.slide-carousel').on('translate.owl.carousel', function () {
		$('.text-animated h1').removeClass('fadeInDown animated').hide();
		$('.text-animated p').removeClass('fadeInUp animated').hide();
		$('.text-animated li').removeClass('fadeInUp animated').hide();
	});

	$('.slide-carousel').on('translated.owl.carousel', function () {
		$('.text-animated h1').addClass('fadeInDown animated').show();
		$('.text-animated p').addClass('fadeInUp animated').show();
		$('.text-animated li').addClass('fadeInUp animated').show();
	});

	

	// Testimonial-Page
	$('.testimonial-owl-page').owlCarousel({
		loop: true,
		autoplay: true,
		autoplayHoverPause: true,
		autoplaySpeed: 1500,
		smartSpeed: 1500,
		margin: 30,
		nav: true,
		navText: ["<i class='fa fa-caret-left'></i>", "<i class='fa fa-caret-right'></i>"],
		responsive: {
			0: {
				items: 1
			},
			768: {
				items: 2
			},
			992: {
				items: 3
			}
		}
	});

	

	// Single-Product
	$('.product-carousel').owlCarousel({
		loop: true,
		autoplay: true,
		autoplayHoverPause: true,
		autoplaySpeed: 1500,
		smartSpeed: 1500,
		animateIn: 'fadeIn',
		animateOut: 'fadeOut',
		margin: 25,
		nav: true,
		navText: ["<i class='fa fa-caret-left'></i>", "<i class='fa fa-caret-right'></i>"],
		responsive: {
			0: {
				items: 1
			},
			576: {
				items: 1
			},
			992: {
				items: 1
			}
		}
	});

	// About-Us
	$('.about-carousel').owlCarousel({
		loop: true,
		autoplay: true,
		autoplayHoverPause: true,
		autoplaySpeed: 1500,
		smartSpeed: 1500,
		animateIn: 'fadeIn',
		animateOut: 'fadeOut',
		margin: 25,
		nav: true,
		navText: ["<i class='fa fa-caret-left'></i>", "<i class='fa fa-caret-right'></i>"],
		responsive: {
			0: {
				items: 1
			},
			576: {
				items: 1
			},
			992: {
				items: 1
			}
		}
	});

	

	// Recent Product
	$('.owlproduct-carousel').owlCarousel({
		loop: true,
		autoplay: true,
		autoplayHoverPause: true,
		autoplaySpeed: 1500,
		smartSpeed: 1500,
		margin: 25,
		nav: true,
		navText: ["<i class='fa fa-caret-left'></i>", "<i class='fa fa-caret-right'></i>"],
		responsive: {
			0: {
				items: 1
			},
			576: {
				items: 2
			},
			768: {
				items: 3
			},
			1200: {
				items: 4
			}
		}
	});
	
	//DatePicker
	$( "#datepicker" ).datepicker({
		dateFormat: 'dd/mm/yy',
		changeMonth: true,
		changeYear: true
	});

	// filter-price
	$("#range-bar").slider({
		range: true,
		min: 5,
		max: 1500,
		values: [240, 960],
		slide: function (event, ui) {
			$("#range-show").html(ui.values[0] + '$' + '-' + ui.values[1] + '$');
		}
	});
	$("#range-show").html($("#range-bar").slider('values', 0) + '$' + '-' + $("#range-bar").slider('values', 1) + '$');

	// Spinner
	$("#shop_spinner").spinner({
		min: 1
	});
    
    // Magnific Popup
    $('.magnific').magnificPopup({
      type: 'image'
    });
	
	// Scroll-Top
	$(".scroll-top").hide();
	$(window).on("scroll", function () {
		if ($(this).scrollTop() > 300) {
			$(".scroll-top").fadeIn();
		} else {
			$(".scroll-top").fadeOut();
		}
	});
	$(".scroll-top").on("click", function () {
		$("html, body").animate({
			scrollTop: 0,
		}, 700)
	});

	// Preloader
	$(window).on('load', function () {
		$('#preloader').fadeOut();
		$('#preloader-status').delay(250).fadeOut('slow');
		$('body').delay(250).css({
			'overflow-x': 'hidden'
		});
	});

	// Filtr-Menu
	if ($('.filtr-container').length && typeof $('.filtr-container').filterizr === 'function') {
        $('.filtr-container').filterizr();
    }
	//$('.filtr-container').filterizr();
	// Filtering section nav
	$('#filtrnav li').on('click', function() {
		$('.filtr').removeClass('filtr-active');
		$(this).addClass('filtr-active');
		var filter = $(this).data('fltr');
		filtrnav.filterizr('filter', filter);
	});


	// Counter
	$('.counter').counterUp({
		delay: 10,
		time: 1000
	});

})(jQuery);