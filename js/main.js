jQuery(document).ready(function($){
	var $form_modal = $('.cd-user-modal'),
		$form_login = $form_modal.find('#cd-login'),
		$form_signup = $form_modal.find('#cd-signup'),
		$form_forgot_password = $form_modal.find('#cd-reset-password'),
		$form_modal_tab = $('.cd-switcher'),
		$tab_login = $form_modal_tab.children('li').eq(0).children('a'),
		$tab_signup = $form_modal_tab.children('li').eq(1).children('a'),
		$forgot_password_link = $form_login.find('.cd-form-bottom-message a'),
		$back_to_login_link = $form_forgot_password.find('.cd-form-bottom-message a'),
		$main_nav = $('.main-nav');

	//open modal
	$main_nav.on('click', function(event){

		if( $(event.target).is($main_nav) ) {
			// on mobile open the submenu
			$(this).children('ul').toggleClass('is-visible');
		} else {
			// on mobile close submenu
			$main_nav.children('ul').removeClass('is-visible');
			//show modal layer
			$form_modal.addClass('is-visible');	
			//show the selected form
			( $(event.target).is('.cd-signup') ) ? signup_selected() : login_selected();
		}

	});

	//close modal
	$('.cd-user-modal').on('click', function(event){
		if( $(event.target).is($form_modal) || $(event.target).is('.cd-close-form') ) {
			$form_modal.removeClass('is-visible');
		}	
	});
	//close modal when clicking the esc keyboard button
	$(document).keyup(function(event){
    	if(event.which=='27'){
    		$form_modal.removeClass('is-visible');
	    }
    });

	//switch from a tab to another
	$form_modal_tab.on('click', function(event) {
		event.preventDefault();
		( $(event.target).is( $tab_login ) ) ? login_selected() : signup_selected();
	});

	//hide or show password
	$('.hide-password').on('click', function(){
		var $this= $(this),
			$password_field = $this.prev('input');
		
		( 'password' == $password_field.attr('type') ) ? $password_field.attr('type', 'text') : $password_field.attr('type', 'password');
		( 'Hide' == $this.text() ) ? $this.text('Show') : $this.text('Hide');
		//focus and move cursor to the end of input field
		$password_field.putCursorAtEnd();
	});

	//show forgot-password form 
	$forgot_password_link.on('click', function(event){
		event.preventDefault();
		forgot_password_selected();
	});

	//back to login from the forgot-password form
	$back_to_login_link.on('click', function(event){
		event.preventDefault();
		login_selected();
	});

	function login_selected(){
		$form_login.addClass('is-selected');
		$form_signup.removeClass('is-selected');
		$form_forgot_password.removeClass('is-selected');
		$tab_login.addClass('selected');
		$tab_signup.removeClass('selected');
	}
/*
	function signup_selected(){
		$form_login.removeClass('is-selected');
		$form_signup.addClass('is-selected');
		$form_forgot_password.removeClass('is-selected');
		$tab_login.removeClass('selected');
		$tab_signup.addClass('selected');
	}
*/
	function forgot_password_selected(){
		$form_login.removeClass('is-selected');
		$form_signup.removeClass('is-selected');
		$form_forgot_password.addClass('is-selected');
	}

	//REMOVE THIS - it's just to show error messages 
/*	$form_login.find('input[type="submit"]').on('click', function(event){
		event.preventDefault();
		$form_login.find('input[type="email"]').toggleClass('has-error').next('span').toggleClass('is-visible');
	});
	$form_signup.find('input[type="submit"]').on('click', function(event){
		event.preventDefault();
		$form_signup.find('input[type="email"]').toggleClass('has-error').next('span').toggleClass('is-visible');
	});
*/

	//IE9 placeholder fallback
	//credits http://www.hagenburger.net/BLOG/HTML5-Input-Placeholder-Fix-With-jQuery.html
	if(!Modernizr.input.placeholder){
		$('[placeholder]').focus(function() {
			var input = $(this);
			if (input.val() == input.attr('placeholder')) {
				input.val('');
		  	}
		}).blur(function() {
		 	var input = $(this);
		  	if (input.val() == '' || input.val() == input.attr('placeholder')) {
				input.val(input.attr('placeholder'));
		  	}
		}).blur();
		$('[placeholder]').parents('form').submit(function() {
		  	$(this).find('[placeholder]').each(function() {
				var input = $(this);
				if (input.val() == input.attr('placeholder')) {
			 		input.val('');
				}
		  	})
		});
	}

});


//credits http://css-tricks.com/snippets/jquery/move-cursor-to-end-of-textarea-or-input/
jQuery.fn.putCursorAtEnd = function() {
	return this.each(function() {
    	// If this function exists...
    	if (this.setSelectionRange) {
      		// ... then use it (Doesn't work in IE)
      		// Double the length because Opera is inconsistent about whether a carriage return is one character or two. Sigh.
      		var len = $(this).val().length * 2;
      		this.setSelectionRange(len, len);
    	} else {
    		// ... otherwise replace the contents with itself
    		// (Doesn't work in Google Chrome)
      		$(this).val($(this).val());
    	}
	});
};

jQuery(document).ready(function(){
	/*
		convert a cubic bezier value to a custom mina easing
		http://stackoverflow.com/questions/25265197/how-to-convert-a-cubic-bezier-value-to-a-custom-mina-easing-snap-svg
	*/
	var duration = 250,
		epsilon = (1000 / 60 / duration) / 4,
		firstCustomMinaAnimation = bezier(.42,.03,.77,.63, epsilon),
		secondCustomMinaAnimation = bezier(.27,.5,.6,.99, epsilon),
		animating = false;

	//initialize the slider
	$('.cd-slider-wrapper').each(function(){
		initSlider($(this));
	});

	function initSlider(sliderWrapper) {
		//cache jQuery objects
		var slider = sliderWrapper.find('.cd-slider'),
			sliderNav = sliderWrapper.find('.cd-slider-navigation'),
			sliderControls = sliderWrapper.find('.cd-slider-controls').find('li');

		//store path 'd' attribute values	
		var pathArray = [];
		pathArray[0] = slider.data('step1');
		pathArray[1] = slider.data('step4');
		pathArray[2] = slider.data('step2');
		pathArray[3] = slider.data('step5');
		pathArray[4] = slider.data('step3');
		pathArray[5] = slider.data('step6');

		//update visible slide when user clicks next/prev arrows
		sliderNav.on('click', '.next-slide', function(event){
			event.preventDefault();
			nextSlide(slider, sliderControls, pathArray);
		});
		sliderNav.on('click', '.prev-slide', function(event){
			event.preventDefault();
			prevSlide(slider, sliderControls, pathArray);
		});

		//detect swipe event on mobile - update visible slide
		slider.on('swipeleft', function(event){
			nextSlide(slider, sliderControls, pathArray);
		});
		slider.on('swiperight', function(event){
			prevSlide(slider, sliderControls, pathArray);
		});

		//update visible slide when user clicks .cd-slider-controls buttons
		sliderControls.on('click', function(event){
			event.preventDefault();
			var selectedItem = $(this);
			if(!selectedItem.hasClass('selected')) {
				// if it's not already selected
				var selectedSlidePosition = selectedItem.index(),
					selectedSlide = slider.children('li').eq(selectedSlidePosition),
					visibleSlide = retrieveVisibleSlide(slider),
					visibleSlidePosition = visibleSlide.index(),
					direction = '';
				direction = ( visibleSlidePosition < selectedSlidePosition) ? 'next': 'prev';
				updateSlide(visibleSlide, selectedSlide, direction, sliderControls, pathArray);
			}
		});

		//keyboard slider navigation
		$(document).keyup(function(event){
			if(event.which=='37' && elementInViewport(slider.get(0)) ) {
				prevSlide(slider, sliderControls, pathArray);
			} else if( event.which=='39' && elementInViewport(slider.get(0)) ) {
				nextSlide(slider, sliderControls, pathArray);
			}
		});
	}

	function retrieveVisibleSlide(slider, sliderControls, pathArray) {
		return slider.find('.visible');
	}
	function nextSlide(slider, sliderControls, pathArray ) {
		var visibleSlide = retrieveVisibleSlide(slider),
			nextSlide = ( visibleSlide.next('li').length > 0 ) ? visibleSlide.next('li') : slider.find('li').eq(0);
		updateSlide(visibleSlide, nextSlide, 'next', sliderControls, pathArray);
	}
	function prevSlide(slider, sliderControls, pathArray ) {
		var visibleSlide = retrieveVisibleSlide(slider),
				prevSlide = ( visibleSlide.prev('li').length > 0 ) ? visibleSlide.prev('li') : slider.find('li').last();
			updateSlide(visibleSlide, prevSlide, 'prev', sliderControls, pathArray);
	}
	function updateSlide(oldSlide, newSlide, direction, controls, paths) {
		if(!animating) {
			//don't animate if already animating
			animating = true;
			var clipPathId = newSlide.find('path').attr('id'),
				clipPath = Snap('#'+clipPathId);

			if( direction == 'next' ) {
				var path1 = paths[0],
					path2 = paths[2],
					path3 = paths[4];
			} else {
				var path1 = paths[1],
					path2 = paths[3],
					path3 = paths[5];
			}

			updateNavSlide(newSlide, controls);
			newSlide.addClass('is-animating');
			clipPath.attr('d', path1).animate({'d': path2}, duration, firstCustomMinaAnimation, function(){
				clipPath.animate({'d': path3}, duration, secondCustomMinaAnimation, function(){
					oldSlide.removeClass('visible');
					newSlide.addClass('visible').removeClass('is-animating');
					animating = false;
				});
			});
		}
	}

	function updateNavSlide(actualSlide, controls) {
		var position = actualSlide.index();
		controls.removeClass('selected').eq(position).addClass('selected');
	}

	function bezier(x1, y1, x2, y2, epsilon){
		//https://github.com/arian/cubic-bezier
		var curveX = function(t){
			var v = 1 - t;
			return 3 * v * v * t * x1 + 3 * v * t * t * x2 + t * t * t;
		};

		var curveY = function(t){
			var v = 1 - t;
			return 3 * v * v * t * y1 + 3 * v * t * t * y2 + t * t * t;
		};

		var derivativeCurveX = function(t){
			var v = 1 - t;
			return 3 * (2 * (t - 1) * t + v * v) * x1 + 3 * (- t * t * t + 2 * v * t) * x2;
		};

		return function(t){

			var x = t, t0, t1, t2, x2, d2, i;

			// First try a few iterations of Newton's method -- normally very fast.
			for (t2 = x, i = 0; i < 8; i++){
				x2 = curveX(t2) - x;
				if (Math.abs(x2) < epsilon) return curveY(t2);
				d2 = derivativeCurveX(t2);
				if (Math.abs(d2) < 1e-6) break;
				t2 = t2 - x2 / d2;
			}

			t0 = 0, t1 = 1, t2 = x;

			if (t2 < t0) return curveY(t0);
			if (t2 > t1) return curveY(t1);

			// Fallback to the bisection method for reliability.
			while (t0 < t1){
				x2 = curveX(t2);
				if (Math.abs(x2 - x) < epsilon) return curveY(t2);
				if (x > x2) t0 = t2;
				else t1 = t2;
				t2 = (t1 - t0) * .5 + t0;
			}

			// Failure
			return curveY(t2);

		};
	};

	/*
		How to tell if a DOM element is visible in the current viewport?
		http://stackoverflow.com/questions/123999/how-to-tell-if-a-dom-element-is-visible-in-the-current-viewport
	*/
	function elementInViewport(el) {
		var top = el.offsetTop;
		var left = el.offsetLeft;
		var width = el.offsetWidth;
		var height = el.offsetHeight;

		while(el.offsetParent) {
		    el = el.offsetParent;
		    top += el.offsetTop;
		    left += el.offsetLeft;
		}

		return (
		    top < (window.pageYOffset + window.innerHeight) &&
		    left < (window.pageXOffset + window.innerWidth) &&
		    (top + height) > window.pageYOffset &&
		    (left + width) > window.pageXOffset
		);
	}
});