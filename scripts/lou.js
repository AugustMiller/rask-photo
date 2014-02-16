/*
	Cindi Rask Photography & Found Accessories
	2014
*/

var Images,
	Gallery;

$(document).ready( function ( ) {
	Images = new Loader( ".slideshow,.content" );

	if ( $(document.body).hasClass('home') || $(document.body).hasClass('single-project') ) initGallery();

	//	Menu

	$('.menu-button-open').click( function ( ) {
		$('.flyout').addClass('open');
	});

	$('.menu-button-close').click( function ( ) {
		$('.flyout').removeClass('open');
	});

	//	Pjax?
	/*
	Doesn't work...?
	$(document).pjax( 'a' , 'body' , {
		timeout : 3000
	});
	*/

});

/*
	Responsive Image Lazy-Loader
*/

function Loader ( scope ) {
	var self = this;

	self.els = $(scope).find('img');
	self.images = [];

	self.init();
}

Loader.prototype = {
	init : function ( ) {
		var self = this;

		for ( var i = 0; i < self.els.length; i++ ) {
			self.images.push( new Image( self.els[i] ) );
		}
		self.listen();
	},
	listen : function ( ) {
		var self = this;
		
		window.setTimeout( function ( ) {
			self.test();
			self.listen();
		} , 250 );
	},
	test : function ( ) {
		var self = this,
			scrolled = window.scrollY,
			height = window.innerHeight;

		for ( var i = 0; i < self.images.length; i++ ) {
			if ( !self.images[i].loaded && ( ( height * 2 ) + scrolled ) > self.images[i].el.offset().top ) {
				self.images[i].load();
			}
		}
	}
}

function Image ( img ) {
	var self = this;

	self.el = $(img);
	self.loaded = false;
	self.init();

	// console.log(self);
}

Image.prototype = {
	init : function ( ) {
		var self = this;

		self.urls = {
			normal : self.el.data('src-normal'),
			mobile : self.el.data('src-mobile'),
			retina : self.el.data('src-retina')
		};
	},

	load : function ( ) {
		var self = this;

		self.el.attr( 'src' , self.size() );

		self.loaded = true;

		// console.log("Image loading...");
	},

	size : function ( ) {
		var self = this,
			url;

		if ( window.innerWidth > 1600 ) {
			url = self.urls.retina;
		} else if ( ( window.devicePixelRatio > 1 ) && ( window.innerWidth < 1024 ) ) {
			url = self.urls.mobile;
		} else {
			url = self.urls.normal;
		}
		return url;
	}
};

/*
	Slider
*/

//	Helper to get this kickstarted:

function initGallery ( ) {
	Gallery = new Slideshow( '.home-heroes' , {
		forward : ".next",
		back : ".prev",
		auto : false,
		slides : ".slide",
		wrapper : ".slides",
		speed : 750,
		indicators : ".indicators"
	});
}

/*
	Slides
	by August Miller gusmiller.com
*/

function Slideshow ( el , opts ) {
	var self = this;

	self.el = $(el);
	self.slides = [];
	self.current = 0;
	self.options = {
		forward : $(opts.forward),
		back : $(opts.back),
		auto : ( typeof opts.auto_advance == "undefined" ) ? true : false,
		slides : $(opts.slides) || $(".slide"),
		wrapper : $(opts.wrapper) || $(".slides"),
		speed : opts.speed || 500,
		indicators : $(opts.indicators) || $(".pagination")
	};
	self.touch = {};

	self.listen();
	self.init();
}

Slideshow.prototype = {

	init : function ( ) {
		var self = this,
			els = self.options.slides;

		els.each( function ( index ) {
			self.slides.push( new Slide ( this , index , self.options.indicators ) );
		});

		self.layout();
		self.pick(0);

		console.log(self);
	},

	listen : function ( ) {
		var self = this;
		// console.log("listen()");

		$(window).on( "resize" , function ( e ) {
			self.layout( e );
		});

		$(self.options.forward).on( 'click' , function ( e ) {
			self.next( self.options.speed );
		});

		$(self.options.back).on( 'click' , function ( e ) {
			self.prev( self.options.speed );
		});

		$(window).on( "keyup" , function ( e ) {
			switch ( e.keyCode ) {
				case 39 :
					self.next( self.options.speed );
					break;
				case 37 :
					self.prev( self.options.speed );
					break;
			}
		});

		$(self.el).on( 'touchstart' , function ( e ) {
			self.touchSetup( e.originalEvent );
		});

		$(self.el).on( 'touchmove' , function ( e ) {
			self.touchPan( e.originalEvent );
		});

		$(self.el).on( 'touchend' , function ( e ) {
			self.touchConclude( e.originalEvent );
		});
	},

	touchSetup : function ( e ) {
		var self = this;
		// console.log(e);

		self.touch.start = {
			position : e.touches[0].pageX,
			time : e.timeStamp
		};
	},

	touchPan : function ( e ) {
		var self = this;
		// console.log(e);

		self.touch.delta = {
			distance : ( self.touch.start.position - e.touches[0].pageX ),
			duration : ( e.timeStamp - self.touch.start.time )
		};

		self.options.wrapper.css({
			left : ( ( - self.touch.delta.distance ) - ( self.el.width() * self.current ) )
		});
	},

	touchConclude : function ( e ) {
		var self = this;
		// console.log(e);

		if ( Math.abs( self.touch.delta.distance ) > ( self.el.width() / 4 ) ) {
			if ( self.touch.delta.distance > 0 ) {
				self.next( Math.min( self.touch.delta.duration , self.options.speed ) );
			} else {
				self.prev( Math.min( self.touch.delta.duration , self.options.speed ) );
			}
		} else {
			self.pick( self.current , 250 );
		}
	},

	next : function ( speed ) {
		var self = this;
		// console.log("next()");
		self.pick( ( ( self.current + 1 < self.slides.length ) ? ( self.current + 1 ) : ( self.slides.length - 1 ) ) , speed );
	},

	prev : function ( speed ) {
		var self = this;
		// console.log("prev()");
		self.pick( ( ( self.current - 1 >= 0 ) ? ( self.current - 1 ) : ( 0 ) ) , speed );
	},

	pick : function ( index , speed ) {
		var self = this;
		// console.log(["pick()",index]);
		if ( speed ) {
			$(self.options.wrapper).animate({
				"left" : - ( index * self.el.width() )
			} , {
				duration : speed,
				queue : false
			});
		} else {
			$(self.options.wrapper).css({
				"left" : - ( index * self.el.width() )
			});
		}

		for ( var s = 0; s < self.slides.length; s++ ) {
			self.slides[s].deactivate();
		}

		self.slides[index].activate();
		self.current = index;
	},

	layout : function ( e ) {
		var self = this,
			width = window.innerWidth,
			height = window.innerHeight;

		self.el.height( height );

		self.options.wrapper.css({
			"width" : ( self.slides.length * width )
		});

		for ( var s = 0; s < self.slides.length; s++ ) {
			self.slides[s].resize( width , height );
		}

		self.pick( self.current , 0 );
	}

}

function Slide ( el , index , indicators ) {
	var self = this;

	self.el = $(el);
	self.wrapper = self.el.find('.image-wrap');
	self.image = self.el.find('img');
	self.index = index;
	self.ratio = parseFloat( self.image.data('aspect-ratio') );
	self.indicator = $('<div/>').appendTo(indicators).addClass('slide-dot');

	// console.log(self);
}

Slide.prototype.activate = function ( ) {
	var self = this;
	
	self.indicator.addClass('active');
};

Slide.prototype.deactivate = function ( ) {
	var self = this;
	
	self.indicator.removeClass('active');
};

Slide.prototype.resize = function ( width , height ) {
	var self = this;
	// console.log(["Holy fuck resize like hell bitches",width]);
	self.el.css({
		"width" : width,
		"height" : height
	});

	self.position( width , height );
};

Slide.prototype.position = function ( width , height ) {
	var self = this,
		ratio = ( width / height );

	if ( ratio < self.ratio ) {
		self.wrapper.css({
			'width' : ( self.ratio * height ),
			'margin-left' : ( ( width - ( self.ratio * height ) ) / 2 ),
			'margin-top' : 0
		});
	} else {
		self.wrapper.css({
			'width' : width,
			'margin-left' : 0,
			'margin-top' : ( ( height - ( width / self.ratio ) ) / 2 )
		});
	}

};
