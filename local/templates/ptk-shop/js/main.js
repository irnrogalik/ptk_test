$(function(){


	//------------------ UI handlers ------------------------

	$('input[data-valid="phone"]').mask("+375 (99) 999-99-99");

	$('.scrollTop').click(function() {
		var sec = $(document).scrollTop() / 4;
		$('html, body').animate({ scrollTop: 0 }, sec);
		return false;
	});

	$('[data-change]').on('click',function() {
		var arr = $(this).attr('data-change').split(' ');
		$(arr[0]).hide();
		$(arr[1]).show();
	})

	var img_detail = $('.js_img_detail');

	$('[data-big-src]').on('click',function() {
		img_detail.attr('src', $(this).attr('data-big-src'));
	})
	$('.pseudo_but').on('click', function() {
		var link = $(this).siblings('.download_link');
		$(link).removeClass('hidden');
		$(link).attr('href',$(link).data('href'));
	})
	$(document).on('click', '.download_link.hidden, .disabled', function(e) {
		e.preventDefault();
		return
	})
	if($('.n_offers__item ').length > 0) {
		$('.js_n-offer_price').text($('.js_n-offer.active').data('item-price'));
		$('[name="item-id"]').val($('.js_n-offer.active').data('item-id'));
	}


	//----------------------   --------------------------------

}); // end document ready

$(document).find('.js_n-offer').not('.disabled').on('click', function() {
	if(!$(this).hasClass('.active')) {
		$(document).find('.js_n-offer.active').removeClass('active');
		$(document).find('.js_n-offer_price').text($(this).data('item-price'));
		$(document).find('[name="item-id"]').val($(this).data('item-id'));
		$(this).addClass('active');
	}
})
$(document).on('click', '.js-basket_add', function(e) {
	e.preventDefault();
	var button = $(this);
	var form = $('#info_to_basket')[0];
	var formData = new FormData(form);
	$.ajax({
		url: "/requests/cart.php",
		type: "POST",
		data: formData,
		contentType: false,
		processData: false,
		beforeSend: function() {

		},
		success: function() {
			var buttonParams = {
				borderR: $(button).css('border-radius'),
				bgc: $(button).css('background-color'),
				height: $(button).outerHeight(),
				width: $(button).outerWidth(),
				top: $(button).offset().top,
				left: $(button).offset().left
			}
			var basket_aim = {
				height: $('.js_top_basket_aim').outerHeight(),
				width: $('.js_top_basket_aim').outerWidth(),
				top: $('.js_top_basket_aim').offset().top,
				left: $('.js_top_basket_aim').offset().left
			};
			var buttonNext = {
				button: $(button).siblings('.n_button-go'),
				bgc: $(button).siblings('.n_button-go').css('background-color'),
				borderR: $(button).siblings('.n_button-go').css('border-radius'),
				height: $(button).siblings('.n_button-go').outerHeight(),
				width: $(button).siblings('.n_button-go').outerWidth()
			}

			$(button).addClass('animated').css({
            	// 'transition': 'none',
            	// 'color':'transparent',
            	// 'padding':'0',
            	'height': buttonParams.height,
            	'width': buttonParams.width/*,
            	'font-size':'0'*/
            }).animate({
            	'border-radius':buttonParams.height/2,
            	'width':buttonParams.height
            }, 300, function() {
            	$(button).css({
            		'border-radius': '50%'
            	})
            	var newBut = $(button).clone().appendTo('body');
            	newBut.css({
            		'position':'absolute',
            		'top': buttonParams.top,
            		'left': buttonParams.left
            	}).animate({
            		'height': basket_aim.height,
            		'width': basket_aim.width,
            		'top': basket_aim.top,
            		'left': basket_aim.left
            	}, function() {
            		newBut.fadeOut().remove();
            		$('.js_top_basket_aim').text(function(i, ot){
            			return parseInt(ot)+1;
            		});
            		if($('.js_top_basket_aim').hasClass('n_invisible')){
            			$('.js_top_basket_aim').removeClass('n_invisible')
            		};
            		$(buttonNext.button).addClass('n_invisible').removeClass('n_hidden');
            		$(button).css({
            			'background':buttonNext.bgc,
            			'border-radius':buttonNext.height/2
            		}).animate({
            			'height': buttonNext.height,
            			'width': buttonNext.width,
            			'border-radius': buttonNext.borderR
            		}, function() {
            			$(buttonNext.button).css({'z-index': '4'}).animate({'opacity': 1}, 50);
            		})
            	})
            })
            
            $('.js_n-offer').not('.active').on('click', function() {
            	if(!$(this).hasClass('disabled')){
            		$(button).removeClass('animated').css({
            			'background':buttonParams.bgc,
            			'border-radius':buttonParams.borderR,
            			'height': buttonParams.height,
            			'width': buttonParams.width
            		})
            		$(buttonNext.button).css({'z-index': '0'}).animate({'opacity': 0}, 50);
            	}
            })
            
        }
    });
})

function fix_worker() {
	var start = $('.js_complex').offset().top,
	fix = $('.js_fix_area'),
	end = $('.js_complex').height() + start - fix.height();

	posa();
	$(document).scroll(function () {
		posa(top);
	})

	function posa() {
        //if(device.mobile()|| device.ios()|| device.android()) return;
        var top = $(document).scrollTop();
        if (top > start && top < end) {
        	fix.addClass('fix').css('top', '0');
        } else if (top >= end) {
        	fix.css('top', end - start).removeClass('fix');
        } else {
        	fix.css('top', '0px').removeClass('fix');
        }
    }
};

function Validator() {
	var params = [
	'js_validate',
	'data-valid',
	'data-valid-min',
	'js_class_valid',
	'js_invalid_animate',
	'error',
	'ok'
	],
	forms = $('.' + params[0]),
	fields = forms.find('[' + params[1] + ']'),
	animate_stopper = true,
	regulars = {
		name: /^[A-Za-zА-Яа-яЁё_-\s]+$/,
		phone: /^(\+375){1}(\s){1}(\(){1}(\d){2}(\)){1}(\s){1}(\d){3}(\-){1}(\d){2}(\-){1}(\d){2}$/,
		email: /^([a-zA-ZА-Яа-яЁё0-9_-]+\.)*[a-zA-ZА-Яа-яЁё0-9_-]+@[a-zA-ZА-Яа-яЁё0-9_-]+(\.[a-zA-ZА-Яа-яЁё0-9_-]+)*\.[a-zA-ZА-Яа-яЁё]{2,6}$/,
		number: /^\d+$/
	};

	function worker(exp, field_wrap) {
		field_wrap.removeClass(params[5]);
		exp ?
		field_wrap.removeClass(params[6]).addClass(params[5]) :
		field_wrap.addClass(params[6]);
	};

	function check_reg(field) {
		var field_wrap, min;

		field.attr(params[2]) ?
		min = (field.val().length < field.attr(params[2])) : min = false;

		field.hasClass(params[3]) ?
		field_wrap = field : field_wrap = field.closest('.' + params[3]);

		switch (field.attr(params[1])) {
			case 'name':
			worker(min || !regulars.name.test(field.val()), field_wrap);
			break;
			case 'phone':
			worker(min || !regulars.phone.test(field.val()), field_wrap);
			break;
			case 'email':
			worker(min || !regulars.email.test(field.val()), field_wrap);
			break;
			case 'number':
			worker(min || !regulars.number.test(field.val()), field_wrap);
			break;
			case 'all':
			worker(min, field_wrap);
			break;
		}

		enableButton();
	};

	function validate(form) {
		var input = form.find('.' + params[3]),
		submit = true;

		input.each(function () {
			if ($(this).hasClass(params[5])) {
				return submit = false;
			}
		});

		if (form.hasClass(params[4]) && animate_stopper) {
			animate_stopper = false;
			input.each(function () {
				if ($(this).hasClass(params[5])) {
					$(this)
					.animate({left: "-8px"}, 100).animate({left: "8px"}, 100)
					.animate({left: "-5px"}, 100).animate({left: "4px"}, 100)
					.animate({left: "-2px"}, 100).animate({left: "0px"}, 100, function () {
						animate_stopper = true;
					});
				}
			});
		};

		return submit;
	};

	fields.on('keyup', function () {
		if($(this).data("valid") == "name" && $(this).val().length>=2 || $(this).data("valid") == "phone" && parseInt($(this).val().slice(18))>=0 || $(this).attr('id') == "happy_client_description" && $(this).val().length>=5){
			check_reg($(this));
			return validate($(this).parents('form'));
		}
	});

	fields.on('change, blur', function () {
		if($(this).val() != "") {
			check_reg($(this));
			return validate($(this).parents('form'));
		} else {
			$(this).parent().removeClass("error ok");
		}
		enableButton();
	});
	fields.focus(function() {
		$(this).parents('.'+params[3]).removeClass('error ok disable_valid');
	})

	$(document).find('.js_send_app').on('click', function() {

		if($(this).hasClass('disabled')) {
			fields.each(function() {
				if($(this).val() =="") {
					$(this).parents('.'+params[3]).addClass('disable_valid');
				} else {
					$(this).parents('.'+params[3]).removeClass('disable_valid');
				}
			})
		} 
		$(this).parents('form').find('[' + params[1] + ']').each(function () {
			check_reg($(this));
		});
		return validate($(this).parents('form'));
	})

	forms.on('submit', function (e) {
		$(this).find('[' + params[1] + ']').each(function () {
			check_reg($(this));
		});
		return validate($(this));
	})
};
function enableButton() {
	if($(".js_class_valid").length == $(".js_class_valid.ok").length) {
		$('.js_send_app').removeClass('disabled');
	} else if (!$('.js_send_app').hasClass("disabled")) {
		$('.js_send_app').addClass('disabled');
	};
}

function row_slider(params) {

	var parent = params.parent_query,
	li_width = params.width_element_with_margin,
	li_visible = params.number_of_visible_elements,
	speed = params.speed_of_motion,
	carret = parent.find('.js_carret'),
	li = carret.find('.js_li'),
	next = parent.find('.js_next'),
	prev = parent.find('.js_prev'),
	state = 0,
	go = true,
	x = 0;

	var currPosition = 0,
	li_q = li.length;

  //init
  carret.css('width',li.length*li_width);
  // prev.addClass('disabled');
  if( li.length <= li_visible) {
  	prev.addClass('disabled');
  	next.addClass('disabled');
  	return;
  } else {
  	li.each(function() {
  		if($(this).index() >= 0 && $(this).index() <= li_visible - 1) {
  			$(this).addClass("s_after");
  		} 
  		if ($(this).index() >= li.length - li_visible && $(this).index() <= li.length - 1) {
  			$(this).addClass("s_before");
  		}
  	})
  	li.each(function(){
  		if($(this).hasClass('s_after')) {
  			$(this).clone().appendTo(carret);
  		}
  		if($(this).hasClass('s_before')) {
  			$('.js_li[data-tab="0"]').first().before($(this).clone());
  		}
  	})
  	$(document).find('.s_after, .s_before').removeClass('s_after s_before');
  	li_q = $(document).find('.js_carret .js_li').length;
  	carret.css({'width':li_q*li_width, 'margin-left': -li_width*li_visible});
  };


  next.on('click',function() {
  	if( go ) { 
  		var rest = li.length - state - li_visible;
  		go = false;
  		currPosition++;
  		prev.removeClass('disabled');
  		if( rest <= li_visible) {
  			// x = rest*li_width;
  			x = li_width;
  			state += rest ;
  			// next.addClass('disabled');
  		} else { 
  			// x = li_visible*li_width;
  			x = li_width;
  			state += li_visible;
  		};
  		carret.animate(
  			{'margin-left':'-='+x+'px'},
  			(x*0.4+200),
  			function() {
  				if (currPosition == li.length) {
  					carret.css({'margin-left':-li_width*li_visible});
  					currPosition = 0;
  				};
  				go = true;
  			}
  			);
  	};
  });

  prev.on('click',function() {
  	if( go ) {
  		go = false;
  		currPosition--;
  		next.removeClass('disabled');
  		if(state <= li_visible) {
  			// x = state*li_width;
  			x = li_width;
  			state = 0;
  			// prev.addClass('disabled');
  		} else {
  			// x = li_visible*li_width;
  			x = li_width;
  			state -= li_visible;
  		};
  		carret.animate(
  			{'margin-left':'+='+x+'px'},
  			(x*0.4+200),
  			function() {
  				if(currPosition == -li_visible) {
  					carret.css({'margin-left':-li_width*li.length});
  					currPosition = li.length-li_visible;
  				}
  				go = true;
  			}
  			);
  	};
  });
};

var DammSlider = function (param) {

	var delta = param.offsetTop,
	delta_left = param.query.width() + 'px',
	pos_default = {'top': '-2000px', 'left': '0'},
	pos_left = {'top': '0', 'left': '-' + delta_left},
	pos_right = {'top': '0', 'left': delta_left},
	pos_curr = {'top': '0', 'left': '0'},
	slide = param.query.find('.js_slide'),
	curr = param.start_slide,
	ctrl = param.query.find('.js_control'),
	nav = param.query.find('.js_navigation'),
	trigger = true,
	Obj = this;

	this.setStart = function (n) {
		curr = +n;
		slide.css(pos_default).eq(n).css(pos_curr);
	};

	this.init = function () {
		if ($(window).height() > param.min_height) {
			param.query.css('height', $(window).height() - delta + 'px');
		} else {
			param.query.css('height', param.min_height - delta + 'px');
		};
		if (param.min_height === 0) {
			param.query.css('height', '100%');
		};
		if (!nav.find('li').length) {
			for (var i = 0; i < slide.length; i++) {
				$('<li></li>').appendTo(nav);
			};
		};
		nav.find('li').each(function (i) {
			$(this).attr('data-num', i);
		});
		nav.find('li').eq(curr).addClass('curr');
		Obj.setStart(curr);
		if (slide.length == 1) {
			ctrl.hide();
		}
	};

	function move(curr_slide, next_slide, invert) {
		if (trigger) {
			trigger = false;
			if (invert) {
				if (curr_slide > next_slide) {
					slide.eq(next_slide).css(pos_right).animate({left: '0'}, param.speed);
					slide.eq(curr_slide).animate({left: '-' + delta_left}, param.speed, function () {
						trigger = true;
					});
				} else {
					slide.eq(next_slide).css(pos_left).animate({left: '0'}, param.speed);
					slide.eq(curr_slide).animate({left: delta_left}, param.speed, function () {
						trigger = true;
					});
				}
				;
				curr = next_slide;
			} else {
				if (curr_slide < next_slide) {
					slide.eq(next_slide).css(pos_right).animate({left: '0'}, param.speed);
					slide.eq(curr_slide).animate({left: '-' + delta_left}, param.speed, function () {
						trigger = true;
					});
				} else {
					slide.eq(next_slide).css(pos_left).animate({left: '0'}, param.speed);
					slide.eq(curr_slide).animate({left: delta_left}, param.speed, function () {
						trigger = true;
					});
				}
				;
				curr = next_slide;
			}
			return true;
		}
		return false;
	}
	;

	Obj.init();

	$(window).resize(function () {
		if ($(window).height() > param.min_height&& param.min_height!==0) {
			pos_left = {'top': '0', 'left': '-' + $(document).width() + 'px'},
			pos_right = {'top': '0', 'left': $(document).width() + 'px'},
			slide.css(pos_default).eq(curr).css(pos_curr);
		}
	})

	nav.find('li').on('click', function () {
		if ($(this).hasClass('curr'))
			return;
		if (move(curr, parseInt($(this).attr('data-num')))) {
			nav.find('li').removeClass('curr');
			$(this).addClass('curr');
		};
	});

	function controller(type) {
		var go;
		if (slide.length > 1) {
			if (type) {
				if (curr == slide.length - 1) {
					var next = 0;
					go = move(curr, next, true);
				} else {
					var next = curr + 1;
					go = move(curr, next, false);
				}
			} else {
				if (curr == 0) {
					var next = slide.length - 1;
					go = move(curr, next, true);
				} else {
					var next = curr - 1;
					go = move(curr, next, false);
				}
			}
			;
			if (go) {
				nav.find('li').removeClass('curr');
				nav.find('[data-num="' + next + '"]').addClass('curr');
			}
		}
	};

	ctrl.on('click', function () {
		if ($(this).hasClass('next')) {
			controller(true);
		} else {
			controller();
		}
	});

	$(document).keydown(function (e) {
		if (e.keyCode == 39) {
			controller(true);
		} else if (e.keyCode == 37) {
			controller();
		};
	});

    //touchHandle
    var startPos = 0,
    move_f = 0;
    param.query.on('touchstart', function (event) {
    	var e = event.originalEvent;
    	startPos = e.touches[0].pageX;
    });
    param.query.on('touchend', function (event) {
    	var e = event.originalEvent;
    	move_f = startPos - e.changedTouches[0].pageX;
    	if (Math.abs(move_f) > 40) {
    		if (move_f > 0) {
    			controller(true);
    		} else {
    			controller();
    		}
    	}
    	;
    });
};

+function ($) {
	'use strict';


	function transitionEnd() {
		var el = document.createElement('bootstrap')

		var transEndEventNames = {
			WebkitTransition : 'webkitTransitionEnd',
			MozTransition    : 'transitionend',
			OTransition      : 'oTransitionEnd otransitionend',
			transition       : 'transitionend'
		}

		for (var name in transEndEventNames) {
			if (el.style[name] !== undefined) {
				return { end: transEndEventNames[name] }
			}
		}

		return false 
	}

	$.fn.emulateTransitionEnd = function (duration) {
		var called = false
		var $el = this
		$(this).one('bsTransitionEnd', function () { called = true })
		var callback = function () { if (!called) $($el).trigger($.support.transition.end) }
		setTimeout(callback, duration)
		return this
	}

	$(function () {
		$.support.transition = transitionEnd()

		if (!$.support.transition) return

			$.event.special.bsTransitionEnd = {
				bindType: $.support.transition.end,
				delegateType: $.support.transition.end,
				handle: function (e) {
					if ($(e.target).is(this)) return e.handleObj.handler.apply(this, arguments)
				}
		}
	})

}(jQuery);

+function ($) {
	'use strict';

	var Modal = function (element, options) {
		this.options             = options
		this.$body               = $(document.body)
		this.$element            = $(element)
		this.$dialog             = this.$element.find('.modal-dialog')
		this.$backdrop           = null
		this.isShown             = null
		this.originalBodyPad     = null
		this.scrollbarWidth      = 0
		this.ignoreBackdropClick = false

		if (this.options.remote) {
			this.$element
			.find('.modal-content')
			.load(this.options.remote, $.proxy(function () {
				this.$element.trigger('loaded.bs.modal')
			}, this))
		}
	}

	Modal.VERSION  = '3.3.6'

	Modal.TRANSITION_DURATION = 300
	Modal.BACKDROP_TRANSITION_DURATION = 150

	Modal.DEFAULTS = {
		backdrop: true,
		keyboard: true,
		show: true
	}

	Modal.prototype.toggle = function (_relatedTarget) {
		return this.isShown ? this.hide() : this.show(_relatedTarget)
	}

	Modal.prototype.show = function (_relatedTarget) {
		var that = this
		var e    = $.Event('show.bs.modal', { relatedTarget: _relatedTarget })

		this.$element.trigger(e)

		if (this.isShown || e.isDefaultPrevented()) return

			this.isShown = true

		this.checkScrollbar()
		this.setScrollbar()
		this.$body.addClass('modal-open')

		this.escape()
		this.resize()

		this.$element.on('click.dismiss.bs.modal', '[data-dismiss="modal"]', $.proxy(this.hide, this))

		this.$dialog.on('mousedown.dismiss.bs.modal', function () {
			that.$element.one('mouseup.dismiss.bs.modal', function (e) {
				if ($(e.target).is(that.$element)) that.ignoreBackdropClick = true
			})
		})

		this.backdrop(function () {
			var transition = $.support.transition && that.$element.hasClass('fade')

			if (!that.$element.parent().length) {
        that.$element.appendTo(that.$body) // don't move modals dom position
    }

    that.$element
    .show()
    .scrollTop(0)

    that.adjustDialog()

    if (transition) {
        that.$element[0].offsetWidth // force reflow
    }

    that.$element.addClass('in')

    that.enforceFocus()

    var e = $.Event('shown.bs.modal', { relatedTarget: _relatedTarget })

    transition ?
        that.$dialog // wait for modal to slide in
        .one('bsTransitionEnd', function () {
        	that.$element.trigger('focus').trigger(e)
        })
        .emulateTransitionEnd(Modal.TRANSITION_DURATION) :
        that.$element.trigger('focus').trigger(e)
    })
	}

	Modal.prototype.hide = function (e) {
		if (e) e.preventDefault()

			e = $.Event('hide.bs.modal')

		this.$element.trigger(e)

		if (!this.isShown || e.isDefaultPrevented()) return

			this.isShown = false

		this.escape()
		this.resize()

		$(document).off('focusin.bs.modal')

		this.$element
		.removeClass('in')
		.off('click.dismiss.bs.modal')
		.off('mouseup.dismiss.bs.modal')

		this.$dialog.off('mousedown.dismiss.bs.modal')

		$.support.transition && this.$element.hasClass('fade') ?
		this.$element
		.one('bsTransitionEnd', $.proxy(this.hideModal, this))
		.emulateTransitionEnd(Modal.TRANSITION_DURATION) :
		this.hideModal()
	}

	Modal.prototype.enforceFocus = function () {
		$(document)
      .off('focusin.bs.modal') // guard against infinite focus loop
      .on('focusin.bs.modal', $.proxy(function (e) {
      	if (this.$element[0] !== e.target && !this.$element.has(e.target).length) {
      		this.$element.trigger('focus')
      	}
      }, this))
  }

  Modal.prototype.escape = function () {
  	if (this.isShown && this.options.keyboard) {
  		this.$element.on('keydown.dismiss.bs.modal', $.proxy(function (e) {
  			e.which == 27 && this.hide()
  		}, this))
  	} else if (!this.isShown) {
  		this.$element.off('keydown.dismiss.bs.modal')
  	}
  }

  Modal.prototype.resize = function () {
  	if (this.isShown) {
  		$(window).on('resize.bs.modal', $.proxy(this.handleUpdate, this))
  	} else {
  		$(window).off('resize.bs.modal')
  	}
  }

  Modal.prototype.hideModal = function () {
  	var that = this
  	this.$element.hide()
  	this.backdrop(function () {
  		that.$body.removeClass('modal-open')
  		that.resetAdjustments()
  		that.resetScrollbar()
  		that.$element.trigger('hidden.bs.modal')
  	})
  }

  Modal.prototype.removeBackdrop = function () {
  	this.$backdrop && this.$backdrop.remove()
  	this.$backdrop = null
  }

  Modal.prototype.backdrop = function (callback) {
  	var that = this
  	var animate = this.$element.hasClass('fade') ? 'fade' : ''

  	if (this.isShown && this.options.backdrop) {
  		var doAnimate = $.support.transition && animate

  		this.$backdrop = $(document.createElement('div'))
  		.addClass('modal-backdrop ' + animate)
  		.appendTo(this.$body)

  		this.$element.on('click.dismiss.bs.modal', $.proxy(function (e) {
  			if (this.ignoreBackdropClick) {
  				this.ignoreBackdropClick = false
  				return
  			}
  			if (e.target !== e.currentTarget) return
  				this.options.backdrop == 'static'
  			? this.$element[0].focus()
  			: this.hide()
  		}, this))

      if (doAnimate) this.$backdrop[0].offsetWidth // force reflow

      	this.$backdrop.addClass('in')

      if (!callback) return

      	doAnimate ?
      this.$backdrop
      .one('bsTransitionEnd', callback)
      .emulateTransitionEnd(Modal.BACKDROP_TRANSITION_DURATION) :
      callback()

  } else if (!this.isShown && this.$backdrop) {
  	this.$backdrop.removeClass('in')

  	var callbackRemove = function () {
  		that.removeBackdrop()
  		callback && callback()
  	}
  	$.support.transition && this.$element.hasClass('fade') ?
  	this.$backdrop
  	.one('bsTransitionEnd', callbackRemove)
  	.emulateTransitionEnd(Modal.BACKDROP_TRANSITION_DURATION) :
  	callbackRemove()

  } else if (callback) {
  	callback()
  }
}

  // these following methods are used to handle overflowing modals

  Modal.prototype.handleUpdate = function () {
  	this.adjustDialog()
  }

  Modal.prototype.adjustDialog = function () {
  	var modalIsOverflowing = this.$element[0].scrollHeight > document.documentElement.clientHeight

  	this.$element.css({
  		paddingLeft:  !this.bodyIsOverflowing && modalIsOverflowing ? this.scrollbarWidth : '',
  		paddingRight: this.bodyIsOverflowing && !modalIsOverflowing ? this.scrollbarWidth : ''
  	})
  }

  Modal.prototype.resetAdjustments = function () {
  	this.$element.css({
  		paddingLeft: '',
  		paddingRight: ''
  	})
  }

  Modal.prototype.checkScrollbar = function () {
  	var fullWindowWidth = window.innerWidth
    if (!fullWindowWidth) { // workaround for missing window.innerWidth in IE8
    	var documentElementRect = document.documentElement.getBoundingClientRect()
    	fullWindowWidth = documentElementRect.right - Math.abs(documentElementRect.left)
    }
    this.bodyIsOverflowing = document.body.clientWidth < fullWindowWidth
    this.scrollbarWidth = this.measureScrollbar()
}

Modal.prototype.setScrollbar = function () {
	var bodyPad = parseInt((this.$body.css('padding-right') || 0), 10)
	this.originalBodyPad = document.body.style.paddingRight || ''
	if (this.bodyIsOverflowing) this.$body.css('padding-right', bodyPad + this.scrollbarWidth)
}

Modal.prototype.resetScrollbar = function () {
	this.$body.css('padding-right', this.originalBodyPad)
}

  Modal.prototype.measureScrollbar = function () { // thx walsh
  	var scrollDiv = document.createElement('div')
  	scrollDiv.className = 'modal-scrollbar-measure'
  	this.$body.append(scrollDiv)
  	var scrollbarWidth = scrollDiv.offsetWidth - scrollDiv.clientWidth
  	this.$body[0].removeChild(scrollDiv)
  	return scrollbarWidth
  }


  // MODAL PLUGIN DEFINITION
  // =======================

  function Plugin(option, _relatedTarget) {
  	return this.each(function () {
  		var $this   = $(this)
  		var data    = $this.data('bs.modal')
  		var options = $.extend({}, Modal.DEFAULTS, $this.data(), typeof option == 'object' && option)

  		if (!data) $this.data('bs.modal', (data = new Modal(this, options)))
  			if (typeof option == 'string') data[option](_relatedTarget)
  				else if (options.show) data.show(_relatedTarget)
  			})
  }

  var old = $.fn.modal

  $.fn.modal             = Plugin
  $.fn.modal.Constructor = Modal


  // MODAL NO CONFLICT
  // =================

  $.fn.modal.noConflict = function () {
  	$.fn.modal = old
  	return this
  }


  // MODAL DATA-API
  // ==============

  $(document).on('click.bs.modal.data-api', '[data-toggle="modal"]', function (e) {
  	var $this   = $(this)
  	var href    = $this.attr('href')
    var $target = $($this.attr('data-target') || (href && href.replace(/.*(?=#[^\s]+$)/, ''))) // strip for ie7
    var option  = $target.data('bs.modal') ? 'toggle' : $.extend({ remote: !/#/.test(href) && href }, $target.data(), $this.data())

    if ($this.is('a')) e.preventDefault()

    	$target.one('show.bs.modal', function (showEvent) {
      if (showEvent.isDefaultPrevented()) return // only register focus restorer if modal will actually get shown
      	$target.one('hidden.bs.modal', function () {
      		$this.is(':visible') && $this.trigger('focus')
      	})
  })
    Plugin.call($target, option, this)
})

}(jQuery);
$(function(){
	$(".js-chat").on("click", function(e){
		e.preventDefault();
		if(typeof(jivo_api) == "undefined") {
			return;
		}
		if($("#jivo-iframe-container").hasClass("jivo-collapsed")) {
			jivo_api.open();
		} else {
			$("#jivo_close_button").trigger('click');
		}

	})
})