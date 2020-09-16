/*------------------------------------------------------------------

[Master Script]

Organization     : Flamecore 
Organization URI : http://flamecore.pro
Name Project     : Auto2000 Client
Version          : 1.0.0
Author           : Andika Chamberlin
Author URI       : http://andikachamberlin.github.io

-------------------------------------------------------------------*/

$(document).ready(function(){

	/*------------------------------------------------------------------
	Install Mnel
	------------------------------------------------------------------*/
	console.log("installed mnel@alpha");

	/*------------------------------------------------------------------
	load resize
	------------------------------------------------------------------*/
	// $(window).resize(function(){
	// 	location.reload();
	// });

	/*------------------------------------------------------------------
	Materilize
	------------------------------------------------------------------*/
	M.AutoInit(); 

	/*------------------------------------------------------------------
	Mousewheel Alert
	------------------------------------------------------------------*/
	// window.addEventListener("wheel", _mousewheel);

	// function _mousewheel(){
	//     $("#_MW-Alert").addClass("_MW-Alert-active");
	// }
	
	/*------------------------------------------------------------------
	nicescoll
	------------------------------------------------------------------*/
	// $("body").niceScroll({
	// 	zindex:'99999999',
	// 	cursorcolor: "rgba(0,0,0,0.4)",
	// 	cursorwidth:"6px",
	// 	cursorborder:false,
	// 	horizrailenabled: false,
	// 	enablemousewheel: false,
	// });

	// $("._scroll-magnum").niceScroll({
	// 	zindex:'99999999',
	// 	cursorcolor: "rgba(0,0,0,0.4)",
	// 	cursorwidth:"5px",
	// 	cursorborder:false,
	// 	horizrailenabled: false,
	// 	enablemousewheel: false,
	// });

	/*------------------------------------------------------------------
	Slick
	------------------------------------------------------------------*/
	// $("#_slick").slick({
	//     dots: true,
	//     autoplay: true,
	//     autoplaySpeed: 5000,
	//     speed: 800
	// });

	/*------------------------------------------------------------------
	Media Query
	------------------------------------------------------------------*/
	// function _mq(mobile) {
	//   if (mobile.matches) {
	//   	// mobile
	  
	//   } else {
	//     // desktop

	//     // alert('desktop');
	  
	//   }
	// }

	// var mobile = window.matchMedia("(max-width: 1023px)")
	// _mq(mobile)
	// mobile.addListener(_mq);

	$("._auto2000-client").on('click', function(){
		$("._auto2000-client-content").toggleClass("_auto2000-form-active");
		$("._window").toggle();
	});

	$("._auto2000-BK").on('click', function(){
		$("._auto2000-BK-content").toggleClass("_auto2000-form-active");
		$("._window").toggle();
	});


	$("._window").on('click', function(){
		$("._auto2000-client-content").removeClass("_auto2000-form-active");
		$("._auto2000-BK-content").removeClass("_auto2000-form-active");		
		$("._window").hide();
	});

	// pelayanan_sa

	const _star1 = $("._ds-star-1"),
	_star2 = $("._ds-star-2"),
	_star3 = $("._ds-star-3"),
	_star4 = $("._ds-star-4"),
	_star5 = $("._ds-star-5");

	_star1.on('click', function(){
		$(this).addClass("_yellow");

		_star2.removeClass("_yellow");
		_star3.removeClass("_yellow");
		_star4.removeClass("_yellow");
		_star5.removeClass("_yellow");
		$('[name=pelayanan_sa').val(1);
	});

	_star2.on('click', function(){
		$(this).addClass("_yellow");
		_star1.addClass("_yellow");

		_star3.removeClass("_yellow");
		_star4.removeClass("_yellow");
		_star5.removeClass("_yellow");
		$('[name=pelayanan_sa').val(2);
	});

	_star3.on('click', function(){
		$(this).addClass("_yellow");
		_star1.addClass("_yellow");
		_star2.addClass("_yellow");

		_star4.removeClass("_yellow");
		_star5.removeClass("_yellow");
		$('[name=pelayanan_sa').val(3);
	});

	_star4.on('click', function(){
		$(this).addClass("_yellow");
		_star1.addClass("_yellow");
		_star2.addClass("_yellow");
		_star3.addClass("_yellow");

		_star5.removeClass("_yellow");
		$('[name=pelayanan_sa').val(4);
	});

	_star5.on('click', function(){
		$(this).addClass("_yellow");
		_star1.addClass("_yellow");
		_star2.addClass("_yellow");
		_star3.addClass("_yellow");
		_star4.addClass("_yellow");
		$('[name=pelayanan_sa').val(5);
	});

	// hasil service
	const hasil_star1 = $("._ds-star-hasil-1"),
	hasil_star2 = $("._ds-star-hasil-2"),
	hasil_star3 = $("._ds-star-hasil-3"),
	hasil_star4 = $("._ds-star-hasil-4"),
	hasil_star5 = $("._ds-star-hasil-5");

	hasil_star1.on('click', function(){
		$(this).addClass("_yellow");

		hasil_star2.removeClass("_yellow");
		hasil_star3.removeClass("_yellow");
		hasil_star4.removeClass("_yellow");
		hasil_star5.removeClass("_yellow");
		$('[name=hasil_service').val(1);
	});

	hasil_star2.on('click', function(){
		$(this).addClass("_yellow");
		hasil_star1.addClass("_yellow");

		hasil_star3.removeClass("_yellow");
		hasil_star4.removeClass("_yellow");
		hasil_star5.removeClass("_yellow");
		$('[name=hasil_service').val(2);
	});

	hasil_star3.on('click', function(){
		$(this).addClass("_yellow");
		hasil_star1.addClass("_yellow");
		hasil_star2.addClass("_yellow");

		hasil_star4.removeClass("_yellow");
		hasil_star5.removeClass("_yellow");
		$('[name=hasil_service').val(3);
	});

	hasil_star4.on('click', function(){
		$(this).addClass("_yellow");
		hasil_star1.addClass("_yellow");
		hasil_star2.addClass("_yellow");
		hasil_star3.addClass("_yellow");

		hasil_star5.removeClass("_yellow");
		$('[name=hasil_service').val(4);
	});

	hasil_star5.on('click', function(){
		$(this).addClass("_yellow");
		hasil_star1.addClass("_yellow");
		hasil_star2.addClass("_yellow");
		hasil_star3.addClass("_yellow");
		hasil_star4.addClass("_yellow");
		$('[name=hasil_service').val(5);
	});
});
