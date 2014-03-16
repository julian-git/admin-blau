Array.prototype.in_array = function(search_term) {
    var i = this.length - 1;
    if (i >= 0) {
	do {
	    if (this[i] === search_term) {
		return true;
	    }
	} while (i--);
    }
    return false;
}

function dependent_list_entry(dependentField, dependent_id, text) {
    var delete_button = '<button id="remove-' + dependentField + '-id-' + dependent_id + '" ' + dependentField + '-id="' + dependent_id + '" dependentField="' + dependentField + '" class="btn btn-danger btn-xs cvg-remove-button"><span class="glyphicon glyphicon-remove"></span></button>';
    return '<div id="' + dependentField + '-id-' + dependent_id + '" ' + dependentField + '-id="' + dependent_id + '" class="' + dependentField + '_item"><span>' + text + '</span>' + delete_button + '</div>';
}

function set_dependent_field(field, master_class, master_id) {
    alert('set_dependent_field(' + field + ',' + master_class + ',' + master_id + ')');
    if (!master_id) {
	$("[field='" + field + "']").text('');
	return;
    }
    if (!! master_id.indexOf(',')) {
	alert("Només puc tractar valors únics"); 
	return;
    }
    $.getJSON('/' + master_class + 's/search/' + master_id, function() {
    }).done(function(masterObject) {
	$("[field='" + field + "']").text(masterObject.field);
    }).fail(function(result) {
        alert("Did not find the object!");
    });
}

function update_dependent_field_input(dependentField) {
    var val_list = '';
    $('#' + dependentField + '.' + dependentField + '_item').each(function() {
	if (val_list.length > 0) {
	    val_list += ',';
	}
	val_list += $(this).attr(dependentField + '-id');
    });
    alert (dependentField + " updated to " + val_list);
    $('#' + dependentField).val(val_list);
    var udae = $('#' + dependentField).attr('update-display-after-edit');
    alert('udae: ' + udae);
    if ( !! udae ) {
	var fields = udae.split(',');
	alert('fields: ' + fields  + ', length: ' + fields.length);
	for (var i=0; i < fields.length; i++) {
	    alert('field: ' + fields[i]);
	    set_dependent_field(fields[i], $('#' + dependentField).attr('master-class'), val_list);
	}
    }
}

function remove_button_clicked(dependentField, dependent_id)
{
//    alert("will remove " + dependentField + '-id-' + dependent_id);
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

function append_dependent_field(dependent_id, dependentField, searchField)
{
    var dependent_text = $('#' + searchField).val();
    $('#' + searchField).val('');
    $('#' + dependentField + '-field-list').append(dependent_list_entry(dependentField, dependent_id, dependent_text));   
}

function can_add_id(dependent_id, dependentField)
{
    if (dependent_id == -1) {
	return false;
    }
    var field = $('#' + dependentField);
    var field_val = field.val();
    if (field.hasClass('cvg-single-entry') &&
	field_val.length > 0) {
	alert('Només pot haber-hi una entrada en aquesta llista');
	return false;
    }
    if (field_val.split(',').in_array(dependent_id)) {
	alert('Aquesta entrada ja hi existeix a la llista');
	return false;
    }
    return true;
}

$('.afegir-button').click(function() {
    var searchField = $(this).attr('searchField');
    var dependentField = $('#' + searchField).attr('dependentField');
    var dependent_id = $('#' + searchField).attr(dependentField + '-id');
    $(this).addClass('disabled');
    if (!can_add_id(dependent_id, dependentField)) {
	$('#' + searchField).val('');	
    } else {
	append_dependent_field(dependent_id, dependentField, searchField);
	$('#remove-' + dependentField + '-id-' + dependent_id).click(function() {
	    var dependentField = $(this).attr('dependentField');
	    remove_button_clicked(dependentField, $(this).attr(dependentField + '-id'));
	});
	update_dependent_field_input(dependentField);
    }
});
