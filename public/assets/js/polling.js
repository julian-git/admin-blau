function polling(className, aFields) {
    $.getJSON('/' + className + '/json', function() {
    }).done(function(result) {
	for(i=0, rlen=result.length; i<rlen; i++) {
	    for(j=0, flen=aFields.length; j<flen; j++) {
		$('#' + className + '-wrap').append('<div id="' + aFields[j] + i + '">' + result[i][aFields[j]] + '</div>');
	    }
	}
    }).fail(function(result) {
	$('#' + className + '-wrap').append('<div class="error">Error</div>');
    });
}