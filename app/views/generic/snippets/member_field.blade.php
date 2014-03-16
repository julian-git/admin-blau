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

      @elseif($action == 'Editar' && isset($dropbox_options[$field]))

        {{ Form::select($field, $dropbox_options[$field], $dropbox_default[$field]) }}

      @elseif ($CSN::is_checkbox($field))

        @if ($action=='Mostrar')
          {{ ($$csn->$field) ? 'Sí' : 'No' }}
        @elseif ($action=='Editar')
          {{ Form::checkbox($field, $$csn->$field, $$csn->$field) }}
        @else
	  {{ Form::checkbox($field, Input::old($field), Input::old($field)) }}
        @endif

        {{ $errors->first($field, '<span class="cvg-error">:message</span>') }}

      @elseif ($CSN::is_textarea($field))

        @if ($action=='Mostrar')
          {{ $$csn->resolve($field) }}
        @elseif ($action=='Editar')
          {{ Form::textarea($field, $$csn->$field, array('size' => $$csn->display_size_of($field))) }}
        @else
          {{ Form::textarea($field, Input::old($field), array('size' => $$csn->display_size_of($field))) }}
        @endif


      @else 

        @if ($action=='Mostrar' || ! $CSN::is_editable($field))
          {{ $$csn->resolve($field) }}
        @elseif ($action=='Editar')
          {{ Form::text($field, $$csn->$field, array('size' => $$csn->display_size_of($field))) }}
        @else
          {{ Form::text($field, Input::old($field), array('size' => $$csn->display_size_of($field))) }}
        @endif

        {{ $errors->first($field, '<span class="cvg-error">:message</span>') }}

      @endif 
     </div> <!-- form-group -->
   </div> <!-- col-md -->
</div> <!-- row -->
@endif <!-- field != id -->
