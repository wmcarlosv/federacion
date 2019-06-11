@extends('adminlte::page')

@section('title', 'Capacitaciones')

@section('content')
<div class="container-fluid">
	<section class="content">
		@include('flash::message')
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3>Capacitaciones</h3>
					</div>
					<div class="box-body">
						<a href="{{ route('trainings.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> Nueva</a>
						<br />
						<br />
						<table class="table table-bordered table-striped">
							<thead>
								<th>ID</th>
								<th>Fecha</th>
								<th>Imagen</th>
								<th>Titulo</th>
								<th>Descripcion</th>
								<th>Categoria</th>
								<th>Acciones</th>
							</thead>
							<tbody>
								@foreach($trainings as $training)
								<tr>
									<td>{{ $training->id }}</td>
									<td>{{ date('d-m-Y',strtotime($training->created_at)) }}</td>
									<td>
										@if(isset($training->image) and !empty($training->image))
											<img src="{{ asset('application/storage/app/'.$training->image) }}" class="img-thumbnail" style="width:80px !important; height:80px !important;">
										@else
											Sin Imagen
										@endif
									</td>
									<td>{{ $training->title }}</td>
									<td>{{ $training->description }}</td>
									<td>{{ $training->category->name }}</td>
									<td>
										<a class="btn btn-info" href="{{ route('trainings.edit',['id' => $training->id]) }}"><i class="fa fa-pencil"></i></a>
										{!! Form::open(['route' => ['trainings.destroy',$training->id], 'method' => 'DELETE', 'style' => 'display:inline;']) !!}
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