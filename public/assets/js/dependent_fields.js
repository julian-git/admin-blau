function dependent_list_entry(dependent_id, text) {
    var delete_button = '<button dependent-id="' + dependent_id + '" class="btn btn-default btn-xs cvg-remove-button"><span class="glyphicon glyphicon-remove"></span></button>';
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
    $('#dependent_field_input').val(val_list);
}

function remove_button_clicked(dependent_id)
{
    $('#dependent-id-' + dependent_id).remove();
    update_dependent_field_input();
}

$('.dependent-search').val('');

$('.cvg-remove-button').click(function() {
    remove_button_clicked($(this).attr('dependent-id'));
});

$('.dependent-search').keyup(function(e) {
    var minLength = 3;  // search with min of X characters
    var searchStr = $(this).val();
    var dependentButton = $(this).attr('dependentButton');
    var searchId = $(this).attr('id');
    if (searchStr.length >= minLength) {
	$.getJSON('/' + $(this).attr('dependentClass') + 's/search/' + searchStr, function() {
	}).done(function(dependentObject) {
	    $('#' + searchId)
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
            $('#' + searchId).val("No es troba cap persona semblant.");
	    $('#' + dependentButton).addClass('disabled');
	});
    }
});

$('.afegir-button').click(function() {
    var dependent_search = $(this).attr('searchField');
    var dependent_id = $('#' + dependent_search).attr('dependent-id');
    if (dependent_id != -1) {
	var dependent_text = $('#' + dependent_search).val();
	$('#dependent-field-list').append(dependent_list_entry(dependent_id, dependent_text));   
	$('#' + dependent_search).val('');
	$(this).addClass('disabled');
	$('.cvg-remove-button').click(function() {
	    remove_button_clicked($(this).attr('dependent-id'));
	});
	update_dependent_field_input();
    }
});
