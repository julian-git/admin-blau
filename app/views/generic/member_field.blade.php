@if ($field != 'id')
<div class="row">
  <div class="col-md-3">
    <div class="form-group">
      {{ Form::label($field, $prompt) }} 
    </div>
  </div>
  <div class="col-md-9">
    <div class="form-group">
      @if (isset($dropbox_options[$field]))
          @if ($action == 'Dades de')
            {{ $$csn->resolve($field) }}
          @elseif (isset($dropbox_default[$field]))
            {{ Form::select($field, $dropbox_options[$field], $dropbox_default[$field]) }} 
          @else
            {{ Form::select($field, $dropbox_options[$field]) }} 
          @endif
          {{ $errors->first($field, '<span class="cvg-error">:message</span>') }}


      @elseif (isset($responsible_fields) &&
               !strcmp($responsible_fields['field'], $field))

        <?php 
          $RCL = $CSN::$responsible_class; 
        ?>
	  {{ $RCL::identifying_fields_of($responsible_fields['id']) }}
          <input type="hidden" name="{{ $field }}" value="{{ $responsible_fields['id'] }}" />
        
      @elseif (isset($dependent_fields) &&
               !strcmp($dependent_fields, $field))

	      <?php $dfi = $CSN::$dependent_field . '_input' ?>
	      @include('generic/dependent_class_form', array('DCL' => $CSN::$dependent_class, 'DF' => $CSN::$dependent_field, 'DFI' => $dfi))

      @elseif ($CSN::is_checkbox($field))

        @if ($action=='Dades de')
          {{ ($$csn->$field) ? 'Sí' : 'No' }}
        @elseif ($action=='Editar')
          {{ Form::checkbox($field, $$csn->$field, $$csn->$field) }}
        @else
	  {{ Form::checkbox($field, Input::old($field), Input::old($field)) }}
        @endif

        {{ $errors->first($field, '<span class="cvg-error">:message</span>') }}

      @elseif ($CSN::is_textarea($field))

        @if ($action=='Dades de')
          {{ $$csn->resolve($field) }}
        @elseif ($action=='Editar')
          {{ Form::textarea($field, $$csn->$field, array('size' => $$csn->display_size_of($field))) }}
        @else
          {{ Form::textarea($field, Input::old($field), array('size' => $$csn->display_size_of($field))) }}
        @endif


      @else 

        @if ($action=='Dades de')
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
