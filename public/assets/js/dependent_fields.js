function update_dependent_field_input() {
    var list = '';
    $('.dependent_list_item').each(function(){
	if (list.length > 0) {
	    list += ',';
	}
	list += $(this).attr('dependent-id');
    });
    $('#dependent-field-input').val(list);
}

$("#dependent-search").val('');

$("#dependent-search").keyup(function(e){
    var minLength = 3;  // search with min of X characters
    var searchStr = $("#dependent-search").val();
    if (searchStr.length >= minLength) {
	$.getJSON('/{{ strtolower($CSN::$dependent_class) }}' + 's/search/' + searchStr, function() {
	}).done(function(dependentObject) {
	    $('#dependent-search')
		.attr('dependent-id', dependentObject.id)
		.val(dependentObject.name);
	    if (dependentObject.id != -1) {
		$('#afegir-button').removeClass('disabled');
	    } else {
		$('#afegir-button').addClass('disabled');
	    }
        }).fail(function(result) {
            $('#dependent-search').val("No es troba cap persona semblant.");
	    $('#afegir-button').addClass('disabled');
	});
    }
});

$('#afegir-button').click(function() {
    var dependent_id = $('#dependent-search').attr('dependent-id');
    if (dependent_id != -1) {
	var delete_button = '<button id="dependent-delete-' + dependent_id + '" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-remove"></span></button>';
	var dependent_div = '<div id="dependent-id-' + dependent_id + '" dependent-id="' + dependent_id + '" class="dependent_list_item"><span>' + $('#dependent-search').val() + '</span>' + delete_button + '</div>';
	$('#dependent-field-list').append(dependent_div);   
	$('#dependent-search').val('');
	$('#afegir-button').addClass('disabled');
	$('#dependent-delete-' + dependent_id).click(function(){
	    $('#dependent-id-' + dependent_id).remove();
	    update_dependent_field_input();
	});
	update_dependent_field_input();
    }
});
