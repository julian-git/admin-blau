    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Rebuts</h3>
      </div>
      <div class="panel-body">
        <div class="row">
          <div class="col-md-9">
            <?php 
	      $DataCSN = 'Rebut';
Log::info('in quote.blade');
Log::info($csn);
Log::info($$csn);
              $instances = $$csn->rebuts()->get();
              $allow_edit = false;
            ?>
            @include('generic/snippets/datatable')
          </div>
          <div class="col-md-3">
            <a class="btn btn-warning" href="/quote/generar_rebut/{{ $quote->id }}">Generar nou rebut</a>
          </div>
        </div>
      </div>
    </div>

