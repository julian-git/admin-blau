    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Rebuts</h3>
      </div>
      <div class="panel-body">
        <div class="row">
          <div class="col-md-9">
            <?php 
	      $DataCSN = 'Rebut';
              $instances = $$csn->rebuts()->get();
              $allow_edit = false;
            ?>
            @include('generic/snippets/datatable')
          </div>
          @if ($action != 'Enviar correu')
            <div class="col-md-3">
              <a class="btn btn-warning" href="/quote/generar_rebut/{{ $quote->id }}">Generar nou rebut</a>
            </div>
          @endif
        </div>
      </div>
    </div>

