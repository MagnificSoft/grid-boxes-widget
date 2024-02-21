class GridBoxesHandler extends elementorModules.frontend.handlers.Base {


	updateGridBoxesContent() {
		var shows_arrows_control = this.getElementSettings( 'show_arrows' );

		if(shows_arrows_control === 'yes') {
			(function($) {
				$('.grid-box').on('mousemove', function(e){
					const gridBox = $(this); // Store reference to $(this)
					setTimeout(function() { 
						const boxLeft =  gridBox.position().left; // Left position of the .grid-box
						$('.grid-line').css('left', boxLeft);
					}, 501);
				});


				$('.grid-box').eq(0).addClass('active-grid');
				$('.grid-box').hover(
					function() {
						$('.grid-box').removeClass('active-grid');
						$(this).addClass('active-grid');
					}
				);
			})(jQuery);
		}
	}

	onInit() {
		this.updateGridBoxesContent();
	}

	onElementChange( propertyName ) {

		if ( 'show_arrows' === propertyName ) {
			this.updateGridBoxesContent();
		}
	}

}

/**
 * Register JS Handler
 *
 */
window.addEventListener( 'elementor/frontend/init', () => {
	const addHandler = ( $element ) => {
		elementorFrontend.elementsHandler.addHandler( GridBoxesHandler, { $element } );
	};

	elementorFrontend.hooks.addAction( 'frontend/element_ready/grid-boxes.default', addHandler );
} );

