function updateStatusBars(detailDiv, url, thresholds) {
    var detailId = detailDiv.attr('detail-id');
    $.getJSON(url + detailId,  function() {
    }).done(function(numApuntats) {
	var detailDivId = detailDiv.attr('id');
	$('#' + detailDivId + ' .current-count-detail-id-' + detailId).text(numApuntats);
	$('#' + detailDivId + ' .progress-bar').each(function(){
	    var percent = Math.min(100, 
				   Math.floor(100.0 * numApuntats / $(this).attr('aria-valuemax')));
	    if (percent <= thresholds[0]) {
		$(this).addClass('progress-bar-danger');
	    } else if (percent <= thresholds[1]) {
		$(this).addClass('progress-bar-warning');
	    } else if (percent <= thresholds[2]) {
		$(this).addClass('progress-bar-info');
	    } else {
		$(this).addClass('progress-bar-success');
	    }

	    $(this).attr('aria-valuenow', percent);
	    $(this).attr('style', "width: " + percent + "%");
	    
	});

    }).fail(function(result) {
	detailDiv.parent().append('<div class="error">Error!</div>');
    });
}