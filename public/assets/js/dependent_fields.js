function dependent_list_entry(dependent_id, text) {
    var delete_button = '<button id="dependent-delete-' + dependent_id + '" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-remove"></span></button>';
    return '<div id="dependent-id-' + dependent_id + '" dependent-id="' + dependent_id + '" class="dependent_list_item"><span>' + text + '</span>' + delete_button + '</div>';
}

function update_dependent_field_input() {
    var val_list = '';
    $('.dependent_list_item').each(function() {
	if (val_list.length > 0) {
	    val_list += ',';
	}
	val_list += $(this).attr('dependent-id');
    });
    $('#dependent-field-input').val(val_list);
}

$("#dependent-search").val('');

$("#dependent-search").keyup(function(e) {
    var minLength = 3;  // search with min of X characters
    var searchStr = $("#dependent-search").val();
    var dependentButton = $('#dependent-search').attr('dependentButton');
    if (searchStr.length >= minLength) {
	$.getJSON('/' + $('#dependent-search').attr('dependentClass') + 's/search/' + searchStr, function() {
	}).done(function(dependentObject) {
	    $('#dependent-search')
		.attr('dependent-id', dependentObject.id)
		.val(dependentObject.name);
	    if (dependentObject.id != -1) {
		$('#' + dependentButton).removeClass('disabled');
		var href = $('#' + dependentButton).attr('href');
		if (href.length > 0) {
		    var last_slash = href.lastIndexOf('/');
		    $('#' + dependentButton).attr('href', href.substr(0, last_slash) + '/' + dependentObject.id);
		}
	    } else {
		$('#' + dependentButton).addClass('disabled');
	    }
        }).fail(function(result) {
            $('#dependent-search').val("No es troba cap persona semblant.");
	    $('#' + dependentButton).addClass('disabled');
	});
    }
});

$('#afegir-button').click(function() {
    var dependent_id = $('#dependent-search').attr('dependent-id');
    if (dependent_id != -1) {
	var dependent_text = $('#dependent-search').val();
	$('#dependent-field-list').append(dependent_list_entry(dependent_id, dependent_text));   
	$('#dependent-search').val('');
	$('#afegir-button').addClass('disabled');
	$('#dependent-delete-' + dependent_id).click(function(){
	    $('#dependent-id-' + dependent_id).remove();
	    update_dependent_field_input();
	});
	update_dependent_field_input();
    }
});
