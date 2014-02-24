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

function drawCastellBar(element) {
    element.text('aa' + element.attr('field'));
/*
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                            <span class="sr-only">40% Complert (warning)</span>
                                        </div>
                                    </div>
*/
}