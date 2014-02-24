function drawCastellBar(barDiv) {
    var castellId = barDiv.attr('castell-id');
    $.getJSON('/persones/apuntats/' + castellId,  function() {
    }).done(function(numApuntats) {
	$('#current-count-' + castellId).text(numApuntats);
	var percent = Math.min(100, 
			       Math.floor(100.0 * numApuntats / barDiv.attr('aria-valuemax')));

	if (percent <= 50) {
	    barDiv.addClass('progress-bar-danger');
	} else if (percent <= 70) {
	    barDiv.addClass('progress-bar-warning');
	} else if (percent <= 90) {
	    barDiv.addClass('progress-bar-info');
	} else {
	    barDiv.addClass('progress-bar-success');
	}

	barDiv.attr('aria-valuenow', percent);
	barDiv.attr('style', "width: " + percent + "%");

    }).fail(function(result) {
	barDiv.parent().append('<div class="error">Error!</div>');
    });
}