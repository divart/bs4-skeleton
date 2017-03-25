(function( $ ) {
    'use strict';
	$( window ).load(function() {

		$('.select2').select2({
            tags: true,
            tokenSeparators: [',', ' ']
        });

	});
})( jQuery );
