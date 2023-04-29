

(function( $ ) {

	wp.customize( 'primary_color', function( value ) {
		value.bind( function( to ) {
			var style = $( '#custom-theme-colors' ),
				hue = style.data( 'hue' ),
				css = style.html(),
				color;

			if( 'custom' === to ){
				color = wp.customize.get().primary_color_hue;
			} else {
				color = 199;
			}

			css = css.split( hue + ',' ).join( color + ',' );
			style.html( css ).data( 'hue', color );
		});
	});

	wp.customize( 'primary_color_hue', function( value ) {
		value.bind( function( to ) {

			var style = $( '#custom-theme-colors' ),
				hue = style.data( 'hue' ),
				css = style.html();

			css = css.split( hue + ',' ).join( to + ',' );
			style.html( css ).data( 'hue', to );
		});
	});

	wp.customize( 'image_filter', function( value ) {
		value.bind( function( to ) {
			if ( to ) {
				$( 'body' ).addClass( 'image-filters-enabled' );
			} else {
				$( 'body' ).removeClass( 'image-filters-enabled' );
			}
		} );
	} );

})( jQuery );
