function rgbtohex( rgb ) {
	var hex = '#';
	jQuery.each( rgb, function( index, value ) {
		hex += ( '00' + value.toString( 16 ).toUpperCase() ).slice( -2 );
	});
	return hex;
}

function brightness( rgb ) {
	return Math.sqrt( ( 0.299 * Math.pow( rgb[0], 2 ) ) + ( 0.587 * Math.pow( rgb[1], 2 ) ) + ( 0.114 * Math.pow( rgb[2], 2 ) ) );
}
