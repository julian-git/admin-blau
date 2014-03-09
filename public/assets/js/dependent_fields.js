function dependent_list_entry(dependentField, dependent_id, text) {
    var delete_button = '<button id="remove-' + dependentField + '-id-' + dependent_id + '" ' + dependentField + '-id="' + dependent_id + '" dependentField="' + dependentField + '" class="btn btn-default btn-xs cvg-remove-button"><span class="glyphicon glyphicon-remove"></span></button>';
    return '<div id="' + dependentField + '-id-' + dependent_id + '" ' + dependentField + '-id="' + dependent_id + '" class="dependent_list_item"><span>' + text + '</span>' + delete_button + '</div>';
}

function update_dependent_field_input(dependentField) {
    var val_list = '';
    $('.dependent_list_item').each(function() {
	if (val_list.length > 0) {
	    val_list += ',';
	}
	val_list += $(this).attr(dependentField + '-id');
    });
    alert ("updated to " + val_list);
    $('#' + dependentField + '_input').val(val_list);
}

function remove_button_clicked(dependentField, dependent_id)
{
    alert("will remove " + dependentField + '-id-' + dependent_id);
    $('#' + dependentField + '-id-' + dependent_id).remove();
    update_dependent_field_input(dependentField);
}

$('.dependent-search').val('');

$('.cvg-remove-button').click(function() {
    var dependentField = $(this).attr('dependentField');
    remove_button_clicked(dependentField, $(this).attr(dependentField + '-id'));
});

$('.dependent-search').keyup(function(e) {
    var minLength = 3;  // search with min of X characters
    var searchStr = $(this).val();
    var dependentButton = $(this).attr('dependentButton');
    var dependentField = $(this).attr('dependentField');
    var searchId = $(this).attr('id');
    if (searchStr.length >= minLength) {
	$.getJSON('/' + $(this).attr('dependentClass') + 's/search/' + searchStr, function() {
	}).done(function(dependentObject) {
	    $('#' + searchId)
		.attr(dependentField + '-id', dependentObject.id)
		.val(dependentObject.name);
	    if (dependentObject.id == -1) {
		$('#' + dependentButton).addClass('disabled');
	    } else {
		$('#' + dependentButton).removeClass('disabled');
		var href = $('#' + dependentButton).attr('href');
		if (!!href) { // checks against undefined and false
		    var last_slash = href.lastIndexOf('/');
		    $('#' + dependentButton).attr('href', href.substr(0, last_slash) + '/' + dependentObject.id);
		}
	    } 
        }).fail(function(result) {
            $('#' + searchId).val("No es troba cap persona semblant.");
	    $('#' + dependentButton).addClass('disabled');
	});
    }
});

$('.afegir-button').click(function() {
    var dependent_search = $(this).attr('searchField');
    var dependentField = $('#' + dependent_search).attr('dependentField');
    var dependent_id = $('#' + dependent_search).attr(dependentField + '-id');
    if (dependent_id != -1) {
	var dependent_text = $('#' + dependent_search).val();
	$('#' + dependentField + '-field-list').append(dependent_list_entry(dependentField, dependent_id, dependent_text));   
	$('#' + dependent_search).val('');
	$(this).addClass('disabled');
	$('#remove-' + dependentField + '-id-' + dependent_id).click(function() {
	    var dependentField = $(this).attr('dependentField');
	    remove_button_clicked(dependentField, $(this).attr(dependentField + '-id'));
	});
	update_dependent_field_input(dependentField);
    }
});
