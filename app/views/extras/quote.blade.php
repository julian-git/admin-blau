    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Rebuts</h3>
      </div>
      <div class="panel-body">
        <div class="row">
          <div class="col-md-6">
            @foreach ($$csn->rebuts() as $rebut)
              @include ('generic/snippets/assemble_dependent_input', array('DCL' => 'Rebut', 'dependent_id' => $rebut->id))
            @endforeach
          </div>
          <div class="col-md-6">
            buttons
          </div>
        </div>
      </div>
    </div>