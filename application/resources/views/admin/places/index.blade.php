@extends('adminlte::page')

@section('title', 'Lugares de Interes')

@section('content')
<div class="container-fluid">
	<section class="content">
		@include('flash::message')
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3>Lugares de Interes</h3>
					</div>
					<div class="box-body">
						<a href="{{ route('places.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> Nuevo</a>
						<br />
						<br />
						<table class="table table-bordered table-striped">
							<thead>
								<th>ID</th>
								<th>Foto</th>
								<th>Fecha</th>
								<th>Lugar</th>
								<th>Activo</th>
								<th>Telefono</th>
								<th>Localidad</th>
								<th>Direccion</th>
								<th>Pais</th>
								<th>Ciudad</th>
								<th>Descripcion</th>
								<th>Acciones</th>
							</thead>
							<tbody>
								@foreach($places as $place)
								<tr>
									<td>{{ $place->id }}</td>
									<td>
										@if(isset($place->image) and !empty($place->image))
											<img src="{{ asset('application/storage/app/'.$place->image) }}" class="img-thumbnail" style="width:80px !important; height:80px !important;">
										@else

										@endif
									</td>
									<td>{{ date('d-m-Y',strtotime($place->created_at)) }}</td>
									<td>{{ $place->name }}</td>
									<td>
										@if($place->isactive)
											Activo
										@else
											Inactivo
										@endif
									</td>
									<td>{{ $place->phone }}</td>
									<td>{{ $place->location->name }}</td>
									<td>{{ $place->direction }}</td>
									<td>{{ $place->country }}</td>
									<td>{{ $place->city }}</td>
									<td>{!! $place->description !!}</td>
									<td>
										<a class="btn btn-info" href="{{ route('places.edit',['id' => $place->id]) }}"><i class="fa fa-pencil"></i></a>
										{!! Form::open(['route' => ['places.destroy',$place->id], 'method' => 'DELETE', 'style' => 'display:inline;']) !!}
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