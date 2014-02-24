function drawStatusBar(barDiv, url, thresholds) {
    var theId = barDiv.attr('detail-id');
    $.getJSON(url + theId,  function() {
    }).done(function(numApuntats) {
	$('#current-count-' + theId).text(numApuntats);
	var percent = Math.min(100, 
			       Math.floor(100.0 * numApuntats / barDiv.attr('aria-valuemax')));

	if (percent <= thresholds[0]) {
	    barDiv.addClass('progress-bar-danger');
	} else if (percent <= thresholds[1]) {
	    barDiv.addClass('progress-bar-warning');
	} else if (percent <= thresholds[2]) {
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