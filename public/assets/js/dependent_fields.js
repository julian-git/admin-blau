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

function set_dependent_fields(fields, masterObject) {
    var field_array = fields.split(',');
    for (var i=0; i < field_array.length; i++) {
	var the_value = ((masterObject == undefined) 
			 ? '' 
			 : masterObject[0][field_array[i]]);
	$("[field='" + field_array[i] + "']").text(the_value);
    }
}

function update_dependent_field_input(dependentField) {
    var val_list = '';
    $('.' + dependentField + '_item').each(function() {
	if (val_list.length > 0) {
	    val_list += ',';
	}
	val_list += $(this).attr(dependentField + '-id');
    });
//    alert (dependentField + " updated to " + val_list);
    $('#' + dependentField).val(val_list);
    var udae = $('#' + dependentField).attr('update-display-after-edit');
    if ( !! udae ) {
	if (val_list.indexOf(',') != -1) {
	    alert("Només puc tractar valors únics"); 
	    return;
	} else if (val_list.length == 0) {
	    set_dependent_fields(udae, undefined);
	} else {
	    $.getJSON('/' + $('#' + dependentField).attr('master-class') + 's/search_id/' + val_list, function() {
	    }).done(function(masterObject) {
		set_dependent_fields(udae, masterObject);
	    }).fail(function(result) {
		alert("Did not find the object!");
	    });
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

/*
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
*/

$('.dependent-search').each(function() {
    var searchBox = new Bloodhound({
	datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
	queryTokenizer: Bloodhound.tokenizers.whitespace,
//	prefetch: '../data/films/post_1960.json',
	remote: {
	    url: '/' + $(this).attr('dependentClass') + 's/search/%QUERY',
	}
    });
 
    searchBox.initialize();

    $(this).typeahead(null, {
	displayKey: 'value',
	source: searchBox.ttAdapter()
    });

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
