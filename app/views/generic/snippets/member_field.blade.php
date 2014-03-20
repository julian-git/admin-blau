@if ($field != 'id')
<div class="row">
  <div class="col-md-3">
    <div class="form-group">
      {{ Form::label($field, $prompt) }} 
    </div>
  </div>
  <div class="col-md-9">
    <div class="form-group" field="{{ $field }}">

      @if ($CSN::is_foreign_selection($field))

        @include('generic/snippets/foreign_selection')

      @elseif($CSN::is_foreign_chooser($field))

        <?php
          $include_args = array('button_action_text' => 'Afegir', 
				'dependent_button' => "afegir-$field-button"
				); // We put it here because @include breaks with newlines
        ?>
        @include('generic/snippets/foreign_chooser', $include_args)

	@elseif(! in_array($action, array('Mostrar', 'Enviar correu')) && isset($dropbox_options[$field]))

        {{ Form::select($field, $dropbox_options[$field], $dropbox_default[$field]) }}

      @elseif ($CSN::is_checkbox($field))

        @if (in_array($action, array('Mostrar', 'Enviar correu')))
          {{ ($$csn->$field) ? 'Sí' : 'No' }}
        @elseif ($action=='Editar')
          {{ Form::checkbox($field, $$csn->$field, $$csn->$field) }}
        @elseif (sizeof(Input::old($field)) > 0)
	  {{ Form::checkbox($field, Input::old($field), Input::old($field)) }}
        @else
          {{ Form::checkbox($field, $CSN::$default_values[$field], $CSN::$default_values[$field]) }}
        @endif

        {{ $errors->first($field, '<span class="cvg-error">:message</span>') }}

      @elseif ($CSN::is_textarea($field))

        @if (in_array($action, array('Mostrar', 'Enviar correu')))
          {{ $$csn->resolve($field) }}
        @elseif ($action=='Editar')
          {{ Form::textarea($field, $$csn->$field, array('size' => display_size_of($CSN, $field))) }}
        @else
          {{ Form::textarea($field, Input::old($field), array('size' => display_size_of($CSN, $field))) }}
        @endif


      @else 

        @if (in_array($action, array('Mostrar', 'Enviar correu')) ||
	     ($action != 'Crear' && ! $CSN::is_editable($field)))
          {{ $$csn->resolve($field) }}
        @elseif ($action=='Editar')
          {{ Form::text($field, $$csn->$field, array('size' => display_size_of($CSN, $field))) }}
        @elseif (sizeof(Input::old($field)))
          {{ Form::text($field, Input::old($field), array('size' => display_size_of($CSN, $field))) }}
        @elseif (isset($CSN::$default_values[$field]))
          {{ Form::text($field, $CSN::$default_values[$field], array('size' => display_size_of($CSN, $field))) }}
        @else
          {{ Form::text($field, null, array('size' => display_size_of($CSN, $field))) }}
        @endif

        {{ $errors->first($field, '<span class="cvg-error">:message</span>') }}

      @endif 
     </div> <!-- form-group -->
   </div> <!-- col-md -->
</div> <!-- row -->
@endif <!-- field != id -->
