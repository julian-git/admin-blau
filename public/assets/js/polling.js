function polling(className, aFields) {
    $.getJSON('/properes-' + className + 's', function() {
    }).done(function(result) {
	for(i=0, rlen=result.length; i<rlen; i++) {
	    var resultId = className + i;
	    $('#' + className + '-wrap').append('<div id="' + resultId + '">');
	    for(j=0, flen=aFields.length; j<flen; j++) {
		$('#' + resultId).append('<div id="' + aFields[j] + i + '">' + result[i][aFields[j]] + '</div>');
	    }
	}
    }).fail(function(result) {
	$('#' + className + '-wrap').append('<div class="error">Error</div>');
    });
}

function pollCastells(index, value) {
    alert(value);
}