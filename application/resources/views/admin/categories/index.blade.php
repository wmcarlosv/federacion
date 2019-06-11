@extends('adminlte::page')

@section('title', 'Categorias')

@section('content')
<div class="container-fluid">
	<section class="content">
		@include('flash::message')
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3>Categorias</h3>
					</div>
					<div class="box-body">
						<a href="{{ route('categories.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> Nueva</a>
						<br />
						<br />
						<table class="table table-bordered table-striped">
							<thead>
								<th>ID</th>
								<th>Fecha</th>
								<th>Nombre</th>
								<th>Descripcion</th>
								<th>Acciones</th>
							</thead>
							<tbody>
								@foreach($categories as $category)
								<tr>
									<td>{{ $category->id }}</td>
									<td>{{ date('d-m-Y',strtotime($category->created_at)) }}</td>
									<td>{{ $category->name }}</td>
									<td>{{ $category->description }}</td>
									<td>
										<a class="btn btn-info" href="{{ route('categories.edit',['id' => $category->id]) }}"><i class="fa fa-pencil"></i></a>
										{!! Form::open(['route' => ['categories.destroy',$category->id], 'method' => 'DELETE', 'style' => 'display:inline;']) !!}
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