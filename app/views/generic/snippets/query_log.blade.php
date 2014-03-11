    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Query Log</h3>
      </div>
      <div class="panel-body">

@foreach(DB::connection()->getQueryLog() as $query)
		<div>{{ $query['query'] }} {{ var_dump($query['bindings']) }} </div>
@endforeach
      </div>
    </div>
