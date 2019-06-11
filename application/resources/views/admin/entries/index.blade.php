@extends('adminlte::page')

@section('title', 'Rubros')

@section('content')
<div class="container-fluid">
	<section class="content">
		@include('flash::message')
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3>Rubros</h3>
					</div>
					<div class="box-body">
						<a href="{{ route('entries.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> Nuevo</a>
						<br />
						<br />
						<table class="table table-bordered table-striped">
							<thead>
								<th>ID</th>
								<th>Fecha</th>
								<th>Nombre</th>
								<th>Descripcion</th>
								<th>Imagen</th>
								<th>Acciones</th>
							</thead>
							<tbody>
								@foreach($entries as $entry)
								<tr>
									<td>{{ $entry->id }}</td>
									<td>{{ date('d-m-Y',strtotime($entry->created_at)) }}</td>
									<td>{{ $entry->name }}</td>
									<td>{{ $entry->description }}</td>
									<td>
										@if(isset($entry->image) and !empty($entry->image))
											<img src="{{ asset('application/storage/app/'.$entry->image) }}" class="img-thumbnail" style="width:80px !important; height:80px !important;">
										@else

										@endif
									</td>
									<td>
										<a class="btn btn-info" href="{{ route('entries.edit',['id' => $entry->id]) }}"><i class="fa fa-pencil"></i></a>
										{!! Form::open(['route' => ['entries.destroy',$entry->id], 'method' => 'DELETE', 'style' => 'display:inline;']) !!}
										<button type="submit" class="btn btn-danger delete-row"><i class="fa fa-times"></i></button>
										{!! Form::close() !!}
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
@endsection
@section('js')
<script type="text/javascript">
	$(document).ready(function(){
		$("table.table").DataTable();

		$(".delete-row").click(function(){
			if(!confirm("Esta seguro de Eliminar este Registro?")){
				return false;
			}
		});

		$('div.alert').not('.alert-important').delay(3000).fadeOut(350);
	});
</script>
@endsection